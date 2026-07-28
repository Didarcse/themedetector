<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Orchestrates all registered technology detectors.
 *
 * Iterates through every detector in the DetectorRegistry, passes the
 * DetectionContext to each, and collects the results in registration
 * order.  Does not filter, sort, or interpret results.
 */
final class DetectionEngine
{
    public function __construct(
        private readonly DetectorRegistry $registry,
    ) {
    }

    /**
     * Run every registered detector against the given context.
     *
     * Execution order is preserved. A detector returning "not detected"
     * does not halt the pipeline — only a detector that throws will
     * propagate its exception.
     *
     * @param DetectionContext $context The immutable HTTP response context.
     *
     * @return list<DetectionResult>
     */
    public function detect(DetectionContext $context): array
    {
        /** @var list<DetectionResult> $results */
        $results = [];

        foreach ($this->registry->all() as $detector) {
            $results[] = $detector->detect($context);
        }

        return $results;
    }
}
