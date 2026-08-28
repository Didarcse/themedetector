<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Request;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the inbound request-body size limit.
 *
 * Verifies that Request detects an oversized request body without relying
 * on the declared Content-Length alone: the actual body length is always
 * checked, so chunked or mislabeled requests cannot bypass the cap, while a
 * declared Content-Length over the limit fails fast even before the body is
 * read.
 */
final class RequestBodyLimitTest extends TestCase
{
    public function test_default_maximum_body_size_is_a_conservative_limit(): void
    {
        self::assertSame(16384, Request::DEFAULT_MAX_BODY_BYTES);
    }

    public function test_request_within_the_limit_is_not_flagged(): void
    {
        $request = new Request('POST', '/api/v1/detect', [], [], [], '{"url":"https://example.com"}');

        self::assertFalse($request->bodyExceedsLimit());
        self::assertSame('{"url":"https://example.com"}', $request->body());
        self::assertSame(Request::DEFAULT_MAX_BODY_BYTES, $request->maxBodyBytes());
    }

    public function test_body_exactly_at_the_limit_is_not_flagged(): void
    {
        $body = str_repeat('a', Request::DEFAULT_MAX_BODY_BYTES);

        $request = new Request('POST', '/api/v1/detect', [], [], [], $body);

        self::assertSame(Request::DEFAULT_MAX_BODY_BYTES, strlen($request->body()));
        self::assertFalse($request->bodyExceedsLimit());
    }

    public function test_body_one_byte_over_the_limit_is_flagged(): void
    {
        $body = str_repeat('a', Request::DEFAULT_MAX_BODY_BYTES + 1);

        $request = new Request('POST', '/api/v1/detect', [], [], [], $body);

        self::assertTrue($request->bodyExceedsLimit());
    }

    public function test_custom_limit_can_be_configured(): void
    {
        $request = new Request('POST', '/api/v1/detect', [], [], [], str_repeat('a', 100), 100);

        self::assertFalse($request->bodyExceedsLimit());
        self::assertSame(100, $request->maxBodyBytes());
    }

    public function test_body_over_the_custom_limit_is_flagged_without_content_length(): void
    {
        $request = new Request(
            method: 'POST',
            uri: '/api/v1/detect',
            body: str_repeat('a', 129),
            maxBodyBytes: 128,
        );

        self::assertTrue($request->bodyExceedsLimit());
    }

    public function test_declared_content_length_over_the_limit_flags_a_small_body(): void
    {
        $request = new Request(
            'POST',
            '/api/v1/detect',
            [],
            [],
            ['CONTENT_LENGTH' => '999999'],
            '{"url":"https://example.com"}',
        );

        self::assertTrue($request->bodyExceedsLimit());
    }

    public function test_integer_content_length_over_the_limit_is_flagged(): void
    {
        $request = new Request(
            'POST',
            '/api/v1/detect',
            [],
            [],
            ['CONTENT_LENGTH' => 1_000_000],
            'small',
        );

        self::assertTrue($request->bodyExceedsLimit());
    }

    public function test_declared_content_length_at_the_limit_is_not_flagged(): void
    {
        $request = new Request(
            'POST',
            '/api/v1/detect',
            [],
            [],
            ['CONTENT_LENGTH' => (string) Request::DEFAULT_MAX_BODY_BYTES],
            str_repeat('a', Request::DEFAULT_MAX_BODY_BYTES),
        );

        self::assertFalse($request->bodyExceedsLimit());
    }

    public function test_malformed_content_length_is_not_trusted(): void
    {
        foreach (['', 'abc', '-1', '12.5', '1e3'] as $value) {
            $request = new Request(
                'POST',
                '/api/v1/detect',
                [],
                [],
                ['CONTENT_LENGTH' => $value],
                '{"url":"https://example.com"}',
            );

            self::assertFalse($request->bodyExceedsLimit(), 'value: ' . var_export($value, true));
        }
    }
}
