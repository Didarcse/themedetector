<?php

declare(strict_types=1);

namespace App\Modules\Http\Curl;

use App\Modules\Http\Exceptions\HttpClientException;
use CurlHandle;

/**
 * Production implementation of CurlAdapterInterface using PHP cURL.
 *
 * This class is the only component in the entire project allowed to call
 * native curl_*() functions. It performs the complete transport operation
 * and returns an immutable CurlResponse. It contains no HTTP response
 * parsing, no business logic, and no CMS knowledge.
 *
 * Responsibilities:
 *
 * - Validate the supplied URL before any network activity.
 * - Perform a single HTTP GET request via cURL with a fixed, safe option
 *   set.
 * - Collect the original URL, final URL, status code, header size, and
 *   response body of the raw cURL exchange.
 * - Split the raw cURL exchange into a raw header region and a body using
 *   CURLINFO_HEADER_SIZE.
 * - Return the exchange as an immutable CurlResponse.
 * - Throw HttpClientException on invalid URLs, cURL initialization,
 *   option, or execution failures.
 * - Always close the cURL handle via try/finally; never leak resources.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a concrete transport
 *   implementation only. It performs no HTTP response parsing, no CMS
 *   detection, no theme extraction, and no plugin detection.
 * - All native curl_*() calls are isolated inside this class.
 * - The adapter is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 * - Public methods stay small and orchestration-focused; implementation
 *   details live in private helper methods.
 */
final readonly class NativeCurlAdapter implements CurlAdapterInterface
{
    /**
     * Execute a single HTTP GET request and return the raw exchange.
     *
     * @param string $url       The absolute URL to request.
     * @param int    $timeout   The total request timeout in seconds.
     * @param string $userAgent The user agent to send with the request.
     *
     * @return CurlResponse The immutable raw cURL exchange.
     *
     * @throws HttpClientException On invalid URL, cURL initialization,
     *                             option, or execution failure.
     */
    public function execute(string $url, int $timeout, string $userAgent): CurlResponse
    {
        $this->validateUrl($url);

        $handle = curl_init();

        if ($handle === false) {
            throw new HttpClientException('Failed to initialize cURL.');
        }

        try {
            if (curl_setopt_array($handle, $this->options($url, $timeout, $userAgent)) === false) {
                throw new HttpClientException('Failed to configure cURL options.');
            }

            $rawExchange = curl_exec($handle);

            if (!is_string($rawExchange)) {
                $error = curl_error($handle);

                if ($error === '') {
                    $error = 'Unknown cURL error (errno ' . curl_errno($handle) . ').';
                }

                throw new HttpClientException('cURL error: ' . $error);
            }

            return $this->createResponse($url, $rawExchange, $handle);
        } finally {
            curl_close($handle);
        }
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
     * Build the immutable set of cURL options for a GET request.
     *
     * The option set is fixed and safe: timeouts are bounded, redirects
     * are followed to a strict maximum, the allowed protocols are
     * restricted to HTTP and HTTPS for both the initial request and any
     * redirects, SSL verification is enabled, and all supported content
     * encodings are accepted.
     *
     * @return array<int, mixed>
     */
    private function options(string $url, int $timeout, string $userAgent): array
    {
        return [
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => true,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => $timeout,
            CURLOPT_CONNECTTIMEOUT  => 5,
            CURLOPT_USERAGENT       => $userAgent,
            CURLOPT_HTTPGET         => true,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER  => true,
            CURLOPT_SSL_VERIFYHOST  => 2,
            CURLOPT_PROTOCOLS       => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_ENCODING        => '',
        ];
    }

    /**
     * Build an immutable CurlResponse from a raw cURL exchange.
     *
     * The raw exchange is split at the cURL-reported header size: the
     * header region is stored verbatim and the remaining bytes form the
     * body. No parsing or transformation is applied; the raw header
     * string is returned exactly as received.
     *
     * @param string     $originalUrl The URL that was originally requested.
     * @param string     $rawExchange The raw cURL exchange (headers and body).
     * @param CurlHandle $handle      The active cURL handle providing response metadata.
     *
     * @return CurlResponse The immutable raw cURL exchange.
     */
    private function createResponse(
        string $originalUrl,
        string $rawExchange,
        CurlHandle $handle,
    ): CurlResponse {
        $headerSize = (int) curl_getinfo($handle, CURLINFO_HEADER_SIZE);

        return new CurlResponse(
            originalUrl: $originalUrl,
            finalUrl: (string) curl_getinfo($handle, CURLINFO_EFFECTIVE_URL),
            statusCode: (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE),
            rawHeaders: substr($rawExchange, 0, $headerSize),
            body: substr($rawExchange, $headerSize),
        );
    }
}
