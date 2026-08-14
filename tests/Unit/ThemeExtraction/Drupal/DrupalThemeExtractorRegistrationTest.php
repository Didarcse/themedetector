<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Drupal;

use App\Core\Container;
use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule as JoomlaMetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule as JoomlaScriptFingerprintRule;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\ThemeExtraction\Drupal\DrupalContextGate;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeExtractor;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeLocator;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeMetadataMapper;
use App\Modules\ThemeExtraction\Joomla\JoomlaContextGate;
use App\Modules\ThemeExtraction\Joomla\JoomlaThemeExtractor;
use App\Modules\ThemeExtraction\Joomla\JoomlaTemplateLocator;
use App\Modules\ThemeExtraction\Joomla\JoomlaThemeMetadataMapper;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeExtractor;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeLocator;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeMetadataMapper;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeParser;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Registration tests for the DrupalThemeExtractor.
 *
 * Verifies that the production composition point registers the Drupal
 * theme extractor after the WordPress, Shopify, and Joomla theme
 * extractors, and that the ThemeExtractionManager selects the correct
 * extractor for a Drupal page, a WordPress page, a Shopify page, a Joomla
 * page, and an unsupported page when all four extractors run side by side.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * The only mocked collaborator is the HttpClientInterface injected into the
 * real WordPress stylesheet downloader; it represents the external
 * transport boundary.
 */
final class DrupalThemeExtractorRegistrationTest extends TestCase
{
    private const STYLE_CSS_URL = 'https://example.com/wp-content/themes/astra/style.css';

    private const STYLE_CSS_CONTENTS = "/*\n"
        . "Theme Name: Astra\n"
        . "Version: 1.0.0\n"
        . "*/";

    /**
     * Verify that the factory registers WordPress before Shopify before
     * Joomla before Drupal.
     *
     * The registration order is deliberate: on ties the manager favours
     * the first registered extractor, so WordPress must remain first for
     * WordPress pages to keep winning while Shopify, Joomla, and Drupal
     * pages win through their higher confidence.
     */
    public function test_factory_registers_wordpress_before_shopify_before_joomla_before_drupal(): void
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

        self::assertCount(4, $materialized);
        self::assertInstanceOf(WordPressThemeExtractor::class, $materialized[0]);
        self::assertInstanceOf(ShopifyThemeExtractor::class, $materialized[1]);
        self::assertInstanceOf(JoomlaThemeExtractor::class, $materialized[2]);
        self::assertInstanceOf(DrupalThemeExtractor::class, $materialized[3]);
    }

    /**
     * Verify that a Drupal page selects the Drupal extractor.
     */
    public function test_manager_selects_drupal_extractor_for_drupal_page(): void
    {
        $result = $this->manager($this->createMock(HttpClientInterface::class))
            ->extract($this->drupalContext());

        self::assertTrue($result->isExtracted());
        self::assertSame('newsroom', $result->theme()?->name());
        self::assertSame(DrupalThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
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
     * Verify that a Shopify page still selects the Shopify extractor.
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
     * Verify that a Joomla page still selects the Joomla extractor.
     */
    public function test_manager_selects_joomla_extractor_for_joomla_page(): void
    {
        $result = $this->manager($this->createMock(HttpClientInterface::class))
            ->extract($this->joomlaContext());

        self::assertTrue($result->isExtracted());
        self::assertSame('cassiopeia', $result->theme()?->name());
        self::assertSame(JoomlaThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
    }

    /**
     * Verify that an unsupported page yields the not-extracted WordPress
     * result.
     *
     * Every extractor reports a not-extracted result with zero confidence,
     * so the tie is resolved in favour of the first registered extractor,
     * WordPress.
     */
    public function test_manager_selects_wordpress_extractor_for_unsupported_page(): void
    {
        $result = $this->manager($this->createMock(HttpClientInterface::class))
            ->extract($this->unsupportedContext());

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Assemble the manager over the WordPress, Shopify, Joomla, and
     * Drupal extractors.
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

        $joomlaExtractor = new JoomlaThemeExtractor(
            new JoomlaContextGate(
                new JoomlaMetaGeneratorRule(),
                new JoomlaScriptFingerprintRule(),
            ),
            new JoomlaTemplateLocator(),
            new JoomlaThemeMetadataMapper(),
        );

        $drupalExtractor = new DrupalThemeExtractor(
            new DrupalContextGate(
                new MetaGeneratorRule(),
                new ScriptFingerprintRule(),
                new HtmlSignatureRule(),
            ),
            new DrupalThemeLocator(),
            new DrupalThemeMetadataMapper(),
        );

        return new ThemeExtractionManager(
            new ThemeExtractorRegistry([
                $wordPressExtractor,
                $shopifyExtractor,
                $joomlaExtractor,
                $drupalExtractor,
            ]),
        );
    }

    /**
     * Create a detection context for a Drupal page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function drupalContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html lang="en">' . "\n"
                . '<head>'
                . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
                . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
                . '</head>' . "\n"
                . '<body>'
                . '<script>window.drupalSettings = {path: {baseUrl: \'/\'}};</script>'
                . '</body>' . "\n"
                . '</html>',
            statusCode: 200,
        );
    }

    /**
     * Create a detection context for a Joomla page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function joomlaContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html lang="en">' . "\n"
                . '<head>'
                . '<meta name="generator" content="Joomla! Open Source CMS">'
                . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
                . '</head>' . "\n"
                . '<body>'
                . '<script>window.Joomla = window.Joomla || {};</script>'
                . '</body>' . "\n"
                . '</html>',
            statusCode: 200,
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

    /**
     * Create a detection context for a page on an unsupported platform.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function unsupportedContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<meta name="generator" content="Eleventy">'
                . '</head><body>'
                . '<p>Plain static site.</p>'
                . '</body></html>',
            statusCode: 200,
        );
    }
}
