<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Drupal;

use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;
use PHPUnit\Framework\TestCase;

final class ScriptFingerprintRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): ScriptFingerprintRule
    {
        return new ScriptFingerprintRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_drupal_object(): void
    {
        $result = $this->evaluate('<script>window.Drupal = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_drupal_settings(): void
    {
        $result = $this->evaluate('<script>drupalSettings = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_drupal_behaviors(): void
    {
        $result = $this->evaluate('<script>Drupal.behaviors.example = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_drupal_once(): void
    {
        $result = $this->evaluate("<script>Drupal.once('example');</script>");

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>DRUPALSETTINGS = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'window.Drupal = {};' .
            'Drupal.behaviors.example = {};' .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'window.Drupal'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<script>const app = {};</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_drupal_name_in_css_class(): void
    {
        $result = $this->evaluate(
            '<style>.btn-drupal:hover { opacity: 0.8; }</style>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_drupal_name_in_plain_text(): void
    {
        $result = $this->evaluate('<h1>Welcome to Drupal</h1><p>Powered by Drupal</p>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_drupal_name_in_unrelated_url(): void
    {
        $result = $this->evaluate(
            '<a href="https://example.com/drupal/docs">Drupal docs</a>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_drupal_name_in_html_comment(): void
    {
        $result = $this->evaluate('<!-- managed with drupal tooling -->');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_once_function(): void
    {
        $result = $this->evaluate('<script>_.once(fn);</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_jquery_once_plugin(): void
    {
        $result = $this->evaluate('<script>$(".el").once("click", handler);</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_handles_empty_html(): void
    {
        $result = $this->evaluate('');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_weight(): void
    {
        $result = $this->evaluate('<script>window.Drupal = {};</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>window.Drupal = {};</script>');

        self::assertSame(
            ['js_fingerprint' => 'window.Drupal'],
            $result['metadata']
        );
    }
}
