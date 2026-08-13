<?php

declare(strict_types=1);

namespace Tests\Integration\ThemeExtraction;

use App\Modules\Detection\DetectionContext;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests for the complete Theme Extraction pipeline.
 *
 * This is the highest-level automated test for the Theme Extraction
 * Engine. It verifies that every production component works together
 * correctly by running the full pipeline end-to-end through the public
 * ThemeExtractor facade:
 *
 * DetectionContext
 *   ↓
 * ThemeExtractor
 *   ↓
 * ThemeExtractionManager
 *   ↓
 * ThemeExtractorRegistry
 *   ↓
 * WordPressThemeExtractor
 *   ↓
 * WordPressStyleCssLocator
 *   ↓
 * WordPressStyleCssDownloader
 *   ↓
 * WordPressStyleCssParser
 *   ↓
 * WordPressThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Every collaborator is a real production object: the real ThemeExtractor
 * facade, ThemeExtractionManager, ThemeExtractorRegistry,
 * WordPressThemeExtractor, WordPressStyleCssLocator,
 * WordPressStyleCssDownloader, WordPressStyleCssParser, and
 * WordPressThemeMetadataMapper. The only mocked collaborator is the
 * HttpClientInterface injected into the real downloader; it represents
 * the external transport boundary and prevents all network I/O.
 *
 * The tests are integration tests: fast, deterministic, and repeatable.
 * They validate the collaboration between all production components and
 * never inspect implementation details — only externally observable
 * behaviour is asserted.
 */
final class ThemeExtractionIntegrationTest extends TestCase
{
    private const URL = 'https://example.com';

    private const STYLE_CSS_URL = 'https://example.com/wp-content/themes/astra/style.css';

    private const STYLE_CSS_CONTENTS = "/*\n"
        . "Theme Name: Astra\n"
        . "Version: 1.0.0\n"
        . "*/";

    /**
     * Create a detection context whose HTML locates the theme stylesheet.
     *
     * The HTML carries a root-relative reference to the theme style.css
     * that the real locator resolves against the final URL into the
     * STYLE_CSS_URL constant.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'
                . '</head><body></body></html>',
            statusCode: 200,
        );
    }

    /**
     * Create a detection context with no theme stylesheet present.
     *
     * The stylesheet reference does not live under /wp-content/themes/,
     * so the real locator returns null for this context.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextWithoutThemeStylesheet(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/assets/app.css">'
                . '</head><body></body></html>',
            statusCode: 200,
        );
    }

    /**
     * Assemble the complete real Theme Extraction pipeline.
     *
     * Wires the real ThemeExtractor facade, ThemeExtractionManager,
     * ThemeExtractorRegistry, WordPressThemeExtractor, locator, downloader,
     * parser, and mapper together. The only mock is the given
     * HttpClientInterface injected into the real downloader.
     *
     * @param HttpClientInterface $client The mocked transport boundary.
     *
     * @return ThemeExtractor The fully wired pipeline entry point.
     */
    private function extractor(HttpClientInterface $client): ThemeExtractor
    {
        $wordPressExtractor = new WordPressThemeExtractor(
            new WordPressStyleCssLocator(),
            new WordPressStyleCssDownloader($client),
            new WordPressStyleCssParser(),
            new WordPressThemeMetadataMapper(),
        );

        return new ThemeExtractor(
            new ThemeExtractionManager(
                new ThemeExtractorRegistry([$wordPressExtractor]),
            ),
        );
    }

    /**
     * Create an HTTP response for the stylesheet under test.
     *
     * @param int    $statusCode The HTTP status code.
     * @param string $body       The response body.
     *
     * @return HttpResponse The immutable HTTP response.
     */
    private function response(int $statusCode, string $body = 'not found'): HttpResponse
    {
        return new HttpResponse(
            originalUrl: self::STYLE_CSS_URL,
            finalUrl: self::STYLE_CSS_URL,
            statusCode: $statusCode,
            headers: [],
            body: $body,
        );
    }

    /**
     * Create an HTTP client mock that serves the stylesheet contents.
     *
     * @return HttpClientInterface A mock HTTP client returning the stylesheet
     *                             contents for any request.
     */
    private function successfulClient(): HttpClientInterface
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        return $client;
    }

    /**
     * Verify that the complete pipeline extracts a WordPress theme.
     *
     * The real locator discovers the stylesheet URL from the context HTML,
     * the real downloader fetches the stylesheet contents through the
     * mocked transport, the real parser extracts the raw metadata, and the
     * real mapper produces the normalized ThemeMetadata. The confidence
     * assertion mirrors the production WordPressThemeExtractor, which
     * reports a fixed confidence of zero.
     */
    public function test_extracts_wordpress_theme_successfully(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with(self::STYLE_CSS_URL)
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $result = $this->extractor($client)->extract($this->context());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertTrue($result->isExtracted());
        self::assertSame(0, $result->confidence());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
        self::assertSame('1.0.0', $theme->version());
    }

    /**
     * Verify that a missing theme stylesheet yields a failed result.
     *
     * When the real locator cannot discover a theme stylesheet, the
     * pipeline short-circuits before the downloader: the mocked transport
     * boundary is expected to receive no request, and the result is a
     * failed ThemeExtractionResult.
     */
    public function test_returns_failed_result_when_stylesheet_is_missing(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::never())->method('get');

        $result = $this->extractor($client)->extract($this->contextWithoutThemeStylesheet());

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a failed stylesheet download yields a failed result.
     *
     * When the mocked transport boundary returns a non-200 response, the
     * real downloader returns null and the pipeline short-circuits into a
     * failed ThemeExtractionResult before parsing or mapping.
     */
    public function test_returns_failed_result_when_stylesheet_download_fails(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(404));

        $result = $this->extractor($client)->extract($this->context());

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a compiled bundle under a theme subdirectory does not
     * steal the extraction from the canonical theme stylesheet.
     *
     * Mirrors the kinsta.com fingerprint: the page links
     * wp-content/themes/kinsta/dist/style.css (a build artifact with no
     * theme header), while the canonical style.css at the theme root
     * carries the real header. The locator must skip the bundle, download
     * the canonical style.css, and extract the theme from it.
     */
    public function test_extracts_theme_from_canonical_style_css_when_bundle_is_linked(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with('https://example.com/wp-content/themes/kinsta/style.css')
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $context = new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/wp-content/themes/kinsta/dist/style.css?ver=1.2.3">'
                . '</head><body class="home wp-theme-kinsta"></body></html>',
            statusCode: 200,
        );

        $result = $this->extractor($client)->extract($context);

        self::assertTrue($result->isExtracted());
        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
    }

    /**
     * Verify that the complete pipeline is deterministic.
     *
     * Extracting twice with the same pipeline and the same detection
     * context produces equivalent results in every observable field.
     */
    public function test_pipeline_is_deterministic(): void
    {
        $extractor = $this->extractor($this->successfulClient());

        $first = $extractor->extract($this->context());
        $second = $extractor->extract($this->context());

        self::assertSame($first->isExtracted(), $second->isExtracted());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->metadata(), $second->metadata());

        $firstTheme = $first->theme();
        $secondTheme = $second->theme();
        self::assertNotNull($firstTheme);
        self::assertNotNull($secondTheme);
        self::assertSame($firstTheme->name(), $secondTheme->name());
        self::assertSame($firstTheme->version(), $secondTheme->version());
    }
}
