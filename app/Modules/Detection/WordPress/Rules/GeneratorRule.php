<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

/**
 * Detects the WordPress generator meta tag in HTML.
 *
 * Matches <meta name="generator" content="WordPress ..."> variants
 * with case-insensitive comparison.
 */
final class GeneratorRule implements RuleInterface
{
    /**
     * Evaluate the HTML for a WordPress generator meta tag.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    public function evaluate(string $html, string $url): array
    {
        $tagPattern = '/<meta\s+[^>]*>/i';

        if (preg_match_all($tagPattern, $html, $tags) < 1) {
            return $this->noMatch();
        }

        $namePattern = '/name\s*=\s*["\']generator["\']/i';
        $contentPattern = '/content\s*=\s*["\']([^"\']*)["\']/i';

        foreach ($tags[0] as $tag) {
            if (preg_match($namePattern, $tag) !== 1) {
                continue;
            }

            if (preg_match($contentPattern, $tag, $contentMatch) !== 1) {
                continue;
            }

            $generator = trim($contentMatch[1]);

            if ($generator === '') {
                continue;
            }

            if (stripos($generator, 'WordPress') === false) {
                continue;
            }

            return [
                'matched' => true,
                'confidence' => 20,
                'metadata' => [
                    'generator' => $generator,
                ],
            ];
        }

        return $this->noMatch();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'confidence' => 0,
            'metadata' => [],
        ];
    }
}
