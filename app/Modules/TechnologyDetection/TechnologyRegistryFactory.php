<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Core\Container;

/**
 * Assembles the production-ready TechnologyRegistry for the Technology
 * Detection Engine.
 *
 * TechnologyRegistryFactory wires every supported technology detector into
 * a single TechnologyRegistry. It is the composition point for introducing
 * technology detectors without coupling the registry to a concrete
 * technology.
 *
 * Responsibilities:
 *
 * - Build every supported technology detector with its pipeline.
 * - Register the detectors on a new TechnologyRegistry.
 * - Return the fully populated TechnologyRegistry.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Composition Root: technology detector wiring happens exclusively here.
 * - Single Responsibility Principle: assembling the registry is the only
 *   concern; it performs no detection.
 * - Open/Closed Principle: new detectors are added here without modifying
 *   the registry or the manager.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class TechnologyRegistryFactory
{
    /**
     * Build the fully populated TechnologyRegistry.
     *
     * No technology detectors are shipped yet: the detection rules for the
     * first technology categories are introduced in a dedicated step.
     * Until then the registry is empty, and the
     * TechnologyDetectionManager reports the missing composition point by
     * throwing a RuntimeException when consulted.
     *
     * @param Container $container The application dependency injection
     *                             container (kept for signature symmetry
     *                             with the other registry factories).
     *
     * @return TechnologyRegistry The registry containing every supported
     *                            technology detector.
     */
    public function create(Container $container): TechnologyRegistry
    {
        return new TechnologyRegistry();
    }
}
