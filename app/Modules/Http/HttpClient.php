<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Lightweight HTTP client for performing GET requests.
 *
 * Wraps cURL behind a clean API and returns immutable HttpResponse objects.
 * Every request automatically creates and releases its own CurlHandle.
 */
final class HttpClient
{
    /**
     * Validate a URL string.
     *
     * @throws HttpException If the URL is empty or malformed.
     */
    private static function validateUrl(string $url): void
    {
        $url = trim($url);

        if ($url === '') {
            throw new HttpException('URL must not be empty.');
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new HttpException("Invalid URL: {$url}");
        }
    }

    /**
     * Parse raw response headers into a key-value map.
     *
     * Skips the status line and the trailing blank line.
     *
     * @return array<string, string>
     */
    private static function parseHeaders(string $rawHeaders): array
    {
        $headers = [];
        $lines = explode("\r\n", $rawHeaders);

        foreach ($lines as $line) {
            if ($line === '' || !str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);
            $headers[trim($key)] = trim($value);
        }

        return $headers;
    }

    /**
     * Parse Set-Cookie headers from raw header block into a name-value map.
     *
     * Operates on the raw header string to correctly capture multiple
     * Set-Cookie headers that would be lost after key deduplication.
     *
     * @return array<string, string>
     */
    private static function parseCookies(string $rawHeaders): array
    {
        $cookies = [];
        $lines = explode("\r\n", $rawHeaders);

        foreach ($lines as $line) {
            if ($line === '' || !str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);

            if (strcasecmp(trim($key), 'Set-Cookie') !== 0) {
                continue;
            }

            $parts = explode(';', trim($value), 2);
            $pair = explode('=', $parts[0], 2);

            if (count($pair) === 2) {
                $cookies[trim($pair[0])] = trim($pair[1]);
            }
        }

        return $cookies;
    }

    /**
     * Perform an HTTP GET request and return an immutable response.
     *
     * @throws HttpException On invalid URL or cURL failure.
     */
    public function get(string $url): HttpResponse
    {
        self::validateUrl($url);

        $handle = CurlFactory::create();

        try {
            curl_setopt($handle, CURLOPT_URL, $url);

            $response = curl_exec($handle);

            if ($response === false) {
                $error = curl_error($handle);
                throw new HttpException("cURL error: {$error}");
            }

            $info = curl_getinfo($handle);

            $rawHeaders = substr($response, 0, $info['header_size']);
            $body = substr($response, $info['header_size']);

            $allHeaders = self::parseHeaders($rawHeaders);
            $cookies = self::parseCookies($rawHeaders);

            return new HttpResponse(
                body: $body,
                status: $info['http_code'],
                headers: $allHeaders,
                cookies: $cookies,
                effectiveUrl: $info['url'],
                responseTime: $info['total_time'],
            );
        } finally {
            curl_close($handle);
        }
    }
}
