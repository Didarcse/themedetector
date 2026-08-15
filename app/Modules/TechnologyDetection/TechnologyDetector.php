<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\Detection\DetectionContext;

/**
 * Public entry point for the Technology Detection Engine.
 *
 * TechnologyDetector coordinates the complete technology detection
 * workflow: it delegates detection to the TechnologyDetectionManager and
 * returns the resulting list of TechnologyDetectionResult instances.
 *
 * TechnologyDetector is the only class external consumers should interact
 * with for technology detection.
 *
 * Responsibilities:
 *
 * - Delegate detection to the TechnologyDetectionManager.
 * - Return the resulting list of TechnologyDetectionResult instances.
 *
 * Design philosophy:
 *
 * - Facade: it is the single public entry point for the Technology
 *   Detection Engine.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Dependency Injection: collaborators are provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   business logic, no technology detection, and no HTTP requests.
 * - Open/Closed Principle: new detectors are added without modifying this
 *   class.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class TechnologyDetector
{
    /**
     * Create a new TechnologyDetector.
     *
     * @param TechnologyDetectionManager $manager The
     *                                            TechnologyDetectionManager
     *                                            that performs technology
     *                                            detection.
     */
    public function __construct(
        private TechnologyDetectionManager $manager,
    ) {
    }

    /**
     * Detect the technologies of the website represented by the given
     * context.
     *
     * Delegates detection to the TechnologyDetectionManager and returns
     * the resulting list of TechnologyDetectionResult instances. The
     * returned list is never modified, and the given DetectionContext is
     * never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return list<TechnologyDetectionResult> The technology detection
     *                                         results.
     */
    public function detect(DetectionContext $context): array
    {
        return $this->manager->detect($context);
    }
}
