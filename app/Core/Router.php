<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * In-memory route registry with exact URI and method matching.
 */
final class Router
{
    /** @var array<string, array<string, Route>> */
    private array $routes = [];

    /**
     * @param \Closure|array{0: class-string, 1: string}|string $handler
     */
    public function get(string $uri, callable|array|string $handler): void
    {
        $this->add('GET', $uri, $handler);
    }

    /**
     * @param \Closure|array{0: class-string, 1: string}|string $handler
     */
    public function post(string $uri, callable|array|string $handler): void
    {
        $this->add('POST', $uri, $handler);
    }

    /**
     * @param \Closure|array{0: class-string, 1: string}|string $handler
     */
    public function add(string $method, string $uri, callable|array|string $handler): void
    {
        $route = new Route($method, $uri, $handler);

        $normalizedMethod = $route->method();
        $normalizedUri = $route->uri();

        if (isset($this->routes[$normalizedMethod][$normalizedUri])) {
            throw new RuntimeException(
                "Route [{$normalizedMethod}] [{$normalizedUri}] is already registered."
            );
        }

        $this->routes[$normalizedMethod][$normalizedUri] = $route;
    }

    public function match(Request $request): ?Route
    {
        return $this->routes[$request->method()][$request->uri()] ?? null;
    }

    /** @return array<string, array<string, Route>> */
    public function all(): array
    {
        return $this->routes;
    }
}
