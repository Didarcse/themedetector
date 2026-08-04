<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use RuntimeException;

/**
 * Coordinates every registered detector and returns the best detection
 * result.
 *
 * The DetectionManager is the orchestration layer of the Detection
 * Engine. It executes every detector registered in the DetectorRegistry,
 * compares their confidence scores, and returns the DetectionResult with
 * the highest confidence.
 *
 * Responsibilities:
 *
 * - Execute every registered detector in the order it was provided.
 * - Compare detector results and select the highest-confidence outcome.
 * - Throw a RuntimeException when no detector has been registered.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no HTML parsing, no
 *   confidence calculation, and no metadata merging.
 * - Open/Closed Principle: it works exclusively with DetectorInterface
 *   and has no knowledge of any concrete technology (WordPress, Joomla,
 *   Drupal, Ghost, TYPO3, etc.), so new detectors can be added without
 *   modifying the manager.
 * - Detectors are never reordered and never executed more than once. On
 *   equal confidence, the first detector in registration order wins.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 */
readonly class DetectionManager
{
    public function __construct(
        private DetectorRegistry $registry,
    ) {
    }

    /**
     * Execute every registered detector and return the best result.
     *
     * All detectors run against the given context in registration order.
     * The result with the highest confidence is returned; ties are
     * resolved in favour of the first detector encountered. The returned
     * DetectionResult is never modified, and the given DetectionContext
     * is never changed.
     *
     * @param DetectionContext $context The immutable HTTP response context.
     *
     * @return DetectionResult The detection result with the highest confidence.
     *
     * @throws RuntimeException When no detector has been registered.
     */
    public function detect(DetectionContext $context): DetectionResult
    {
        $bestResult = null;

        foreach ($this->registry->all() as $detector) {
            $result = $detector->detect($context);

            if ($bestResult === null || $result->confidence() > $bestResult->confidence()) {
                $bestResult = $result;
            }
        }

        if ($bestResult === null) {
            throw new RuntimeException('No detectors have been registered.');
        }

        return $bestResult;
    }
}
