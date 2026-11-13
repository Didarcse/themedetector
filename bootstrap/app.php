<?php

declare(strict_types=1);

use App\Api\AnalysisCache;
use App\Api\ApiDetectionResponsePresenter;
use App\Api\ApiKeyStore;
use App\Api\ApiRequestValidator;
use App\Api\RateLimiter;
use App\Api\WorkloadGuard;
use App\Core\Application;
use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\Environment;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Request;
use App\Core\Router;
use App\Core\View;
use App\Controllers\AboutController;
use App\Controllers\ApiV1DetectionController;
use App\Controllers\DetectionController;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\SeoController;
use App\Logging\ContextRedactor;
use App\Logging\FileLogger;
use App\Logging\LogLevel;
use App\Logging\NullLogger;
use App\Logging\SecurityEventLogger;
use Dotenv\Dotenv;
use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\DetectorRegistryFactory;
use App\Modules\Http\BoundedBodyCollector;
use App\Modules\Http\BoundedHeaderCollector;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
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
use App\Security\CsrfGuard;
use App\Security\CsrfTokenManager;
use App\Security\NativeSessionDriver;
use App\Security\SessionCsrfTokenStore;
use App\Security\SessionManager;
use App\Services\DetectionService;
use App\Services\WebsiteReportAnalyzer;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/*
 * Load the environment configuration when present. The .env file is
 * git-ignored; this provides the API key and rate-limit settings to the
 * public API. safeLoad() never overwrites existing environment variables
 * and never fails when no .env file exists.
 */
Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

$application = new Application();

$container = $application->container();

/*
 * Structured security logging. Disabled logging swaps in a no-op logger so
 * the rest of the event pipeline stays unchanged. An invalid LOG_LEVEL falls
 * back to warning rather than preventing the application from booting.
 */
$container->set(
    SecurityEventLogger::class,
    static function (): SecurityEventLogger {
        $enabled = filter_var(
            Environment::get('LOG_ENABLED') ?? 'true',
            FILTER_VALIDATE_BOOLEAN,
            FILTER_NULL_ON_FAILURE,
        ) ?? true;
        $levelName = Environment::get('LOG_LEVEL') ?? 'warning';

        try {
            $level = LogLevel::fromName($levelName);
        } catch (InvalidArgumentException) {
            $level = LogLevel::WARNING;
        }

        $logger = $enabled
            ? new FileLogger(
                dirname(__DIR__) . '/storage/logs/app.jsonl',
                $level,
                true,
            )
            : new NullLogger();

        return new SecurityEventLogger(
            $logger,
            new ContextRedactor(Environment::get('LOG_HASH_KEY')),
        );
    },
);

/*
 * Populated service registries are registered before boot so that the
 * idempotent service providers never overwrite them with empty registries.
 */

$maxResponseBytes = (static function (): int {
    $value = getenv('HTTP_MAX_RESPONSE_BYTES');

    return is_string($value) && is_numeric($value) && (int) $value > 0
        ? (int) $value
        : BoundedBodyCollector::DEFAULT_MAX_BYTES;
})();
$maxHeaderBytes = (static function (): int {
    $value = getenv('HTTP_MAX_HEADER_BYTES');

    return is_string($value) && is_numeric($value) && (int) $value > 0
        ? (int) $value
        : BoundedHeaderCollector::DEFAULT_MAX_BYTES;
})();
$container->set(
    HttpClientInterface::class,
    static fn (Container $container): HttpClientInterface => new CurlHttpClient(
        new NativeCurlAdapter(
            maxResponseBytes: $maxResponseBytes,
            maxHeaderBytes: $maxHeaderBytes,
        ),
        eventLogger: $container->get(SecurityEventLogger::class),
    ),
);

$container->set(
    HttpClient::class,
    static fn (Container $container): HttpClient => new HttpClient(
        maxResponseBytes: $maxResponseBytes,
        maxHeaderBytes: $maxHeaderBytes,
        eventLogger: $container->get(SecurityEventLogger::class),
    ),
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
    static fn (Container $container): TechnologyRegistry => (new TechnologyRegistryFactory())->create($container),
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
        $container->get(SecurityEventLogger::class),
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
    DetectionService::class,
    static fn (Container $container): DetectionService => new DetectionService(
        $container->get(WebsiteReportAnalyzer::class),
    ),
);

