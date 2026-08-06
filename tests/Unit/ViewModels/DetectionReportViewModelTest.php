<?php

declare(strict_types=1);

namespace Tests\Unit\ViewModels;

use App\Domain\DetectionReport\DetectionError;
use App\Domain\DetectionReport\DetectionReport;
use App\Domain\DetectionReport\DetectionSummary;
use App\Domain\DetectionReport\WebsiteInformation;
use App\Modules\Detection\Core\DetectionReport as EngineDetectionReport;
use App\Modules\Detection\DetectionResult;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeMetadata;
use App\ViewModels\DetectionReportViewModel;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the Detection Report view model.
 *
 * Verifies the mapping of the domain-level DetectionReport onto the
 * presentation model: canonical report fields, detection state, plugin
 * deduplication, and the overall detection confidence.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the domain value objects.
 */
final class DetectionReportViewModelTest extends TestCase
{
    public function test_maps_full_report_to_view_model(): void
    {
        $report = $this->websiteReport(
            $this->detectionReport(),
            $this->themeExtractionResult(),
            $this->pluginDetectionResult(),
        );

        $viewModel = DetectionReportViewModel::fromReport($report, 'example.com');

        self::assertSame('example.com', $viewModel->submittedUrl());
        self::assertSame('https://example.com', $viewModel->url());
        self::assertSame('https://example.com/', $viewModel->finalUrl());
        self::assertSame('WordPress', $viewModel->cms());
        self::assertSame(55, $viewModel->cmsConfidence());
        self::assertSame('Twenty Twenty-Five', $viewModel->themeName());
        self::assertSame('1.0', $viewModel->themeVersion());
        self::assertSame('the WordPress team', $viewModel->themeAuthor());
        self::assertSame(['contact-form-7'], $viewModel->plugins());
        self::assertSame(55, $viewModel->detectionConfidence());
        self::assertSame(1.234, $viewModel->executionTime());
        self::assertSame(200, $viewModel->statusCode());
        self::assertFalse($viewModel->hasError());
        self::assertNull($viewModel->error());
        self::assertTrue($viewModel->hasDetection());
        self::assertSame(['WordPress'], $viewModel->technologies());
        self::assertSame(1, $viewModel->technologiesCount());
        self::assertSame(55, $viewModel->confidenceForTechnology('WordPress'));
        self::assertSame('twentytwentyfive', $viewModel->primaryTheme());

        $themeMetadata = $viewModel->themeMetadata();
        self::assertNotNull($themeMetadata);
        self::assertSame('Twenty Twenty-Five', $themeMetadata->name());
        self::assertSame(0, $viewModel->themeConfidence());

        $pluginMetadata = $viewModel->pluginMetadata();
        self::assertNotNull($pluginMetadata);
        self::assertSame('contact-form-7', $pluginMetadata->name());
        self::assertSame(30, $viewModel->pluginConfidence());
    }

    public function test_maps_error_report_to_view_model(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: '',
                finalUrl: '',
                statusCode: 0,
            ),
            errors: [
                new DetectionError(
                    code: 'invalid_url',
                    message: 'Please enter a valid website URL.',
                    source: 'WebsiteReportAnalyzer',
                ),
            ],
        );

        $viewModel = DetectionReportViewModel::fromReport($report, 'not a url!!');

        self::assertSame('not a url!!', $viewModel->submittedUrl());
        self::assertSame('', $viewModel->url());
        self::assertSame('', $viewModel->finalUrl());
        self::assertSame('', $viewModel->cms());
        self::assertSame(0, $viewModel->cmsConfidence());
        self::assertNull($viewModel->themeName());
        self::assertNull($viewModel->themeVersion());
        self::assertNull($viewModel->themeAuthor());
        self::assertSame([], $viewModel->plugins());
        self::assertSame(0, $viewModel->detectionConfidence());
        self::assertSame(0.0, $viewModel->executionTime());
        self::assertSame(0, $viewModel->statusCode());
        self::assertTrue($viewModel->hasError());
        self::assertSame('Please enter a valid website URL.', $viewModel->error());
        self::assertFalse($viewModel->hasDetection());
        self::assertSame([], $viewModel->technologies());
        self::assertSame(0, $viewModel->technologiesCount());
        self::assertNull($viewModel->themeMetadata());
        self::assertNull($viewModel->pluginMetadata());
    }

    public function test_maps_report_without_detection(): void
    {
        $report = $this->websiteReport(
            new EngineDetectionReport(results: [], metadata: [], primary: null),
            new ThemeExtractionResult(extracted: false, theme: null, confidence: 0),
            new PluginDetectionResult(detected: false, plugin: null, confidence: 0),
        );

        $viewModel = DetectionReportViewModel::fromReport($report, 'example.com');

        self::assertFalse($viewModel->hasDetection());
        self::assertSame('', $viewModel->cms());
        self::assertSame(0, $viewModel->cmsConfidence());
        self::assertSame(0, $viewModel->detectionConfidence());
        self::assertSame(0, $viewModel->technologiesCount());
        self::assertNull($viewModel->primaryTheme());
    }

    public function test_deduplicates_plugin_names_and_keeps_primary_first(): void
    {
        $primary = new DetectionResult(
            technology: 'WordPress',
            detected: true,
            confidence: 55,
            theme: 'twentytwentyfive',
            plugins: ['contact-form-7', 'woocommerce'],
            metadata: [],
        );

        $report = $this->websiteReport(
            new EngineDetectionReport(results: [$primary], metadata: [], primary: $primary),
            $this->themeExtractionResult(),
            $this->pluginDetectionResult(),
        );

        $viewModel = DetectionReportViewModel::fromReport($report, 'example.com');

        self::assertSame(['contact-form-7', 'woocommerce'], $viewModel->plugins());
    }

    private function detectionReport(): EngineDetectionReport
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

    private function themeExtractionResult(): ThemeExtractionResult
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

    private function pluginDetectionResult(): PluginDetectionResult
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

    private function websiteReport(
        EngineDetectionReport $detection,
        ThemeExtractionResult $theme,
        PluginDetectionResult $plugin,
    ): DetectionReport {
        return new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
            engine: $detection,
            theme: $theme,
            plugin: $plugin,
            summary: DetectionSummary::from($detection, $theme, $plugin),
            detectionTime: 1.234,
        );
    }
}
