<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;

/** @var Core\Router $router */

$router->get('/', HomeController::class);

$router->get('/health', fn () => 'OK');

$router->get('/about', fn () => 'ThemeDetectorTool v2');
