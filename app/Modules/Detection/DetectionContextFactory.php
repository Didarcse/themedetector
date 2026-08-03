<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use App\Modules\Http\HttpResponse;

/**
 * Factory for creating immutable DetectionContext objects from
 * HttpResponse instances.
 *
 * This class bridges the HTTP Infrastructure layer and the Detection
 * Engine. It converts transport-layer responses into the DetectionContext
 * objects consumed by DetectionManager. It performs object mapping only.
 *
 * Responsibilities:
 *
 * - Convert an immutable HttpResponse into an immutable DetectionContext.
 * - Preserve the original URL, final URL, HTML body, and status code
 *   across the conversion.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure mapper. It performs
 *   no HTTP requests, no HTML parsing, no HTML normalization, and no CMS
 *   detection.
 * - The factory is stateless, deterministic, and side-effect free. Given
 *   the same HttpResponse it always produces the same DetectionContext.
 * - It knows nothing about WordPress, Joomla, Drupal, Ghost, TYPO3, theme
 *   extraction, or plugin detection.
 */
final readonly class DetectionContextFactory
{
    /**
     * Convert an HttpResponse into a DetectionContext.
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
