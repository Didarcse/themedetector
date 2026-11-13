<?php

declare(strict_types=1);

namespace App\Modules\Http;

use App\Logging\SecurityEventLogger;
use App\Modules\Http\Curl\CurlAdapterInterface;
use App\Modules\Http\Curl\CurlResponse;
use App\Modules\Http\Exceptions\HttpClientException;
use App\Modules\Http\Exceptions\SsrfBlockedException;

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
    private const MAX_REDIRECTS = 10;

    /**
     * Create an HTTP client backed by a CurlAdapterInterface.
     *
     * @param CurlAdapterInterface $adapter   The transport adapter that
     *                                        performs the raw cURL
     *                                        exchange.
     * @param int                  $timeout   The total request timeout in
     *                                        seconds, covering every hop of
     *                                        a redirect chain.
     * @param string               $userAgent The user agent to send with
     *                                        the request.
     * @param UrlHostPolicy        $urlPolicy   The SSRF destination policy
     *                                          applied to the initial URL and
     *                                          to every redirect target.
     * @param SecurityEventLogger|null $eventLogger The security event logger.
     */
    public function __construct(
        private CurlAdapterInterface $adapter,
        private int $timeout = 15,
        private string $userAgent = 'ThemeDetectorTool/2.0',
        private UrlHostPolicy $urlPolicy = new UrlHostPolicy(),
        private ?SecurityEventLogger $eventLogger = null,
    ) {
    }

    /**
     * Send an HTTP GET request and return the immutable response.
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
     * @param string $url The absolute URL to request.
     *
     * @return HttpResponse The immutable HTTP response.
     *
     * @throws HttpClientException On invalid or unsafe URL, request
     *                             timeout, or transport-level failure.
     */
    public function get(string $url): HttpResponse
    {
        $this->validateUrl($url);

        $originalUrl = $url;
        $currentUrl = $url;
        $redirects = 0;
        $deadline = microtime(true) + $this->timeout;

        while (true) {
            $response = $this->adapter->execute(
                $currentUrl,
                $this->remainingTimeout($deadline),
                $this->userAgent,
            );

            $location = $this->redirectLocation($response->rawHeaders());

            if ($this->isRedirect($response->statusCode()) && $location !== null) {
                if ($redirects >= self::MAX_REDIRECTS) {
                    return $this->createResponse($response, $originalUrl);
                }

                $currentUrl = $this->resolveRedirectUrl($currentUrl, $location);
                $this->validateUrl($currentUrl);
                $redirects++;

                continue;
            }

            return $this->createResponse($response, $originalUrl);
        }
    }

    /**
     * Validate that a URL is an absolute, well-formed URL whose
     * destination is permitted by the SSRF destination policy.
     *
     * @param string $url The URL to validate.
     *
     * @throws HttpClientException If the URL is malformed or unsafe.
     */
    private function validateUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new HttpClientException('Invalid URL.');
        }

        if (!$this->urlPolicy->isAllowed($url)) {
            $this->eventLogger?->ssrfBlocked($url);

            throw new SsrfBlockedException('Invalid URL.');
        }
    }

    /**
     * Return the remaining time budget for the current hop.
     *
     * @param float $deadline The absolute deadline for the whole chain.
     *
     * @return int The remaining seconds, at least one.
     *
     * @throws HttpClientException When the time budget is exhausted.
     */
    private function remainingTimeout(float $deadline): int
    {
        $remaining = (int) ceil($deadline - microtime(true));

        if ($remaining <= 0) {
            throw new HttpClientException('Request timed out.');
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
    private function isRedirect(int $statusCode): bool
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
    private function redirectLocation(string $rawHeaders): ?string
    {
        $block = $this->finalHeaderBlock($rawHeaders);

        foreach (preg_split('/\r\n|\n|\r/', $block) ?: [] as $line) {
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
     * relative references. Dot segments are not collapsed here; they never
     * change the destination host, and the resolved URL is re-validated by
     * the destination policy before it is fetched.
     *
     * @param string $currentUrl The current URL.
     * @param string $location   The raw Location value.
     *
     * @return string The resolved absolute URL.
     *
     * @throws HttpClientException When the current URL cannot be parsed.
     */
    private function resolveRedirectUrl(string $currentUrl, string $location): string
    {
        if (preg_match('#^[a-zA-Z][a-zA-Z0-9+.\-]*://#', $location) === 1) {
            return $location;
        }

        $parts = parse_url($currentUrl);

        if ($parts === false) {
            throw new HttpClientException('Invalid URL.');
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

    /**
     * Build an immutable HttpResponse from a raw CurlResponse.
     *
     * Only the final HTTP header block is parsed: redirect headers are
     * ignored and intermediate header blocks are discarded rather than
     * merged. The original user-submitted URL is preserved as the
     * response's original URL even when a redirect chain was followed.
     *
     * @param CurlResponse $response    The immutable raw cURL exchange.
     * @param string       $originalUrl The user-submitted URL.
     *
     * @return HttpResponse The immutable HTTP response.
     */
    private function createResponse(CurlResponse $response, string $originalUrl): HttpResponse
    {
        return new HttpResponse(
            originalUrl: $originalUrl,
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
