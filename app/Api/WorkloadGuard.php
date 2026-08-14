<?php

declare(strict_types=1);

namespace App\Api;

use InvalidArgumentException;
use JsonException;
use RuntimeException;

/**
 * Dependency-free in-flight concurrency guard backed by atomic file locks.
 *
 * WorkloadGuard caps how many detections may be in flight across the
 * application at the same time. A single counter file is read, incremented,
 * and written back under an exclusive flock, so concurrent requests cannot
 * race into a lost update. Counters expire after a bounded TTL so a crashed
 * request can never wedge the guard permanently.
 *
 * Responsibilities:
 *
 * - Track the number of in-flight detections.
 * - Deny acquisition when the concurrency cap is reached.
 * - Recover automatically from stale counters via a TTL.
 *
 * Design philosophy:
 *
 * - Dependency-free: PHP core file I/O only; no Composer dependencies.
 * - Race-safe: every read-modify-write happens under an exclusive lock.
 * - Fail closed: when the counter file cannot be opened the guard denies
 *   acquisition rather than allowing unbounded concurrency.
 * - Single-instance: the counter lives on the local filesystem, so the
 *   guard is only accurate for a single application instance.
 *
 * @see docs/api.md for the single-instance deployment limitation.
 */
final class WorkloadGuard
{
    private string $storageDir;
    private int $maxConcurrent;
    private int $ttlSeconds;

    /** @var \Closure(): int */
    private \Closure $clock;

    /**
     * Create a workload guard.
     *
     * @param string         $storageDir    The directory holding the counter
     *                                      file.
     * @param int            $maxConcurrent The maximum concurrent
     *                                      detections, 0 disables the guard.
     * @param int            $ttlSeconds    Seconds after which a stale
     *                                      counter is reset.
     * @param \Closure():int $clock         The clock used for expiry math,
     *                                      injectable for deterministic
     *                                      tests.
     */
    public function __construct(
        string $storageDir,
        int $maxConcurrent,
        int $ttlSeconds = 120,
        ?\Closure $clock = null,
    ) {
        if ($maxConcurrent < 0) {
            throw new InvalidArgumentException('Max concurrent must not be negative.');
        }

        if ($ttlSeconds < 1) {
            throw new InvalidArgumentException('Guard TTL must be at least 1 second.');
        }

        $this->storageDir = rtrim($storageDir, '/\\');
        $this->maxConcurrent = $maxConcurrent;
        $this->ttlSeconds = $ttlSeconds;
        $this->clock = $clock ?? static fn (): int => time();
    }

    /**
     * Try to acquire a detection slot.
     *
     * When the concurrency cap is reached, false is returned and the
     * counter is left untouched. The counter file is created on first use.
     *
     * @return bool True when a slot was acquired, false when the guard is
     *              at capacity.
     */
    public function acquire(): bool
    {
        if ($this->maxConcurrent < 1) {
            return true;
        }

        $file = $this->counterFile();

        $handle = $this->openFile($file);

        if ($handle === null) {
            return false;
        }

        try {
            flock($handle, LOCK_EX);

            $record = $this->decode(stream_get_contents($handle) ?: '');
            $now = ($this->clock)();

            if ($record['count'] >= $this->maxConcurrent && $record['expiresAt'] >= $now) {
                flock($handle, LOCK_UN);

                return false;
            }

            $this->persist($handle, [
                'count' => $record['count'] + 1,
                'expiresAt' => $now + $this->ttlSeconds,
            ]);

            flock($handle, LOCK_UN);

            return true;
        } finally {
            fclose($handle);
        }
    }

    /**
     * Release a previously acquired detection slot.
     *
     * Safe to call when the guard is disabled. The counter is decremented
     * but never drops below zero.
     */
    public function release(): void
    {
        if ($this->maxConcurrent < 1) {
            return;
        }

        $file = $this->counterFile();

        $handle = $this->openFile($file);

        if ($handle === null) {
            return;
        }

        try {
            flock($handle, LOCK_EX);

            $record = $this->decode(stream_get_contents($handle) ?: '');

            $this->persist($handle, [
                'count' => max(0, $record['count'] - 1),
                'expiresAt' => $record['expiresAt'],
            ]);

            flock($handle, LOCK_UN);
        } finally {
            fclose($handle);
        }
    }

    /**
     * Resolve the counter file path.
     *
     * @return string The absolute counter file path.
     *
     * @throws RuntimeException When the storage directory cannot be created.
     */
    private function counterFile(): string
    {
        if (!is_dir($this->storageDir) && !@mkdir($this->storageDir, 0755, true) && !is_dir($this->storageDir)) {
            throw new RuntimeException(sprintf('Cannot create workload directory "%s".', $this->storageDir));
        }

        return $this->storageDir . DIRECTORY_SEPARATOR . 'active.json';
    }

    /**
     * Open the counter file for reading and writing.
     *
     * @param string $file The counter file path.
     *
     * @return resource|null The open file handle, or null when the file
     *                       cannot be opened.
     */
    private function openFile(string $file)
    {
        $handle = @fopen($file, 'c+');

        return $handle === false ? null : $handle;
    }

    /**
     * Decode a persisted counter record.
     *
     * A missing or corrupt record falls back to an idle counter.
     *
     * @param string $contents The raw file contents.
     *
     * @return array{count: int, expiresAt: int} The decoded record.
     */
    private function decode(string $contents): array
    {
        $decoded = json_decode($contents, true);

        if (
            !is_array($decoded)
            || !is_int($decoded['count'] ?? null)
            || !is_int($decoded['expiresAt'] ?? null)
        ) {
            return ['count' => 0, 'expiresAt' => 0];
        }

        return ['count' => $decoded['count'], 'expiresAt' => $decoded['expiresAt']];
    }

    /**
     * Persist a counter record under the held lock.
     *
     * @param resource                  $handle The open file handle.
     * @param array{count: int, expiresAt: int} $record The record to persist.
     */
    private function persist(mixed $handle, array $record): void
    {
        try {
            $encoded = json_encode($record, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('Cannot encode workload record.', previous: $exception);
        }

        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, $encoded);
        fflush($handle);
    }
}
