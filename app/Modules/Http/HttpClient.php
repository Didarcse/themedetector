<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Lightweight HTTP client for performing GET requests.
 *
 * Wraps cURL behind a clean API and returns immutable HttpResponse objects.
 * Every request automatically creates and releases its own CurlHandle.
 * The class is not final so test doubles may subclass it and override the
 * transport without changing any consumer.
 */
class HttpClient
{
    /**
     * Validate a URL string and return the trimmed, valid value.
     *
     * @throws HttpException If the URL is empty or malformed.
     *
     * @return non-empty-string The validated URL.
     */
    private static function validateUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '') {
            throw new HttpException('URL must not be empty.');
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new HttpException("Invalid URL: {$url}");
        }

        return $url;
    }

    /**
     * Parse raw response headers into a name-to-values map.
     *
     * Skips the status line and the trailing blank line. Repeated header
     * names are preserved as a list of values under a single key.
     *
     * @return array<string, list<string>>
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
            $key = trim($key);
            $value = trim($value);

            if (!isset($headers[$key])) {
                $headers[$key] = [];
            }

            $headers[$key][] = $value;
        }

        return $headers;
    }

    /**
     * Perform an HTTP GET request and return an immutable response.
     *
     * @throws HttpException On invalid URL or cURL failure.
     */
    public function get(string $url): HttpResponse
    {
        $url = self::validateUrl($url);

        $handle = CurlFactory::create();

        try {
            curl_setopt($handle, CURLOPT_URL, $url);

            $response = curl_exec($handle);

            if (!is_string($response)) {
                $error = curl_error($handle);
                throw new HttpException("cURL error: {$error}");
            }

            $info = curl_getinfo($handle);

            $rawHeaders = substr($response, 0, $info['header_size']);
            $body = substr($response, $info['header_size']);

            return new HttpResponse(
                originalUrl: $url,
                finalUrl: $info['url'],
                statusCode: $info['http_code'],
                headers: self::parseHeaders($rawHeaders),
                body: $body,
            );
        } finally {
            curl_close($handle);
        }
    }
}
