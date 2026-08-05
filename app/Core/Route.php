<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable representation of a single registered route.
 */
final class Route
{
    private readonly string $method;
    private readonly string $uri;
    /** @var \Closure|array{0: class-string, 1: string}|string */
    private readonly mixed $handler;

    /**
     * @param \Closure|array{0: class-string, 1: string}|string $handler
     */
    public function __construct(
        string $method,
        string $uri,
        callable|array|string $handler,
    ) {
        if (trim($uri) === '') {
            throw new \InvalidArgumentException('Route URI must not be empty.');
        }

        $this->method = strtoupper($method);
        $this->uri = '/' . ltrim(trim($uri), '/');
        $this->handler = $handler;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    /** @return \Closure|array{0: class-string, 1: string}|string */
    public function handler(): callable|array|string
    {
        return $this->handler;
    }
}
