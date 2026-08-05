<?php

declare(strict_types=1);

use App\Core\Application;
use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Router;
use App\Core\View;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\ReportController;
use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\DetectorRegistryFactory;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpClientInterface;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginRegistry;
use App\Modules\PluginDetection\PluginRegistryFactory;
use App\Modules\ThemeExtraction\Providers\ThemeExtractionServiceProvider;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use App\Services\WebsiteReportAnalyzer;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$application = new Application();

$container = $application->container();

/*
 * Populated service registries are registered before boot so that the
 * idempotent service providers never overwrite them with empty registries.
 */

$container->set(
    HttpClientInterface::class,
    static fn (): HttpClientInterface => new CurlHttpClient(
        new NativeCurlAdapter(),
    ),
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
    static fn (Container $container): ThemeExtractorRegistry => (new ThemeExtractorRegistryFactory())->create($container),
);

$container->set(
    PluginRegistry::class,
    static fn (Container $container): PluginRegistry => (new PluginRegistryFactory())->create($container),
);

$application->register(new ThemeExtractionServiceProvider());

$application->boot();

/*
 * Framework, presentation, and application services that no service
 * provider covers.
 */

$container->set(
    View::class,
    static fn (): View => new View(dirname(__DIR__) . '/resources/views'),
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
    ReportController::class,
    static fn (Container $container): ReportController => new ReportController(
        $container->get(WebsiteReportAnalyzer::class),
    ),
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

require dirname(__DIR__) . '/routes/web.php';

$GLOBALS['app'] = $container;

return $kernel;
