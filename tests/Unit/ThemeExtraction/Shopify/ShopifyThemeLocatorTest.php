<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeLocator;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the ShopifyThemeLocator.
 *
 * Verifies the complete public contract of the locator: the canonical
 * plain `window.Shopify = { ... }` assignment is discovered from the
 * inline body of script blocks, multiple objects are returned in document
 * order, string contents and nested braces never break the balance, the
 * guard idiom `window.Shopify = window.Shopify || { ... }` is ignored,
 * external and structured-data scripts are skipped, objects outside script
 * blocks are ignored, unbalanced objects are skipped, empty HTML yields an
 * empty list, and locating is deterministic across repeated calls.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — a real ShopifyThemeLocator and a real
 * DetectionContext — with no mocks, no filesystem, and no HTTP.
 */
final class ShopifyThemeLocatorTest extends TestCase
{
    /**
     * Create a real locator instance.
     *
     * @return ShopifyThemeLocator The locator under test.
     */
    private function locator(): ShopifyThemeLocator
    {
        return new ShopifyThemeLocator();
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
     * Verify that the canonical assignment yields its object body.
     *
     * The body between the outer braces of the window.Shopify object is
     * returned exactly, including the whitespace as found.
     */
    public function test_locate_returns_object_body_for_canonical_assignment(): void
    {
        $html = '<html><head></head><body>'
            . '<script>window.Shopify = { theme: { id: 8, name: "Dawn" } };</script>'
            . '</body></html>';

        self::assertSame(
            [' theme: { id: 8, name: "Dawn" } '],
            $this->locator()->locate($this->context($html)),
        );
    }

    /**
     * Verify that multiple objects are returned in document order.
     */
    public function test_locate_returns_multiple_bodies_in_document_order(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { first: 1 };</script>'
            . '<script>window.Shopify = { second: 2 };</script>'
            . '</body></html>';

        self::assertSame(
            [' first: 1 ', ' second: 2 '],
            $this->locator()->locate($this->context($html)),
        );
    }

    /**
     * Verify that the guard idiom is ignored.
     *
     * `window.Shopify = window.Shopify || { ... }` is not the canonical
     * plain assignment emitted by Online Store 2.0 and must not be treated
     * as theme evidence.
     */
    public function test_locate_ignores_guard_idiom(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = window.Shopify || { theme: { id: 8 } };</script>'
            . '</body></html>';

        self::assertSame([], $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that minified assignments without whitespace are located.
     */
    public function test_locate_accepts_minified_assignment(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify={"theme":{"name":"Dawn"}};</script>'
            . '</body></html>';

        self::assertSame(
            ['"theme":{"name":"Dawn"}'],
            $this->locator()->locate($this->context($html)),
        );
    }

    /**
     * Verify that external script blocks are ignored.
     */
    public function test_locate_ignores_external_scripts(): void
    {
        $html = '<html><head>'
            . '<script src="https://cdn.example.com/app.js">window.Shopify = { theme: { name: "Dawn" } };</script>'
            . '</head><body></body></html>';

        self::assertSame([], $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that structured-data script blocks are ignored.
     */
    public function test_locate_skips_structured_data_scripts(): void
    {
        $html = '<html><head>'
            . '<script type="application/ld+json">{ "@type": "Store", "name": "window.Shopify = {" }</script>'
            . '</head><body></body></html>';

        self::assertSame([], $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that an object outside a script block is ignored.
     */
    public function test_locate_ignores_object_outside_script(): void
    {
        $html = '<html><body><div>window.Shopify = { theme: { name: "Dawn" } };</div></body></html>';

        self::assertSame([], $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that string contents with braces never break the balance.
     */
    public function test_locate_handles_string_contents_with_braces(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { shop: { name: "a} b{ c" }, theme: { name: "Dawn" } };</script>'
            . '</body></html>';

        self::assertSame(
            [' shop: { name: "a} b{ c" }, theme: { name: "Dawn" } '],
            $this->locator()->locate($this->context($html)),
        );
    }

    /**
     * Verify that a candidate whose braces never balance is skipped.
     */
    public function test_locate_skips_malformed_unbalanced_object(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { theme: { name: "Dawn" };</script>'
            . '</body></html>';

        self::assertSame([], $this->locator()->locate($this->context($html)));
    }

    /**
     * Verify that empty HTML yields an empty list.
     */
    public function test_locate_returns_empty_for_empty_html(): void
    {
        self::assertSame([], $this->locator()->locate($this->context('')));
    }

    /**
     * Verify that locating is deterministic.
     */
    public function test_locate_is_deterministic(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { theme: { name: "Dawn" } };</script>'
            . '</body></html>';

        $locator = $this->locator();

        self::assertSame(
            $locator->locate($this->context($html)),
            $locator->locate($this->context($html)),
        );
    }
}
