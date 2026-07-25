<?php

declare(strict_types=1);

use Core\Application;
use Core\Config;
use Core\Container;
use Core\Dispatcher;
use Core\Kernel;
use Core\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = new Config();

$application = new Application(
    basePath: dirname(__DIR__),
    config: $config->all(),
);

$container = new Container();
$router = new Router();
$dispatcher = new Dispatcher(container: $container);

$kernel = new Kernel(
    application: $application,
    router: $router,
    dispatcher: $dispatcher,
);

return $kernel;
