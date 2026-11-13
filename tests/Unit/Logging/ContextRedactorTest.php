<?php

declare(strict_types=1);

namespace Tests\Unit\Logging;

use App\Core\Request;
use App\Logging\ContextRedactor;
use PHPUnit\Framework\TestCase;

final class ContextRedactorTest extends TestCase
{
    public function test_unknown_and_secret_keys_are_dropped(): void
    {
        $redactor = new ContextRedactor();

        $redacted = $redactor->redact([
            'status' => 403,
            'reason' => 'missing_or_invalid_token',
            'api_key' => 'secret',
            'authorization' => 'Bearer secret',
            'cookie' => 'TD_SESSION=secret',
            'body' => '{"url":"https://example.com"}',
            'query' => '?token=secret',
        ]);

        self::assertSame([
            'status' => 403,
            'reason' => 'missing_or_invalid_token',
        ], $redacted);
    }

    public function test_target_url_is_reduced_to_host_and_host_only_hash(): void
    {
        $redactor = new ContextRedactor();

        $first = $redactor->redact([
            'target_url' => 'https://Example.com/private-id?token=secret#fragment',
        ]);
        $second = $redactor->redact([
            'target_url' => 'https://example.com/another/path?other=value',
        ]);

        self::assertSame('example.com', $first['target_host']);
        self::assertSame('example.com', $second['target_host']);
        self::assertSame($first['target_hash'], $second['target_hash']);
        self::assertSame(hash('sha256', 'https://example.com'), $first['target_hash']);
        self::assertArrayNotHasKey('target_url', $first);
        self::assertStringNotContainsString('secret', json_encode($first, JSON_THROW_ON_ERROR));
        self::assertStringNotContainsString('private-id', json_encode($first, JSON_THROW_ON_ERROR));
    }

    public function test_target_metadata_cannot_be_overridden_by_caller_context(): void
    {
        $redactor = new ContextRedactor();
        $expectedHash = hash('sha256', 'https://example.com');

        $attempts = [
            [
                'target_url' => 'https://example.com/safe',
                'target_host' => 'attacker.example',
                'target_hash' => str_repeat('a', 64),
            ],
            [
                'target_host' => 'attacker.example',
                'target_hash' => str_repeat('a', 64),
                'target_url' => 'https://example.com/safe',
            ],
        ];

        foreach ($attempts as $context) {
            $redacted = $redactor->redact($context);

            self::assertSame('example.com', $redacted['target_host']);
            self::assertSame($expectedHash, $redacted['target_hash']);
            self::assertStringNotContainsString(
                'attacker.example',
                json_encode($redacted, JSON_THROW_ON_ERROR),
            );
        }
    }

    public function test_caller_supplied_derived_fields_are_ignored_without_a_target_url(): void
    {
        $redactor = new ContextRedactor();

        self::assertSame([], $redactor->redact([
            'client' => 'raw-ip',
            'target_host' => 'example.com',
            'target_hash' => str_repeat('a', 64),
        ]));
    }

    public function test_client_address_is_omitted_without_a_hash_key(): void
    {
        $redactor = new ContextRedactor();

        self::assertSame([], $redactor->redact(['client_ip' => '203.0.113.10']));
    }

    public function test_client_address_is_hmac_hashed_with_a_key(): void
    {
        $redactor = new ContextRedactor('test-hash-key');

        $redacted = $redactor->redact(['client_ip' => '203.0.113.10']);

        self::assertSame(
            'hmac-sha256:' . hash_hmac('sha256', '203.0.113.10', 'test-hash-key'),
            $redacted['client'],
        );
    }

    public function test_control_characters_are_stripped_before_validation(): void
    {
        $redactor = new ContextRedactor();

        $redacted = $redactor->redact([
            'reason' => "missing_or_invalid_token\x00\n",
            'method' => "PO\x00ST",
            'path' => "/detect\x00?token=secret",
        ]);

        self::assertSame('missing_or_invalid_token', $redacted['reason']);
        self::assertSame('POST', $redacted['method']);
        self::assertSame('/detect', $redacted['path']);
    }

