<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

/**
 * Detects Webflow via JavaScript fingerprints in the HTML source.
 *
 * Performs simple case-insensitive string searches for well-known
 * Webflow JS identifiers.  No DOM parsing or HTTP requests.
 */
final readonly class GlobalJsRule implements RuleInterface
{
    private const CONFIDENCE = 25;

    private const FINGERPRINTS = [
        'webflow.js',
        'window.Webflow',
        'Webflow.require(',
        'Webflow.push(',
    ];

    /**
     * Evaluate the HTML content for Webflow JavaScript fingerprints.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        $lower = strtolower($html);

        foreach (self::FINGERPRINTS as $fingerprint) {
            if (str_contains($lower, strtolower($fingerprint))) {
                return [
                    'matched' => true,
                    'confidence' => self::CONFIDENCE,
                    'metadata' => [
                        'js_fingerprint' => $fingerprint,
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
