<?php

declare(strict_types=1);

/**
 * ThemeDetectorTool v2
 * Kernel Framework v1 - Entry Point
 *
 * @author  Didar Alam <didar@globalkernel.com>
 * @company Global Kernel
 */

use App\Core\Request;

define('KERNEL_VERSION', '1.0.0');
define('APP_VERSION', '2.2.0');
define('APP_NAME', 'ThemeDetectorTool');
define('FRAMEWORK_NAME', 'Kernel Framework');

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var App\Core\Kernel $kernel */
$kernel = require dirname(__DIR__) . '/bootstrap/app.php';

$request = Request::fromGlobals();

$GLOBALS['app']->set(Request::class, $request);

$response = $kernel->handle($request);
$response->send();
