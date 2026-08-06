<?php

declare(strict_types=1);

namespace Tests\Integration\Services;

use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\WordPress\ConfidenceCalculator as WordPressConfidenceCalculator;
use App\Modules\Detection\WordPress\Rules\GeneratorRule;
use App\Modules\Detection\WordPress\Rules\ThemePathRule;
use App\Modules\Detection\WordPress\WordPressDetector;
use App\Modules\Http\Exceptions\HttpClientException;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginRegistry;
use App\Modules\PluginDetection\WordPress\PluginMetadataMapper;
use App\Modules\PluginDetection\WordPress\PluginSlugExtractor;
use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use App\Modules\PluginDetection\WordPress\WordPressPluginDetector;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use App\Services\DetectionService;
use App\Services\WebsiteReportAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests for the Detection Report service.
 *
 * Verifies that the service orchestrates the complete detection workflow
 * through the real analyzer and produces a detection report view model.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - End-to-end: the real detection, theme extraction, and plugin detection
 *   engines run against a fake HTTP client.
 */
final class DetectionServiceIntegrationTest extends TestCase
{
    private const HOMEPAGE_HTML = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example Blog</title>
    <meta name="generator" content="WordPress 6.7.1">
    <link rel="stylesheet" href="/wp-content/themes/twentytwentyfive/style.css">
    <script src="/wp-content/plugins/contact-form-7/includes/js/index.js"></script>
</head>
<body>
    <h1>Example Blog</h1>
</body>
</html>
HTML;

    private const STYLESHEET_CSS = <<<'CSS'
/*
Theme Name: Twenty Twenty-Five
Theme URI: https://wordpress.org/themes/twentytwentyfive/
Author: the WordPress team
Author URI: https://wordpress.org/
Description: The 2025 default theme for WordPress.
Version: 1.0
License: GPL-2.0-or-later
Text Domain: twentytwentyfive
*/
CSS;

    public function test_detect_builds_full_view_model(): void
    {
        $service = $this->service(new FakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $viewModel = $service->detect('example.com');

        self::assertFalse($viewModel->hasError());
        self::assertSame('example.com', $viewModel->submittedUrl());
        self::assertSame('https://example.com', $viewModel->url());
        self::assertSame('https://example.com', $viewModel->finalUrl());
        self::assertSame('WordPress', $viewModel->cms());
        self::assertSame(55, $viewModel->cmsConfidence());
        self::assertSame('Twenty Twenty-Five', $viewModel->themeName());
        self::assertSame('1.0', $viewModel->themeVersion());
        self::assertSame('the WordPress team', $viewModel->themeAuthor());
        self::assertSame(['contact-form-7'], $viewModel->plugins());
        self::assertSame(55, $viewModel->detectionConfidence());
        self::assertGreaterThanOrEqual(0.0, $viewModel->executionTime());
        self::assertSame(200, $viewModel->statusCode());
        self::assertTrue($viewModel->hasDetection());
    }

    public function test_detect_returns_error_view_model_for_invalid_url(): void
    {
        $service = $this->service(new FakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $viewModel = $service->detect('not a url!!');

        self::assertTrue($viewModel->hasError());
        $error = $viewModel->error();
        self::assertNotNull($error);
        self::assertStringContainsString('valid website URL', $error);
        self::assertFalse($viewModel->hasDetection());
    }

    public function test_detect_returns_error_view_model_on_transport_failure(): void
    {
        $service = $this->service(new ThrowingHttpClient());

        $viewModel = $service->detect('https://example.com');

        self::assertTrue($viewModel->hasError());
        $error = $viewModel->error();
        self::assertNotNull($error);
        self::assertStringContainsString('could not be reached', $error);
        self::assertFalse($viewModel->hasDetection());
    }

    private function service(HttpClientInterface $client): DetectionService
    {
        $registry = new DetectorRegistry([
            new WordPressDetector(
                [new GeneratorRule(), new ThemePathRule()],
                new WordPressConfidenceCalculator(),
            ),
        ]);

        $themeExtractor = new ThemeExtractor(
            new ThemeExtractionManager(
                new ThemeExtractorRegistry([
                    new WordPressThemeExtractor(
                        new WordPressStyleCssLocator(),
                        new WordPressStyleCssDownloader($client),
                        new WordPressStyleCssParser(),
                        new WordPressThemeMetadataMapper(),
                    ),
                ]),
            ),
        );

        $pluginRegistry = new PluginRegistry();
        $pluginRegistry->register(
            new WordPressPluginDetector(
                new PluginPathRule(),
                new PluginSlugExtractor(),
                new PluginMetadataMapper(),
            ),
        );

        $analyzer = new WebsiteReportAnalyzer(
            $client,
            new DetectionContextFactory(),
            new DetectionPipeline(new DetectionEngine($registry)),
            $themeExtractor,
            new PluginDetectionManager($pluginRegistry),
        );

        return new DetectionService($analyzer);
    }
}

final class FakeHttpClient implements HttpClientInterface
{
    public function __construct(
        private string $homepageHtml,
        private string $stylesheetCss,
    ) {
    }

    public function get(string $url): HttpResponse
    {
        if (str_contains($url, 'style.css')) {
            return $this->response($url, $this->stylesheetCss);
        }

        return $this->response($url, $this->homepageHtml);
    }

    private function response(string $url, string $body): HttpResponse
    {
        return new HttpResponse(
            originalUrl: $url,
            finalUrl: $url,
            statusCode: 200,
            headers: [],
            body: $body,
        );
    }
}

final class ThrowingHttpClient implements HttpClientInterface
{
    public function get(string $url): HttpResponse
    {
        throw new HttpClientException('Connection refused.');
    }
}
