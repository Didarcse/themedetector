<?php

declare(strict_types=1);

use App\Core\View;

/**
 * @param array<string, mixed> $data
 */
function view(string $view, array $data = [], ?string $layout = null): string
{
    return app()->make(View::class)->render($view, $data, $layout);
}
