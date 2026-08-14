<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Joomla;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Joomla\JoomlaTemplateLocator;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the JoomlaTemplateLocator.
 *
 * Verifies the complete public contract of the locator: a root-anchored
 * /templates/{slug}/ path in a resource attribute yields the template
 * directory name, stylesheet links are scanned before every other
 * resource, the first qualifying path wins, absolute URLs with query
 * strings and fragments and URL-encoded slugs are handled, and every non-qualifying path —
 * bare /templates/, generic directory names such as css and js, the
 * singular /template/, non-root paths such as /assets/templates/, plain
 * text, CSS class names, and unparseable URLs — is ignored.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — a real JoomlaTemplateLocator and a real
 * DetectionContext — with no mocks, no filesystem, and no HTTP.
 */
final class JoomlaTemplateLocatorTest extends TestCase
{
    /**
     * Create a real locator instance.
     *
     * @return JoomlaTemplateLocator The locator under test.
     */
    private function locator(): JoomlaTemplateLocator
    {
        return new JoomlaTemplateLocator();
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
     * Verify that a stylesheet link yields its template directory name.
     */
    public function test_locate_returns_slug_from_stylesheet_link(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
            . '</head><body></body></html>';

        self::assertSame('cassiopeia', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a script src yields its template directory name.
     */
    public function test_locate_returns_slug_from_script_src(): void
    {
        $html = '<html><head>'
            . '<script src="/templates/helix/js/template.js"></script>'
            . '</head><body></body></html>';

        self::assertSame('helix', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an image src yields its template directory name.
     */
    public function test_locate_returns_slug_from_image_src(): void
    {
        $html = '<html><body>'
            . '<img src="/templates/ample/img/logo.png" alt="logo">'
            . '</body></html>';

        self::assertSame('ample', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an image srcset yields its template directory name.
     */
    public function test_locate_returns_slug_from_image_srcset(): void
    {
        $html = '<html><body>'
            . '<img srcset="/templates/ample/img/logo.png 1x, /templates/ample/img/logo-2x.png 2x">'
            . '</body></html>';

        self::assertSame('ample', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a lazy-loaded data-src yields its template directory
     * name.
     */
    public function test_locate_returns_slug_from_data_src(): void
    {
        $html = '<html><body>'
            . '<div class="lazy" data-src="/templates/yoo_master2/img/bg.png"></div>'
            . '</body></html>';

        self::assertSame('yoo_master2', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a stylesheet link wins over an earlier script.
     *
     * Stylesheet links are scanned before every other resource, so a
     * stylesheet under /templates/{slug}/ wins over a script or image
     * found earlier in the document.
     */
    public function test_locate_prefers_stylesheet_links(): void
    {
        $html = '<html><head>'
            . '<script src="/templates/helix/js/template.js"></script>'
            . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
            . '</head><body></body></html>';

        self::assertSame('cassiopeia', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that the first qualifying stylesheet wins in document order.
     */
    public function test_locate_returns_first_qualifying_stylesheet(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
            . '<link rel="stylesheet" href="/templates/gantry/css/template.css">'
            . '</head><body></body></html>';

        self::assertSame('cassiopeia', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an absolute URL with a query string is handled.
     */
    public function test_locate_handles_absolute_url_with_query_string(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://example.com/templates/cassiopeia/css/template.css?v=123">'
            . '</head><body></body></html>';

        self::assertSame('cassiopeia', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an absolute URL with a fragment is handled.
     */
    public function test_locate_handles_absolute_url_with_fragment(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://example.com/templates/cassiopeia/css/template.css#main">'
            . '</head><body></body></html>';

        self::assertSame('cassiopeia', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a URL-encoded template directory name is decoded.
     */
    public function test_locate_decodes_encoded_slug(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/hel%69x/css/template.css">'
            . '</head><body></body></html>';

        self::assertSame('helix', $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a bare /templates/ path is ignored.
     */
    public function test_locate_ignores_bare_templates_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a generic css directory under /templates/ is ignored.
     */
    public function test_locate_ignores_generic_css_directory(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/css/template.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a generic js directory under /templates/ is ignored.
     */
    public function test_locate_ignores_generic_js_directory(): void
    {
        $html = '<html><head>'
            . '<script src="/templates/js/main.js"></script>'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that the singular /template/ path is ignored.
     */
    public function test_locate_ignores_singular_template_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/template/cassiopeia/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a non-root /assets/templates/ path is ignored.
     */
    public function test_locate_ignores_non_root_templates_path(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/assets/templates/foo.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a stylesheet with no directory after /templates/ is
     * ignored.
     */
    public function test_locate_ignores_templates_root_file(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/main.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that /media/ asset paths are ignored.
     */
    public function test_locate_ignores_media_paths(): void
    {
        $html = '<html><head>'
            . '<script src="/media/system/js/core.js"></script>'
            . '</head><body>'
            . '<img src="/media/img/logo.png" alt="logo">'
            . '</body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an API asset path is ignored.
     */
    public function test_locate_ignores_api_paths(): void
    {
        $html = '<html><body>'
            . '<script src="/api/v1/widget.js"></script>'
            . '</body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a bare relative reference is ignored.
     */
    public function test_locate_ignores_bare_relative_reference(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="templates/cassiopeia/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a parent-relative reference is ignored.
     */
    public function test_locate_ignores_parent_relative_reference(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="../templates/cassiopeia/style.css">'
            . '</head><body></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a plain text occurrence is ignored.
     */
    public function test_locate_ignores_plain_text(): void
    {
        $html = '<html><body><p>templates/cassiopeia/css/template.css</p></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a CSS class name is ignored.
     */
    public function test_locate_ignores_css_class_name(): void
    {
        $html = '<html><body><div class="templates">hello</div></body></html>';

        self::assertNull($this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that a slug decoding to a slash is rejected.
     */
    public function test_locate_rejects_slug_decoding_to_slash(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/templates/foo%2Fbar/css/template.css">'
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
            . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
            . '</head><body></body></html>';

        $locator = $this->locator();

        self::assertSame(
            $locator->locate($this->context($html)),
            $locator->locate($this->context($html)),
        );
    }
}
