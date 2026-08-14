<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;

/**
 * Offline HTTP client used by the Detection Benchmark Suite.
 *
 * OfflineHttpClient replaces the real network transport inside the
 * benchmark harness. It serves the fixture responses seeded for the
 * current benchmark case and answers every other request with an empty
 * HTTP 404, so a benchmark run can never perform a real network request.
 * Every requested URL is recorded for inspection.
 *
 * Responsibilities:
 *
 * - Serve the fixture responses seeded for the current benchmark case.
 * - Answer unknown requests with an empty HTTP 404 response.
 * - Record every requested URL in request order.
 *
 * Design philosophy:
 *
 * - No network I/O: get() is fully overridden and never delegates to the
 *   parent cURL implementation, so no request can ever reach the network.
 * - Deterministic: given the same seeded responses, the client always
 *   produces the same responses.
 * - Stateless apart from the seeded responses and the request log.
 */
final class OfflineHttpClient extends HttpClient implements HttpClientInterface
{
    /** @var array<string, string> */
    private array $responses = [];

    /** @var list<string> */
    private array $requestedUrls = [];

    /**
     * Seed the fixture responses for the current benchmark case.
     *
     * @param array<string, string> $responses The response bodies keyed by
     *                                         absolute request URL.
     */
    public function seed(array $responses): void
    {
        $this->responses = $responses;
    }

    /**
     * Return every URL requested since the last seed.
     *
     * @return list<string> The requested URLs in request order.
     */
    public function requestedUrls(): array
    {
        return $this->requestedUrls;
    }

    /**
     * Serve a seeded fixture response, or a 404 for unknown URLs.
     *
     * The request is recorded before the response is assembled. Unknown
     * URLs receive an empty HTTP 404 response so that transport-failure
     * handling follows the same shape as a real 404 from the network.
     *
     * @param string $url The absolute URL to request.
     *
     * @return HttpResponse The seeded response, or an empty HTTP 404
     *                      response when the URL is not part of the
     *                      fixture.
     */
    public function get(string $url): HttpResponse
    {
        $this->requestedUrls[] = $url;

        $body = $this->responses[$url] ?? null;

        if ($body === null) {
            return new HttpResponse($url, $url, 404, [], '');
        }

        return new HttpResponse($url, $url, 200, $this->headersFor($url), $body);
    }

    /**
     * Build the response headers for a seeded fixture response.
     *
     * JSON endpoints receive an application/json content type so that
     * rules requiring it (for example the Shopify cart endpoint) can be
     * exercised; everything else is served as plain text.
     *
     * @param string $url The request URL.
     *
     * @return array<string, list<string>> The response headers.
     */
    private function headersFor(string $url): array
    {
        if (str_contains($url, '/wp-json/') || str_ends_with($url, '.json') || str_ends_with($url, '.js')) {
            return ['Content-Type' => ['application/json; charset=UTF-8']];
        }

        return ['Content-Type' => ['text/plain; charset=UTF-8']];
    }
}
