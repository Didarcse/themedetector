<?php

declare(strict_types=1);

namespace App\Logging;

/**
 * Minimal application logging contract.
 *
 * Implementations receive already-redacted structured context. They must
 * never throw into the request path; logging failures are non-fatal.
 */
interface LoggerInterface
{
    /**
     * Write a single structured event.
     *
     * @param LogLevel              $level   The event severity.
     * @param string                $event   The stable event name.
     * @param array<string, mixed>  $context Safe, redacted event metadata.
     *
     * @return void
     */
    public function log(LogLevel $level, string $event, array $context = []): void;
}
