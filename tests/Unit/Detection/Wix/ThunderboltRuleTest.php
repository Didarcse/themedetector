<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Wix;

use App\Modules\Detection\Wix\Rules\ThunderboltRule;
use PHPUnit\Framework\TestCase;

final class ThunderboltRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): ThunderboltRule
    {
        return new ThunderboltRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_wix_thunderbolt(): void
    {
        $result = $this->evaluate('<script>wix-thunderbolt</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_tb_ready(): void
    {
        $result = $this->evaluate('<script>tbReady();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_tb_init(): void
    {
        $result = $this->evaluate('<script>tbInit();</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_thunderbolt(): void
    {
        $result = $this->evaluate('<script>thunderbolt</script>');

        self::assertTrue($result['matched']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<script>WIX-THUNDERBOLT</script>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_fingerprint(): void
    {
        $result = $this->evaluate(
            '<script>' .
            'wix-thunderbolt' .
            'tbReady();' .
            '</script>'
        );

        self::assertSame(
            ['thunderbolt' => 'wix-thunderbolt'],
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
        $result = $this->evaluate('<script>wix-thunderbolt</script>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_thunderbolt_metadata(): void
    {
        $result = $this->evaluate('<script>wix-thunderbolt</script>');

        self::assertSame(
            ['thunderbolt' => 'wix-thunderbolt'],
            $result['metadata']
        );
    }
}
