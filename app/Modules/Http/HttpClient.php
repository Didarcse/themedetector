<?php

declare(strict_types=1);

namespace App\Modules\Http;

use CurlHandle;

/**
 * Lightweight HTTP client for performing GET requests.
 *
 * Wraps cURL behind a clean API and returns immutable HttpResponse objects.
 * Every request automatically creates and releases its own CurlHandle.
 * The response body and the raw header region are each streamed through a
 * bounded collector, so no unbounded response is ever buffered in memory.
 * The class is not final so test doubles may subclass it and override the
 * transport without changing any consumer.
 */
class HttpClient
{
    private const MAX_REDIRECTS = 10;

    private const TOTAL_TIMEOUT = 30;

    private ?UrlHostPolicy $urlPolicy = null;

    /**
     * @param int $maxResponseBytes The maximum response-body size in
     *                              bytes. Responses larger than this are
     *                              failed closed and reported as a
     *                              transport failure.
     * @param int $maxHeaderBytes   The maximum response-header size in
     *                              bytes. Header regions larger than this
     *                              are failed closed and reported as a
     *                              transport failure.
     */
    public function __construct(
        ?UrlHostPolicy $urlPolicy = null,
        private int $maxResponseBytes = BoundedBodyCollector::DEFAULT_MAX_BYTES,
        private int $maxHeaderBytes = BoundedHeaderCollector::DEFAULT_MAX_BYTES,
    ) {
        $this->urlPolicy = $urlPolicy;
    }

    /**
     * Return the SSRF destination policy for this client.
     */
    private function policy(): UrlHostPolicy
    {
        return $this->urlPolicy ??= new UrlHostPolicy();
    }

