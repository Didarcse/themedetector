<?php

declare(strict_types=1);

namespace App\Modules\Http\Curl;

/**
 * Immutable raw transport result returned by a CurlAdapterInterface
 * implementation.
 *
 * Contains only transport-layer data produced by the native cURL adapter.
 * CurlHttpClient converts this object into an HttpResponse.
 *
 * Responsibilities:
 *
 * - Store the original and final URLs, status code, raw header region,
 *   and body of a raw cURL exchange.
 * - Expose the stored transport data through immutable read-only
 *   accessors.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure Value Object. It
 *   represents the raw transport layer only and performs no parsing, no
 *   validation, no normalization, and no transformation.
 * - The object is immutable, stateless, deterministic, and side-effect
 *   free. Once constructed, its state cannot be altered.
 * - It knows nothing about HttpResponse, detection, theme extraction,
 *   plugin detection, or any concrete technology (WordPress, Joomla,
 *   Drupal, Ghost, TYPO3, etc.).
 */
final readonly class CurlResponse
{
    /**
     * Create a raw transport-layer response value object.
     *
     * @param string $originalUrl The URL that was originally requested.
     * @param string $finalUrl    The URL of the final response after any
     *                            redirects.
     * @param int    $statusCode  The HTTP status code of the final
     *                            response.
     * @param string $rawHeaders  The raw header region of the cURL
     *                            exchange, verbatim and unparsed.
     * @param string $body        The response body, verbatim and
     *                            unmodified.
     */
    public function __construct(
        private string $originalUrl,
        private string $finalUrl,
        private int $statusCode,
        private string $rawHeaders,
        private string $body,
    ) {
    }

    /**
     * Return the URL that was originally requested.
     */
    public function originalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * Return the URL of the final response after any redirects.
     */
    public function finalUrl(): string
    {
        return $this->finalUrl;
    }

    /**
     * Return the HTTP status code of the final response.
     */
    public function statusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Return the raw header region of the cURL exchange.
     *
     * The header region is returned verbatim and unparsed. When redirects
     * are followed it may contain multiple header blocks separated by
     * blank lines; the consumer is responsible for selecting the final
     * block.
     */
    public function rawHeaders(): string
    {
        return $this->rawHeaders;
    }

    /**
     * Return the response body, verbatim and unmodified.
     */
    public function body(): string
    {
        return $this->body;
    }
}
