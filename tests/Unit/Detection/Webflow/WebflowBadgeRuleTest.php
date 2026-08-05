<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\Webflow\Rules\WebflowBadgeRule;
use PHPUnit\Framework\TestCase;

final class WebflowBadgeRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): WebflowBadgeRule
    {
        return new WebflowBadgeRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_webflow_dot_com_href(): void
    {
        $result = $this->evaluate('<a href="https://webflow.com"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(['badge_indicator' => 'webflow.com'], $result['metadata']);
    }

    public function test_detects_webflow_badge_class(): void
    {
        $result = $this->evaluate('<a class="webflow-badge"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(['badge_indicator' => 'webflow-badge'], $result['metadata']);
    }

    public function test_detects_w_webflow_badge_class(): void
    {
        $result = $this->evaluate('<a class="w-webflow-badge"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(['badge_indicator' => 'webflow-badge'], $result['metadata']);
    }

    public function test_detects_made_in_webflow_text(): void
    {
        $result = $this->evaluate('<a>Made in Webflow</a>');

        self::assertTrue($result['matched']);
        self::assertSame(['badge_indicator' => 'Made in Webflow'], $result['metadata']);
    }

    public function test_returns_first_matching_indicator(): void
    {
        $result = $this->evaluate(
            '<a href="https://webflow.com" class="webflow-badge">Made in Webflow</a>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(['badge_indicator' => 'webflow.com'], $result['metadata']);
    }

    public function test_returns_no_match_when_badge_is_missing(): void
    {
        $result = $this->evaluate('<a href="https://example.com">Contact</a>');

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
        $result = $this->evaluate('<a href="');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate('<a href="https://webflow.com"></a>');

        self::assertSame(10, $result['confidence']);
    }
}
