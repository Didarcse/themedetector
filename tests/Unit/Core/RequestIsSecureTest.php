<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Request;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for Request::isSecure().
 *
 * Secure-transport detection must accept only direct TLS signals (the HTTPS
 * server flag or port 443) plus X-Forwarded-Proto from a configured trusted
 * proxy. Untrusted clients must never be able to force HSTS by sending
 * forwarded headers themselves.
 */
final class RequestIsSecureTest extends TestCase
{
    public function test_https_flag_enables_secure_request(): void
    {
        foreach (['on', '1', 'ON', 'On'] as $flag) {
            $request = new Request('GET', '/', server: ['HTTPS' => $flag]);

            self::assertTrue($request->isSecure(), "HTTPS={$flag} must be secure.");
        }
    }

    public function test_https_flag_off_or_empty_disables_secure_request(): void
    {
        foreach (['off', 'OFF', '', '0', 'disabled'] as $flag) {
            $request = new Request('GET', '/', server: ['HTTPS' => $flag]);

            self::assertFalse($request->isSecure(), "HTTPS={$flag} must not be secure.");
        }

        self::assertFalse((new Request('GET', '/'))->isSecure());
    }

    public function test_port_443_is_treated_as_secure(): void
    {
        self::assertTrue((new Request('GET', '/', server: ['SERVER_PORT' => 443]))->isSecure());
        self::assertTrue((new Request('GET', '/', server: ['SERVER_PORT' => '443']))->isSecure());
        self::assertFalse((new Request('GET', '/', server: ['SERVER_PORT' => 80]))->isSecure());
        self::assertFalse((new Request('GET', '/', server: ['SERVER_PORT' => '8080']))->isSecure());
    }

    public function test_forwarded_proto_is_ignored_without_trusted_proxies(): void
    {
        $request = new Request('GET', '/', server: [
            'REMOTE_ADDR' => '198.51.100.7',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ]);

        self::assertFalse($request->isSecure());
    }

    public function test_forwarded_proto_is_honored_from_an_exact_trusted_proxy(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '203.0.113.9',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['203.0.113.9'],
        );

        self::assertTrue($request->isSecure());
    }

    public function test_forwarded_proto_is_honored_from_a_trusted_cidr_block(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '10.20.30.40',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['10.0.0.0/8'],
        );

        self::assertTrue($request->isSecure());
    }

    public function test_forwarded_proto_is_ignored_when_cidr_does_not_match(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '192.0.2.40',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['10.0.0.0/8'],
        );

        self::assertFalse($request->isSecure());
    }

    public function test_forwarded_proto_http_from_trusted_proxy_is_not_secure(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '203.0.113.9',
                'HTTP_X_FORWARDED_PROTO' => 'http',
            ],
            trustedProxies: ['203.0.113.9'],
        );

        self::assertFalse($request->isSecure());
    }

    public function test_ipv6_cidr_trusted_proxy_is_supported(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '2001:db8:abcd::1',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['2001:db8::/32'],
        );

        self::assertTrue($request->isSecure());
    }

    public function test_mixed_address_families_do_not_match(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '2001:db8::1',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['10.0.0.0/8'],
        );

        self::assertFalse($request->isSecure());
    }

    public function test_invalid_trusted_proxy_entries_are_ignored(): void
    {
        $request = new Request(
            'GET',
            '/',
            server: [
                'REMOTE_ADDR' => '203.0.113.9',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ],
            trustedProxies: ['not-an-ip', '10.0.0.0/999', '203.0.113.9/'],
        );

        self::assertFalse($request->isSecure());
    }

    public function test_direct_tls_wins_over_a_conflicting_forwarded_header(): void
    {
        $request = new Request('GET', '/', server: [
            'HTTPS' => 'on',
            'REMOTE_ADDR' => '198.51.100.7',
            'HTTP_X_FORWARDED_PROTO' => 'http',
        ]);

        self::assertTrue($request->isSecure());
    }

    public function test_from_globals_honors_configured_trusted_proxies(): void
    {
        $previousServer = $_SERVER;
        $previousEnvSuperglobal = $_ENV;
        $previousProcessEnv = getenv('TRUSTED_PROXIES');

        try {
            putenv('TRUSTED_PROXIES=203.0.113.9');
            unset($_ENV['TRUSTED_PROXIES']);

            $_SERVER = [
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/',
                'REMOTE_ADDR' => '203.0.113.9',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ];

            self::assertTrue(Request::fromGlobals()->isSecure());
        } finally {
            $_SERVER = $previousServer;
            $_ENV = $previousEnvSuperglobal;

            if ($previousProcessEnv === false) {
                putenv('TRUSTED_PROXIES');
            } else {
                putenv('TRUSTED_PROXIES=' . $previousProcessEnv);
            }
        }
    }

    public function test_from_globals_fails_closed_without_trusted_proxies(): void
    {
        $previousServer = $_SERVER;
        $previousEnvSuperglobal = $_ENV;
        $previousProcessEnv = getenv('TRUSTED_PROXIES');

        try {
            putenv('TRUSTED_PROXIES');
            unset($_ENV['TRUSTED_PROXIES'], $_SERVER['TRUSTED_PROXIES']);

            $_SERVER = [
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/',
                'REMOTE_ADDR' => '198.51.100.7',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ];

            self::assertFalse(Request::fromGlobals()->isSecure());
        } finally {
            $_SERVER = $previousServer;
            $_ENV = $previousEnvSuperglobal;

            if ($previousProcessEnv === false) {
                putenv('TRUSTED_PROXIES');
            } else {
                putenv('TRUSTED_PROXIES=' . $previousProcessEnv);
            }
        }
    }
}
