<?php

declare(strict_types=1);

namespace Tests\Integration\Web;

use App\Core\Application;
use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\View;
use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\SeoController;
use App\Security\CsrfGuard;
use App\Security\CsrfTokenManager;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;
use Tests\Support\CsrfTestSupport;

/**
 * Verifies the security response headers on the public web routes.
 *
 * Every response must carry the baseline security headers — nosniff,
 * Referrer-Policy, X-Frame-Options: DENY, and the restrictive
 * Content-Security-Policy — regardless of the route or content type.
 * Strict-Transport-Security is emitted only when the request is genuinely
 * HTTPS; forwarded protocol headers are trusted only from a configured
 * trusted reverse proxy.
 */
#[BackupGlobals(true)]
final class ResponseSecurityHeadersTest extends TestCase
{
    public function test_html_pages_carry_security_headers(): void
    {
        foreach (['/', '/about', '/loading'] as $uri) {
            $response = $this->kernel()->handle($this->request('GET', $uri));

            self::assertSame(200, $response->status(), "Route {$uri} should respond 200.");
            self::assertBaselineSecurityHeaders($response);
        }
    }

    public function test_seo_artifacts_carry_security_headers(): void
    {
        foreach (['/robots.txt', '/sitemap.xml'] as $uri) {
            $response = $this->kernel()->handle($this->request('GET', $uri));

            self::assertSame(200, $response->status(), "Route {$uri} should respond 200.");
            self::assertBaselineSecurityHeaders($response);
        }
    }

    public function test_content_security_policy_matches_the_documented_policy(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/'));
        $policy = $response->headers()['Content-Security-Policy'];

        self::assertSame(Response::CONTENT_SECURITY_POLICY, $policy);
        self::assertStringNotContainsString('unsafe-inline', $policy);
        self::assertStringNotContainsString('unsafe-eval', $policy);
        self::assertStringNotContainsString('*', $policy);
        self::assertStringContainsString("frame-ancestors 'none'", $policy);
        self::assertStringContainsString(
            "script-src 'self' https://cdn.jsdelivr.net",
            $policy,
        );
        self::assertStringContainsString(
            "connect-src 'self'",
            $policy,
        );
        self::assertStringContainsString(
            "form-action 'self'",
            $policy,
        );
    }

    public function test_x_frame_options_is_deny(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/'));

        self::assertSame('DENY', $response->headers()['X-Frame-Options']);
    }

    public function test_hsts_is_sent_on_https_requests(): void
    {
        $response = $this->kernel()->handle(
            $this->request('GET', '/', server: ['HTTPS' => 'on']),
        );

        self::assertSame(200, $response->status());
        self::assertArrayHasKey('Strict-Transport-Security', $response->headers());
        self::assertSame(
            'max-age=' . Response::HSTS_MAX_AGE,
            $response->headers()['Strict-Transport-Security'],
        );
        self::assertStringNotContainsString(
            'includeSubDomains',
            $response->headers()['Strict-Transport-Security'],
        );
        self::assertStringNotContainsString(
            'preload',
            $response->headers()['Strict-Transport-Security'],
        );
    }

    public function test_hsts_is_not_sent_on_http_requests(): void
    {
        $response = $this->kernel()->handle(
            $this->request('GET', '/', server: ['SERVER_PORT' => 80]),
        );

        self::assertSame(200, $response->status());
        self::assertArrayNotHasKey('Strict-Transport-Security', $response->headers());
    }

    public function test_hsts_is_not_sent_when_the_https_flag_is_off(): void
    {
        $response = $this->kernel()->handle(
            $this->request('GET', '/', server: ['HTTPS' => 'off']),
        );

        self::assertArrayNotHasKey('Strict-Transport-Security', $response->headers());
    }

