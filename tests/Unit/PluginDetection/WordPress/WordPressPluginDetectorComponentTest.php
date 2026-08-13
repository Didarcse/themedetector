<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection\WordPress;

use App\Modules\Detection\DetectionContext;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\PluginDetection\WordPress\PluginMetadataMapper;
use App\Modules\PluginDetection\WordPress\PluginSlugExtractor;
use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use App\Modules\PluginDetection\WordPress\WordPressPluginDetector;
use PHPUnit\Framework\TestCase;

/**
 * Component tests for the WordPressPluginDetector orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete WordPress plugin detection pipeline using the real
 * implementations of every collaborator. It verifies the collaboration
 * between
 *
 * - PluginPathRule,
 * - PluginSlugExtractor, and
 * - PluginMetadataMapper
 *
 * by exercising their real implementations through WordPressPluginDetector
 * and observing the assembled PluginDetectionResult.
 *
 * WordPressPluginDetector is a pure orchestrator. It delegates rule
 * evaluation to PluginPathRule, raw metadata extraction to
 * PluginSlugExtractor, and metadata normalization to PluginMetadataMapper,
 * and it wires their outputs into the assembled PluginDetectionResult. It
 * performs no mapping, no parsing, no confidence calculation, and no
 * business logic of its own.
 *
 * The three collaborators are final readonly classes and therefore cannot
 * be doubled by PHPUnit; they are exercised as real, deterministic
 * objects. Unlike WordPressThemeExtractorComponentTest, this pipeline
 * exposes no interface transport boundary, so per-collaborator invocation
 * counts cannot be observed directly. Orchestration is verified
 * behaviourally through the assembled result only: rule evaluation is
 * proven by the outcome being driven exclusively by the context HTML,
 * slug extraction is proven by the detected plugin slug, and metadata
 * mapping is proven by the normalized PluginMetadata carried by the
 * result.
 *
 * The suite verifies orchestration, collaboration, the assembled
 * PluginDetectionResult, deterministic behaviour, and the immutability of
 * the DetectionContext. It does not test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable.
 */
final class WordPressPluginDetectorComponentTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Assemble the detector under test from its three real collaborators.
     *
     * @return WordPressPluginDetector The detector under test.
     */
    private function detector(): WordPressPluginDetector
    {
        return new WordPressPluginDetector(
            pluginPathRule: new PluginPathRule(),
            pluginSlugExtractor: new PluginSlugExtractor(),
            pluginMetadataMapper: new PluginMetadataMapper(),
        );
    }

    /**
     * Build the HTML of a page referencing the given plugin directories.
     *
     * @param string ...$slugs The plugin directory names referenced by the
     *                         page.
     *
     * @return string HTML referencing /wp-content/plugins/ asset URLs.
     */
    private function htmlWithPlugins(string ...$slugs): string
    {
        $html = '<!DOCTYPE html>' . "\n"
            . '<html><head></head><body>';

        foreach ($slugs as $slug) {
            $html .= '<script src="/wp-content/plugins/' . $slug . '/index.js"></script>';
        }

        return $html . '</body></html>';
    }

    /**
     * Create a detection context referencing the given plugin directories.
     *
     * @param string ...$slugs The plugin directory names referenced by the
     *                         page.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextWithPlugins(string ...$slugs): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: $this->htmlWithPlugins(...$slugs),
            statusCode: 200,
        );
    }

    /**
     * Create a detection context referencing the default plugin.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(): DetectionContext
    {
        return $this->contextWithPlugins('contact-form-7');
    }

    /**
     * Create a detection context with no plugin path references.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextWithoutPlugins(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '<!DOCTYPE html>' . "\n" . '<html><head></head><body></body></html>',
            statusCode: 200,
        );
    }

    /**
     * Create a detection context whose final URL differs from the default.
     *
     * @param string $finalUrl The final URL after redirects.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextForUrl(string $finalUrl): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: $finalUrl,
            html: $this->htmlWithPlugins('contact-form-7'),
            statusCode: 200,
        );
    }

    /**
     * Verify that supports() returns true when the pipeline detects a
     * plugin.
     *
     * A context referencing plugin paths yields a successful support
     * decision from the assembled pipeline.
     */
    public function test_supports_returns_true_when_plugin_detected(): void
    {
        self::assertTrue($this->detector()->supports($this->context()));
    }

    /**
     * Verify that supports() returns false when no plugin is detected.
     *
     * A context without plugin path references yields a negative support
     * decision from the assembled pipeline.
     */
    public function test_supports_returns_false_when_no_plugin_detected(): void
    {
        self::assertFalse($this->detector()->supports($this->contextWithoutPlugins()));
    }

    /**
     * Verify that the support decision is derived from the context.
     *
     * The same detector answers differently for contexts with and without
     * plugin path references, proving the outcome is driven by the
     * supplied context rather than by any fixed value.
     */
    public function test_supports_derives_result_from_plugin_path_rule(): void
    {
        $detector = $this->detector();

        self::assertTrue($detector->supports($this->context()));
        self::assertFalse($detector->supports($this->contextWithoutPlugins()));
    }

    /**
     * Verify that the context HTML drives the support decision.
     *
     * Replacing the context HTML with plugin path references changes the
     * supports() outcome, proving the context HTML is consumed by the
     * pipeline rather than being ignored.
     */
    public function test_supports_consumes_context_html(): void
    {
        $detector = $this->detector();

        self::assertFalse($detector->supports($this->contextWithoutPlugins()));
        self::assertTrue($detector->supports($this->context()));
    }

    /**
     * Verify that the support decision is unaffected by the final URL.
     *
     * Contexts carrying different final URLs are all supported as long as
     * their HTML references plugin paths. The PluginPathRule matches
     * exclusively on the HTML, so varying the final URL does not alter the
     * outcome. Argument-level verification of the final URL handoff would
     * require an observable transport boundary, which this
     * pure-orchestrator pipeline does not expose; this suite therefore
     * verifies the assembled behaviour only.
     */
    public function test_supports_handles_varying_context_final_urls(): void
    {
        $detector = $this->detector();

        self::assertTrue($detector->supports($this->contextForUrl('https://example.com/en')));
        self::assertTrue($detector->supports($this->contextForUrl('https://example.org')));
    }

    /**
     * Verify that a successful pipeline run produces a successful result.
     *
     * The assembled PluginDetectionResult reports the detection and
     * carries the normalized plugin metadata.
     */
    public function test_detect_returns_successful_result(): void
    {
        $result = $this->detector()->detect($this->context());

        self::assertInstanceOf(PluginDetectionResult::class, $result);
        self::assertTrue($result->isDetected());
        self::assertNotNull($result->plugin());
    }

    /**
     * Verify that a failed pipeline run reports detected = false.
     *
     * A context without plugin path references makes the pipeline assemble
     * a failed result.
     */
    public function test_detect_returns_detected_false_when_no_plugin_detected(): void
    {
        $result = $this->detector()->detect($this->contextWithoutPlugins());

        self::assertInstanceOf(PluginDetectionResult::class, $result);
        self::assertFalse($result->isDetected());
    }

    /**
     * Verify that a failed pipeline run carries a null plugin.
     */
    public function test_detect_returns_plugin_null_when_detection_fails(): void
    {
        $result = $this->detector()->detect($this->contextWithoutPlugins());

        self::assertNull($result->plugin());
    }

    /**
     * Verify that the rule-provided confidence is carried unchanged.
     *
     * The PluginPathRule reports a fixed confidence of 30, and the
     * assembled result carries that score without any confidence
     * calculation of its own.
     */
    public function test_detect_returns_rule_confidence_unchanged(): void
    {
        $result = $this->detector()->detect($this->context());

        self::assertSame(30, $result->confidence());
    }

    /**
     * Verify that the assembled result carries normalized plugin metadata.
     *
     * The name and slug mirror the detected plugin slug, and the raw rule
     * metadata is preserved unchanged inside extra(), proving the raw
     * metadata extracted by the slug extractor reached the metadata mapper
     * during the pipeline run.
     */
    public function test_detect_assembles_normalized_plugin_metadata(): void
    {
        $result = $this->detector()->detect($this->context());

        $plugin = $result->plugin();
        self::assertInstanceOf(PluginMetadata::class, $plugin);
        self::assertSame('contact-form-7', $plugin->name());
        self::assertSame('contact-form-7', $plugin->slug());
        self::assertSame(['plugins' => ['contact-form-7']], $plugin->extra());
    }

    /**
     * Verify that multiple plugin references yield a single primary plugin.
     *
     * A page referencing several plugin directories produces a single
     * assembled result carrying one primary plugin: the alphabetically
     * first referenced slug, as produced by the collaborator chain. The
     * selection mechanism itself belongs to PluginPathRule and
     * PluginSlugExtractor and is covered by their dedicated test suites;
     * this suite observes the assembled result only.
     */
    public function test_detect_reports_single_primary_plugin_for_multiple_references(): void
    {
        $result = $this->detector()->detect($this->contextWithPlugins('woocommerce', 'contact-form-7'));

        $plugin = $result->plugin();
        self::assertNotNull($plugin);
        self::assertSame('contact-form-7', $plugin->slug());
    }

    /**
     * Verify that build-artifact references never become the primary
     * plugin.
     *
     * Combined asset URLs referencing non-plugin directories such as
     * /wp-content/plugins/dist/ are discarded by the rule, so the
     * alphabetically first real plugin slug becomes the primary. This is
     * a regression test for the woocommerce.com false positive, where
     * the "dist" artifact directory previously won primary selection
     * over the real woocommerce plugin.
     */
    public function test_detect_never_selects_build_artifact_as_primary_plugin(): void
    {
        $result = $this->detector()->detect($this->contextWithPlugins(
            'woocommerce',
            'dist',
            'woocommerce-payments',
        ));

        $plugin = $result->plugin();
        self::assertNotNull($plugin);
        self::assertSame('woocommerce', $plugin->slug());
        self::assertSame(
            ['plugins' => ['woocommerce', 'woocommerce-payments']],
            $plugin->extra(),
        );
    }

    /**
     * Verify that a wildcard plugin reference never becomes a plugin.
     *
     * A page whose only /wp-content/plugins/ reference is the
     * "/wp-content/plugins/*" URL-match wildcard is not detected as
     * carrying a plugin, mirroring the w3eden.com configuration.
     */
    public function test_detect_ignores_wildcard_plugin_reference(): void
    {
        $context = new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '{"href_matches":["/wp-*.php","/wp-admin/*",'
                . '"/wp-content/plugins/*","/wp-content/themes/*"]}',
            statusCode: 200,
        );

        $result = $this->detector()->detect($context);

        self::assertFalse($result->isDetected());
        self::assertNull($result->plugin());
    }

    /**
     * Verify that supports() and detect() agree on the same context.
     *
     * A context the detector supports is also detected, and a context the
     * detector does not support is not detected.
     */
    public function test_supports_and_detect_agree(): void
    {
        $detector = $this->detector();

        self::assertTrue($detector->supports($this->context()));
        self::assertTrue($detector->detect($this->context())->isDetected());

        self::assertFalse($detector->supports($this->contextWithoutPlugins()));
        self::assertFalse($detector->detect($this->contextWithoutPlugins())->isDetected());
    }

    /**
     * Verify that the detection context is never modified.
     *
     * The immutable context carries the same values before and after a
     * full detection run, proving the detector treats it as read-only.
     */
    public function test_detect_never_modifies_detection_context(): void
    {
        $context = $this->context();

        $this->detector()->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame($this->htmlWithPlugins('contact-form-7'), $context->html());
        self::assertSame(200, $context->statusCode());
    }

    /**
     * Verify that repeated detection runs are deterministic.
     *
     * Two independently wired detectors over the same context produce
     * equivalent results in every observable field.
     */
    public function test_detect_produces_deterministic_results(): void
    {
        $context = $this->context();

        $first = $this->detector()->detect($context);
        $second = $this->detector()->detect($context);

        self::assertSame($first->isDetected(), $second->isDetected());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->plugin()?->name(), $second->plugin()?->name());
        self::assertSame($first->plugin()?->slug(), $second->plugin()?->slug());
        self::assertSame($first->plugin()?->extra(), $second->plugin()?->extra());
    }
}
