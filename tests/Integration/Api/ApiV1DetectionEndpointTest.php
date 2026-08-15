<?php

declare(strict_types=1);

namespace Tests\Integration\Api;

use App\Core\Response;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

/**
 * End-to-end integration tests for POST /api/v1/detect.
 *
 * Exercises the full request boundary through a production-shaped kernel
 * with offline HTTP clients and a disposable storage directory: successful
 * detections, response caching, request validation errors, authentication,
 * rate limiting, transport failures, and the co-existence of the public API
 * with the existing web /detect route.
 *
 * Design philosophy:
 *
 * - Real assembly: the kernel, container, providers, routes, and controller
 *   are wired exactly like production.
 * - Offline: no request ever reaches the network.
 * - Deterministic: fixed rate-limit windows and clocks.
 */
#[BackupGlobals(true)]
final class ApiV1DetectionEndpointTest extends TestCase
{
    private ?ApiTestKernel $kernel = null;

    protected function tearDown(): void
    {
        if ($this->kernel !== null) {
            $this->kernel->cleanup();
            $this->kernel = null;
        }
    }

    public function test_detects_a_wordpress_site(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->post('{"url":"example.com"}');

        self::assertSame(200, $response->status());
        self::assertSame('application/json; charset=UTF-8', $response->headers()['Content-Type'] ?? null);

        $payload = $this->payload($response);

        self::assertSame('v1', $payload['schemaVersion']);
        self::assertIsString($payload['requestId']);
        self::assertMatchesRegularExpression('/^[0-9a-f]{32}$/', $payload['requestId']);
        self::assertTrue($payload['success']);
        self::assertSame([], $payload['errors']);

        $data = $payload['data'];
        self::assertIsArray($data);
        self::assertIsInt($data['detectionTimeMs']);
        self::assertGreaterThanOrEqual(0, $data['detectionTimeMs']);

        unset($data['detectionTimeMs']);

        self::assertSame([
            'website' => [
                'url' => 'https://example.com',
                'finalUrl' => 'https://example.com',
                'statusCode' => 200,
            ],
            'cms' => 'WordPress',
            'cmsConfidence' => 55,
            'theme' => [
                'name' => 'Twenty Twenty-Five',
                'version' => '1.0',
                'author' => 'the WordPress team',
            ],
            'plugins' => ['contact-form-7'],
            'technologies' => [
                ['name' => 'WordPress', 'confidence' => 55],
            ],
            'detectionConfidence' => 55,
        ], $data);
    }

    public function test_technologies_include_technology_detection_results(): void
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example Blog</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.example.com/cdn-cgi/scripts/main.js"></script>
</head>
<body>
    <h1>Example Blog</h1>
</body>
</html>
HTML;

        $this->kernel = ApiTestKernel::create(homepageHtml: $html, stylesheetCss: '');

        $response = $this->post('{"url":"example.com"}');

        self::assertSame(200, $response->status());

        $data = $this->payload($response)['data'];
        self::assertIsArray($data);

        $technologies = $data['technologies'];
        self::assertIsArray($technologies);
        self::assertSame([
            ['name' => 'jQuery', 'confidence' => 80],
            ['name' => 'Cloudflare', 'confidence' => 70],
        ], $technologies);

