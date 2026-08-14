<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule as JoomlaMetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule as JoomlaScriptFingerprintRule;
use App\Modules\Http\HttpClientInterface;
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
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for the frozen theme extraction scope.
 *
 * The v2.1 theme extraction scope supports exactly four platforms —
 * WordPress, Shopify, Joomla, and Drupal. Every other platform served by
 * the Detection Engine deliberately reports no theme: Ghost and TYPO3 and
 * Squarespace are NOT SUPPORTED (they expose no reliable page-level theme
 * identity), and Wix and Webflow have NO THEME CONCEPT (their template
 * technology is opaque). This suite locks that freeze in place by running
 * the complete four-extractor pipeline against platform-typical pages for
 * those five platforms and asserting the accuracy-first not-extracted
 * result.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They exercise the real production extractors and collaborators; the only
 * mocked collaborator is the HttpClientInterface injected into the real
 * WordPress stylesheet downloader, and it is never invoked because none of
 * these pages carries WordPress theme evidence. No HTTP is performed.
 */
final class CrossPlatformScopeFreezeTest extends TestCase
{
    /**
     * Verify that a Ghost page yields the not-extracted result.
     *
     * Ghost exposes no page-level theme identity; theme discovery lives in
     * the admin area only. Asset paths under /assets/ are not theme
     * evidence, so the pipeline must report no theme.
     */
    public function test_ghost_page_is_not_extracted(): void
    {
        $result = $this->manager()->extract($this->ghostContext());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a TYPO3 page yields the not-extracted result.
     *
     * A TYPO3 frontend resolves its active theme through the sitepackage
     * configuration, not through a public asset path. Extension resource
     * paths under /typo3conf/ext/ are extensions, not themes, and must not
     * be mistaken for one.
     */
    public function test_typo3_page_is_not_extracted(): void
    {
        $result = $this->manager()->extract($this->typo3Context());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Squarespace page yields the not-extracted result.
     *
     * Squarespace exposes only an opaque template id with no offline
     * mapping to a theme name, and its template technology ships no theme
     * identity in the public page, so no theme can be reported.
     */
    public function test_squarespace_page_is_not_extracted(): void
    {
        $result = $this->manager()->extract($this->squarespaceContext());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Wix page yields the not-extracted result.
     *
     * Wix has no public theme concept: sites are assembled from an opaque
     * cloud builder, and the served assets carry no theme identity.
     */
    public function test_wix_page_is_not_extracted(): void
    {
        $result = $this->manager()->extract($this->wixContext());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Webflow page yields the not-extracted result.
     *
     * Webflow has no public theme concept: every site is a bespoke
     * published artifact with no theme identity in the served HTML.
     */
    public function test_webflow_page_is_not_extracted(): void
    {
        $result = $this->manager()->extract($this->webflowContext());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Assemble the manager over the full four-extractor registry.
     *
     * @return ThemeExtractionManager The manager under test.
     */
    private function manager(): ThemeExtractionManager
    {
        $wordPressExtractor = new WordPressThemeExtractor(
            new WordPressStyleCssLocator(),
            new WordPressStyleCssDownloader($this->createMock(HttpClientInterface::class)),
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
     * Create a detection context for a Ghost page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function ghostContext(): DetectionContext
    {
        return $this->context(
            '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<meta name="generator" content="Ghost 5.82">'
            . '<link rel="stylesheet" href="/assets/built/screen.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<script src="/assets/public/share.js"></script>'
            . '</body>' . "\n"
            . '</html>',
        );
    }

    /**
     * Create a detection context for a TYPO3 page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function typo3Context(): DetectionContext
    {
        return $this->context(
            '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<meta name="generator" content="TYPO3 CMS">'
            . '<link rel="stylesheet" href="/typo3conf/ext/site_package/Resources/Public/Css/main.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<script src="/typo3conf/ext/site_package/Resources/Public/JavaScript/main.js"></script>'
            . '</body>' . "\n"
            . '</html>',
        );
    }

    /**
     * Create a detection context for a Squarespace page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function squarespaceContext(): DetectionContext
    {
        return $this->context(
            '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<link rel="stylesheet" href="https://static1.squarespace.com/static/5a0f9d/6t/1234/style.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<div id="siteWrapper" data-template-id="62f0c1b2abc123"></div>'
            . '</body>' . "\n"
            . '</html>',
        );
    }

    /**
     * Create a detection context for a Wix page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function wixContext(): DetectionContext
    {
        return $this->context(
            '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<link rel="stylesheet" href="https://static.parastorage.com/services/'
            . 'santa-resources/resources/styles/main.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<div id="SITE_CONTAINER"></div>'
            . '<script src="https://static.parastorage.com/services/'
            . 'website-translator/v1.0.1/assets/translator.js"></script>'
            . '</body>' . "\n"
            . '</html>',
        );
    }

    /**
     * Create a detection context for a Webflow page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function webflowContext(): DetectionContext
    {
        return $this->context(
            '<!DOCTYPE html>' . "\n"
            . '<html lang="en" data-wf-page="62f0c1b2abc123" data-wf-site="62f0c1b2abc456">' . "\n"
            . '<head>'
            . '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:wght@400">'
            . '</head>' . "\n"
            . '<body>'
            . '<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.js"></script>'
            . '</body>' . "\n"
            . '</html>',
        );
    }
}
