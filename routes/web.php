<?php

declare(strict_types=1);

use App\Controllers\AboutController;
use App\Controllers\DetectionController;
use App\Controllers\HomeController;
use App\Controllers\LoadingController;
use App\Controllers\SeoController;

/** @var App\Core\Router $router */

$router->get('/', HomeController::class);

$router->get('/loading', LoadingController::class);

$router->post('/loading', LoadingController::class);

$router->post('/detect', DetectionController::class);

$router->get('/health', fn () => 'OK');

$router->get('/about', AboutController::class);

$router->get('/robots.txt', [SeoController::class, 'robots']);

$router->get('/sitemap.xml', [SeoController::class, 'sitemap']);