        self::assertArrayNotHasKey('category', $technologies[0]);
        self::assertArrayNotHasKey('version', $technologies[0]);
        self::assertArrayNotHasKey('vendor', $technologies[0]);
    }

    public function test_repeated_requests_are_served_from_cache(): void
    {
        $this->kernel = ApiTestKernel::create();

        $first = $this->payload($this->post('{"url":"https://example.com"}'));
        $requestsAfterFirst = count($this->kernel->client->requestedUrls());

        self::assertTrue($first['success']);

        $second = $this->payload($this->post('{"url":"https://example.com"}'));

        self::assertTrue($second['success']);
        self::assertSame($first['data'], $second['data']);
        self::assertNotSame($first['requestId'], $second['requestId']);

        self::assertSame($requestsAfterFirst, count($this->kernel->client->requestedUrls()));
    }

    public function test_different_urls_are_cached_independently(): void
    {
        $this->kernel = ApiTestKernel::create();

        $this->post('{"url":"https://example.com"}');
        $requestsAfterFirst = count($this->kernel->client->requestedUrls());

        $this->post('{"url":"https://other.example.com"}');

        self::assertGreaterThan($requestsAfterFirst, count($this->kernel->client->requestedUrls()));
    }

    public function test_malformed_json_returns_400(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->post('{not json');

        self::assertSame(400, $response->status());

        $payload = $this->payload($response);
        self::assertFalse($payload['success']);
        self::assertNull($payload['data']);
        $errors = $payload['errors'];
        self::assertIsArray($errors);
        self::assertSame([['code' => 'invalid_json', 'message' => 'The request body is not valid JSON.']], $errors);
    }

    public function test_wrong_content_type_returns_415(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->post('{"url":"example.com"}', ['HTTP_CONTENT_TYPE' => 'text/plain']);

        self::assertSame(415, $response->status());

        $payload = $this->payload($response);
        self::assertSame('unsupported_media_type', $this->errorCode($payload));
    }

    public function test_missing_content_type_returns_415(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->kernel->handle('{"url":"example.com"}');

        self::assertSame(415, $response->status());

        $payload = $this->payload($response);
        self::assertSame('unsupported_media_type', $this->errorCode($payload));
    }

    public function test_validation_errors_return_422(): void
    {
        $this->kernel = ApiTestKernel::create();

        $cases = [
            ['{}', ['body_not_object']],
            ['{"foo":"bar"}', ['unknown_field', 'url_required']],
            ['{"url":42}', ['url_invalid_type']],
            ['{"url":"   "}', ['url_empty']],
            ['{"url":"ht!tp://example.com"}', ['url_invalid_format']],
            ['{"url":"https://example.com","extra":1}', ['unknown_field']],
            ['{"url":"ftp://example.com"}', ['url_invalid_format']],
            ['{"url":"file:///etc/passwd"}', ['url_invalid_format']],
            ['{"url":"gopher://example.com"}', ['url_invalid_format']],
        ];

        foreach ($cases as [$body, $expectedCodes]) {
            $response = $this->post($body);

            self::assertSame(422, $response->status(), 'body: ' . $body);

            $payload = $this->payload($response);
            self::assertFalse($payload['success'], 'body: ' . $body);
            self::assertNull($payload['data']);

            $errors = $payload['errors'];
            self::assertIsArray($errors);

            $codes = [];

            foreach ($errors as $error) {
                self::assertIsArray($error);
                $codes[] = $error['code'];
            }

            self::assertSame($expectedCodes, $codes, 'body: ' . $body);
        }
    }

    public function test_anonymous_requests_are_rejected_when_keys_are_configured(): void
    {
        $this->kernel = ApiTestKernel::create(apiKeys: ['secret-key']);

        $response = $this->post('{"url":"example.com"}');

        self::assertSame(401, $response->status());
        self::assertSame('unauthorized', $this->errorCode($this->payload($response)));
    }

    public function test_invalid_authorization_headers_return_401(): void
    {
        $this->kernel = ApiTestKernel::create(apiKeys: ['secret-key']);

        $cases = [
            ['HTTP_AUTHORIZATION' => 'Bearer wrong-key'],
            ['HTTP_AUTHORIZATION' => 'Basic abcdef'],
            ['HTTP_AUTHORIZATION' => 'Bearer'],
        ];

        foreach ($cases as $server) {
            $response = $this->post('{"url":"example.com"}', $server);

            self::assertSame(401, $response->status(), 'server: ' . var_export($server, true));
            self::assertSame('unauthorized', $this->errorCode($this->payload($response)));
        }
    }

    public function test_valid_bearer_key_authenticates_the_request(): void
    {
        $this->kernel = ApiTestKernel::create(apiKeys: ['secret-key']);

        $response = $this->post('{"url":"example.com"}', ['HTTP_AUTHORIZATION' => 'Bearer secret-key']);

        self::assertSame(200, $response->status());
        self::assertTrue($this->payload($response)['success']);
    }

    public function test_anonymous_requests_are_rate_limited_per_ip(): void
    {
        $this->kernel = ApiTestKernel::create(
            anonymousLimit: 2,
            windowSeconds: 3600,
            now: 1_700_000_000,
        );

        $server = ['REMOTE_ADDR' => '203.0.113.10'];

        $first = $this->post('{"url":"example.com"}', $server);
        self::assertSame(200, $first->status());
        self::assertSame('2', $first->headers()['X-RateLimit-Limit'] ?? null);
        self::assertSame('1', $first->headers()['X-RateLimit-Remaining'] ?? null);
        self::assertArrayNotHasKey('Retry-After', $first->headers());

        $this->post('{"url":"example.com"}', $server);

        $denied = $this->post('{"url":"example.com"}', $server);
        self::assertSame(429, $denied->status());
        self::assertSame('0', $denied->headers()['X-RateLimit-Remaining'] ?? null);
        self::assertArrayHasKey('Retry-After', $denied->headers());

        $retryAfter = (int) $denied->headers()['Retry-After'];
        self::assertGreaterThan(0, $retryAfter);

        self::assertSame('rate_limited', $this->errorCode($this->payload($denied)));
    }

    public function test_rate_limits_are_isolated_by_client_ip(): void
    {
        $this->kernel = ApiTestKernel::create(
            anonymousLimit: 1,
            windowSeconds: 3600,
            now: 1_700_000_000,
        );

        $this->post('{"url":"example.com"}', ['REMOTE_ADDR' => '203.0.113.10']);
        $denied = $this->post('{"url":"example.com"}', ['REMOTE_ADDR' => '203.0.113.10']);

        self::assertSame(429, $denied->status());

        $other = $this->post('{"url":"example.com"}', ['REMOTE_ADDR' => '198.51.100.20']);

        self::assertSame(200, $other->status());
    }

    public function test_keyed_requests_are_rate_limited_per_key(): void
    {
        $this->kernel = ApiTestKernel::create(
            apiKeys: ['key-a', 'key-b'],
            keyedLimit: 1,
            windowSeconds: 3600,
            now: 1_700_000_000,
        );

        $first = $this->post('{"url":"example.com"}', ['HTTP_AUTHORIZATION' => 'Bearer key-a']);
        self::assertSame(200, $first->status());

        $denied = $this->post('{"url":"example.com"}', ['HTTP_AUTHORIZATION' => 'Bearer key-a']);
        self::assertSame(429, $denied->status());

        $otherKey = $this->post('{"url":"example.com"}', ['HTTP_AUTHORIZATION' => 'Bearer key-b']);
        self::assertSame(200, $otherKey->status());
    }

    public function test_transport_failures_return_200_with_the_error_contract(): void
    {
        $this->kernel = ApiTestKernel::create(client: $this->throwingClient());

        $response = $this->post('{"url":"https://down.example.com"}');

        self::assertSame(200, $response->status());

        $payload = $this->payload($response);
        self::assertFalse($payload['success']);
        self::assertNull($payload['data']);

        $errors = $payload['errors'];
        self::assertIsArray($errors);

        self::assertSame([
            'code' => 'transport_failure',
            'message' => 'The website could not be reached. Please check the URL and try again.',
        ], $errors[0]);
    }

    public function test_api_errors_never_expose_internal_fields(): void
    {
        $this->kernel = ApiTestKernel::create(client: $this->throwingClient());

        $payload = $this->payload($this->post('{"url":"https://down.example.com"}'));

        $rendered = json_encode($payload);
        self::assertIsString($rendered);
        self::assertStringNotContainsString('source', $rendered);
        self::assertStringNotContainsString('context', $rendered);
        self::assertStringNotContainsString('WebsiteReportAnalyzer', $rendered);
    }

    public function test_api_responses_carry_security_headers(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->post('{"url":"example.com"}');

        self::assertSame(200, $response->status());
        self::assertSame('application/json; charset=UTF-8', $response->headers()['Content-Type'] ?? null);
        self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
        self::assertSame(
            'strict-origin-when-cross-origin',
            $response->headers()['Referrer-Policy'],
        );
    }

    public function test_response_body_size_limit_failures_never_leak_to_api_clients(): void
    {
        $this->kernel = ApiTestKernel::create(
            client: $this->throwingClient('Response body exceeds the maximum allowed size.'),
        );

        $response = $this->post('{"url":"https://huge.example.com"}');

        self::assertSame(200, $response->status());

        $payload = $this->payload($response);
        self::assertFalse($payload['success']);

        $rendered = json_encode($payload);
        self::assertIsString($rendered);
        self::assertStringNotContainsString('maximum allowed size', $rendered);

        $errors = $payload['errors'];

        self::assertIsArray($errors);
        self::assertSame([
            'code' => 'transport_failure',
            'message' => 'The website could not be reached. Please check the URL and try again.',
        ], $errors[0]);
    }

    public function test_the_web_detect_route_still_works_alongside_the_api(): void
    {
        $this->kernel = ApiTestKernel::create();

        $home = $this->kernel->handleRequest('GET', '/');
        self::assertSame(200, $home->status());

        $detect = $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']);
        self::assertSame(200, $detect->status());
        self::assertStringContainsString('Detection Report', $detect->content());
        self::assertStringContainsString('WordPress', $detect->content());

        $api = $this->kernel->handle('{"url":"example.com"}', ['HTTP_CONTENT_TYPE' => 'application/json']);
        self::assertSame(200, $api->status());
        self::assertTrue($this->payload($api)['success']);
    }

    public function test_get_requests_against_the_api_route_return_404(): void
    {
        $this->kernel = ApiTestKernel::create();

        $response = $this->kernel->handleRequest('GET', '/api/v1/detect');

        self::assertSame(404, $response->status());
    }

    /**
     * @param array<string, mixed> $server The additional server overrides.
     */
    private function post(string $body, array $server = []): Response
    {
        $server = array_merge(['HTTP_CONTENT_TYPE' => 'application/json'], $server);

        self::assertNotNull($this->kernel);

        return $this->kernel->handle($body, $server);
    }

    /**
     * @return array<mixed>
     */
    private function payload(Response $response): array
    {
        $payload = json_decode($response->content(), true);

        self::assertIsArray($payload, 'response is not valid JSON');

        return $payload;
    }

    /**
     * Return the error code of the first envelope error.
     *
     * @param array<mixed> $payload The decoded envelope.
     */
    private function errorCode(array $payload): string
    {
        $errors = $payload['errors'];
        self::assertIsArray($errors);

        $error = $errors[0];
        self::assertIsArray($error);

        $code = $error['code'];
        self::assertIsString($code);

        return $code;
    }

    private function throwingClient(string $message = 'host unreachable'): HttpClientInterface
    {
        return new class ($message) implements HttpClientInterface {
            public function __construct(private readonly string $message)
            {
            }

            public function get(string $url): HttpResponse
            {
                throw new HttpException($this->message);
            }
        };
    }
}
