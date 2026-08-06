<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\TechnologyDetection\Contracts\TechnologyDetectorInterface;

/**
 * Provides a central registry for every Technology Detector supported by
 * the Technology Detection Engine.
 *
 * The registry is the composition point for technology detector
 * implementations. It is responsible only for registering and exposing
 * detector instances. It performs no detection, no orchestration, no
 * confidence calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Register TechnologyDetectorInterface implementations.
 * - Return all registered detectors.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Registry Pattern: the registry owns the technology detector collection
 *   and nothing more.
 * - Single Responsibility Principle: the registry has no business logic,
 *   no detection logic, no parsing, and no HTTP.
 * - Open/Closed Principle: it works exclusively with
 *   TechnologyDetectorInterface and has no knowledge of any concrete
 *   technology (JavaScript libraries, analytics platforms, CDNs, etc.), so
 *   new detectors can be registered without modifying the registry.
 * - Detectors are never reordered, filtered, deduplicated, or transformed.
 *   The all() accessor returns exactly what was registered, in the order
 *   it was registered.
 * - The registry is deterministic and side-effect free, holding no state
 *   other than the detector collection itself.
 *
 * Future Compatibility:
 *
 * - Every future technology detector implementation — JavaScript
 *   libraries, analytics platforms, CDNs, and future technology
 *   categories — is registered through this registry.
 */
final class TechnologyRegistry
{
    /**
     * @var list<TechnologyDetectorInterface>
     */
    private array $detectors = [];

    /**
     * Register a technology detector implementation.
     *
     * The detector is appended to the registry in the exact order it is
     * registered.
     *
     * @param TechnologyDetectorInterface $detector The detector to register.
     */
    public function register(TechnologyDetectorInterface $detector): void
    {
        $this->detectors[] = $detector;
    }

    /**
     * Return every registered technology detector.
     *
     * Detectors are returned exactly as registered: no reordering, no
     * filtering, and no transformation.
     *
     * @return list<TechnologyDetectorInterface> The registered detectors.
     */
    public function all(): array
    {
        return $this->detectors;
    }
}
