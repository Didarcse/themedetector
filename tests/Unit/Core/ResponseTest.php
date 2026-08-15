<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Response;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the immutable HTTP response representation.
 *
 * Verifies the default security headers are present on every response
 * shape, that JSON responses keep the JSON content type, and that caller
 * headers override defaults without duplication.
 */
final class ResponseTest extends TestCase
{
    public function test_html_response_carries_security_headers(): void
    {
        $response = new Response('<h1>Hello</h1>');

        self::assertSame('text/html; charset=UTF-8', $response->headers()['Content-Type']);
        self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
    }

    public function test_json_response_keeps_json_content_type_and_carries_security_headers(): void
    {
        $response = Response::json(['success' => true]);

        self::assertSame('application/json; charset=UTF-8', $response->headers()['Content-Type']);
        self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
    }

    public function test_caller_headers_override_defaults_without_duplication(): void
    {
        $response = new Response(
            'x',
            200,
            ['X-Content-Type-Options' => 'no-sniff-overridden'],
        );

        self::assertSame('no-sniff-overridden', $response->headers()['X-Content-Type-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
        self::assertSame(
            $response->headers()['X-Content-Type-Options'],
            'no-sniff-overridden',
            'The overridden header must appear exactly once.',
        );
    }
}
