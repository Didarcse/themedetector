<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow;

/**
 * Calculates the final confidence score for Webflow detection.
 *
 * Receives evaluation results from every Webflow rule, sums the
 * weights of matched rules, and clamps the result to 0–100.
 *
 * Contains no HTML parsing, no regex, and no HTTP logic — pure
 * score aggregation only.
 */
final readonly class ConfidenceCalculator
{
    private const MAX_SCORE = 100;

    /**
     * Calculate the final confidence score from rule results.
     *
     * @param list<array<string,mixed>> $ruleResults
     *
     * @return int The calculated confidence score (0–100).
     */
    public function calculate(array $ruleResults): int
    {
        $score = 0;

        foreach ($ruleResults as $result) {
            if ($result['matched'] !== true) {
                continue;
            }

            $score += $result['weight'];
        }

        if ($score < 0) {
            return 0;
        }

        if ($score > self::MAX_SCORE) {
            return self::MAX_SCORE;
        }

        return $score;
    }
}
