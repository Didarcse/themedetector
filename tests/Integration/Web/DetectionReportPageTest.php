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
use App\Controllers\DetectionController;
use App\Controllers\HomeController;
use App\Controllers\SeoController;
use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\DetectorRegistryFactory;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginRegistry;
use App\Modules\PluginDetection\PluginRegistryFactory;
use App\Modules\ThemeExtraction\Providers\ThemeExtractionServiceProvider;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use App\Services\DetectionService;
use App\Services\WebsiteReportAnalyzer;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

#[BackupGlobals(true)]
final class DetectionReportPageTest extends TestCase
{
    private const HOMEPAGE_HTML = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example Blog</title>
    <meta name="generator" content="WordPress 6.7.1">
    <link rel="stylesheet" href="/wp-content/themes/twentytwentyfive/style.css">
    <script src="/wp-content/plugins/contact-form-7/includes/js/index.js"></script>
</head>
<body>
    <h1>Example Blog</h1>
</body>
</html>
HTML;

    private const STYLESHEET_CSS = <<<'CSS'
/*
Theme Name: Twenty Twenty-Five
Theme URI: https://wordpress.org/themes/twentytwentyfive/
Author: the WordPress team
Version: 1.0
License: GPL-2.0-or-later
Text Domain: twentytwentyfive
*/
CSS;

    private const NO_DETECTION_HTML = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Static Site</title>
</head>
<body>
    <h1>Hello</h1>
</body>
</html>
HTML;

    private const MINIMAL_THEME_HTML = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example Blog</title>
    <meta name="generator" content="WordPress 6.7.1">
    <link rel="stylesheet" href="/wp-content/themes/minimal/style.css">
</head>
<body>
    <h1>Example Blog</h1>
</body>
</html>
HTML;

    private const MINIMAL_THEME_CSS = <<<'CSS'
/*
Theme Name: Minimal Theme
*/
CSS;

