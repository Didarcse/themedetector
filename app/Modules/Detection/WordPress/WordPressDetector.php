<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress;

use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\WordPress\Rules\RuleInterface;

/**
 * Coordinates all WordPress detection rules.
 *
 * Iterates through every registered RuleInterface, collects results,
 * merges metadata, calculates the final confidence score via
 * ConfidenceCalculator, and returns a DetectionResult.
 */
final class WordPressDetector implements DetectorInterface
{
    /**
     * @param iterable<RuleInterface> $rules
     */
    public function __construct(
        private readonly iterable $rules,
        private readonly ConfidenceCalculator $confidenceCalculator,
    ) {
    }

    /**
     * Execute WordPress detection rules against the given page.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     */
    public function detect(string $html, string $url): DetectionResult
    {
        $ruleResults = [];
        $mergedMetadata = [];

        foreach ($this->rules as $rule) {
            $result = $rule->evaluate($html, $url);

            $ruleResults[] = $result;

            if ($result['matched'] !== true) {
                continue;
            }

            foreach ($result['metadata'] as $key => $value) {
                $mergedMetadata[$key] = $value;
            }
        }

        $confidence = $this->confidenceCalculator->calculate($ruleResults);

        if ($confidence === 0) {
            return new DetectionResult(
                technology: 'WordPress',
                detected: false,
                confidence: 0,
                theme: null,
                plugins: [],
                metadata: [],
            );
        }

        return new DetectionResult(
            technology: 'WordPress',
            detected: true,
            confidence: $confidence,
            theme: isset($mergedMetadata['theme_name']) && is_string($mergedMetadata['theme_name'])
                ? $mergedMetadata['theme_name']
                : null,
            plugins: isset($mergedMetadata['plugins']) && is_array($mergedMetadata['plugins'])
                ? $mergedMetadata['plugins']
                : [],
            metadata: $mergedMetadata,
        );
    }
}