    public function test_free_form_fields_are_normalized_to_approved_values(): void
    {
        $redactor = new ContextRedactor();

        $redacted = $redactor->redact([
            'reason' => 'invalid_api_key',
            'engine' => 'technology',
            'tier' => 'anonymous',
            'content_type' => 'Application/JSON; charset=utf-8; token=secret',
            'method' => 'post',
            'path' => '/api/v1/detect?token=secret#fragment',
            'exception_class' => 'RuntimeException',
            'error_codes' => ['url_invalid_format', 'token=secret'],
        ]);

        self::assertSame([
            'reason' => 'invalid_api_key',
            'engine' => 'technology',
            'tier' => 'anonymous',
            'content_type' => 'application/json',
            'method' => 'POST',
            'path' => '/api/v1/detect',
            'exception_class' => 'RuntimeException',
            'error_codes' => ['url_invalid_format'],
        ], $redacted);
    }

    public function test_suspicious_free_form_values_are_rejected_or_reduced(): void
    {
        $redactor = new ContextRedactor();

        self::assertSame([
            'content_type' => 'other',
            'method' => 'OTHER',
        ], $redactor->redact([
            'reason' => 'token=secret',
            'engine' => 'technology?token=secret',
            'tier' => 'anonymous/secret',
            'content_type' => 'text/secret-token',
            'method' => 'SECRET-TOKEN',
            'path' => '/detect/secret-token',
            'exception_class' => 'RuntimeException; DROP TABLE',
            'error_codes' => ['token=secret', str_repeat('a', 65)],
        ]));
    }

    public function test_invalid_utf8_is_rejected_without_breaking_json_encoding(): void
    {
        $redactor = new ContextRedactor();

        $redacted = $redactor->redact(['reason' => "invalid-\xFF-value"]);

        self::assertArrayNotHasKey('reason', $redacted);
        self::assertNotFalse(json_encode($redacted, JSON_THROW_ON_ERROR));
    }

    public function test_exception_file_is_reduced_to_a_safe_basename(): void
    {
        $redactor = new ContextRedactor();

        $posix = $redactor->redact([
            'exception_file' => '/var/www/themedetector/app/Core/Kernel.php',
        ]);
        $windows = $redactor->redact([
            'exception_file' => 'C:\\xampp\\htdocs\\themedetector\\app\\Core\\Kernel.php',
        ]);

        self::assertSame(['exception_file' => 'Kernel.php'], $posix);
        self::assertSame(['exception_file' => 'Kernel.php'], $windows);

        $encoded = json_encode([$posix, $windows], JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('/var/www', $encoded);
        self::assertStringNotContainsString('xampp', $encoded);
        self::assertStringNotContainsString('app/Core', $encoded);
        self::assertSame([], $redactor->redact([
            'exception_file' => '/var/www/file with spaces.php',
        ]));
    }

    public function test_request_metadata_contains_correlation_and_strips_query_from_path(): void
    {
        $redactor = new ContextRedactor('test-hash-key');
        $request = new Request(
            'GET',
            '/detect?token=secret',
            server: ['REMOTE_ADDR' => '198.51.100.7'],
        );

        $metadata = $redactor->requestMetadata($request);

        self::assertSame($request->requestId(), $metadata['request_id']);
        self::assertSame('GET', $metadata['method']);
        self::assertSame('/detect', $metadata['path']);
        self::assertSame(
            'hmac-sha256:' . hash_hmac('sha256', '198.51.100.7', 'test-hash-key'),
            $metadata['client'],
        );
        self::assertArrayNotHasKey('client_ip', $metadata);
        self::assertStringNotContainsString('secret', json_encode($metadata, JSON_THROW_ON_ERROR));
    }

    public function test_request_id_and_status_are_validated(): void
    {
        $redactor = new ContextRedactor();

        self::assertSame([], $redactor->redact([
            'request_id' => 'client-controlled',
            'status' => 99,
        ]));
        self::assertSame(
            ['request_id' => '0123456789abcdef0123456789abcdef'],
            $redactor->redact(['request_id' => '0123456789abcdef0123456789abcdef']),
        );
    }
}
