<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Modules\Detection\DetectionContext;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeExtractor;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeLocator;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeMetadataMapper;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeParser;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use PHPUnit\Framework\TestCase;

/**
 * Component tests for the ShopifyThemeExtractor orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete Shopify theme extraction pipeline using the real implementations
 * of every collaborator. It verifies the collaboration between
 *
 * - ShopifyThemeLocator,
 * - ShopifyThemeParser, and
 * - ShopifyThemeMetadataMapper
 *
 * by exercising their real implementations through ShopifyThemeExtractor
 * and observing the assembled ThemeExtractionResult.
 *
 * The pipeline delegates window.Shopify object discovery to the locator,
 * raw theme metadata parsing to the parser, and metadata normalization to
 * the mapper, and it assembles the resulting ThemeExtractionResult from
 * their outputs. When no window.Shopify object carries a valid theme name,
 * the pipeline short-circuits into a failed result.
 *
 * The collaborators are exercised as real, deterministic objects; they are
 * final readonly classes and therefore cannot be doubled by PHPUnit. No
 * HTTP is performed anywhere in the pipeline.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable. They verify collaboration and
 * orchestration only; they never test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 */
final class ShopifyThemeExtractorComponentTest extends TestCase
{
    /**
     * Assemble the extractor under test from its three collaborators.
     *
     * @return ShopifyThemeExtractor The extractor under test.
     */
    private function extractor(): ShopifyThemeExtractor
    {
        return new ShopifyThemeExtractor(
            new ShopifyThemeLocator(),
            new ShopifyThemeParser(),
            new ShopifyThemeMetadataMapper(),
        );
    }

    /**
     * Create a detection context carrying the given HTML.
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
     * Create the HTML of a Shopify page carrying a theme object.
     *
     * @return string The Shopify storefront HTML.
     */
    private function shopifyPageHtml(): string
    {
        return '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/9/t/8/assets/base.css?v=456">'
            . '</head>' . "\n"
            . '<body>'
            . '<script>window.Shopify = { theme: { id: 8, name: "Dawn", role: "main" } };</script>'
            . '<main><h1>Gadgets and more</h1></main>'
            . '</body>' . "\n"
            . '</html>';
    }

    /**
     * Verify that the full pipeline produces a successful result.
     *
     * The locator discovers the window.Shopify object, the parser extracts
     * the raw theme metadata, the mapper normalizes it, and the extractor
     * assembles the ThemeExtractionResult with the documented positive
     * confidence.
     */
    public function test_extract_returns_successful_result(): void
    {
        $result = $this->extractor()->extract($this->context($this->shopifyPageHtml()));

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertTrue($result->isExtracted());
        self::assertSame(ShopifyThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
        self::assertSame([], $result->metadata());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Dawn', $theme->name());
        self::assertSame(8, $theme->extra()['shopify_theme_id']);
        self::assertSame('main', $theme->extra()['shopify_theme_role']);
    }

    /**
     * Verify that a page without window.Shopify yields a failed result.
     */
    public function test_returns_failed_result_when_no_shopify_object(): void
    {
        $html = '<!DOCTYPE html>'
            . '<html><head></head><body><p>Plain site</p></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a window.Shopify object without a theme name yields a
     * failed result.
     */
    public function test_returns_failed_result_when_theme_name_is_missing(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { routes: { root: "/" }, theme: { id: 8, role: "main" } };</script>'
            . '</body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the guard idiom yields a failed result.
     */
    public function test_returns_failed_result_for_guard_idiom(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = window.Shopify || { theme: { id: 8, name: "Dawn" } };</script>'
            . '</body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a page without Shopify theme evidence yields a failed
     * result.
     */
    public function test_returns_failed_result_without_theme_evidence(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that an empty theme name yields a failed result.
     *
     * The mapper normalizes an empty name to the empty string, and the
     * extractor must never surface an empty name as an extracted theme, so
     * the pipeline short-circuits into a failed result.
     */
    public function test_returns_failed_result_when_theme_name_is_empty(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { theme: { id: 8, name: "", role: "main" } };</script>'
            . '</body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that generic theme asset names yield a failed result.
     *
     * Generic asset names such as theme.css and theme.js are deliberately
     * excluded as evidence: they appear on countless non-Shopify sites and
     * carry no window.Shopify theme object.
     */
    public function test_returns_failed_result_for_generic_theme_assets(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/theme.css">'
            . '</head><body>'
            . '<script src="/theme.js"></script>'
            . '</body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that Shopify asset paths without a theme object yield a failed
     * result.
     *
     * base.css and global.js are standard Online Store 2.0 asset names, but
     * without a window.Shopify object carrying a valid theme name they are
     * not theme evidence.
     */
    public function test_returns_failed_result_for_assets_without_theme_object(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/9/t/8/assets/base.css?v=456">'
            . '</head><body>'
            . '<script src="https://cdn.shopify.com/s/files/1/9/t/8/assets/global.js"></script>'
            . '</body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the successful pipeline maps the theme metadata.
     */
    public function test_successful_pipeline_maps_theme_metadata(): void
    {
        $result = $this->extractor()->extract($this->context($this->shopifyPageHtml()));

        self::assertTrue($result->isExtracted());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Dawn', $theme->name());
        self::assertNull($theme->version());
        self::assertNull($theme->author());
        self::assertNull($theme->themeUrl());
        self::assertSame([], $theme->tags());
    }

    /**
     * Verify that repeated extractions with identical input are
     * deterministic.
     */
    public function test_extractor_is_deterministic(): void
    {
        $extractor = $this->extractor();

        $first = $extractor->extract($this->context($this->shopifyPageHtml()));
        $second = $extractor->extract($this->context($this->shopifyPageHtml()));

        self::assertSame($first->isExtracted(), $second->isExtracted());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->metadata(), $second->metadata());
        self::assertSame($first->theme()?->name(), $second->theme()?->name());
    }
}
