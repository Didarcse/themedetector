<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Webflow;

use App\Modules\Detection\Webflow\Rules\DataAttributesRule;
use PHPUnit\Framework\TestCase;

final class DataAttributesRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): DataAttributesRule
    {
        return new DataAttributesRule();
    }

    /**
     * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_data_wf_page_attribute(): void
    {
        $result = $this->evaluate('<html data-wf-page="abc123"></html>');

        self::assertTrue($result['matched']);
        self::assertSame(['wf_attribute' => 'data-wf-page'], $result['metadata']);
    }

    public function test_detects_data_wf_site_attribute(): void
    {
        $result = $this->evaluate('<body data-wf-site="site456"></body>');

        self::assertTrue($result['matched']);
        self::assertSame(['wf_attribute' => 'data-wf-site'], $result['metadata']);
    }

    public function test_returns_first_matching_attribute(): void
    {
        $result = $this->evaluate(
            '<html data-wf-page="1"><body data-wf-site="2"></body></html>'
        );

        self::assertTrue($result['matched']);
        self::assertSame(['wf_attribute' => 'data-wf-page'], $result['metadata']);
    }

    public function test_returns_no_match_when_attributes_are_missing(): void
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
        $result = $this->evaluate('<div><p>unclosed tag');

        self::assertFalse($result['matched']);
    }

    public function test_returns_expected_confidence(): void
    {
        $result = $this->evaluate('<html data-wf-page="abc123"></html>');

        self::assertSame(15, $result['confidence']);
    }

    public function test_returns_attribute_metadata(): void
    {
        $result = $this->evaluate('<html data-wf-page="abc123"></html>');

        self::assertSame(['wf_attribute' => 'data-wf-page'], $result['metadata']);
    }
}
