<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Drupal;

use App\Modules\ThemeExtraction\ThemeMetadata;

/**
 * Converts RawDrupalThemeMetadata into the ThemeMetadata domain object.
 *
 * DrupalThemeMetadataMapper is responsible only for translating the raw
 * theme directory name located from the HTML into the canonical,
 * CMS-agnostic ThemeMetadata value object. It applies lightweight
 * normalization (surrounding whitespace is trimmed) and nothing else: no
 * version or URL inference, and no business logic.
 *
 * Responsibilities:
 *
 * - Translate the raw theme directory name into the ThemeMetadata name.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no HTTP requests, no parsing, no confidence
 *   calculation, and no Drupal business rules.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same ThemeMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawDrupalThemeMetadata it receives.
 *
 * The class creates no ThemeExtractionResult and knows nothing about the
 * extraction workflow that surrounds it.
 */
final readonly class DrupalThemeMetadataMapper
{
    /**
     * Map the raw metadata to a ThemeMetadata value object.
     *
     * The raw theme directory name maps to the ThemeMetadata name, trimmed
     * of surrounding whitespace. Every other ThemeMetadata field — version,
     * author, theme URL, license, and the rest — remains null, since the
     * Drupal theme path exposes no reliable explicit metadata.
     *
     * @param RawDrupalThemeMetadata $raw The raw metadata located from the
     *                                    HTML.
     *
     * @return ThemeMetadata The normalized ThemeMetadata value object.
     */
    public function map(RawDrupalThemeMetadata $raw): ThemeMetadata
    {
        return new ThemeMetadata(
            name: trim($raw->themeSlug()),
        );
    }
}
