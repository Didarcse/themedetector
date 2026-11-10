<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Security\CsrfTokenStoreInterface;

/**
 * Deterministic in-memory token store used by tests instead of PHP sessions.
 */
final class InMemoryCsrfTokenStore implements CsrfTokenStoreInterface
{
    private ?string $token = null;

    private int $closeCount = 0;

    public function get(): ?string
    {
        return $this->token;
    }

    public function put(string $token): void
    {
        $this->token = $token;
    }

    public function clear(): void
    {
        $this->token = null;
    }

    public function close(): void
    {
        ++$this->closeCount;
    }

    public function closeCount(): int
    {
        return $this->closeCount;
    }
}
