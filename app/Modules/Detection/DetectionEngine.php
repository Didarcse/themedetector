<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Orchestrates all registered technology detectors.
 *
 * Receives the HTML source and URL of a target website, executes every
 * registered DetectorInterface implementation in order, and returns
 * the collected DetectionResult list.
 */
final class DetectionEngine
{
    /**
     * @param list<DetectorInterface> $detectors Ordered list of detectors to execute.
     *
     * @throws \InvalidArgumentException If any item is not a DetectorInterface.
     */
    public function __construct(
        private readonly array $detectors,
    ) {
        foreach ($this->detectors as $index => $detector) {
            if (!$detector instanceof DetectorInterface) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Detector at index %d must implement %s, got %s.',
                        $index,
                        DetectorInterface::class,
                        get_debug_type($detector),
                    ),
                );
            }
        }
    }

    /**
     * Run every registered detector against the given page.
     *
     * Execution order is preserved. A detector returning "not detected"
     * does not halt the pipeline — only a detector that throws will
     * propagate its exception.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return list<DetectionResult>
     */
    public function detect(string $html, string $url): array
    {
        /** @var list<DetectionResult> $results */
        $results = [];

        foreach ($this->detectors as $detector) {
            $results[] = $detector->detect($html, $url);
        }

        return $results;
    }
}
