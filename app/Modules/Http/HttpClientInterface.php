<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Contract for every HTTP client implementation used by the
 * ThemeDetectorTool platform.
 *
 * The interface abstracts all outbound HTTP communication. It allows the
 * Detection Engine, Theme Extraction Engine, Plugin Detection Engine, and
 * future Website Intelligence modules to retrieve remote resources
 * without depending on a concrete HTTP implementation.
 *
 * Responsibilities:
 *
 * - Perform HTTP GET requests against a given absolute URL.
 * - Return the response as an immutable HttpResponse value object.
 * - Signal transport-level failures through HttpException.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the interface covers only outbound
 *   HTTP communication. It knows nothing about CMS detection, HTML
 *   parsing, theme extraction, or plugin extraction.
 * - Dependency Inversion Principle: consumers depend on this abstraction
 *   rather than on a concrete transport (cURL, Guzzle, sockets, etc.).
 * - Every implementation is stateless, deterministic, and side-effect
 *   free except for the network I/O inherent to performing a request.
 * - Every implementation must honour the same contract: given the same
 *   URL it produces the same shape of response, and it must never expose
 *   any technology-specific knowledge (WordPress, Joomla, Drupal, Ghost,
 *   TYPO3, etc.).
 */
interface HttpClientInterface
{
    /**
     * Send an HTTP GET request.
     *
     * @param string $url The absolute URL to request.
     *
     * @return HttpResponse The immutable HTTP response.
     *
     * @throws HttpException On invalid URL or transport-level failure.
     */
    public function get(string $url): HttpResponse;
}
