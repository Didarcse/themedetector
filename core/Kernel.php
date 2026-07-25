<?php

declare(strict_types=1);

namespace Core;

/**
 * Handles the application lifecycle.
 */
final class Kernel
{
    public function __construct(
        private readonly Application $application,
        private readonly Router $router,
        private readonly Dispatcher $dispatcher,
    ) {}

    public function application(): Application
    {
        return $this->application;
    }

    public function handle(Request $request): Response
    {
        $route = $this->router->match($request);

        if ($route === null) {
            return new Response(
                content: '404 Not Found',
                status: 404,
            );
        }

        return $this->dispatcher->dispatch($route);
    }
}
