<?php

declare(strict_types=1);

namespace App\Modules\Detection\Drupal\Rules;

use DOMDocument;

/**
 * Detects Drupal via well-known asset paths in HTML element attributes.
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and only <link href>, <script
 *   src>, and <img src> attributes are inspected.
 * - Each attribute value is lowered and searched, case-insensitively, for
 *   a known Drupal asset path. The first matching path wins and is
 *   recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to asset URLs only. No
 *   JavaScript detection, no meta tag inspection, and no HTTP requests
 *   are performed.
 * - Parser warnings are suppressed during DOM construction, errors are
 *   cleared, and the previous libxml error state is always restored,
 *   keeping the rule side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 * - The rule is stateless and deterministic: given the same input, it
 *   always returns the same result.
 */
final readonly class AssetPathRule implements RuleInterface
{
    private const WEIGHT = 20;

    private const PATHS = [
        '/sites/default/files/',
        '/core/misc/',
        '/core/assets/',
        '/modules/custom/',
        '/themes/custom/',
    ];

    private const TAG_ATTRIBUTE_MAP = [
        'link' => 'href',
        'script' => 'src',
        'img' => 'src',
    ];

    /**
     * Evaluate the HTML content for Drupal asset paths.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        if (trim($html) === '') {
            return $this->noMatch();
        }

        $dom = new DOMDocument();

        $oldUseErrors = libxml_use_internal_errors(true);

        $dom->loadHTML($html);

        libxml_clear_errors();

        libxml_use_internal_errors($oldUseErrors);

        foreach (self::TAG_ATTRIBUTE_MAP as $tagName => $attributeName) {
            $elements = $dom->getElementsByTagName($tagName);

            foreach ($elements as $element) {
                $value = $element->getAttribute($attributeName);

                if ($value === '') {
                    continue;
                }

                $value = strtolower($value);

                foreach (self::PATHS as $path) {
                    if (str_contains($value, $path)) {
                        return [
                            'matched' => true,
                            'weight' => self::WEIGHT,
                            'metadata' => [
                                'asset_path' => $path,
                            ],
                        ];
                    }
                }
            }
        }

        return $this->noMatch();
    }

    /**
     * @return array{matched: false, weight: 20, metadata: array<string, mixed>}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'weight' => self::WEIGHT,
            'metadata' => [],
        ];
    }
}
