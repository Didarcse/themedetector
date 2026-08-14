<?php

declare(strict_types=1);

namespace App\Api;

use JsonException;
use RuntimeException;

/**
 * Dependency-free file-backed cache for serialized API responses.
 *
 * AnalysisCache persists the serialized API response data for a normalized
 * target URL so repeated detections of the same website are served from
 * disk instead of re-fetching and re-analysing the target. Cache keys are
 * sha256 hashes of the schema version plus the normalized URL, so no
 * user-controlled value ever reaches the filesystem path and traversal is
 * impossible. Writes go to a unique temporary file that is atomically
 * renamed into place.
 *
 * Responsibilities:
 *
 * - Store and retrieve serialized API response data by normalized URL.
 * - Scope keys by the API schema version.
 * - Expire entries after a configurable TTL.
 * - Write entries atomically.
 *
 * Design philosophy:
 *
 * - API endpoint only: the existing /detect page never uses this cache.
 * - Cache the serialized response, never internal pipeline state.
 * - Best effort: a failed write or read degrades to a cache miss and the
 *   analysis proceeds normally.
 * - Single-instance: entries live on the local filesystem.
 *
 * @see docs/api.md for the single-instance deployment limitation.
 */
final class AnalysisCache
{
    private string $storageDir;
    private int $ttlSeconds;
    private string $schemaVersion;

    /** @var \Closure(): int */
    private \Closure $clock;

    /**
     * Create an analysis cache.
     *
     * @param string         $storageDir    The directory holding cache
     *                                      entries.
     * @param int            $ttlSeconds    How long entries stay valid.
     * @param string         $schemaVersion The API schema version baked
     *                                      into every cache key.
     * @param \Closure():int $clock         The clock used for expiry math,
     *                                      injectable for deterministic
     *                                      tests.
     */
    public function __construct(
        string $storageDir,
        int $ttlSeconds,
        string $schemaVersion = 'v1',
        ?\Closure $clock = null,
    ) {
        if ($ttlSeconds < 1) {
            throw new \InvalidArgumentException('Cache TTL must be at least 1 second.');
        }

        $this->storageDir = rtrim($storageDir, '/\\');
        $this->ttlSeconds = $ttlSeconds;
        $this->schemaVersion = $schemaVersion;
        $this->clock = $clock ?? static fn (): int => time();
    }

    /**
     * Retrieve the cached response data for a normalized URL.
     *
     * An expired entry is removed and reported as a miss.
     *
     * @param string $url The normalized URL.
     *
     * @return array<mixed>|null The cached response data, or null on miss.
     */
    public function get(string $url): ?array
    {
        $file = $this->entryFile($url);

        if (!is_file($file)) {
            return null;
        }

        $raw = @file_get_contents($file);

        if ($raw === false) {
            return null;
        }

        $entry = json_decode($raw, true);

        if (!is_array($entry) || !is_array($entry['payload'] ?? null)) {
            return null;
        }

        if (($entry['expiresAt'] ?? 0) < ($this->clock)()) {
            @unlink($file);

            return null;
        }

        /** @var array<mixed> */
        return $entry['payload'];
    }

    /**
     * Store serialized response data for a normalized URL.
     *
     * The entry is written to a unique temporary file and atomically
     * renamed into place, so a concurrent reader never observes a partial
     * write. Failures degrade silently to a miss.
     *
     * @param string        $url     The normalized URL.
     * @param array<mixed>  $payload The serialized response data.
     */
    public function set(string $url, array $payload): void
    {
        $file = $this->entryFile($url);
        $dir = dirname($file);

        if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new RuntimeException(sprintf('Cannot create cache directory "%s".', $dir));
        }

        try {
            $encoded = json_encode([
                'expiresAt' => ($this->clock)() + $this->ttlSeconds,
                'payload' => $payload,
            ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        } catch (JsonException $exception) {
            throw new RuntimeException('Cannot encode cache entry.', previous: $exception);
        }

        $temp = $file . '.' . bin2hex(random_bytes(8)) . '.tmp';

        if (@file_put_contents($temp, $encoded) === false) {
            return;
        }

        @rename($temp, $file);
    }

    /**
     * Resolve the entry file path for a normalized URL.
     *
     * @param string $url The normalized URL.
     *
     * @return string The absolute entry file path.
     */
    private function entryFile(string $url): string
    {
        $hash = hash('sha256', $this->schemaVersion . ':' . $url);

        return $this->storageDir
            . DIRECTORY_SEPARATOR . substr($hash, 0, 2)
            . DIRECTORY_SEPARATOR . $hash . '.json';
    }
}
