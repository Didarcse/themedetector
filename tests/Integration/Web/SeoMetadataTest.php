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
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

/**
 * Verifies that every public page emits SEO metadata for the canonical
 * production origin and never leaks local development domains.
 */
#[BackupGlobals(true)]
final class SeoMetadataTest extends TestCase
{
    private const PRODUCTION_ORIGIN = 'https://themedetectortool.com';

    private const FORBIDDEN_LOCAL = [
        'themedetector.test',
        'localhost',
        '127.0.0.1',
    ];

    public function test_home_page_emits_production_canonical_url(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/'));

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString(
            'rel="canonical" href="' . self::PRODUCTION_ORIGIN . '/"',
            $response->content(),
        );
    }

    public function test_home_page_emits_production_open_graph_url(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/'));

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString(
            'property="og:url" content="' . self::PRODUCTION_ORIGIN . '/"',
            $response->content(),
        );
    }

    public function test_about_page_emits_production_canonical_and_open_graph_url(): void
    {
        $response = $this->kernel()->handle($this->request('GET', '/about'));

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('About ThemeDetectorTool', $response->content());
        $this->assertStringContainsString(
            'rel="canonical" href="' . self::PRODUCTION_ORIGIN . '/about"',
            $response->content(),
        );
        $this->assertStringContainsString(
            'property="og:url" content="' . self::PRODUCTION_ORIGIN . '/about"',
            $response->content(),
        );
    }

    public function test_loading_page_is_noindex_and_has_no_canonical(): void
    {
        $response = $this->kernel()->handle(
            $this->request('POST', '/loading', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('name="robots" content="noindex, nofollow"', $response->content());
        $this->assertStringNotContainsString('rel="canonical"', $response->content());
    }

    public function test_public_pages_never_leak_local_development_domains(): void
    {
        foreach (['/', '/about', '/loading'] as $uri) {
            $response = $this->kernel()->handle($this->request('GET', $uri, query: ['url' => 'example.com']));

            $this->assertSame(200, $response->status());

            foreach (self::FORBIDDEN_LOCAL as $needle) {
                $this->assertStringNotContainsString($needle, $response->content(), sprintf('URI: %s', $uri));
            }
        }
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
            AboutController::class,
            static fn (): AboutController => new AboutController(),
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
