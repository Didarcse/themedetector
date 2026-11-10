<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Security\SessionDriverInterface;

/**
 * Deterministic session driver double for SessionManager unit tests.
 */
final class FakeSessionDriver implements SessionDriverInterface
{
    public bool $active = false;

    public bool $cookiePresent = false;

    public bool $headersSent = false;

    public bool $startResult = true;

    public bool $regenerateResult = true;

    public bool $closeResult = true;

    public int $startCount = 0;

    public int $regenerateCount = 0;

    public int $closeCount = 0;

    /** @var array<string, string> */
    public array $options = [];

    public string $name = '';

    public string $savePath = '';

    /** @var array<string, mixed> */
    private array $data = [];

    public function isActive(): bool
    {
        return $this->active;
    }

    public function hasSessionCookie(string $name): bool
    {
        return $this->cookiePresent;
    }

    public function headersSent(): bool
    {
        return $this->headersSent;
    }

    /**
     * @param array<string, string> $options
     */
    public function start(array $options, string $name, string $savePath): bool
    {
        ++$this->startCount;
        $this->options = $options;
        $this->name = $name;
        $this->savePath = $savePath;

        if (!$this->startResult) {
            return false;
        }

        $this->active = true;

        return true;
    }

    public function regenerateId(bool $deleteOld): bool
    {
        ++$this->regenerateCount;

        return $this->regenerateResult;
    }

    public function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function remove(string $key): void
    {
        unset($this->data[$key]);
    }

    public function close(): bool
    {
        ++$this->closeCount;

        if (!$this->closeResult) {
            return false;
        }

        $this->active = false;

        return true;
    }
}
