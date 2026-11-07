<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Api\AnalysisCache;
use App\Api\ApiDetectionResponsePresenter;
use App\Api\ApiKeyStore;
use App\Api\ApiRequestValidator;
use App\Api\RateLimiter;
use App\Api\WorkloadGuard;
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
use App\Controllers\ApiV1DetectionController;
use App\Controllers\DetectionController;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\SeoController;
use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\DetectorRegistryFactory;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpClientInterface;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginRegistry;
use App\Modules\PluginDetection\PluginRegistryFactory;
use App\Modules\TechnologyDetection\TechnologyDetector;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyRegistry;
use App\Modules\TechnologyDetection\TechnologyRegistryFactory;
use App\Modules\ThemeExtraction\Providers\ThemeExtractionServiceProvider;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use App\Services\DetectionService;
use App\Services\WebsiteReportAnalyzer;

/**
 * Boots a fully wired application kernel for the public API tests.
 *
 * ApiTestKernel assembles the same container, services, and routes the
 * production bootstrap wires, but injects offline HTTP clients and an
 * isolated, disposable storage directory so every test is deterministic
 * and never touches the network or shared state.
 *
 * Responsibilities:
 *
 * - Build a production-shaped kernel with offline collaborators.
 * - Provide a handle() helper that posts to the public API route.
 * - Provide access to the fake HTTP client and disposable storage.
 *
 * Design philosophy:
 *
 * - Deterministic: fixed rate-limit windows and a disposable storage
 *   directory keep every test repeatable.
 * - Offline: no real HTTP client is ever installed unless the caller
 *   supplies one.
 * - Self-contained: cleanup() removes the disposable storage directory.
 */
final class ApiTestKernel
{
    public const HOMEPAGE_HTML = <<<'HTML'
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

    public const STYLESHEET_CSS = <<<'CSS'
/*
Theme Name: Twenty Twenty-Five
Theme URI: https://wordpress.org/themes/twentytwentyfive/
Author: the WordPress team
Version: 1.0
License: GPL-2.0-or-later
Text Domain: twentytwentyfive
*/
CSS;

    public const NO_DETECTION_HTML = <<<'HTML'
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

    public readonly Kernel $kernel;
    public readonly Container $container;
    public readonly ApiFakeHttpClient $client;

    private readonly string $storageDir;

    /**
     * @param string $storageDir The disposable storage directory.
     */
    private function __construct(
        Kernel $kernel,
        Container $container,
        string $storageDir,
        ApiFakeHttpClient $client,
    ) {
        $this->kernel = $kernel;
        $this->container = $container;
        $this->storageDir = $storageDir;
        $this->client = $client;
    }

