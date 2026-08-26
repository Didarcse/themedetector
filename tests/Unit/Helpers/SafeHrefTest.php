<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;

/**
 * Regression tests for safe_href URL sanitizer.
 *
 * Verifies that only http and https schemes are allowed in HTML href
 * attributes. Unsafe schemes such as javascript, data, and vbscript are
 * rejected to prevent stored XSS through attacker-controlled metadata URLs.
 *
 * @see resources/views/partials/report-card.php
 * @see resources/views/partials/plugin-card.php
 */
final class SafeHrefTest extends TestCase
{
    public function test_https_url_is_preserved(): void
    {
        self::assertSame('https://example.com/theme', safe_href('https://example.com/theme'));
    }

    public function test_http_url_is_preserved(): void
    {
        self::assertSame('http://example.com/theme', safe_href('http://example.com/theme'));
    }

    public function test_javascript_uri_is_rejected(): void
    {
        self::assertSame('', safe_href('javascript:alert(1)'));
    }

    public function test_javascript_uri_with_whitespace_is_rejected(): void
    {
        self::assertSame('', safe_href('javascript:alert(1)'));
    }

    public function test_data_uri_is_rejected(): void
    {
        self::assertSame('', safe_href('data:text/html,<script>alert(1)</script>'));
    }

    public function test_vbscript_uri_is_rejected(): void
    {
        self::assertSame('', safe_href('vbscript:MsgBox("XSS")'));
    }

    public function test_empty_string_returns_empty(): void
    {
        self::assertSame('', safe_href(''));
    }

    public function test_javascript_with_encoded_characters_is_rejected(): void
    {
        self::assertSame('', safe_href('javaScript:alert(1)'));
    }

    public function test_data_uri_with_svg_payload_is_rejected(): void
    {
        self::assertSame('', safe_href('data:image/svg+xml,<svg onload=alert(1)>'));
    }

    public function test_relative_path_returns_empty_string(): void
    {
        self::assertSame('', safe_href('/wp-content/themes/twenty/style.css'));
    }

    public function test_normal_theme_url_is_preserved(): void
    {
        self::assertSame(
            'https://developer.wordpress.org/themes/twentytwentyfive/',
            safe_href('https://developer.wordpress.org/themes/twentytwentyfive/'),
        );
    }

    public function test_url_with_port_is_preserved(): void
    {
        self::assertSame('https://example.com:8080/theme', safe_href('https://example.com:8080/theme'));
    }

    public function test_url_with_query_string_is_preserved(): void
    {
        self::assertSame(
            'https://example.com/theme?v=2',
            safe_href('https://example.com/theme?v=2'),
        );
    }

    public function test_url_with_fragment_is_preserved(): void
    {
        self::assertSame(
            'https://example.com/theme#readme',
            safe_href('https://example.com/theme#readme'),
        );
    }
}
