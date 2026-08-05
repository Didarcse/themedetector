<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection;

use App\Modules\Detection\DetectionContext;

/**
 * Coordinates the complete plugin detection workflow.
 *
 * The PluginDetectionManager is the orchestration layer of the Plugin
 * Detection Engine. It iterates the detectors registered in the
 * PluginRegistry, delegates detection to the first detector that supports
 * the supplied context, and returns the resulting PluginDetectionResult.
 *
 * Responsibilities:
 *
 * - Obtain every registered detector from the PluginRegistry.
 * - Iterate through the detectors in registration order.
 * - Invoke supports() on each detector.
 * - Delegate detection to the first detector that supports the supplied
 *   DetectionContext.
 * - Return the resulting PluginDetectionResult.
 *
 * Design philosophy:
 *
 * - Orchestrator Pattern: the manager coordinates the registered
 *   detectors and never performs detection itself.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no parsing, no
 *   confidence calculation, and no platform-specific logic.
 * - Dependency Injection: the manager depends on the PluginRegistry and
 *   receives it through the constructor.
 * - Open/Closed Principle: it works exclusively with
 *   PluginDetectorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Browser Extensions, CMS Modules,
 *   etc.), so new detectors can be added without modifying the manager.
 * - Detectors are never reordered and never executed more than once. The
 *   first detector in registration order that supports the context is
 *   the only one executed.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 *
 * Future Compatibility:
 *
 * - Future plugin detector implementations are discovered only through
 *   the PluginRegistry and are consumed by this manager without
 *   modification.
 */
final readonly class PluginDetectionManager
{
    /**
     * @param PluginRegistry $registry The registry of registered plugin
     *                                 detectors.
     */
    public function __construct(
        private PluginRegistry $registry,
    ) {
    }

    /**
     * Detect a plugin from the given detection context.
     *
     * Detectors are consulted in registration order. The first detector
     * that supports the context is delegated to and its result is
     * returned. When no detector supports the context, a deterministic
     * failed result (detected = false, plugin = null, confidence = 0) is
     * returned. The given DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return PluginDetectionResult The normalized plugin detection result.
     */
    public function detect(DetectionContext $context): PluginDetectionResult
    {
        foreach ($this->registry->all() as $detector) {
            if ($detector->supports($context)) {
                return $detector->detect($context);
            }
        }

        return new PluginDetectionResult(
            detected: false,
            plugin: null,
            confidence: 0,
        );
    }
}
