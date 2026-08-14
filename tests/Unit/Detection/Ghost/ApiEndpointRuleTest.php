<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\Ghost;

use App\Modules\Detection\Ghost\Rules\ApiEndpointRule;
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

    public function test_detects_ghost_api_endpoint(): void
    {
        $result = $this->evaluate('<script src="/ghost/api/"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/ghost/api/'],
            $result['metadata'],
        );
    }

    public function test_detects_ghost_api_content_endpoint(): void
    {
        $result = $this->evaluate('<script src="/ghost/api/content/"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/ghost/api/'],
            $result['metadata'],
        );
    }

    public function test_detects_ghost_api_admin_endpoint(): void
    {
        $result = $this->evaluate('<script src="/ghost/api/admin/"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/ghost/api/'],
            $result['metadata'],
        );
    }

    public function test_does_not_detect_bare_ghost_directory(): void
    {
        $result = $this->evaluate('<a href="/ghost/hollow-forest">Play as the ghost</a>');

        self::assertFalse($result['matched']);
        self::assertSame([], $result['metadata']);
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<a href="/GHOST/API/"></a>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_endpoint(): void
    {
        $result = $this->evaluate(
            '<script src="/ghost/api/"></script>' .
            '<a href="/ghost/"></a>'
        );

        self::assertSame(
            ['api_endpoint' => '/ghost/api/'],
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
        $result = $this->evaluate('<script src="/ghost/api/"></script>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_api_endpoint_metadata(): void
    {
        $result = $this->evaluate('<script src="/ghost/api/"></script>');

        self::assertSame(
            ['api_endpoint' => '/ghost/api/'],
            $result['metadata'],
        );
    }
}
