<?php

declare(strict_types=1);

namespace App\Core;

use Core\Request;
use Core\Response;

/**
 * Contract for all HTTP middleware.
 */
interface MiddlewareInterface
{
    public function process(Request $request, callable $next): Response;
}
