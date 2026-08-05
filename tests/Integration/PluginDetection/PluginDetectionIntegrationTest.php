<?php

declare(strict_types=1);

namespace Tests\Integration\PluginDetection;

use App\Modules\Detection\DetectionContext;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginRegistry;
use App\Modules\PluginDetection\WordPress\PluginMetadataMapper;
use App\Modules\PluginDetection\WordPress\PluginSlugExtractor;
use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use App\Modules\PluginDetection\WordPress\WordPressPluginDetector;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests for the complete Plugin Detection pipeline.
 *
 * This is the highest-level automated test for the Plugin Detection
 * Engine. It verifies that every production component works together
 * correctly by running the full pipeline end-to-end from the public
 * PluginDetectionManager entry point down to the final
 * PluginDetectionResult:
 *
 * PluginRegistry
 *   ↓
 * PluginDetectionManager
 *   ↓
 * WordPressPluginDetector
 *   ↓
 * PluginPathRule
 *   ↓
 * PluginSlugExtractor
 *   ↓
 * PluginMetadataMapper
 *   ↓
 * PluginDetectionResult
 *
 * Every collaborator is a real production object: the real PluginRegistry,
 * PluginDetectionManager, WordPressPluginDetector, PluginPathRule,
 * PluginSlugExtractor, PluginMetadataMapper, PluginMetadata,
 * PluginDetectionResult, and DetectionContext. Nothing is mocked. No HTTP
 * requests, no filesystem access, and no fixtures are used; the pipeline
 * consumes representative HTML strings embedded directly in the test.
 *
 * Scope:
 *
 * The tests validate the collaboration of the assembled pipeline only.
 * They verify observable behaviour — a WordPress HTML body produces a
 * detected plugin result with the expected metadata, an empty HTML body
 * produces the canonical failed result, and the pipeline is deterministic
 * — and never inspect internal implementation details. Parsing internals,
 * mapping internals, and unit-level contracts are covered by their own
 * unit tests and are deliberately not duplicated here.
 *
 * The tests are fast, deterministic, and repeatable. Given the same
 * DetectionContext, the same assembled pipeline always produces the same
 * PluginDetectionResult.
 */
final class PluginDetectionIntegrationTest extends TestCase
{
    private const URL = 'https://example.com';

    private const PLUGIN_SLUG = 'contact-form-7';

    private const EXPECTED_CONFIDENCE = 30;

    /**
     * Create a detection context carrying WordPress HTML that references a
     * plugin asset path.
     *
     * The HTML contains /wp-content/plugins/contact-form-7/ so that the
     * real PluginPathRule matches, the real PluginSlugExtractor extracts
     * the slug, and the real PluginMetadataMapper maps it.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextWithPlugin(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '<!DOCTYPE html>' . "\n"
                . '<html><head>'
                . '<link rel="stylesheet" href="/wp-content/plugins/contact-form-7/includes/css/styles.css">'
                . '</head><body></body></html>',
            statusCode: 200,
        );
    }

    /**
     * Create a detection context carrying empty HTML.
     *
     * No WordPress plugin path is referenced, so no detector in the
     * pipeline can match and the manager returns its canonical failed
     * result.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function contextWithoutPlugin(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: '',
            statusCode: 200,
        );
    }

    /**
     * Assemble the complete real WordPress plugin detection pipeline.
     *
     * Wires the real PluginPathRule, PluginSlugExtractor, and
     * PluginMetadataMapper into a real WordPressPluginDetector.
     *
     * @return WordPressPluginDetector The fully wired WordPress detector.
     */
    private function detector(): WordPressPluginDetector
    {
        return new WordPressPluginDetector(
            new PluginPathRule(),
            new PluginSlugExtractor(),
            new PluginMetadataMapper(),
        );
    }

    /**
     * Assemble the complete real Plugin Detection pipeline.
     *
     * Wires the real WordPressPluginDetector into a real PluginRegistry
     * and a real PluginDetectionManager, mirroring the production
     * composition point.
     *
     * @return PluginDetectionManager The fully wired pipeline entry point.
     */
    private function manager(): PluginDetectionManager
    {
        $registry = new PluginRegistry();
        $registry->register($this->detector());

        return new PluginDetectionManager($registry);
    }

