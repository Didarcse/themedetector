<?php

declare(strict_types=1);

namespace App\Modules\Http;

use App\Modules\Http\Curl\CurlAdapterInterface;
use App\Modules\Http\Curl\CurlResponse;
use App\Modules\Http\Exceptions\HttpClientException;

/**
 * Default HttpClientInterface implementation.
 *
 * Orchestrates the transport layer and converts transport responses into
 * immutable HttpResponse objects. CurlHttpClient contains no direct
 * interaction with PHP native cURL; all transport operations are
 * delegated to a CurlAdapterInterface.
 *
 * Responsibilities:
 *
 * - Validate the supplied URL before any network activity.
 * - Delegate the raw cURL exchange to a CurlAdapterInterface.
 * - Convert the raw CurlResponse into an immutable HttpResponse.
 * - Parse the final HTTP header block into a name-to-values map.
 * - Propagate HttpClientException raised by the adapter.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a thin orchestration layer
 *   only. It performs no CMS detection, no HTML parsing, and contains no
 *   business logic.
 * - Dependency Inversion Principle: the client depends on the
 *   CurlAdapterInterface abstraction, never on the native cURL functions
 *   directly.
 * - The client is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 * - Public methods stay small and orchestration-focused; parsing logic
 *   lives in private helper methods.
 */
final readonly class CurlHttpClient implements HttpClientInterface
{
    /**
     * Create an HTTP client backed by a CurlAdapterInterface.
     *
     * @param CurlAdapterInterface $adapter   The transport adapter that
     *                                        performs the raw cURL
     *                                        exchange.
     * @param int                  $timeout   The total request timeout in
     *                                        seconds.
     * @param string               $userAgent The user agent to send with
     *                                        the request.
     */
    public function __construct(
        private CurlAdapterInterface $adapter,
        private int $timeout = 15,
        private string $userAgent = 'ThemeDetectorTool/2.0',
    ) {
    }

    /**
     * Send an HTTP GET request and return the immutable response.
     *
     * @param string $url The absolute URL to request.
     *
     * @return HttpResponse The immutable HTTP response.
     *
     * @throws HttpClientException On invalid URL or transport-level
     *                             failure.
     */
    public function get(string $url): HttpResponse
    {
        $this->validateUrl($url);

        $response = $this->adapter->execute(
            $url,
            $this->timeout,
            $this->userAgent,
        );

        return $this->createResponse($response);
    }

    /**
     * Validate that a URL is an absolute, well-formed URL.
     *
     * @param string $url The URL to validate.
     *
     * @throws HttpClientException If the URL is malformed.
     */
    private function validateUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new HttpClientException('Invalid URL.');
        }
    }

    /**
     * Build an immutable HttpResponse from a raw CurlResponse.
     *
     * Only the final HTTP header block is parsed: redirect headers are
     * ignored and intermediate header blocks are discarded rather than
     * merged.
     *
     * @param CurlResponse $response The immutable raw cURL exchange.
     *
     * @return HttpResponse The immutable HTTP response.
     */
    private function createResponse(CurlResponse $response): HttpResponse
    {
        return new HttpResponse(
            originalUrl: $response->originalUrl(),
            finalUrl: $response->finalUrl(),
            statusCode: $response->statusCode(),
            headers: $this->parseHeaders($this->finalHeaderBlock($response->rawHeaders())),
            body: $response->body(),
        );
    }

    /**
     * Parse a raw header block into a name-to-values map.
     *
     * Preserves duplicate header names as a list of values under a single
     * key and ignores malformed lines (empty lines and lines without a
     * colon separator).
     *
     * @param string $rawHeaders The raw final header block.
     *
     * @return array<string, list<string>>
     */
    private function parseHeaders(string $rawHeaders): array
    {
        $headers = [];

        foreach (explode("\r\n", $rawHeaders) as $line) {
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
     * Extract the final header block from a raw header region.
     *
     * A raw header region may contain multiple blocks separated by blank
     * lines when redirects are followed. Only the last non-empty block —
     * the final response's headers — is returned.
     *
     * @param string $rawHeaders The raw header region.
     *
     * @return string The final header block.
     */
    private function finalHeaderBlock(string $rawHeaders): string
    {
        foreach (array_reverse(explode("\r\n\r\n", $rawHeaders)) as $block) {
            if (trim($block) !== '') {
                return $block;
            }
        }

        return '';
    }
}
