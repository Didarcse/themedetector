<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;
use App\Modules\Detection\Shopify\Rules\RuleInterface;

/**
 * Coordinates all Shopify detection rules.
 *
 * Iterates through every registered RuleInterface, collects results,
 * merges metadata, calculates the final confidence score via
 * ConfidenceCalculator, and returns a DetectionResult.
 */
final class ShopifyDetector implements DetectorInterface
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
     * Execute Shopify detection rules against the given context.
     *
     * @param DetectionContext $context The immutable HTTP response context.
     */
    public function detect(DetectionContext $context): DetectionResult
    {
        $html = $context->html();
        $url = $context->finalUrl();

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
                technology: 'Shopify',
                detected: false,
                confidence: 0,
                theme: null,
                plugins: [],
                metadata: [],
            );
        }

        return new DetectionResult(
            technology: 'Shopify',
            detected: true,
            confidence: $confidence,
            theme: isset($mergedMetadata['theme_name']) && is_string($mergedMetadata['theme_name'])
                ? $mergedMetadata['theme_name']
                : null,
            plugins: $this->extractPlugins($mergedMetadata),
            metadata: $mergedMetadata,
        );
    }

    /**
     * Extract the detected plugin list from the merged rule metadata.
     *
     * Only string entries are retained, guaranteeing the result is a
     * list<string> regardless of the metadata content.
     *
     * @param array<string, mixed> $metadata The merged rule metadata.
     *
     * @return list<string> The detected plugin names.
     */
    private function extractPlugins(array $metadata): array
    {
        if (!isset($metadata['plugins']) || !is_array($metadata['plugins'])) {
            return [];
        }

        $plugins = [];

        foreach ($metadata['plugins'] as $plugin) {
            if (is_string($plugin)) {
                $plugins[] = $plugin;
            }
        }

        return $plugins;
    }
}
