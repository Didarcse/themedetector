<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Contracts;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;

/**
 * Contract for every Technology Detector implementation.
 *
 * A Technology Detector determines whether it supports the supplied
 * detection context and, if so, produces a normalized list of technology
 * detection results. Every detector returns the same normalized
 * TechnologyDetectionResult shape regardless of the underlying platform,
 * and a single detector may report several technologies (for example a
 * page that runs multiple JavaScript libraries at once).
 *
 * Responsibilities:
 *
 * - Determine whether the detector supports the given detection context.
 * - Produce a normalized list of technology detection results.
 *
 * Design philosophy:
 *
 * - Interface Segregation Principle: the contract exposes only the
 *   operations a technology detector needs.
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete detector.
 * - Dependency Injection and Open/Closed Principle: new detectors are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: detectors perform technology
 *   detection only. They never perform HTTP requests, never parse
 *   responses, and never apply detection rules.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Every future technology detector — JavaScript libraries, analytics
 *   platforms, CDNs, and future technology categories — must implement
 *   this contract and produce a list of TechnologyDetectionResult
 *   instances.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */
interface TechnologyDetectorInterface
{
    /**
     * Determine whether the detector supports the given detection context.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True when the detector supports the supplied context.
     */
    public function supports(DetectionContext $context): bool;

    /**
     * Detect technologies from the given detection context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. Detectors translate that data into technology
     * information and perform no additional HTTP requests of their own.
     * The returned list contains every technology this detector identified,
     * in a deterministic order, and is empty when the detector identified
     * no technology.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return list<TechnologyDetectionResult> The normalized technology
     *                                          detection results.
     */
    public function detect(DetectionContext $context): array;
}
