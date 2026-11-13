<?php

declare(strict_types=1);

namespace Tests\Integration\Logging;

use App\Core\Request;
use App\Logging\ContextRedactor;
use App\Logging\SecurityEventLogger;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\Exceptions\SsrfBlockedException;
use App\Modules\Http\HttpClient;
use PHPUnit\Framework\TestCase;
use Tests\Support\InMemoryLogger;

final class HttpSecurityLoggingTest extends TestCase
{
    public function test_curl_ssrf_rejection_is_logged_without_the_raw_target(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger($memory, new ContextRedactor());
        $request = new Request('POST', '/api/v1/detect');
        $logger->setRequest($request);
        $client = new CurlHttpClient(
            new NativeCurlAdapter(),
            eventLogger: $logger,
        );

        try {
            $client->get('http://127.0.0.1/private?token=secret#fragment');
            self::fail('Expected the SSRF policy to reject the destination.');
        } catch (SsrfBlockedException $exception) {
            self::assertSame('Invalid URL.', $exception->getMessage());
        }

        $records = $memory->recordsFor(SecurityEventLogger::HTTP_SSRF_BLOCKED);

        self::assertCount(1, $records);
        self::assertSame($request->requestId(), $records[0]['context']['request_id']);
        self::assertSame('127.0.0.1', $records[0]['context']['target_host']);
        self::assertSame('host_not_allowed', $records[0]['context']['reason']);

        $encoded = json_encode($records, JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('token=secret', $encoded);
        self::assertStringNotContainsString('fragment', $encoded);
    }

    public function test_legacy_client_ssrf_rejection_is_logged(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger($memory, new ContextRedactor());
        $client = new HttpClient(eventLogger: $logger);

        try {
            $client->get('http://10.0.0.1/internal');
            self::fail('Expected the SSRF policy to reject the destination.');
        } catch (SsrfBlockedException) {
        }

        $records = $memory->recordsFor(SecurityEventLogger::HTTP_SSRF_BLOCKED);

        self::assertCount(1, $records);
        self::assertSame('10.0.0.1', $records[0]['context']['target_host']);
    }
}
