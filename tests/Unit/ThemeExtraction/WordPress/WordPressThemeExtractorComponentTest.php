<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\Detection\DetectionContext;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeMetadata;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Component tests for the WordPressThemeExtractor orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete WordPress theme extraction pipeline using the real
 * implementations of every collaborator. It verifies the collaboration
 * between
 *
 * - WordPressStyleCssLocator,
 * - WordPressStyleCssDownloader,
 * - WordPressStyleCssParser, and
 * - WordPressThemeMetadataMapper
 *
 * by exercising their real implementations through WordPressThemeExtractor
 * and observing the assembled ThemeExtractionResult.
 *
 * The pipeline delegates active theme stylesheet discovery to the locator,
 * stylesheet downloading to the downloader, raw metadata parsing to the
 * parser, and metadata normalization to the mapper, and it assembles the
 * resulting ThemeExtractionResult from their outputs. When the stylesheet
 * cannot be located or downloaded, the pipeline short-circuits into a
 * failed result without invoking any downstream collaborator.
 *
 * The four collaborators are exercised as real, deterministic objects;
 * they are final readonly classes and therefore cannot be doubled by
 * PHPUnit. The only mocked collaborator is the HttpClientInterface
 * injected into the real WordPressStyleCssDownloader. It represents the
 * external transport boundary and is the sole place where behaviour must
 * be controlled and invocation counts observed.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable. They verify collaboration and
 * orchestration only; they never test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 */
final class WordPressThemeExtractorComponentTest extends TestCase
{
    private const STYLE_CSS_URL = 'https://example.com/wp-content/themes/astra/style.css';

    private const STYLE_CSS_CONTENTS = "/*\n"
        . "Theme Name: Astra\n"
        . "Version: 1.0.0\n"
        . "*/";

    /**
     * Assemble the extractor under test from its four collaborators.
     *
     * @param WordPressStyleCssLocator      $locator    Discovers the active
     *                                                  theme style.css URL.
     * @param WordPressStyleCssDownloader   $downloader Downloads the style.css
     *                                                  contents.
     * @param WordPressStyleCssParser       $parser     Parses the raw theme
     *                                                  metadata.
     * @param WordPressThemeMetadataMapper  $mapper     Maps the raw theme
     *                                                  metadata.
     *
     * @return WordPressThemeExtractor The extractor under test.
     */
    private function extractor(
        WordPressStyleCssLocator $locator,
        WordPressStyleCssDownloader $downloader,
        WordPressStyleCssParser $parser,
        WordPressThemeMetadataMapper $mapper,
    ): WordPressThemeExtractor {
        return new WordPressThemeExtractor($locator, $downloader, $parser, $mapper);
    }

    /**
     * Create the real locator collaborator.
     *
     * @return WordPressStyleCssLocator A real, deterministic locator.
     */
    private function locator(): WordPressStyleCssLocator
    {
        return new WordPressStyleCssLocator();
    }

    /**
     * Create the real downloader collaborator backed by the given client.
     *
     * @param HttpClientInterface $client The HTTP client collaborator.
     *
     * @return WordPressStyleCssDownloader A real downloader over the client.
     */
    private function downloader(HttpClientInterface $client): WordPressStyleCssDownloader
    {
        return new WordPressStyleCssDownloader($client);
    }

    /**
     * Create the real parser collaborator.
     *
     * @return WordPressStyleCssParser A real, deterministic parser.
     */
    private function parser(): WordPressStyleCssParser
    {
        return new WordPressStyleCssParser();
    }

    /**
     * Create the real mapper collaborator.
     *
     * @return WordPressThemeMetadataMapper A real, deterministic mapper.
     */
    private function mapper(): WordPressThemeMetadataMapper
    {
        return new WordPressThemeMetadataMapper();
    }

