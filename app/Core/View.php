<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Lightweight PHP view renderer with layout support.
 */
final class View
{
    public function __construct(
        private readonly string $viewsPath,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function render(string $view, array $data = [], ?string $layout = null): string
    {
        $content = $this->renderFile($this->resolvePath($view), $data);

        if ($layout === null) {
            return $content;
        }

        return $this->renderFile(
            $this->resolvePath($layout),
            array_merge($data, ['content' => $content]),
        );
    }

    /**
     * @param array<string, mixed> $data
     */
    private function renderFile(string $path, array $data): string
    {
        if (!is_file($path)) {
            throw new RuntimeException("View not found at [{$path}].");
        }

        extract($data, EXTR_SKIP);

        ob_start();

        try {
            include $path;

            return (string) ob_get_clean();
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }
    }

    private function resolvePath(string $view): string
    {
        return $this->viewsPath
            . DIRECTORY_SEPARATOR
            . str_replace('.', DIRECTORY_SEPARATOR, $view)
            . '.php';
    }
}
