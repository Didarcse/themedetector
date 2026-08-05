<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\Webflow\Rules\MetaGeneratorRule;
use PHPUnit\Framework\TestCase;

final class MetaGeneratorRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): MetaGeneratorRule
    {
        return new MetaGeneratorRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_webflow_generator(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Webflow">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_generator_case_insensitively(): void
    {
        $result = $this->evaluate('<meta name="generator" content="webflow">');

        self::assertTrue($result['matched']);
    }

    public function test_ignores_non_webflow_generator(): void
    {
        $result = $this->evaluate('<meta name="generator" content="WordPress 6.8">');

        self::assertFalse($result['matched']);
    }

    public function test_returns_no_match_when_generator_is_missing(): void
    {
        $result = $this->evaluate('<meta name="description" content="Example">');

        self::assertFalse($result['matched']);
    }

    public function test_handles_empty_html(): void
    {
        $result = $this->evaluate(' ');

        self::assertFalse($result['matched']);
    }

    public function test_handles_malformed_html(): void
    {
        $result = $this->evaluate('<html><meta name="generator"');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Webflow">');

        self::assertSame(35, $result['confidence']);
    }

    public function test_returns_generator_metadata(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Webflow">');

        self::assertSame(['generator' => 'Webflow'], $result['metadata']);
    }
}
