<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Root application container holding base path and configuration.
 */
final class Application
{
    public function __construct(
        private readonly string $basePath,
        private readonly array $config = [],
    ) {}

    public function basePath(): string
    {
        return $this->basePath;
    }

    public function config(): array
    {
        return $this->config;
    }

    public function path(string $path = ''): string
    {
        return $this->basePath . ($path !== '' ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR . '/') : '');
    }

    public function configValue(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $key);
        $current = $this->config;

        foreach ($segments as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return $default;
            }

            $current = $current[$segment];
        }

        return $current;
    }
}
