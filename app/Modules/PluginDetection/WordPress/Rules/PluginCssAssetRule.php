<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress\Rules;

/**
 * Detects WordPress plugins referenced by linked CSS assets.
 *
 * PluginCssAssetRule is the canonical CSS-asset detection rule for the
 * Plugin Detection Engine. It scans the HTML already carried by the
 * detection context for stylesheet link tags, extracts the plugin slugs
 * referenced by /wp-content/plugins/ asset URLs inside their href
 * attributes, and returns them sorted alphabetically, preserving their
 * original spelling.
 *
 * Responsibilities:
 *
 * - Scan the HTML for linked CSS assets (stylesheet link tags).
 * - Extract the plugin slugs referenced by their href attributes.
 * - Discard references that cannot be plugin slugs: malformed names,
 *   wildcard patterns, and well-known non-plugin artifact directories.
 * - Return the unique, valid slugs, sorted alphabetically.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for WordPress
 *   plugin CSS asset references is the only concern. It performs no HTTP
 *   requests, no metadata mapping, no confidence aggregation beyond the
 *   rule's own score, and no workflow orchestration. The only decision
 *   it applies is slug validity: references that are not valid plugin
 *   slugs are discarded.
 * - Stateless, deterministic, and side-effect free: given the same HTML
 *   and URL, it always returns the same result.
 * - Platform-specific implementation: this rule knows it targets
 *   WordPress plugin CSS assets.
 *
 * The class belongs to the Plugin Detection module and knows nothing
 * about PluginMetadata, PluginDetectionResult, or the detection workflow
 * that surrounds it.
 */
final readonly class PluginCssAssetRule
{
    private const LINK_TAG_PATTERN = '/<link\b[^>]*>/i';

    private const STYLESHEET_REL_PATTERN = '/\brel=["\']([^"\']*\bstylesheet\b[^"\']*)["\']/i';

    private const HREF_PATTERN = '/\bhref=["\']([^"\']+)["\']/i';

    private const PLUGIN_PATH_PATTERN = '/\/wp-content\/plugins\/([^\/?"\'\s>]+)/i';

    private const VALID_SLUG_PATTERN = '/^[a-zA-Z0-9][a-zA-Z0-9_.\-]*$/';

    /**
     * Well-known directories that appear directly under
     * /wp-content/plugins/ in asset URLs but are never plugin slugs.
     *
     * Combined and minified asset URLs routinely reference build,
     * dependency, and asset directories (for example
     * /wp-content/plugins/dist/...) that are not plugins; discarding
     * them prevents false-positive plugin detections.
     *
     * @var list<string>
     */
    private const NON_PLUGIN_DIRECTORIES = [
        'assets',
        'build',
        'dist',
        'node_modules',
        'vendor',
    ];

    /**
     * Evaluate the HTML for WordPress plugin CSS asset references.
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
        if (preg_match_all(self::LINK_TAG_PATTERN, $html, $matches) < 1) {
            return $this->noMatch();
        }

        $plugins = [];

        foreach ($matches[0] as $tag) {
            if (preg_match(self::STYLESHEET_REL_PATTERN, $tag) !== 1) {
                continue;
            }

            if (preg_match(self::HREF_PATTERN, $tag, $href) !== 1) {
                continue;
            }

            if (preg_match_all(self::PLUGIN_PATH_PATTERN, $href[1], $paths) < 1) {
                continue;
            }

            foreach ($paths[1] as $slug) {
                $slug = trim($slug);

                if ($slug === '' || !$this->isPluginSlug($slug)) {
                    continue;
                }

                $plugins[$slug] = true;
            }
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
     * Determine whether a raw path capture is a usable plugin slug.
     *
     * A usable slug is non-empty, matches the valid slug shape, and is
     * not a well-known non-plugin artifact directory.
     *
     * @param string $slug The trimmed raw path capture.
     *
     * @return bool True when the capture is a usable plugin slug.
     */
    private function isPluginSlug(string $slug): bool
    {
        return preg_match(self::VALID_SLUG_PATTERN, $slug) === 1
            && !in_array($slug, self::NON_PLUGIN_DIRECTORIES, true);
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
