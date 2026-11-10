<?php

declare(strict_types=1);

namespace App\Security;

/**
 * Issues and validates stable per-session synchronizer CSRF tokens.
 */
final class CsrfTokenManager
{
    public function __construct(
        private readonly CsrfTokenStoreInterface $store,
    ) {
    }

    /**
     * Return the current session token, generating it on first use.
     */
    public function token(): string
    {
        $token = $this->store->get();

        if ($token === null) {
            $token = bin2hex(random_bytes(32));
            $this->store->put($token);
        }

        return $token;
    }

    /**
     * Validate a submitted token in constant time.
     */
    public function validate(mixed $submitted): bool
    {
        $expected = $this->store->get();

        if ($expected === null || !is_string($submitted) || $submitted === '') {
            return false;
        }

        return hash_equals($expected, $submitted);
    }

    /**
     * Discard the current token so the next request issues a new one.
     *
     * Callers must also regenerate the session identifier when rotating a
     * token outside the initial anonymous-session establishment.
     */
    public function rotate(): void
    {
        $this->store->clear();
    }

    /**
     * Release the backing store lock before expensive work.
     */
    public function release(): void
    {
        $this->store->close();
    }
}
