<?php

declare(strict_types=1);

namespace App\Api;

/**
 * Immutable value object describing the outcome of a rate-limit check.
 *
 * RateLimitResult carries everything a consumer needs to enforce a
 * rate limit: whether the request was allowed, the configured limit, the
 * remaining allowance, and — when denied — how many seconds to wait
 * before retrying.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a single rate-limit consumption.
 * - Carry the limit, remaining allowance, and retry-after value.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores rate-limit data only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class RateLimitResult
{
    /**
     * Create a rate-limit result.
     *
     * @param bool $allowed            Whether the request was allowed.
     * @param int  $limit              The configured request limit.
     * @param int  $remaining          The remaining allowance in the window.
     * @param int  $retryAfterSeconds  Seconds until the window resets, 0
     *                                 when the request was allowed.
     */
    public function __construct(
        private bool $allowed,
        private int $limit,
        private int $remaining,
        private int $retryAfterSeconds = 0,
    ) {
    }

    /**
     * Return whether the request was allowed.
     *
     * @return bool True when the request did not exceed the limit.
     */
    public function allowed(): bool
    {
        return $this->allowed;
    }

    /**
     * Return the configured request limit.
     *
     * @return int The request limit per window.
     */
    public function limit(): int
    {
        return $this->limit;
    }

    /**
     * Return the remaining allowance in the current window.
     *
     * @return int The remaining requests, never negative.
     */
    public function remaining(): int
    {
        return $this->remaining;
    }

    /**
     * Return the number of seconds until the window resets.
     *
     * @return int The retry-after value in seconds, 0 when allowed.
     */
    public function retryAfterSeconds(): int
    {
        return $this->retryAfterSeconds;
    }
}
