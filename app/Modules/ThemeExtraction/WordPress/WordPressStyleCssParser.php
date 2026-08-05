<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata;

/**
 * Parses the metadata header from a WordPress theme style.css file.
 *
 * WordPressStyleCssParser is responsible only for extracting the raw
 * metadata fields declared in the opening header comment of a WordPress
 * theme stylesheet. It reads the stylesheet line by line, inspects only
 * the metadata header, and returns the extracted key/value pairs wrapped
 * in a RawWordPressThemeMetadata transport object. It never parses CSS
 * rules, never validates or normalizes values, and never performs any
 * mapping.
 *
 * Responsibilities:
 *
 * - Read the style.css contents line by line.
 * - Inspect only the metadata header (the opening comment block).
 * - Extract the recognized metadata field names and their values.
 * - Stop parsing as soon as the metadata header ends.
 * - Return the extracted fields as a RawWordPressThemeMetadata.
 *
 * Design philosophy:
 *
 * - Parser: it extracts raw data only and performs no interpretation.
 * - Single Responsibility Principle: extracting the raw metadata header is
 *   the only concern. It performs no validation, no normalization, no
 *   mapping, no HTTP requests, and no confidence calculation.
 * - Line-by-line processing: lightweight matching is applied per header
 *   line only; the stylesheet is never parsed with one large regular
 *   expression, and CSS rules, declarations, and selectors are never
 *   inspected.
 * - Stateless, deterministic, and side-effect free: given the same
 *   style.css contents, it always returns the same fields.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the style.css string it receives.
 *
 * The class creates no ThemeMetadata, knows nothing about
 * ThemeExtractionResult, and contains no WordPress business rules.
 */
final readonly class WordPressStyleCssParser
{
    /**
     * The recognized WordPress style.css header fields.
     *
     * Maps the lowercase field name as found in the file to the canonical
     * field name used as the array key, allowing case-insensitive
     * recognition while producing stable, predictable keys.
     *
     * @var array<string, string>
     */
    private const FIELD_LOOKUP = [
        'theme name' => 'Theme Name',
        'theme uri' => 'Theme URI',
        'author' => 'Author',
        'author uri' => 'Author URI',
        'description' => 'Description',
        'version' => 'Version',
        'license' => 'License',
        'license uri' => 'License URI',
        'tags' => 'Tags',
        'text domain' => 'Text Domain',
        'requires php' => 'Requires PHP',
        'requires at least' => 'Requires at least',
        'tested up to' => 'Tested up to',
        'template' => 'Template',
    ];

    /**
     * Parse the metadata header from the given style.css contents.
     *
     * @param string $styleCss The full contents of a WordPress theme
     *                         style.css file.
     *
     * @return RawWordPressThemeMetadata The raw metadata fields extracted
     *                                   from the stylesheet header.
     */
    public function parse(string $styleCss): RawWordPressThemeMetadata
    {
        return new RawWordPressThemeMetadata($this->extractFields($styleCss));
    }

    /**
     * Extract the recognized metadata fields from the stylesheet header.
     *
     * Reads the stylesheet line by line. Parsing begins at the first
     * opening comment marker and ends as soon as the comment is closed;
     * everything outside the metadata header — CSS rules, declarations,
     * selectors, and other comments — is ignored. Each header line is
     * examined for a recognized field; only the first occurrence of each
     * field is retained.
     *
     * @param string $styleCss The full contents of a WordPress theme
     *                         style.css file.
     *
     * @return array<string, string> The recognized fields keyed by their
     *                               canonical field name.
     */
    private function extractFields(string $styleCss): array
    {
        $fields = [];
        $inHeader = false;

        $lines = preg_split('/\R/', $styleCss);

        if ($lines === false) {
            return $fields;
        }

        foreach ($lines as $line) {
            if (!$inHeader) {
                $commentStart = strpos($line, '/*');

                if ($commentStart === false) {
                    continue;
                }

                $inHeader = true;
                $line = substr($line, $commentStart + 2);
            }

            $commentEnd = strpos($line, '*/');

            if ($commentEnd !== false) {
                $this->extractFieldLine(substr($line, 0, $commentEnd), $fields);
                break;
            }

            $this->extractFieldLine($line, $fields);
        }

        return $fields;
    }

    /**
     * Extract a single recognized field from one metadata header line.
     *
     * Removes decorative comment markers and surrounding whitespace, splits
     * the line at the first colon, and stores the value under its canonical
     * field name when the field is recognized and not already present.
     * Surrounding whitespace is removed from the value; internal whitespace
     * and all other characters are preserved exactly as found in the file.
     *
     * @param string              $line   A single metadata header line.
     * @param array<string,string> $fields The fields collected so far.
     *
     * @return void
     */
    private function extractFieldLine(string $line, array &$fields): void
    {
        $line = trim($line, " \t\n\r\0\x0B*");

        if ($line === '') {
            return;
        }

        $colonPos = strpos($line, ':');

        if ($colonPos === false) {
            return;
        }

        $canonicalKey = self::FIELD_LOOKUP[strtolower(trim(substr($line, 0, $colonPos)))] ?? null;

        if ($canonicalKey === null || isset($fields[$canonicalKey])) {
            return;
        }

        $fields[$canonicalKey] = trim(substr($line, $colonPos + 1));
    }
}
