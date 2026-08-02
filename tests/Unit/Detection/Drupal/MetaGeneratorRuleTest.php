<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Drupal;

use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
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

    public function test_detects_plain_drupal_generator(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Drupal">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_drupal_ten(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Drupal 10">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_drupal_eleven(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Drupal 11">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_powered_by_drupal(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Powered by Drupal">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_built_with_drupal(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Built with Drupal">');

        self::assertTrue($result['matched']);
    }

    public function test_detects_generator_case_insensitively(): void
    {
        $result = $this->evaluate('<meta name="generator" content="dRuPaL">');

        self::assertTrue($result['matched']);
    }

    public function test_ignores_non_drupal_generator(): void
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
        $result = $this->evaluate('<meta name="generator" content="Drupal">');

        self::assertSame(35, $result['weight']);
    }

    public function test_returns_generator_metadata(): void
    {
        $result = $this->evaluate('<meta name="generator" content="Drupal 10">');

        self::assertSame(['generator' => 'Drupal'], $result['metadata']);
    }
}
