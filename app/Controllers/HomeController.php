<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Default application controller.
 */
final class HomeController
{
    public function __invoke(): string
    {
        return 'Welcome to ThemeDetectorTool v2';
    }
}