    /**
     * Boot a fully wired API test kernel.
     *
     * @param array<int|string, string> $apiKeys       The API keys to
     *                                                 configure.
     * @param int                       $anonymousLimit The anonymous tier
     *                                                 limit.
     * @param int                       $keyedLimit     The keyed tier limit.
     * @param int                       $windowSeconds  The shared window
     *                                                 length.
     * @param int                       $cacheTtl       The cache TTL.
     * @param int                       $maxConcurrent  The workload cap.
     * @param int|null                  $now            A fixed clock value
     *                                                 for deterministic
     *                                                 rate-limit tests.
     * @param HttpClientInterface|null $client          The primary HTTP
     *                                                 client; defaults to
     *                                                 the offline fake.
     * @param string|null              $homepageHtml    The homepage fixture.
     * @param string|null              $stylesheetCss   The stylesheet fixture.
     * @param int                      $webLimit        The web `/detect`
     *                                                 per-IP request limit.
     * @param int                      $webWindowSeconds The web `/detect`
     *                                                 window length.
     *
     * @return self The booted test kernel.
     */
    public static function create(
        array $apiKeys = [],
        int $anonymousLimit = 100,
        int $keyedLimit = 100,
        int $windowSeconds = 3600,
        int $cacheTtl = 300,
        int $maxConcurrent = 10,
        ?int $now = null,
        ?HttpClientInterface $client = null,
        ?string $homepageHtml = null,
        ?string $stylesheetCss = null,
        int $webLimit = 1000,
        int $webWindowSeconds = 3600,
    ): self {
        $application = new Application();
        $container = $application->container();

        $fake = $client instanceof ApiFakeHttpClient
            ? $client
            : new ApiFakeHttpClient($homepageHtml ?? self::HOMEPAGE_HTML, $stylesheetCss ?? self::STYLESHEET_CSS);

        $container->set(
            HttpClientInterface::class,
            static fn (): HttpClientInterface => $client ?? $fake,
        );

        $container->set(
            HttpClient::class,
            static fn (): HttpClient => new OfflineHttpClient(),
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

        $container->set(
            TechnologyRegistry::class,
            static fn (Container $container): TechnologyRegistry =>
                (new TechnologyRegistryFactory())->create($container),
        );

        $application->register(new ThemeExtractionServiceProvider());
        $application->boot();

        $container->set(
            View::class,
            static fn (): View => new View(dirname(__DIR__, 2) . '/resources/views'),
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
            TechnologyDetectionManager::class,
            static fn (Container $container): TechnologyDetectionManager => new TechnologyDetectionManager(
                $container->get(TechnologyRegistry::class),
            ),
        );

        $container->set(
            TechnologyDetector::class,
            static fn (Container $container): TechnologyDetector => new TechnologyDetector(
                $container->get(TechnologyDetectionManager::class),
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
                $container->get(TechnologyDetector::class),
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

        $storageDir = sys_get_temp_dir() . '/api-test-' . uniqid('', true);

        $container->set(
            DetectionService::class,
            static fn (Container $container): DetectionService => new DetectionService(
                $container->get(WebsiteReportAnalyzer::class),
            ),
        );

        $webRateLimiter = new RateLimiter(
            $storageDir . '/rate-limit/web',
            $webLimit,
            $webWindowSeconds,
            'web',
            $now === null ? null : static fn (): int => $now,
        );

        $container->set(
            DetectionController::class,
            static fn (Container $container): DetectionController => new DetectionController(
                $container->get(DetectionService::class),
                $webRateLimiter,
            ),
        );

        $container->set(
            LoadingController::class,
            static fn (): LoadingController => new LoadingController(),
        );

        $container->set(
            ApiKeyStore::class,
            static fn (): ApiKeyStore => new ApiKeyStore($apiKeys),
        );

        $container->set(
            ApiRequestValidator::class,
            static fn (): ApiRequestValidator => new ApiRequestValidator(),
        );

        $container->set(
            ApiDetectionResponsePresenter::class,
            static fn (): ApiDetectionResponsePresenter => new ApiDetectionResponsePresenter(),
        );

        $container->set(
            AnalysisCache::class,
            static fn (): AnalysisCache => new AnalysisCache(
                $storageDir . '/cache',
                $cacheTtl,
                ApiDetectionResponsePresenter::SCHEMA_VERSION,
                $now === null ? null : static fn (): int => $now,
            ),
        );

        $anonymousLimiter = new RateLimiter(
            $storageDir . '/rate-limit/anonymous',
            $anonymousLimit,
            $windowSeconds,
            'anonymous',
            $now === null ? null : static fn (): int => $now,
        );

        $keyedLimiter = new RateLimiter(
            $storageDir . '/rate-limit/keyed',
            $keyedLimit,
            $windowSeconds,
            'keyed',
            $now === null ? null : static fn (): int => $now,
        );

        $container->set(
            WorkloadGuard::class,
            static fn (): WorkloadGuard => new WorkloadGuard(
                $storageDir . '/workload',
                $maxConcurrent,
                120,
                $now === null ? null : static fn (): int => $now,
            ),
        );

        $container->set(
            ApiV1DetectionController::class,
            static fn (Container $container): ApiV1DetectionController => new ApiV1DetectionController(
                $container->get(ApiKeyStore::class),
                $container->get(ApiRequestValidator::class),
                $container->get(WebsiteReportAnalyzer::class),
                $container->get(ApiDetectionResponsePresenter::class),
                $container->get(AnalysisCache::class),
                $anonymousLimiter,
                $keyedLimiter,
                $container->get(WorkloadGuard::class),
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

        require dirname(__DIR__, 2) . '/routes/web.php';
        require dirname(__DIR__, 2) . '/routes/api.php';

        $GLOBALS['app'] = $container;

        return new self($kernel, $container, $storageDir, $fake);
    }

    /**
     * Post a JSON body to the public API route and return the response.
     *
     * @param string               $body   The raw request body.
     * @param array<string, mixed> $server The server variables.
     *
     * @return Response The HTTP response.
     */
    public function handle(string $body, array $server = []): Response
    {
        $request = new Request('POST', '/api/v1/detect', [], [], $server, $body);

        $this->container->set(Request::class, $request);

        return $this->kernel->handle($request);
    }

    /**
     * Handle an arbitrary request for web/API co-existence tests.
     *
     * @param string               $method The HTTP method.
     * @param string               $uri    The request URI.
     * @param array<string, mixed> $post   The POST parameters.
     * @param array<string, mixed> $server The server variables.
     *
     * @return Response The HTTP response.
     */
    public function handleRequest(string $method, string $uri, array $post = [], array $server = []): Response
    {
        $request = new Request($method, $uri, [], $post, $server);

        $this->container->set(Request::class, $request);

        return $this->kernel->handle($request);
    }

    /**
     * Remove the disposable storage directory.
     */
    public function cleanup(): void
    {
        self::removeDirectory($this->storageDir);
    }

    /**
     * Recursively remove a directory tree.
     *
     * @param string $directory The directory to remove.
     */
    private static function removeDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        /** @var \SplFileInfo $item */
        foreach ($items as $item) {
            if ($item->isDir()) {
                @rmdir($item->getPathname());
            } else {
                @unlink($item->getPathname());
            }
        }

        @rmdir($directory);
    }
}
