<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeLocator;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the DrupalThemeLocator.
 *
 * Verifies the complete public contract of the locator: a root-anchored
 * /themes/contrib/{slug}/ or /themes/custom/{slug}/ path in a resource
 * attribute yields the theme directory name, stylesheet links are scanned
 * before every other resource, the first qualifying path wins, absolute
 * URLs with query strings and fragments and URL-encoded slugs are handled,
 * and every
 * non-qualifying path — bare /themes/, /themes/contrib/ and /themes/custom/
 * without a slug, a generic first segment, the singular /theme/, non-root
 * paths such as /assets/themes/ and /wp-content/themes/, generic directory
 * names such as css and js, plain text, CSS class names, and unparseable
 * URLs — is ignored.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — a real DrupalThemeLocator and a real
 * DetectionContext — with no mocks, no filesystem, and no HTTP.
 */
final class DrupalThemeLocatorTest extends TestCase
{
    /**
     * Create a real locator instance.
     *
     * @return DrupalThemeLocator The locator under test.
     */
    private function locator(): DrupalThemeLocator
    {
        return new DrupalThemeLocator();
    }

    /**
     * Create a real detection context carrying the given HTML.
     *
     * @param string $html The HTML body to carry.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(string $html): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: $html,
            statusCode: 200,
        );
    }

    /**
     * Verify that a contrib stylesheet link yields its theme directory
     * name.
     */
    public function test_locate_returns_slug_from_contrib_stylesheet_link(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/contrib/olivero/css/style.css">'
            . '</head><body></body></html>';

        self::assertSame('olivero', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a custom stylesheet link yields its theme directory
     * name.
     */
    public function test_locate_returns_slug_from_custom_stylesheet_link(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a custom script src yields its theme directory name.
     */
    public function test_locate_returns_slug_from_script_src(): void
    {
        $html = '<html><head>'
            . '<script src="/themes/custom/newsroom/js/main.js"></script>'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a custom image src yields its theme directory name.
     */
    public function test_locate_returns_slug_from_image_src(): void
    {
        $html = '<html><body>'
            . '<img src="/themes/custom/newsroom/img/logo.png" alt="logo">'
            . '</body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an image srcset yields its theme directory name.
     */
    public function test_locate_returns_slug_from_image_srcset(): void
    {
        $html = '<html><body>'
            . '<img srcset="/themes/custom/newsroom/img/logo.png 1x, /themes/custom/newsroom/img/logo-2x.png 2x">'
            . '</body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a lazy-loaded data-src yields its theme directory name.
     */
    public function test_locate_returns_slug_from_data_src(): void
    {
        $html = '<html><body>'
            . '<div class="lazy" data-src="/themes/custom/newsroom/img/bg.png"></div>'
            . '</body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a stylesheet link wins over an earlier script.
     *
     * Stylesheet links are scanned before every other resource, so a
     * stylesheet under /themes/contrib/{slug}/ or /themes/custom/{slug}/
     * wins over a script or image found earlier in the document.
     */
    public function test_locate_prefers_stylesheet_links(): void
    {
        $html = '<html><head>'
            . '<script src="/themes/custom/newsroom/js/main.js"></script>'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that the first qualifying stylesheet wins in document order
     * when contrib and custom both appear.
     */
    public function test_locate_returns_first_qualifying_stylesheet(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '<link rel="stylesheet" href="/themes/contrib/olivero/css/style.css">'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an absolute URL with a query string is handled.
     */
    public function test_locate_handles_absolute_url_with_query_string(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://example.com/themes/custom/newsroom/css/main.css?v=123">'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an absolute URL with a fragment is handled.
     */
    public function test_locate_handles_absolute_url_with_fragment(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://example.com/themes/custom/newsroom/css/main.css#main">'
            . '</head><body></body></html>';

        self::assertSame('newsroom', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a URL-encoded theme directory name is decoded.
     */
    public function test_locate_decodes_encoded_slug(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/contrib/ol%69vero/css/style.css">'
            . '</head><body></body></html>';

        self::assertSame('olivero', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a bare /themes/ path is ignored.
     */
    public function test_locate_ignores_bare_themes_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that /themes/contrib/ without a slug is ignored.
     */
    public function test_locate_ignores_contrib_without_slug(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/contrib/">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that /themes/custom/ without a slug is ignored.
     */
    public function test_locate_ignores_custom_without_slug(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a generic first segment under /themes/ is ignored.
     */
    public function test_locate_ignores_generic_first_segment(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/foo/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a generic css directory under /themes/custom/ is
     * ignored.
     */
    public function test_locate_ignores_generic_css_directory(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/css/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a generic js directory under /themes/contrib/ is
     * ignored.
     */
    public function test_locate_ignores_generic_js_directory(): void
    {
        $html = '<html><head>'
            . '<script src="/themes/contrib/js/main.js"></script>'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that the singular /theme/ path is ignored.
     */
    public function test_locate_ignores_singular_theme_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/theme/custom/newsroom/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a non-root /assets/themes/ path is ignored.
     */
    public function test_locate_ignores_non_root_themes_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/assets/themes/custom/newsroom/css/main.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a WordPress /wp-content/themes/ path is ignored.
     */
    public function test_locate_ignores_wordpress_themes_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a stylesheet with no directory after contrib is ignored.
     */
    public function test_locate_ignores_contrib_root_file(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/contrib/main.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that /core/ paths are ignored.
     */
    public function test_locate_ignores_core_paths(): void
    {
        $html = '<html><head>'
            . '<script src="/core/misc/drupal.js"></script>'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that /node/, /entity/, and /user/login paths are ignored.
     */
    public function test_locate_ignores_content_paths(): void
    {
        $html = '<html><body>'
            . '<a href="/node/1">Item</a>'
            . '<a href="/entity/42">Entity</a>'
            . '<a href="/user/login">Sign in</a>'
            . '</body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a bare relative reference is ignored.
     */
    public function test_locate_ignores_bare_relative_reference(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="themes/custom/newsroom/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a parent-relative reference is ignored.
     */
    public function test_locate_ignores_parent_relative_reference(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="../themes/custom/newsroom/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a plain text occurrence is ignored.
     */
    public function test_locate_ignores_plain_text(): void
    {
        $html = '<html><body><p>/themes/custom/newsroom/css/main.css</p></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a CSS class name is ignored.
     */
    public function test_locate_ignores_css_class_name(): void
    {
        $html = '<html><body><div class="themes-custom">hello</div></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a slug decoding to a slash is rejected.
     */
    public function test_locate_rejects_slug_decoding_to_slash(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/foo%2Fbar/css/main.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a malformed URL is ignored.
     */
    public function test_locate_ignores_malformed_url(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="http://">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a URL with no path is ignored.
     */
    public function test_locate_ignores_url_without_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://example.com">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that empty HTML yields null.
     */
    public function test_locate_returns_null_for_empty_html(): void
    {
        self::assertNull($this->locator()->locate($this->context('')));
    }

    /**
     * Verify that locating is deterministic.
     */
    public function test_locate_is_deterministic(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '</head><body></body></html>';

        $locator = $this->locator();

        self::assertSame(
            $locator->locate($this->context($html)),
            $locator->locate($this->context($html)),
        );
    }
}
