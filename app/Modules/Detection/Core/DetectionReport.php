<?php

declare(strict_types=1);

namespace App\Modules\Detection\Core;

use App\Modules\Detection\DetectionResult;

/**
 * Immutable value object representing the final output of the detection
 * pipeline.
 *
 * Contains only successful detections.  Provides structured read-only
 * access to results, metadata, and convenience accessors for common
 * interrogation patterns.  Follows DDD Value Object principles.
 */
final readonly class DetectionReport
{
    /**
     * @param list<DetectionResult>    $results  Successful detection results.
     * @param array<string, mixed>     $metadata Merged metadata from all successful detectors.
     * @param DetectionResult|null     $primary  The highest-confidence result, or null.
     */
    public function __construct(
        private array $results,
        private array $metadata,
        private ?DetectionResult $primary,
    ) {
    }

    /**
     * @return list<DetectionResult>
     */
    public function results(): array
    {
        return $this->results;
    }

    /**
     * @return array<string, mixed>
     */
    public function metadata(): array
    {
        return $this->metadata;
    }

    /**
     * Return a metadata value when it exists, otherwise the default.
     */
    public function metadataValue(string $key, mixed $default = null): mixed
    {
        return array_key_exists($key, $this->metadata)
            ? $this->metadata[$key]
            : $default;
    }

    public function primary(): ?DetectionResult
    {
        return $this->primary;
    }

    /**
     * Whether at least one detector produced a successful result.
     */
    public function hasDetection(): bool
    {
        return $this->primary !== null;
    }

    /**
     * The technology name of the primary detection, or null.
     */
    public function primaryTechnology(): ?string
    {
        return $this->primary?->technology();
    }

    /**
     * The highest confidence score across all results, or 0.
     */
    public function highestConfidence(): int
    {
        return $this->primary?->confidence() ?? 0;
    }

    /**
     * The number of successful detections.
     */
    public function count(): int
    {
        return count($this->results);
    }

    /**
     * Every detected technology, in report order.
     *
     * @return list<string>
     */
    public function technologies(): array
    {
        return $this->mapResults(
            static fn (DetectionResult $result): string => $result->technology(),
        );
    }

    /**
     * Technology-to-confidence map, in report order.
     *
     * @return array<string, int>
     */
    public function confidenceMap(): array
    {
        $map = [];

        foreach ($this->results as $result) {
            $map[$result->technology()] = $result->confidence();
        }

        return $map;
    }

    /**
     * Return the DetectionResult for a specific technology.
     */
    public function technology(string $technology): ?DetectionResult
    {
        foreach ($this->results as $result) {
            if ($result->technology() === $technology) {
                return $result;
            }
        }

        return null;
    }

    /**
     * Map a callback over every result and return the collected values.
     *
     * @template T
     *
     * @param callable(DetectionResult): T $callback
     *
     * @return list<T>
     */
    private function mapResults(callable $callback): array
    {
        $items = [];

        foreach ($this->results as $result) {
            $items[] = $callback($result);
        }

        return $items;
    }
}
