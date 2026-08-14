<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Shopify;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Orchestrates the complete Shopify theme extraction workflow.
 *
 * ShopifyThemeExtractor is the orchestration layer of the Shopify theme
 * extraction pipeline. It coordinates a fixed sequence of dedicated
 * collaborators — locating the window.Shopify object literal from the HTML,
 * parsing the raw theme metadata from it, and mapping the raw metadata —
 * and assembles the resulting ThemeExtractionResult from their outputs. It
 * is a thin facade: it performs no work itself other than delegating each
 * step and wiring the results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * ShopifyThemeLocator
 *   ↓
 * window.Shopify object bodies
 *   ↓
 * ShopifyThemeParser
 *   ↓
 * RawShopifyThemeMetadata
 *   ↓
 * ShopifyThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Responsibilities:
 *
 * - Delegate window.Shopify object discovery to ShopifyThemeLocator.
 * - Delegate raw theme metadata parsing to ShopifyThemeParser.
 * - Delegate metadata normalization to ShopifyThemeMetadataMapper.
 * - Assemble and return the resulting ThemeExtractionResult.
 * - Return a failed ThemeExtractionResult when no window.Shopify object
 *   with a valid theme name is found, so that an empty name never becomes
 *   extracted theme metadata.
 *
 * Confidence:
 *
 * The ThemeExtractionManager selects the result with the highest
 * confidence score and resolves ties in favour of the first registered
 * extractor. WordPress reports a fixed confidence of zero (MVP), so a
 * Shopify extractor reporting zero could never win its selection on any
 * page. This extractor therefore reports a small positive confidence
 * (EXTRACTED_CONFIDENCE = 1) when it extracts a theme, and zero when it
 * does not. A WordPress page still selects the WordPress extractor
 * (extracted 0 vs Shopify not-extracted 0, tie, first registered wins),
 * while a Shopify page selects this extractor (1 beats 0). The value is
 * deliberately minimal and is the only deviation from the zero-confidence
 * MVP convention, adopted to make max-confidence selection work for a
 * second extractor without modifying the manager.
 *
 * Design philosophy:
 *
 * - Facade: ShopifyThemeExtractor is the single public entry point for
 *   Shopify theme extraction.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never parses
 *   objects, never performs HTTP requests, never inspects HTML, never
 *   contains Shopify business rules, and owns no confidence calculation
 *   beyond its fixed constant.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same ThemeExtractionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * The class contains no regular expressions, no object parsing, no HTTP
 * requests, no HTML inspection, no Shopify detection logic, and no
 * business rules.
 */
final readonly class ShopifyThemeExtractor implements ThemeExtractorInterface
{
    /**
     * The confidence reported when a theme is extracted.
     *
     * See the class-level Confidence section for the rationale behind this
     * small positive constant.
     */
    public const EXTRACTED_CONFIDENCE = 1;

    /**
     * Create a new ShopifyThemeExtractor.
     *
     * @param ShopifyThemeLocator          $locator        Locates the
     *                                                     window.Shopify object
     *                                                     bodies from the HTML
     *                                                     inside the detection
     *                                                     context.
     * @param ShopifyThemeParser           $parser         Parses the raw theme
     *                                                     metadata from each
     *                                                     object body.
     * @param ShopifyThemeMetadataMapper   $metadataMapper Maps the raw theme
     *                                                     metadata to a
     *                                                     normalized
     *                                                     ThemeMetadata.
     */
    public function __construct(
        private ShopifyThemeLocator $locator,
        private ShopifyThemeParser $parser,
        private ShopifyThemeMetadataMapper $metadataMapper,
    ) {
    }

    /**
     * Extract Shopify theme metadata from the given detection context.
     *
     * Coordinates the dedicated collaborators in order and returns the
     * assembled result:
     *
     * - Locate every window.Shopify object body from the detection context
     *   HTML.
     * - Parse the raw theme metadata from each object body.
     * - Map the raw metadata to a normalized ThemeMetadata.
     * - Return the first successful mapping as the result.
     *
     * When no object body carries a valid theme name, a failed
     * ThemeExtractionResult is returned: an empty name must never become
     * valid theme metadata. The given DetectionContext is never modified
     * and never fetched again.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extracted Shopify theme metadata
     *                               result, or a failed result when no
     *                               window.Shopify object carries a valid
     *                               theme name.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult
    {
        foreach ($this->locator->locate($context) as $objectBody) {
            $rawMetadata = $this->parser->parse($objectBody);

            if ($rawMetadata === null) {
                continue;
            }

            $themeMetadata = $this->metadataMapper->map($rawMetadata);

            if ($themeMetadata->name() === '') {
                continue;
            }

            return new ThemeExtractionResult(
                extracted: true,
                theme: $themeMetadata,
                confidence: self::EXTRACTED_CONFIDENCE,
            );
        }

        return $this->notExtracted();
    }

    /**
     * Return a ThemeExtractionResult representing a failed extraction.
     *
     * Used when no window.Shopify object body carries a valid theme name,
     * so that a deterministic result is always produced. The confidence is
     * zero, consistent with the not-extracted convention of the MVP.
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
