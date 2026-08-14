<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;
use App\Modules\ThemeExtraction\Drupal\DrupalContextGate;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the DrupalContextGate.
 *
 * Verifies the complete public contract of the gate: the context passes
 * when the generator meta tag names Drupal, a well-known Drupal
 * JavaScript fingerprint is present, or a well-known Drupal HTML signature
 * is present, and fails for non-Drupal pages, pages carrying only generic
 * paths, empty HTML, and other platforms.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — the real gate, real MetaGeneratorRule,
 * ScriptFingerprintRule, and HtmlSignatureRule collaborators, and a real
 * DetectionContext — with no mocks.
 */
final class DrupalContextGateTest extends TestCase
{
    /**
     * Create a real gate instance.
     *
     * @return DrupalContextGate The gate under test.
     */
    private function gate(): DrupalContextGate
    {
        return new DrupalContextGate(
            new MetaGeneratorRule(),
            new ScriptFingerprintRule(),
            new HtmlSignatureRule(),
        );
    }

    /**
     * Create a real detection context carrying the given HTML.
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
     * Verify that a Drupal generator meta tag passes the gate.
     */
    public function test_passes_for_drupal_generator_meta(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '</head><body></body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the drupalSettings fingerprint passes the gate.
     */
    public function test_passes_for_drupal_settings_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>window.drupalSettings = {path: {baseUrl: \'/\'}};</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the Drupal.behaviors fingerprint passes the gate.
     */
    public function test_passes_for_behaviors_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>Drupal.behaviors.newsroom = { attach: function () {} };</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the window.Drupal fingerprint passes the gate.
     */
    public function test_passes_for_window_drupal_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>(function (Drupal) {}(window.Drupal));</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the data-drupal-selector HTML signature passes the gate.
     */
    public function test_passes_for_drupal_selector_signature(): void
    {
        $html = '<html><body>'
            . '<div data-drupal-selector="edit-submit">Submit</div>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that a non-Drupal generator fails the gate.
     */
    public function test_fails_for_non_drupal_generator(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="WordPress 6.8">'
            . '</head><body></body></html>';

        self::assertFalse($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that a Joomla page fails the gate.
     */
    public function test_fails_for_joomla_page(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Joomla! Open Source CMS">'
            . '</head><body>'
            . '<script>window.Joomla = window.Joomla || {};</script>'
            . '</body></html>';

        self::assertFalse($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that a Shopify page fails the gate.
     */
    public function test_fails_for_shopify_page(): void
    {
        $html = '<html><body>'
            . '<script>window.Shopify = { theme: { name: "Dawn" } };</script>'
            . '</body></html>';

        self::assertFalse($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that an Eleventy page fails the gate.
     */
    public function test_fails_for_eleventy_page(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Eleventy">'
            . '</head><body></body></html>';

        self::assertFalse($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that generic /core/, /node/, /entity/, and /user/login paths
     * never pass the gate.
     */
    public function test_fails_for_generic_paths_only(): void
    {
        $html = '<html><body>'
            . '<link rel="stylesheet" href="/core/framework/base.css">'
            . '<a href="/node/1">Item</a>'
            . '<a href="/entity/42">Entity</a>'
            . '<a href="/user/login">Sign in</a>'
            . '</body></html>';

        self::assertFalse($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that empty HTML fails the gate.
     */
    public function test_fails_for_empty_html(): void
    {
        self::assertFalse($this->gate()->passes($this->context('')));
    }

    /**
     * Verify that the gate is deterministic.
     */
    public function test_gate_is_deterministic(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Drupal 11 (https://www.drupal.org)">'
            . '</head><body></body></html>';

        $gate = $this->gate();

        self::assertSame(
            $gate->passes($this->context($html)),
            $gate->passes($this->context($html)),
        );
    }
}
