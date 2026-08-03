<?php

declare(strict_types=1);

namespace Tests\Unit\Detection\TYPO3;

use App\Modules\Detection\TYPO3\Rules\ApiEndpointRule;
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

    public function test_detects_typo3_endpoint(): void
    {
        $result = $this->evaluate('<script src="/typo3/"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/typo3/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_index_php_endpoint(): void
    {
        $result = $this->evaluate('<script src="/typo3/index.php"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/typo3/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_ajax_endpoint(): void
    {
        $result = $this->evaluate('<script src="/typo3/ajax"></script>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/typo3/'],
            $result['metadata'],
        );
    }

    public function test_detects_typo3_module_endpoint(): void
    {
        $result = $this->evaluate('<a href="/typo3/module"></a>');

        self::assertTrue($result['matched']);
        self::assertSame(
            ['api_endpoint' => '/typo3/'],
            $result['metadata'],
        );
    }

    public function test_detects_case_insensitively(): void
    {
        $result = $this->evaluate('<a href="/TYPO3/"></a>');

        self::assertTrue($result['matched']);
    }

    public function test_returns_first_matching_endpoint(): void
    {
        $result = $this->evaluate(
            '<script src="/typo3/index.php"></script>' .
            '<a href="/typo3/module"></a>'
        );

        self::assertSame(
            ['api_endpoint' => '/typo3/'],
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
        $result = $this->evaluate('<script src="/typo3/"></script>');

        self::assertSame(15, $result['weight']);
    }

    public function test_returns_api_endpoint_metadata(): void
    {
        $result = $this->evaluate('<script src="/typo3/"></script>');

        self::assertSame(
            ['api_endpoint' => '/typo3/'],
            $result['metadata'],
        );
    }
}
