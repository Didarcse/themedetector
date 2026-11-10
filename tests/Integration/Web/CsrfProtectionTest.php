<?php

declare(strict_types=1);

namespace Tests\Integration\Web;

use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

/**
 * End-to-end CSRF protection tests for the public web routes.
 */
#[BackupGlobals(true)]
final class CsrfProtectionTest extends TestCase
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

    public function test_home_page_embeds_the_session_csrf_token(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handleRequest('GET', '/');

        self::assertSame(200, $response->status());
        self::assertStringContainsString('name="_token"', $response->content());
        self::assertStringContainsString(
            'value="' . $this->kernel->csrfToken() . '"',
            $response->content(),
        );
    }

    public function test_post_loading_accepts_a_valid_token(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handleRequest('POST', '/loading', ['url' => 'example.com']);

        self::assertSame(200, $response->status());
        self::assertStringContainsString('data-loading-auto-start="1"', $response->content());
    }

    public function test_post_loading_rejects_a_missing_token(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handleRequest(
            'POST',
            '/loading',
            ['url' => 'example.com'],
            [],
            false,
        );

        self::assertSame(403, $response->status());
        self::assertSame('Forbidden', $response->content());
        self::assertSame('no-store', $response->headers()['Cache-Control']);
    }

    public function test_post_loading_rejects_an_invalid_token(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handleRequest(
            'POST',
            '/loading',
            ['url' => 'example.com', '_token' => 'invalid-token'],
        );

        self::assertSame(403, $response->status());
    }

    public function test_post_detect_rejects_missing_and_invalid_tokens_without_spending_budget(): void
    {
        $this->kernel = ApiTestKernel::create(
            webLimit: 1,
            webWindowSeconds: 3600,
            now: self::NOW,
        );

        $missing = $this->kernel->handleRequest(
            'POST',
            '/detect',
            ['url' => 'example.com'],
            [],
            false,
        );
        $invalid = $this->kernel->handleRequest(
            'POST',
            '/detect',
            ['url' => 'example.com', '_token' => 'invalid-token'],
        );

        self::assertSame(403, $missing->status());
        self::assertSame(403, $invalid->status());
        self::assertSame([], $this->kernel->client->requestedUrls());

        $allowed = $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']);

        self::assertSame(200, $allowed->status());
        self::assertSame(
            [
                'https://example.com',
                'https://example.com/wp-content/themes/twentytwentyfive/style.css',
            ],
            $this->kernel->client->requestedUrls(),
        );

        $limited = $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']);

        self::assertSame(429, $limited->status());
    }

    public function test_expired_token_is_rejected_and_a_fresh_token_is_accepted(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);
        $expired = $this->kernel->csrfToken();
        $this->kernel->csrfTokens->rotate();

        $rejected = $this->kernel->handleRequest(
            'POST',
            '/detect',
            ['url' => 'example.com', '_token' => $expired],
        );

        self::assertSame(403, $rejected->status());

        $accepted = $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']);

        self::assertSame(200, $accepted->status());
    }

    public function test_get_loading_renders_a_manual_start_action_without_detecting(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handleRequest(
            'GET',
            '/loading',
            [],
            [],
            false,
            ['url' => 'example.com'],
        );

        self::assertSame(200, $response->status());
        self::assertStringContainsString('data-loading-auto-start="0"', $response->content());
        self::assertStringContainsString('Start Detection', $response->content());
        self::assertStringContainsString('name="_token"', $response->content());
        self::assertSame([], $this->kernel->client->requestedUrls());
    }

    public function test_manual_start_posts_to_the_protected_loading_route(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $manual = $this->kernel->handleRequest(
            'GET',
            '/loading',
            [],
            [],
            false,
            ['url' => 'example.com'],
        );

        self::assertStringContainsString('<form action="/loading" method="post"', $manual->content());
        self::assertStringContainsString('name="url" value="example.com"', $manual->content());
        self::assertStringContainsString('name="_token"', $manual->content());

        $auto = $this->kernel->handleRequest('POST', '/loading', ['url' => 'example.com']);

        self::assertSame(200, $auto->status());
        self::assertStringContainsString('data-loading-auto-start="1"', $auto->content());
    }

    public function test_loading_script_sends_the_token_and_respects_auto_start(): void
    {
        $script = file_get_contents(
            dirname(__DIR__, 3) . '/public/assets/js/loading.js',
        );

        self::assertIsString($script);
        self::assertStringContainsString("params.set('_token', token)", $script);
        self::assertStringContainsString('data-loading-auto-start', $script);
        self::assertStringContainsString('response.status === 403', $script);
    }

    public function test_html_responses_are_not_cacheable(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $responses = [
            $this->kernel->handleRequest('GET', '/'),
            $this->kernel->handleRequest(
                'GET',
                '/loading',
                [],
                [],
                false,
                ['url' => 'example.com'],
            ),
            $this->kernel->handleRequest('POST', '/detect', ['url' => 'example.com']),
        ];

        foreach ($responses as $response) {
            self::assertSame('no-store', $response->headers()['Cache-Control']);
            self::assertSame('Cookie', $response->headers()['Vary']);
        }
    }

    public function test_api_json_response_is_not_given_html_cache_headers(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handle(
            '{"url":"example.com"}',
            ['HTTP_CONTENT_TYPE' => 'application/json'],
        );

        self::assertSame(200, $response->status());
        self::assertArrayNotHasKey('Cache-Control', $response->headers());
        self::assertArrayNotHasKey('Vary', $response->headers());
    }

    public function test_api_endpoint_remains_csrf_exempt(): void
    {
        $this->kernel = ApiTestKernel::create(now: self::NOW);

        $response = $this->kernel->handle(
            '{"url":"example.com"}',
            ['HTTP_CONTENT_TYPE' => 'application/json'],
        );

        self::assertSame(200, $response->status());
        self::assertStringContainsString('"success":true', $response->content());
    }
}
