<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\AnalysisCache;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the file-backed analysis response cache.
 *
 * Verifies the store/retrieve round trip, cache misses, TTL expiry, schema
 * version scoping, atomic writes (no leftover temporary files), and the
 * graceful handling of corrupt entries.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Deterministic: a fixed clock makes expiry math exact.
 * - Uses a disposable storage directory per test.
 */
final class AnalysisCacheTest extends TestCase
{
    private int $now;

    private string $storageDir;

    protected function setUp(): void
    {
        $this->now = 1_000_000_000;
        $this->storageDir = sys_get_temp_dir() . '/analysis-cache-' . uniqid('', true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->storageDir);
    }

    public function test_round_trips_the_exact_payload(): void
    {
        $cache = $this->cache(ttl: 300);
        $payload = ['website' => ['url' => 'https://example.com'], 'cms' => 'WordPress'];

        $cache->set('https://example.com', $payload);

        self::assertSame($payload, $cache->get('https://example.com'));
    }

    public function test_returns_null_for_unknown_urls(): void
    {
        $cache = $this->cache(ttl: 300);

        self::assertNull($cache->get('https://unknown.example.com'));
    }

    public function test_expires_entries_after_the_ttl(): void
    {
        $cache = $this->cache(ttl: 300);
        $payload = ['cms' => 'WordPress'];

        $cache->set('https://example.com', $payload);
        self::assertNotNull($cache->get('https://example.com'));

        $this->now += 300;

        self::assertNotNull($cache->get('https://example.com'));

        $this->now += 1;

        self::assertNull($cache->get('https://example.com'));
    }

    public function test_schema_version_scopes_entries(): void
    {
        $v1 = new AnalysisCache($this->storageDir, 300, 'v1', fn (): int => $this->now);
        $v2 = new AnalysisCache($this->storageDir, 300, 'v2', fn (): int => $this->now);

        $v1->set('https://example.com', ['schema' => 'v1']);

        self::assertSame(['schema' => 'v1'], $v1->get('https://example.com'));
        self::assertNull($v2->get('https://example.com'));
    }

    public function test_atomic_writes_leave_no_temporary_files(): void
    {
        $cache = $this->cache(ttl: 300);

        $cache->set('https://example.com', ['cms' => 'WordPress']);

        $temporary = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->storageDir, \FilesystemIterator::SKIP_DOTS),
        );

        /** @var \SplFileInfo $file */
        foreach ($iterator as $file) {
            if (str_ends_with($file->getFilename(), '.tmp')) {
                $temporary[] = $file->getFilename();
            }
        }

        self::assertSame([], $temporary);
    }

    public function test_corrupt_entries_are_treated_as_misses(): void
    {
        $cache = $this->cache(ttl: 300);
        $payload = ['cms' => 'WordPress'];

        $cache->set('https://example.com', $payload);

        $hash = hash('sha256', 'v1:https://example.com');
        $entry = $this->storageDir . '/' . substr($hash, 0, 2) . '/' . $hash . '.json';

        file_put_contents($entry, '{not json');

        self::assertNull($cache->get('https://example.com'));
    }

    private function cache(int $ttl): AnalysisCache
    {
        return new AnalysisCache($this->storageDir, $ttl, 'v1', fn (): int => $this->now);
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