    /**
     * Verify that WordPress HTML containing a plugin asset path is
     * detected.
     *
     * The full pipeline detects the plugin and reports detected = true
     * with a normalized PluginMetadata whose name and slug match the
     * referenced plugin slug.
     */
    public function test_detects_plugin_from_wordpress_html(): void
    {
        $result = $this->manager()->detect($this->contextWithPlugin());

        self::assertInstanceOf(PluginDetectionResult::class, $result);
        self::assertTrue($result->isDetected());

        $plugin = $result->plugin();
        self::assertNotNull($plugin);
        self::assertSame(self::PLUGIN_SLUG, $plugin->name());
        self::assertSame(self::PLUGIN_SLUG, $plugin->slug());
    }

    /**
     * Verify that the confidence score is preserved through the pipeline.
     *
     * The rule-provided confidence is carried unchanged through
     * PluginSlugExtractor, WordPressPluginDetector, and
     * PluginDetectionResult.
     */
    public function test_confidence_is_preserved(): void
    {
        $result = $this->manager()->detect($this->contextWithPlugin());

        self::assertTrue($result->isDetected());
        self::assertSame(self::EXPECTED_CONFIDENCE, $result->confidence());
    }

    /**
     * Verify that extra() preserves the plugin metadata.
     *
     * The platform-specific metadata produced by the rule flows unchanged
     * through the raw metadata transport object into the normalized
     * PluginMetadata extra() array.
     */
    public function test_extra_preserves_plugin_metadata(): void
    {
        $result = $this->manager()->detect($this->contextWithPlugin());

        self::assertTrue($result->isDetected());

        $plugin = $result->plugin();
        self::assertNotNull($plugin);
        self::assertSame(
            ['plugins' => [self::PLUGIN_SLUG]],
            $plugin->extra(),
        );
    }

    /**
     * Verify that the manager returns the detector result unchanged.
     *
     * Running the detector directly and running the same detector through
     * the assembled manager must yield equivalent results in every
     * observable field: the manager is a pure orchestrator and passes the
     * detector output through without transformation.
     */
    public function test_manager_returns_detector_result_unchanged(): void
    {
        $context = $this->contextWithPlugin();

        $direct = $this->detector()->detect($context);
        $viaManager = $this->manager()->detect($context);

        self::assertSame($direct->isDetected(), $viaManager->isDetected());
        self::assertSame($direct->confidence(), $viaManager->confidence());

        $directPlugin = $direct->plugin();
        $managerPlugin = $viaManager->plugin();
        self::assertNotNull($directPlugin);
        self::assertNotNull($managerPlugin);
        self::assertSame($directPlugin->name(), $managerPlugin->name());
        self::assertSame($directPlugin->slug(), $managerPlugin->slug());
        self::assertSame($directPlugin->extra(), $managerPlugin->extra());
    }

    /**
     * Verify that the complete pipeline is deterministic.
     *
     * Detecting twice with the same assembled pipeline and the same
     * detection context produces equivalent results in every observable
     * field.
     */
    public function test_pipeline_is_deterministic(): void
    {
        $manager = $this->manager();

        $first = $manager->detect($this->contextWithPlugin());
        $second = $manager->detect($this->contextWithPlugin());

        self::assertSame($first->isDetected(), $second->isDetected());
        self::assertSame($first->confidence(), $second->confidence());

        $firstPlugin = $first->plugin();
        $secondPlugin = $second->plugin();
        self::assertNotNull($firstPlugin);
        self::assertNotNull($secondPlugin);
        self::assertSame($firstPlugin->name(), $secondPlugin->name());
        self::assertSame($firstPlugin->slug(), $secondPlugin->slug());
        self::assertSame($firstPlugin->extra(), $secondPlugin->extra());
    }

    /**
     * Verify that empty HTML produces the canonical failed result.
     *
     * When no detector in the pipeline supports the context, the manager
     * returns a deterministic failed result: detected = false, plugin =
     * null, and confidence = 0.
     */
    public function test_returns_failed_result_for_empty_html(): void
    {
        $result = $this->manager()->detect($this->contextWithoutPlugin());

        self::assertFalse($result->isDetected());
        self::assertNull($result->plugin());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the supplied DetectionContext remains unchanged.
     *
     * The immutable context is consumed by the pipeline without mutation:
     * every observable value is identical before and after detection.
     */
    public function test_detection_context_remains_unchanged(): void
    {
        $context = $this->contextWithPlugin();

        $this->manager()->detect($context);

        self::assertSame(self::URL, $context->originalUrl());
        self::assertSame(self::URL, $context->finalUrl());
        self::assertSame(200, $context->statusCode());
        self::assertSame([], $context->headers());
        self::assertSame(0.0, $context->responseTime());
        self::assertTrue($context->isSuccess());
        self::assertStringContainsString(
            '/wp-content/plugins/contact-form-7/',
            $context->html(),
        );
    }
}
