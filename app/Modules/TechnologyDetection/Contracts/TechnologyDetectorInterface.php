<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Contracts;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;

/**
 * Contract for every Technology Detector implementation.
 *
 * A Technology Detector determines whether it supports the supplied detection
 * context and, if so, produces a normalized technology detection result. Every
 * detector returns the same normalized TechnologyDetectionResult shape
 * regardless of the underlying technology.
 *
 * Responsibilities:
 *
 * - Determine whether the detector supports the given detection context.
 * - Produce a normalized technology detection result.
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
 * - Single Responsibility Principle: detectors perform technology detection
 *   only. They never perform HTTP requests, never parse responses, and
 *   never apply detection rules.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Every future technology detector — PHP, Laravel, React, Vue, Angular,
 *   Bootstrap, Tailwind, jQuery, Cloudflare, Nginx, and future platforms —
 *   must implement this contract and produce a TechnologyDetectionResult.
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
     * Detect a technology from the given detection context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. Detectors translate that data into technology
     * information and perform no additional HTTP requests of their own.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return TechnologyDetectionResult The normalized technology detection
     *                                   result.
     */
    public function detect(DetectionContext $context): TechnologyDetectionResult;
}
