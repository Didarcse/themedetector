<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress\Rules;

/**
 * Detects WordPress plugins referenced in HTML by scanning asset URLs
 * that contain /wp-content/plugins/.
 *
 * PluginPathRule is the canonical plugin-path detection rule for the
 * Plugin Detection Engine. It inspects the HTML already carried by the
 * detection context, extracts the unique plugin slugs referenced by
 * /wp-content/plugins/ asset URLs, and returns them sorted
 * alphabetically, preserving their original spelling.
 *
 * Responsibilities:
 *
 * - Scan the HTML for asset URLs that contain /wp-content/plugins/.
 * - Extract the referenced plugin slugs.
 * - Return the unique slugs, sorted alphabetically.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for WordPress
 *   plugin path references is the only concern. It performs no HTTP
 *   requests, no metadata mapping, no confidence calculation, and no
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same HTML
 *   and URL, it always returns the same result.
 * - Platform-specific implementation: this rule knows it targets
 *   WordPress plugin paths.
 *
 * The class belongs to the Plugin Detection module and knows nothing
 * about PluginMetadata, PluginDetectionResult, or the detection workflow
 * that surrounds it.
 */
final readonly class PluginPathRule
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
