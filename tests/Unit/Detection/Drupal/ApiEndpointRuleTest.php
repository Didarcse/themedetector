<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Drupal;

use App\Modules\Detection\Drupal\Rules\ApiEndpointRule;
use PHPUnit\Framework\TestCase;

final class ApiEndpointRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    private function createRule(): ApiEndpointRule
    {
        return new ApiEndpointRule();
    }

    /**
     * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
     */
    private function evaluate(string $html): array
    {
        return $this->createRule()->evaluate($html, self::URL);
    }

    public function test_detects_jsonapi_endpoint(): void
    {
        $result = $this->evaluate('<script src="/jsonapi/"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/jsonapi/'],
            $result['metadata'],
        );
    }

    public function test_detects_entity_endpoint(): void
    {
        $result = $this->evaluate('<a href="/entity/node/1"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/entity/'],
            $result['metadata'],
        );
    }

    public function test_detects_node_endpoint(): void
    {
        $result = $this->evaluate('<a href="/node/1"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/node/'],
            $result['metadata'],
        );
    }

    public function test_detects_user_login_endpoint(): void
    {
        $result = $this->evaluate('<form action="/user/login"></form>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/user/login'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<a href="/JSONAPI/"></a>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_endpoint(): void
    {
        $result = $this->evaluate(
            '<script src="/jsonapi/"></script>' .
            '<a href="/user/login"></a>'
        );

        self::assertSame(
            ['api_endpoint' => '/jsonapi/'],
            $result['metadata']
        );
    }

    public function test_returns_no_match_when_no_endpoint_exists(): void
    {
        $result = $this->evaluate('<div class="example"></div>');

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
        $result = $this->evaluate('<script src="/jsonapi/"></script>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_api_endpoint_metadata(): void
    {
        $result = $this->evaluate('<script src="/jsonapi/"></script>');

        self::assertSame(
            ['api_endpoint' => '/jsonapi/'],
            $result['metadata'],
        );
    }
}
