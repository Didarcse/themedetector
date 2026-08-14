<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Shopify;

/**
 * Parses the raw theme metadata from a window.Shopify object literal.
 *
 * ShopifyThemeParser is responsible only for extracting the raw theme
 * metadata fields declared inside a window.Shopify object body. It accepts
 * the text of a JavaScript object literal (with braces), inspects only the
 * top-level `theme` property, and returns the recognized fields — name,
 * id, and role — wrapped in a RawShopifyThemeMetadata transport object. It
 * never executes the object, never validates or normalizes values, and
 * never performs any mapping.
 *
 * Rules:
 *
 * - The input may be a full object literal (braces included) or its bare
 *   interior; a braced literal must have balanced braces.
 * - Only the top-level `theme` property is inspected; all other properties
 *   are consumed without interpretation.
 * - String literals may be single- or double-quoted and are unescaped.
 * - A theme property that is missing or not an object yields null.
 * - A malformed object literal yields null.
 * - Unparseable values other than theme are ignored, never guessed.
 *
 * Design philosophy:
 *
 * - Parser: it extracts raw data only and performs no interpretation.
 * - Single Responsibility Principle: extracting the raw theme fields is
 *   the only concern. It performs no validation, no normalization, no
 *   mapping, no HTTP requests, and no confidence calculation.
 * - String-aware scanning: values are parsed with lightweight matching
 *   that is aware of string literals, quoted keys, and brace depth; the
 *   object is never evaluated and never parsed with one large regular
 *   expression.
 * - Stateless, deterministic, and side-effect free: given the same object
 *   text, it always returns the same fields.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the object text it receives.
 *
 * The class creates no ThemeMetadata, knows nothing about
 * ThemeExtractionResult, and contains no Shopify business rules.
 */
