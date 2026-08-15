<?php

declare(strict_types=1);

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

if (!is_string($requestUri)) {
    $requestUri = '/';
}

$path = parse_url($requestUri, PHP_URL_PATH);

if (!is_string($path)) {
    $path = '/';
}

if (preg_match('#^/size/([0-9]+)$#', $path, $matches) === 1) {
    $bytes = (int) $matches[1];

    header('Content-Type: text/plain; charset=UTF-8');
    echo str_repeat('x', $bytes);

    exit;
}

header('Content-Type: text/html; charset=UTF-8');
echo "<html><body>Body-size fixture root</body></html>\n";
