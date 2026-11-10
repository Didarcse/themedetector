<?php

declare(strict_types=1);

namespace App\Security;

/**
 * Persistence abstraction for the synchronizer CSRF token.
 *
 * Production uses the PHP session; tests can supply an in-memory store so
 * no real session is started.
 */
interface CsrfTokenStoreInterface
{
    public function get(): ?string;

    public function put(string $token): void;

    public function clear(): void;

    /**
     * Release the backing store's lock, if any.
     */
    public function close(): void;
}
