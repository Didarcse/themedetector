<?php

declare(strict_types=1);

namespace Tests\Unit\Logging;

use App\Logging\FileLogger;
use App\Logging\LogLevel;
use PHPUnit\Framework\TestCase;

final class FileLoggerTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        $this->directory = sys_get_temp_dir() . '/td-file-logger-' . uniqid('', true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->directory);
    }

    public function test_writes_one_valid_json_object_per_line_with_utc_timestamp(): void
    {
        $logger = new FileLogger($this->path(), LogLevel::DEBUG);

        $logger->log(LogLevel::INFO, 'test.info', ['status' => 200]);
        $logger->log(LogLevel::ERROR, 'test.error', ['reason' => 'failure']);

        $lines = file($this->path(), FILE_IGNORE_NEW_LINES);

        self::assertIsArray($lines);
        self::assertCount(2, $lines);

        $first = $this->decode($lines[0]);
        $second = $this->decode($lines[1]);

        self::assertSame('info', $first['level']);
        self::assertSame('test.info', $first['event']);
        self::assertSame(200, $first['status']);
        self::assertSame('error', $second['level']);
        self::assertSame('test.error', $second['event']);
        self::assertSame('failure', $second['reason']);

        foreach ([$first, $second] as $record) {
            self::assertIsString($record['timestamp']);
            self::assertMatchesRegularExpression(
                '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{6}Z$/',
                $record['timestamp'],
            );
        }
    }

    public function test_minimum_level_filters_lower_severity_events(): void
    {
        $logger = new FileLogger($this->path(), LogLevel::WARNING);

        $logger->log(LogLevel::INFO, 'test.info');
        $logger->log(LogLevel::WARNING, 'test.warning');

        $lines = file($this->path(), FILE_IGNORE_NEW_LINES);

        self::assertIsArray($lines);
        self::assertCount(1, $lines);
        self::assertSame('test.warning', $this->decode($lines[0])['event']);
    }

    public function test_disabled_logger_writes_nothing(): void
    {
        $logger = new FileLogger($this->path(), LogLevel::DEBUG, false);

        $logger->log(LogLevel::ERROR, 'test.error');

        self::assertFileDoesNotExist($this->path());
    }

    public function test_write_failures_are_suppressed_and_use_the_fallback(): void
    {
        $errorLog = tempnam(sys_get_temp_dir(), 'td-file-logger-error-');
        self::assertIsString($errorLog);

        $previous = ini_get('error_log');
        ini_set('error_log', $errorLog);

        try {
            self::assertTrue(mkdir($this->directory . '/logs/app.jsonl', 0700, true));

            (new FileLogger($this->path(), LogLevel::DEBUG))->log(LogLevel::ERROR, 'test.error');
        } finally {
            ini_set('error_log', is_string($previous) ? $previous : '');
        }

        self::assertDirectoryExists($this->directory . '/logs/app.jsonl');

        $contents = file_get_contents($errorLog);

        self::assertIsString($contents);
        self::assertStringContainsString('ThemeDetectorTool security logging failure', $contents);

        @unlink($errorLog);
    }

    public function test_creates_missing_directory_and_appends_across_instances(): void
    {
        (new FileLogger($this->path(), LogLevel::DEBUG))->log(LogLevel::INFO, 'first');
        (new FileLogger($this->path(), LogLevel::DEBUG))->log(LogLevel::INFO, 'second');

        $lines = file($this->path(), FILE_IGNORE_NEW_LINES);

        self::assertIsArray($lines);
        self::assertCount(2, $lines);
        self::assertSame('first', $this->decode($lines[0])['event']);
        self::assertSame('second', $this->decode($lines[1])['event']);
    }

    /**
     * @return array<string, mixed>
     */
    private function decode(string $line): array
    {
        $record = json_decode($line, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($record);

        $normalized = [];

        foreach ($record as $key => $value) {
            if (!is_string($key)) {
                self::fail('Log records must use string field names.');
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }

    private function path(): string
    {
        return $this->directory . '/logs/app.jsonl';
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
