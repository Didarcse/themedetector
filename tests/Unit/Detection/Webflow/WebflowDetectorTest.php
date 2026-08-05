<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\Webflow\ConfidenceCalculator;
use App\Modules\Detection\Webflow\Rules\GlobalJsRule;
use App\Modules\Detection\Webflow\Rules\MetaGeneratorRule;
use App\Modules\Detection\Webflow\Rules\RuleInterface;
use App\Modules\Detection\Webflow\WebflowDetector;
use PHPUnit\Framework\TestCase;

final class WebflowDetectorTest extends TestCase
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
    private function createDetector(iterable $rules): WebflowDetector
    {
        return new WebflowDetector($rules, new ConfidenceCalculator());
    }

    /**
     * @param array{matched: bool, confidence: int, metadata: array<string, mixed>} $result
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
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function createMatchedRuleResult(int $confidence = 35, array $metadata = []): array
    {
        return [
            'matched' => true,
            'confidence' => $confidence,
            'metadata' => $metadata,
        ];
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function createUnmatchedRuleResult(int $confidence = 35): array
    {
        return [
            'matched' => false,
            'confidence' => $confidence,
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
            $this->createRule($this->createMatchedRuleResult(35, ['generator' => 'Webflow'])),
            $this->createRule($this->createMatchedRuleResult(15, ['asset_host' => 'assets.website-files.com'])),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertSame('Webflow', $result->metadata()['generator']);
        self::assertSame('assets.website-files.com', $result->metadata()['asset_host']);
    }

    public function test_later_metadata_overwrites_previous_values(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult(35, ['generator' => 'Old'])),
            $this->createRule($this->createMatchedRuleResult(25, ['generator' => 'Webflow'])),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertSame('Webflow', $result->metadata()['generator']);
    }

    public function test_collects_matched_rule_names(): void
    {
        $html = '<html><head><meta name="generator" content="Webflow"></head>'
            . '<body><script src="/js/webflow.js"></script></body></html>';

        $detector = $this->createDetector([new MetaGeneratorRule(), new GlobalJsRule()]);
        $result = $detector->detect($this->createContext($html));

        self::assertSame(
            ['MetaGeneratorRule', 'GlobalJsRule'],
            $result->metadata()['matched_rules'],
        );
    }

    public function test_ignores_unmatched_rules(): void
    {
        $html = '<html><head><meta name="generator" content="Webflow"></head><body></body></html>';

        $detector = $this->createDetector([new MetaGeneratorRule(), new GlobalJsRule()]);
        $result = $detector->detect($this->createContext($html));

        self::assertSame(['MetaGeneratorRule'], $result->metadata()['matched_rules']);
        self::assertArrayHasKey('generator', $result->metadata());
    }

    public function test_returns_detection_result(): void
    {
        $detector = $this->createDetector([
            $this->createRule($this->createMatchedRuleResult()),
        ]);

        $result = $detector->detect($this->createContext());

        self::assertInstanceOf(DetectionResult::class, $result);
        self::assertSame('Webflow', $result->technology());
    }
}
