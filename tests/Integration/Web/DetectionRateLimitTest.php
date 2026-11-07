<?php

declare(strict_types=1);

namespace Tests\Integration\Web;

use App\Core\Response;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

/**
 * End-to-end integration tests for the web `POST /detect` rate limit.
 *
 * Every request shares the same kernel, storage, and client, so a single
 * IP consuming the whole budget proves that detection is not executed for
 * the denied request and that the fixed-window counter is respected across
 * consecutive requests.
 */
#[BackupGlobals(true)]
final class DetectionRateLimitTest extends TestCase
{
    private const NOW = 1_700_000_000;

    private ?ApiTestKernel $kernel = null;

    protected function tearDown(): void
    {
        if ($this->kernel !== null) {
            $this->kernel->cleanup();
        }

        $this->kernel = null;
    }

    public function test_requests_below_the_limit_execute_normally(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 3,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $server = ['REMOTE_ADDR' => '203.0.113.80'];

        self::assertSame(200, $this->detect($server)->status());
        self::assertSame(200, $this->detect($server)->status());

        $third = $this->detect($server);
        self::assertSame(200, $third->status());
        self::assertArrayNotHasKey('Retry-After', $third->headers());
    }

    public function test_first_request_beyond_the_limit_returns_429(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 2,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $server = ['REMOTE_ADDR' => '203.0.113.81'];

        self::assertSame(200, $this->detect($server)->status());
        self::assertSame(200, $this->detect($server)->status());

        self::assertSame(429, $this->detect($server)->status());
    }

    public function test_rate_limited_request_does_not_trigger_detection_work(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $server = ['REMOTE_ADDR' => '203.0.113.82'];

        self::assertSame(200, $this->detect($server)->status());
        self::assertNotEmpty($this->kernel->client->requestedUrls());

        $before = count($this->kernel->client->requestedUrls());

        $denied = $this->detect($server);
        self::assertSame(429, $denied->status());
        self::assertSame($before, count($this->kernel->client->requestedUrls()));
    }

    public function test_retry_after_is_present_and_positive_on_429(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 600,
            now: self::NOW,
        );

        $server = ['REMOTE_ADDR' => '203.0.113.83'];

        self::assertSame(200, $this->detect($server)->status());

        $denied = $this->detect($server);
        self::assertSame(429, $denied->status());
        self::assertArrayHasKey('Retry-After', $denied->headers());

        $retryAfter = $denied->headers()['Retry-After'];
        self::assertMatchesRegularExpression('/^[1-9][0-9]*$/', $retryAfter);
    }

    public function test_different_ip_has_an_independent_rate_limit_bucket(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $other = ['REMOTE_ADDR' => '203.0.113.84'];

        self::assertSame(200, $this->detect($other)->status());
        self::assertSame(429, $this->detect($other)->status());

        self::assertSame(200, $this->detect(['REMOTE_ADDR' => '203.0.113.85'])->status());
    }

    public function test_web_and_api_rate_limit_budgets_are_isolated(): void
    {
        $this->kernel = ApiTestKernel::create(
            anonymousLimit: 2,
            windowSeconds: 3600,
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $webServer = ['REMOTE_ADDR' => '203.0.113.88'];
        self::assertSame(200, $this->detect($webServer)->status());
        self::assertSame(429, $this->detect($webServer)->status());

        $apiServer = ['REMOTE_ADDR' => '203.0.113.89'];
        self::assertSame(200, $this->apiDetect($apiServer)->status());
        self::assertSame(200, $this->apiDetect($apiServer)->status());
        self::assertSame(429, $this->apiDetect($apiServer)->status());

        $sharedServer = ['REMOTE_ADDR' => '203.0.113.90'];
        self::assertSame(200, $this->apiDetect($sharedServer)->status());
        self::assertSame(200, $this->apiDetect($sharedServer)->status());
        self::assertSame(200, $this->detect($sharedServer)->status());
        self::assertSame(429, $this->detect($sharedServer)->status());
    }

    public function test_spoofed_x_forwarded_for_does_not_bypass_the_limit(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $spoofed = $this->detect([
            'REMOTE_ADDR' => '203.0.113.86',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.9',
        ]);
        self::assertSame(200, $spoofed->status());

        $secondSpoof = $this->detect([
            'REMOTE_ADDR' => '203.0.113.86',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.10',
        ]);
        self::assertSame(429, $secondSpoof->status(), 'X-Forwarded-For must not change the identity.');
    }

    public function test_requests_without_remote_addr_share_the_safe_fallback_identity(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        self::assertSame(200, $this->detect([])->status());
        self::assertSame(429, $this->detect([])->status());
    }

    public function test_allowed_response_still_renders_the_report_page(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 3,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $response = $this->detect(['REMOTE_ADDR' => '203.0.113.87']);

        self::assertSame(200, $response->status());
        self::assertStringContainsString('Detection Report', $response->content());
    }

    /**
     * @param array<string, mixed> $server
     */
    private function detect(array $server): Response
    {
        self::assertNotNull($this->kernel);

        return $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com'], $server);
    }

    /**
     * @param array<string, mixed> $server
     */
    private function apiDetect(array $server): Response
    {
        self::assertNotNull($this->kernel);

        return $this->kernel->handle(
            '{"url":"example.com"}',
            $server + ['HTTP_CONTENT_TYPE' => 'application/json'],
        );
    }
}
