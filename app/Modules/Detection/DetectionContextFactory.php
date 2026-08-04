<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use App\Modules\Http\HttpResponse;

/**
 * Creates immutable DetectionContext instances from HttpResponse objects.
 *
 * DetectionContextFactory centralizes all DetectionContext creation and
 * acts as the single translation layer between the HTTP module and the
 * Detection Engine. It performs object creation only.
 *
 * Responsibilities:
 *
 * - Create DetectionContext objects from HttpResponse instances.
 * - Preserve the original URL, final URL, HTML body, and status code
 *   across the translation.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Value Object creation: the produced context is immutable.
 * - Single Responsibility Principle: a pure translation layer. It performs
 *   no HTTP requests, no CMS detection, no confidence calculation, and no
 *   HTML parsing.
 * - Dependency Injection friendly: stateless, side-effect free, and
 *   deterministic. Given the same response it always produces the same
 *   context.
 * - It knows nothing about WordPress, Joomla, Drupal, Ghost, TYPO3, theme
 *   extraction, or plugin detection.
 *
 * Future architecture:
 *
 * - Future versions may populate DetectionContext with headers, cookies,
 *   content type, redirect chain, response time, encoding, language, and
 *   TLS information.
 * - The factory must remain the only class that translates HttpResponse
 *   into DetectionContext; WebsiteDetector must never construct
 *   DetectionContext directly.
 */
readonly class DetectionContextFactory
{
    /**
     * Convert an HttpResponse into an immutable DetectionContext.
     *
     * Values are copied verbatim: no validation, modification, or
     * transformation is applied.
     *
     * @param HttpResponse $response The immutable HTTP response.
     *
     * @return DetectionContext The immutable detection context.
     */
    public function create(HttpResponse $response): DetectionContext
    {
        return new DetectionContext(
            originalUrl: $response->originalUrl(),
            finalUrl: $response->finalUrl(),
            html: $response->body(),
            statusCode: $response->statusCode(),
        );
    }
}
