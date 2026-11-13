<?php

declare(strict_types=1);

namespace Tests\Integration\Logging;

use App\Api\WorkloadGuard;
use App\Core\Response;
use App\Logging\SecurityEventLogger;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

#[BackupGlobals(true)]
final class SecurityEventIntegrationTest extends TestCase
{
    private ?ApiTestKernel $kernel = null;

    protected function tearDown(): void
    {
        if ($this->kernel !== null) {
            $this->kernel->cleanup();
            $this->kernel = null;
        }
    }

    public function test_csrf_rejection_is_logged_once_and_correlated(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->kernel->handleRequest(
            'POST',
            '/detect',
            ['url' => 'example.com'],
            ['REMOTE_ADDR' => '198.51.100.7'],
            false,
        );

        self::assertSame(403, $response->status());

        $requestId = $response->headers()['X-Request-ID'];
        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::CSRF_REJECTED);

        self::assertCount(1, $records);
        self::assertSame($requestId, $records[0]['context']['request_id']);
        self::assertSame(403, $records[0]['context']['status']);
        self::assertStringNotContainsString(
            'example.com',
            json_encode($records, JSON_THROW_ON_ERROR),
        );
    }

    public function test_api_authentication_rejection_is_logged_without_the_key(): void
    {
        $this->kernel = ApiTestKernel::create(apiKeys: ['valid-secret-key']);

        $response = $this->post(
            '{"url":"example.com"}',
            [
                'HTTP_AUTHORIZATION' => 'Bearer wrong-secret-key',
                'HTTP_X_REQUEST_ID' => 'client-controlled-id',
                'REMOTE_ADDR' => '198.51.100.7',
            ],
        );

        self::assertSame(401, $response->status());

        $payload = $this->payload($response);
        $requestId = $payload['requestId'];

        self::assertIsString($requestId);
        self::assertNotSame('client-controlled-id', $requestId);
        self::assertSame($requestId, $response->headers()['X-Request-ID']);

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::API_AUTH_REJECTED);

        self::assertCount(1, $records);
        self::assertSame($requestId, $records[0]['context']['request_id']);
        self::assertSame('invalid_api_key', $records[0]['context']['reason']);
        self::assertTrue($records[0]['context']['has_authorization']);

        $encoded = json_encode($records, JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('wrong-secret-key', $encoded);
        self::assertStringNotContainsString('valid-secret-key', $encoded);
        self::assertStringNotContainsString('Bearer', $encoded);
    }

    public function test_api_validation_rejection_is_logged_once_without_the_url(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->kernel->handle(
            '{"url":"ftp://example.com/private?token=secret"}',
            ['HTTP_CONTENT_TYPE' => 'application/json'],
        );

        self::assertSame(422, $response->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::API_REQUEST_REJECTED);

        self::assertCount(1, $records);
        self::assertSame(422, $records[0]['context']['status']);
        self::assertSame('invalid_url', $records[0]['context']['reason']);
        self::assertSame(['url_invalid_format'], $records[0]['context']['error_codes']);

        $encoded = json_encode($records, JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('ftp://example.com', $encoded);
        self::assertStringNotContainsString('token=secret', $encoded);
    }

    public function test_api_content_type_and_size_rejections_are_logged_once(): void
    {
        $this->kernel = ApiTestKernel::create();

        $unsupported = $this->kernel->handle(
            '{"url":"example.com"}',
            ['HTTP_CONTENT_TYPE' => 'text/plain'],
        );

        self::assertSame(415, $unsupported->status());

        $tooLarge = $this->kernel->handle(
            '{"url":"' . str_repeat('a', 17000) . '"}',
            ['HTTP_CONTENT_TYPE' => 'application/json'],
        );

        self::assertSame(413, $tooLarge->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::API_REQUEST_REJECTED);

        self::assertCount(2, $records);
        self::assertSame(415, $records[0]['context']['status']);
        self::assertSame('unsupported_media_type', $records[0]['context']['reason']);
        self::assertSame('text/plain', $records[0]['context']['content_type']);
        self::assertSame(413, $records[1]['context']['status']);
        self::assertSame('payload_too_large', $records[1]['context']['reason']);
    }

    public function test_api_rate_limit_is_logged_once(): void
    {
        $this->kernel = ApiTestKernel::create(anonymousLimit: 1, now: 1000);

        self::assertSame(200, $this->post('{"url":"example.com"}')->status());
        self::assertSame(429, $this->post('{"url":"other.example.com"}')->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::API_RATE_LIMIT_DENIED);

        self::assertCount(1, $records);
        self::assertSame('anonymous', $records[0]['context']['tier']);
        self::assertSame(1, $records[0]['context']['limit']);
        self::assertSame(0, $records[0]['context']['remaining']);
        self::assertGreaterThan(0, $records[0]['context']['retry_after']);
    }

    public function test_web_rate_limit_is_logged_once(): void
    {
        $this->kernel = ApiTestKernel::create(webLimit: 1, now: 1000);

        $first = $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']);
        $second = $this->kernel->handleRequest('POST', '/detect', ['url' => 'other.example.com']);

        self::assertSame(200, $first->status());
        self::assertSame(429, $second->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::WEB_RATE_LIMIT_DENIED);

        self::assertCount(1, $records);
        self::assertSame('web', $records[0]['context']['tier']);
        self::assertSame(1, $records[0]['context']['limit']);
        self::assertGreaterThan(0, $records[0]['context']['retry_after']);
    }

    public function test_api_workload_rejection_is_logged_once(): void
    {
        $this->kernel = ApiTestKernel::create(maxConcurrent: 1);

        $guard = $this->kernel->container->get(WorkloadGuard::class);

        self::assertInstanceOf(WorkloadGuard::class, $guard);
        self::assertTrue($guard->acquire());

        try {
            $response = $this->post('{"url":"example.com"}');
        } finally {
            $guard->release();
        }

        self::assertSame(429, $response->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::API_WORKLOAD_REJECTED);

        self::assertCount(1, $records);
        self::assertSame(429, $records[0]['context']['status']);
        self::assertSame('workload_limit_reached', $records[0]['context']['reason']);
        self::assertSame(1, $records[0]['context']['max_concurrent']);
    }

    public function test_transport_failure_is_logged_without_the_raw_target(): void
    {
        $client = new class implements HttpClientInterface {
            public function get(string $url): HttpResponse
            {
                throw new HttpException('super-secret-transport-detail');
            }
        };
        $this->kernel = ApiTestKernel::create(client: $client);

        $response = $this->post('{"url":"https://example.com/path?token=secret"}');

        self::assertSame(200, $response->status());

        $records = $this->kernel->logger->recordsFor(SecurityEventLogger::HTTP_REQUEST_FAILED);

        self::assertCount(1, $records);
        self::assertSame('example.com', $records[0]['context']['target_host']);
        self::assertSame(
            hash('sha256', 'https://example.com'),
            $records[0]['context']['target_hash'],
        );

        $encoded = json_encode($records, JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('https://example.com/path', $encoded);
        self::assertStringNotContainsString('token=secret', $encoded);
        self::assertStringNotContainsString('super-secret-transport-detail', $encoded);
    }

    public function test_successful_requests_do_not_emit_security_events(): void
    {
        $this->kernel = ApiTestKernel::create();

        self::assertSame(200, $this->post('{"url":"example.com"}')->status());
        self::assertSame([], $this->kernel->logger->events());
    }

    /**
     * @param array<string, mixed> $server Additional server overrides.
     */
    private function post(string $body, array $server = []): Response
    {
        self::assertNotNull($this->kernel);

        return $this->kernel->handle(
            $body,
            array_merge(['HTTP_CONTENT_TYPE' => 'application/json'], $server),
        );
    }

    /**
     * @return array<mixed>
     */
    private function payload(Response $response): array
    {
        $payload = json_decode($response->content(), true);

        self::assertIsArray($payload);

        return $payload;
    }
}
