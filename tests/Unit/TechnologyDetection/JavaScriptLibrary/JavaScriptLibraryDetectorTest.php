<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\JavaScriptLibrary;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\AbstractCategoryDetector;
use App\Modules\TechnologyDetection\JavaScriptLibrary\JavaScriptLibraryDetector;
use App\Modules\TechnologyDetection\Rules\TechnologyRuleInterface;
use App\Modules\TechnologyDetection\TechnologyDetectionResult;
use App\Modules\TechnologyDetection\TechnologyMetadata;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Test-only category detector exposing an arbitrary rule set.
 *
 * Used to verify shared category detector behaviour — such as CMS slug
 * exclusion — with a controlled rule list instead of the production rule
 * set.
 */
final readonly class RulesetCategoryDetector extends AbstractCategoryDetector
{
}

/**
 * Unit tests for the JavaScriptLibraryDetector.
 *
 * Verifies the category detection flow over the JavaScript library rule
 * set: multiple libraries are reported in rule order, the output cap is
 * enforced, CMS-owned slugs are excluded, an empty list is returned when
 * nothing matches, the context is never modified, and detection is
 * deterministic.
 */
final class JavaScriptLibraryDetectorTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Create the JavaScript library detector under test.
     *
     * @param int $maxTechnologies The maximum number of technologies to
     *                             report.
     *
     * @return JavaScriptLibraryDetector The detector instance.
     */
    private function createDetector(
        int $maxTechnologies = AbstractCategoryDetector::MAX_TECHNOLOGIES,
    ): JavaScriptLibraryDetector {
        return new JavaScriptLibraryDetector(new TechnologyMetadataMapper(), $maxTechnologies);
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
     * Verify that every present library is reported in rule order.
     */
    public function test_detects_multiple_libraries_in_rule_order(): void
    {
        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>'
            . '<script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js"></script>'
            . '<script src="https://cdn.example.com/js/vue.min.js"></script>';

        $results = $this->createDetector()->detect($this->createContext($html));

        self::assertCount(3, $results);
        self::assertSame('jquery', $this->metadataAt($results, 0)->slug());
        self::assertSame('react', $this->metadataAt($results, 1)->slug());
        self::assertSame('vue', $this->metadataAt($results, 2)->slug());
    }

    /**
     * Verify that the detector supports any context.
     */
    public function test_supports_any_context(): void
    {
        self::assertTrue($this->createDetector()->supports($this->createContext('<html></html>')));
    }

    /**
     * Verify that an empty list is returned when no library matches.
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
    public function test_caps_number_of_detected_libraries(): void
    {
        $html = '<script src="https://code.jquery.com/jquery.min.js"></script>'
            . '<script src="https://cdn.example.com/js/vue.min.js"></script>'
            . '<script src="https://cdn.example.com/js/react.min.js"></script>';

        $results = $this->createDetector(2)->detect($this->createContext($html));

        self::assertCount(2, $results);
    }

    /**
     * Verify that technology slugs owned by the CMS Detection Engine are
     * excluded.
     */
    public function test_excludes_cms_owned_slugs(): void
    {
        $wordpressRule = new class implements TechnologyRuleInterface {
            public function evaluate(string $html, string $url): array
            {
                return [
                    'matched' => true,
                    'confidence' => 90,
                    'metadata' => ['signal' => 'test'],
                ];
            }

            public function technology(): TechnologyMetadata
            {
                return new TechnologyMetadata(
                    name: 'WordPress',
                    slug: 'wordpress',
                    category: 'CMS',
                );
            }
        };

        $detector = new RulesetCategoryDetector(
            [$wordpressRule],
            new TechnologyMetadataMapper(),
            10,
        );

        self::assertSame([], $detector->detect($this->createContext('<html>wordpress</html>')));
    }

    /**
     * Verify that the supplied DetectionContext is never modified.
     */
    public function test_never_modifies_supplied_context(): void
    {
        $html = '<script src="https://code.jquery.com/jquery.min.js"></script>';
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
        $html = '<script src="https://code.jquery.com/jquery.min.js"></script>'
            . '<script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js"></script>';

        $detector = $this->createDetector();

        self::assertEquals(
            $detector->detect($this->createContext($html)),
            $detector->detect($this->createContext($html)),
        );
    }
}
