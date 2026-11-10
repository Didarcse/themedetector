<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Response;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the immutable HTTP response representation.
 *
 * Verifies the default security headers are present on every response
 * shape, that the Content-Security-Policy is restrictive and reflects the
 * real application dependencies, that JSON responses keep the JSON content
 * type, that caller headers override defaults without duplication, and that
 * withHeader() produces a new response without mutating the original.
 */
final class ResponseTest extends TestCase
{
    public function test_html_response_carries_security_headers(): void
    {
        $response = new Response('<h1>Hello</h1>');

        self::assertSame('text/html; charset=UTF-8', $response->headers()['Content-Type']);
        self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
        self::assertSame('DENY', $response->headers()['X-Frame-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
        self::assertSame(
            Response::CONTENT_SECURITY_POLICY,
            $response->headers()['Content-Security-Policy'],
        );
    }

    public function test_json_response_keeps_json_content_type_and_carries_security_headers(): void
    {
        $response = Response::json(['success' => true]);

        self::assertSame('application/json; charset=UTF-8', $response->headers()['Content-Type']);
        self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
        self::assertSame('DENY', $response->headers()['X-Frame-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
        self::assertSame(
            Response::CONTENT_SECURITY_POLICY,
            $response->headers()['Content-Security-Policy'],
        );
    }

    public function test_html_response_cannot_override_mandatory_cache_headers(): void
    {
        $response = Response::html(
            'x',
            200,
            [
                'Retry-After' => '60',
                'Cache-Control' => 'public, max-age=3600',
                'Vary' => 'Accept-Encoding',
                'cache-control' => 'private',
                'vary' => '*',
            ],
        );

        self::assertSame('no-store', $response->headers()['Cache-Control']);
        self::assertSame('Cookie', $response->headers()['Vary']);
        self::assertSame('60', $response->headers()['Retry-After']);

        $headerNames = array_map(
            static fn (string $name): string => strtolower($name),
            array_keys($response->headers()),
        );

        self::assertSame(1, count(array_keys($headerNames, 'cache-control')));
        self::assertSame(1, count(array_keys($headerNames, 'vary')));
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

    public function test_content_security_policy_is_restrictive(): void
    {
        $policy = Response::CONTENT_SECURITY_POLICY;

        self::assertStringNotContainsString('unsafe-inline', $policy);
        self::assertStringNotContainsString('unsafe-eval', $policy);
        self::assertStringNotContainsString('*', $policy);
        self::assertStringContainsString("default-src 'self'", $policy);
        self::assertStringContainsString("frame-ancestors 'none'", $policy);
        self::assertStringContainsString("object-src 'none'", $policy);
        self::assertStringContainsString("base-uri 'self'", $policy);
        self::assertStringContainsString("connect-src 'self'", $policy);
        self::assertStringContainsString("form-action 'self'", $policy);
        self::assertStringContainsString(
            "script-src 'self' https://cdn.jsdelivr.net",
            $policy,
        );
        self::assertStringContainsString(
            "style-src 'self' https://cdn.jsdelivr.net",
            $policy,
        );
    }

    public function test_hsts_max_age_is_a_safe_positive_policy(): void
    {
        self::assertSame(15552000, Response::HSTS_MAX_AGE);
        self::assertGreaterThan(0, Response::HSTS_MAX_AGE);
    }

    public function test_with_header_returns_a_new_response_without_mutating_the_original(): void
    {
        $original = new Response('x');

        $updated = $original->withHeader('Strict-Transport-Security', 'max-age=15552000');

        self::assertNotSame($original, $updated);
        self::assertArrayNotHasKey('Strict-Transport-Security', $original->headers());
        self::assertSame(
            'max-age=15552000',
            $updated->headers()['Strict-Transport-Security'],
        );
        self::assertSame('x', $updated->content());
        self::assertSame(200, $updated->status());

        // Defaults survive the copy and are not duplicated.
        self::assertSame('nosniff', $updated->headers()['X-Content-Type-Options']);
        self::assertSame('DENY', $updated->headers()['X-Frame-Options']);
        self::assertSame(
            Response::CONTENT_SECURITY_POLICY,
            $updated->headers()['Content-Security-Policy'],
        );
    }

    public function test_with_header_replaces_an_existing_header(): void
    {
        $response = (new Response('x'))->withHeader('X-Frame-Options', 'SAMEORIGIN');
        $replaced = $response->withHeader('X-Frame-Options', 'DENY');

        self::assertSame('SAMEORIGIN', $response->headers()['X-Frame-Options']);
        self::assertSame('DENY', $replaced->headers()['X-Frame-Options']);
        self::assertCount(1, array_filter(
            array_keys($replaced->headers()),
            static fn (string $name): bool => $name === 'X-Frame-Options',
        ));
    }
}
