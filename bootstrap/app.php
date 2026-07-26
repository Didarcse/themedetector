<?php

declare(strict_types=1);

use App\Core\Application;
use App\Core\Config;
use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Router;
use App\Core\View;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = new Config();

$application = new Application(
    basePath: dirname(__DIR__),
    config: $config->all(),
);

$container = new Container();

$container->singleton(
    Config::class,
    fn () => $config,
);

$container->singleton(
    Application::class,
    fn () => $application,
);

$router = new Router();
$dispatcher = new Dispatcher(container: $container);

$container->singleton(
    View::class,
    fn () => new View(
        $application->basePath() . '/resources/views'
    ),
);

$exceptionHandler = new ExceptionHandler();

$kernel = new Kernel(
    router: $router,
    dispatcher: $dispatcher,
    exceptionHandler: $exceptionHandler,
);

require dirname(__DIR__) . '/routes/web.php';

$GLOBALS['app'] = $container;

return $kernel;
