<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection\WordPress\Rules;

use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the PluginPathRule.
 *
 * Verifies the complete public contract of the rule: valid WordPress
 * plugin path references are detected and returned as unique, sorted
 * slugs, wildcard patterns never surface as plugin slugs, well-known
 * non-plugin artifact directories are discarded, and the canonical
 * non-match result is produced when no usable plugin reference exists.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginPathRule, no mocks, no fixtures, no filesystem,
 * and no HTTP.
 */
final class PluginPathRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private const EXPECTED_CONFIDENCE = 30;

    /**
     * Evaluate HTML with a real PluginPathRule instance.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    private function evaluate(string $html): array
    {
        return (new PluginPathRule())->evaluate($html, self::URL);
    }

    /**
     * Verify that a page referencing a single plugin path is detected.
     *
     * A script reference under /wp-content/plugins/ yields a match that
     * carries the plugin slug and the fixed rule confidence.
     */
    public function test_detects_single_plugin_path(): void
    {
        $result = $this->evaluate(
            '<script src="/wp-content/plugins/contact-form-7/includes/js/script.js"></script>',
        );

        self::assertTrue($result['matched']);
        self::assertSame(self::EXPECTED_CONFIDENCE, $result['confidence']);
        self::assertSame(
            ['plugins' => ['contact-form-7']],
            $result['metadata'],
        );
    }

    /**
     * Verify that unique plugin slugs are returned sorted alphabetically.
     *
     * Duplicate references collapse into a single slug, and the slugs are
     * ordered alphabetically regardless of document order.
     */
    public function test_returns_unique_slugs_sorted_alphabetically(): void
    {
        $result = $this->evaluate(
            '<script src="/wp-content/plugins/woocommerce/assets/js/script.js"></script>'
            . '<link href="/wp-content/plugins/akismet/akismet.css">'
            . '<script src="/wp-content/plugins/contact-form-7/includes/js/script.js"></script>',
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['plugins' => ['akismet', 'contact-form-7', 'woocommerce']],
            $result['metadata'],
        );
    }

    /**
     * Verify that no plugin path references produce the canonical
     * non-match result.
     *
     * HTML without any /wp-content/plugins/ reference yields matched =
     * false, confidence = 0, and empty metadata.
     */
    public function test_returns_non_match_when_no_plugin_paths(): void
    {
        $result = $this->evaluate('<html><head></head><body></body></html>');

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that a wildcard plugin path reference is never surfaced.
     *
     * Sites embed URL-match configs (for example site-wide caching
     * rules) that reference "/wp-content/plugins/*". The wildcard is not
     * a plugin slug and must never be reported; a page containing only
     * such a reference produces the canonical non-match result.
     */
    public function test_ignores_wildcard_plugin_path_reference(): void
    {
        $result = $this->evaluate(
            '{"not":{"href_matches":["/wp-*.php","/wp-admin/*",'
            . '"/wp-content/uploads/*","/wp-content/*",'
            . '"/wp-content/plugins/*","/wp-content/themes/*"]}}',
        );

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that a wildcard reference is ignored while real plugins are
     * still detected.
     *
     * A page carrying both a URL-match config with the wildcard and real
     * plugin asset references reports only the real plugins.
     */
    public function test_ignores_wildcard_and_keeps_real_plugins(): void
    {
        $result = $this->evaluate(
            '{"href_matches":["/wp-content/plugins/*"]}'
            . '<script src="/wp-content/plugins/gutenberg/build/index.js"></script>',
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['plugins' => ['gutenberg']],
            $result['metadata'],
        );
    }

    /**
     * Verify that build-artifact directories under /wp-content/plugins/
     * are never surfaced as plugin slugs.
     *
     * Combined and minified asset URLs routinely reference directories
     * such as /wp-content/plugins/dist/... and /wp-content/plugins/
     * node_modules/... that are not plugins. Discarding them prevents
     * false-positive detections such as the "dist" primary plugin that
     * woocommerce.com previously produced.
     */
    public function test_ignores_build_artifact_directories(): void
    {
        $result = $this->evaluate(
            '<script src="https://example.com/_static/??/wp-content/plugins/dist/woothemes/wte.min.js,'
            . '/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js"></script>',
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['plugins' => ['woocommerce']],
            $result['metadata'],
        );
    }

    /**
     * Verify that every known non-plugin artifact directory is ignored.
     */
    #[DataProvider('nonPluginDirectoryProvider')]
    public function test_ignores_each_non_plugin_directory(string $directory): void
    {
        $result = $this->evaluate(
            '<link href="/wp-content/plugins/' . $directory . '/theme.css">'
            . '<script src="/wp-content/plugins/real-plugin/index.js"></script>',
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['plugins' => ['real-plugin']],
            $result['metadata'],
        );
    }

    /**
     * @return array<string, array{directory: string}>
     */
    public static function nonPluginDirectoryProvider(): array
    {
        return [
            'assets' => ['directory' => 'assets'],
            'build' => ['directory' => 'build'],
            'dist' => ['directory' => 'dist'],
            'node_modules' => ['directory' => 'node_modules'],
            'vendor' => ['directory' => 'vendor'],
        ];
    }

    /**
     * Verify that a page referencing only artifact directories produces
     * the canonical non-match result.
     */
    public function test_returns_non_match_when_only_artifact_directories(): void
    {
        $result = $this->evaluate(
            '<link href="/wp-content/plugins/dist/theme.css">'
            . '<script src="/wp-content/plugins/node_modules/lib.js"></script>',
        );

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that the evaluation is deterministic.
     *
     * Repeated evaluation of the same HTML always produces the same
     * result in every observable field.
     */
    public function test_evaluation_is_deterministic(): void
    {
        $html = '<script src="/wp-content/plugins/woocommerce/assets/js/script.js"></script>';

        $first = $this->evaluate($html);
        $second = $this->evaluate($html);

        self::assertSame($first, $second);
    }
}
