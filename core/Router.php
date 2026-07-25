<?php

declare(strict_types=1);

namespace Core;

/**
 * In-memory route registry with exact URI and method matching.
 */
final class Router
{
    /** @var array<string, array<string, Route>> */
    private array $routes = [];

    public function get(string $uri, callable|array|string $handler): void
    {
        $this->add('GET', $uri, $handler);
    }

    public function post(string $uri, callable|array|string $handler): void
    {
        $this->add('POST', $uri, $handler);
    }

    public function add(string $method, string $uri, callable|array|string $handler): void
    {
        $route = new Route($method, $uri, $handler);

        $this->routes[$route->method()][$route->uri()] = $route;
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
