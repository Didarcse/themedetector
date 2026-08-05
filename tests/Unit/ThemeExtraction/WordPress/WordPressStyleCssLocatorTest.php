<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the WordPressStyleCssLocator.
 *
 * Verifies the complete public contract of the locator: the active
 * WordPress theme stylesheet is discovered from the HTML carried by a real
 * DetectionContext, absolute hrefs are preserved, relative hrefs are
 * resolved into absolute URLs against the final URL, the original URL is
 * used as a fallback, non-theme stylesheets (wp-includes, plugins, Google
 * Fonts, and external CSS) are ignored, the first matching theme
 * stylesheet wins, child themes are supported, malformed HTML is tolerated,
 * empty HTML yields null, and locating is deterministic across repeated
 * calls.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — a real WordPressStyleCssLocator and a real
 * DetectionContext — with no mocks, no filesystem, and no HTTP.
 */
final class WordPressStyleCssLocatorTest extends TestCase
{
    private const THEME_URL = 'https://example.com/wp-content/themes/astra/style.css';

    /**
     * Create a real locator instance.
     *
     * @return WordPressStyleCssLocator The locator under test.
     */
    private function locator(): WordPressStyleCssLocator
    {
        return new WordPressStyleCssLocator();
    }

    /**
     * Create a real detection context carrying the given HTML.
     *
     * @param string $html        The HTML body to carry.
     * @param string $finalUrl    The final URL after redirects.
     * @param string $originalUrl The URL requested by the user.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(
        string $html,
        string $finalUrl = 'https://example.com',
        string $originalUrl = 'https://example.com',
    ): DetectionContext {
        return new DetectionContext(
            originalUrl: $originalUrl,
            finalUrl: $finalUrl,
            html: $html,
            statusCode: 200,
        );
    }

    /**
     * Wrap a stylesheet link into a minimal HTML document.
     *
     * @param string $link The full <link> element markup.
     *
     * @return string A complete HTML document carrying the given link.
     */
    private function document(string $link): string
    {
        return "<!DOCTYPE html>\n"
            . "<html>\n"
            . "<head>\n"
            . $link . "\n"
            . "</head>\n"
            . "<body></body>\n"
            . "</html>";
    }

