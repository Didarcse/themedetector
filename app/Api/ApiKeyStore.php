<?php

declare(strict_types=1);

namespace App\Api;

use App\Core\Environment;

/**
 * Immutable store of accepted API keys loaded from configuration.
 *
 * ApiKeyStore holds the set of API keys accepted by the public API. Keys
 * come exclusively from the environment/configuration (the API_KEYS or
 * API_KEY environment variables, typically provided through the git-ignored
 * .env file); they are never hard-coded, never read from the query string,
 * and never logged. Validation uses hash_equals so comparisons run in
 * constant time.
 *
 * Responsibilities:
 *
 * - Hold the configured set of accepted API keys.
 * - Validate candidate keys in constant time.
 * - Report whether a key is required at all.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Configuration source of truth: keys come only from the environment.
 * - Single Responsibility Principle: it stores and validates keys only.
 */
final readonly class ApiKeyStore
{
    /** @var list<string> */
    private array $keys;

    /**
     * Create a key store.
     *
     * @param array<int|string, string> $keys The accepted keys.
     */
    public function __construct(array $keys)
    {
        $normalized = [];

        foreach ($keys as $key) {
            $key = trim($key);

            if ($key !== '') {
                $normalized[$key] = $key;
            }
        }

        $this->keys = array_values($normalized);
    }

    /**
     * Load the accepted keys from the environment.
     *
     * Reads the comma-separated API_KEYS variable first and falls back to
     * the single API_KEY variable. When neither is set the store holds no
     * keys and the API runs in its open, per-IP-limited tier.
     *
     * @return self The key store populated from the environment.
     */
    public static function fromEnvironment(): self
    {
        $keys = [];

        $bulk = Environment::get('API_KEYS');

        if (is_string($bulk) && $bulk !== '') {
            foreach (explode(',', $bulk) as $part) {
                $keys[] = trim($part);
            }
        }

        $single = Environment::get('API_KEY');

        if (is_string($single) && $single !== '') {
            $keys[] = trim($single);
        }

        return new self($keys);
    }

    /**
     * Return whether any API key is configured.
     *
     * @return bool True when at least one key is accepted.
     */
    public function hasKeys(): bool
    {
        return $this->keys !== [];
    }

    /**
     * Validate a candidate key in constant time.
     *
     * @param string $candidate The key supplied by the caller.
     *
     * @return bool True when the candidate matches an accepted key.
     */
    public function validate(string $candidate): bool
    {
        foreach ($this->keys as $key) {
            if (hash_equals($key, $candidate)) {
                return true;
            }
        }

        return false;
    }
}
