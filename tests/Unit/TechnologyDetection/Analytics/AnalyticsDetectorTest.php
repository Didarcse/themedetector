<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Analytics;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\AbstractCategoryDetector;
use App\Modules\TechnologyDetection\Analytics\AnalyticsDetector;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;
use App\Modules\TechnologyDetection\TechnologyMetadata;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Unit tests for the AnalyticsDetector.
 *
 * Verifies the category detection flow over the analytics rule set:
 * multiple platforms are reported in rule order, an empty list is
 * returned when nothing matches, the context is never modified, and
 * detection is deterministic.
 */
final class AnalyticsDetectorTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Create the analytics detector under test.
     *
     * @param int $maxTechnologies The maximum number of technologies to
     *                             report.
     *
     * @return AnalyticsDetector The detector instance.
     */
    private function createDetector(
        int $maxTechnologies = AbstractCategoryDetector::MAX_TECHNOLOGIES,
    ): AnalyticsDetector {
        return new AnalyticsDetector(new TechnologyMetadataMapper(), $maxTechnologies);
    }

    /**
     * Create a real detection context carrying the supplied HTML body.
     *
     * @param string $html The HTML body.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function createContext(string $html): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: $html,
            statusCode: 200,
        );
    }

    /**
     * Return the metadata of the result at the supplied index, failing the
     * test when it is absent.
     *
     * @param list<TechnologyDetectionResult> $results The detected
     *                                                 technology results.
     * @param int                             $index   The zero-based result
     *                                                 index.
     *
     * @return TechnologyMetadata The non-null result metadata.
     */
    private function metadataAt(array $results, int $index): TechnologyMetadata
    {
        $metadata = $results[$index]->metadata();

        if ($metadata === null) {
            throw new RuntimeException('Expected the detected result to carry metadata.');
        }

        return $metadata;
    }

    /**
     * Verify that every present analytics platform is reported in rule
     * order.
     */
    public function test_detects_multiple_platforms_in_rule_order(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>'
            . '<script src="https://connect.facebook.net/en_US/fbevents.js"></script>'
            . '<script src="https://static.hotjar.com/c/hotjar-1234567.js?sv=6"></script>';

        $results = $this->createDetector()->detect($this->createContext($html));

        self::assertCount(3, $results);
        self::assertSame('google-analytics', $this->metadataAt($results, 0)->slug());
        self::assertSame('meta-pixel', $this->metadataAt($results, 1)->slug());
        self::assertSame('hotjar', $this->metadataAt($results, 2)->slug());
    }

    /**
     * Verify that the detector supports any context.
     */
    public function test_supports_any_context(): void
    {
        self::assertTrue($this->createDetector()->supports($this->createContext('<html></html>')));
    }

    /**
     * Verify that an empty list is returned when no platform matches.
     */
    public function test_returns_empty_list_when_nothing_matches(): void
    {
        $html = '<html><head><title>Static page</title></head></html>';

        self::assertSame([], $this->createDetector()->detect($this->createContext($html)));
    }

    /**
     * Verify that the output cap limits the number of reported
     * technologies.
     */
    public function test_caps_number_of_detected_platforms(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>'
            . '<script src="https://connect.facebook.net/en_US/fbevents.js"></script>';

        $results = $this->createDetector(1)->detect($this->createContext($html));

        self::assertCount(1, $results);
        self::assertSame('google-analytics', $this->metadataAt($results, 0)->slug());
    }

    /**
     * Verify that the supplied DetectionContext is never modified.
     */
    public function test_never_modifies_supplied_context(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>';
        $context = $this->createContext($html);

        $this->createDetector()->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame($html, $context->html());
        self::assertSame(200, $context->statusCode());
    }

    /**
     * Verify that detection is deterministic.
     */
    public function test_detector_is_deterministic(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>';

        $detector = $this->createDetector();

        self::assertEquals(
            $detector->detect($this->createContext($html)),
            $detector->detect($this->createContext($html)),
        );
    }
}
