<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Core\Container;
use App\Modules\Detection\DetectionContext;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeExtractor;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeLocator;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeMetadataMapper;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeParser;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Registration tests for the ShopifyThemeExtractor.
 *
 * Verifies that the production composition point registers the Shopify
 * theme extractor after the WordPress theme extractor, and that the
 * ThemeExtractionManager selects the correct extractor for both a Shopify
 * page and a WordPress page when the two extractors run side by side.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * The only mocked collaborator is the HttpClientInterface injected into the
 * real WordPress stylesheet downloader; it represents the external
 * transport boundary.
 */
final class ShopifyThemeExtractorRegistrationTest extends TestCase
{
    private const STYLE_CSS_URL = 'https://example.com/wp-content/themes/astra/style.css';

    private const STYLE_CSS_CONTENTS = "/*\n"
        . "Theme Name: Astra\n"
        . "Version: 1.0.0\n"
        . "*/";

    /**
     * Verify that the factory registers WordPress before Shopify.
     *
     * The registration order is deliberate: on ties the manager favours
     * the first registered extractor, so WordPress must remain first for
     * WordPress pages to keep winning while Shopify wins Shopify pages
     * through its higher confidence.
     */
    public function test_factory_registers_wordpress_before_shopify(): void
    {
        $container = new Container();
        $container->set(
            HttpClientInterface::class,
            $this->createMock(HttpClientInterface::class),
        );

        $extractors = (new ThemeExtractorRegistryFactory())->create($container)->all();

        $materialized = [];
        foreach ($extractors as $extractor) {
            $materialized[] = $extractor;
        }

        self::assertCount(2, $materialized);
        self::assertInstanceOf(WordPressThemeExtractor::class, $materialized[0]);
        self::assertInstanceOf(ShopifyThemeExtractor::class, $materialized[1]);
    }

    /**
     * Verify that a Shopify page selects the Shopify extractor.
     */
    public function test_manager_selects_shopify_extractor_for_shopify_page(): void
    {
        $result = $this->manager($this->createMock(HttpClientInterface::class))
            ->extract($this->shopifyContext());

        self::assertTrue($result->isExtracted());
        self::assertSame('Dawn', $result->theme()?->name());
        self::assertSame(ShopifyThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
    }

    /**
     * Verify that a WordPress page still selects the WordPress extractor.
     */
    public function test_manager_selects_wordpress_extractor_for_wordpress_page(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn(
            new HttpResponse(
                originalUrl: self::STYLE_CSS_URL,
                finalUrl: self::STYLE_CSS_URL,
                statusCode: 200,
                headers: [],
                body: self::STYLE_CSS_CONTENTS,
            ),
        );

        $result = $this->manager($client)->extract($this->wordPressContext());

        self::assertTrue($result->isExtracted());
        self::assertSame('Astra', $result->theme()?->name());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Assemble the manager over the WordPress and Shopify extractors.
     *
     * @param HttpClientInterface $client The transport boundary for the
     *                                    real WordPress downloader.
     *
     * @return ThemeExtractionManager The manager under test.
     */
    private function manager(HttpClientInterface $client): ThemeExtractionManager
    {
        $wordPressExtractor = new WordPressThemeExtractor(
            new WordPressStyleCssLocator(),
            new WordPressStyleCssDownloader($client),
            new WordPressStyleCssParser(),
            new WordPressThemeMetadataMapper(),
        );

        $shopifyExtractor = new ShopifyThemeExtractor(
            new ShopifyThemeLocator(),
            new ShopifyThemeParser(),
            new ShopifyThemeMetadataMapper(),
        );

        return new ThemeExtractionManager(
            new ThemeExtractorRegistry([$wordPressExtractor, $shopifyExtractor]),
        );
    }

    /**
     * Create a detection context for a Shopify page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function shopifyContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html lang="en">' . "\n"
                . '<head>'
                . '<link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/9/t/8/assets/base.css?v=456">'
                . '</head>' . "\n"
                . '<body>'
                . '<script>window.Shopify = { theme: { id: 8, name: "Dawn", role: "main" } };</script>'
                . '</body>' . "\n"
                . '</html>',
            statusCode: 200,
        );
    }

    /**
     * Create a detection context for a WordPress page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function wordPressContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'
                . '</head><body></body></html>',
            statusCode: 200,
        );
    }
}
