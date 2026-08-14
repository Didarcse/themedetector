<?php

declare(strict_types=1);

namespace App\Modules\Detection\Drupal\Rules;

/**
 * Detects Drupal by identifying well-known API endpoint fingerprints
 * embedded in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   Drupal-specific API endpoint identifiers using simple string matching
 *   only. Only endpoints that are distinctive to Drupal are considered;
 *   generic path tokens that commonly occur on unrelated applications
 *   (such as /node/, /entity/, or /user/login) are deliberately not
 *   treated as evidence.
 * - The comparison is case-insensitive and the first matching endpoint
 *   wins; the matched endpoint is recorded in the metadata.
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
final readonly class ApiEndpointRule implements RuleInterface
{
    private const WEIGHT = 15;

    private const ENDPOINTS = [
        '/jsonapi/',
    ];

    /**
     * Evaluate the HTML for Drupal API endpoint fingerprints.
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

        foreach (self::ENDPOINTS as $endpoint) {
            if (str_contains($normalizedHtml, strtolower($endpoint))) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'api_endpoint' => $endpoint,
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
