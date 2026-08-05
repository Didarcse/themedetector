<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\Webflow\Rules\GlobalJsRule;
use PHPUnit\Framework\TestCase;

final class GlobalJsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): GlobalJsRule
    {
        return new GlobalJsRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_webflow_js_file(): void
    {
        $result = $this->evaluate('<script src="/js/webflow.js"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(['js_fingerprint' => 'webflow.js'], $result['metadata']);
    }

    public function test_detects_window_webflow(): void
    {
        $result = $this->evaluate(
            '<script>window.Webflow = window.Webflow || [];</script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(['js_fingerprint' => 'window.Webflow'], $result['metadata']);
    }

    public function test_detects_webflow_require(): void
    {
        $result = $this->evaluate(
            '<script>Webflow.require(\'ix2\');</script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(['js_fingerprint' => 'Webflow.require('], $result['metadata']);
    }

    public function test_detects_webflow_push(): void
    {
        $result = $this->evaluate(
            '<script>Webflow.push(function(){});</script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(['js_fingerprint' => 'Webflow.push('], $result['metadata']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>WINDOW.WEBFLOW</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>window.Webflow; Webflow.push(function(){});</script>'
        );

        self::assertSame(['js_fingerprint' => 'window.Webflow'], $result['metadata']);
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<script>var app = {};</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_handles_empty_html(): void
    {
        $result = $this->evaluate('');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate('<script src="/js/webflow.js"></script>');

        self::assertSame(25, $result['confidence']);
    }
}
