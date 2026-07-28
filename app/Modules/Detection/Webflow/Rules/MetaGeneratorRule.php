<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

use DOMDocument;

/**
 * Detects Webflow via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "Webflow" (case-insensitive).
 */
final readonly class MetaGeneratorRule implements RuleInterface
{
    private const WEIGHT = 35;

    private const GENERATOR_NAME = 'Webflow';

    /**
     * Evaluate the HTML content for a Webflow generator meta tag.
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

        libxml_use_internal_errors($oldUseErrors);

        $metas = $dom->getElementsByTagName('meta');

        foreach ($metas as $meta) {
            $name = $meta->getAttribute('name');

            if (strcasecmp($name, 'generator') !== 0) {
                continue;
            }

            $content = $meta->getAttribute('content');

            if (stripos($content, self::GENERATOR_NAME) !== false) {
                return [
                    'matched' => true,
                    'weight' => self::WEIGHT,
                    'metadata' => [
                        'generator' => 'Webflow',
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
}
