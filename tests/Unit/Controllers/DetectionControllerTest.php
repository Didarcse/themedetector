<?php

declare(strict_types=1);

namespace Tests\Unit\Controllers;

use App\Core\Response;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

/**
 * Unit tests for the DetectionController web rate-limiting boundary.
 *
 * The DetectionController orchestrates DetectionService, which is a final
 * concrete service wired against a WebsiteReportAnalyzer, so the
 * controller-level contract (one detection per allowed request, zero
 * detection when denied) is asserted through the offline HTTP spy: an
 * allowed request fetches the target homepage exactly once, a denied
 * request fetches nothing at all.
 */
#[BackupGlobals(true)]
final class DetectionControllerTest extends TestCase
{
    private const NOW = 1_700_000_000;

    private const STATIC_HTML = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Static Site</title>
</head>
<body>
    <h1>Static</h1>
</body>
</html>
HTML;

    private ?ApiTestKernel $kernel = null;

    protected function tearDown(): void
    {
        if ($this->kernel !== null) {
            $this->kernel->cleanup();
        }

        $this->kernel = null;
    }

    public function test_allowed_request_calls_detection_exactly_once(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 5,
            webWindowSeconds: 3600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        $response = $this->detect('203.0.113.10');

        self::assertSame(200, $response->status());
        self::assertSame(['https://example.com'], $this->kernel->client->requestedUrls());
    }

    public function test_denied_request_does_not_call_detection(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        self::assertSame(200, $this->detect('203.0.113.11')->status());
        self::assertSame(['https://example.com'], $this->kernel->client->requestedUrls());

        $denied = $this->detect('203.0.113.11');

        self::assertSame(429, $denied->status());
        self::assertSame(['https://example.com'], $this->kernel->client->requestedUrls());
    }

    public function test_remote_addr_is_used_as_the_identifier(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        self::assertSame(200, $this->detect('203.0.113.12')->status());

        $denied = $this->detect('203.0.113.12');
        self::assertSame(429, $denied->status());

        $other = $this->detect('203.0.113.99');
        self::assertSame(200, $other->status());
    }

    public function test_x_forwarded_for_cannot_override_remote_addr(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        $base = [
            'REMOTE_ADDR' => '203.0.113.13',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.1',
        ];

        self::assertSame(200, $this->detectServer($base)->status());

        $spoofed = $this->detectServer([
            'REMOTE_ADDR' => '203.0.113.13',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.2',
        ]);
        self::assertSame(429, $spoofed->status());

        $other = $this->detectServer([
            'REMOTE_ADDR' => '203.0.113.200',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.1',
        ]);
        self::assertSame(200, $other->status());
    }

    public function test_missing_remote_addr_uses_the_safe_fallback(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        self::assertSame(200, $this->detectServer([])->status());

        $denied = $this->detectServer([]);
        self::assertSame(429, $denied->status());
    }

    public function test_denied_response_has_http_429_and_retry_after(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 600,
            now: self::NOW,
            homepageHtml: self::STATIC_HTML,
            stylesheetCss: '',
        );

        self::assertSame(200, $this->detect('203.0.113.14')->status());

        $denied = $this->detect('203.0.113.14');

        self::assertSame(429, $denied->status());
        self::assertArrayHasKey('Retry-After', $denied->headers());

        $retryAfter = $denied->headers()['Retry-After'];
        self::assertGreaterThan(0, (int) $retryAfter);

        self::assertStringContainsString('Too many requests', $denied->content());
        self::assertStringNotContainsString('Detection Report', $denied->content());
    }

    /**
     * @param array<string, mixed> $server
     */
    private function detectServer(array $server): Response
    {
        self::assertNotNull($this->kernel);

        return $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com'], $server);
    }

    private function detect(string $ip): Response
    {
        return $this->detectServer(['REMOTE_ADDR' => $ip]);
    }
}
