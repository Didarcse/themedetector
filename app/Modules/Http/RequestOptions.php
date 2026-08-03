<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Immutable HTTP request options value object.
 *
 * Contains every configurable option required by an
 * HttpClientInterface implementation. Future options — such as proxy,
 * cookies, custom headers, or authentication — can be added here without
 * changing the HttpClientInterface contract.
 *
 * Current options:
 *
 * - timeout: total request timeout in seconds.
 * - connectTimeout: connection timeout in seconds.
 * - userAgent: the user agent sent with the request.
 * - followRedirects: whether redirects are followed.
 * - maxRedirects: the maximum number of redirects to follow.
 *
 * Responsibilities:
 *
 * - Store HTTP request configuration.
 * - Expose the stored configuration through immutable read-only
 *   accessors.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure Value Object. It
 *   stores configuration only and performs no HTTP requests, no
 *   validation, and no business logic.
 * - The object is immutable, stateless, deterministic, and side-effect
 *   free. Once constructed, its state cannot be altered.
 * - It knows nothing about detection, theme extraction, plugin detection,
 *   or any concrete technology (WordPress, Joomla, Drupal, Ghost, TYPO3,
 *   etc.).
 */
final readonly class RequestOptions
{
    /**
     * Create an immutable set of HTTP request options.
     *
     * @param int    $timeout         Total request timeout in seconds.
     * @param int    $connectTimeout  Connection timeout in seconds.
     * @param string $userAgent       The user agent sent with the request.
     * @param bool   $followRedirects Whether redirects are followed.
     * @param int    $maxRedirects    The maximum number of redirects to
     *                                follow.
     */
    public function __construct(
        private int $timeout = 15,
        private int $connectTimeout = 5,
        private string $userAgent = 'ThemeDetectorTool/2.0',
        private bool $followRedirects = true,
        private int $maxRedirects = 10,
    ) {
    }

    /**
     * Return the total request timeout in seconds.
     */
    public function timeout(): int
    {
        return $this->timeout;
    }

    /**
     * Return the connection timeout in seconds.
     */
    public function connectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * Return the user agent sent with the request.
     */
    public function userAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Return whether redirects are followed.
     */
    public function followRedirects(): bool
    {
        return $this->followRedirects;
    }

    /**
     * Return the maximum number of redirects to follow.
     */
    public function maxRedirects(): int
    {
        return $this->maxRedirects;
    }
}
