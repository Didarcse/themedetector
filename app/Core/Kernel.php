<?php

declare(strict_types=1);

namespace App\Core;

use Core\Dispatcher;
use Core\Request;
use Core\Response;
use Core\Router;

/**
 * Handles the HTTP request lifecycle.
 */
final class Kernel
{
    public function __construct(
        private readonly Router $router,
        private readonly Dispatcher $dispatcher,
        private readonly ExceptionHandler $exceptionHandler,
    ) {}

    public function handle(Request $request): Response
    {
        try {
            $route = $this->router->match($request);

            if ($route === null) {
                return new Response(
                    content: '404 Not Found',
                    status: 404,
                );
            }

            return $this->dispatcher->dispatch($route);
        } catch (\Throwable $exception) {
            return $this->exceptionHandler->render($exception);
        }
    }
}
