<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Core;

use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\DetectorRegistry;
use PHPUnit\Framework\TestCase;

final class DetectionPipelineTest extends TestCase
{
    /**
     * @param array<string, mixed> $metadata
     */
    private function createResult(
        string $technology,
        int $confidence,
        bool $detected = true,
        array $metadata = [],
    ): DetectionResult {
        return new DetectionResult(
            technology: $technology,
            detected: $detected,
            confidence: $confidence,
            theme: null,
            plugins: [],
            metadata: $metadata,
        );
    }

    private function createContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<html></html>',
            statusCode: 200,
        );
    }

    /**
     * @param list<DetectionResult> $results
     */
    private function createPipeline(array $results): DetectionPipeline
    {
        $detectors = [];

        foreach ($results as $result) {
            $detector = $this->createMock(DetectorInterface::class);
            $detector->method('detect')->willReturn($result);
            $detectors[] = $detector;
        }

        $registry = new DetectorRegistry($detectors);
        $engine = new DetectionEngine($registry);

        return new DetectionPipeline($engine);
    }

    public function test_returns_empty_report_when_no_detector_matches(): void
    {
        $pipeline = $this->createPipeline([]);
        $report = $pipeline->analyze($this->createContext());

        self::assertFalse($report->hasDetection());
        self::assertSame(0, $report->count());
        self::assertNull($report->primary());
        self::assertSame(0, $report->highestConfidence());
        self::assertSame([], $report->metadata());
    }

    public function test_returns_primary_detection(): void
    {
        $results = [
            $this->createResult('Shopify', 95),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        self::assertSame('Shopify', $report->primaryTechnology());
    }

    public function test_sorts_results_by_confidence(): void
    {
        $results = [
            $this->createResult('WordPress', 60),
            $this->createResult('Shopify', 95),
            $this->createResult('Webflow', 80),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        $technologies = $report->technologies();

        self::assertSame('Shopify', $technologies[0]);
        self::assertSame('Webflow', $technologies[1]);
        self::assertSame('WordPress', $technologies[2]);
    }

    public function test_merges_metadata(): void
    {
        $results = [
            $this->createResult('Shopify', 95, true, ['theme' => 'Dawn']),
            $this->createResult('WordPress', 60, true, ['version' => '14']),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        $metadata = $report->metadata();

        self::assertArrayHasKey('theme', $metadata);
        self::assertArrayHasKey('version', $metadata);
        self::assertSame('Dawn', $metadata['theme']);
        self::assertSame('14', $metadata['version']);
    }

    public function test_later_metadata_overwrites_previous_values(): void
    {
        $results = [
            $this->createResult('WordPress', 60, true, ['theme' => 'Old']),
            $this->createResult('Shopify', 95, true, ['theme' => 'Dawn']),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        self::assertSame('Dawn', $report->metadata()['theme']);
    }

    public function test_failed_detections_are_removed(): void
    {
        $results = [
            $this->createResult('WordPress', 0, false, []),
            $this->createResult('Shopify', 95, true, []),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        self::assertCount(1, $report->results());
        self::assertSame('Shopify', $report->primaryTechnology());
    }

    public function test_highest_confidence_becomes_primary(): void
    {
        $results = [
            $this->createResult('WordPress', 50),
            $this->createResult('Shopify', 95),
            $this->createResult('Webflow', 70),
        ];

        $pipeline = $this->createPipeline($results);
        $report = $pipeline->analyze($this->createContext());

        self::assertSame(95, $report->highestConfidence());
        self::assertSame('Shopify', $report->primaryTechnology());
    }
}
