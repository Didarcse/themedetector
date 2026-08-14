<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\ApiDetectionResponsePresenter;
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
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the whitelist-only API response presenter.
 *
 * Verifies the v1 envelope structure, the exact whitelisted data projection,
 * the null theme case, and that error reports expose only their public code
 * and message — never source or context.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 */
final class ApiDetectionResponsePresenterTest extends TestCase
{
    private ApiDetectionResponsePresenter $presenter;

    protected function setUp(): void
    {
        $this->presenter = new ApiDetectionResponsePresenter();
    }

    public function test_success_envelope_matches_the_v1_contract(): void
    {
        $data = $this->data();

        $envelope = $this->presenter->success($data, 'request-abc');

        self::assertSame('v1', $envelope['schemaVersion']);
        self::assertSame('request-abc', $envelope['requestId']);
        self::assertTrue($envelope['success']);
        self::assertSame($data, $envelope['data']);
        self::assertSame([], $envelope['errors']);
    }

    public function test_data_projection_is_whitelisted(): void
    {
        $report = $this->report();
        $data = $this->presenter->data($report);

        self::assertSame([
            'website' => [
                'url' => 'https://example.com',
                'finalUrl' => 'https://example.com/',
                'statusCode' => 200,
            ],
            'cms' => 'WordPress',
            'cmsConfidence' => 55,
            'theme' => [
                'name' => 'Twenty Twenty-Five',
                'version' => '1.0',
                'author' => 'the WordPress team',
            ],
            'plugins' => ['contact-form-7'],
            'technologies' => [
                ['name' => 'WordPress', 'confidence' => 55],
            ],
            'detectionConfidence' => 55,
            'detectionTimeMs' => 1234,
        ], $data);
    }

    public function test_present_maps_a_success_report_onto_the_envelope(): void
    {
        $envelope = $this->presenter->present($this->report(), 'request-abc');

        self::assertTrue($envelope['success']);
        self::assertSame($this->data(), $envelope['data']);
        self::assertSame([], $envelope['errors']);
    }

    public function test_missing_theme_is_projected_as_null(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
        );

        $data = $this->presenter->data($report);

        self::assertNull($data['theme']);
        self::assertSame('', $data['cms']);
        self::assertSame([], $data['plugins']);
        self::assertSame([], $data['technologies']);
    }

    public function test_error_report_exposes_only_public_code_and_message(): void
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

        $envelope = $this->presenter->present($report, 'request-abc');

        self::assertFalse($envelope['success']);
        self::assertNull($envelope['data']);

        $errors = $envelope['errors'];
        self::assertIsArray($errors);
        self::assertCount(1, $errors);

        $error = $errors[0];
        self::assertIsArray($error);
        self::assertSame(['code' => 'transport_failure', 'message' => 'The website could not be reached.'], $error);
        self::assertArrayNotHasKey('source', $error);
        self::assertArrayNotHasKey('context', $error);
    }

    public function test_non_public_error_codes_are_mapped_to_analysis_failed(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(url: '', finalUrl: '', statusCode: 0),
            errors: [
                new DetectionError(code: 'internal_error', message: 'Something went wrong.'),
            ],
        );

        $envelope = $this->presenter->present($report, 'request-abc');

        $errors = $envelope['errors'];
        self::assertIsArray($errors);

        $error = $errors[0];
        self::assertIsArray($error);
        self::assertSame('analysis_failed', $error['code']);
        self::assertSame('Something went wrong.', $error['message']);
    }

    public function test_present_without_errors_produces_a_success_envelope(): void
    {
        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: 'https://example.com',
                finalUrl: 'https://example.com/',
                statusCode: 200,
            ),
        );

        $envelope = $this->presenter->present($report, 'request-abc');

        self::assertTrue($envelope['success']);
        self::assertSame($this->presenter->data($report), $envelope['data']);
        self::assertSame([], $envelope['errors']);
    }

    public function test_error_method_builds_a_single_error_envelope(): void
    {
        $envelope = $this->presenter->error('invalid_url', 'Bad url.', 'request-abc');

        self::assertFalse($envelope['success']);
        self::assertNull($envelope['data']);
        self::assertSame([['code' => 'invalid_url', 'message' => 'Bad url.']], $envelope['errors']);
    }

    public function test_errors_method_builds_a_multi_error_envelope(): void
    {
        $envelope = $this->presenter->errors([
            ['code' => 'unknown_field', 'message' => 'Unknown field [x].'],
            ['code' => 'url_required', 'message' => 'Url required.'],
        ], 'request-abc');

        self::assertFalse($envelope['success']);

        $errors = $envelope['errors'];
        self::assertIsArray($errors);
        self::assertCount(2, $errors);
        self::assertSame(['code' => 'url_required', 'message' => 'Url required.'], $errors[1]);
    }

    private function report(): DetectionReport
    {
        $primary = new DetectionResult(
            technology: 'WordPress',
            detected: true,
            confidence: 55,
            theme: 'twentytwentyfive',
            plugins: ['contact-form-7'],
            metadata: [],
        );

        $engine = new EngineDetectionReport(results: [$primary], metadata: [], primary: $primary);

        $theme = new ThemeExtractionResult(
            extracted: true,
            theme: new ThemeMetadata(
                name: 'Twenty Twenty-Five',
                version: '1.0',
                author: 'the WordPress team',
            ),
            confidence: 0,
        );

        $plugin = new PluginDetectionResult(
            detected: true,
            plugin: new PluginMetadata(name: 'contact-form-7', slug: 'contact-form-7'),
            confidence: 30,
        );

        return new DetectionReport(
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
    }

    /**
     * @return array<string, mixed>
     */
    private function data(): array
    {
        return $this->presenter->data($this->report());
    }
}
