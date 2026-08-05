<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\DetectorRegistry;
use PHPUnit\Framework\TestCase;

final class DetectionEngineTest extends TestCase
{
    private function createContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<html></html>',
            statusCode: 200,
        );
    }

    private function createResult(
        string $technology,
        int $confidence,
        bool $detected = true,
    ): DetectionResult {
        return new DetectionResult(
            technology: $technology,
            detected: $detected,
            confidence: $confidence,
            theme: null,
            plugins: [],
            metadata: [],
        );
    }

    public function test_executes_all_detectors(): void
    {
        $results = [
            $this->createResult('Shopify', 95),
            $this->createResult('WordPress', 60),
        ];

        $detectors = [];

        foreach ($results as $result) {
            $detector = $this->createMock(DetectorInterface::class);
            $detector->method('detect')->willReturn($result);
            $detectors[] = $detector;
        }

        $engine = new DetectionEngine(new DetectorRegistry($detectors));
        $output = $engine->detect($this->createContext());

        self::assertCount(2, $output);
        self::assertSame('Shopify', $output[0]->technology());
        self::assertSame('WordPress', $output[1]->technology());
    }

    public function test_preserves_detector_order(): void
    {
        $detectors = [];

        foreach (['A', 'B', 'C'] as $name) {
            $result = $this->createResult($name, 50);
            $detector = $this->createMock(DetectorInterface::class);
            $detector->method('detect')->willReturn($result);
            $detectors[] = $detector;
        }

        $engine = new DetectionEngine(new DetectorRegistry($detectors));
        $output = $engine->detect($this->createContext());

        self::assertSame('A', $output[0]->technology());
        self::assertSame('B', $output[1]->technology());
        self::assertSame('C', $output[2]->technology());
    }

    public function test_returns_list_of_detection_results(): void
    {
        $result = $this->createResult('Shopify', 95);
        $detector = $this->createMock(DetectorInterface::class);
        $detector->method('detect')->willReturn($result);

        $engine = new DetectionEngine(new DetectorRegistry([$detector]));
        $output = $engine->detect($this->createContext());

        self::assertCount(1, $output);
        self::assertSame('Shopify', $output[0]->technology());
    }

    public function test_handles_empty_registry(): void
    {
        $engine = new DetectionEngine(new DetectorRegistry([]));
        $output = $engine->detect($this->createContext());

        self::assertSame([], $output);
    }

    public function test_includes_failed_detections(): void
    {
        $success = $this->createResult('Shopify', 95, true);
        $failed = $this->createResult('Unknown', 0, false);

        $detector1 = $this->createMock(DetectorInterface::class);
        $detector1->method('detect')->willReturn($success);

        $detector2 = $this->createMock(DetectorInterface::class);
        $detector2->method('detect')->willReturn($failed);

        $engine = new DetectionEngine(new DetectorRegistry([$detector1, $detector2]));
        $output = $engine->detect($this->createContext());

        self::assertCount(2, $output);
        self::assertTrue($output[0]->isDetected());
        self::assertFalse($output[1]->isDetected());
    }

    public function test_propagates_detector_exception(): void
    {
        $detector = $this->createMock(DetectorInterface::class);
        $detector->method('detect')->willThrowException(new \RuntimeException('Detector failed'));

        $engine = new DetectionEngine(new DetectorRegistry([$detector]));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Detector failed');

        $engine->detect($this->createContext());
    }
}
