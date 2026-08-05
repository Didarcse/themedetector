<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\ThemeExtraction\ThemeMetadata;

/**
 * Converts RawWordPressThemeMetadata into the ThemeMetadata domain object.
 *
 * WordPressThemeMetadataMapper is responsible only for translating the raw
 * style.css header fields into the canonical, CMS-agnostic ThemeMetadata
 * value object. It applies lightweight normalization (missing fields become
 * null, surrounding whitespace is trimmed) and nothing else: no version or
 * URL validation, no tag splitting, no value inference, and no business
 * logic.
 *
 * Responsibilities:
 *
 * - Translate the recognized raw fields into the corresponding
 *   ThemeMetadata properties.
 * - Normalize each value by trimming surrounding whitespace.
 * - Treat missing fields as null.
 * - Preserve the raw Tags value without splitting it.
 * - Store fields without a dedicated ThemeMetadata property (such as
 *   Tested up to) in the platform-specific extra() array.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no HTTP requests, no CSS parsing, no HTML
 *   parsing, no confidence calculation, and no WordPress business rules.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same ThemeMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawWordPressThemeMetadata it receives.
 *
 * The class creates no ThemeExtractionResult and knows nothing about the
 * extraction workflow that surrounds it.
 */
final readonly class WordPressThemeMetadataMapper
{
    /**
     * Map the raw metadata to a ThemeMetadata value object.
     *
     * Recognized fields are translated to their ThemeMetadata counterpart.
     * Fields that are missing from the raw metadata map to null (or the
     * empty string for the required theme name). The Tags value is
     * preserved as a single-element array without splitting, and Tested up
     * to is stored under the 'tested_up_to' key of the extra() array since
     * ThemeMetadata exposes no dedicated property for it.
     *
     * @param RawWordPressThemeMetadata $raw The raw metadata extracted from
     *                                       the style.css header.
     *
     * @return ThemeMetadata The normalized ThemeMetadata value object.
     */
    public function map(RawWordPressThemeMetadata $raw): ThemeMetadata
    {
        $fields = $raw->fields();

        $tags = $this->value($fields, 'Tags');
        $testedUpTo = $this->value($fields, 'Tested up to');

        $extra = [];

        if ($testedUpTo !== null) {
            $extra['tested_up_to'] = $testedUpTo;
        }

        return new ThemeMetadata(
            name: $this->value($fields, 'Theme Name') ?? '',
            version: $this->value($fields, 'Version'),
            author: $this->value($fields, 'Author'),
            authorUrl: $this->value($fields, 'Author URI'),
            themeUrl: $this->value($fields, 'Theme URI'),
            description: $this->value($fields, 'Description'),
            license: $this->value($fields, 'License'),
            licenseUrl: $this->value($fields, 'License URI'),
            textDomain: $this->value($fields, 'Text Domain'),
            parentTheme: $this->value($fields, 'Template'),
            tags: $tags === null ? [] : [$tags],
            requiresPhp: $this->value($fields, 'Requires PHP'),
            requiresCms: $this->value($fields, 'Requires at least'),
            extra: $extra,
        );
    }

    /**
     * Return the trimmed value for the given field, or null.
     *
     * Missing fields, as well as fields that are empty after trimming, are
     * treated as null. Surrounding whitespace is removed; internal
     * whitespace and casing are preserved exactly as found.
     *
     * @param array<string, string> $fields The raw metadata fields.
     * @param string                $key    The canonical field name.
     *
     * @return string|null The trimmed field value, or null when the field
     *                     is missing or empty.
     */
    private function value(array $fields, string $key): ?string
    {
        $value = $fields[$key] ?? null;

        if ($value === null) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? $value : null;
    }
}
