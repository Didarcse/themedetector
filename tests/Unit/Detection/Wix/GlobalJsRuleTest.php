<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Wix;

use App\Modules\Detection\Wix\Rules\GlobalJsRule;
use PHPUnit\Framework\TestCase;

final class GlobalJsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): GlobalJsRule
    {
        return new GlobalJsRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_window_viewer_model(): void
    {
        $result = $this->evaluate('<script>window.viewerModel = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_window_wix_bi_session(): void
    {
        $result = $this->evaluate('<script>window.wixBiSession = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_does_not_detect_window_client_side_render(): void
    {
        $result = $this->evaluate('<script>window.clientSideRender = true;</script>');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_detect_window_initial_state(): void
    {
        $result = $this->evaluate('<script>window.__INITIAL_STATE__ = {};</script>');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_detect_window_tb(): void
    {
        $result = $this->evaluate('<script>window.tb = {};</script>');

        self::assertFalse($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>WINDOW.VIEWERMODEL = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'window.viewerModel = {};' .
            'window.wixBiSession = {};' .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'window.viewerModel'],
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
        $result = $this->evaluate('<script>window.viewerModel = {};</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>window.viewerModel = {};</script>');

        self::assertSame(
            ['js_fingerprint' => 'window.viewerModel'],
            $result['metadata']
        );
    }
}
