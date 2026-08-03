<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Immutable HTTP response value object.
 *
 * Represents a complete HTTP response returned by an HttpClientInterface
 * implementation. Contains the data required by the Detection Engine,
 * Theme Extraction Engine, Plugin Detection Engine, and future Website
 * Intelligence modules.
 *
 * Responsibilities:
 *
 * - Store the original and final URLs, status code, headers, and body of
 *   an HTTP response.
 * - Expose the stored data through read-only accessors.
 *
 * Design philosophy:
 *
 * - This is a pure Value Object: it contains data only and performs no
 *   business logic.
 * - The object is immutable, stateless, deterministic, and side-effect
 *   free. Once constructed, its state cannot be altered.
 * - No validation and no transformation are applied to the supplied
 *   data; headers are exposed exactly as received, keyed by name with
 *   each value as a list of the raw header values.
 */
final readonly class HttpResponse
{
    /**
     * @param array<string, list<string>> $headers Response headers keyed by name.
     */
    public function __construct(
        private string $originalUrl,
        private string $finalUrl,
        private int $statusCode,
        private array $headers,
        private string $body,
    ) {
    }

    public function originalUrl(): string
    {
        return $this->originalUrl;
    }

    public function finalUrl(): string
    {
        return $this->finalUrl;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, list<string>>
     */
    public function headers(): array
    {
        return $this->headers;
    }

    public function body(): string
    {
        return $this->body;
    }
}
