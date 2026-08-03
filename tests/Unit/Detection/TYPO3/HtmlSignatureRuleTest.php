<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\TYPO3;

use App\Modules\Detection\TYPO3\Rules\HtmlSignatureRule;
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

    public function test_detects_data_typo3_signature(): void
    {
        $result = $this->evaluate('<div data-typo3></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'data-typo3'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_login_signature(): void
    {
        $result = $this->evaluate('<div class="typo3-login"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'typo3-login'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_backend_signature(): void
    {
        $result = $this->evaluate('<div class="typo3-backend"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'typo3-backend'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_adminpanel_signature(): void
    {
        $result = $this->evaluate('<div class="typo3-adminpanel"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'typo3-adminpanel'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<div class="TYPO3-LOGIN"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_signature(): void
    {
        $result = $this->evaluate(
            '<div class="typo3-login">' .
            '<div class="typo3-backend"></div>'
        );

        self::assertSame(
            ['html_signature' => 'typo3-login'],
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
        $result = $this->evaluate('<div class="typo3-login"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_html_signature_metadata(): void
    {
        $result = $this->evaluate('<div class="typo3-login"></div>');

        self::assertSame(
            ['html_signature' => 'typo3-login'],
            $result['metadata'],
        );
    }
}
