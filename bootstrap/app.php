<?php

declare(strict_types=1);

/**
 * Application Bootstrap
 *
 * Loads configuration, initializes environment,
 * and returns the application instance.
 *
 * @author  Didar Alam <didar@globalkernel.com>
 * @company Global Kernel
 */

use Dotenv\Dotenv;

defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__));

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        return match (strtolower($value)) {
            'true', '(true)'   => true,
            'false', '(false)'  => false,
            'null', '(null)'    => null,
            'empty', '(empty)'  => '',
            default             => $value,
        };
    }
}

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

$app = [
    'name'    => $_ENV['APP_NAME'] ?? 'ThemeDetectorTool',
    'env'     => $_ENV['APP_ENV'] ?? 'production',
    'debug'   => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
    'url'     => $_ENV['APP_URL'] ?? 'http://localhost',
    'version' => APP_VERSION,
];

return $app;
