<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Ghost;

use App\Modules\Detection\Ghost\Rules\HtmlSignatureRule;
use PHPUnit\Framework\TestCase;

final class HtmlSignatureRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): HtmlSignatureRule
    {
        return new HtmlSignatureRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_ghost_head_signature(): void
    {
        $result = $this->evaluate('<div class="ghost-head"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'ghost-head'],
            $result['metadata'],
        );
    }

    public function test_detects_kg_card_signature(): void
    {
        $result = $this->evaluate('<div class="kg-card"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'kg-card'],
            $result['metadata'],
        );
    }

    public function test_detects_kg_width_wide_signature(): void
    {
        $result = $this->evaluate('<figure class="kg-width-wide"></figure>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'kg-width-wide'],
            $result['metadata'],
        );
    }

    public function test_detects_kg_width_full_signature(): void
    {
        $result = $this->evaluate('<figure class="kg-width-full"></figure>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'kg-width-full'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<div class="GHOST-HEAD"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_signature(): void
    {
        $result = $this->evaluate(
            '<div class="ghost-head">' .
            '<div class="kg-card"></div>'
        );

        self::assertSame(
            ['html_signature' => 'ghost-head'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_signature_exists(): void
    {
        $result = $this->evaluate('<div class="example"></div>');

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
        $result = $this->evaluate('<div class="ghost-head"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_html_signature_metadata(): void
    {
        $result = $this->evaluate('<div class="ghost-head"></div>');

        self::assertSame(
            ['html_signature' => 'ghost-head'],
            $result['metadata'],
        );
    }
}
