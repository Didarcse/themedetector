<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Squarespace;

use App\Modules\Detection\Squarespace\Rules\DataAttributesRule;
use PHPUnit\Framework\TestCase;

final class DataAttributesRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): DataAttributesRule
    {
        return new DataAttributesRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_data_animation_role_attribute(): void
    {
        $result = $this->evaluate('<div data-animation-role="banner"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['sq_attribute' => 'data-animation-role'],
            $result['metadata'],
        );
    }

    public function test_does_not_detect_generic_data_section_id_attribute(): void
    {
        $result = $this->evaluate('<section data-section-id="abc123"></section>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_detects_data_current_styles_attribute(): void
    {
        $result = $this->evaluate('<div data-current-styles="{}"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['sq_attribute' => 'data-current-styles'],
            $result['metadata'],
        );
    }

    public function test_returns_first_matching_attribute(): void
    {
        $result = $this->evaluate(
            '<div data-animation-role="hero" data-current-styles="{}"></div>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['sq_attribute' => 'data-animation-role'],
            $result['metadata'],
        );
    }

    public function test_returns_no_match_when_attributes_are_missing(): void
    {
        $result = $this->evaluate('<html><body><p>Example</p></body></html>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_handles_empty_html(): void
    {
        $result = $this->evaluate('');

        self::assertFalse($result['matched']);
    }

    public function test_handles_malformed_html(): void
    {
        $result = $this->evaluate('<div data- role=>');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_weight(): void
    {
        $result = $this->evaluate('<div data-animation-role="banner"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_attribute_metadata(): void
    {
        $result = $this->evaluate('<div data-animation-role="banner"></div>');

        self::assertSame(
            ['sq_attribute' => 'data-animation-role'],
            $result['metadata'],
        );
    }
}
