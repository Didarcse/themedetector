<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Joomla;

/**
 * Raw template metadata extracted directly from a Joomla template
 * directory name.
 *
 * RawJoomlaTemplateMetadata is a temporary transport object exchanged
 * between the JoomlaThemeExtractor and JoomlaThemeMetadataMapper. It
 * carries the template directory name exactly as it was located from the
 * HTML, without interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store the raw template directory name.
 * - Expose it through the templateSlug() accessor.
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
 * The class knows nothing about ThemeMetadata, Joomla, or any other
 * platform; it is a plain, platform-neutral field container.
 */
final readonly class RawJoomlaTemplateMetadata
{
    /**
     * @param string $templateSlug The raw Joomla template directory name.
     */
    public function __construct(
        private string $templateSlug,
    ) {
    }

    /**
     * Return the raw Joomla template directory name.
     *
     * @return string The template directory name.
     */
    public function templateSlug(): string
    {
        return $this->templateSlug;
    }
}
