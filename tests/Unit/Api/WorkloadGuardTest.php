<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\WorkloadGuard;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the file-backed in-flight concurrency guard.
 *
 * Verifies the acquire/release accounting, the concurrency cap, the TTL
 * recovery for stale counters, the disabled configuration, and the
 * fail-closed behaviour when the counter file cannot be opened.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Deterministic: a fixed clock makes TTL math exact.
 * - Uses a disposable storage directory per test.
 */
final class WorkloadGuardTest extends TestCase
{
    private const NOW = 1_000_000_000;

    private int $now;

    private string $storageDir;

    protected function setUp(): void
    {
        $this->now = self::NOW;
        $this->storageDir = sys_get_temp_dir() . '/workload-guard-' . uniqid('', true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->storageDir);
    }

    public function test_acquire_and_release_round_trip(): void
    {
        $guard = $this->guard(maxConcurrent: 2);

        self::assertTrue($guard->acquire());
        self::assertTrue($guard->acquire());

        $guard->release();

        self::assertTrue($guard->acquire());
    }

    public function test_denies_acquisition_at_capacity(): void
    {
        $guard = $this->guard(maxConcurrent: 2);

        self::assertTrue($guard->acquire());
        self::assertTrue($guard->acquire());
        self::assertFalse($guard->acquire());
    }

    public function test_disabled_guard_always_acquires(): void
    {
        $guard = $this->guard(maxConcurrent: 0);

        self::assertTrue($guard->acquire());
        self::assertTrue($guard->acquire());

        $guard->release();
    }

    public function test_release_never_drops_below_zero(): void
    {
        $guard = $this->guard(maxConcurrent: 2);

        $guard->release();
        $guard->release();
        $guard->release();

        self::assertTrue($guard->acquire());
        self::assertTrue($guard->acquire());
    }

    public function test_stale_counter_recovers_after_the_ttl(): void
    {
        $guard = $this->guard(maxConcurrent: 1);

        self::assertTrue($guard->acquire());
        self::assertFalse($guard->acquire());

        $this->now = self::NOW + 121;

        self::assertTrue($guard->acquire());
    }

    public function test_fails_closed_when_the_counter_file_cannot_be_opened(): void
    {
        $guard = $this->guard(maxConcurrent: 2);

        mkdir($this->storageDir, 0755, true);
        mkdir($this->storageDir . '/active.json');

        self::assertFalse($guard->acquire());

        $guard->release();
    }

    private function guard(int $maxConcurrent): WorkloadGuard
    {
        return new WorkloadGuard($this->storageDir, $maxConcurrent, 120, fn (): int => $this->now);
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
