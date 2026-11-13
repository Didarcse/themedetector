<?php

declare(strict_types=1);

namespace App\Logging;

use InvalidArgumentException;

/**
 * Supported application log levels.
 *
 * Levels are ordered by increasing severity so the logger can apply a
 * configured minimum threshold without maintaining a separate ranking table.
 */
enum LogLevel: string
{
    case DEBUG = 'debug';
    case INFO = 'info';
    case NOTICE = 'notice';
    case WARNING = 'warning';
    case ERROR = 'error';
    case CRITICAL = 'critical';

    /**
     * Return the numeric severity priority for this level.
     *
     * @return int The priority, higher values are more severe.
     */
    public function priority(): int
    {
        return match ($this) {
            self::DEBUG => 100,
            self::INFO => 200,
            self::NOTICE => 250,
            self::WARNING => 300,
            self::ERROR => 400,
            self::CRITICAL => 500,
        };
    }

    /**
     * Parse a case-insensitive level name.
     *
     * @param string $name The configured level name.
     *
     * @return self The matching level.
     *
     * @throws InvalidArgumentException When the name is not a supported level.
     */
    public static function fromName(string $name): self
    {
        $level = self::tryFrom(strtolower(trim($name)));

        if ($level === null) {
            throw new InvalidArgumentException(sprintf('Unsupported log level "%s".', $name));
        }

        return $level;
    }
}
