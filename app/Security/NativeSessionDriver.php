<?php

declare(strict_types=1);

namespace App\Security;

/**
 * Native PHP session implementation of SessionDriverInterface.
 */
final class NativeSessionDriver implements SessionDriverInterface
{
    public function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public function hasSessionCookie(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    public function headersSent(): bool
    {
        return headers_sent();
    }

    /**
     * @param array<string, string> $options
     */
    public function start(array $options, string $name, string $savePath): bool
    {
        foreach ($options as $key => $value) {
            if (ini_set($key, $value) === false) {
                return false;
            }
        }

        session_save_path($savePath);
        session_name($name);

        return session_start();
    }

    public function regenerateId(bool $deleteOld): bool
    {
        return session_regenerate_id($deleteOld);
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function close(): bool
    {
        return session_write_close();
    }
}
