<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Squarespace;

use App\Modules\Detection\Squarespace\Rules\AssetPathRule;
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

    public function test_detects_static1_squarespace_host(): void
    {
        $result = $this->evaluate(
            '<link href="https://static1.squarespace.com/site.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static1.squarespace.com'],
            $result['metadata'],
        );
    }

    public function test_detects_static2_squarespace_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://static2.squarespace.com/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static2.squarespace.com'],
            $result['metadata'],
        );
    }

    public function test_detects_assets_squarespace_host(): void
    {
        $result = $this->evaluate(
            '<img src="https://assets.squarespace.com/image.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'assets.squarespace.com'],
            $result['metadata'],
        );
    }

    public function test_detects_images_squarespace_cdn_host(): void
    {
        $result = $this->evaluate(
            '<img src="https://images.squarespace-cdn.com/photo.jpg">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'images.squarespace-cdn.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="https://static1.squarespace.com/theme.css">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_host_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="https://static2.squarespace.com/app.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_host_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="https://assets.squarespace.com/logo.png">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_asset_host(): void
    {
        $html = '<link href="https://static1.squarespace.com/theme.css">'
            . '<script src="https://static2.squarespace.com/app.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static1.squarespace.com'],
            $result['metadata'],
        );
    }

    public function test_returns_no_match_when_no_asset_host_exists(): void
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
            '<link href="https://static1.squarespace.com/style.css">'
        );

        self::assertSame(20, $result['weight']);
    }

    public function test_returns_asset_host_metadata(): void
    {
        $result = $this->evaluate(
            '<link href="https://static1.squarespace.com/style.css">'
        );

        self::assertSame(
            ['asset_host' => 'static1.squarespace.com'],
            $result['metadata'],
        );
    }
}
