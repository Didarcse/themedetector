<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying official Shopify JavaScript globals
 * in HTML.
 *
 * Performs a case-sensitive search for JavaScript identifiers such as
 * window.Shopify, Shopify.theme, Shopify.routes, and ShopifyAnalytics.
 */
final class GlobalJsRule implements RuleInterface
{
    private const CONFIDENCE = 20;

    private const PATTERN = '/(?:window\.Shopify|Shopify\.theme|Shopify\.routes|Shopify\.designMode|Shopify\.locale|Shopify\.country|Shopify\.currency|ShopifyAnalytics)/';

    /**
     * Evaluate the HTML for Shopify JavaScript fingerprints.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    public function evaluate(string $html, string $url): array
    {
        if (preg_match(self::PATTERN, $html) !== 1) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => self::CONFIDENCE,
            'metadata' => [
                'shopify_js' => true,
            ],
        ];
    }

    /**
     * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'confidence' => 0,
            'metadata' => [],
        ];
    }
}
