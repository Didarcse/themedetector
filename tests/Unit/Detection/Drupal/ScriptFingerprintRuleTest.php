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
        $result = $this->evaluate('<script>Drupal = {};</script>');

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

    public function test_detects_once_function(): void
    {
        $result = $this->evaluate("<script>once('example');</script>");

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
            'Drupal = {};' .
            'Drupal.behaviors.example = {};' .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'Drupal'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<script>const app = {};</script>');

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
        $result = $this->evaluate('<script>Drupal = {};</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>Drupal = {};</script>');

        self::assertSame(
            ['js_fingerprint' => 'Drupal'],
            $result['metadata']
        );
    }
}
