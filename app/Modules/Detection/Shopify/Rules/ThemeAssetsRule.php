<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying common Shopify Online Store 2.0 theme
 * asset filenames referenced in HTML.
 *
 * Complements ShopifyAssetsRule by matching well-known theme filenames
 * rather than path structures.
 */
final class ThemeAssetsRule implements RuleInterface
{
    private const CONFIDENCE = 15;

    private const PATTERN = '/\b(?:base\.css|theme\.css|theme\.min\.css|theme\.js|theme\.min\.js|global\.js|vendor\.js|constants\.js|animations\.js|details-disclosure\.js|details-modal\.js|predictive-search\.js|component-card\.css|component-price\.css|component-slider\.css|component-cart\.css|component-search\.css|quick-add\.js|cart\.js|product-form\.js)\b/i';

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
