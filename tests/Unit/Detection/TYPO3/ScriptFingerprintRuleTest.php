<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\TYPO3;

use App\Modules\Detection\TYPO3\Rules\ScriptFingerprintRule;
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

    public function test_detects_typo3(): void
    {
        $result = $this->evaluate('<script>window.TYPO3 = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_typo3_settings(): void
    {
        $result = $this->evaluate('<script>TYPO3.settings = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_typo3_lang(): void
    {
        $result = $this->evaluate('<script>TYPO3.lang = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_typo3_configuration(): void
    {
        $result = $this->evaluate('<script>TYPO3.Configuration = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>window.typo3 = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'TYPO3.settings = {};' .
            'TYPO3.lang = {};' .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'TYPO3.settings'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<script>const app = {};</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_typo3_name_in_css_class(): void
    {
        $result = $this->evaluate(
            '<style>.btn-typo3:hover { opacity: 0.8; }</style>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_typo3_name_in_plain_text(): void
    {
        $result = $this->evaluate('<h1>Welcome to TYPO3</h1><p>Powered by TYPO3</p>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_typo3_name_in_unrelated_url(): void
    {
        $result = $this->evaluate(
            '<a href="https://example.com/typo3/guides">TYPO3 guides</a>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_bare_typo3_name_in_html_comment(): void
    {
        $result = $this->evaluate('<!-- managed with typo3 tooling -->');

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
        $result = $this->evaluate('<script>window.TYPO3 = {};</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>window.TYPO3 = {};</script>');

        self::assertSame(
            ['js_fingerprint' => 'window.TYPO3'],
            $result['metadata']
        );
    }
}
