<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Ghost;

use App\Modules\Detection\Ghost\Rules\AssetPathRule;
use PHPUnit\Framework\TestCase;

final class AssetPathRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): AssetPathRule
    {
        return new AssetPathRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_content_themes_path(): void
    {
        $result = $this->evaluate(
            '<link href="/content/themes/casper/style.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/content/themes/'],
            $result['metadata'],
        );
    }

    public function test_detects_content_images_path(): void
    {
        $result = $this->evaluate(
            '<img src="/content/images/logo.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/content/images/'],
            $result['metadata'],
        );
    }

    public function test_detects_assets_built_path(): void
    {
        $result = $this->evaluate(
            '<script src="/assets/built/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/assets/built/'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_path_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="/content/themes/casper/style.css">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="/assets/built/app.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="/content/images/logo.png">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_asset_path(): void
    {
        $html = '<link href="/content/themes/casper/style.css">'
            . '<script src="/assets/built/app.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/content/themes/'],
            $result['metadata'],
        );
    }

    public function test_returns_no_match_when_no_asset_path_exists(): void
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
        $result = $this->evaluate('<link href="');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_weight(): void
    {
        $result = $this->evaluate(
            '<link href="/content/themes/casper/style.css">'
        );

        self::assertSame(20, $result['weight']);
    }

    public function test_returns_asset_path_metadata(): void
    {
        $result = $this->evaluate(
            '<link href="/content/themes/casper/style.css">'
        );

        self::assertSame(
            ['asset_path' => '/content/themes/'],
            $result['metadata'],
        );
    }
}