$storageDir = dirname(__DIR__) . '/storage';

/*
 * Session and CSRF services. The session manager is registered lazily so it
 * can read the current Request (set by the HTTP entry point) and enforce a
 * Secure cookie whenever the request is genuinely HTTPS. No session is
 * started for API requests; the store only starts one when a token is
 * issued or validated for a web request.
 */
$container->set(
    SessionManager::class,
    static function (Container $container) use ($storageDir): SessionManager {
        $request = $container->has(Request::class) ? $container->get(Request::class) : null;

        return new SessionManager(
            new NativeSessionDriver(),
            $storageDir . '/sessions',
            $request instanceof Request && $request->isSecure(),
            $container->get(SecurityEventLogger::class),
        );
    },
);

$container->set(
    CsrfTokenManager::class,
    static fn (Container $container): CsrfTokenManager => new CsrfTokenManager(
        new SessionCsrfTokenStore($container->get(SessionManager::class)),
    ),
);

$container->set(
    CsrfGuard::class,
    static fn (Container $container): CsrfGuard => new CsrfGuard(
        $container->get(CsrfTokenManager::class),
        $container->get(SecurityEventLogger::class),
    ),
);

/*
 * Web /detect boundary: the fixed-window per-IP rate limiter is a
 * dedicated limiter, fully isolated from the API limiters — its own
 * storage path, namespace, and environment variables. Identifiers are
 * sha256-hashed before they touch the filesystem, so raw IP addresses
 * never appear in file names or contents.
 */
$container->set(
    'web.rate_limiter',
    static fn (): RateLimiter => new RateLimiter(
        $storageDir . '/web/rate-limit',
        Environment::int('WEB_DETECT_LIMIT', 10),
        Environment::int('WEB_DETECT_WINDOW', 900),
        'web',
    ),
);

$container->set(
    DetectionController::class,
    static fn (Container $container): DetectionController => new DetectionController(
        $container->get(DetectionService::class),
        $container->get('web.rate_limiter'),
        $container->get(CsrfGuard::class),
        $container->get(SecurityEventLogger::class),
    ),
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

/*
 * Public API boundary services. The API reuses the existing
 * WebsiteReportAnalyzer; only boundary concerns are registered here.
 */

$container->set(
    ApiKeyStore::class,
    static fn (): ApiKeyStore => ApiKeyStore::fromEnvironment(),
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
        $storageDir . '/cache/api',
        Environment::int('API_CACHE_TTL', 300),
        ApiDetectionResponsePresenter::SCHEMA_VERSION,
    ),
);

$container->set(
    'api.rate_limiter.anonymous',
    static fn (): RateLimiter => new RateLimiter(
        $storageDir . '/api/rate-limit/anonymous',
        Environment::int('API_ANON_LIMIT', 10),
        Environment::int('API_ANON_WINDOW', 900),
        'anonymous',
    ),
);

$container->set(
    'api.rate_limiter.keyed',
    static fn (): RateLimiter => new RateLimiter(
        $storageDir . '/api/rate-limit/keyed',
        Environment::int('API_KEYED_LIMIT', 60),
        Environment::int('API_KEYED_WINDOW', 3600),
        'keyed',
    ),
);

$container->set(
    WorkloadGuard::class,
    static fn (): WorkloadGuard => new WorkloadGuard(
        $storageDir . '/api/workload',
        Environment::int('API_MAX_CONCURRENT', 10),
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
        $container->get('api.rate_limiter.anonymous'),
        $container->get('api.rate_limiter.keyed'),
        $container->get(WorkloadGuard::class),
        $container->get(SecurityEventLogger::class),
    ),
);

$router = new Router();
$dispatcher = new Dispatcher(container: $container);
$exceptionHandler = new ExceptionHandler();

$kernel = new Kernel(
    router: $router,
    dispatcher: $dispatcher,
    exceptionHandler: $exceptionHandler,
    eventLogger: $container->get(SecurityEventLogger::class),
);

require dirname(__DIR__) . '/routes/web.php';

require dirname(__DIR__) . '/routes/api.php';

$GLOBALS['app'] = $container;

return $kernel;
