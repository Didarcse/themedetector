<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\DetectionReport;

use App\Domain\DetectionReport\DetectionSummary;
use App\Modules\Detection\Core\DetectionReport as EngineDetectionReport;
use App\Modules\Detection\DetectionResult;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the normalized DetectionSummary projection.
 *
 * Verifies that the summary derives the canonical headline fields from the
 * engine results: CMS, theme, plugins, confidence, and technologies.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the domain value objects.
 */
final class DetectionSummaryTest extends TestCase
{
    public function test_projects_full_summary(): void
    {
        $engine = $this->engineReport();
        $summary = DetectionSummary::from($engine, $this->themeResult(), $this->pluginResult());

        self::assertSame('WordPress', $summary->cms());
        self::assertSame(55, $summary->cmsConfidence());
        self::assertSame('Twenty Twenty-Five', $summary->themeName());
        self::assertSame('1.0', $summary->themeVersion());
        self::assertSame('the WordPress team', $summary->themeAuthor());
        self::assertSame(['contact-form-7'], $summary->plugins());
        self::assertSame(55, $summary->detectionConfidence());
        self::assertSame(['WordPress'], $summary->technologies());
        self::assertSame(['WordPress' => 55], $summary->technologyConfidences());
        self::assertSame(55, $summary->confidenceForTechnology('WordPress'));
        self::assertSame('twentytwentyfive', $summary->primaryTheme());
    }

    public function test_projects_empty_summary(): void
    {
        $summary = DetectionSummary::from(null, null, null);

        self::assertSame('', $summary->cms());
        self::assertSame(0, $summary->cmsConfidence());
        self::assertNull($summary->themeName());
        self::assertNull($summary->themeVersion());
        self::assertNull($summary->themeAuthor());
        self::assertSame([], $summary->plugins());
        self::assertSame(0, $summary->detectionConfidence());
        self::assertSame([], $summary->technologies());
        self::assertSame([], $summary->technologyConfidences());
        self::assertSame(0, $summary->confidenceForTechnology('WordPress'));
        self::assertNull($summary->primaryTheme());
    }

    public function test_deduplicates_plugins_and_keeps_primary_first(): void
    {
        $primary = new DetectionResult(
            technology: 'WordPress',
            detected: true,
            confidence: 55,
            theme: 'twentytwentyfive',
            plugins: ['contact-form-7', 'woocommerce'],
            metadata: [],
        );
        $engine = new EngineDetectionReport(
            results: [$primary],
            metadata: [],
            primary: $primary,
        );

        $summary = DetectionSummary::from($engine, $this->themeResult(), $this->pluginResult());

        self::assertSame(['contact-form-7', 'woocommerce'], $summary->plugins());
    }

    public function test_detection_confidence_is_the_highest_across_engines(): void
    {
        $engine = $this->engineReport();
        $theme = new ThemeExtractionResult(
            extracted: false,
            theme: null,
            confidence: 90,
        );
        $plugin = new PluginDetectionResult(
            detected: false,
            plugin: null,
            confidence: 30,
        );

        $summary = DetectionSummary::from($engine, $theme, $plugin);

        self::assertSame(90, $summary->detectionConfidence());
    }

    public function test_ignores_unextracted_theme_and_undetected_plugin(): void
    {
        $summary = DetectionSummary::from(
            null,
            new ThemeExtractionResult(extracted: false, theme: null, confidence: 90),
            new PluginDetectionResult(detected: false, plugin: null, confidence: 90),
        );

        self::assertNull($summary->themeName());
        self::assertSame([], $summary->plugins());
        self::assertSame(90, $summary->detectionConfidence());
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
