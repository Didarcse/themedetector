<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use App\Modules\Http\BoundedBodyCollector;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the BoundedBodyCollector write callback.
 *
 * Verifies that the collector accepts bodies up to its limit, fails closed
 * the moment a chunk would push the total past the limit, and never
 * exposes partial content once the limit has been crossed.
 */
final class BoundedBodyCollectorTest extends TestCase
{
    public function test_rejects_a_non_positive_limit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new BoundedBodyCollector(0);
    }

    public function test_collects_a_body_below_the_limit(): void
    {
        $collector = new BoundedBodyCollector(1024);

        $accepted = $collector->write(str_repeat('a', 512));

        self::assertSame(512, $accepted);
        self::assertFalse($collector->exceeded());
        self::assertSame(str_repeat('a', 512), $collector->body());
    }

    public function test_collects_multiple_chunks_up_to_the_limit(): void
    {
        $collector = new BoundedBodyCollector(1024);

        self::assertSame(300, $collector->write(str_repeat('a', 300)));
        self::assertSame(724, $collector->write(str_repeat('b', 724)));
        self::assertFalse($collector->exceeded());
        self::assertSame(1024, strlen($collector->body()));
    }

    public function test_exact_limit_is_accepted(): void
    {
        $collector = new BoundedBodyCollector(1024);

        $accepted = $collector->write(str_repeat('x', 1024));

        self::assertSame(1024, $accepted);
        self::assertFalse($collector->exceeded());
        self::assertSame(1024, strlen($collector->body()));
    }

    public function test_a_chunk_above_the_limit_is_rejected_and_flagged(): void
    {
        $collector = new BoundedBodyCollector(1024);

        $accepted = $collector->write(str_repeat('x', 2048));

        self::assertSame(-1, $accepted);
        self::assertTrue($collector->exceeded());
        self::assertSame('', $collector->body());
    }

    public function test_a_chunk_crossing_the_limit_is_rejected_without_partial_content(): void
    {
        $collector = new BoundedBodyCollector(1024);

        self::assertSame(1000, $collector->write(str_repeat('a', 1000)));
        self::assertSame(-1, $collector->write(str_repeat('b', 30)));
        self::assertTrue($collector->exceeded());
        self::assertSame(1000, strlen($collector->body()));
        self::assertStringNotContainsString('b', $collector->body());
    }

    public function test_no_further_chunks_are_accepted_after_exceeding_the_limit(): void
    {
        $collector = new BoundedBodyCollector(8);

        self::assertSame(-1, $collector->write(str_repeat('x', 16)));
        self::assertSame(-1, $collector->write(str_repeat('y', 4)));
        self::assertTrue($collector->exceeded());
        self::assertSame('', $collector->body());
    }

    public function test_exposes_the_configured_limit(): void
    {
        $collector = new BoundedBodyCollector(4096);

        self::assertSame(4096, $collector->maxBytes());
        self::assertSame(5 * 1024 * 1024, BoundedBodyCollector::DEFAULT_MAX_BYTES);
    }
}
