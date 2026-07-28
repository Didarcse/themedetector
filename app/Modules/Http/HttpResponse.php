<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Immutable HTTP response value object.
 *
 * Represents a complete HTTP response returned by an external service.
 * This object is fully immutable — once constructed, its state cannot be altered.
 */
final class HttpResponse
{
    /**
     * @param string          $body        Raw response body.
     * @param int             $status      HTTP status code.
     * @param array<string, string> $headers    Response headers keyed by name.
     * @param array<string, string> $cookies    Response cookies keyed by name.
     * @param string          $effectiveUrl Final URL after redirects.
     * @param float           $responseTime Total round-trip time in seconds.
     */
    public function __construct(
        private readonly string $body,
        private readonly int $status,
        private readonly array $headers,
        private readonly array $cookies,
        private readonly string $effectiveUrl,
        private readonly float $responseTime,
    ) {
    }

    public function body(): string
    {
        return $this->body;
    }

    public function status(): int
    {
        return $this->status;
    }

    /** @return array<string, string> */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Retrieve a single header value by name, case-insensitively.
     *
     * @return string|null The header value, or null if not present.
     */
    public function header(string $name): ?string
    {
        $lower = strtolower($name);

        foreach ($this->headers as $key => $value) {
            if (strtolower($key) === $lower) {
                return $value;
            }
        }

        return null;
    }

    /** @return array<string, string> */
    public function cookies(): array
    {
        return $this->cookies;
    }

    public function effectiveUrl(): string
    {
        return $this->effectiveUrl;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }
}
