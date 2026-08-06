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
use App\Services\WebsiteReportAnalyzer;
use PHPUnit\Framework\TestCase;

final class WebsiteReportAnalyzerIntegrationTest extends TestCase
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

    public function test_analyze_builds_full_report(): void
    {
        $analyzer = $this->analyzer(new FakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $report = $analyzer->analyze('example.com');

        $this->assertFalse($report->hasError());
        $this->assertSame('https://example.com', $report->websiteInformation()->url());
        $this->assertSame('https://example.com', $report->websiteInformation()->finalUrl());
        $this->assertSame(200, $report->websiteInformation()->statusCode());
        $this->assertGreaterThanOrEqual(0.0, $report->detectionTime());

        $this->assertTrue($report->hasDetection());
        $detection = $report->engine();
        $this->assertNotNull($detection);
        $this->assertTrue($detection->hasDetection());
        $this->assertSame('WordPress', $detection->primaryTechnology());
        $this->assertSame(55, $detection->highestConfidence());

        $summary = $report->summary();
        $this->assertSame('WordPress', $summary->cms());
        $this->assertSame(55, $summary->cmsConfidence());
        $this->assertSame('Twenty Twenty-Five', $summary->themeName());
        $this->assertSame(['contact-form-7'], $summary->plugins());

        $theme = $report->theme();
        $this->assertNotNull($theme);
        $this->assertTrue($theme->isExtracted());
        $metadata = $theme->theme();
        $this->assertNotNull($metadata);
        $this->assertSame('Twenty Twenty-Five', $metadata->name());
        $this->assertSame('1.0', $metadata->version());
        $this->assertSame('the WordPress team', $metadata->author());

        $plugin = $report->plugin();
        $this->assertNotNull($plugin);
        $this->assertTrue($plugin->isDetected());
        $pluginMetadata = $plugin->plugin();
        $this->assertNotNull($pluginMetadata);
        $this->assertSame('contact-form-7', $pluginMetadata->slug());
        $this->assertSame(30, $plugin->confidence());
    }

    public function test_analyze_rejects_invalid_url(): void
    {
        $analyzer = $this->analyzer(new FakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $report = $analyzer->analyze('not a url!!');

        $this->assertTrue($report->hasError());
        $error = $report->primaryError();
        $this->assertNotNull($error);
        $this->assertSame('invalid_url', $error->code());
        $this->assertStringContainsString('valid website URL', $error->message());
        $this->assertFalse($report->hasDetection());
    }

    public function test_analyze_handles_blank_url(): void
    {
        $analyzer = $this->analyzer(new FakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $report = $analyzer->analyze('   ');

        $this->assertTrue($report->hasError());
        $error = $report->primaryError();
        $this->assertNotNull($error);
        $this->assertSame('invalid_url', $error->code());
        $this->assertStringContainsString('valid website URL', $error->message());
    }

    public function test_analyze_returns_error_report_on_transport_failure(): void
    {
        $analyzer = $this->analyzer(new ThrowingHttpClient());

        $report = $analyzer->analyze('https://example.com');

        $this->assertTrue($report->hasError());
        $error = $report->primaryError();
        $this->assertNotNull($error);
        $this->assertSame('transport_failure', $error->code());
        $this->assertStringContainsString('could not be reached', $error->message());
        $this->assertFalse($report->hasDetection());
    }

    private function analyzer(HttpClientInterface $client): WebsiteReportAnalyzer
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

        return new WebsiteReportAnalyzer(
            $client,
            new DetectionContextFactory(),
            new DetectionPipeline(new DetectionEngine($registry)),
            $themeExtractor,
            new PluginDetectionManager($pluginRegistry),
        );
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
