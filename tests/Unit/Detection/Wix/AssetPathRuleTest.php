<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Wix;

use App\Modules\Detection\Wix\Rules\AssetPathRule;
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

    public function test_detects_static_wixstatic_host(): void
    {
        $result = $this->evaluate(
            '<link href="https://static.wixstatic.com/css/site.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static.wixstatic.com'],
            $result['metadata'],
        );
    }

    public function test_detects_static_parastorage_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://static.parastorage.com/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static.parastorage.com'],
            $result['metadata'],
        );
    }

    public function test_detects_siteassets_parastorage_host(): void
    {
        $result = $this->evaluate(
            '<img src="https://siteassets.parastorage.com/image.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'siteassets.parastorage.com'],
            $result['metadata'],
        );
    }

    public function test_detects_frog_wix_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://frog.wix.com/api"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'frog.wix.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="https://static.wixstatic.com/theme.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static.wixstatic.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="https://static.parastorage.com/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static.parastorage.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="https://siteassets.parastorage.com/logo.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'siteassets.parastorage.com'],
            $result['metadata'],
        );
    }

    public function test_returns_first_matching_asset_host(): void
    {
        $html = '<link href="https://static.wixstatic.com/theme.css">'
            . '<script src="https://static.parastorage.com/app.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'static.wixstatic.com'],
            $result['metadata'],
        );
    }

    public function test_returns_no_match_when_no_asset_host_exists(): void
    {
        $result = $this->evaluate('<html><body><p>plain</p></body></html>');

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
            '<link href="https://static.wixstatic.com/style.css">'
        );

        self::assertSame(20, $result['weight']);
    }
}
