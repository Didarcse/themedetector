<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\Webflow\Rules\RuleInterface;

/**
 * Coordinates all Webflow detection rules.
 *
 * Iterates through every registered RuleInterface, collects results,
 * extracts matched rule names, merges metadata, calculates the final
 * confidence score via ConfidenceCalculator, and returns a
 * DetectionResult.
 *
 * The detector itself contains no detection logic — all detection is
 * delegated to dedicated Rule classes.
 */
final readonly class WebflowDetector implements DetectorInterface
{
    /**
     * @param iterable<RuleInterface> $rules
     */
    public function __construct(
        private iterable $rules,
        private ConfidenceCalculator $confidenceCalculator,
    ) {
    }

    /**
     * Execute Webflow detection rules against the given context.
     *
     * @param DetectionContext $context The immutable HTTP response context.
     */
    public function detect(DetectionContext $context): DetectionResult
    {
        $html = $context->html();
        $url = $context->finalUrl();

        $ruleResults = [];
        $matchedRules = [];
        $mergedMetadata = [];

        foreach ($this->rules as $rule) {
            $result = $rule->evaluate($html, $url);

            $ruleResults[] = $result;

            if ($result['matched'] !== true) {
                continue;
            }

            $matchedRules[] = $this->ruleName($rule);

            foreach ($result['metadata'] as $key => $value) {
                $mergedMetadata[$key] = $value;
            }
        }

        $confidence = $this->confidenceCalculator->calculate($ruleResults);

        if ($confidence === 0) {
            return new DetectionResult(
                technology: 'Webflow',
                detected: false,
                confidence: 0,
                theme: null,
                plugins: [],
                metadata: [],
            );
        }

        $mergedMetadata['matched_rules'] = $matchedRules;

        return new DetectionResult(
            technology: 'Webflow',
            detected: true,
            confidence: $confidence,
            theme: null,
            plugins: [],
            metadata: $mergedMetadata,
        );
    }

    /**
     * Extract the short class name from a rule instance.
     */
    private function ruleName(object $rule): string
    {
        $parts = explode('\\', $rule::class);

        return end($parts);
    }
}
