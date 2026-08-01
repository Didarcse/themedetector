<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Squarespace;

use App\Modules\Detection\Squarespace\Rules\MetaGeneratorRule;
use PHPUnit\Framework\TestCase;

final class MetaGeneratorRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): MetaGeneratorRule
    {
        return new MetaGeneratorRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_plain_squarespace_generator(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Squarespace">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_squarespace_version(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Squarespace 7.1">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_built_with_squarespace(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Built with Squarespace">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_squarespace_website_builder(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Squarespace Website Builder">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_generator_case_insensitively(): void
    {
        $result = $this->evaluate('<meta name="generator" content="sQuArEsPaCe">');

        self::assertTrue($result['matched']);
    }

    public function test_ignores_non_squarespace_generator(): void
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
        $result = $this->evaluate('');

        self::assertFalse($result['matched']);
    }

    public function test_handles_malformed_html(): void
    {
        $result = $this->evaluate('<html><meta name="generator"');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_weight(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Squarespace">');

        self::assertSame(35, $result['weight']);
    }

    public function test_returns_generator_metadata(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Squarespace 7.1">');

        self::assertSame(['generator' => 'Squarespace'], $result['metadata']);
    }
}
