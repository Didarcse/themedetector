<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Parsers;

/**
 * Extracts structured Shopify theme asset metadata from HTML.
 *
 * This class is purely a parser — it does not perform detection.
 * Detection is handled by ThemeAssetsRule.  This parser extracts
 * the theme ID and unique asset filenames from Shopify asset paths
 * found in the HTML source.
 */
final class ThemeAssetParser
{
    private const THEME_PATTERN = '/\/t\/([a-zA-Z0-9_-]+)\/assets\//i';

    private const ASSET_PATTERN = '/assets\/([a-zA-Z0-9_\.-]+\.(?:css|js))/i';

    /**
     * Parse the HTML for Shopify theme asset metadata.
     *
     * @param string $html The complete HTML source.
     *
     * @return array{
     *     theme_id: string|null,
     *     asset_files: list<string>
     * }
     */
    public function parse(string $html): array
    {
        return [
            'theme_id' => $this->extractThemeId($html),
            'asset_files' => $this->extractAssetFiles($html),
        ];
    }

    /**
     * Extract the Shopify theme identifier from asset paths.
     *
     * Looks for the pattern /t/<id>/assets/ where <id> may be numeric
     * or alphanumeric (e.g. "8", "main", "demo").
     *
     * @return string|null
     */
    private function extractThemeId(string $html): ?string
    {
        if (preg_match(self::THEME_PATTERN, $html, $matches) !== 1) {
            return null;
        }

        return $matches[1];
    }

    /**
     * Extract unique Shopify theme asset filenames from the HTML.
     *
     * Only filenames located inside /assets/ paths are extracted,
     * preserving discovery order and ignoring duplicates, query
     * strings, and hashes.
     *
     * @return list<string>
     */
    private function extractAssetFiles(string $html): array
    {
        if (preg_match_all(self::ASSET_PATTERN, $html, $matches) < 1) {
            return [];
        }

        $files = [];
        $seen = [];

        foreach ($matches[1] as $file) {
            $file = trim($file);

            if ($file === '' || isset($seen[$file])) {
                continue;
            }

            $seen[$file] = true;
            $files[] = $file;
        }

        return $files;
    }
}
