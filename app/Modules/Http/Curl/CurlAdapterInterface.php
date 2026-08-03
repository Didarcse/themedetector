<?php

declare(strict_types=1);

namespace App\Modules\Http\Curl;

/**
 * Abstraction over PHP native cURL functions.
 *
 * The adapter isolates all direct interaction with the cURL extension.
 * CurlHttpClient must never call curl_*() functions directly; instead,
 * it communicates exclusively through this interface. This allows the
 * HTTP layer to be fully unit-testable without depending on the native
 * cURL extension or network access.
 *
 * Responsibilities:
 *
 * - Execute one HTTP GET request against the given URL.
 * - Return the raw cURL exchange as an immutable CurlResponse.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure transport
 *   abstraction. It knows nothing about HttpResponse, detection, theme
 *   extraction, plugin detection, or any concrete technology (WordPress,
 *   Joomla, Drupal, Ghost, TYPO3, etc.).
 * - Dependency Inversion Principle: consumers depend on this abstraction
 *   rather than on the native cURL extension directly.
 * - The adapter is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 */
interface CurlAdapterInterface
{
    /**
     * Execute a single HTTP GET request and return the raw exchange.
     *
     * @param string $url      The absolute URL to request.
     * @param int    $timeout  The total request timeout in seconds.
     * @param string $userAgent The user agent to send with the request.
     *
     * @return CurlResponse The immutable raw cURL exchange.
     */
    public function execute(string $url, int $timeout, string $userAgent): CurlResponse;
}
