<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Converts uncaught exceptions into safe HTTP responses.
 */
final class ExceptionHandler
{
    public function render(\Throwable $exception): Response
    {
        if ($exception instanceof RuntimeException) {
            return new Response(
                content: 'Internal Server Error',
                status: 500,
            );
        }

        return new Response(
            content: 'Unexpected Error',
            status: 500,
        );
    }
}
