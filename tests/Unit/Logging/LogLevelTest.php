<?php

declare(strict_types=1);

namespace Tests\Unit\Logging;

use App\Logging\LogLevel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class LogLevelTest extends TestCase
{
    public function test_names_are_parsed_case_insensitively_and_trimmed(): void
    {
        self::assertSame(LogLevel::WARNING, LogLevel::fromName(' Warning '));
        self::assertSame(LogLevel::ERROR, LogLevel::fromName('ERROR'));
    }

    public function test_invalid_names_are_rejected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        LogLevel::fromName('verbose');
    }

    public function test_severity_priorities_are_ordered(): void
    {
        self::assertLessThan(LogLevel::INFO->priority(), LogLevel::DEBUG->priority());
        self::assertLessThan(LogLevel::WARNING->priority(), LogLevel::INFO->priority());
        self::assertLessThan(LogLevel::ERROR->priority(), LogLevel::WARNING->priority());
        self::assertLessThan(LogLevel::CRITICAL->priority(), LogLevel::ERROR->priority());
    }
}