    public function test_home_page_renders_search_form(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $response = $kernel->handle(
            $this->request('GET', '/'),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('Theme &amp; Plugins Instantly', $response->content());
        $this->assertStringContainsString('Website URL', $response->content());
        $this->assertStringContainsString('<form', $response->content());
        $this->assertStringContainsString('method="post"', $response->content());
    }

    public function test_report_page_renders_detection_report(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $response = $kernel->handle(
            $this->request('POST', '/detect', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('Detection Report', $response->content());
        $this->assertStringContainsString('example.com', $response->content());
        $this->assertStringContainsString('WordPress', $response->content());
        $this->assertStringContainsString('Twenty Twenty-Five', $response->content());
        $this->assertStringContainsString('contact-form-7', $response->content());
        $this->assertStringContainsString('Detection Time', $response->content());
        $this->assertStringContainsString('55%', $response->content());
        $this->assertStringContainsString('Website Summary', $response->content());
        $this->assertStringContainsString('Detection Score', $response->content());
        $this->assertStringContainsString('CMS Information', $response->content());
        $this->assertStringContainsString('Theme Information', $response->content());
        $this->assertStringContainsString('Theme Metadata', $response->content());
        $this->assertStringContainsString('Detected Plugins', $response->content());
        $this->assertStringContainsString('Detect Another Website', $response->content());
        $this->assertStringContainsString('Copy Report', $response->content());
    }

    public function test_report_page_shows_error_for_invalid_url(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $response = $kernel->handle(
            $this->request('POST', '/detect', post: ['url' => 'not a url!!']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('Detection failed', $response->content());
        $this->assertStringContainsString('valid website URL', $response->content());
    }

    public function test_report_page_without_detections_hides_theme_metadata_and_note(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::NO_DETECTION_HTML, ''));

        $response = $kernel->handle(
            $this->request('POST', '/detect', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('No CMS detected', $response->content());
        $this->assertStringContainsString('No theme detected', $response->content());
        $this->assertStringContainsString('No plugins detected', $response->content());
        $this->assertStringNotContainsString('Theme Metadata', $response->content());
        $this->assertStringNotContainsString('technologies detected', $response->content());
    }

    public function test_report_page_with_minimal_theme_omits_unknown_rows_and_empty_metadata(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::MINIMAL_THEME_HTML, self::MINIMAL_THEME_CSS));

        $response = $kernel->handle(
            $this->request('POST', '/detect', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('WordPress', $response->content());
        $this->assertStringContainsString('Minimal Theme', $response->content());
        $this->assertStringNotContainsString('Theme Metadata', $response->content());
        $this->assertStringNotContainsString('Unknown', $response->content());
    }

    public function test_report_page_is_noindex_and_has_no_canonical(): void
    {
        $kernel = $this->kernel(new PageFakeHttpClient(self::HOMEPAGE_HTML, self::STYLESHEET_CSS));

        $response = $kernel->handle(
            $this->request('POST', '/detect', post: ['url' => 'example.com']),
        );

        $this->assertSame(200, $response->status());
        $this->assertStringContainsString('name="robots" content="noindex, nofollow"', $response->content());
        $this->assertStringNotContainsString('rel="canonical"', $response->content());
        $this->assertStringNotContainsString('themedetector.test', $response->content());
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

    private function kernel(HttpClientInterface $client): Kernel
    {
        $application = new Application();
        $container = $application->container();

        $container->set(
            HttpClientInterface::class,
            static fn (): HttpClientInterface => $client,
        );

        $container->set(
            HttpClient::class,
            static fn (): HttpClient => new HttpClient(),
        );

        $container->set(
            DetectorRegistry::class,
            static fn (Container $container): DetectorRegistry => (new DetectorRegistryFactory())->create($container),
        );

        $container->set(
            ThemeExtractorRegistry::class,
            static fn (Container $container): ThemeExtractorRegistry =>
                (new ThemeExtractorRegistryFactory())->create($container),
        );

        $container->set(
            PluginRegistry::class,
            static fn (Container $container): PluginRegistry => (new PluginRegistryFactory())->create($container),
        );

        $application->register(new ThemeExtractionServiceProvider());
        $application->boot();

        $container->set(
            View::class,
            static fn (): View => new View(dirname(__DIR__, 3) . '/resources/views'),
        );

        $container->set(
            DetectionEngine::class,
            static fn (Container $container): DetectionEngine => new DetectionEngine(
                $container->get(DetectorRegistry::class),
            ),
        );

        $container->set(
            DetectionPipeline::class,
            static fn (Container $container): DetectionPipeline => new DetectionPipeline(
                $container->get(DetectionEngine::class),
            ),
        );

        $container->set(
            ThemeExtractor::class,
            static fn (Container $container): ThemeExtractor => new ThemeExtractor(
                $container->get(ThemeExtractionManager::class),
            ),
        );

        $container->set(
            PluginDetectionManager::class,
            static fn (Container $container): PluginDetectionManager => new PluginDetectionManager(
                $container->get(PluginRegistry::class),
            ),
        );

        $container->set(
            WebsiteReportAnalyzer::class,
            static fn (Container $container): WebsiteReportAnalyzer => new WebsiteReportAnalyzer(
                $container->get(HttpClientInterface::class),
                $container->get(DetectionContextFactory::class),
                $container->get(DetectionPipeline::class),
                $container->get(ThemeExtractor::class),
                $container->get(PluginDetectionManager::class),
            ),
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
            SeoController::class,
            static fn (): SeoController => new SeoController(),
        );

        $container->set(
            DetectionService::class,
            static fn (Container $container): DetectionService => new DetectionService(
                $container->get(WebsiteReportAnalyzer::class),
            ),
        );

        $container->set(
            DetectionController::class,
            static fn (Container $container): DetectionController => new DetectionController(
                $container->get(DetectionService::class),
            ),
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

final class PageFakeHttpClient implements HttpClientInterface
{
    public function __construct(
        private string $homepageHtml,
        private string $stylesheetCss,
    ) {
    }

    public function get(string $url): HttpResponse
    {
        if (str_contains($url, 'style.css')) {
            return $this->response($url, $this->stylesheetCss);
        }

        return $this->response($url, $this->homepageHtml);
    }

    private function response(string $url, string $body): HttpResponse
    {
        return new HttpResponse(
            originalUrl: $url,
            finalUrl: $url,
            statusCode: 200,
            headers: [],
            body: $body,
        );
    }
}
