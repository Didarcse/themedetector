<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\DetectorRegistry;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class DetectionManagerTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createContext(string $html = '<html></html>'): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: $html,
            statusCode: 200,
        );
    }

    private function createDetector(DetectionResult $result): DetectorInterface
    {
        $detector = $this->createMock(DetectorInterface::class);
        $detector->expects(self::once())
            ->method('detect')
            ->willReturn($result);

        return $detector;
    }

    private function createResult(string $technology, int $confidence): DetectionResult
    {
        return new DetectionResult(
            technology: $technology,
            detected: $confidence > 0,
            confidence: $confidence,
            theme: null,
            plugins: [],
            metadata: [],
        );
    }

    public function test_throws_exception_when_registry_is_empty(): void
    {
        $manager = new DetectionManager(new DetectorRegistry([]));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('No detectors have been registered.');

        $manager->detect($this->createContext());
    }

    public function test_returns_single_detector_result(): void
    {
        $result = $this->createResult('WordPress', 75);
        $detector = $this->createDetector($result);

        $manager = new DetectionManager(new DetectorRegistry([$detector]));
        $returned = $manager->detect($this->createContext());

        self::assertSame($result, $returned);
    }

    public function test_returns_highest_confidence_result(): void
    {
        $low = $this->createResult('WordPress', 30);
        $high = $this->createResult('Shopify', 90);
        $mid = $this->createResult('Ghost', 60);

        $detectorLow = $this->createDetector($low);
        $detectorHigh = $this->createDetector($high);
        $detectorMid = $this->createDetector($mid);

        $manager = new DetectionManager(
            new DetectorRegistry([$detectorLow, $detectorHigh, $detectorMid]),
        );
        $returned = $manager->detect($this->createContext());

        self::assertSame($high, $returned);
    }

    public function test_keeps_first_result_when_confidence_is_equal(): void
    {
        $first = $this->createResult('WordPress', 80);
        $second = $this->createResult('Shopify', 80);

        $detectorFirst = $this->createDetector($first);
        $detectorSecond = $this->createDetector($second);

        $manager = new DetectionManager(
            new DetectorRegistry([$detectorFirst, $detectorSecond]),
        );
        $returned = $manager->detect($this->createContext());

        self::assertSame($first, $returned);
    }

    public function test_executes_every_detector_once(): void
    {
        $detectors = [
            $this->createDetector($this->createResult('A', 10)),
            $this->createDetector($this->createResult('B', 20)),
            $this->createDetector($this->createResult('C', 30)),
        ];

        $manager = new DetectionManager(new DetectorRegistry($detectors));
        $manager->detect($this->createContext());
    }

    public function test_passes_context_to_every_detector(): void
    {
        $context = $this->createContext();
        $detectors = [];

        foreach (['A', 'B', 'C'] as $name) {
            $detector = $this->createMock(DetectorInterface::class);
            $detector->expects(self::once())
                ->method('detect')
                ->with($this->identicalTo($context))
                ->willReturn($this->createResult($name, 10));
            $detectors[] = $detector;
        }

        $manager = new DetectionManager(new DetectorRegistry($detectors));
        $manager->detect($context);
    }

    public function test_returns_exact_detection_result_instance(): void
    {
        $result = $this->createResult('Drupal', 55);
        $detector = $this->createDetector($result);

        $manager = new DetectionManager(new DetectorRegistry([$detector]));
        $returned = $manager->detect($this->createContext());

        self::assertSame($result, $returned);
        self::assertSame('Drupal', $returned->technology());
        self::assertSame(55, $returned->confidence());
    }
}
