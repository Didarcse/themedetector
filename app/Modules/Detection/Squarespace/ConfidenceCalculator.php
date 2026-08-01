<?php

declare(strict_types=1);

namespace App\Modules\Detection\Squarespace;

/**
 * Calculates the final Squarespace detection confidence score.
 *
 * The calculator aggregates the weights of every matched detection rule
 * into a single, deterministic confidence score clamped to the range
 * 0–100.
 *
 * Responsibilities:
 *
 * - Accept the evaluation results produced by every Squarespace rule.
 * - Sum the weights of all matched rules and clamp the total to the
 *   inclusive range 0–100.
 *
 * Design philosophy:
 *
 * - This class performs score aggregation and nothing else. It contains
 *   no HTML parsing, no DOM manipulation, no regular expressions, no HTTP
 *   requests, and no Squarespace-specific detection logic.
 * - Each rule result is treated independently: unmatched rules are
 *   ignored, and the weights of matched rules are accumulated. The final
 *   total is clamped on both ends so callers always receive a valid
 *   percentage score, even in the presence of unexpected negative weights.
 * - The calculator is stateless and side-effect free. Given identical
 *   input, it always returns identical output, which keeps detection
 *   reproducible and trivially testable.
 *
 * The class must never be extended or subclassed.
 */
final readonly class ConfidenceCalculator
{
    /**
     * The maximum achievable confidence score.
     */
    private const MAX_SCORE = 100;

    /**
     * Calculate the final confidence score from rule evaluation results.
     *
     * Rules that did not match are skipped. The weights of all matched
     * rules are summed, and the resulting total is clamped to the
     * inclusive range 0–100.
     *
     * @param list<array{
     *     matched: bool,
     *     weight: int,
     *     metadata: array<string, mixed>
     * }> $ruleResults The evaluation results produced by the detection rules.
     *
     * @return int The final confidence score, always between 0 and 100.
     */
    public function calculate(array $ruleResults): int
    {
        $score = 0;

        foreach ($ruleResults as $ruleResult) {
            if ($ruleResult['matched'] !== true) {
                continue;
            }

            $score += $ruleResult['weight'];
        }

        return min(max($score, 0), self::MAX_SCORE);
    }
}
