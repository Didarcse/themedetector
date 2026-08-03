<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\TYPO3;

use App\Modules\Detection\TYPO3\ConfidenceCalculator;
use PHPUnit\Framework\TestCase;

final class ConfidenceCalculatorTest extends TestCase
{
    private function createCalculator(): ConfidenceCalculator
    {
        return new ConfidenceCalculator();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function createRuleResult(bool $matched, int $weight): array
    {
        return [
            'matched' => $matched,
            'weight' => $weight,
            'metadata' => [],
        ];
    }

    public function test_returns_zero_for_empty_rule_results(): void
    {
        $result = $this->createCalculator()->calculate([]);

        self::assertSame(0, $result);
    }

    public function test_ignores_unmatched_rules(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(false, 50),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(0, $result);
    }

    public function test_returns_single_rule_weight(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(true, 35),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(35, $result);
    }

    public function test_sums_multiple_matched_rules(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(true, 35),
            $this->createRuleResult(true, 25),
            $this->createRuleResult(true, 15),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(75, $result);
    }

    public function test_ignores_unmatched_rules_when_mixed(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(true, 35),
            $this->createRuleResult(false, 25),
            $this->createRuleResult(true, 15),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(50, $result);
    }

    public function test_caps_confidence_at_one_hundred(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(true, 50),
            $this->createRuleResult(true, 40),
            $this->createRuleResult(true, 35),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(100, $result);
    }

    public function test_never_returns_negative_confidence(): void
    {
        $calculator = $this->createCalculator();

        $ruleResults = [
            $this->createRuleResult(true, -10),
        ];

        $result = $calculator->calculate($ruleResults);

        self::assertSame(0, $result);
    }
}
