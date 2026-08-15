<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection;

use App\Core\Container;
use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\Analytics\AnalyticsDetector;
use App\Modules\TechnologyDetection\Cdn\CdnDetector;
use App\Modules\TechnologyDetection\JavaScriptLibrary\JavaScriptLibraryDetector;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;
use App\Modules\TechnologyDetection\TechnologyRegistryFactory;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Unit tests for the TechnologyRegistryFactory.
 *
 * Verifies that the factory assembles a working registry containing the
 * three category detectors in registration order, and that the assembled
 * registry drives an end-to-end detection flow through the manager.
 */
final class TechnologyRegistryFactoryTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Create the registry factory under test.
     *
     * @return TechnologyRegistryFactory The factory instance.
     */
    private function createFactory(): TechnologyRegistryFactory
    {
        return new TechnologyRegistryFactory();
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
     * Verify that the factory registers exactly the three category
     * detectors in order.
     */
    public function test_create_registers_three_category_detectors_in_order(): void
    {
        $registry = $this->createFactory()->create(new Container());

        $detectors = $registry->all();

        self::assertCount(3, $detectors);
        self::assertInstanceOf(JavaScriptLibraryDetector::class, $detectors[0]);
        self::assertInstanceOf(CdnDetector::class, $detectors[1]);
        self::assertInstanceOf(AnalyticsDetector::class, $detectors[2]);
    }

    /**
     * Verify that the assembled registry drives an end-to-end detection
     * flow through the manager.
     */
    public function test_registry_detects_technologies_end_to_end(): void
    {
        $manager = new TechnologyDetectionManager(
            $this->createFactory()->create(new Container()),
        );

        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>'
            . '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>';

        $results = $manager->detect($this->createContext($html));

        $slugs = array_map(
            static function (TechnologyDetectionResult $result): ?string {
                $metadata = $result->metadata();

                if ($metadata === null) {
                    throw new RuntimeException('Expected the detected result to carry metadata.');
                }

                return $metadata->slug();
            },
            $results,
        );

        self::assertSame(['jquery', 'google-analytics'], $slugs);
    }
}
