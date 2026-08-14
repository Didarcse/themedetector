<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Orchestrates the complete Drupal theme extraction workflow.
 *
 * DrupalThemeExtractor is the orchestration layer of the Drupal theme
 * extraction pipeline. It coordinates a fixed sequence of dedicated
 * collaborators — gating extraction on Drupal-specific CMS evidence,
 * locating the active theme directory from the HTML, and mapping the raw
 * theme directory name — and assembles the resulting ThemeExtractionResult
 * from their outputs. It is a thin facade: it performs no work itself
 * other than delegating each step and wiring the results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * DrupalContextGate
 *   ↓
 * DrupalThemeLocator
 *   ↓
 * theme directory name
 *   ↓
 * RawDrupalThemeMetadata
 *   ↓
 * DrupalThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Responsibilities:
 *
 * - Delegate the CMS-context check to DrupalContextGate.
 * - Delegate theme directory discovery to DrupalThemeLocator.
 * - Delegate metadata normalization to DrupalThemeMetadataMapper.
 * - Assemble and return the resulting ThemeExtractionResult.
 * - Return a failed ThemeExtractionResult when the page lacks
 *   Drupal-specific evidence or no valid theme directory name is found, so
 *   that an empty name never becomes extracted theme metadata.
 *
 * Confidence:
 *
 * The ThemeExtractionManager selects the result with the highest
 * confidence score and resolves ties in favour of the first registered
 * extractor. WordPress reports a fixed confidence of zero (MVP), so a
 * Drupal extractor reporting zero could never win its selection on any
 * page. This extractor therefore reports a small positive confidence
 * (EXTRACTED_CONFIDENCE = 1) when it extracts a theme, and zero when it
 * does not. A WordPress page still selects the WordPress extractor
 * (extracted 0 vs Drupal not-extracted 0, tie, first registered wins),
 * a Shopify page selects the Shopify extractor (1 beats 0), a Joomla page
 * selects the Joomla extractor (1 beats 0), and a Drupal page selects this
 * extractor (1 beats 0). The value is deliberately minimal and is the only
 * deviation from the zero-confidence MVP convention, adopted to make
 * max-confidence selection work for additional extractors without
 * modifying the manager.
 *
 * Design philosophy:
 *
 * - Facade: DrupalThemeExtractor is the single public entry point for
 *   Drupal theme extraction.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never performs
 *   HTTP requests, never inspects HTML, never contains Drupal detection or
 *   business rules, and owns no confidence calculation beyond its fixed
 *   constant.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same ThemeExtractionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * The class contains no regular expressions, no HTTP requests, no HTML
 * inspection, no Drupal detection logic, no confidence calculation, and no
 * business rules.
 */
final readonly class DrupalThemeExtractor implements ThemeExtractorInterface
{
    /**
     * The confidence reported when a theme is extracted.
     *
     * See the class-level Confidence section for the rationale behind this
     * small positive constant.
     */
    public const EXTRACTED_CONFIDENCE = 1;

    /**
     * Create a new DrupalThemeExtractor.
     *
     * @param DrupalContextGate            $gate            Checks whether the
     *                                                      page carries
     *                                                      Drupal-specific CMS
     *                                                      evidence.
     * @param DrupalThemeLocator           $locator         Locates the active
     *                                                      Drupal theme
     *                                                      directory name from
     *                                                      the HTML inside the
     *                                                      detection context.
     * @param DrupalThemeMetadataMapper    $metadataMapper  Maps the raw theme
     *                                                      metadata to a
     *                                                      normalized
     *                                                      ThemeMetadata.
     */
    public function __construct(
        private DrupalContextGate $gate,
        private DrupalThemeLocator $locator,
        private DrupalThemeMetadataMapper $metadataMapper,
    ) {
    }

    /**
     * Extract Drupal theme metadata from the given detection context.
     *
     * Coordinates the dedicated collaborators in order and returns the
     * assembled result:
     *
     * - Check that the page carries Drupal-specific CMS evidence.
     * - Locate the active theme directory name from the detection context
     *   HTML.
     * - Map the raw theme metadata to a normalized ThemeMetadata.
     * - Return the mapped metadata as the result.
     *
     * When the page lacks Drupal-specific evidence or no valid theme
     * directory name is found, a failed ThemeExtractionResult is returned:
     * an empty name must never become valid theme metadata. The given
     * DetectionContext is never modified and never fetched again.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extracted Drupal theme metadata
     *                               result, or a failed result when the
     *                               page is not Drupal or carries no valid
     *                               theme directory name.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult
    {
        if (!$this->gate->passes($context)) {
            return $this->notExtracted();
        }

        $themeSlug = $this->locator->locate($context);

        if ($themeSlug === null) {
            return $this->notExtracted();
        }

        $themeMetadata = $this->metadataMapper->map(
            new RawDrupalThemeMetadata($themeSlug),
        );

        if ($themeMetadata->name() === '') {
            return $this->notExtracted();
        }

        return new ThemeExtractionResult(
            extracted: true,
            theme: $themeMetadata,
            confidence: self::EXTRACTED_CONFIDENCE,
        );
    }

    /**
     * Return a ThemeExtractionResult representing a failed extraction.
     *
     * Used when the page is not Drupal or carries no valid theme directory
     * name, so that a deterministic result is always produced. The
     * confidence is zero, consistent with the not-extracted convention of
     * the MVP.
     *
     * @return ThemeExtractionResult The failed extraction result.
     */
    private function notExtracted(): ThemeExtractionResult
    {
        return new ThemeExtractionResult(
            extracted: false,
            theme: null,
            confidence: 0,
        );
    }
}
