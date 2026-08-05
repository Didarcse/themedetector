<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable HTTP request representation.
 */
final class Request
{
    private readonly string $method;
    private readonly string $uri;
    /** @var array<string, mixed> */
    private readonly array $query;
    /** @var array<string, mixed> */
    private readonly array $post;
    /** @var array<string, mixed> */
    private readonly array $server;

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $post
     * @param array<string, mixed> $server
     */
    public function __construct(
        string $method,
        string $uri,
        array $query = [],
        array $post = [],
        array $server = [],
    ) {
        $this->method = strtoupper($method);
        $this->uri = '/' . ltrim(trim($uri), '/');
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    /** @return array<string, mixed> */
    public function query(): array
    {
        return $this->query;
    }

    /** @return array<string, mixed> */
    public function post(): array
    {
        return $this->post;
    }

    /** @return array<string, mixed> */
    public function server(): array
    {
        return $this->server;
    }

    public static function fromGlobals(): self
    {
        $method = self::stringValue($_SERVER['REQUEST_METHOD'] ?? null) ?? 'GET';
        $requestUri = self::stringValue($_SERVER['REQUEST_URI'] ?? null) ?? '/';
        $uri = parse_url($requestUri, PHP_URL_PATH);

        if ($uri === false || $uri === null) {
            $uri = '/';
        }

        return new self(
            $method,
            $uri,
            self::superglobal($_GET),
            self::superglobal($_POST),
            self::superglobal($_SERVER),
        );
    }

    private static function stringValue(mixed $value): ?string
    {
        return is_string($value) ? $value : null;
    }

    /**
     * @return array<string, mixed>
     */
    private static function superglobal(mixed $value): array
    {
        if (!is_array($value)) {
            return [];
        }

        $normalized = [];

        foreach ($value as $key => $item) {
            $normalized[(string) $key] = $item;
        }

        return $normalized;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function queryParam(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }
}
