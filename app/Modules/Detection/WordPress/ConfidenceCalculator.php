<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress;

/**
 * Calculates the final WordPress confidence score from multiple rule
 * evaluation results.
 *
 * Strong evidence rules (ThemeStyleRule, WPJsonRule) impose a minimum
 * confidence floor when matched.  Normal evidence rules contribute
 * their individual confidence values to the accumulated total.
 * The final score is capped at 100.
 */
final class ConfidenceCalculator
{
    private const MAX_CONFIDENCE = 100;

    private const STRONG_EVIDENCE = [
        'style_css_url' => 95,
        'rest_api_url' => 90,
    ];

    /**
     * Calculate the final confidence score from rule results.
     *
     * @param list<array{matched: bool, confidence: int, metadata: array<string, mixed>}> $ruleResults
     *
     * @return int The calculated confidence score (0–100).
     */
    public function calculate(array $ruleResults): int
    {
        $accumulated = 0;
        $strongMinimum = 0;

        foreach ($ruleResults as $result) {
            if ($result['matched'] !== true) {
                continue;
            }

            $accumulated += $result['confidence'];

            foreach (self::STRONG_EVIDENCE as $key => $minimum) {
                if (array_key_exists($key, $result['metadata'])) {
                    if ($minimum > $strongMinimum) {
                        $strongMinimum = $minimum;
                    }
                }
            }
        }

        if ($accumulated === 0) {
            return 0;
        }

        $accumulated = min($accumulated, self::MAX_CONFIDENCE);

        if ($strongMinimum > 0 && $strongMinimum > $accumulated) {
            return $strongMinimum;
        }

        return $accumulated;
    }
}
