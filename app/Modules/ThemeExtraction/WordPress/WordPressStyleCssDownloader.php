<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;

/**
 * Downloads the raw contents of a WordPress theme stylesheet.
 *
 * WordPressStyleCssDownloader is an HTTP adapter responsible only for
 * retrieving the raw style.css contents from a given stylesheet URL. It
 * performs exactly one HTTP GET request through the injected
 * HttpClientInterface and returns the response body on success.
 *
 * Responsibilities:
 *
 * - Perform a single HTTP GET request against the given stylesheet URL.
 * - Return the response body when the request succeeds with HTTP 200.
 * - Return null when the request fails or the response is not HTTP 200.
 *
 * Design philosophy:
 *
 * - HTTP Adapter: it is the thin network boundary of the WordPress theme
 *   extraction pipeline; all outbound traffic flows through it.
 * - Dependency Injection: the transport is injected as
 *   HttpClientInterface, so the downloader never depends on a concrete
 *   HTTP implementation and remains fully testable.
 * - Single Responsibility Principle: downloading the stylesheet is the
 *   only concern. It performs no HTML parsing, no CSS parsing, no theme
 *   locating, no metadata extraction, no confidence calculation, and no
 *   WordPress business logic.
 * - Stateless, deterministic, and side-effect free except for the
 *   delegated HTTP request: given the same stylesheet URL and HTTP layer,
 *   it always produces the same outcome.
 * - Transport failures never escape: an HttpException raised by the HTTP
 *   layer is converted into a null result, so consumers only ever observe
 *   a string or null.
 */
final readonly class WordPressStyleCssDownloader
{
    /**
     * Create a new WordPressStyleCssDownloader.
     *
     * @param HttpClientInterface $httpClient The HTTP client used to
     *                                        perform the stylesheet
     *                                        download.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    /**
     * Download the contents of the given stylesheet URL.
     *
     * Performs exactly one HTTP GET request. When the response status is
     * HTTP 200, the response body is returned; otherwise null is returned.
     * Transport-level failures raised by the HTTP layer are caught and
     * converted into a null result and are never rethrown. The stylesheet
     * is never parsed or inspected.
     *
     * @param string $styleCssUrl The stylesheet URL to download.
     *
     * @return string|null The raw style.css contents, or null when the
     *                     request fails or the response is not HTTP 200.
     */
    public function download(string $styleCssUrl): ?string
    {
        try {
            $response = $this->httpClient->get($styleCssUrl);
        } catch (HttpException) {
            return null;
        }

        if ($response->statusCode() !== 200) {
            return null;
        }

        return $response->body();
    }
}
