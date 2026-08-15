<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\Contracts\TechnologyDetectorInterface;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;
use App\Modules\TechnologyDetection\TechnologyMetadata;
use App\Modules\TechnologyDetection\TechnologyRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Unit tests for the TechnologyDetectionManager orchestration layer.
 *
 * Verifies the complete multi-hit public contract of the class: the
 * manager consults every registered detector that supports the supplied
 * context, aggregates all returned results in registration order,
 * deduplicates them by slug (falling back to the normalized technology
 * name) keeping the highest-confidence result, returns an empty list when
 * no detector supports the context, and throws a RuntimeException when no
 * detector has been registered. The supplied DetectionContext is never
 * modified and the manager is deterministic.
 *
 * The manager is intentionally a pure orchestrator. It performs no
 * detection, no parsing, no mapping, no confidence calculation, and no
 * business logic. The tests reflect that contract and never assert any
 * behaviour beyond it.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real TechnologyDetectionManager, a real TechnologyRegistry,
 * PHPUnit mocks of TechnologyDetectorInterface, and a real
 * DetectionContext. There is no filesystem access, no HTTP, and no
 * fixtures.
 */
final class TechnologyDetectionManagerTest extends TestCase
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
     * Create a detected technology detection result carrying the supplied
     * identity and confidence score.
     *
     * @param string      $name       The technology name.
     * @param string|null $slug       The technology slug, null to exercise
     *                                the normalized-name deduplication key.
     * @param int         $confidence The confidence score (0–100).
     *
     * @return TechnologyDetectionResult The detected technology detection
     *                                   result.
     */
    private function createResult(string $name, ?string $slug = null, int $confidence = 75): TechnologyDetectionResult
    {
        return new TechnologyDetectionResult(
            detected: true,
            metadata: new TechnologyMetadata(name: $name, slug: $slug),
            confidence: $confidence,
        );
    }

    /**
     * Create a mock technology detector without any configured
     * expectations.
     *
     * @return MockObject&TechnologyDetectorInterface The mock detector
     *                                                instance.
     */
    private function createDetector(): MockObject&TechnologyDetectorInterface
    {
        return $this->createMock(TechnologyDetectorInterface::class);
    }

    /**
     * Create a registry pre-loaded with the supplied detectors.
     *
     * @param list<TechnologyDetectorInterface> $detectors The detectors to
     *                                                     register.
     *
     * @return TechnologyRegistry The real registry instance.
     */
    private function createRegistry(array $detectors): TechnologyRegistry
    {
        $registry = new TechnologyRegistry();

        foreach ($detectors as $detector) {
            $registry->register($detector);
        }

        return $registry;
    }

    /**
     * Verify that every supporting detector is consulted.
     *
     * In the multi-hit contract the manager must delegate to every
     * registered detector that supports the context, never stopping after
     * the first one.
     */
    public function test_consults_every_supporting_detector(): void
    {
        $context = $this->createContext();
        $resultA = $this->createResult('Technology A', 'tech-a');
        $resultB = $this->createResult('Technology B', 'tech-b');

        $detectorA = $this->createDetector();
        $detectorA->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $detectorA->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn([$resultA]);

        $detectorB = $this->createDetector();
        $detectorB->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $detectorB->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn([$resultB]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertSame([$resultA, $resultB], $returned);
    }

    /**
     * Verify that the aggregated results preserve registration order.
     *
     * Results collected from detectors registered later must appear after
     * results collected from detectors registered earlier.
     */
    public function test_preserves_registration_order_before_dedup(): void
    {
        $context = $this->createContext();
        $resultA = $this->createResult('Technology A', 'tech-a');
        $resultB = $this->createResult('Technology B', 'tech-b');
        $resultC = $this->createResult('Technology C', 'tech-c');

        $detectorA = $this->createDetector();
        $detectorA->method('supports')->willReturn(true);
        $detectorA->method('detect')->willReturn([$resultA]);

        $detectorB = $this->createDetector();
        $detectorB->method('supports')->willReturn(true);
        $detectorB->method('detect')->willReturn([$resultB]);

        $detectorC = $this->createDetector();
        $detectorC->method('supports')->willReturn(true);
        $detectorC->method('detect')->willReturn([$resultC]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB, $detectorC]),
        );
        $returned = $manager->detect($context);

        self::assertSame([$resultA, $resultB, $resultC], $returned);
    }

    /**
     * Verify that multiple results produced by a single detector are
     * aggregated.
     *
     * A detector reports every technology it identified; all of them must
     * appear in the aggregated list.
     */
    public function test_aggregates_multiple_results_from_detectors(): void
    {
        $context = $this->createContext();
        $resultA = $this->createResult('Technology A', 'tech-a');
        $resultB = $this->createResult('Technology B', 'tech-b');
        $resultC = $this->createResult('Technology C', 'tech-c');

        $detectorA = $this->createDetector();
        $detectorA->method('supports')->willReturn(true);
        $detectorA->method('detect')->willReturn([$resultA, $resultB]);

        $detectorB = $this->createDetector();
        $detectorB->method('supports')->willReturn(true);
        $detectorB->method('detect')->willReturn([$resultC]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertSame([$resultA, $resultB, $resultC], $returned);
    }

    /**
     * Verify that a duplicate slug keeps the highest-confidence result.
     *
     * Two detectors report the same technology slug; the higher-confidence
     * result must win and occupy the first occurrence position.
     */
    public function test_duplicate_slug_keeps_highest_confidence(): void
    {
        $context = $this->createContext();
        $weaker = $this->createResult('jQuery', 'jquery', 50);
        $stronger = $this->createResult('jQuery', 'jquery', 80);

        $detectorA = $this->createDetector();
        $detectorA->method('supports')->willReturn(true);
        $detectorA->method('detect')->willReturn([$weaker]);

        $detectorB = $this->createDetector();
        $detectorB->method('supports')->willReturn(true);
        $detectorB->method('detect')->willReturn([$stronger]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertCount(1, $returned);
        self::assertSame($stronger, $returned[0]);
        self::assertSame(80, $returned[0]->confidence());
    }

    /**
     * Verify that the normalized technology name is used as the fallback
     * deduplication key when no slug is present.
     *
     * Results without a slug must be deduplicated case-insensitively and
     * on trimmed surrounding whitespace.
     */
    public function test_normalized_name_fallback_dedup(): void
    {
        $context = $this->createContext();
        $weaker = $this->createResult('jQuery', null, 40);
        $stronger = $this->createResult(' jquery ', null, 90);

        $detectorA = $this->createDetector();
        $detectorA->method('supports')->willReturn(true);
        $detectorA->method('detect')->willReturn([$weaker]);

        $detectorB = $this->createDetector();
        $detectorB->method('supports')->willReturn(true);
        $detectorB->method('detect')->willReturn([$stronger]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertCount(1, $returned);
        self::assertSame($stronger, $returned[0]);
        self::assertSame(90, $returned[0]->confidence());
    }

    /**
     * Verify that a duplicate with a lower confidence is discarded.
     *
     * When the second occurrence of a deduplication key carries a lower
     * confidence than the first, the first result must be kept unchanged.
     */
    public function test_duplicate_with_lower_confidence_is_discarded(): void
    {
        $context = $this->createContext();
        $stronger = $this->createResult('React', 'react', 90);
        $weaker = $this->createResult('React', 'react', 40);

        $detectorA = $this->createDetector();
        $detectorA->method('supports')->willReturn(true);
        $detectorA->method('detect')->willReturn([$stronger]);

        $detectorB = $this->createDetector();
        $detectorB->method('supports')->willReturn(true);
        $detectorB->method('detect')->willReturn([$weaker]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertCount(1, $returned);
        self::assertSame($stronger, $returned[0]);
        self::assertSame(90, $returned[0]->confidence());
    }

    /**
     * Verify that an empty list is returned when no detector supports the
     * supplied context.
     *
     * Every registered detector is consulted, none supports the context,
     * and the manager falls back to the canonical empty outcome.
     */
    public function test_returns_empty_list_when_no_detector_supports(): void
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

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$detectorA, $detectorB]),
        );
        $returned = $manager->detect($context);

        self::assertSame([], $returned);
    }

    /**
     * Verify that the manager never invokes detect() on unsupported
     * detectors.
     *
     * A detector whose supports() returns false is only ever asked whether
     * it supports the context and is never delegated to.
     */
    public function test_never_invokes_detect_on_unsupported_detectors(): void
    {
        $context = $this->createContext();
        $result = $this->createResult('Technology A', 'tech-a');

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
            ->willReturn([$result]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$unsupported, $supporting]),
        );
        $returned = $manager->detect($context);

        self::assertSame([$result], $returned);
    }

    /**
     * Verify that the manager throws a RuntimeException when no detector
     * has been registered.
     *
     * An empty registry is a composition error, not a detection outcome:
     * the manager must report it instead of silently returning an empty
     * list.
     */
    public function test_throws_when_no_detectors_registered(): void
    {
        $manager = new TechnologyDetectionManager($this->createRegistry([]));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('No technology detectors have been registered.');

        $manager->detect($this->createContext());
    }

    /**
     * Verify that the manager never modifies the supplied DetectionContext.
     *
     * The exact same context instance must be passed to supports() and
     * detect() of every supporting detector, and its immutable values must
     * remain unchanged after the manager returns.
     */
    public function test_never_modifies_supplied_context(): void
    {
        $context = $this->createContext('<html>vendor-script.js</html>');
        $result = $this->createResult('Technology A', 'tech-a');

        $supporting = $this->createDetector();
        $supporting->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn([$result]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$supporting]),
        );
        $manager->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame('<html>vendor-script.js</html>', $context->html());
        self::assertSame(200, $context->statusCode());
        self::assertSame([], $context->headers());
        self::assertSame(0.0, $context->responseTime());
        self::assertTrue($context->isSuccess());
    }

    /**
     * Verify that the manager is deterministic.
     *
     * Repeated detections with the same context return the identical
     * aggregated list, including the deduplication outcome.
     */
    public function test_manager_is_deterministic(): void
    {
        $context = $this->createContext();
        $resultA = $this->createResult('Technology A', 'tech-a');
        $resultB = $this->createResult('Technology B', 'tech-b');

        $supporting = $this->createDetector();
        $supporting->method('supports')->willReturn(true);
        $supporting->method('detect')->willReturn([$resultA, $resultB]);

        $manager = new TechnologyDetectionManager(
            $this->createRegistry([$supporting]),
        );

        self::assertSame([$resultA, $resultB], $manager->detect($context));
        self::assertSame([$resultA, $resultB], $manager->detect($context));

        $duplicate = $this->createResult('Technology A', 'tech-a', 60);
        $overlapping = $this->createDetector();
        $overlapping->method('supports')->willReturn(true);
        $overlapping->method('detect')->willReturn([$duplicate]);

        $dedupManager = new TechnologyDetectionManager(
            $this->createRegistry([$supporting, $overlapping]),
        );

        $first = $dedupManager->detect($context);
        $second = $dedupManager->detect($context);

        self::assertSame($first, $second);
        self::assertCount(2, $first);
        self::assertSame($resultA, $first[0]);
        self::assertSame($resultB, $first[1]);
    }
}
