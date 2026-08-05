<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress;

use App\Modules\Detection\DetectionContext;
use App\Modules\PluginDetection\Contracts\PluginDetectorInterface;
use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use App\Modules\PluginDetection\PluginDetectionResult;

/**
 * Orchestrates the complete WordPress plugin detection workflow.
 *
 * WordPressPluginDetector is the orchestration layer of the WordPress
 * plugin detection pipeline. It coordinates a fixed sequence of dedicated
 * collaborators — evaluating the PluginPathRule, extracting the plugin
 * slugs, and mapping the raw metadata — and assembles the resulting
 * PluginDetectionResult from their outputs. It is a thin facade: it
 * performs no work itself other than delegating each step and wiring the
 * results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * PluginPathRule
 *   ↓
 * PluginSlugExtractor
 *   ↓
 * RawPluginMetadata
 *   ↓
 * PluginMetadataMapper
 *   ↓
 * PluginMetadata
 *   ↓
 * PluginDetectionResult
 *
 * Responsibilities:
 *
 * - Determine whether the supplied DetectionContext belongs to a
 *   WordPress website.
 * - Delegate plugin detection to PluginPathRule.
 * - Delegate plugin slug extraction to PluginSlugExtractor.
 * - Delegate metadata mapping to PluginMetadataMapper.
 * - Assemble and return the resulting PluginDetectionResult.
 * - Return a failed PluginDetectionResult when no plugin was detected.
 *
 * MVP scope:
 *
 * - The only plugin detection rule used is PluginPathRule.
 * - Additional rules — CssAssetRule, JsAssetRule, HtmlFingerprintRule,
 *   and RestApiRule — must not be implemented yet.
 *
 * Design philosophy:
 *
 * - Facade: WordPressPluginDetector is the single public entry point for
 *   WordPress plugin detection.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never
 *   inspects rule metadata arrays, never interprets metadata, never maps
 *   metadata, never constructs PluginMetadata, never makes business
 *   decisions, never performs HTTP requests, never parses HTML, and never
 *   calculates confidence.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same PluginDetectionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * Future Compatibility:
 *
 * - Future collaborators — PluginSlugExtractor, RawPluginMetadata,
 *   PluginMetadataMapper, CssAssetRule, JsAssetRule, HtmlFingerprintRule,
 *   and RestApiRule — will be integrated through dependency injection
 *   without modifying this detector itself.
 *
 * The class contains no regular expressions, no metadata interpretation,
 * no metadata mapping, no business decisions, no confidence calculation,
 * and no HTTP requests.
 */
final readonly class WordPressPluginDetector implements PluginDetectorInterface
{
    /**
     * Create a new WordPressPluginDetector.
     *
     * @param PluginPathRule       $pluginPathRule       Evaluates the HTML
     *                                                   for WordPress plugin
     *                                                   path references.
     * @param PluginSlugExtractor  $pluginSlugExtractor  Extracts the raw
     *                                                   plugin metadata from
     *                                                   the rule evaluation
     *                                                   result.
     * @param PluginMetadataMapper $pluginMetadataMapper Maps the raw plugin
     *                                                   metadata to a
     *                                                   normalized
     *                                                   PluginMetadata.
     */
    public function __construct(
        private PluginPathRule $pluginPathRule,
        private PluginSlugExtractor $pluginSlugExtractor,
        private PluginMetadataMapper $pluginMetadataMapper,
    ) {
    }

    /**
     * Determine whether the supplied detection context belongs to a
     * WordPress website.
     *
     * For the MVP, WordPress is recognized through the PluginPathRule:
     * when the context HTML references /wp-content/plugins/ asset URLs,
     * the website is treated as WordPress.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True when the context belongs to a WordPress website.
     */
    public function supports(DetectionContext $context): bool
    {
        return $this->pluginSlugExtractor->extract(
            $this->pluginPathRule->evaluate($context->html(), $context->finalUrl()),
        ) !== null;
    }

    /**
     * Detect a WordPress plugin from the given detection context.
     *
     * Coordinates the dedicated collaborators in order and returns the
     * assembled result:
     *
     * - Evaluate the PluginPathRule against the context HTML and URL.
     * - Extract the raw plugin metadata through PluginSlugExtractor.
     * - Map the raw metadata to a normalized PluginMetadata.
     * - Assemble the resulting PluginDetectionResult.
     *
     * When no plugin is detected, a failed PluginDetectionResult is
     * returned. The rule-provided confidence is carried through the raw
     * metadata unchanged; this detector never calculates confidence
     * itself. The given DetectionContext is never modified.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return PluginDetectionResult The normalized WordPress plugin
     *                               detection result, or a failed result
     *                               when no plugin was detected.
     */
    public function detect(DetectionContext $context): PluginDetectionResult
    {
        $rawMetadata = $this->pluginSlugExtractor->extract(
            $this->pluginPathRule->evaluate($context->html(), $context->finalUrl()),
        );

        if ($rawMetadata === null) {
            return $this->notDetected();
        }

        return new PluginDetectionResult(
            detected: true,
            plugin: $this->pluginMetadataMapper->map($rawMetadata),
            confidence: $rawMetadata->confidence(),
        );
    }

    /**
     * Return a PluginDetectionResult representing a failed detection.
     *
     * Used when no WordPress plugin could be detected, so that a
     * deterministic result is always produced.
     *
     * @return PluginDetectionResult The failed plugin detection result.
     */
    private function notDetected(): PluginDetectionResult
    {
        return new PluginDetectionResult(
            detected: false,
            plugin: null,
            confidence: 0,
        );
    }
}
