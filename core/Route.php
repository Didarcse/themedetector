<?php

declare(strict_types=1);

namespace Core;

/**
 * Immutable representation of a single registered route.
 */
final class Route
{
    private readonly string $method;
    private readonly string $uri;
    /** @var callable|array<string, string>|string */
    private readonly mixed $handler;

    public function __construct(
        string $method,
        string $uri,
        callable|array|string $handler,
    ) {
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

    public function handler(): callable|array|string
    {
        return $this->handler;
    }
}
