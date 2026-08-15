<?php

declare(strict_types=1);

namespace Tests\Integration\Web;

use App\Core\Application;
use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Request;
use App\Core\Router;
use App\Core\View;
use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\SeoController;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

/**
 * Verifies the security response headers on the public web routes.
 *
 * Every response must carry X-Content-Type-Options: nosniff and
 * Referrer-Policy: strict-origin-when-cross-origin regardless of the route
 * or content type, so browsers never guess content types and referrer
 * information is kept conservative across origins.
 */
#[BackupGlobals(true)]
final class ResponseSecurityHeadersTest extends TestCase
{
    public function test_html_pages_carry_security_headers(): void
    {
        foreach (['/', '/about', '/loading'] as $uri) {
            $response = $this->kernel()->handle($this->request('GET', $uri));

            self::assertSame(200, $response->status(), "Route {$uri} should respond 200.");
            self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
            self::assertSame(
                'strict-origin-when-cross-origin',
                $response->headers()['Referrer-Policy'],
            );
        }
    }

    public function test_seo_artifacts_carry_security_headers(): void
    {
        foreach (['/robots.txt', '/sitemap.xml'] as $uri) {
            $response = $this->kernel()->handle($this->request('GET', $uri));

            self::assertSame(200, $response->status(), "Route {$uri} should respond 200.");
            self::assertSame('nosniff', $response->headers()['X-Content-Type-Options']);
            self::assertSame(
                'strict-origin-when-cross-origin',
                $response->headers()['Referrer-Policy'],
            );
        }
    }

    public function test_security_headers_are_not_duplicated_on_error_responses(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/detect'));

        self::assertSame(404, $response->status(), 'GET on /detect must be rejected.');

        $headers = $response->headers();

        self::assertSame(1, substr_count(implode("\n", array_keys($headers)), 'X-Content-Type-Options'));
        self::assertSame(1, substr_count(implode("\n", array_keys($headers)), 'Referrer-Policy'));
    }

    private function request(string $method, string $uri): Request
    {
        $request = new Request($method, $uri, [], []);

        $container = $GLOBALS['app'] ?? null;

        if ($container instanceof Container) {
            $container->set(Request::class, $request);
        }

        return $request;
    }

    private function kernel(): Kernel
    {
        $application = new Application();
        $container = $application->container();

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
            static fn (): LoadingController => new LoadingController(),
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
