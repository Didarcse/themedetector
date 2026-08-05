<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\Detection\DetectionContext;

/**
 * Coordinates the complete technology detection workflow.
 *
 * The TechnologyDetectionManager is the orchestration layer of the Technology
 * Detection Engine. It iterates the detectors registered in the
 * TechnologyRegistry, delegates detection to the first detector that supports
 * the supplied context, and returns the resulting TechnologyDetectionResult.
 *
 * Responsibilities:
 *
 * - Obtain every registered detector from the TechnologyRegistry.
 * - Iterate through the detectors in registration order.
 * - Invoke supports() on each detector.
 * - Delegate detection to the first detector that supports the supplied
 *   DetectionContext.
 * - Return the resulting TechnologyDetectionResult.
 *
 * Design philosophy:
 *
 * - Orchestrator Pattern: the manager coordinates the registered
 *   detectors and never performs detection itself.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no parsing, no
 *   confidence calculation, and no technology-specific logic.
 * - Dependency Injection: the manager depends on the TechnologyRegistry and
 *   receives it through the constructor.
 * - Open/Closed Principle: it works exclusively with
 *   TechnologyDetectorInterface and has no knowledge of any concrete
 *   technology (PHP, Laravel, React, Vue, Angular, Bootstrap, Tailwind,
 *   jQuery, Cloudflare, Nginx, etc.), so new detectors can be added
 *   without modifying the manager.
 * - Detectors are never reordered and never executed more than once. The
 *   first detector in registration order that supports the context is
 *   the only one executed.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 *
 * Future Compatibility:
 *
 * - Future technology detector implementations are discovered only through
 *   the TechnologyRegistry and are consumed by this manager without
 *   modification.
 */
final readonly class TechnologyDetectionManager
{
    /**
     * @param TechnologyRegistry $registry The registry of registered
     *                                     technology detectors.
     */
    public function __construct(
        private TechnologyRegistry $registry,
    ) {
    }

    /**
     * Detect a technology from the given detection context.
     *
     * Detectors are consulted in registration order. The first detector
     * that supports the context is delegated to and its result is
     * returned. When no detector supports the context, a deterministic
     * failed result (detected = false, technology = null, confidence = 0) is
     * returned. The given DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return TechnologyDetectionResult The normalized technology detection
     *                                   result.
     */
    public function detect(DetectionContext $context): TechnologyDetectionResult
    {
        foreach ($this->registry->all() as $detector) {
            if ($detector->supports($context)) {
                return $detector->detect($context);
            }
        }

        return new TechnologyDetectionResult(
            detected: false,
            technology: null,
            confidence: 0,
        );
    }
}