    /**
     * Verify that an absolute theme stylesheet href is located unchanged.
     */
    public function test_finds_absolute_theme_stylesheet(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="https://example.com/wp-content/themes/'
                . 'astra/style.css?ver=6.4.1">',
            ),
        );

        self::assertSame(
            'https://example.com/wp-content/themes/astra/style.css?ver=6.4.1',
            $this->locator()->locate($context),
        );
    }

    /**
     * Verify that a root-relative theme stylesheet href is resolved
     * against the final URL.
     */
    public function test_finds_relative_theme_stylesheet(): void
    {
        $context = $this->context(
            $this->document('<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'),
        );

        self::assertSame(self::THEME_URL, $this->locator()->locate($context));
    }

    /**
     * Verify that null is returned when no valid theme stylesheet exists.
     *
     * A stylesheet living under /wp-content/themes/ that does not name a
     * style.css file is rejected, and so is an empty href.
     */
    public function test_returns_null_when_no_theme_stylesheet_exists(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="">' . "\n"
                . '<link rel="stylesheet" href="https://example.com/wp-content/themes/astra/custom.css">',
            ),
        );

        self::assertNull($this->locator()->locate($context));
    }

    /**
     * Verify that wp-includes stylesheets are ignored.
     */
    public function test_ignores_wp_includes_stylesheets(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="https://example.com/wp-includes/css/'
                . 'classic-themes.min.css">',
            ),
        );

        self::assertNull($this->locator()->locate($context));
    }

    /**
     * Verify that plugin stylesheets are ignored.
     */
    public function test_ignores_plugin_stylesheets(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="https://example.com/wp-content/plugins/'
                . 'elementor/assets/css/frontend.min.css">',
            ),
        );

        self::assertNull($this->locator()->locate($context));
    }

    /**
     * Verify that Google Fonts stylesheets are ignored.
     */
    public function test_ignores_google_fonts(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?'
                . 'family=Roboto:wght@400&amp;display=swap">',
            ),
        );

        self::assertNull($this->locator()->locate($context));
    }

    /**
     * Verify that external stylesheets hosted outside the target site are
     * ignored.
     */
    public function test_ignores_external_stylesheets(): void
    {
        $context = $this->context(
            $this->document('<link rel="stylesheet" href="https://cdn.example.com/vendor/style.css">'),
        );

        self::assertNull($this->locator()->locate($context));
    }

    /**
     * Verify that the first matching theme stylesheet is returned even when
     * unrelated stylesheets appear earlier in the markup.
     */
    public function test_returns_first_matching_theme_stylesheet(): void
    {
        $context = $this->context(
            $this->document(
                '<link rel="stylesheet" href="https://example.com/wp-content/plugins/'
                . 'woocommerce/assets/css/woocommerce.css">'
                . "\n"
                . '<link rel="stylesheet" href="https://example.com/wp-content/themes/'
                . 'twenty/style.css">'
                . "\n"
                . '<link rel="stylesheet" href="https://example.com/wp-content/themes/'
                . 'astra/style.css">',
            ),
        );

        self::assertSame(
            'https://example.com/wp-content/themes/twenty/style.css',
            $this->locator()->locate($context),
        );
    }

    /**
     * Verify that a child theme stylesheet is located and resolved.
     */
    public function test_supports_child_theme_stylesheet(): void
    {
        $context = $this->context(
            $this->document('<link rel="stylesheet" href="/wp-content/themes/astra-child/style.css">'),
        );

        self::assertSame(
            'https://example.com/wp-content/themes/astra-child/style.css',
            $this->locator()->locate($context),
        );
    }

    /**
     * Verify that malformed HTML still yields the theme stylesheet.
     */
    public function test_supports_malformed_html(): void
    {
        $html = "<!DOCTYPE html>\n"
            . "<html>\n"
            . "<head><link rel=\"stylesheet\" href=\"/wp-content/themes/astra/style.css\">\n"
            . "<title>Broken\n"
            . "</head>\n"
            . "<body>\n"
            . "<div class=\"a\"><p>text\n"
            . "<div><b>bold\n"
            . "<unclosed>\n"
            . "</body>\n"
            . "</html>";

        self::assertSame(self::THEME_URL, $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that the original URL is used when the final URL is empty.
     */
    public function test_falls_back_to_original_url(): void
    {
        $context = $this->context(
            '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">',
            finalUrl: '',
            originalUrl: 'https://example.com',
        );

        self::assertSame(self::THEME_URL, $this->locator()->locate($context));
    }

    /**
     * Verify that every relative URL form is resolved into an absolute URL.
     */
    public function test_normalizes_relative_urls(): void
    {
        $locator = $this->locator();

        self::assertSame(
            self::THEME_URL,
            $locator->locate($this->context(
                $this->document('<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'),
            )),
        );

        self::assertSame(
            self::THEME_URL,
            $locator->locate($this->context(
                $this->document('<link rel="stylesheet" href="//example.com/wp-content/themes/astra/style.css">'),
            )),
        );

        self::assertSame(
            self::THEME_URL,
            $locator->locate($this->context(
                $this->document('<link rel="stylesheet" href="../wp-content/themes/astra/style.css">'),
            )),
        );

        self::assertSame(
            self::THEME_URL,
            $locator->locate($this->context(
                $this->document('<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'),
                finalUrl: 'https://example.com/blog/',
            )),
        );
    }

    /**
     * Verify that empty HTML yields null.
     */
    public function test_returns_null_for_empty_html(): void
    {
        self::assertNull($this->locator()->locate($this->context('')));
    }

    /**
     * Verify that repeated calls with the same context are deterministic.
     */
    public function test_locator_is_deterministic(): void
    {
        $context = $this->context(
            $this->document('<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'),
        );

        $locator = $this->locator();

        $first = $locator->locate($context);
        $second = $locator->locate($context);

        self::assertSame($first, $second);
        self::assertSame(self::THEME_URL, $first);
    }
}
