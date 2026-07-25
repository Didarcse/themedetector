<?php

declare(strict_types=1);

/**
 * ThemeDetectorTool v2
 * Kernel Framework v1 - Entry Point
 *
 * @author  Didar Alam <didar@globalkernel.com>
 * @company Global Kernel
 */

define('KERNEL_VERSION', '1.0.0');
define('APP_VERSION', '2.0.0');
define('APP_NAME', 'ThemeDetectorTool');
define('FRAMEWORK_NAME', 'Kernel Framework');

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

$httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri = $_SERVER['REQUEST_URI'] ?? '/';

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

header('X-Powered-By: ' . FRAMEWORK_NAME . ' v' . KERNEL_VERSION);
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'app'       => APP_NAME,
    'version'   => APP_VERSION,
    'framework' => FRAMEWORK_NAME,
    'kernel'    => KERNEL_VERSION,
    'status'    => 'initialized',
    'timestamp' => time(),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
