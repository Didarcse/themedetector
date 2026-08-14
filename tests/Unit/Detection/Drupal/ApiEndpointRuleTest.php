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

    public function test_detects_jsonapi_node_endpoint(): void
    {
        $result = $this->evaluate('<a href="/jsonapi/node/1"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/jsonapi/'],
            $result['metadata'],
        );
    }

    public function test_returns_first_matching_endpoint(): void
    {
        $result = $this->evaluate(
            '<script src="/jsonapi/"></script>' .
            '<a href="/node/1"></a>'
        );

        self::assertSame(
            ['api_endpoint' => '/jsonapi/'],
            $result['metadata']
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<a href="/JSONAPI/"></a>');

        self::assertTrue($result['matched']);
    }

    public function test_does_not_match_generic_node_route(): void
    {
        $result = $this->evaluate('<a href="/node/1"></a>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_entity_route(): void
    {
        $result = $this->evaluate('<a href="/entity/customer/5"></a>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_user_login_route(): void
    {
        $result = $this->evaluate('<form action="/user/login"></form>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_paths_in_css(): void
    {
        $result = $this->evaluate('<style>.a{background:url(/node/img.png)}</style>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_paths_in_javascript(): void
    {
        $result = $this->evaluate('<script>const routes = [{path: "/node/:id"}];</script>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_generic_paths_in_plain_text(): void
    {
        $result = $this->evaluate(
            '<p>GET /node/{id} returns a record. POST /entity/account creates one. ' .
            'Sign in at /user/login.</p>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_does_not_match_combination_of_generic_paths(): void
    {
        $result = $this->evaluate(
            '<a href="/node/1">a</a>' .
            '<a href="/entity/customer/5">b</a>' .
            '<a href="/user/login">c</a>'
        );

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
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
