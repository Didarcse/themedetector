<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Joomla;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule;
use App\Modules\ThemeExtraction\Joomla\JoomlaContextGate;
use App\Modules\ThemeExtraction\Joomla\JoomlaTemplateLocator;
use App\Modules\ThemeExtraction\Joomla\JoomlaThemeExtractor;
use App\Modules\ThemeExtraction\Joomla\JoomlaThemeMetadataMapper;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use PHPUnit\Framework\TestCase;

/**
 * Component tests for the JoomlaThemeExtractor orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete Joomla theme extraction pipeline using the real implementations
 * of every collaborator. It verifies the collaboration between
 *
 * - JoomlaContextGate,
 * - JoomlaTemplateLocator, and
 * - JoomlaThemeMetadataMapper
 *
 * by exercising their real implementations through JoomlaThemeExtractor
 * and observing the assembled ThemeExtractionResult.
 *
 * The pipeline delegates the CMS-context check to the gate, template
 * directory discovery to the locator, and metadata normalization to the
 * mapper, and it assembles the resulting ThemeExtractionResult from their
 * outputs. When the page is not Joomla or carries no valid template
 * directory name, the pipeline short-circuits into a failed result.
 *
 * The collaborators are exercised as real, deterministic objects; they are
 * final readonly classes and therefore cannot be doubled by PHPUnit. No
 * HTTP is performed anywhere in the pipeline.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable. They verify collaboration and
 * orchestration only; they never test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 */
final class JoomlaThemeExtractorComponentTest extends TestCase
{
    /**
     * Assemble the extractor under test from its three collaborators.
     *
     * @return JoomlaThemeExtractor The extractor under test.
     */
    private function extractor(): JoomlaThemeExtractor
    {
        return new JoomlaThemeExtractor(
            new JoomlaContextGate(
                new MetaGeneratorRule(),
                new ScriptFingerprintRule(),
            ),
            new JoomlaTemplateLocator(),
            new JoomlaThemeMetadataMapper(),
        );
    }

    /**
     * Create a detection context carrying the given HTML.
     *
     * @param string $html The HTML body to carry.
     *
     * @return DetectionContext The immutable detection context.
     */
    private function context(string $html): DetectionContext
    {
        return new DetectionContext(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            html: $html,
            statusCode: 200,
        );
    }

    /**
     * Create the HTML of a Joomla page carrying a template path.
     *
     * @return string The Joomla page HTML.
     */
    private function joomlaPageHtml(): string
    {
        return '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<meta name="generator" content="Joomla! Open Source CMS">'
            . '<link rel="stylesheet" href="/templates/cassiopeia/css/template.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<script>window.Joomla = window.Joomla || {};</script>'
            . '<main><h1>Welcome</h1></main>'
            . '</body>' . "\n"
            . '</html>';
    }

    /**
     * Verify that the full pipeline produces a successful result.
     *
     * The gate confirms the Joomla-specific evidence, the locator
     * discovers the template directory name, the mapper normalizes it, and
     * the extractor assembles the ThemeExtractionResult with the documented
     * positive confidence.
     */
    public function test_extract_returns_successful_result(): void
    {
        $result = $this->extractor()->extract($this->context($this->joomlaPageHtml()));

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertTrue($result->isExtracted());
        self::assertSame(JoomlaThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
        self::assertSame([], $result->metadata());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('cassiopeia', $theme->name());
    }

    /**
     * Verify that a page without Joomla-specific evidence yields a failed
     * result even when a template path exists.
     */
    public function test_returns_failed_result_without_joomla_evidence(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Eleventy">'
            . '<link rel="stylesheet" href="/templates/helix/css/template.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Joomla page without a valid template path yields a
     * failed result.
     */
    public function test_returns_failed_result_without_template_path(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Joomla! Open Source CMS">'
            . '<script src="/media/system/js/core.js"></script>'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Joomla page with only a generic template directory
     * yields a failed result.
     */
    public function test_returns_failed_result_for_generic_template_directory(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Joomla! Open Source CMS">'
            . '<link rel="stylesheet" href="/templates/css/template.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that the successful pipeline maps the theme metadata.
     */
    public function test_successful_pipeline_maps_theme_metadata(): void
    {
        $result = $this->extractor()->extract($this->context($this->joomlaPageHtml()));

        self::assertTrue($result->isExtracted());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('cassiopeia', $theme->name());
        self::assertNull($theme->version());
        self::assertNull($theme->author());
        self::assertNull($theme->themeUrl());
        self::assertNull($theme->license());
        self::assertSame([], $theme->tags());
    }

    /**
     * Verify that repeated extractions with identical input are
     * deterministic.
     */
    public function test_extractor_is_deterministic(): void
    {
        $extractor = $this->extractor();

        $first = $extractor->extract($this->context($this->joomlaPageHtml()));
        $second = $extractor->extract($this->context($this->joomlaPageHtml()));

        self::assertSame($first->isExtracted(), $second->isExtracted());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->metadata(), $second->metadata());
        self::assertSame($first->theme()?->name(), $second->theme()?->name());
    }
}