    public function test_forwarded_proto_does_not_enable_hsts_without_a_trusted_proxy(): void
    {
        $response = $this->kernel()->handle(
            $this->request('GET', '/', server: [
                'REMOTE_ADDR' => '198.51.100.7',
                'HTTP_X_FORWARDED_PROTO' => 'https',
            ]),
        );

        self::assertArrayNotHasKey('Strict-Transport-Security', $response->headers());
    }

    public function test_forwarded_proto_enables_hsts_from_a_trusted_proxy(): void
    {
        $response = $this->kernel()->handle(
            $this->request(
                'GET',
                '/',
                server: [
                    'REMOTE_ADDR' => '203.0.113.9',
                    'HTTP_X_FORWARDED_PROTO' => 'https',
                ],
                trustedProxies: ['203.0.113.9'],
            ),
        );

        self::assertSame(
            'max-age=' . Response::HSTS_MAX_AGE,
            $response->headers()['Strict-Transport-Security'],
        );
    }

    public function test_hsts_applies_to_error_responses_over_https(): void
    {
        $response = $this->kernel()->handle(
            $this->request('GET', '/detect', server: ['HTTPS' => 'on']),
        );

        self::assertSame(404, $response->status());
        self::assertSame(
            'max-age=' . Response::HSTS_MAX_AGE,
            $response->headers()['Strict-Transport-Security'],
        );
    }

    public function test_security_headers_are_not_duplicated_on_error_responses(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/detect'));

        self::assertSame(404, $response->status(), 'GET on /detect must be rejected.');

        $headerNames = implode("\n", array_keys($response->headers()));

        foreach (['X-Content-Type-Options', 'Referrer-Policy', 'X-Frame-Options', 'Content-Security-Policy'] as $name) {
            self::assertSame(1, substr_count($headerNames, $name), "{$name} must appear once.");
        }
    }

    public function test_normal_html_response_is_not_broken(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/'));

        self::assertSame(200, $response->status());
        self::assertStringContainsString('ThemeDetectorTool', $response->content());
        self::assertStringContainsString('Works Across the Web', $response->content());
        self::assertSame('text/html; charset=UTF-8', $response->headers()['Content-Type']);
    }

    private function assertBaselineSecurityHeaders(Response $response): void
    {
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

    /**
     * @param array<string, mixed> $server
     * @param list<string>         $trustedProxies
     */
    private function request(
        string $method,
        string $uri,
        array $server = [],
        array $trustedProxies = [],
    ): Request {
        $container = $GLOBALS['app'] ?? null;
        $post = [];

        if ($container instanceof Container && strtoupper($method) === 'POST') {
            $post['_token'] = $container->get(CsrfTokenManager::class)->token();
        }

        $request = new Request(
            method: $method,
            uri: $uri,
            post: $post,
            server: $server,
            trustedProxies: $trustedProxies,
        );

        if ($container instanceof Container) {
            $container->set(Request::class, $request);
        }

        return $request;
    }

    private function kernel(): Kernel
    {
        $application = new Application();
        $container = $application->container();
        CsrfTestSupport::register($container);

        $container->set(
            View::class,
            static fn (): View => new View(dirname(__DIR__, 3) . '/resources/views'),
        );

        $container->set(
            HomeController::class,
            static fn (): HomeController => new HomeController(),
        );

        $container->set(
            AboutController::class,
            static fn (): AboutController => new AboutController(),
        );

        $container->set(
            LoadingController::class,
            static fn (Container $container): LoadingController => new LoadingController(
                $container->get(CsrfGuard::class),
            ),
        );

        $container->set(
            SeoController::class,
            static fn (): SeoController => new SeoController(),
        );

        $router = new Router();
        $dispatcher = new Dispatcher(container: $container);
        $exceptionHandler = new ExceptionHandler();

        $kernel = new Kernel(
            router: $router,
            dispatcher: $dispatcher,
            exceptionHandler: $exceptionHandler,
        );

        require dirname(__DIR__, 3) . '/routes/web.php';

        $GLOBALS['app'] = $container;

        return $kernel;
    }
}
