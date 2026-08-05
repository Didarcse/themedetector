<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection;

use App\Modules\Detection\DetectionContext;
use App\Modules\PluginDetection\Contracts\PluginDetectorInterface;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\PluginDetection\PluginRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the PluginDetectionManager orchestration layer.
 *
 * Verifies the complete public contract of the class: the manager
 * delegates detection to the first registered detector that supports the
 * supplied context, stops iterating after that first supporting detector,
 * never invokes detect() on unsupported detectors, evaluates supports() in
 * registration order, and returns a deterministic failed
 * PluginDetectionResult when no detector supports the context. The
 * supplied DetectionContext is never modified and the manager is
 * deterministic.
 *
 * The manager is intentionally a pure orchestrator. It performs no
 * detection, no parsing, no mapping, no confidence calculation, and no
 * business logic. The tests reflect that contract and never assert any
 * behaviour beyond it.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginDetectionManager, a real PluginRegistry, PHPUnit
 * mocks of PluginDetectorInterface, and a real DetectionContext. There is
 * no filesystem access, no HTTP, and no fixtures.
 */
final class PluginDetectionManagerTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Create a real detection context carrying the supplied HTML body.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function createContext(string $html = '<html></html>'): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: $html,
            statusCode: 200,
        );
    }

    /**
     * Create a mock plugin detector without any configured expectations.
     *
     * @return MockObject&PluginDetectorInterface The mock detector instance.
     */
    private function createDetector(): MockObject&PluginDetectorInterface
    {
        return $this->createMock(PluginDetectorInterface::class);
    }

    /**
     * Create a detected plugin detection result carrying the supplied
     * confidence score.
     *
     * @param int $confidence The confidence score (0–100).
     *
     * @return PluginDetectionResult The detected plugin detection result.
     */
    private function createDetectedResult(int $confidence = 75): PluginDetectionResult
    {
        return new PluginDetectionResult(
            detected: true,
            plugin: new PluginMetadata(name: 'Detected Plugin'),
            confidence: $confidence,
        );
    }

    /**
     * Create a registry pre-loaded with the supplied detectors.
     *
     * @param list<PluginDetectorInterface> $detectors The detectors to
     *                                                 register.
     *
     * @return PluginRegistry The real registry instance.
     */
    private function createRegistry(array $detectors): PluginRegistry
    {
        $registry = new PluginRegistry();

        foreach ($detectors as $detector) {
            $registry->register($detector);
        }

        return $registry;
    }

    /**
     * Verify that the manager returns the PluginDetectionResult produced
     * by the first supporting detector.
     *
     * Detectors that do not support the context must be skipped and the
     * first detector that does support it must be delegated to.
     */
    public function test_returns_result_from_first_supporting_detector(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();

        $unsupported = $this->createDetector();
        $unsupported->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(false);
        $unsupported->expects(self::never())
            ->method('detect');

        $supporting = $this->createDetector();
        $supporting->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn($expected);

        $manager = new PluginDetectionManager(
            $this->createRegistry([$unsupported, $supporting]),
        );
        $returned = $manager->detect($context);

        self::assertSame($expected, $returned);
    }

    /**
     * Verify that the manager stops iterating after the first supporting
     * detector.
     *
     * Detectors registered after the first supporting detector must never
     * be consulted: neither supports() nor detect() may be invoked on
     * them.
     */
    public function test_stops_iterating_after_first_supporting_detector(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();

        $supporting = $this->createDetector();
        $supporting->expects(self::once())
            ->method('supports')
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->willReturn($expected);

        $neverConsulted = $this->createDetector();
        $neverConsulted->expects(self::never())
            ->method('supports');
        $neverConsulted->expects(self::never())
            ->method('detect');

        $manager = new PluginDetectionManager(
            $this->createRegistry([$supporting, $neverConsulted]),
        );
        $returned = $manager->detect($context);

        self::assertSame($expected, $returned);
    }

    /**
     * Verify that the manager never invokes detect() on unsupported
     * detectors.
     *
     * A detector whose supports() returns false must only ever be asked
     * whether it supports the context and must never be delegated to.
     */
    public function test_never_invokes_detect_on_unsupported_detectors(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();

        $unsupported = $this->createDetector();
        $unsupported->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(false);
        $unsupported->expects(self::never())
            ->method('detect');

        $supporting = $this->createDetector();
        $supporting->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn($expected);

        $manager = new PluginDetectionManager(
            $this->createRegistry([$unsupported, $supporting]),
        );
        $manager->detect($context);
    }

    /**
     * Verify that the manager evaluates supports() in registration order.
     *
     * When a detector that supports the context is registered after an
     * unsupported detector, the supporting detector is only ever consulted
     * after the unsupported one. The invocation sequence is recorded
     * explicitly.
     */
    public function test_evaluates_supports_in_registration_order(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();
        $order = [];

        $detectorA = $this->createDetector();
        $detectorA->expects(self::once())
            ->method('supports')
            ->willReturnCallback(
                static function () use (&$order): bool {
                    $order[] = 'A';

                    return false;
                },
            );

        $detectorB = $this->createDetector();
        $detectorB->expects(self::once())
            ->method('supports')
            ->willReturnCallback(
                static function () use (&$order): bool {
                    $order[] = 'B';

                    return true;
                },
            );
        $detectorB->expects(self::once())
            ->method('detect')
            ->willReturn($expected);

        $detectorC = $this->createDetector();
        $detectorC->expects(self::never())
            ->method('supports');

        $manager = new PluginDetectionManager(
            $this->createRegistry([$detectorA, $detectorB, $detectorC]),
        );
        $returned = $manager->detect($context);

        self::assertSame(['A', 'B'], $order);
        self::assertSame($expected, $returned);
    }

    /**
     * Verify that a deterministic failed PluginDetectionResult is returned
     * when no detector supports the supplied context.
     *
     * Every registered detector is consulted, none supports the context,
     * and the manager falls back to its canonical failed result.
     */
    public function test_returns_deterministic_failed_result_when_none_support(): void
    {
        $context = $this->createContext();

        $detectorA = $this->createDetector();
        $detectorA->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(false);
        $detectorA->expects(self::never())
            ->method('detect');

        $detectorB = $this->createDetector();
        $detectorB->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(false);
        $detectorB->expects(self::never())
            ->method('detect');

        $manager = new PluginDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $result = $manager->detect($context);

        self::assertInstanceOf(PluginDetectionResult::class, $result);
        self::assertFalse($result->isDetected());
        self::assertNull($result->plugin());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the failed result carries detected = false, plugin =
     * null, and confidence = 0.
     *
     * The failed result is the canonical empty outcome of the manager and
     * its three fields must always have their documented defaults.
     */
    public function test_failed_result_contains_expected_values(): void
    {
        $manager = new PluginDetectionManager($this->createRegistry([]));
        $result = $manager->detect($this->createContext());

        self::assertFalse($result->isDetected());
        self::assertNull($result->plugin());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the manager never modifies the supplied DetectionContext.
     *
     * The exact same context instance must be passed to supports() and
     * detect() of the supporting detector, and its immutable values must
     * remain unchanged after the manager returns.
     */
    public function test_never_modifies_supplied_context(): void
    {
        $context = $this->createContext('<html>contact-form-7</html>');
        $expected = $this->createDetectedResult();

        $supporting = $this->createDetector();
        $supporting->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn($expected);

        $manager = new PluginDetectionManager(
            $this->createRegistry([$supporting]),
        );
        $manager->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame('<html>contact-form-7</html>', $context->html());
        self::assertSame(200, $context->statusCode());
        self::assertSame([], $context->headers());
        self::assertSame(0.0, $context->responseTime());
        self::assertTrue($context->isSuccess());
    }

    /**
     * Verify that the manager is deterministic.
     *
     * Repeated detections with the same context return the same result,
     * and an empty registry always yields the canonical failed result
     * regardless of how many times it is consulted.
     */
    public function test_manager_is_deterministic(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();

        $supporting = $this->createDetector();
        $supporting->method('supports')->willReturn(true);
        $supporting->method('detect')->willReturn($expected);

        $manager = new PluginDetectionManager(
            $this->createRegistry([$supporting]),
        );

        self::assertSame($expected, $manager->detect($context));
        self::assertSame($expected, $manager->detect($context));

        $emptyManager = new PluginDetectionManager($this->createRegistry([]));

        $first = $emptyManager->detect($context);
        $second = $emptyManager->detect($context);

        self::assertFalse($first->isDetected());
        self::assertFalse($second->isDetected());
        self::assertNull($first->plugin());
        self::assertNull($second->plugin());
        self::assertSame(0, $first->confidence());
        self::assertSame(0, $second->confidence());
    }
}
