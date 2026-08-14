<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Joomla;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule;
use App\Modules\ThemeExtraction\Joomla\JoomlaContextGate;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the JoomlaContextGate.
 *
 * Verifies the complete public contract of the gate: the context passes
 * when the generator meta tag names Joomla or a well-known Joomla
 * JavaScript fingerprint is present, and fails for non-Joomla pages, empty
 * HTML, and other platforms.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — the real gate, real MetaGeneratorRule and
 * ScriptFingerprintRule collaborators, and a real DetectionContext — with
 * no mocks.
 */
final class JoomlaContextGateTest extends TestCase
{
    /**
     * Create a real gate instance.
     *
     * @return JoomlaContextGate The gate under test.
     */
    private function gate(): JoomlaContextGate
    {
        return new JoomlaContextGate(
            new MetaGeneratorRule(),
            new ScriptFingerprintRule(),
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
     * Verify that a Joomla generator meta tag passes the gate.
     */
    public function test_passes_for_joomla_generator_meta(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="Joomla! Open Source CMS">'
            . '</head><body></body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the window.Joomla fingerprint passes the gate.
     */
    public function test_passes_for_window_joomla_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>window.Joomla = window.Joomla || {};</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the Joomla.getOptions fingerprint passes the gate.
     */
    public function test_passes_for_get_options_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>Joomla.getOptions(\'system.paths\');</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the Joomla.submitbutton fingerprint passes the gate.
     */
    public function test_passes_for_submit_button_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>Joomla.submitbutton(\'contact.apply\');</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that the Joomla.JText fingerprint passes the gate.
     */
    public function test_passes_for_jtext_fingerprint(): void
    {
        $html = '<html><body>'
            . '<script>Joomla.JText._(\'COM_USERS_LOGIN\');</script>'
            . '</body></html>';

        self::assertTrue($this->gate()->passes($this->context($html)));
    }

    /**
     * Verify that a non-Joomla generator fails the gate.
     */
    public function test_fails_for_non_joomla_generator(): void
    {
        $html = '<html><head>'
            . '<meta name="generator" content="WordPress 6.8">'
            . '</head><body></body></html>';

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
     * Verify that a page with only /media/ paths fails the gate.
     */
    public function test_fails_without_strong_joomla_evidence(): void
    {
        $html = '<html><head>'
            . '<link rel="stylesheet" href="/media/com_home/assets/home.css">'
            . '</head><body>'
            . '<div class="joomla-toolbar-button">Publish</div>'
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
            . '<meta name="generator" content="Joomla!">'
            . '</head><body></body></html>';

        $gate = $this->gate();

        self::assertSame(
            $gate->passes($this->context($html)),
            $gate->passes($this->context($html)),
        );
    }
}
