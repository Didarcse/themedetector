<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Squarespace;

use App\Modules\Detection\Squarespace\Rules\StaticJsRule;
use PHPUnit\Framework\TestCase;

final class StaticJsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): StaticJsRule
    {
        return new StaticJsRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_squarespace_load(): void
    {
        $result = $this->evaluate('<script>Squarespace.load();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_squarespace_initialize(): void
    {
        $result = $this->evaluate('<script>Squarespace.initialize();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_static_squarespace_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://static.squarespace.com/universal/scripts.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_y_use(): void
    {
        $result = $this->evaluate("<script>Y.use('node');</script>");

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>SQUARESPACE.LOAD();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            "Squarespace.load();" .
            "Y.use('node');" .
            '</script>'
        );

        self::assertSame(
            ['js_fingerprint' => 'Squarespace.load'],
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
        $result = $this->evaluate('<script>Squarespace.load();</script>');

        self::assertSame(25, $result['weight']);
    }

    public function test_returns_js_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<script>Squarespace.load();</script>');

        self::assertSame(
            ['js_fingerprint' => 'Squarespace.load'],
            $result['metadata']
        );
    }
}
