<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress;

/**
 * Converts the PluginPathRule evaluation result into a RawPluginMetadata
 * transport object.
 *
 * PluginSlugExtractor is the transformation layer between the rule
 * system and the metadata mapping layer. It consumes the evaluation
 * result produced by PluginPathRule, extracts the primary plugin slug,
 * and preserves the confidence score together with all remaining rule
 * metadata inside the resulting RawPluginMetadata.
 *
 * Responsibilities:
 *
 * - Read the PluginPathRule evaluation result.
 * - Extract the primary plugin slug.
 * - Preserve the confidence score.
 * - Preserve all remaining rule metadata inside extra().
 * - Return a RawPluginMetadata object.
 * - Return null when no plugin slug can be extracted.
 * - Nothing else.
 *
 * Input:
 *
 * - The extractor accepts the evaluation result returned by
 *   PluginPathRule.
 * - The rule result structure is never modified and is treated as
 *   immutable input.
 *
 * Design philosophy:
 *
 * - Transformer: it converts one representation into another and nothing
 *   more.
 * - Single Responsibility Principle: producing a RawPluginMetadata from a
 *   rule evaluation result is the only concern. It never constructs
 *   PluginMetadata, never performs mapping, never performs detection,
 *   never performs HTTP, never applies regex, and never calculates
 *   confidence.
 * - Stateless, deterministic, and side-effect free: given the same rule
 *   result, it always produces the same RawPluginMetadata.
 *
 * Future Compatibility:
 *
 * - The extractor operates on the rule evaluation result abstraction
 *   rather than relying on the current array implementation details. A
 *   future PluginPathRuleResult value object may replace the array shape
 *   without changing this extractor's responsibility.
 * - Future rule implementations may provide richer metadata while this
 *   extractor remains responsible only for producing RawPluginMetadata;
 *   additional rule metadata flows into extra() without modification.
 *
 * The class knows nothing about PluginMetadata, PluginDetectionResult, or
 * the detection workflow that surrounds it.
 */
final readonly class PluginSlugExtractor
{
    /**
     * Extract raw plugin metadata from a rule evaluation result.
     *
     * Returns null when the rule did not match or yielded no plugin
     * slugs. The first plugin slug in the detected list becomes the
     * primary slug; the list is consumed exactly as provided by the rule
     * and is never reordered by this extractor. The confidence score and
     * the remaining rule metadata are preserved inside the returned
     * RawPluginMetadata. The given rule result is never modified.
     *
     * @param array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * } $ruleResult The rule evaluation result produced by PluginPathRule.
     *
     * @return RawPluginMetadata|null The raw plugin metadata, or null when
     *                                no plugin slug was detected.
     */
    public function extract(array $ruleResult): ?RawPluginMetadata
    {
        if ($ruleResult['matched'] !== true) {
            return null;
        }

        $plugins = $this->extractPlugins($ruleResult['metadata']);

        if ($plugins === []) {
            return null;
        }

        return new RawPluginMetadata(
            slug: $plugins[0],
            confidence: $ruleResult['confidence'],
            extra: $ruleResult['metadata'],
        );
    }

    /**
     * Extract the detected plugin slug list from the rule metadata.
     *
     * Only string entries are retained, guaranteeing the result is a
     * list<string> regardless of the metadata content.
     *
     * @param array<string, mixed> $metadata The rule metadata array.
     *
     * @return list<string> The detected plugin slugs.
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
