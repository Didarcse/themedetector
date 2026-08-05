<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

/**
 * Detects WordPress plugins referenced in HTML by scanning asset URLs
 * that contain /wp-content/plugins/.
 *
 * Extracts unique plugin slugs, sorted alphabetically, preserving
 * their original spelling.
 */
final class PluginPathRule implements RuleInterface
{
    private const PLUGIN_PATH_PATTERN = '/\/wp-content\/plugins\/([^\/?"\'\s>]+)/i';

    /**
     * Evaluate the HTML for WordPress plugin path references.
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
        if (preg_match_all(self::PLUGIN_PATH_PATTERN, $html, $matches) < 1) {
            return $this->noMatch();
        }

        $plugins = [];

        foreach ($matches[1] as $slug) {
            $slug = trim($slug);

            if ($slug === '') {
                continue;
            }

            $plugins[$slug] = true;
        }

        if ($plugins === []) {
            return $this->noMatch();
        }

        $plugins = array_keys($plugins);
        sort($plugins);

        return [
            'matched' => true,
            'confidence' => 30,
            'metadata' => [
                'plugins' => $plugins,
            ],
        ];
    }

    /**
     * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
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
