<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

/**
 * Immutable value object representing the website that was analysed.
 *
 * WebsiteInformation carries the transport-level facts of the analysed
 * website: the normalized submitted URL, the final URL after redirects, and
 * the HTTP status code returned by the target. It knows nothing about
 * detection, themes, or plugins.
 *
 * Responsibilities:
 *
 * - Represent the analysed website's identity and transport outcome.
 * - Carry the URL, final URL, and HTTP status code.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores website information only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class WebsiteInformation
{
    /**
     * Create a website information instance.
     *
     * @param string $url        The normalized analysed URL.
     * @param string $finalUrl   The final URL after redirects, empty when the
     *                           analysis failed before the website could be
     *                           reached.
     * @param int    $statusCode The analysed website's HTTP status code, 0
     *                           when the analysis failed.
     */
    public function __construct(
        private string $url,
        private string $finalUrl,
        private int $statusCode,
    ) {
    }

    /**
     * Return the normalized analysed URL.
     *
     * @return string The normalized URL, empty when the URL was invalid.
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Return the final URL after redirects.
     *
     * @return string The final URL, empty when the analysis failed.
     */
    public function finalUrl(): string
    {
        return $this->finalUrl;
    }

    /**
     * Return the analysed website's HTTP status code.
     *
     * @return int The HTTP status code, 0 when the analysis failed.
     */
    public function statusCode(): int
    {
        return $this->statusCode;
    }
}