    /**
     * Validate a URL string and return the trimmed, valid value.
     *
     * The destination must also pass the SSRF destination policy; unsafe
     * destinations are rejected before any outbound request is made.
     *
     * @throws HttpException If the URL is empty, malformed, or unsafe.
     *
     * @return non-empty-string The validated URL.
     */
    private function validateUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '') {
            throw new HttpException('URL must not be empty.');
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new HttpException('Invalid URL.');
        }

        if (!$this->policy()->isAllowed($url)) {
            throw new HttpException('Invalid URL.');
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
     * The initial URL and every redirect target are validated against the
     * SSRF destination policy before any request is performed. Automatic
     * redirect following is disabled in the transport, so redirects are
     * followed manually here: each Location is read, resolved against the
     * current URL, validated, and only followed when safe. At most 10
     * redirects are followed; a chain longer than that is returned as the
     * redirect response without further fetches. The total time budget
     * spans every hop of the chain.
     *
     * @throws HttpException On invalid or unsafe URL, request timeout, or
     *                       cURL failure.
     */
    public function get(string $url): HttpResponse
    {
        $url = $this->validateUrl($url);

        $originalUrl = $url;
        $currentUrl = $url;
        $redirects = 0;
        $deadline = microtime(true) + self::TOTAL_TIMEOUT;

        while (true) {
            $handle = CurlFactory::create();

            $collector = new BoundedBodyCollector($this->maxResponseBytes);
            $headerCollector = new BoundedHeaderCollector($this->maxHeaderBytes);

            try {
                curl_setopt($handle, CURLOPT_URL, $currentUrl);
                curl_setopt($handle, CURLOPT_TIMEOUT, $this->remainingTimeout($deadline));

                // Stream the body through the bounded collector instead of
                // buffering an unbounded response via CURLOPT_RETURNTRANSFER.
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
                curl_setopt($handle, CURLOPT_HEADER, false);
                curl_setopt(
                    $handle,
                    CURLOPT_HEADERFUNCTION,
                    static fn (CurlHandle $handle, string $line): int => $headerCollector->write($line),
                );
                curl_setopt(
                    $handle,
                    CURLOPT_WRITEFUNCTION,
                    static fn (CurlHandle $handle, string $chunk): int => $collector->write($chunk),
                );

                $result = curl_exec($handle);

                if ($result === false) {
                    if ($collector->exceeded()) {
                        throw new HttpException('Response body exceeds the maximum allowed size.');
                    }

                    if ($headerCollector->exceeded()) {
                        throw new HttpException('Response headers exceed the maximum allowed size.');
                    }

                    $error = curl_error($handle);
                    throw new HttpException("cURL error: {$error}");
                }

                $statusCode = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);

                $rawHeaders = $headerCollector->headers();

                $location = self::redirectLocation($rawHeaders);

                if (self::isRedirect($statusCode) && $location !== null) {
                    if ($redirects >= self::MAX_REDIRECTS) {
                        return new HttpResponse(
                            originalUrl: $originalUrl,
                            finalUrl: $currentUrl,
                            statusCode: $statusCode,
                            headers: self::parseHeaders($rawHeaders),
                            body: $collector->body(),
                        );
                    }

                    $currentUrl = $this->validateUrl(self::resolveRedirectUrl($currentUrl, $location));
                    $redirects++;

                    continue;
                }

                return new HttpResponse(
                    originalUrl: $originalUrl,
                    finalUrl: $currentUrl,
                    statusCode: $statusCode,
                    headers: self::parseHeaders($rawHeaders),
                    body: $collector->body(),
                );
            } finally {
                curl_close($handle);
            }
        }
    }

    /**
     * Return the remaining time budget for the current hop.
     *
     * @param float $deadline The absolute deadline for the whole chain.
     *
     * @return int The remaining seconds, at least one.
     *
     * @throws HttpException When the time budget is exhausted.
     */
    private function remainingTimeout(float $deadline): int
    {
        $remaining = (int) ceil($deadline - microtime(true));

        if ($remaining <= 0) {
            throw new HttpException('Request timed out.');
        }

        return $remaining;
    }

    /**
     * Return whether the given status code is a redirect.
     *
     * @param int $statusCode The HTTP status code.
     *
     * @return bool True when the status is a redirect.
     */
    private static function isRedirect(int $statusCode): bool
    {
        return in_array($statusCode, [301, 302, 303, 307, 308], true);
    }

    /**
     * Extract the Location header from a raw header region.
     *
     * @param string $rawHeaders The raw header region of the exchange.
     *
     * @return string|null The trimmed Location value, or null when absent.
     */
    private static function redirectLocation(string $rawHeaders): ?string
    {
        foreach (preg_split('/\r\n|\n|\r/', $rawHeaders) ?: [] as $line) {
            if (preg_match('/^Location\s*:\s*(.+)$/i', $line, $matches) === 1) {
                $value = trim($matches[1]);

                if ($value !== '') {
                    return $value;
                }
            }
        }

        return null;
    }

    /**
     * Resolve a redirect Location against the current URL.
     *
     * Supports absolute, protocol-relative, root-relative, and plain
     * relative references.
     *
     * @param string $currentUrl The current URL.
     * @param string $location   The raw Location value.
     *
     * @return string The resolved absolute URL.
     */
    private static function resolveRedirectUrl(string $currentUrl, string $location): string
    {
        if (preg_match('#^[a-zA-Z][a-zA-Z0-9+.\-]*://#', $location) === 1) {
            return $location;
        }

        $parts = parse_url($currentUrl);

        if ($parts === false) {
            throw new HttpException('Invalid URL.');
        }

        $scheme = (string) ($parts['scheme'] ?? 'http');
        $host = (string) ($parts['host'] ?? '');
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        $origin = $scheme . '://' . $host . $port;

        if (str_starts_with($location, '//')) {
            return $scheme . ':' . $location;
        }

        if (str_starts_with($location, '/')) {
            return $origin . $location;
        }

        $path = (string) ($parts['path'] ?? '');
        $slashPos = strrpos($path, '/');
        $directory = $slashPos === false ? '/' : substr($path, 0, $slashPos + 1);

        return $origin . $directory . $location;
    }
}