    /**
     * Create a detection context whose HTML locates the Astra stylesheet.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(): DetectionContext
    {
        return $this->contextForTheme('astra');
    }

    /**
     * Create a detection context referencing the given theme directory.
     *
     * The HTML carries a root-relative reference to the theme style.css
     * that the real locator resolves against the final URL, producing a
     * stylesheet URL for the given theme directory.
     *
     * @param string $theme The theme directory name.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextForTheme(string $theme): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/wp-content/themes/' . $theme . '/style.css">'
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
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/assets/app.css">'
                . '</head><body></body></html>',
            statusCode: 200,
        );
    }

    /**
     * Create the expected ThemeMetadata for the stylesheet under test.
     *
     * @return ThemeMetadata The expected normalized theme metadata.
     */
    private function metadata(): ThemeMetadata
    {
        return new ThemeMetadata(
            name: 'Astra',
            version: '1.0.0',
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
     * Assemble a fully wired extractor over a successful HTTP client.
     *
     * @return WordPressThemeExtractor The extractor under test.
     */
    private function successExtractor(): WordPressThemeExtractor
    {
        return $this->extractor(
            $this->locator(),
            $this->downloader($this->successfulClient()),
            $this->parser(),
            $this->mapper(),
        );
    }

    /**
     * Verify that the full pipeline produces a successful result.
     *
     * The locator discovers the stylesheet URL, the downloader fetches the
     * stylesheet contents, the parser extracts the raw metadata, the mapper
     * normalizes it, and the extractor assembles the ThemeExtractionResult.
     * The confidence assertion mirrors the production implementation, which
     * reports a fixed confidence of zero.
     */
    public function test_extract_returns_successful_result(): void
    {
        $result = $this->successExtractor()->extract($this->context());

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertTrue($result->isExtracted());
        self::assertSame(0, $result->confidence());
        self::assertSame([], $result->metadata());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame($this->metadata()->name(), $theme->name());
        self::assertSame($this->metadata()->version(), $theme->version());
    }

    /**
     * Verify that a null locator result yields a failed result.
     *
     * The downloader, parser, and mapper must never be invoked: the HTTP
     * client behind the real downloader is expected to receive no request,
     * and the failed result proves the pipeline short-circuited before any
     * downstream collaborator could run.
     */
    public function test_returns_failed_result_when_locator_returns_null(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::never())->method('get');

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $result = $extractor->extract($this->contextWithoutThemeStylesheet());

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a null download result yields a failed result.
     *
     * The parser and mapper must never be invoked: the failed result
     * proves the pipeline short-circuited as soon as the download failed,
     * before parsing or mapping could run.
     */
    public function test_returns_failed_result_when_downloader_returns_null(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(404));

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $result = $extractor->extract($this->context());

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the successful pipeline discovers the stylesheet URL.
     *
     * The URL delivered to the downloader originates exclusively from the
     * real locator over the detection context HTML, so a single HTTP
     * request against that URL proves the locator discovered exactly one
     * stylesheet and the pipeline completed successfully.
     */
    public function test_successful_pipeline_discovers_stylesheet_url(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with(self::STYLE_CSS_URL)
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $result = $extractor->extract($this->context());

        self::assertTrue($result->isExtracted());
    }

    /**
     * Verify that the downloader performs exactly one download.
     *
     * The HTTP client behind the real downloader is the observable
     * transport boundary; it is expected to receive exactly one request for
     * the located stylesheet URL, proving the downloader was invoked
     * exactly once per extraction.
     */
    public function test_calls_downloader_once(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with(self::STYLE_CSS_URL)
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $result = $extractor->extract($this->context());

        self::assertTrue($result->isExtracted());
    }

    /**
     * Verify that the successful pipeline parses the theme metadata.
     *
     * The theme name and version carried by the result are parsed by the
     * real parser from the downloaded stylesheet header, proving the raw
     * metadata was parsed during the successful pipeline run.
     */
    public function test_successful_pipeline_parses_theme_metadata(): void
    {
        $result = $this->successExtractor()->extract($this->context());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
        self::assertSame('1.0.0', $theme->version());
    }

    /**
     * Verify that the successful pipeline maps the theme metadata.
     *
     * The ThemeMetadata carried by the result is the normalized output of
     * the real mapper over the raw parsed fields, proving the raw metadata
     * was mapped during the successful pipeline run.
     */
    public function test_successful_pipeline_maps_theme_metadata(): void
    {
        $result = $this->successExtractor()->extract($this->context());

        self::assertTrue($result->isExtracted());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
        self::assertSame('1.0.0', $theme->version());
    }

    /**
     * Verify that the detection context is handed to the locator.
     *
     * A context referencing a distinct theme directory yields a download
     * of exactly that theme's stylesheet URL, proving the real locator
     * derived the URL from the given detection context rather than from a
     * fixed value.
     */
    public function test_passes_detection_context_to_locator(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with('https://example.com/wp-content/themes/twentytwentyfive/style.css')
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $result = $extractor->extract($this->contextForTheme('twentytwentyfive'));

        self::assertTrue($result->isExtracted());
    }

    /**
     * Verify that the located stylesheet URL is passed to the downloader.
     *
     * The HTTP client behind the real downloader must be called with the
     * exact stylesheet URL discovered by the locator.
     */
    public function test_passes_style_css_url_to_downloader(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with(self::STYLE_CSS_URL)
            ->willReturn($this->response(200, self::STYLE_CSS_CONTENTS));

        $extractor = $this->extractor($this->locator(), $this->downloader($client), $this->parser(), $this->mapper());

        $extractor->extract($this->context());
    }

    /**
     * Verify that the downloaded stylesheet contents are passed to the parser.
     *
     * The theme name and version exposed by the result are derived only
     * from the downloaded stylesheet body, proving the parser received the
     * exact downloaded CSS.
     */
    public function test_passes_downloaded_css_to_parser(): void
    {
        $result = $this->successExtractor()->extract($this->context());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
        self::assertSame('1.0.0', $theme->version());
    }

    /**
     * Verify that the raw parsed metadata is passed to the mapper.
     *
     * The mapped ThemeMetadata carries exactly the fields declared in the
     * stylesheet header; fields absent from the header map to null or the
     * empty tags array, proving the raw metadata reached the mapper.
     */
    public function test_passes_raw_metadata_to_mapper(): void
    {
        $result = $this->successExtractor()->extract($this->context());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('Astra', $theme->name());
        self::assertSame('1.0.0', $theme->version());
        self::assertNull($theme->author());
        self::assertNull($theme->authorUrl());
        self::assertNull($theme->themeUrl());
        self::assertNull($theme->description());
        self::assertNull($theme->license());
        self::assertNull($theme->licenseUrl());
        self::assertNull($theme->textDomain());
        self::assertNull($theme->parentTheme());
        self::assertNull($theme->requiresPhp());
        self::assertNull($theme->requiresCms());
        self::assertSame([], $theme->tags());
        self::assertSame([], $theme->extra());
    }

    /**
     * Verify that the extractor reports a fixed confidence.
     *
     * The production WordPressThemeExtractor owns no confidence logic and
     * reports a constant confidence of zero for both the successful and
     * the failed outcome; the assertions mirror that implementation.
     */
    public function test_returns_fixed_confidence(): void
    {
        $successful = $this->successExtractor()->extract($this->context());
        self::assertSame(0, $successful->confidence());

        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(404));

        $failedExtractor = $this->extractor(
            $this->locator(),
            $this->downloader($client),
            $this->parser(),
            $this->mapper(),
        );

        $failed = $failedExtractor->extract($this->context());
        self::assertSame(0, $failed->confidence());
    }

    /**
     * Verify that repeated extractions with identical behaviour are
     * deterministic.
     *
     * Calling extract() twice with the same extractor and the same
     * collaborator behaviour produces equivalent results in every
     * observable field.
     */
    public function test_extractor_is_deterministic(): void
    {
        $extractor = $this->successExtractor();

        $first = $extractor->extract($this->context());
        $second = $extractor->extract($this->context());

        self::assertSame($first->isExtracted(), $second->isExtracted());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->metadata(), $second->metadata());
        self::assertSame($first->theme()?->name(), $second->theme()?->name());
        self::assertSame($first->theme()?->version(), $second->theme()?->version());
    }
}
