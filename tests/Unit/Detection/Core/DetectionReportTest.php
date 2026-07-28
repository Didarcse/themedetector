<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Core;

use App\Modules\Detection\Core\DetectionReport;
use App\Modules\Detection\DetectionResult;
use PHPUnit\Framework\TestCase;

final class DetectionReportTest extends TestCase
{
    /**
     * @param array<string, mixed> $metadata
     */
    private function createResult(
        string $technology = 'Shopify',
        int $confidence = 95,
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

    /**
     * @param list<DetectionResult> $results
     * @param array<string, mixed>  $metadata
     */
    private function createReport(
        array $results = [],
        array $metadata = [],
        ?DetectionResult $primary = null,
    ): DetectionReport {
        return new DetectionReport(
            results: $results,
            metadata: $metadata,
            primary: $primary,
        );
    }

    public function test_returns_empty_report(): void
    {
        $report = $this->createReport();

        self::assertFalse($report->hasDetection());
        self::assertSame(0, $report->count());
        self::assertSame([], $report->results());
        self::assertSame([], $report->metadata());
        self::assertNull($report->primary());
        self::assertSame(0, $report->highestConfidence());
        self::assertNull($report->primaryTechnology());
        self::assertSame([], $report->technologies());
        self::assertSame([], $report->confidenceMap());
    }

    public function test_returns_primary_detection(): void
    {
        $result = $this->createResult('Shopify', 95);
        $report = $this->createReport(
            results: [$result],
            primary: $result,
        );

        self::assertSame($result, $report->primary());
        self::assertSame('Shopify', $report->primaryTechnology());
        self::assertSame(95, $report->highestConfidence());
    }

    public function test_returns_all_results(): void
    {
        $shopify = $this->createResult('Shopify', 95);
        $wordpress = $this->createResult('WordPress', 60);
        $webflow = $this->createResult('Webflow', 80);

        $report = $this->createReport(
            results: [$shopify, $wordpress, $webflow],
            primary: $shopify,
        );

        self::assertCount(3, $report->results());
        self::assertSame(3, $report->count());
    }

    public function test_returns_technologies_in_order(): void
    {
        $results = [
            $this->createResult('Shopify', 95),
            $this->createResult('Webflow', 80),
            $this->createResult('WordPress', 60),
        ];

        $report = $this->createReport(
            results: $results,
            primary: $results[0],
        );

        self::assertSame(
            ['Shopify', 'Webflow', 'WordPress'],
            $report->technologies(),
        );
    }

    public function test_returns_confidence_map(): void
    {
        $results = [
            $this->createResult('Shopify', 95),
            $this->createResult('WordPress', 60),
        ];

        $report = $this->createReport(
            results: $results,
            primary: $results[0],
        );

        self::assertSame(
            ['Shopify' => 95, 'WordPress' => 60],
            $report->confidenceMap(),
        );
    }

    public function test_returns_metadata(): void
    {
        $metadata = [
            'theme' => 'Dawn',
            'version' => '14',
        ];

        $result = $this->createResult('Shopify', 95, true, $metadata);
        $report = $this->createReport(
            results: [$result],
            metadata: $metadata,
            primary: $result,
        );

        self::assertSame($metadata, $report->metadata());
    }

    public function test_returns_metadata_value(): void
    {
        $metadata = ['theme' => 'Dawn'];

        $result = $this->createResult('Shopify', 95, true, $metadata);
        $report = $this->createReport(
            results: [$result],
            metadata: $metadata,
            primary: $result,
        );

        self::assertSame('Dawn', $report->metadataValue('theme'));
        self::assertNull($report->metadataValue('missing'));
        self::assertSame('default', $report->metadataValue('missing', 'default'));
    }

    public function test_returns_detection_by_technology(): void
    {
        $shopify = $this->createResult('Shopify', 95);
        $wordpress = $this->createResult('WordPress', 60);

        $report = $this->createReport(
            results: [$shopify, $wordpress],
            primary: $shopify,
        );

        self::assertSame($shopify, $report->technology('Shopify'));
        self::assertSame($wordpress, $report->technology('WordPress'));
        self::assertNull($report->technology('Drupal'));
    }

    public function test_handles_empty_metadata(): void
    {
        $result = $this->createResult('Shopify', 95);
        $report = $this->createReport(
            results: [$result],
            metadata: [],
            primary: $result,
        );

        self::assertSame([], $report->metadata());
    }

    public function test_is_immutable(): void
    {
        $result = $this->createResult('Shopify', 95);
        $report = $this->createReport(
            results: [$result],
            metadata: ['theme' => 'Dawn'],
            primary: $result,
        );

        self::assertTrue($report->hasDetection());
        self::assertSame('Shopify', $report->primaryTechnology());
        self::assertSame(95, $report->highestConfidence());
        self::assertCount(1, $report->results());
        self::assertSame(['Shopify'], $report->technologies());
        self::assertSame(['Shopify' => 95], $report->confidenceMap());
        self::assertSame('Dawn', $report->metadataValue('theme'));

        // Second call returns identical results
        self::assertTrue($report->hasDetection());
        self::assertSame('Shopify', $report->primaryTechnology());
        self::assertSame(95, $report->highestConfidence());
        self::assertCount(1, $report->results());
        self::assertSame(['Shopify'], $report->technologies());
        self::assertSame(['Shopify' => 95], $report->confidenceMap());
        self::assertSame('Dawn', $report->metadataValue('theme'));
    }
}
