<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

use App\Modules\Detection\DetectionContext;

/**
 * Public entry point for the Theme Extraction Engine.
 *
 * ThemeExtractor coordinates the complete theme extraction workflow: it
 * delegates extraction to the ThemeExtractionManager and returns the
 * resulting highest-confidence ThemeExtractionResult.
 *
 * ThemeExtractor is the only class external consumers should interact with
 * for theme extraction.
 *
 * Responsibilities:
 *
 * - Delegate extraction to the ThemeExtractionManager.
 * - Return the resulting ThemeExtractionResult.
 *
 * Design philosophy:
 *
 * - Facade: it is the single public entry point for the Theme Extraction
 *   Engine.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Dependency Injection: collaborators are provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   business logic, no CMS or plugin detection, and no HTTP requests.
 * - Open/Closed Principle: new extractors are added without modifying this
 *   class.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class ThemeExtractor
{
    /**
     * Create a new ThemeExtractor.
     *
     * @param ThemeExtractionManager $manager The ThemeExtractionManager that
     *                                        performs theme extraction.
     */
    public function __construct(
        private ThemeExtractionManager $manager,
    ) {
    }

    /**
     * Extract the theme of the website represented by the given context.
     *
     * Delegates extraction to the ThemeExtractionManager and returns the
     * resulting ThemeExtractionResult. The returned result is never
     * modified, and the given DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extraction result with the highest
     *                               confidence.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult
    {
        return $this->manager->extract($context);
    }
}
