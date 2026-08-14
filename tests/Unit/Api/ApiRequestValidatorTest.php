<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\ApiRequestValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the public API request validator.
 *
 * Verifies the strict POST /api/v1/detect request contract: the body must
 * be a JSON object with a single "url" string field, no unknown fields,
 * and a valid http(s) URL. Scheme-less hosts are inferred as https,
 * mirroring the existing analyzer.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 */
final class ApiRequestValidatorTest extends TestCase
{
    private ApiRequestValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ApiRequestValidator();
    }

    /**
     * @param array<string, mixed> $body        The decoded JSON object.
     * @param string               $expectedUrl The expected normalized URL.
     */
    #[DataProvider('validBodyProvider')]
    public function test_accepts_valid_url_bodies(array $body, string $expectedUrl): void
    {
        $result = $this->validator->validate($body);

        self::assertTrue($result->valid());
        self::assertSame([], $result->errors());
        self::assertSame($expectedUrl, $result->url());
    }

    /**
     * @return iterable<string, array{array<string, mixed>, string}>
     */
    public static function validBodyProvider(): iterable
    {
        yield 'absolute https url' => [
            ['url' => 'https://example.com'],
            'https://example.com',
        ];

        yield 'absolute http url' => [
            ['url' => 'http://example.com'],
            'http://example.com',
        ];

        yield 'scheme-less host infers https' => [
            ['url' => 'example.com'],
            'https://example.com',
        ];

        yield 'url with path and query' => [
            ['url' => '  example.com/blog?page=2  '],
            'https://example.com/blog?page=2',
        ];

        yield 'whitespace is trimmed' => [
            ['url' => '   https://example.com   '],
            'https://example.com',
        ];

        yield 'uppercase scheme is preserved' => [
            ['url' => 'HTTPS://example.com'],
            'HTTPS://example.com',
        ];
    }

    /**
     * @param array<string, mixed> $body          The decoded JSON object.
     * @param list<string>         $expectedCodes The expected error codes.
     */
    #[DataProvider('rejectedBodyProvider')]
    public function test_rejects_invalid_bodies(array $body, array $expectedCodes): void
    {
        $result = $this->validator->validate($body);

        self::assertFalse($result->valid());
        self::assertSame('', $result->url());

        $codes = array_map(
            static fn (array $error): string => $error['code'],
            $result->errors(),
        );

        self::assertSame($expectedCodes, $codes);
    }

    /**
     * @return iterable<string, array{array<string, mixed>, list<string>}>
     */
    public static function rejectedBodyProvider(): iterable
    {
        yield 'empty object is not a valid object' => [
            [],
            ['body_not_object'],
        ];

        yield 'unknown field is rejected' => [
            ['url' => 'https://example.com', 'callback' => 'x'],
            ['unknown_field'],
        ];

        yield 'unknown field without url' => [
            ['foo' => 'bar'],
            ['unknown_field', 'url_required'],
        ];

        yield 'url must be a string' => [
            ['url' => 42],
            ['url_invalid_type'],
        ];

        yield 'url must not be empty' => [
            ['url' => '   '],
            ['url_empty'],
        ];

        yield 'url must not be a list object' => [
            ['url' => []],
            ['url_invalid_type'],
        ];

        yield 'invalid url format' => [
            ['url' => 'ht!tp://example.com'],
            ['url_invalid_format'],
        ];

        yield 'ftp scheme is rejected' => [
            ['url' => 'ftp://example.com'],
            ['url_invalid_format'],
        ];

        yield 'file scheme is rejected' => [
            ['url' => 'file:///etc/passwd'],
            ['url_invalid_format'],
        ];

        yield 'gopher scheme is rejected' => [
            ['url' => 'gopher://example.com'],
            ['url_invalid_format'],
        ];

        yield 'data scheme is rejected' => [
            ['url' => 'data://text/plain'],
            ['url_invalid_format'],
        ];
    }

    public function test_rejects_non_object_bodies(): void
    {
        foreach ([null, 'string', 42, true, [1, 2, 3]] as $body) {
            $result = $this->validator->validate($body);

            self::assertFalse($result->valid(), 'body should be rejected: ' . var_export($body, true));
            self::assertSame(['body_not_object'], array_map(
                static fn (array $error): string => $error['code'],
                $result->errors(),
            ));
            self::assertSame('', $result->url());
        }
    }

    public function test_rejects_urls_longer_than_the_maximum(): void
    {
        $url = 'https://example.com/' . str_repeat('a', ApiRequestValidator::MAX_URL_LENGTH - 19);

        self::assertSame(ApiRequestValidator::MAX_URL_LENGTH + 1, strlen($url));

        $result = $this->validator->validate(['url' => $url]);

        self::assertFalse($result->valid());
        self::assertSame(['url_too_long'], array_map(
            static fn (array $error): string => $error['code'],
            $result->errors(),
        ));
    }

    public function test_accepts_url_at_exactly_the_maximum_length(): void
    {
        $url = 'https://example.com/' . str_repeat('a', ApiRequestValidator::MAX_URL_LENGTH - 20);

        self::assertSame(ApiRequestValidator::MAX_URL_LENGTH, strlen($url));

        $result = $this->validator->validate(['url' => $url]);

        self::assertTrue($result->valid());
        self::assertSame($url, $result->url());
    }

    public function test_error_messages_are_present(): void
    {
        $result = $this->validator->validate(['url' => '']);

        $error = $result->errors()[0];

        self::assertSame('url_empty', $error['code']);
        self::assertSame('The "url" field must not be empty.', $error['message']);
    }
}
