<?php

declare(strict_types=1);

namespace App\Modules\Detection\Wix\Rules;

use DOMDocument;

/**
 * Detects Wix via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "Wix" (case-insensitive).
 * Accepts values such as "Wix.com Website Builder", "Wix", or
 * "Built with Wix".
 *
 * Design philosophy:
 *
 * - Detection is confined to a single, unambiguous signal: the generator
 *   meta tag. No other markup is inspected.
 * - The match is a case-insensitive substring check, so generator
 *   strings that embed "Wix" in longer phrases still match without
 *   relying on exact-value comparison.
 * - Parser warnings are suppressed during DOM construction and the
 *   previous libxml error state is always restored, keeping the rule
 *   side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 */
final readonly class MetaGeneratorRule implements RuleInterface
{
    private const WEIGHT = 35;

    private const GENERATOR_NAME = 'generator';

    private const TARGET = 'Wix';

    /**
     * Evaluate the HTML content for a Wix generator meta tag.
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
                        'generator' => 'Wix',
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
