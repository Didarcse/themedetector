<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\ReportController;

/** @var App\Core\Router $router */

$router->get('/', HomeController::class);

$router->get('/loading', LoadingController::class);

$router->post('/loading', LoadingController::class);

$router->post('/report', ReportController::class);

$router->get('/health', fn () => 'OK');

$router->get('/about', fn () => 'ThemeDetectorTool v2');
