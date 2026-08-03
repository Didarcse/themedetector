<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\TYPO3;

use App\Modules\Detection\TYPO3\Rules\AssetPathRule;
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

    public function test_detects_typo3_path(): void
    {
        $result = $this->evaluate(
            '<link href="/typo3/templates/main.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/typo3/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3conf_path(): void
    {
        $result = $this->evaluate(
            '<img src="/typo3conf/ext/site/logo.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/typo3conf/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3temp_path(): void
    {
        $result = $this->evaluate(
            '<script src="/typo3temp/assets/js/app.js"></script>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/typo3temp/'],
            $result['metadata'],
        );
    }

    public function test_detects_fileadmin_path(): void
    {
        $result = $this->evaluate(
            '<img src="/fileadmin/user_upload/logo.png">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/fileadmin/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_sysext_path(): void
    {
        $result = $this->evaluate(
            '<link href="/typo3/sysext/rte_ckeditor/styles.css">'
        );

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/typo3/sysext/'],
            $result['metadata'],
        );
    }

    public function test_detects_asset_path_in_link_element(): void
    {
        $result = $this->evaluate(
            '<link href="/typo3/templates/main.css">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_script_element(): void
    {
        $result = $this->evaluate(
            '<script src="/typo3temp/assets/js/app.js"></script>'
        );

        self::assertTrue($result['matched']);
    }

    public function test_detects_asset_path_in_img_element(): void
    {
        $result = $this->evaluate(
            '<img src="/fileadmin/user_upload/logo.png">'
        );

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_asset_path(): void
    {
        $html = '<link href="/typo3/templates/main.css">'
            . '<script src="/typo3temp/assets/js/app.js"></script>';

        $result = $this->evaluate($html);

        self::assertTrue($result['matched']);
        self::assertSame(
            ['asset_path' => '/typo3/'],
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
            '<link href="/typo3/templates/main.css">'
        );

        self::assertSame(20, $result['weight']);
    }

    public function test_returns_asset_path_metadata(): void
    {
        $result = $this->evaluate(
            '<link href="/typo3/templates/main.css">'
        );

        self::assertSame(
            ['asset_path' => '/typo3/'],
            $result['metadata'],
        );
    }
}
