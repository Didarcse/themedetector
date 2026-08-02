<?php

declare(strict_types=1);

namespace App\Modules\Detection\Joomla\Rules;

/**
 * Detects Joomla by identifying well-known HTML signatures embedded in
 * the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   Joomla-specific HTML identifiers using simple string matching only.
 * - The comparison is case-insensitive and the first matching signature
 *   wins; the matched signature is recorded in the metadata.
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
final readonly class HtmlSignatureRule implements RuleInterface
{
    private const WEIGHT = 15;

    private const SIGNATURES = [
        'option=com_',
        'com_content',
        'com_users',
        'com_contact',
        'joomla-toolbar-button',
    ];

    /**
     * Evaluate the HTML for Joomla HTML signatures.
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

        foreach (self::SIGNATURES as $signature) {
            if (str_contains($normalizedHtml, strtolower($signature))) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'html_signature' => $signature,
                    ],
                ];
            }
        }

        return $this->noMatch();
    }

    /**
     * @return array{matched: false, weight: 15, metadata: array<string, mixed>}
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
