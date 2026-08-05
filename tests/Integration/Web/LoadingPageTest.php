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
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

#[BackupGlobals(true)]
final class LoadingPageTest extends TestCase
{
    public function test_loading_page_renders_loading_flow_for_valid_url(): void
    {
        $kernel = $this->kernel();

        $response = $kernel->handle(
            $this->request('POST', '/loading', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('Analyzing website', $response->content());
        $this->assertStringContainsString('example.com', $response->content());
        $this->assertStringContainsString('data-loading-url="example.com"', $response->content());
        $this->assertStringContainsString('data-loading-invalid="0"', $response->content());
        $this->assertStringContainsString('Preparing detection context...', $response->content());
        $this->assertStringContainsString('Detecting CMS...', $response->content());
        $this->assertStringContainsString('Scanning plugins...', $response->content());
        $this->assertStringContainsString('Generating report...', $response->content());
        $this->assertStringContainsString('role="progressbar"', $response->content());
        $this->assertStringContainsString('Try Again', $response->content());
        $this->assertStringContainsString('Back to Home', $response->content());
        $this->assertStringContainsString('/assets/js/loading.js', $response->content());
    }

    public function test_loading_page_accepts_urls_without_scheme(): void
    {
        $kernel = $this->kernel();

        $response = $kernel->handle(
            $this->request('GET', '/loading', query: ['url' => 'https://example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('data-loading-url="https://example.com"', $response->content());
        $this->assertStringContainsString('data-loading-invalid="0"', $response->content());
    }

    public function test_loading_page_marks_invalid_url(): void
    {
        $kernel = $this->kernel();

        $response = $kernel->handle(
            $this->request('POST', '/loading', post: ['url' => 'not a url!!']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('data-loading-url="not a url!!"', $response->content());
        $this->assertStringContainsString('data-loading-invalid="1"', $response->content());
    }

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $post
     */
    private function request(string $method, string $uri, array $query = [], array $post = []): Request
    {
        $request = new Request($method, $uri, $query, $post);

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
            LoadingController::class,
            static fn (): LoadingController => new LoadingController(),
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
