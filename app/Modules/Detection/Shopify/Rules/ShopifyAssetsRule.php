<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying Shopify-specific asset path structures
 * in HTML.
 *
 * Matches any of the known Shopify CDN path patterns such as /s/files/,
 * /cdn/shop/, /cdn/shopifycloud/, and /t/<number>/assets/.
 */
final class ShopifyAssetsRule implements RuleInterface
{
    private const CONFIDENCE = 25;

    private const PATTERN = '/(?:\/s\/files\/|\/cdn\/shop\/|\/cdn\/shopifycloud\/|\/t\/\d+\/assets\/)/i';

    /**
     * Evaluate the HTML for Shopify asset path references.
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
                'shopify_assets' => true,
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
