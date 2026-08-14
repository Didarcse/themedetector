<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying distinctive Shopify Online Store 2.0
 * theme asset filenames referenced in HTML.
 *
 * Complements ShopifyAssetsRule by matching well-known Dawn theme
 * filenames rather than path structures.  Only filenames that are
 * strongly associated with Shopify's default Dawn theme are considered;
 * generic names such as theme.css, base.css, global.js, vendor.js or
 * cart.js are deliberately excluded because they appear on unrelated
 * sites.
 */
final class ThemeAssetsRule implements RuleInterface
{
    private const CONFIDENCE = 15;

    private const PATTERN = '/\b(?:details-disclosure\.js|details-modal\.js|predictive-search\.js'
        . '|component-card\.css|component-price\.css|component-slider\.css'
        . '|component-cart\.css|component-search\.css|quick-add\.js|product-form\.js)\b/i';

    /**
     * Evaluate the HTML for Shopify theme asset filename references.
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
                'shopify_theme_assets' => true,
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
