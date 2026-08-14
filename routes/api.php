<?php

declare(strict_types=1);

use App\Controllers\ApiV1DetectionController;

/*
 * Public API routes.
 *
 * The API is a peer of the web routes: it shares the existing detection
 * pipeline (WebsiteReportAnalyzer) but is wired independently so web
 * behaviour is never affected by API changes.
 */

/** @var App\Core\Router $router */
$router->post('/api/v1/detect', ApiV1DetectionController::class);
