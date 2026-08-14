<?php

declare(strict_types=1);

namespace App\Api;

use InvalidArgumentException;
use JsonException;
use RuntimeException;

/**
 * Dependency-free fixed-window rate limiter backed by atomic file locks.
 *
 * RateLimiter implements a fixed-window counter per identifier (IP address
 * or API key). Each counter is persisted to its own file and updated under
 * an exclusive flock so concurrent requests cannot race into a lost update.
 * Identifiers are hashed before they touch the filesystem so sensitive
 * values such as raw API keys never appear in file names or contents.
 *
 * Responsibilities:
 *
 * - Count requests per identifier within a fixed time window.
 * - Allow or deny requests against a configurable limit.
 * - Persist counters safely under exclusive file locking.
 * - Hash identifiers before filesystem use.
 *
 * Design philosophy:
 *
 * - Dependency-free: PHP core file I/O only; no Composer dependencies.
 * - Race-safe: every read-modify-write happens under an exclusive lock.
 * - Single-instance: counters live on the local filesystem, so the limiter
 *   is only accurate for a single application instance.
 * - Stateless apart from the persistent counter files.
 *
 * @see docs/api.md for the single-instance deployment limitation.
 */
final class RateLimiter
{
    private string $storageDir;
    private int $limit;
    private int $windowSeconds;
    private string $namespace;

    /** @var \Closure(): int */
    private \Closure $clock;

    /**
     * Create a rate limiter.
     *
     * @param string         $storageDir    The directory holding counter
     *                                      files.
     * @param int            $limit         The maximum requests per window.
     * @param int            $windowSeconds The length of the window in
     *                                      seconds.
     * @param string         $namespace     A namespace prefix isolating this
     *                                      limiter from other limiters.
     * @param \Closure():int $clock         The clock used for window math,
     *                                      injectable for deterministic
     *                                      tests.
     */
    public function __construct(
        string $storageDir,
        int $limit,
        int $windowSeconds,
        string $namespace = 'default',
        ?\Closure $clock = null,
    ) {
        if ($limit < 1) {
            throw new InvalidArgumentException('Rate limit must be at least 1.');
        }

        if ($windowSeconds < 1) {
            throw new InvalidArgumentException('Rate limit window must be at least 1 second.');
        }

        $this->storageDir = rtrim($storageDir, '/\\');
        $this->limit = $limit;
        $this->windowSeconds = $windowSeconds;
        $this->namespace = $namespace;
        $this->clock = $clock ?? static fn (): int => time();
    }

    /**
     * Consume one request against the given identifier.
     *
     * The counter file for the identifier is read, incremented, and written
     * back entirely under an exclusive lock. A window change resets the
     * counter, so every window starts from zero.
     *
     * @param string $identifier The identifier to rate limit, hashed before
     *                           it is used on the filesystem.
     *
     * @return RateLimitResult The outcome of the consumption.
     *
     * @throws RuntimeException When the counter file cannot be opened.
     */
    public function consume(string $identifier): RateLimitResult
    {
        $now = ($this->clock)();
        $window = intdiv($now, $this->windowSeconds);
        $hash = hash('sha256', $this->namespace . ':' . $identifier);
        $file = $this->counterFile($hash);

        $handle = $this->openFile($file);

        try {
            flock($handle, LOCK_EX);

            $record = $this->decode(stream_get_contents($handle) ?: '');

            if ($record['window'] !== $window) {
                $record = ['window' => $window, 'count' => 0];
            }

            $count = $record['count'] + 1;
            $allowed = $count <= $this->limit;

            $this->persist($handle, ['window' => $window, 'count' => $count]);

            flock($handle, LOCK_UN);
        } finally {
            fclose($handle);
        }

        $retryAfter = $allowed
            ? 0
            : (($window + 1) * $this->windowSeconds) - $now;

        return new RateLimitResult(
            allowed: $allowed,
            limit: $this->limit,
            remaining: max(0, $this->limit - $count),
            retryAfterSeconds: max(1, $retryAfter),
        );
    }

    /**
     * Resolve the counter file path for a hashed identifier.
     *
     * @param string $hash The sha256 hash of the identifier.
     *
     * @return string The absolute counter file path.
     */
    private function counterFile(string $hash): string
    {
        $subDir = $this->storageDir . DIRECTORY_SEPARATOR . substr($hash, 0, 2);

        if (!is_dir($subDir) && !@mkdir($subDir, 0755, true) && !is_dir($subDir)) {
            throw new RuntimeException(sprintf('Cannot create rate limit directory "%s".', $subDir));
        }

        return $subDir . DIRECTORY_SEPARATOR . $hash . '.json';
    }

    /**
     * Open a counter file for reading and writing.
     *
     * The file is opened in c+ mode so it is created when missing without
     * truncating existing contents before the lock is acquired.
     *
     * @param string $file The counter file path.
     *
     * @return resource The open file handle.
     *
     * @throws RuntimeException When the file cannot be opened.
     */
    private function openFile(string $file)
    {
        $handle = @fopen($file, 'c+');

        if ($handle === false) {
            throw new RuntimeException(sprintf('Cannot open rate limit file "%s".', $file));
        }

        return $handle;
    }

    /**
     * Decode a persisted counter record.
     *
     * An empty or corrupt file falls back to a fresh zero-count record for
     * the current window.
     *
     * @param string $contents The raw file contents.
     *
     * @return array{window: int, count: int} The decoded record.
     */
    private function decode(string $contents): array
    {
        $decoded = json_decode($contents, true);

        if (!is_array($decoded) || !is_int($decoded['window'] ?? null) || !is_int($decoded['count'] ?? null)) {
            return ['window' => -1, 'count' => 0];
        }

        return ['window' => $decoded['window'], 'count' => $decoded['count']];
    }

    /**
     * Persist a counter record under the held lock.
     *
     * The file is truncated and rewritten in place so the record written
     * always reflects the state observed under the lock.
     *
     * @param resource                  $handle The open file handle.
     * @param array{window: int, count: int} $record The record to persist.
     */
    private function persist(mixed $handle, array $record): void
    {
        try {
            $encoded = json_encode($record, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('Cannot encode rate limit record.', previous: $exception);
        }

        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, $encoded);
        fflush($handle);
    }
}
