<?php

declare(strict_types=1);

namespace App\Modules\Http\Curl;

use App\Modules\Http\BoundedBodyCollector;
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
 * The response body is streamed through a BoundedBodyCollector write
 * callback instead of being buffered unbounded by CURLOPT_RETURNTRANSFER:
 * libcurl aborts the transfer as soon as the collected body would exceed
 * the configured maximum, so a hostile or pathological remote site can
 * never force the process to hold an unbounded response in memory. Header
 * bytes are captured separately through CURLOPT_HEADERFUNCTION.
 *
 * Responsibilities:
 *
 * - Validate the supplied URL before any network activity.
 * - Perform a single HTTP GET request via cURL with a fixed, safe option
 *   set.
 * - Collect the original URL, final URL, status code, raw header region,
 *   and response body of the raw cURL exchange.
 * - Enforce a bounded maximum response-body size while streaming, failing
 *   closed when the limit is exceeded.
 * - Return the exchange as an immutable CurlResponse.
 * - Throw HttpClientException on invalid URLs, cURL initialization,
 *   option, execution, or body-size-limit failures.
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
     * Create a native cURL adapter.
     *
     * @param int $maxResponseBytes The maximum response-body size in
     *                              bytes. Responses larger than this are
     *                              failed closed and reported as a
     *                              transport failure.
     */
    public function __construct(
        private int $maxResponseBytes = BoundedBodyCollector::DEFAULT_MAX_BYTES,
    ) {
    }

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
     *                             option, execution, or body-size-limit
     *                             failure.
     */
    public function execute(string $url, int $timeout, string $userAgent): CurlResponse
    {
        $this->validateUrl($url);

        $handle = curl_init();

        if ($handle === false) {
            throw new HttpClientException('Failed to initialize cURL.');
        }

        $collector = new BoundedBodyCollector($this->maxResponseBytes);
        $rawHeaders = '';

        try {
            $options = $this->options($url, $timeout, $userAgent, $collector, $rawHeaders);

            if (curl_setopt_array($handle, $options) === false) {
                throw new HttpClientException('Failed to configure cURL options.');
            }

            if (curl_exec($handle) === false) {
                if ($collector->exceeded()) {
                    throw new HttpClientException('Response body exceeds the maximum allowed size.');
                }

                $error = curl_error($handle);

                if ($error === '') {
                    $error = 'Unknown cURL error (errno ' . curl_errno($handle) . ').';
                }

                throw new HttpClientException('cURL error: ' . $error);
            }

            return $this->createResponse($url, $collector, $rawHeaders, $handle);
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
     * The option set is fixed and safe: timeouts are bounded, automatic
     * redirect following is disabled so the client layer can validate
     * every redirect target against the SSRF URL policy, the allowed
     * protocols are restricted to HTTP and HTTPS for both the initial
     * request and any redirects (defense-in-depth), SSL verification is
     * enabled, and all supported content encodings are accepted. The body
     * is streamed through the bounded collector and the headers through a
     * separate header callback, so no unbounded response is ever buffered.
     *
     * @param string                $url          The URL to request.
     * @param int                   $timeout      The request timeout.
     * @param string                $userAgent    The user agent.
     * @param BoundedBodyCollector  $collector    The bounded body writer.
     * @param string                $rawHeaders   The captured raw header
     *                                            region, filled by the
     *                                            header callback.
     *
     * @return array<int, mixed>
     */
    private function options(
        string $url,
        int $timeout,
        string $userAgent,
        BoundedBodyCollector $collector,
        string &$rawHeaders,
    ): array {
        return [
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => false,
            CURLOPT_HEADER          => false,
            CURLOPT_HEADERFUNCTION  => static function (CurlHandle $handle, string $line) use (&$rawHeaders): int {
                $rawHeaders .= $line;

                return strlen($line);
            },
            CURLOPT_WRITEFUNCTION   => static fn (CurlHandle $handle, string $chunk): int => $collector->write($chunk),
            CURLOPT_FOLLOWLOCATION  => false,
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
     * Build an immutable CurlResponse from a streamed cURL exchange.
     *
     * The raw header region is taken verbatim from the header callback and
     * the body from the bounded collector; no parsing or transformation is
     * applied. The header region is returned exactly as received.
     *
     * @param string                $originalUrl The URL that was originally requested.
     * @param BoundedBodyCollector  $collector   The bounded body collector holding the body.
     * @param string                $rawHeaders  The captured raw header region.
     * @param CurlHandle            $handle      The active cURL handle providing response metadata.
     *
     * @return CurlResponse The immutable raw cURL exchange.
     */
    private function createResponse(
        string $originalUrl,
        BoundedBodyCollector $collector,
        string $rawHeaders,
        CurlHandle $handle,
    ): CurlResponse {
        return new CurlResponse(
            originalUrl: $originalUrl,
            finalUrl: (string) curl_getinfo($handle, CURLINFO_EFFECTIVE_URL),
            statusCode: (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE),
            rawHeaders: $rawHeaders,
            body: $collector->body(),
        );
    }
}
