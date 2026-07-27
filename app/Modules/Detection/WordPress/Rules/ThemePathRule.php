<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

/**
 * Detects WordPress theme paths from the provided HTML source.
 *
 * Identifies references to /wp-content/themes/ and extracts
 * the theme slug for downstream use by ThemeStyleRule.
 */
final class ThemePathRule implements RuleInterface
{
    /**
     * Evaluate the HTML for WordPress theme path references.
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
        $pattern = '/\/wp-content\/themes\/([^\/?"\'\s>]+)([^"\'\s>]*)/i';

        if (preg_match($pattern, $html, $matches) !== 1) {
            return $this->noMatch();
        }

        $slug = strtolower(trim($matches[1]));

        if ($slug === '') {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => 35,
            'metadata' => [
                'theme_slug' => $slug,
                'theme_directory' => '/wp-content/themes/' . $slug . '/',
                'theme_asset' => $matches[0],
            ],
        ];
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
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
