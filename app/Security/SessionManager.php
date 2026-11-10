<?php

declare(strict_types=1);

namespace App\Security;

use RuntimeException;

/**
 * Configures, starts, and closes the application's PHP session.
 *
 * Security defaults are applied before the session starts: strict mode,
 * cookies only, no URL session IDs, HttpOnly, SameSite=Lax, and a Secure
 * cookie whenever the request is genuinely HTTPS. A new anonymous session
 * rotates its identifier once, which mitigates session fixation. Startup
 * and persistence failures fail closed with a RuntimeException.
 */
final class SessionManager
{
    public const COOKIE_NAME = 'TD_SESSION';

    public function __construct(
        private readonly SessionDriverInterface $driver,
        private readonly string $savePath,
        private readonly bool $secure,
    ) {
    }

    /**
     * Return the session INI options applied before session_start().
     *
     * @return array<string, string>
     */
    public static function options(bool $secure): array
    {
        return [
            'session.use_strict_mode' => '1',
            'session.use_only_cookies' => '1',
            'session.use_trans_sid' => '0',
            'session.cookie_httponly' => '1',
            'session.cookie_samesite' => 'Lax',
            'session.cookie_secure' => $secure ? '1' : '0',
            'session.cookie_path' => '/',
            'session.cookie_domain' => '',
            'session.sid_length' => '48',
            'session.sid_bits_per_character' => '6',
            'session.gc_maxlifetime' => '1440',
            'session.lazy_write' => '1',
        ];
    }

    public function start(): void
    {
        if ($this->driver->isActive()) {
            return;
        }

        if ($this->driver->headersSent()) {
            throw new RuntimeException('Cannot start the session after output has been sent.');
        }

        $this->ensureStorageDirectory();

        $isNewSession = !$this->driver->hasSessionCookie(self::COOKIE_NAME);

        if (!$this->driver->start(self::options($this->secure), self::COOKIE_NAME, $this->savePath)) {
            throw new RuntimeException('Unable to start the session.');
        }

        if ($isNewSession && !$this->driver->regenerateId(true)) {
            throw new RuntimeException('Unable to establish a fresh session identifier.');
        }
    }

    public function get(string $key): mixed
    {
        $this->start();

        return $this->driver->get($key);
    }

    public function set(string $key, mixed $value): void
    {
        $this->start();
        $this->driver->set($key, $value);
    }

    public function remove(string $key): void
    {
        $this->start();
        $this->driver->remove($key);
    }

    public function close(): void
    {
        if (!$this->driver->isActive()) {
            return;
        }

        if (!$this->driver->close()) {
            throw new RuntimeException('Unable to persist the session.');
        }
    }

    private function ensureStorageDirectory(): void
    {
        if (is_dir($this->savePath)) {
            if (!is_writable($this->savePath)) {
                throw new RuntimeException('The session storage directory is not writable.');
            }

            return;
        }

        if (!@mkdir($this->savePath, 0700, true) && !is_dir($this->savePath)) {
            throw new RuntimeException('Unable to create the session storage directory.');
        }
    }
}
