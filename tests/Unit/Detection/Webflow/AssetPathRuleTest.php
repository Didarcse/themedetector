<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\Webflow\Rules\AssetPathRule;
use PHPUnit\Framework\TestCase;

final class AssetPathRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): AssetPathRule
    {
        return new AssetPathRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_assets_website_files_host(): void
    {
        $result = $this->evaluate(
            '<link href="https://assets.website-files.com/css/site.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'assets.website-files.com'],
            $result['metadata'],
        );
    }

    public function test_detects_cdn_prod_website_files_host(): void
    {
        $result = $this->evaluate(
            '<script src="https://cdn.prod.website-files.com/js/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'cdn.prod.website-files.com'],
            $result['metadata'],
        );
    }

    public function test_detects_uploads_ssl_webflow_host(): void
    {
        $result = $this->evaluate(
            '<img src="https://uploads-ssl.webflow.com/image.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'uploads-ssl.webflow.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="https://cdn.prod.website-files.com/theme.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'cdn.prod.website-files.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="https://uploads-ssl.webflow.com/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'uploads-ssl.webflow.com'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_host_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="https://assets.website-files.com/logo.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'assets.website-files.com'],
            $result['metadata'],
        );
    }

    public function test_returns_first_matching_asset_host(): void
    {
        $html = '<link href="https://assets.website-files.com/theme.css">'
            . '<script src="https://cdn.prod.website-files.com/app.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_host' => 'assets.website-files.com'],
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
        $result = $this->evaluate(' ');

        self::assertFalse($result['matched']);
    }

    public function test_handles_malformed_html(): void
    {
        $result = $this->evaluate('<link href="');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate(
            '<link href="https://assets.website-files.com/css/site.css">'
        );

        self::assertSame(15, $result['confidence']);
    }
}
