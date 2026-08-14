<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Wix;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\Wix\ConfidenceCalculator;
use App\Modules\Detection\Wix\Rules\AssetPathRule;
use App\Modules\Detection\Wix\Rules\GlobalJsRule;
use App\Modules\Detection\Wix\Rules\MetaGeneratorRule;
use App\Modules\Detection\Wix\Rules\RuleInterface;
use App\Modules\Detection\Wix\Rules\ThunderboltRule;
use App\Modules\Detection\Wix\Rules\ViewerModelRule;
use App\Modules\Detection\Wix\WixDetector;
use PHPUnit\Framework\TestCase;

final class WixDetectorTest extends TestCase
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

    /**
     * @param iterable<RuleInterface> $rules
     */
    private function createDetector(iterable $rules): WixDetector
    {
        return new WixDetector($rules, new ConfidenceCalculator());
    }

    /**
     * @param array{matched: bool, weight: int, metadata: array<string, mixed>} $result
     */
    private function createRule(array $result): RuleInterface
    {
        $rule = $this->createMock(RuleInterface::class);
        $rule->method('evaluate')->willReturn($result);

        return $rule;
    }

    /**
     * @param array<string, mixed> $metadata
     *
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function createMatchedRuleResult(int $weight = 35, array $metadata = []): array
    {
        return [
            'matched' => true,
            'weight' => $weight,
            'metadata' => $metadata,
        ];
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function createUnmatchedRuleResult(int $weight = 35): array
    {
        return [
            'matched' => false,
            'weight' => $weight,
            'metadata' => [],
        ];
    }

    public function test_returns_no_detection_when_confidence_is_zero(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createUnmatchedRuleResult()),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertFalse($result->isDetected());
        self::assertSame(0, $result->confidence());
        self::assertSame([], $result->metadata());
        self::assertNull($result->theme());
        self::assertSame([], $result->plugins());
    }

    public function test_returns_detection_when_confidence_is_positive(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult(80)),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertTrue($result->isDetected());
        self::assertSame(80, $result->confidence());
    }

    public function test_executes_every_rule(): void
    {
        $html = '<html></html>';
        $order = [];
        $rules = [];

        foreach (['A', 'B', 'C'] as $name) {
            $rule = $this->createMock(RuleInterface::class);
            $rule->expects(self::once())
                ->method('evaluate')
                ->with($html, self::URL)
                ->willReturnCallback(function () use (&$order, $name): array {
                    $order[] = $name;

                    return $this->createUnmatchedRuleResult();
                });
            $rules[] = $rule;
        }

        $detector = $this->createDetector($rules);
        $detector->detect($this->createContext($html));

        self::assertSame(['A', 'B', 'C'], $order);
    }

    public function test_passes_all_rule_results_to_confidence_calculator(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult(10)),
            $this->createRule($this->createMatchedRuleResult(20)),
            $this->createRule($this->createMatchedRuleResult(30)),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertSame(60, $result->confidence());
    }

    public function test_merges_metadata_from_multiple_rules(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult(35, ['generator' => 'Wix'])),
            $this->createRule($this->createMatchedRuleResult(20, ['asset_host' => 'static.wixstatic.com'])),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertSame('Wix', $result->metadata()['generator']);
        self::assertSame('static.wixstatic.com', $result->metadata()['asset_host']);
    }

    public function test_later_metadata_overwrites_previous_values(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult(35, ['generator' => 'Old'])),
            $this->createRule($this->createMatchedRuleResult(25, ['generator' => 'Wix'])),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertSame('Wix', $result->metadata()['generator']);
    }

    public function test_collects_matched_rule_names(): void
    {
        $html = '<meta name="generator" content="Wix">'
            . '<script>window.viewerModel = {};</script>';

        $detector = $this->createDetector([new MetaGeneratorRule(), new GlobalJsRule()]);
        $result = $detector->detect($this->createContext($html));

        self::assertSame(
            ['MetaGeneratorRule', 'GlobalJsRule'],
            $result->metadata()['matched_rules'],
        );
    }

    public function test_ignores_unmatched_rules(): void
    {
        $html = '<meta name="generator" content="Wix">';

        $detector = $this->createDetector([new MetaGeneratorRule(), new AssetPathRule()]);
        $result = $detector->detect($this->createContext($html));

        self::assertSame(['MetaGeneratorRule'], $result->metadata()['matched_rules']);
        self::assertArrayHasKey('generator', $result->metadata());
    }

    public function test_does_not_detect_generic_web_technologies_page(): void
    {
        $html = '<html><body>'
            . '<article>Compare Thunderbolt 4 and USB4 connections.</article>'
            . '<script>window.__INITIAL_STATE__ = {"user": null};</script>'
            . '<script>var viewerModel = new Viewer3D();</script>'
            . '</body></html>';

        $detector = $this->createDetector([
            new ThunderboltRule(),
            new GlobalJsRule(),
            new ViewerModelRule(),
        ]);
        $result = $detector->detect($this->createContext($html));

        self::assertFalse($result->isDetected());
        self::assertSame(0, $result->confidence());
    }

    public function test_returns_detection_result(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult()),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertInstanceOf(DetectionResult::class, $result);
        self::assertSame('Wix', $result->technology());
    }
}
