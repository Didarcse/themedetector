<?php

declare(strict_types=1);

namespace App\Modules\Detection\Joomla;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\Joomla\Rules\RuleInterface;

/**
 * Coordinates all Joomla detection rules.
 *
 * Executes every registered RuleInterface against the supplied context,
 * collects the rule results, extracts the names of matched rules, merges
 * their metadata, calculates the final confidence score via the
 * ConfidenceCalculator, and returns a DetectionResult.
 *
 * Responsibilities:
 *
 * - Iterate over every registered rule in the order it was provided.
 * - Delegate evaluation of each detection signal to the rule itself.
 * - Aggregate matched rule names and merged metadata into the result.
 * - Delegate score aggregation to the ConfidenceCalculator.
 * - Produce a fully-formed DetectionResult for both matched and
 *   unmatched outcomes.
 *
 * Design philosophy:
 *
 * - This class performs pure orchestration only. It contains no Joomla
 *   detection logic, no HTML parsing, no DOM manipulation, no regular
 *   expressions, no HTTP requests, and no confidence calculation.
 * - The detector is stateless, deterministic, and side-effect free: given
 *   the same context and rules, it always returns the same result.
 */
final readonly class JoomlaDetector implements DetectorInterface
{
    /**
     * @param iterable<RuleInterface> $rules The detection rules to execute.
     */
    public function __construct(
        private iterable $rules,
        private ConfidenceCalculator $confidenceCalculator,
    ) {
    }

    /**
     * Execute all Joomla detection rules against the given context.
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
                technology: 'Joomla',
                detected: false,
                confidence: 0,
                theme: null,
                plugins: [],
                metadata: [],
            );
        }

        $mergedMetadata['matched_rules'] = $matchedRules;

        return new DetectionResult(
            technology: 'Joomla',
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
