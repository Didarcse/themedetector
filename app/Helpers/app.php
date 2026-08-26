<?php

declare(strict_types=1);

use App\Core\Container;

function app(): Container
{
    if (!isset($GLOBALS['app']) || !$GLOBALS['app'] instanceof Container) {
        throw new RuntimeException('Application container is not available.');
    }

    return $GLOBALS['app'];
}

function canonical_url(string $path = '/'): string
{
    return 'https://themedetectortool.com' . '/' . ltrim($path, '/');
}

/**
 * Sanitize a URL for safe use in an HTML href attribute.
 *
 * Returns the URL unchanged when the scheme is http or https (the only
 * schemes the application renders as clickable links). Returns an empty
 * string for every other scheme — including javascript, data, vbscript,
 * and any future unsafe scheme — so that the URL is never rendered as an
 * executable href.
 *
 * @param string $url The raw URL to sanitize.
 *
 * @return string The safe URL for use in href attributes, or empty string
 *                when the scheme is not allowed.
 */
function safe_href(string $url): string
{
    $scheme = parse_url($url, PHP_URL_SCHEME);

    if (!is_string($scheme) || !in_array(strtolower($scheme), ['http', 'https'], true)) {
        return '';
    }

    return $url;
}
