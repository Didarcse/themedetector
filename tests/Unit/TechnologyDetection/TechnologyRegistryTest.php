<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection;

use App\Modules\TechnologyDetection\Contracts\TechnologyDetectorInterface;
use App\Modules\TechnologyDetection\TechnologyRegistry;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the TechnologyRegistry collection object.
 *
 * Verifies the complete public contract of the class: a newly created
 * registry is empty; registering detectors stores exactly the supplied
 * instances; registration order is preserved; the all() accessor returns
 * the exact registered instances; registered detectors are never
 * modified, filtered, or deduplicated; and the registry is deterministic.
 *
 * The registry is intentionally a pure deterministic collection. It
 * performs no orchestration, no filtering, no deduplication, and no
 * business logic. The tests reflect that contract and never assert any
 * behaviour beyond it.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use PHPUnit mocks of TechnologyDetectorInterface only; the registry
 * itself is always a real instance. There is no filesystem access, no
 * HTTP, and no fixtures.
 */
final class TechnologyRegistryTest extends TestCase
{
    /**
     * Create a mock TechnologyDetectorInterface implementation.
     *
     * @return TechnologyDetectorInterface The mock detector instance.
     */
    private function createDetector(): TechnologyDetectorInterface
    {
        return $this->createMock(TechnologyDetectorInterface::class);
    }

    /**
     * Verify that a newly created registry is empty.
     */
    public function test_newly_created_registry_is_empty(): void
    {
        $registry = new TechnologyRegistry();

        self::assertSame([], $registry->all());
    }

    /**
     * Verify that registering one detector stores exactly one detector.
     */
    public function test_registers_single_detector(): void
    {
        $detector = $this->createDetector();

        $registry = new TechnologyRegistry();
        $registry->register($detector);

        self::assertSame([$detector], $registry->all());
    }

    /**
     * Verify that registering multiple detectors preserves the order in
     * which they were registered.
     */
    public function test_registers_multiple_detectors_in_registration_order(): void
    {
        $detectorA = $this->createDetector();
        $detectorB = $this->createDetector();
        $detectorC = $this->createDetector();

        $registry = new TechnologyRegistry();
        $registry->register($detectorA);
        $registry->register($detectorB);
        $registry->register($detectorC);

        self::assertSame(
            [$detectorA, $detectorB, $detectorC],
            $registry->all(),
        );
    }

    /**
     * Verify that all() returns the exact detector instances that were
     * registered, with no reordering and no transformation.
     */
    public function test_all_returns_exact_registered_instances(): void
    {
        $detectorA = $this->createDetector();
        $detectorB = $this->createDetector();
        $detectorC = $this->createDetector();

        $registry = new TechnologyRegistry();
        $registry->register($detectorA);
        $registry->register($detectorB);
        $registry->register($detectorC);

        $all = $registry->all();

        self::assertCount(3, $all);
        self::assertSame($detectorA, $all[0]);
        self::assertSame($detectorB, $all[1]);
        self::assertSame($detectorC, $all[2]);
    }

    /**
     * Verify that the registry never modifies a registered detector.
     *
     * The registry is a pure collection: it must never invoke any method
     * on the detectors it stores. A detector with explicit never()
     * expectations proves that registration and all() have no
     * side-effects on the stored instances.
     */
    public function test_registry_never_modifies_registered_detectors(): void
    {
        $detectorA = $this->createMock(TechnologyDetectorInterface::class);
        $detectorA->expects(self::never())->method('supports');
        $detectorA->expects(self::never())->method('detect');

        $detectorB = $this->createMock(TechnologyDetectorInterface::class);
        $detectorB->expects(self::never())->method('supports');
        $detectorB->expects(self::never())->method('detect');

        $registry = new TechnologyRegistry();
        $registry->register($detectorA);
        $registry->register($detectorB);

        self::assertSame([$detectorA, $detectorB], $registry->all());
    }

    /**
     * Verify that the registry performs no filtering.
     *
     * Every registered detector is returned by all(), regardless of any
     * characteristic of the instance. There is no selection criterion and
     * no detector is ever excluded.
     */
    public function test_registry_performs_no_filtering(): void
    {
        $detectors = [
            $this->createDetector(),
            $this->createDetector(),
            $this->createDetector(),
        ];

        $registry = new TechnologyRegistry();

        foreach ($detectors as $detector) {
            $registry->register($detector);
        }

        self::assertSame($detectors, $registry->all());
    }

    /**
     * Verify that the registry performs no deduplication.
     *
     * Registering the same detector instance twice must store it twice.
     * The registry never compares, merges, or collapses identical
     * instances.
     */
    public function test_registry_performs_no_deduplication(): void
    {
        $detector = $this->createDetector();

        $registry = new TechnologyRegistry();
        $registry->register($detector);
        $registry->register($detector);

        $all = $registry->all();

        self::assertCount(2, $all);
        self::assertSame($detector, $all[0]);
        self::assertSame($detector, $all[1]);
    }

    /**
     * Verify that the registry is deterministic.
     *
     * Repeated calls to all() on the same registry return identical
     * results, and two registries fed the same detectors in the same
     * order expose identical collections.
     */
    public function test_registry_is_deterministic(): void
    {
        $detectorA = $this->createDetector();
        $detectorB = $this->createDetector();
        $detectorC = $this->createDetector();

        $first = new TechnologyRegistry();
        $first->register($detectorA);
        $first->register($detectorB);
        $first->register($detectorC);

        $second = new TechnologyRegistry();
        $second->register($detectorA);
        $second->register($detectorB);
        $second->register($detectorC);

        self::assertSame($first->all(), $second->all());
        self::assertSame($first->all(), $first->all());
        self::assertSame($second->all(), $second->all());
        self::assertSame(
            [$detectorA, $detectorB, $detectorC],
            $first->all(),
        );
    }
}
