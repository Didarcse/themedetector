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
}
