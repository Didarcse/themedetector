<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;
use App\Modules\ThemeExtraction\Drupal\DrupalContextGate;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeExtractor;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeLocator;
use App\Modules\ThemeExtraction\Drupal\DrupalThemeMetadataMapper;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use PHPUnit\Framework\TestCase;

/**
 * Component tests for the DrupalThemeExtractor orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete Drupal theme extraction pipeline using the real implementations
 * of every collaborator. It verifies the collaboration between
 *
 * - DrupalContextGate,
 * - DrupalThemeLocator, and
 * - DrupalThemeMetadataMapper
 *
 * by exercising their real implementations through DrupalThemeExtractor
 * and observing the assembled ThemeExtractionResult.
 *
 * The pipeline delegates the CMS-context check to the gate, theme
 * directory discovery to the locator, and metadata normalization to the
 * mapper, and it assembles the resulting ThemeExtractionResult from their
 * outputs. When the page is not Drupal or carries no valid theme directory
 * name, the pipeline short-circuits into a failed result.
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
final class DrupalThemeExtractorComponentTest extends TestCase
{
    /**
     * Assemble the extractor under test from its three collaborators.
     *
     * @return DrupalThemeExtractor The extractor under test.
     */
    private function extractor(): DrupalThemeExtractor
    {
        return new DrupalThemeExtractor(
            new DrupalContextGate(
                new MetaGeneratorRule(),
                new ScriptFingerprintRule(),
                new HtmlSignatureRule(),
            ),
            new DrupalThemeLocator(),
            new DrupalThemeMetadataMapper(),
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
     * Create the HTML of a Drupal page carrying a theme path.
     *
     * @return string The Drupal page HTML.
     */
    private function drupalPageHtml(): string
    {
        return '<!DOCTYPE html>' . "\n"
            . '<html lang="en">' . "\n"
            . '<head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '</head>' . "\n"
            . '<body>'
            . '<script>window.drupalSettings = {path: {baseUrl: \'/\'}};</script>'
            . '<main><h1>Welcome</h1></main>'
            . '</body>' . "\n"
            . '</html>';
    }

    /**
     * Verify that the full pipeline produces a successful result.
     *
     * The gate confirms the Drupal-specific evidence, the locator
     * discovers the theme directory name, the mapper normalizes it, and
     * the extractor assembles the ThemeExtractionResult with the documented
     * positive confidence.
     */
    public function test_extract_returns_successful_result(): void
    {
        $result = $this->extractor()->extract($this->context($this->drupalPageHtml()));

        self::assertInstanceOf(ThemeExtractionResult::class, $result);
        self::assertTrue($result->isExtracted());
        self::assertSame(DrupalThemeExtractor::EXTRACTED_CONFIDENCE, $result->confidence());
        self::assertSame([], $result->metadata());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('newsroom', $theme->name());
    }

    /**
     * Verify that a page without Drupal-specific evidence yields a failed
     * result even when a theme path exists.
     */
    public function test_returns_failed_result_without_drupal_evidence(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Eleventy">'
            . '<link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a WordPress page yields a failed result even when a
     * WordPress theme path exists.
     */
    public function test_returns_failed_result_for_wordpress_page(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="WordPress 6.8">'
            . '<link rel="stylesheet" href="/wp-content/themes/astra/style.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Drupal page without a valid theme path yields a failed
     * result.
     */
    public function test_returns_failed_result_without_theme_path(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '<script src="/core/misc/drupal.js"></script>'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Drupal page with only a generic theme directory
     * yields a failed result.
     */
    public function test_returns_failed_result_for_generic_theme_directory(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '<link rel="stylesheet" href="/themes/custom/css/style.css">'
            . '</head><body></body></html>';

        $result = $this->extractor()->extract($this->context($html));

        self::assertFalse($result->isExtracted());
        self::assertNull($result->theme());
        self::assertSame(0, $result->confidence());
    }

    /**
     * Verify that a Drupal page with only a bare /themes/ path yields a
     * failed result.
     */
    public function test_returns_failed_result_for_bare_themes_path(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '<link rel="stylesheet" href="/themes/">'
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
        $result = $this->extractor()->extract($this->context($this->drupalPageHtml()));

        self::assertTrue($result->isExtracted());

        $theme = $result->theme();
        self::assertNotNull($theme);
        self::assertSame('newsroom', $theme->name());
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

        $first = $extractor->extract($this->context($this->drupalPageHtml()));
        $second = $extractor->extract($this->context($this->drupalPageHtml()));

        self::assertSame($first->isExtracted(), $second->isExtracted());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->metadata(), $second->metadata());
        self::assertSame($first->theme()?->name(), $second->theme()?->name());
    }
}
