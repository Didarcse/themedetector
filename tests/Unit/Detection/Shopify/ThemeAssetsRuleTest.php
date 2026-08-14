<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Shopify;

use App\Modules\Detection\Shopify\Rules\ThemeAssetsRule;
use PHPUnit\Framework\TestCase;

final class ThemeAssetsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): ThemeAssetsRule
    {
        return new ThemeAssetsRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_predictive_search_asset(): void
    {
        $result = $this->evaluate('<script src="/assets/predictive-search.js"></script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_component_card_asset(): void
    {
        $result = $this->evaluate('<link rel="stylesheet" href="/assets/component-card.css">');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['shopify_theme_assets' => true],
            $result['metadata'],
        );
    }

    public function test_detects_quick_add_asset(): void
    {
        $result = $this->evaluate('<script src="/assets/quick-add.js"></script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script src="/ASSETS/PRODUCT-FORM.JS"></script>');

        self::assertTrue($result['matched']);
    }

    public function test_does_not_detect_generic_theme_css(): void
    {
        $result = $this->evaluate('<link rel="stylesheet" href="/css/theme.css">');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_detect_generic_vendor_js(): void
    {
        $result = $this->evaluate('<script src="/js/vendor.js"></script>');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_detect_generic_base_css(): void
    {
        $result = $this->evaluate('<link rel="stylesheet" href="/assets/base.css">');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_detect_generic_global_js(): void
    {
        $result = $this->evaluate('<script src="/assets/global.js"></script>');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_detect_generic_cart_js(): void
    {
        $result = $this->evaluate('<script src="/js/cart.js"></script>');

        self::assertFalse($result['matched']);
    }

    public function test_does_not_match_plain_theme_word(): void
    {
        $result = $this->evaluate('<title>About our theme</title>');

        self::assertFalse($result['matched']);
    }

    public function test_handles_empty_html(): void
    {
        $result = $this->evaluate('');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate('<script src="/assets/predictive-search.js"></script>');

        self::assertSame(15, $result['confidence']);
    }
}
