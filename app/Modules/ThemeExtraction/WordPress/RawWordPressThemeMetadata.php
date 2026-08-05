<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

/**
 * Raw metadata extracted directly from a WordPress style.css file.
 *
 * RawWordPressThemeMetadata is a temporary transport object exchanged
 * between WordPressStyleCssParser and WordPressThemeMetadataMapper. It
 * carries the style.css header fields exactly as they were read from the
 * file, without interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store the raw style.css metadata fields.
 * - Expose them through the fields() accessor.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the parser to the
 *   mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, and no business logic:
 *   values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about ThemeMetadata, WordPress, or any other
 * platform; it is a plain, platform-neutral field container.
 */
final readonly class RawWordPressThemeMetadata
{
    /**
     * @param array<string, string> $rawFields The raw style.css metadata
     *                                         fields keyed by field name.
     */
    public function __construct(
        private array $rawFields,
    ) {
    }

    /**
     * Return the raw style.css metadata fields.
     *
     * @return array<string, string> The raw metadata fields keyed by field
     *                               name, exactly as supplied.
     */
    public function fields(): array
    {
        return $this->rawFields;
    }
}
