<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\RateLimiter;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the file-backed fixed-window rate limiter.
 *
 * Verifies the fixed-window counting semantics, the window rollover, the
 * retry-after calculation, identifier isolation, namespace isolation, and
 * that raw identifiers are never written to the filesystem.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Deterministic: a fixed clock makes window math exact.
 * - Uses a disposable storage directory per test.
 */
final class RateLimiterTest extends TestCase
{
    private const NOW = 1_000_000_000;

    private int $now;

    private string $storageDir;

    protected function setUp(): void
    {
        $this->now = self::NOW;
        $this->storageDir = sys_get_temp_dir() . '/rate-limiter-' . uniqid('', true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->storageDir);
    }

    public function test_counts_requests_within_a_window(): void
    {
        $limiter = $this->limiter(limit: 3, window: 60);

        self::assertTrue($limiter->consume('ip-1')->allowed());
        self::assertTrue($limiter->consume('ip-1')->allowed());
        self::assertTrue($limiter->consume('ip-1')->allowed());
        self::assertFalse($limiter->consume('ip-1')->allowed());
    }

    public function test_reports_limit_and_remaining(): void
    {
        $limiter = $this->limiter(limit: 3, window: 60);

        $first = $limiter->consume('ip-1');
        self::assertSame(3, $first->limit());
        self::assertSame(2, $first->remaining());

        $second = $limiter->consume('ip-1');
        self::assertSame(1, $second->remaining());

        $third = $limiter->consume('ip-1');
        self::assertSame(0, $third->remaining());

        $denied = $limiter->consume('ip-1');
        self::assertSame(0, $denied->remaining());
    }

    public function test_denied_requests_report_retry_after(): void
    {
        $limiter = $this->limiter(limit: 1, window: 60);

        $limiter->consume('ip-1');
        $denied = $limiter->consume('ip-1');

        self::assertFalse($denied->allowed());

        $window = intdiv(self::NOW, 60);
        $expected = (($window + 1) * 60) - self::NOW;

        self::assertSame($expected, $denied->retryAfterSeconds());
    }

    public function test_allowed_requests_report_a_minimum_retry_after(): void
    {
        $limiter = $this->limiter(limit: 1, window: 60);

        $allowed = $limiter->consume('ip-1');

        self::assertTrue($allowed->allowed());
        self::assertSame(1, $allowed->retryAfterSeconds());
    }

    public function test_window_rollover_resets_the_counter(): void
    {
        $limiter = $this->limiter(limit: 1, window: 60);

        self::assertTrue($limiter->consume('ip-1')->allowed());
        self::assertFalse($limiter->consume('ip-1')->allowed());

        $this->now = self::NOW + 60;

        self::assertTrue($limiter->consume('ip-1')->allowed());
    }

    public function test_identifiers_are_isolated(): void
    {
        $limiter = $this->limiter(limit: 1, window: 60);

        self::assertTrue($limiter->consume('ip-a')->allowed());
        self::assertFalse($limiter->consume('ip-a')->allowed());
        self::assertTrue($limiter->consume('ip-b')->allowed());
    }

    public function test_namespaces_are_isolated(): void
    {
        $one = new RateLimiter($this->storageDir, 1, 60, 'anonymous', fn (): int => $this->now);
        $two = new RateLimiter($this->storageDir, 1, 60, 'keyed', fn (): int => $this->now);

        self::assertTrue($one->consume('same-id')->allowed());
        self::assertTrue($two->consume('same-id')->allowed());
    }

    public function test_identifiers_are_hashed_before_reaching_the_filesystem(): void
    {
        $limiter = $this->limiter(limit: 1, window: 60);

        $limiter->consume('super-secret-client-key');

        $this->assertFilesContainOnlyHashedNames($this->storageDir);
        $this->assertNoFileContainsText($this->storageDir, 'super-secret-client-key');
    }

    private function limiter(int $limit, int $window): RateLimiter
    {
        return new RateLimiter($this->storageDir, $limit, $window, 'default', fn (): int => $this->now);
    }

    private function assertFilesContainOnlyHashedNames(string $directory): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
        );

        /** @var \SplFileInfo $file */
        foreach ($iterator as $file) {
            self::assertMatchesRegularExpression('/^[0-9a-f]{64}\.json$/', $file->getFilename());
        }
    }

    private function assertNoFileContainsText(string $directory, string $needle): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
        );

        /** @var \SplFileInfo $file */
        foreach ($iterator as $file) {
            self::assertStringNotContainsString($needle, (string) file_get_contents($file->getPathname()));
        }
    }

    private function removeDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        /** @var \SplFileInfo $item */
        foreach ($items as $item) {
            if ($item->isDir()) {
                @rmdir($item->getPathname());
            } else {
                @unlink($item->getPathname());
            }
        }

        @rmdir($directory);
    }
}
