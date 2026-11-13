<?php

declare(strict_types=1);

namespace App\Logging;

use DateTimeImmutable;
use DateTimeZone;
use JsonException;
use Throwable;

/**
 * JSON Lines logger backed by a single append-only file.
 *
 * Every event is encoded as one JSON object per line. Writes are serialized
 * with an exclusive lock and use restrictive permissions. Logging failures
 * are never propagated to the caller; a sanitized PHP error-log message is
 * emitted instead.
 */
final class FileLogger implements LoggerInterface
{
    private const FILE_MODE = 0600;

    private const DIRECTORY_MODE = 0700;

    public function __construct(
        private readonly string $filePath,
        private readonly LogLevel $minimumLevel = LogLevel::WARNING,
        private readonly bool $enabled = true,
    ) {
    }

    public function log(LogLevel $level, string $event, array $context = []): void
    {
        if (!$this->enabled || $level->priority() < $this->minimumLevel->priority()) {
            return;
        }

        $record = $context;
        $record['timestamp'] = $this->timestamp();
        $record['level'] = $level->value;
        $record['event'] = $event;

        try {
            $line = json_encode(
                $record,
                JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            );
        } catch (JsonException) {
            $this->fallback('JSON encoding failed.');

            return;
        }

        try {
            $this->append($line . PHP_EOL);
        } catch (Throwable) {
            $this->fallback('Log append failed.');
        }
    }

    /**
     * Append a complete line under an exclusive lock.
     */
    private function append(string $line): void
    {
        $directory = dirname($this->filePath);

        if (!is_dir($directory)) {
            if (!@mkdir($directory, self::DIRECTORY_MODE, true) && !is_dir($directory)) {
                $this->fallback('Log directory could not be created.');

                return;
            }
        }

        @chmod($directory, self::DIRECTORY_MODE);

        $handle = @fopen($this->filePath, 'c+b');

        if ($handle === false) {
            $this->fallback('Log file could not be opened.');

            return;
        }

        @chmod($this->filePath, self::FILE_MODE);

        if (!@flock($handle, LOCK_EX)) {
            @fclose($handle);
            $this->fallback('Log file lock could not be acquired.');

            return;
        }

        if (@fseek($handle, 0, SEEK_END) !== 0) {
            @flock($handle, LOCK_UN);
            @fclose($handle);
            $this->fallback('Log file could not be positioned.');

            return;
        }

        $offset = @ftell($handle);

        if ($offset === false || $offset < 0) {
            @flock($handle, LOCK_UN);
            @fclose($handle);
            $this->fallback('Log file position could not be read.');

            return;
        }

        $written = @fwrite($handle, $line);

        if ($written !== strlen($line)) {
            @ftruncate($handle, $offset);
        }

        @fflush($handle);
        @flock($handle, LOCK_UN);
        @fclose($handle);

        if ($written !== strlen($line)) {
            $this->fallback('Log line could not be written completely.');
        }
    }

    /**
     * Return the current UTC timestamp in RFC3339 form with microseconds.
     */
    private function timestamp(): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->format('Y-m-d\TH:i:s.u\Z');
    }

    /**
     * Emit a sanitized operational message without any event context.
     */
    private function fallback(string $reason): void
    {
        try {
            @error_log('ThemeDetectorTool security logging failure: ' . $reason);
        } catch (Throwable) {
        }
    }
}
