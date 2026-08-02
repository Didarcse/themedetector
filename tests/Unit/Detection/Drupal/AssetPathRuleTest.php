<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Drupal;

use App\Modules\Detection\Drupal\Rules\AssetPathRule;
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

    public function test_detects_sites_default_files_path(): void
    {
        $result = $this->evaluate(
            '<link href="/sites/default/files/style.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/sites/default/files/'],
            $result['metadata'],
        );
    }

    public function test_detects_core_misc_path(): void
    {
        $result = $this->evaluate(
            '<script src="/core/misc/drupal.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/core/misc/'],
            $result['metadata'],
        );
    }

    public function test_detects_core_assets_path(): void
    {
        $result = $this->evaluate(
            '<script src="/core/assets/vendor.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/core/assets/'],
            $result['metadata'],
        );
    }

    public function test_detects_modules_custom_path(): void
    {
        $result = $this->evaluate(
            '<script src="/modules/custom/example/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/modules/custom/'],
            $result['metadata'],
        );
    }

    public function test_detects_themes_custom_path(): void
    {
        $result = $this->evaluate(
            '<link href="/themes/custom/mytheme/style.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/themes/custom/'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_path_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="/sites/default/files/style.css">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="/core/misc/drupal.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="/themes/custom/mytheme/logo.png">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_asset_path(): void
    {
        $html = '<link href="/sites/default/files/style.css">'
            . '<script src="/core/misc/drupal.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/sites/default/files/'],
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
            '<link href="/sites/default/files/style.css">'
        );

        self::assertSame(20, $result['weight']);
    }

    public function test_returns_asset_path_metadata(): void
    {
        $result = $this->evaluate(
            '<link href="/sites/default/files/style.css">'
        );

        self::assertSame(
            ['asset_path' => '/sites/default/files/'],
            $result['metadata'],
        );
    }
}
