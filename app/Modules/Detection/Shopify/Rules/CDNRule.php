<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying official Shopify CDN asset URLs in HTML.
 *
 * Performs a case-insensitive search for cdn.shopify.com or
 * cdn.shopifycdn.net in the provided HTML source.
 */
final class CDNRule implements RuleInterface
{
    private const PATTERN = '/(?:cdn\.shopify\.com|cdn\.shopifycdn\.net)/i';

    /**
     * Evaluate the HTML for Shopify CDN references.
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
            'confidence' => 30,
            'metadata' => [
                'shopify_cdn' => true,
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
