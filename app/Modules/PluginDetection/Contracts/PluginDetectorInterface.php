<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\Contracts;

use App\Modules\Detection\DetectionContext;
use App\Modules\PluginDetection\PluginDetectionResult;

/**
 * Contract for every Plugin Detector implementation.
 *
 * A Plugin Detector determines whether it supports the supplied detection
 * context and, if so, produces a normalized plugin detection result. Every
 * detector returns the same normalized PluginDetectionResult shape
 * regardless of the underlying platform.
 *
 * Responsibilities:
 *
 * - Determine whether the detector supports the given detection context.
 * - Produce a normalized plugin detection result.
 *
 * Design philosophy:
 *
 * - Interface Segregation Principle: the contract exposes only the
 *   operations a plugin detector needs.
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete detector.
 * - Dependency Injection and Open/Closed Principle: new detectors are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: detectors perform plugin detection
 *   only. They never perform HTTP requests, never parse responses, and
 *   never apply detection rules.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Every future plugin detector — WordPress Plugins, Shopify Apps, Ghost
 *   Integrations, Browser Extensions, CMS Modules, and future platforms —
 *   must implement this contract and produce a PluginDetectionResult.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */
interface PluginDetectorInterface
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
     * Detect a plugin from the given detection context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. Detectors translate that data into plugin
     * information and perform no additional HTTP requests of their own.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return PluginDetectionResult The normalized plugin detection result.
     */
    public function detect(DetectionContext $context): PluginDetectionResult;
}
