<?php

declare(strict_types=1);

namespace App\Logging;

/**
 * Logger implementation that discards every event.
 *
 * Used as the safe default in contexts where logging is disabled or not
 * explicitly configured.
 */
final class NullLogger implements LoggerInterface
{
    public function log(LogLevel $level, string $event, array $context = []): void
    {
    }
}
