<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Orchestrates the complete WordPress theme extraction workflow.
 *
 * WordPressThemeExtractor is the orchestration layer of the WordPress
 * theme extraction pipeline. It coordinates a fixed sequence of dedicated
 * collaborators and assembles the resulting ThemeExtractionResult from
 * their outputs. It is a thin facade: it performs no work itself other
 * than delegating each step and wiring the results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * WordPressStyleCssLocator
 *   ↓
 * style.css URL
 *   ↓
 * WordPressStyleCssDownloader
 *   ↓
 * style.css contents
 *   ↓
 * WordPressStyleCssParser
 *   ↓
 * Raw Theme Metadata
 *   ↓
 * WordPressThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Responsibilities:
 *
 * - Delegate style.css URL locating to WordPressStyleCssLocator.
 * - Delegate style.css downloading to WordPressStyleCssDownloader.
 * - Delegate raw metadata parsing to WordPressStyleCssParser.
 * - Delegate metadata normalization to WordPressThemeMetadataMapper.
 * - Assemble and return the resulting ThemeExtractionResult.
 * - Return a failed ThemeExtractionResult when the style.css cannot be
 *   located or downloaded.
 *
 * Design philosophy:
 *
 * - Facade: WordPressThemeExtractor is the single public entry point for
 *   WordPress theme extraction.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never parses
 *   CSS, never performs HTTP requests, never inspects HTML, never
 *   calculates confidence, and never contains WordPress business rules.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same ThemeExtractionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * The class contains no regular expressions, no CSS parsing, no HTTP
 * requests, no HTML inspection, no WordPress detection logic, no
 * confidence calculation, and no business rules.
 */
final readonly class WordPressThemeExtractor implements ThemeExtractorInterface
{
    /**
     * Create a new WordPressThemeExtractor.
     *
     * @param WordPressStyleCssLocator      $styleCssLocator      Locates the
     *                                                            style.css URL from the
     *                                                            detection context.
     * @param WordPressStyleCssDownloader   $styleCssDownloader   Downloads the style.css
     *                                                            contents from the located
     *                                                            URL.
     * @param WordPressStyleCssParser       $styleCssParser       Parses the raw theme
     *                                                            metadata from the style.css
     *                                                            contents.
     * @param WordPressThemeMetadataMapper  $metadataMapper       Maps the raw theme metadata
     *                                                            to a normalized
     *                                                            ThemeMetadata.
     */
    public function __construct(
        private WordPressStyleCssLocator $styleCssLocator,
        private WordPressStyleCssDownloader $styleCssDownloader,
        private WordPressStyleCssParser $styleCssParser,
        private WordPressThemeMetadataMapper $metadataMapper,
    ) {
    }

    /**
     * Extract WordPress theme metadata from the given detection context.
     *
     * Coordinates the dedicated collaborators in order and returns the
     * assembled result:
     *
     * - Locate the style.css URL from the detection context.
     * - Download the style.css contents from the located URL.
     * - Parse the raw theme metadata from the style.css contents.
     * - Map the raw metadata to a normalized ThemeMetadata.
     * - Assemble the resulting ThemeExtractionResult.
     *
     * When the style.css cannot be located or downloaded, a failed
     * ThemeExtractionResult is returned. For the MVP, the confidence is
     * always zero; confidence scoring is intentionally deferred to future
     * extraction rules and scoring logic. The given DetectionContext is
     * never modified.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extracted WordPress theme metadata
     *                               result, or a failed result when the
     *                               style.css could not be resolved.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult
    {
        $styleCssUrl = $this->styleCssLocator->locate($context);

        if ($styleCssUrl === null) {
            return $this->notExtracted();
        }

        $styleCssContents = $this->styleCssDownloader->download($styleCssUrl);

        if ($styleCssContents === null) {
            return $this->notExtracted();
        }

        $rawMetadata = $this->styleCssParser->parse($styleCssContents);
        $themeMetadata = $this->metadataMapper->map($rawMetadata);

        return new ThemeExtractionResult(
            extracted: true,
            theme: $themeMetadata,
            confidence: 0,
        );
    }

    /**
     * Return a ThemeExtractionResult representing a failed extraction.
     *
     * Used when the style.css cannot be located or downloaded, so that a
     * deterministic result is always produced. The confidence is zero,
     * consistent with the MVP scope in which this class owns no confidence
     * values.
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
