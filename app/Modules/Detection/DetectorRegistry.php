<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Stores and exposes all registered technology detectors.
 *
 * Preserves insertion order and provides access to every detector
 * registered with the system.
 */
final class DetectorRegistry
{
    /**
     * @var list<DetectorInterface>
     */
    private readonly array $detectors;

    /**
     * @param iterable<DetectorInterface> $detectors
     */
    public function __construct(
        iterable $detectors,
    ) {
        $this->detectors = $this->materialize($detectors);
    }

    /**
     * Returns every registered detector.
     *
     * @return iterable<DetectorInterface>
     */
    public function all(): iterable
    {
        return $this->detectors;
    }

    /**
     * Returns the number of registered detectors.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->detectors);
    }

    /**
     * Convert an iterable to a list, preserving order.
     *
     * @param iterable<DetectorInterface> $iterable
     *
     * @return list<DetectorInterface>
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
