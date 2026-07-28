<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

use DOMDocument;

/**
 * Detects Webflow via the default branding badge.
 *
 * Inspects all <a> elements for Webflow badge indicators in the
 * href, class attribute, or anchor text.
 */
final readonly class WebflowBadgeRule implements RuleInterface
{
    private const WEIGHT = 10;

    /**
     * Evaluate the HTML content for a Webflow branding badge.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        $dom = new DOMDocument;

        $oldUseErrors = libxml_use_internal_errors(true);

        $dom->loadHTML($html);

        libxml_clear_errors();

        libxml_use_internal_errors($oldUseErrors);

        $anchors = $dom->getElementsByTagName('a');

        foreach ($anchors as $anchor) {
            $indicator = $this->matchIndicator($anchor);

            if ($indicator !== null) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'badge_indicator' => $indicator,
                    ],
                ];
            }
        }

        return [
            'matched' => false,
            'weight' => self::WEIGHT,
            'metadata' => [],
        ];
    }

    /**
     * Check a single anchor element for any badge indicator.
     *
     * @param \DOMElement $anchor The anchor element to inspect.
     *
     * @return string|null The matched indicator, or null if none found.
     */
    private function matchIndicator(\DOMElement $anchor): ?string
    {
        $href = strtolower($anchor->getAttribute('href'));

        if (str_contains($href, 'webflow.com')) {
            return 'webflow.com';
        }

        $class = strtolower($anchor->getAttribute('class'));

        if (str_contains($class, 'webflow-badge')) {
            return 'webflow-badge';
        }

        $text = strtolower(trim($anchor->textContent));

        if (str_contains($text, 'made in webflow')) {
            return 'Made in Webflow';
        }

        return null;
    }
}
