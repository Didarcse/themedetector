<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\DetectionReport;

use App\Domain\DetectionReport\DetectionError;
use App\Domain\DetectionReport\DetectionReport;
use App\Domain\DetectionReport\DetectionSummary;
use App\Domain\DetectionReport\DetectionWarning;
use App\Domain\DetectionReport\WebsiteInformation;
use App\Modules\Detection\Core\DetectionReport as EngineDetectionReport;
use App\Modules\Detection\DetectionResult;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the domain-level DetectionReport aggregate.
 *
 * Verifies that the aggregate exposes the website information, the raw
 * engine results, the normalized summary, the measured detection time, and
 * every warning and error of a completed website analysis.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the domain value objects.
 */
final class DetectionReportTest extends TestCase
{
    public function test_aggregates_full_success_report(): void
    {
        $engine = $this->engineReport();
        $theme = $this->themeResult();
        $plugin = $this->pluginResult();

        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
            engine: $engine,
            theme: $theme,
            plugin: $plugin,
            summary: DetectionSummary::from($engine, $theme, $plugin),
            detectionTime: 1.234,
        );

        self::assertSame('https://example.com', $report->websiteInformation()->url());
        self::assertSame('https://example.com/', $report->websiteInformation()->finalUrl());
        self::assertSame(200, $report->websiteInformation()->statusCode());
        self::assertSame($engine, $report->engine());
        self::assertSame($theme, $report->theme());
        self::assertSame($plugin, $report->plugin());
        self::assertSame(1.234, $report->detectionTime());
        self::assertTrue($report->hasDetection());
        self::assertFalse($report->hasError());
        self::assertNull($report->primaryError());
        self::assertSame([], $report->errors());
        self::assertSame([], $report->warnings());

        $summary = $report->summary();
        self::assertSame('WordPress', $summary->cms());
        self::assertSame(55, $summary->cmsConfidence());
        self::assertSame('Twenty Twenty-Five', $summary->themeName());
        self::assertSame('1.0', $summary->themeVersion());
        self::assertSame('the WordPress team', $summary->themeAuthor());
        self::assertSame(['contact-form-7'], $summary->plugins());
        self::assertSame(55, $summary->detectionConfidence());
        self::assertSame(['WordPress'], $summary->technologies());
        self::assertSame('twentytwentyfive', $summary->primaryTheme());

        $themeMetadata = $report->themeMetadata();
        self::assertNotNull($themeMetadata);
        self::assertSame('Twenty Twenty-Five', $themeMetadata->name());
        self::assertSame(0, $report->themeConfidence());

        $pluginMetadata = $report->pluginMetadata();
        self::assertNotNull($pluginMetadata);
        self::assertSame('contact-form-7', $pluginMetadata->name());
        self::assertSame(30, $report->pluginConfidence());
    }

    public function test_exposes_error_state(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(url: '', finalUrl: '', statusCode: 0),
            errors: [
                new DetectionError(
                    code: 'transport_failure',
                    message: 'The website could not be reached.',
                    source: 'WebsiteReportAnalyzer',
                    context: ['url' => 'https://example.com'],
                ),
            ],
        );

        self::assertTrue($report->hasError());
        self::assertFalse($report->hasDetection());
        self::assertCount(1, $report->errors());

        $error = $report->primaryError();
        self::assertNotNull($error);
        self::assertSame('transport_failure', $error->code());
        self::assertSame('The website could not be reached.', $error->message());
        self::assertSame('WebsiteReportAnalyzer', $error->source());
        self::assertSame(['url' => 'https://example.com'], $error->context());

        $summary = $report->summary();
        self::assertSame('', $summary->cms());
        self::assertSame(0, $summary->cmsConfidence());
        self::assertNull($summary->themeName());
        self::assertSame([], $summary->plugins());
        self::assertSame(0, $summary->detectionConfidence());
        self::assertSame([], $summary->technologies());
    }

    public function test_exposes_warnings(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
            warnings: [
                new DetectionWarning(
                    code: 'partial_theme_meta',
                    message: 'Some theme metadata fields are missing.',
                ),
            ],
        );

        self::assertCount(1, $report->warnings());

        $warning = $report->warnings()[0];
        self::assertSame('partial_theme_meta', $warning->code());
        self::assertSame('Some theme metadata fields are missing.', $warning->message());
        self::assertNull($warning->source());
        self::assertSame([], $warning->context());
    }

    public function test_exposes_only_extracted_metadata(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
            engine: $this->engineReport(),
            theme: new ThemeExtractionResult(extracted: false, theme: null, confidence: 20),
            plugin: new PluginDetectionResult(detected: false, plugin: null, confidence: 25),
        );

        self::assertNull($report->themeMetadata());
        self::assertSame(20, $report->themeConfidence());
        self::assertNull($report->pluginMetadata());
        self::assertSame(25, $report->pluginConfidence());
        self::assertTrue($report->hasDetection());
    }

    private function engineReport(): EngineDetectionReport
    {
        $primary = new DetectionResult(
            technology: 'WordPress',
            detected: true,
            confidence: 55,
            theme: 'twentytwentyfive',
            plugins: ['contact-form-7'],
            metadata: [],
        );

        return new EngineDetectionReport(results: [$primary], metadata: [], primary: $primary);
    }

    private function themeResult(): ThemeExtractionResult
    {
        return new ThemeExtractionResult(
            extracted: true,
            theme: new ThemeMetadata(
                name: 'Twenty Twenty-Five',
                version: '1.0',
                author: 'the WordPress team',
            ),
            confidence: 0,
        );
    }

    private function pluginResult(): PluginDetectionResult
    {
        return new PluginDetectionResult(
            detected: true,
            plugin: new PluginMetadata(
                name: 'contact-form-7',
                slug: 'contact-form-7',
            ),
            confidence: 30,
        );
    }
}
