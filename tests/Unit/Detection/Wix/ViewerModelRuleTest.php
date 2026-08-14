<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Wix;

use App\Modules\Detection\Wix\Rules\ViewerModelRule;
use PHPUnit\Framework\TestCase;

final class ViewerModelRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): ViewerModelRule
    {
        return new ViewerModelRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_does_not_detect_bare_viewer_model(): void
    {
        $result = $this->evaluate('<script>viewerModel = {};</script>');

        self::assertFalse($result['matched']);
    }

    public function test_detects_site_features_configs(): void
    {
        $result = $this->evaluate('<script>siteFeaturesConfigs = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_client_spec_map(): void
    {
        $result = $this->evaluate('<script>clientSpecMap = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_does_not_detect_fleet_config(): void
    {
        $result = $this->evaluate('<script>fleetConfig = {};</script>');

        self::assertFalse($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>SITEFEATURESCONFIGS = {};</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'siteFeaturesConfigs = {};' .
            'clientSpecMap = {};' .
            '</script>'
        );

        self::assertSame(
            ['viewer_model' => 'siteFeaturesConfigs'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_fingerprint_exists(): void
    {
        $result = $this->evaluate('<script>const app = {};</script>');

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
        $result = $this->evaluate('<script>siteFeaturesConfigs = {};</script>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_viewer_model_metadata(): void
    {
        $result = $this->evaluate('<script>siteFeaturesConfigs = {};</script>');

        self::assertSame(
            ['viewer_model' => 'siteFeaturesConfigs'],
            $result['metadata']
        );
    }
}
