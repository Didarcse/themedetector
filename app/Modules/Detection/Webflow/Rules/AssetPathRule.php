<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

use DOMDocument;

/**
 * Detects Webflow via known asset hostnames in HTML element
 * attributes.
 *
 * Inspects <link href>, <script src>, and <img src> for URLs
 * pointing to Webflow infrastructure.
 */
final readonly class AssetPathRule implements RuleInterface
{
    private const CONFIDENCE = 15;

    private const HOSTNAMES = [
        'assets.website-files.com',
        'cdn.prod.website-files.com',
        'uploads-ssl.webflow.com',
    ];

    private const TAG_ATTRIBUTE_MAP = [
        'link' => 'href',
        'script' => 'src',
        'img' => 'src',
    ];

    /**
     * Evaluate the HTML content for Webflow asset hostnames.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        $dom = new DOMDocument;

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

                foreach (self::HOSTNAMES as $hostname) {
                    if (str_contains($value, $hostname)) {
                        return [
                            'matched' => true,
                            'confidence' => self::CONFIDENCE,
                            'metadata' => [
                                'asset_host' => $hostname,
                            ],
                        ];
                    }
                }
            }
        }

        return [
            'matched' => false,
            'confidence' => self::CONFIDENCE,
            'metadata' => [],
        ];
    }
}
