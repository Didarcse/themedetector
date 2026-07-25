<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable value object representing application configuration.
 */
final class Config
{
    private const MISSING = "\0missing";

    /** @var array<string, mixed> */
    private readonly array $items;

    /** @param array<string, mixed> $items */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /** @return array<string, mixed> */
    public function all(): array
    {
        return $this->items;
    }

    public function has(string $key): bool
    {
        return $this->traverse($key) !== self::MISSING;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $result = $this->traverse($key);

        return $result === self::MISSING ? $default : $result;
    }

    /** @return mixed */
    private function traverse(string $key): mixed
    {
        $segments = explode('.', $key);
        $current = $this->items;

        foreach ($segments as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return self::MISSING;
            }

            $current = $current[$segment];
        }

        return $current;
    }
}
