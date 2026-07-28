<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

/**
 * Detects Shopify by identifying the official HTML generator meta tag.
 *
 * Matches <meta name="generator" content="Shopify"> regardless of
 * attribute order, quote style, or whitespace variation, using a
 * case-insensitive search.
 */
final class MetaGeneratorRule implements RuleInterface
{
    private const CONFIDENCE = 15;

    private const PATTERN = '/<meta\s+(?=.*name=["\']generator["\'])(?=.*content=["\']Shopify["\'])[^>]*>/i';

    /**
     * Evaluate the HTML for a Shopify generator meta tag.
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
                'shopify_generator' => true,
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
