<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Provides a central registry for every CMS detector supported by the
 * Detection Engine.
 *
 * The registry is responsible only for registering and exposing detector
 * instances. It performs no detection, no orchestration, no confidence
 * calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Store detector instances in the exact order they were provided.
 * - Expose every registered detector via the all() accessor.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the registry has no business logic,
 *   no detection logic, no HTML parsing, no HTTP, no confidence
 *   calculation, and no metadata manipulation.
 * - Detectors are never reordered, filtered, or transformed. The all()
 *   accessor returns exactly what was supplied.
 * - The registry is stateless after construction, deterministic, and
 *   side-effect free.
 */
final readonly class DetectorRegistry
{
    /**
     * @var list<DetectorInterface>
     */
    private readonly array $detectors;

    /**
     * @param iterable<DetectorInterface> $detectors The detectors to register.
     */
    public function __construct(
        iterable $detectors,
    ) {
        $this->detectors = $this->materialize($detectors);
    }

    /**
     * Return every registered detector.
     *
     * Detectors are returned exactly as provided: no reordering, no
     * filtering, and no transformation.
     *
     * @return iterable<DetectorInterface>
     */
    public function all(): iterable
    {
        return $this->detectors;
    }

    /**
     * Return the number of registered detectors.
     *
     * @return int The number of registered detectors.
     */
    public function count(): int
    {
        return count($this->detectors);
    }

    /**
     * Convert an iterable to a list, preserving insertion order.
     *
     * @param iterable<DetectorInterface> $iterable The iterable to materialize.
     *
     * @return list<DetectorInterface> The materialized detectors.
     */
    private function materialize(iterable $iterable): array
    {
        $result = [];

        foreach ($iterable as $item) {
            $result[] = $item;
        }

        return $result;
    }
}
