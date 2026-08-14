<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Drupal;

/**
 * Raw theme metadata extracted directly from a Drupal theme directory
 * name.
 *
 * RawDrupalThemeMetadata is a temporary transport object exchanged between
 * the DrupalThemeExtractor and DrupalThemeMetadataMapper. It carries the
 * theme directory name exactly as it was located from the HTML, without
 * interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store the raw theme directory name.
 * - Expose it through the themeSlug() accessor.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the extractor to
 *   the mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, and no business logic:
 *   values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about ThemeMetadata, Drupal, or any other
 * platform; it is a plain, platform-neutral field container.
 */
final readonly class RawDrupalThemeMetadata
{
    /**
     * @param string $themeSlug The raw Drupal theme directory name.
     */
    public function __construct(
        private string $themeSlug,
    ) {
    }

    /**
     * Return the raw Drupal theme directory name.
     *
     * @return string The theme directory name.
     */
    public function themeSlug(): string
    {
        return $this->themeSlug;
    }
}
