<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Joomla;

use App\Modules\Detection\Joomla\Rules\HtmlSignatureRule;
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

    public function test_detects_option_com_signature(): void
    {
        $result = $this->evaluate('<a href="/index.php?option=com_content">');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'option=com_'],
            $result['metadata'],
        );
    }

    public function test_detects_com_content_signature(): void
    {
        $result = $this->evaluate('<div class="com_content"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'com_content'],
            $result['metadata'],
        );
    }

    public function test_detects_com_users_signature(): void
    {
        $result = $this->evaluate('<div class="com_users"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'com_users'],
            $result['metadata'],
        );
    }

    public function test_detects_com_contact_signature(): void
    {
        $result = $this->evaluate('<div class="com_contact"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'com_contact'],
            $result['metadata'],
        );
    }

    public function test_detects_joomla_toolbar_button_signature(): void
    {
        $result = $this->evaluate('<div class="joomla-toolbar-button"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'joomla-toolbar-button'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<div class="COM_CONTENT"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_signature(): void
    {
        $result = $this->evaluate(
            '<div class="com_content">' .
            '<div class="com_users"></div>'
        );

        self::assertSame(
            ['html_signature' => 'com_content'],
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
        $result = $this->evaluate('<div class="com_content"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_html_signature_metadata(): void
    {
        $result = $this->evaluate('<div class="com_content"></div>');

        self::assertSame(
            ['html_signature' => 'com_content'],
            $result['metadata'],
        );
    }
}
