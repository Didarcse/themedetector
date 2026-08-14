<?php

declare(strict_types=1);

$hitLog = getenv('SSRF_HIT_LOG');

$serverAddr = is_string($_SERVER['SERVER_ADDR'] ?? null) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1';
$serverPort = is_string($_SERVER['SERVER_PORT'] ?? null) ? $_SERVER['SERVER_PORT'] : '';
$requestUri = is_string($_SERVER['REQUEST_URI'] ?? null) ? $_SERVER['REQUEST_URI'] : '/';

if (is_string($hitLog) && $hitLog !== '') {
    $line = sprintf(
        "%s %s:%s %s\n",
        date('c'),
        $serverAddr,
        $serverPort,
        $requestUri,
    );

    file_put_contents($hitLog, $line, FILE_APPEND);
}

$path = parse_url($requestUri, PHP_URL_PATH) ?? '/';

if ($path === '/internal') {
    echo 'INTERNAL SECRET AREA';

    exit;
}

if ($path === '/redirect-internal') {
    header('Location: /internal', true, 302);

    exit;
}

if ($path === '/redirect-loopback') {
    header('Location: http://127.0.0.1:' . $serverPort . '/internal', true, 302);

    exit;
}

if ($path === '/redirect-ftp') {
    header('Location: ftp://example.com/file', true, 302);

    exit;
}

if ($path === '/sleep30') {
    sleep(30);

    echo 'slept';

    exit;
}

header('Content-Type: text/html; charset=UTF-8');
echo "<html><body>SSRF fixture root</body></html>\n";
