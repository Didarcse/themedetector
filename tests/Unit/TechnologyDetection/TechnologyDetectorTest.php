<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\Contracts\TechnologyDetectorInterface;
use App\Modules\TechnologyDetection\TechnologyDetector;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;
use App\Modules\TechnologyDetection\TechnologyMetadata;
use App\Modules\TechnologyDetection\TechnologyRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the TechnologyDetector facade.
 *
 * Verifies the complete public contract of the class: it delegates
 * detection to the TechnologyDetectionManager, returns the exact list of
 * TechnologyDetectionResult instances produced by the manager, passes the
 * exact DetectionContext through, and never modifies either. The facade is
 * intentionally a thin delegation layer.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real TechnologyDetector, a real TechnologyDetectionManager, a
 * real TechnologyRegistry, a PHPUnit mock of TechnologyDetectorInterface,
 * and a real DetectionContext. There is no filesystem access, no HTTP,
 * and no fixtures.
 */
final class TechnologyDetectorTest extends TestCase
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
     * Create a detected technology detection result.
     *
     * @return TechnologyDetectionResult The detected technology detection
     *                                   result.
     */
    private function createDetectedResult(): TechnologyDetectionResult
    {
        return new TechnologyDetectionResult(
            detected: true,
            metadata: new TechnologyMetadata(name: 'Detected Technology', slug: 'detected-technology'),
            confidence: 90,
        );
    }

    /**
     * Create a real TechnologyDetector backed by a real manager and a
     * real registry carrying the supplied detector.
     *
     * @param TechnologyDetectorInterface $detector The detector to register.
     *
     * @return TechnologyDetector The real facade instance.
     */
    private function createDetector(TechnologyDetectorInterface $detector): TechnologyDetector
    {
        $registry = new TechnologyRegistry();
        $registry->register($detector);

        return new TechnologyDetector(
            new TechnologyDetectionManager($registry),
        );
    }

    /**
     * Create a mock technology detector that supports every context and
     * returns the supplied list of results.
     *
     * @param list<TechnologyDetectionResult> $results The results returned
     *                                                 by the detector.
     *
     * @return MockObject&TechnologyDetectorInterface The mock detector
     *                                                instance.
     */
    private function createSupportingDetector(array $results): MockObject&TechnologyDetectorInterface
    {
        $detector = $this->createMock(TechnologyDetectorInterface::class);
        $detector->method('supports')->willReturn(true);
        $detector->method('detect')->willReturn($results);

        return $detector;
    }

    /**
     * Verify that the facade delegates detection to the manager and
     * returns the exact list produced by the pipeline.
     *
     * The facade must forward the exact DetectionContext instance and
     * return the manager result list unchanged.
     */
    public function test_delegates_detection_to_manager_and_returns_list(): void
    {
        $context = $this->createContext();
        $expected = $this->createDetectedResult();

        $detector = $this->createDetector($this->createSupportingDetector([$expected]));
        $returned = $detector->detect($context);

        self::assertSame([$expected], $returned);
    }

    /**
     * Verify that the facade never modifies the supplied DetectionContext.
     *
     * The exact same context instance is forwarded through the manager to
     * the supporting detector and its immutable values remain unchanged
     * after the facade returns.
     */
    public function test_never_modifies_supplied_context(): void
    {
        $context = $this->createContext('<html>vendor-script.js</html>');
        $expected = $this->createDetectedResult();

        $supporting = $this->createMock(TechnologyDetectorInterface::class);
        $supporting->expects(self::once())
            ->method('supports')
            ->with(self::identicalTo($context))
            ->willReturn(true);
        $supporting->expects(self::once())
            ->method('detect')
            ->with(self::identicalTo($context))
            ->willReturn([$expected]);

        $detector = $this->createDetector($supporting);
        $detector->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame('<html>vendor-script.js</html>', $context->html());
        self::assertSame(200, $context->statusCode());
        self::assertSame([], $context->headers());
        self::assertSame(0.0, $context->responseTime());
        self::assertTrue($context->isSuccess());
    }
}
