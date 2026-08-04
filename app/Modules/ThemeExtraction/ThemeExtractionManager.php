<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface;
use RuntimeException;

/**
 * Coordinates every registered Theme Extractor and returns the best
 * ThemeExtractionResult.
 *
 * The ThemeExtractionManager is the orchestration layer of the Theme
 * Extraction Engine. It executes every extractor registered in the
 * ThemeExtractorRegistry, compares their confidence scores, and returns
 * the ThemeExtractionResult with the highest confidence.
 *
 * Responsibilities:
 *
 * - Execute every registered theme extractor in the order it was provided.
 * - Compare extractor results and select the highest-confidence outcome.
 * - Throw a RuntimeException when no extractor has been registered.
 *
 * Design philosophy:
 *
 * - Manager: performs orchestration only.
 * - Orchestrator: it wires the registered extractors to the given
 *   context and nothing more.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no style.css parsing,
 *   and no confidence calculation.
 * - Open/Closed Principle: it works exclusively with
 *   ThemeExtractorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Joomla, Drupal, TYPO3, etc.),
 *   so new extractors can be added without modifying the manager.
 * - Extractors are never reordered and never executed more than once. On
 *   equal confidence, the first extractor in registration order wins.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 */
final readonly class ThemeExtractionManager
{
    /**
     * @param ThemeExtractorRegistry $registry The registry of registered
     *                                         theme extractors.
     */
    public function __construct(
        private ThemeExtractorRegistry $registry,
    ) {
    }

    /**
     * Execute every registered theme extractor and return the best result.
     *
     * All extractors run against the given context in registration order.
     * The result with the highest confidence is returned; ties are
     * resolved in favour of the first extractor encountered. The returned
     * ThemeExtractionResult is never modified, and the given
     * DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extraction result with the highest
     *                               confidence.
     *
     * @throws RuntimeException When no extractor has been registered.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult
    {
        $bestResult = null;

        foreach ($this->registry->all() as $extractor) {
            $result = $extractor->extract($context);

            if ($bestResult === null || $result->confidence() > $bestResult->confidence()) {
                $bestResult = $result;
            }
        }

        if ($bestResult === null) {
            throw new RuntimeException('No theme extractors have been registered.');
        }

        return $bestResult;
    }
}
