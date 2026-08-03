<?php

declare(strict_types=1);

namespace App\Modules\Detection\TYPO3\Rules;

use DOMDocument;

/**
 * Detects TYPO3 via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "TYPO3" (case-insensitive).
 * Accepts values such as "TYPO3", "TYPO3 CMS",
 * "Powered by TYPO3", and "Built with TYPO3".
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and every <meta> element is
 *   inspected.
 * - Only the generator meta tag is considered: elements whose name
 *   differs from "generator" (case-insensitive) are skipped.
 * - A match occurs when the content value contains the target string,
 *   matched as a case-insensitive substring.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to the generator meta
 *   tag. No other markup, JavaScript, regex, or HTTP is involved.
 * - Parser warnings are suppressed during DOM construction and the
 *   previous libxml error state is always restored, keeping the rule
 *   side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 * - The rule is stateless and deterministic: given the same input, it
 *   always returns the same result.
 */
final readonly class MetaGeneratorRule implements RuleInterface
{
    private const WEIGHT = 35;

    private const GENERATOR_NAME = 'generator';

    private const TARGET = 'TYPO3';

    /**
     * Evaluate the HTML content for a TYPO3 generator meta tag.
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

        $dom = new DOMDocument();

        $oldUseErrors = libxml_use_internal_errors(true);

        $dom->loadHTML($html);

        libxml_clear_errors();

        libxml_use_internal_errors($oldUseErrors);

        $metas = $dom->getElementsByTagName('meta');

        foreach ($metas as $meta) {
            $name = $meta->getAttribute('name');

            if (strcasecmp($name, self::GENERATOR_NAME) !== 0) {
                continue;
            }

            $content = $meta->getAttribute('content');

            if (stripos($content, self::TARGET) !== false) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'generator' => 'TYPO3',
                    ],
                ];
            }
        }

        return $this->noMatch();
    }

    /**
     * @return array{matched: false, weight: 35, metadata: array<string, mixed>}
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
