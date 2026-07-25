<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Lightweight PHP view renderer.
 */
final class View
{
    public function __construct(
        private readonly string $viewsPath,
    ) {}

    public function render(string $view, array $data = []): string
    {
        $path = $this->viewsPath
            . DIRECTORY_SEPARATOR
            . str_replace('.', DIRECTORY_SEPARATOR, $view)
            . '.php';

        if (!is_file($path)) {
            throw new RuntimeException("View [{$view}] not found at [{$path}].");
        }

        extract($data, EXTR_SKIP);

        ob_start();

        include $path;

        return (string) ob_get_clean();
    }
}
