<?php

declare(strict_types=1);

namespace App\Security;

/**
 * Thin abstraction over PHP's native session functions.
 *
 * The interface exists so SessionManager can be exercised deterministically
 * (startup failures, persistence failures, fixation behaviour) without
 * touching the real PHP session store in unit tests.
 */
interface SessionDriverInterface
{
    public function isActive(): bool;

    public function hasSessionCookie(string $name): bool;

    public function headersSent(): bool;

    /**
     * @param array<string, string> $options The session INI options.
     */
    public function start(array $options, string $name, string $savePath): bool;

    public function regenerateId(bool $deleteOld): bool;

    public function get(string $key): mixed;

    public function set(string $key, mixed $value): void;

    public function remove(string $key): void;

    public function close(): bool;
}
