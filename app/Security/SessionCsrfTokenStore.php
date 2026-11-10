<?php

declare(strict_types=1);

namespace App\Security;

/**
 * Stores the CSRF token in the PHP session.
 *
 * The token is cached in memory so views can still render it after the
 * session lock has been released with close().
 */
final class SessionCsrfTokenStore implements CsrfTokenStoreInterface
{
    private const SESSION_KEY = '_csrf_token';

    private ?string $token = null;

    private bool $loaded = false;

    public function __construct(
        private readonly SessionManager $session,
    ) {
    }

    public function get(): ?string
    {
        if (!$this->loaded) {
            $value = $this->session->get(self::SESSION_KEY);
            $this->token = is_string($value) && $value !== '' ? $value : null;
            $this->loaded = true;
        }

        return $this->token;
    }

    public function put(string $token): void
    {
        $this->session->set(self::SESSION_KEY, $token);
        $this->token = $token;
        $this->loaded = true;
    }

    public function clear(): void
    {
        $this->session->remove(self::SESSION_KEY);
        $this->token = null;
        $this->loaded = true;
    }

    public function close(): void
    {
        $this->session->close();
    }
}
