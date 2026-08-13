<?php

declare(strict_types=1);

namespace App\Modules\Detection\Ghost\Rules;

/**
 * Detects Ghost by identifying well-known JavaScript fingerprints
 * embedded in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   Ghost-specific JavaScript identifiers using simple string matching
 *   only.
 * - The comparison is case-insensitive and the first matching fingerprint
 *   wins; the matched fingerprint is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: this rule is a pure string scan. It performs
 *   no HTML parsing, no DOM construction, no HTML traversal, no regular
 *   expressions, and no HTTP requests.
 * - An empty response body short-circuits to a no-match before any
 *   scanning work.
 * - The rule is stateless, side-effect free, and deterministic: given the
 *   same input, it always returns the same result.
 */
final readonly class ScriptFingerprintRule implements RuleInterface
{
    private const WEIGHT = 25;

    private const FINGERPRINTS = [
        'window.Ghost',
        'ghost.init',
        'ghost-sdk',
    ];

    /**
     * Evaluate the HTML for Ghost JavaScript fingerprints.
     *
     * @param string $html The raw HTML response body.
     * @param string $url  The final request URL (unused in this rule).
     *
     * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
     */
    public function evaluate(string $html, string $url): array
    {
        if (trim($html) === '') {
            return $this->noMatch();
        }

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
