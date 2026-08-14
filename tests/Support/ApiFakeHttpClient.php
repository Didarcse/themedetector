<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;

/**
 * Offline HTTP client used by the public API integration tests.
 *
 * ApiFakeHttpClient replaces the real network transport inside the API
 * integration harness. It serves a homepage document and a stylesheet, and
 * answers every other request with the homepage document, so the detection
 * pipeline produces the exact same report on every run. Every requested
 * URL is recorded in request order for inspection (for example to prove a
 * cache hit).
 *
 * Responsibilities:
 *
 * - Serve the fixture homepage and stylesheet for the current test.
 * - Record every requested URL in request order.
 *
 * Design philosophy:
 *
 * - No network I/O: get() is fully self-contained, so no request can ever
 *   reach the network.
 * - Deterministic: given the same fixtures, the client always produces the
 *   same responses.
 * - Stateless apart from the fixtures and the request log.
 */
final class ApiFakeHttpClient implements HttpClientInterface
{
    /** @var list<string> */
    private array $requestedUrls = [];

    public function __construct(
        private string $homepageHtml,
        private string $stylesheetCss,
    ) {
    }

    /**
     * Serve a fixture response without performing any network I/O.
     *
     * URLs containing "style.css" receive the stylesheet fixture; every
     * other URL receives the homepage fixture, mirroring the behaviour of
     * the web-page integration tests.
     *
     * @param string $url The absolute URL to request.
     *
     * @return HttpResponse The fixture response.
     */
    public function get(string $url): HttpResponse
    {
        $this->requestedUrls[] = $url;

        if (str_contains($url, 'style.css')) {
            return $this->response($url, $this->stylesheetCss);
        }

        return $this->response($url, $this->homepageHtml);
    }

    /**
     * Return every URL requested so far.
     *
     * @return list<string> The requested URLs in request order.
     */
    public function requestedUrls(): array
    {
        return $this->requestedUrls;
    }

    /**
     * Build an immutable HTTP 200 fixture response.
     *
     * @param string $url  The request URL.
     * @param string $body The response body.
     *
     * @return HttpResponse The response.
     */
    private function response(string $url, string $body): HttpResponse
    {
        return new HttpResponse(
            originalUrl: $url,
            finalUrl: $url,
            statusCode: 200,
            headers: [],
            body: $body,
        );
    }
}
