<?php

declare(strict_types=1);

namespace App\Modules\Detection\Squarespace\Rules;

use DOMDocument;

/**
 * Detects Squarespace by identifying well-known HTML data attributes
 * embedded in the document.
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and every element is inspected.
 * - Each element is checked for the presence of any known
 *   Squarespace-specific data attribute. The first matching attribute
 *   wins and is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to HTML attributes. No
 *   JavaScript parsing, no meta tag inspection, no regular expressions,
 *   and no HTTP requests are performed.
 * - Parser warnings are suppressed during DOM construction, errors are
 *   cleared, and the previous libxml error state is always restored,
 *   keeping the rule side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 * - The rule is stateless and deterministic: given the same input, it
 *   always returns the same result.
 */
final readonly class DataAttributesRule implements RuleInterface
{
    private const WEIGHT = 15;

    private const ATTRIBUTES = [
        'data-animation-role',
        'data-section-id',
        'data-current-styles',
    ];

    /**
     * Evaluate the HTML content for Squarespace data attributes.
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

        $elements = $dom->getElementsByTagName('*');

        foreach ($elements as $element) {
            foreach (self::ATTRIBUTES as $attribute) {
                if ($element->hasAttribute($attribute)) {
                    return [
                        'matched' => true,
                        'weight' => self::WEIGHT,
                        'metadata' => [
                            'sq_attribute' => $attribute,
                        ],
                    ];
                }
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
