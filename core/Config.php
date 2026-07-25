<?php

declare(strict_types=1);

namespace Core;

/**
 * Immutable value object representing application configuration.
 */
final class Config
{
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
        return $this->exists($key);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->resolve($key);

        return $value !== null ? $value : $default;
    }

    private function exists(string $key): bool
    {
        $segments = explode('.', $key);
        $current = $this->items;

        foreach ($segments as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return false;
            }

            $current = $current[$segment];
        }

        return true;
    }

    private function resolve(string $key): mixed
    {
        $segments = explode('.', $key);
        $current = $this->items;

        foreach ($segments as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return null;
            }

            $current = $current[$segment];
        }

        return $current;
    }
}