final readonly class ShopifyThemeParser
{
    /**
     * Parse the raw theme metadata from the given object literal.
     *
     * @param string $objectText The text of a window.Shopify object
     *                           literal (braces included) or its interior.
     *
     * @return RawShopifyThemeMetadata|null The raw theme metadata, or null
     *                                      when the literal is malformed or
     *                                      carries no theme object.
     */
    public function parse(string $objectText): ?RawShopifyThemeMetadata
    {
        $interior = $this->objectInterior($objectText);

        if ($interior === null) {
            return null;
        }

        $properties = $this->topLevelProperties($interior);

        $theme = $properties['theme'] ?? null;

        if (!is_array($theme)) {
            return null;
        }

        $name = isset($theme['name']) && is_string($theme['name']) ? $theme['name'] : null;
        $role = isset($theme['role']) && is_string($theme['role']) ? $theme['role'] : null;
        $id = $theme['id'] ?? null;

        if (!is_int($id) && !is_string($id)) {
            $id = null;
        }

        return new RawShopifyThemeMetadata(
            name: $name,
            id: $id,
            role: $role,
        );
    }

    /**
     * Extract the interior of the outer object literal.
     *
     * Accepts both the full object literal (braces included) and its bare
     * interior: when the text does not start with an opening brace it is
     * treated as the interior directly. For a braced literal, the first
     * opening brace outside any string literal and its matching closing
     * brace delimit the interior. Returns null when the text is empty or
     * a braced literal never balances.
     *
     * @param string $objectText The object literal text.
     *
     * @return string|null The outer object interior, or null when malformed.
     */
    private function objectInterior(string $objectText): ?string
    {
        $trimmed = trim($objectText);

        if ($trimmed === '') {
            return null;
        }

        if ($trimmed[0] !== '{') {
            return $trimmed;
        }

        $length = strlen($objectText);

        $open = $this->indexOfBrace($objectText, $length);

        if ($open === null) {
            return null;
        }

        $close = $this->matchingBrace($objectText, $open + 1, $length);

        if ($close === null) {
            return null;
        }

        return substr($objectText, $open + 1, $close - $open - 1);
    }

    /**
     * Return the offset of the first unquoted opening brace.
     *
     * @param string $text   The text to scan.
     * @param int    $length The length of the text.
     *
     * @return int|null The offset of the opening brace, or null when none
     *                  exists outside a string literal.
     */
    private function indexOfBrace(string $text, int $length): ?int
    {
        for ($i = 0; $i < $length; $i++) {
            $char = $text[$i];

            if ($char === '"' || $char === "'") {
                $i = $this->endOfString($text, $i + 1, $length, $char);

                if ($i === null) {
                    return null;
                }

                continue;
            }

            if ($char === '{') {
                return $i;
            }
        }

        return null;
    }

    /**
     * Return the offset of the brace matching the opening brace.
     *
     * @param string $text    The text to scan.
     * @param int    $start   The offset after the opening brace.
     * @param int    $length  The length of the text.
     *
     * @return int|null The offset of the matching closing brace, or null
     *                  when the braces never balance.
     */
    private function matchingBrace(string $text, int $start, int $length): ?int
    {
        $depth = 1;

        for ($i = $start; $i < $length; $i++) {
            $char = $text[$i];

            if ($char === '"' || $char === "'") {
                $end = $this->endOfString($text, $i + 1, $length, $char);

                if ($end === null) {
                    return null;
                }

                $i = $end;

                continue;
            }

            if ($char === '{') {
                $depth++;

                continue;
            }

            if ($char === '}') {
                $depth--;

                if ($depth === 0) {
                    return $i;
                }
            }
        }

        return null;
    }

    /**
     * Return the offset of the closing quote of a string literal.
     *
     * @param string $text   The text to scan.
     * @param int    $start  The offset after the opening quote.
     * @param int    $length The length of the text.
     * @param string $quote  The quote character.
     *
     * @return int|null The offset of the closing quote, or null when the
     *                  string is unterminated.
     */
    private function endOfString(string $text, int $start, int $length, string $quote): ?int
    {
        for ($i = $start; $i < $length; $i++) {
            if ($text[$i] === '\\') {
                $i++;

                continue;
            }

            if ($text[$i] === $quote) {
                return $i;
            }
        }

        return null;
    }

    /**
     * Parse the top-level properties of an object interior.
     *
     * Splits the interior at top-level commas (outside strings and nested
     * braces and brackets), splits each segment into a key and a value at
     * the first top-level colon, and parses each value. The first
     * occurrence of a key wins.
     *
     * @param string $interior The object interior between the braces.
     *
     * @return array<string, mixed> The parsed top-level properties.
     */
    private function topLevelProperties(string $interior): array
    {
        $properties = [];
        $length = strlen($interior);
        $depth = 0;
        $quote = null;
        $escaped = false;
        $segmentStart = 0;

        for ($i = 0; $i < $length; $i++) {
            $char = $interior[$i];

            if ($quote !== null) {
                if ($escaped) {
                    $escaped = false;
                } elseif ($char === '\\') {
                    $escaped = true;
                } elseif ($char === $quote) {
                    $quote = null;
                }

                continue;
            }

            if ($char === '"' || $char === "'") {
                $quote = $char;

                continue;
            }

            if ($char === '{' || $char === '[') {
                $depth++;

                continue;
            }

            if ($char === '}' || $char === ']') {
                $depth--;

                continue;
            }

            if ($char === ',' && $depth === 0) {
                $this->addProperty($properties, substr($interior, $segmentStart, $i - $segmentStart));
                $segmentStart = $i + 1;
            }
        }

        $this->addProperty($properties, substr($interior, $segmentStart));

        return $properties;
    }

    /**
     * Parse a single key/value segment into the properties array.
     *
     * @param array<string, mixed> $properties The properties collected so
     *                                         far.
     * @param string               $segment    The key/value segment.
     *
     * @return void
     */
    private function addProperty(array &$properties, string $segment): void
    {
        $segment = trim($segment);

        if ($segment === '') {
            return;
        }

        $colon = $this->indexOfColon($segment);

        if ($colon === null) {
            return;
        }

        $key = $this->parseKey(substr($segment, 0, $colon));

        if ($key === null || isset($properties[$key])) {
            return;
        }

        $properties[$key] = $this->parseValue(substr($segment, $colon + 1));
    }

    /**
     * Return the offset of the first unquoted colon in a segment.
     *
     * @param string $segment The key/value segment.
     *
     * @return int|null The offset of the colon, or null when none exists
     *                  outside a string literal.
     */
    private function indexOfColon(string $segment): ?int
    {
        $length = strlen($segment);

        for ($i = 0; $i < $length; $i++) {
            $char = $segment[$i];

            if ($char === '"' || $char === "'") {
                $end = $this->endOfString($segment, $i + 1, $length, $char);

                if ($end === null) {
                    return null;
                }

                $i = $end;

                continue;
            }

            if ($char === ':') {
                return $i;
            }
        }

        return null;
    }

    /**
     * Parse a property key.
     *
     * A key is either a quoted string literal or a JavaScript identifier.
     * Returns null when the text is neither.
     *
     * @param string $text The key text.
     *
     * @return string|null The parsed key, or null when unparseable.
     */
    private function parseKey(string $text): ?string
    {
        $text = trim($text);

        if ($text === '') {
            return null;
        }

        if ($text[0] === '"' || $text[0] === "'") {
            return $this->readString($text);
        }

        if (preg_match('/^[A-Za-z_$][A-Za-z0-9_$]*$/', $text) === 1) {
            return $text;
        }

        return null;
    }

    /**
     * Parse a property value.
     *
     * Handles object literals (parsed recursively into an array), string
     * literals, booleans, null, and numbers. Unparseable values yield
     * null; they are skipped, never guessed.
     *
     * @param string $text The value text.
     *
     * @return mixed The parsed value, or null when unparseable.
     */
    private function parseValue(string $text): mixed
    {
        $text = trim($text);

        if ($text === '') {
            return null;
        }

        if ($text[0] === '{') {
            $interior = $this->objectInterior($text);

            return $interior === null ? null : $this->topLevelProperties($interior);
        }

        if ($text[0] === '"' || $text[0] === "'") {
            return $this->readString($text);
        }

        if ($text === 'true') {
            return true;
        }

        if ($text === 'false') {
            return false;
        }

        if ($text === 'null') {
            return null;
        }

        if (preg_match('/^-?\d+(\.\d+)?$/', $text) === 1) {
            return str_contains($text, '.') ? (float) $text : (int) $text;
        }

        return null;
    }

    /**
     * Read and unescape a quoted string literal.
     *
     * The first character must be the opening quote. Returns null when the
     * string is unterminated or not a single string literal.
     *
     * @param string $text The string literal text.
     *
     * @return string|null The unescaped string value, or null when
     *                     malformed.
     */
    private function readString(string $text): ?string
    {
        $quote = $text[0];
        $length = strlen($text);

        for ($i = 1; $i < $length; $i++) {
            if ($text[$i] === '\\') {
                $i++;

                continue;
            }

            if ($text[$i] === $quote) {
                return $this->unescapeString(substr($text, 1, $i - 1));
            }
        }

        return null;
    }

    /**
     * Unescape the interior of a quoted string literal.
     *
     * Resolves the JSON and JavaScript escape sequences for quotes,
     * backslashes, slashes, and the common control characters. Unknown
     * escape sequences are preserved literally.
     *
     * @param string $value The raw string interior.
     *
     * @return string The unescaped string value.
     */
    private function unescapeString(string $value): string
    {
        $escapes = [
            '\\\\' => '\\',
            '\\"' => '"',
            "\\'" => "'",
            '\\/' => '/',
            '\\n' => "\n",
            '\\t' => "\t",
            '\\r' => "\r",
            '\\b' => "\x08",
            '\\f' => "\x0C",
        ];

        return strtr($value, $escapes);
    }
}
