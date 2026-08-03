<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\DetectorRegistry;
use PHPUnit\Framework\TestCase;

final class DetectorRegistryTest extends TestCase
{
    private function createDetector(): DetectorInterface
    {
        return $this->createMock(DetectorInterface::class);
    }

    public function test_registry_is_initially_empty(): void
    {
        $registry = new DetectorRegistry([]);

        self::assertSame(0, $registry->count());
        self::assertSame([], iterator_to_array($registry->all()));
    }

    public function test_registers_single_detector(): void
    {
        $detector = $this->createDetector();

        $registry = new DetectorRegistry([$detector]);

        self::assertSame(1, $registry->count());
        self::assertSame([$detector], iterator_to_array($registry->all()));
    }

    public function test_registers_multiple_detectors(): void
    {
        $detectorA = $this->createDetector();
        $detectorB = $this->createDetector();
        $detectorC = $this->createDetector();

        $registry = new DetectorRegistry([$detectorA, $detectorB, $detectorC]);

        self::assertSame(3, $registry->count());
        self::assertSame(
            [$detectorA, $detectorB, $detectorC],
            iterator_to_array($registry->all()),
        );
    }

    public function test_all_returns_registered_detectors(): void
    {
        $detectors = [
            $this->createDetector(),
            $this->createDetector(),
            $this->createDetector(),
        ];

        $registry = new DetectorRegistry($detectors);

        self::assertSame($detectors, iterator_to_array($registry->all()));
    }

    public function test_accepts_generator(): void
    {
        $detectorA = $this->createDetector();
        $detectorB = $this->createDetector();

        $generator = (function () use ($detectorA, $detectorB): \Generator {
            yield $detectorA;
            yield $detectorB;
        })();

        $registry = new DetectorRegistry($generator);

        self::assertSame(2, $registry->count());
        self::assertSame(
            [$detectorA, $detectorB],
            iterator_to_array($registry->all()),
        );
    }

    public function test_count_returns_registered_detector_count(): void
    {
        $registry = new DetectorRegistry([
            $this->createDetector(),
            $this->createDetector(),
            $this->createDetector(),
            $this->createDetector(),
        ]);

        self::assertSame(4, $registry->count());
    }
}
