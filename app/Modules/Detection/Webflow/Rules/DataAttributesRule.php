<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

use DOMDocument;
use DOMXPath;

/**
 * Detects Webflow via known HTML data attributes.
 *
 * Searches every element for either data-wf-page or data-wf-site.
 */
final readonly class DataAttributesRule implements RuleInterface
{
    private const CONFIDENCE = 15;

    private const ATTRIBUTES = [
        'data-wf-page',
        'data-wf-site',
    ];

    /**
     * Evaluate the HTML content for Webflow data attributes.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        $dom = new DOMDocument();

        $oldUseErrors = libxml_use_internal_errors(true);

        $dom->loadHTML($html);

        libxml_clear_errors();

        libxml_use_internal_errors($oldUseErrors);

        $xpath = new DOMXPath($dom);

        foreach (self::ATTRIBUTES as $attribute) {
            $nodes = $xpath->query("//*[@{$attribute}]");

            if ($nodes !== false && $nodes->length > 0) {
                return [
                    'matched' => true,
                    'confidence' => self::CONFIDENCE,
                    'metadata' => [
                        'wf_attribute' => $attribute,
                    ],
                ];
            }
        }

        return [
            'matched' => false,
            'confidence' => self::CONFIDENCE,
            'metadata' => [],
        ];
    }
}
