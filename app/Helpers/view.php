<?php

declare(strict_types=1);

use App\Core\View;
use App\Security\CsrfTokenManager;

/**
 * @param array<string, mixed> $data
 */
function view(string $view, array $data = [], ?string $layout = null): string
{
    return app()->make(View::class)->render($view, $data, $layout);
}

/**
 * Return the current session's CSRF token, generating it on first use.
 */
function csrf_token(): string
{
    return app()->make(CsrfTokenManager::class)->token();
}

/**
 * Render the hidden CSRF form field.
 */
function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="'
        . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8')
        . '">';
}
