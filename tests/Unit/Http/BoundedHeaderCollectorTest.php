<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use App\Modules\Http\BoundedHeaderCollector;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the BoundedHeaderCollector header callback.
 *
 * Verifies that the collector accepts header lines up to its limit, fails
 * closed the moment a line would push the total past the limit, and never
 * exposes partial content once the limit has been crossed.
 */
final class BoundedHeaderCollectorTest extends TestCase
{
    public function test_rejects_a_non_positive_limit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new BoundedHeaderCollector(0);
    }

    public function test_accepts_a_positive_limit(): void
    {
        $collector = new BoundedHeaderCollector(1024);

        self::assertSame(1024, $collector->maxBytes());
    }

    public function test_collects_header_lines_below_the_limit(): void
    {
        $collector = new BoundedHeaderCollector(1024);

        $accepted = $collector->write("Content-Type: text/html\r\n");

        self::assertSame(25, $accepted);
        self::assertFalse($collector->exceeded());
        self::assertSame("Content-Type: text/html\r\n", $collector->headers());
    }

    public function test_collects_multiple_lines_up_to_the_limit(): void
    {
        $collector = new BoundedHeaderCollector(1024);

        self::assertSame(12, $collector->write("X-One: 123\r\n"));
        self::assertSame(12, $collector->write("X-Two: abc\r\n"));
        self::assertFalse($collector->exceeded());
        self::assertSame(24, strlen($collector->headers()));
    }

    public function test_exact_limit_is_accepted(): void
    {
        $collector = new BoundedHeaderCollector(12);

        $accepted = $collector->write("X-One: 123\r\n");

        self::assertSame(12, $accepted);
        self::assertFalse($collector->exceeded());
        self::assertSame(12, strlen($collector->headers()));
    }

    public function test_a_line_above_the_limit_is_rejected_and_flagged(): void
    {
        $collector = new BoundedHeaderCollector(12);

        $accepted = $collector->write("X-One: " . str_repeat('x', 64) . "\r\n");

        self::assertSame(-1, $accepted);
        self::assertTrue($collector->exceeded());
        self::assertSame('', $collector->headers());
    }

    public function test_a_line_crossing_the_limit_is_rejected_without_partial_content(): void
    {
        $collector = new BoundedHeaderCollector(12);

        self::assertSame(12, $collector->write("X-One: 123\r\n"));
        self::assertSame(-1, $collector->write("X-Two: " . str_repeat('x', 20) . "\r\n"));
        self::assertTrue($collector->exceeded());
        self::assertSame(12, strlen($collector->headers()));
        self::assertStringNotContainsString('x', $collector->headers());
    }

    public function test_no_further_lines_are_accepted_after_exceeding_the_limit(): void
    {
        $collector = new BoundedHeaderCollector(16);

        self::assertSame(-1, $collector->write(str_repeat('x', 32) . "\r\n"));
        self::assertSame(-1, $collector->write("X-Two: 1\r\n"));
        self::assertTrue($collector->exceeded());
        self::assertSame('', $collector->headers());
    }

    public function test_exposes_the_configured_limit_and_default(): void
    {
        $collector = new BoundedHeaderCollector(4096);

        self::assertSame(4096, $collector->maxBytes());
        self::assertSame(64 * 1024, BoundedHeaderCollector::DEFAULT_MAX_BYTES);
    }
}
