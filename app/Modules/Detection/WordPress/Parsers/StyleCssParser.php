<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Parsers;

/**
 * Parses a WordPress style.css header block and extracts theme metadata.
 *
 * Operates exclusively on the provided CSS string, reading only the
 * opening comment block.  All CSS rules below the header are ignored.
 * Field names are treated case-insensitively; only the first occurrence
 * of each field is retained.
 */
final class StyleCssParser
{
    private const FIELD_MAP = [
        'theme name' => 'theme_name',
        'theme uri' => 'theme_uri',
        'version' => 'version',
        'author' => 'author',
        'author uri' => 'author_uri',
    ];

    /**
     * Parse theme metadata from a style.css source.
     *
     * @param string $css The full content of a WordPress style.css file.
     *
     * @return array{
     *     theme_name: string|null,
     *     theme_uri: string|null,
     *     version: string|null,
     *     author: string|null,
     *     author_uri: string|null,
     * }
     */
    public function parse(string $css): array
    {
        $result = array_fill_keys(
            ['theme_name', 'theme_uri', 'version', 'author', 'author_uri'],
            null,
        );

        $header = $this->extractHeader($css);

        if ($header === null) {
            return $result;
        }

        $seen = [];

        foreach (preg_split('/\R/', $header) as $line) {
            $line = trim($line);
            $line = ltrim($line, '*');

            if ($line === '') {
                continue;
            }

            $colonPos = strpos($line, ':');

            if ($colonPos === false) {
                continue;
            }

            $rawKey = trim(substr($line, 0, $colonPos));
            $rawValue = trim(substr($line, $colonPos + 1));

            if ($rawKey === '' || $rawValue === '') {
                continue;
            }

            $normalizedKey = strtolower($rawKey);

            if (isset($seen[$normalizedKey])) {
                continue;
            }

            $seen[$normalizedKey] = true;

            $mapped = self::FIELD_MAP[$normalizedKey] ?? null;

            if ($mapped !== null) {
                $result[$mapped] = $rawValue;
            }
        }

        return $result;
    }

    /**
     * Extract the raw header comment block from CSS.
     *
     * @param string $css The full CSS string.
     *
     * @return string|null The header content, or null when no comment is found.
     */
    private function extractHeader(string $css): ?string
    {
        $start = strpos($css, '/*');

        if ($start === false) {
            return null;
        }

        $end = strpos($css, '*/', $start + 2);

        if ($end === false) {
            return null;
        }

        return substr($css, $start + 2, $end - $start - 2);
    }
}
