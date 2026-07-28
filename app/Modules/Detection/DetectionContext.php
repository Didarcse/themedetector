<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Immutable HTTP response context used by every technology detector.
 *
 * Carries the full request/response lifecycle data — the original and
 * final URLs, the HTML body, status code, response headers, and
 * duration — so that every detector has uniform access to the same
 * information without performing its own HTTP requests.
 */
final class DetectionContext
{
    /**
     * @param string                           $originalUrl  The URL requested by the user.
     * @param string                           $finalUrl     The final URL after redirects.
     * @param string                           $html         The response body.
     * @param int                              $statusCode   HTTP response status.
     * @param array<string, string|string[]>   $headers      HTTP response headers.
     * @param float                            $responseTime Response duration in seconds.
     */
    public function __construct(
        private readonly string $originalUrl,
        private readonly string $finalUrl,
        private readonly string $html,
        private readonly int $statusCode,
        private readonly array $headers = [],
        private readonly float $responseTime = 0.0,
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

    public function html(): string
    {
        return $this->html;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, string|string[]>
     */
    public function headers(): array
    {
        return $this->headers;
    }

    public function responseTime(): float
    {
        return $this->responseTime;
    }

    /**
     * Returns true when the HTTP status code is between 200 and 299.
     */
    public function isSuccess(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode <= 299;
    }
}
