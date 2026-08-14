<?php

declare(strict_types=1);

namespace App\Api;

use InvalidArgumentException;

/**
 * Immutable value object identifying an authenticated API client.
 *
 * ApiClientIdentity captures the tier a request belongs to and the stable
 * identifier the rate limiter keys it by. Anonymous requests are keyed by
 * the client IP address; keyed requests are keyed by the API key. The
 * identifier is hashed by the rate limiter before it touches the
 * filesystem, so the raw key is never persisted.
 *
 * Responsibilities:
 *
 * - Represent the authentication tier of a request.
 * - Carry the rate-limit identifier for the tier.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores identity data only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class ApiClientIdentity
{
    public const TIER_ANONYMOUS = 'anonymous';
    public const TIER_KEYED = 'keyed';

    private string $tier;
    private string $identifier;

    /**
     * Create a client identity.
     *
     * @param string $tier       The authentication tier, one of the TIER_
     *                           constants.
     * @param string $identifier The stable rate-limit identifier.
     */
    public function __construct(string $tier, string $identifier)
    {
        if ($tier !== self::TIER_ANONYMOUS && $tier !== self::TIER_KEYED) {
            throw new InvalidArgumentException(sprintf('Unknown API client tier "%s".', $tier));
        }

        $this->tier = $tier;
        $this->identifier = $identifier;
    }

    /**
     * Return the authentication tier.
     *
     * @return string The tier, one of the TIER_ constants.
     */
    public function tier(): string
    {
        return $this->tier;
    }

    /**
     * Return whether the client authenticated with an API key.
     *
     * @return bool True when the tier is keyed.
     */
    public function isKeyed(): bool
    {
        return $this->tier === self::TIER_KEYED;
    }

    /**
     * Return the stable rate-limit identifier.
     *
     * @return string The identifier, hashed before filesystem use.
     */
    public function identifier(): string
    {
        return $this->identifier;
    }
}
