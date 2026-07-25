<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Executes a matched route and returns an HTTP response.
 */
final class Dispatcher
{
    public function __construct(
        private readonly Container $container,
    ) {}

    public function dispatch(Route $route): Response
    {
        $handler = $route->handler();

        if (is_array($handler)) {
            return $this->dispatchArray($handler);
        }

        if (is_string($handler)) {
            return $this->dispatchController($handler);
        }

        if (is_callable($handler)) {
            return $this->dispatchCallable($handler);
        }

        throw new RuntimeException('Invalid handler type.');
    }

    private function dispatchCallable(callable $handler): Response
    {
        $result = $handler();

        return $this->wrapResult($result);
    }

    private function dispatchArray(array $handler): Response
    {
        if (count($handler) !== 2) {
            throw new RuntimeException('Controller array handler must contain exactly two elements.');
        }

        $controllerClass = $handler[0];
        $method = $handler[1];

        if (!is_string($controllerClass) || !is_string($method)) {
            throw new RuntimeException('Invalid controller array handler.');
        }

        $controller = $this->resolveController($controllerClass);

        if (!method_exists($controller, $method)) {
            throw new RuntimeException(
                "Method [{$method}] does not exist on controller [{$controllerClass}]."
            );
        }

        $result = $controller->$method();

        return $this->wrapResult($result);
    }

    private function dispatchController(string $class): Response
    {
        $controller = $this->resolveController($class);

        if (!method_exists($controller, '__invoke')) {
            throw new RuntimeException(
                "Controller [{$class}] does not implement __invoke()."
            );
        }

        $result = $controller();

        return $this->wrapResult($result);
    }

    private function resolveController(string $class): object
    {
        try {
            return $this->container->make($class);
        } catch (RuntimeException $e) {
            throw new RuntimeException(
                "Cannot resolve controller [{$class}]: {$e->getMessage()}.",
                previous: $e,
            );
        }
    }

    private function wrapResult(mixed $result): Response
    {
        if ($result instanceof Response) {
            return $result;
        }

        if (is_string($result)) {
            return new Response(content: $result);
        }

        throw new RuntimeException(
            'Dispatcher may only return a Response or a string.'
        );
    }
}
