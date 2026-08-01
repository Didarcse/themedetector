<?php

declare(strict_types=1);

namespace App\Modules\Detection\Wix\Rules;

/**
 * Detects Wix by identifying well-known JavaScript fingerprints embedded
 * in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is searched for a fixed set of Wix-specific
 *   JavaScript identifiers using simple string matching only.
 * - The comparison is case-insensitive and the first matching fingerprint
 *   wins; the matched fingerprint is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - This rule performs no HTML parsing, no DOM manipulation, no regex and
 *   no HTTP. It is a pure, deterministic string scan, which keeps it fast
 *   and independent of any markup quirks in the response body.
 * - The rule is stateless and side-effect free: given the same input, it
 *   always returns the same result.
 */
final readonly class GlobalJsRule implements RuleInterface
{
    private const WEIGHT = 25;

    private const FINGERPRINTS = [
        'window.viewerModel',
        'window.wixBiSession',
        'window.clientSideRender',
        'window.__INITIAL_STATE__',
        'window.tb',
    ];

    /**
     * Evaluate the HTML for Wix JavaScript fingerprints.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        $normalizedHtml = strtolower($html);

        foreach (self::FINGERPRINTS as $fingerprint) {
            if (str_contains($normalizedHtml, strtolower($fingerprint))) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'js_fingerprint' => $fingerprint,
                    ],
                ];
            }
        }

        return $this->noMatch();
    }

    /**
     * @return array{matched: false, weight: 25, metadata: array<string, mixed>}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'weight' => self::WEIGHT,
            'metadata' => [],
        ];
    }
}
