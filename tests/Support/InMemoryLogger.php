<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Logging\LoggerInterface;
use App\Logging\LogLevel;

/**
 * Logger test double that captures every event for assertions.
 */
final class InMemoryLogger implements LoggerInterface
{
    /** @var list<array{level: LogLevel, event: string, context: array<string, mixed>}> */
    private array $records = [];

    public function log(LogLevel $level, string $event, array $context = []): void
    {
        $this->records[] = [
            'level' => $level,
            'event' => $event,
            'context' => $context,
        ];
    }

    /**
     * @return list<array{level: LogLevel, event: string, context: array<string, mixed>}>
     */
    public function records(): array
    {
        return $this->records;
    }

    /**
     * @return list<string>
     */
    public function events(): array
    {
        return array_map(
            static fn (array $record): string => $record['event'],
            $this->records,
        );
    }

    /**
     * @return list<array{level: LogLevel, event: string, context: array<string, mixed>}>
     */
    public function recordsFor(string $event): array
    {
        return array_values(array_filter(
            $this->records,
            static fn (array $record): bool => $record['event'] === $event,
        ));
    }

    public function clear(): void
    {
        $this->records = [];
    }
}
