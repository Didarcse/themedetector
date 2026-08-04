<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Contracts;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Contract for every Theme Extractor implementation.
 *
 * A Theme Extractor is responsible for extracting theme metadata from a
 * website after the CMS has already been detected. Theme extractors never
 * detect the CMS themselves; they consume the immutable detection context
 * produced by the Detection Engine and return a structured
 * ThemeExtractionResult.
 *
 * Responsibilities:
 *
 * - Extract theme metadata from the given detection context.
 * - Return the extracted theme information as a ThemeExtractionResult.
 *
 * Design philosophy:
 *
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete extractor.
 * - Dependency Injection and Open/Closed Principle: new extractors are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: extractors perform theme extraction
 *   only. They never detect CMS, never perform HTTP requests, never
 *   calculate confidence, and never perform plugin detection.
 * - Stateless, deterministic, and side-effect free.
 *
 * Supported implementations:
 *
 * - WordPressThemeExtractor, ShopifyThemeExtractor, GhostThemeExtractor,
 *   JoomlaThemeExtractor, DrupalThemeExtractor, TYPO3ThemeExtractor,
 *   WebflowThemeExtractor, WixThemeExtractor, MagentoThemeExtractor, and
 *   future extractors.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */
interface ThemeExtractorInterface
{
    /**
     * Extract theme metadata from the given detection context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. Extractors translate that data into theme
     * information and perform no additional HTTP requests of their own.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return ThemeExtractionResult The extracted theme metadata result.
     */
    public function extract(DetectionContext $context): ThemeExtractionResult;
}
