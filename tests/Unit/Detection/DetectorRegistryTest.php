<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\DetectorRegistry;
use PHPUnit\Framework\TestCase;

final class DetectorRegistryTest extends TestCase
{
    private function createMockDetector(string $name): DetectorInterface
    {
        $result = new DetectionResult(
            technology: $name,
            detected: true,
            confidence: 50,
            theme: null,
            plugins: [],
            metadata: [],
        );

        $detector = $this->createMock(DetectorInterface::class);
        $detector->method('detect')->willReturn($result);

        return $detector;
    }

    public function test_constructs_with_empty_iterable(): void
    {
        $registry = new DetectorRegistry([]);

        self::assertSame(0, $registry->count());
        self::assertSame([], iterator_to_array($registry->all()));
    }

    public function test_constructs_with_array(): void
    {
        $detectors = [
            $this->createMockDetector('Shopify'),
            $this->createMockDetector('WordPress'),
        ];

        $registry = new DetectorRegistry($detectors);

        self::assertSame(2, $registry->count());
    }

    public function test_constructs_with_traversable(): void
    {
        $detectors = [
            $this->createMockDetector('Shopify'),
            $this->createMockDetector('WordPress'),
        ];

        $generator = (function () use ($detectors): \Generator {
            yield from $detectors;
        })();

        $registry = new DetectorRegistry($generator);

        self::assertSame(2, $registry->count());
    }

    public function test_all_returns_all_detectors(): void
    {
        $detectors = [
            $this->createMockDetector('Shopify'),
            $this->createMockDetector('WordPress'),
        ];

        $registry = new DetectorRegistry($detectors);

        $all = $registry->all();

        self::assertCount(2, $all);
        self::assertContainsOnlyInstancesOf(DetectorInterface::class, $all);
    }

    public function test_preserves_insertion_order(): void
    {
        $names = ['Z', 'A', 'M', 'B'];

        $detectors = array_map(
            fn (string $name): DetectorInterface => $this->createMockDetector($name),
            $names,
        );

        $registry = new DetectorRegistry($detectors);

        $context = new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: '<html></html>',
            statusCode: 200,
        );

        $result = [];
        foreach ($registry->all() as $detector) {
            $result[] = $detector->detect($context)->technology();
        }

        self::assertSame(['Z', 'A', 'M', 'B'], $result);
    }

    public function test_iteration_is_reusable(): void
    {
        $detectors = [
            $this->createMockDetector('Shopify'),
            $this->createMockDetector('WordPress'),
        ];

        $registry = new DetectorRegistry($detectors);

        $first = iterator_to_array($registry->all());
        $second = iterator_to_array($registry->all());

        self::assertCount(2, $first);
        self::assertCount(2, $second);
        self::assertSame($first, $second);
    }

    public function test_count_returns_correct_number(): void
    {
        $detectors = [
            $this->createMockDetector('A'),
            $this->createMockDetector('B'),
            $this->createMockDetector('C'),
        ];

        $registry = new DetectorRegistry($detectors);

        self::assertSame(3, $registry->count());
    }

    public function test_count_returns_zero_when_empty(): void
    {
        $registry = new DetectorRegistry([]);

        self::assertSame(0, $registry->count());
    }
}
