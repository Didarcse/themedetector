<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Joomla;

use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule;
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

    public function test_detects_window_joomla(): void
    {
        $result = $this->evaluate('<script>window.Joomla = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_joomla_get_options(): void
    {
        $result = $this->evaluate('<script>Joomla.getOptions();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_joomla_submitbutton(): void
    {
        $result = $this->evaluate('<script>Joomla.submitbutton();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_joomla_jtext(): void
    {
        $result = $this->evaluate('<script>Joomla.JText._("HELLO");</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>WINDOW.JOOMLA = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'window.Joomla = {};' .
            'Joomla.submitbutton();' .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'window.Joomla'],
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
        $result = $this->evaluate('<script>window.Joomla = {};</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>window.Joomla = {};</script>');

        self::assertSame(
            ['js_fingerprint' => 'window.Joomla'],
            $result['metadata']
        );
    }
}
