<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Drupal;

use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
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

    public function test_detects_data_drupal_selector_signature(): void
    {
        $result = $this->evaluate('<div data-drupal-selector="edit-name"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'data-drupal-selector'],
            $result['metadata'],
        );
    }

    public function test_detects_drupal_settings_json_signature(): void
    {
        $result = $this->evaluate(
            '<script type="application/json" id="drupal-settings-json"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'drupal-settings-json'],
            $result['metadata'],
        );
    }

    public function test_detects_js_drupal_dialog_signature(): void
    {
        $result = $this->evaluate('<div class="js-drupal-dialog"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'js-drupal-dialog'],
            $result['metadata'],
        );
    }

    public function test_detects_toolbar_bar_signature(): void
    {
        $result = $this->evaluate('<div class="toolbar-bar"></div>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['html_signature' => 'toolbar-bar'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<div class="TOOLBAR-BAR"></div>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_signature(): void
    {
        $result = $this->evaluate(
            '<div data-drupal-selector="edit-name"></div>' .
            '<div class="toolbar-bar"></div>'
        );

        self::assertSame(
            ['html_signature' => 'data-drupal-selector'],
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
        $result = $this->evaluate('<div data-drupal-selector="edit-name"></div>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_html_signature_metadata(): void
    {
        $result = $this->evaluate('<div data-drupal-selector="edit-name"></div>');

        self::assertSame(
            ['html_signature' => 'data-drupal-selector'],
            $result['metadata'],
        );
    }
}
