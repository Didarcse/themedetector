<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Squarespace;

use App\Modules\Detection\Squarespace\Rules\CommerceRule;
use PHPUnit\Framework\TestCase;

final class CommerceRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): CommerceRule
    {
        return new CommerceRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_sqs_cart(): void
    {
        $result = $this->evaluate('<div class="sqs-cart"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_sqs_commerce(): void
    {
        $result = $this->evaluate('<div class="sqs-commerce"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_cart_squarespace_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://cart.squarespace.com/cart.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<div class="SQS-CART"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate('<div class="sqs-cart sqs-commerce"></div>');

        self::assertSame(
            ['commerce_fingerprint' => 'sqs-cart'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<div class="shop"></div>');

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
        $result = $this->evaluate('<div class="sqs-cart"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_commerce_fingerprint_metadata(): void
    {
        $result = $this->evaluate('<div class="sqs-cart"></div>');

        self::assertSame(
            ['commerce_fingerprint' => 'sqs-cart'],
            $result['metadata']
        );
    }
}
