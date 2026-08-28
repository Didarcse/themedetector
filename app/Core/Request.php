<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable HTTP request representation.
 */
final class Request
{
    /**
     * Default maximum inbound request-body size in bytes (16 KiB).
     *
     * The public API accepts a single JSON object holding one "url" field
     * of at most 2048 characters, so the realistic maximum body is around
     * 2.5 KiB. 16 KiB therefore bounds per-request allocation with roughly
     * 6x headroom for whitespace and future fields while keeping the
     * ceiling small enough to repel resource-exhaustion attempts. It is a
     * resource-exhaustion guard, not a contract change.
     */
    public const DEFAULT_MAX_BODY_BYTES = 16384;

    private readonly string $method;
    private readonly string $uri;
    /** @var array<string, mixed> */
    private readonly array $query;
    /** @var array<string, mixed> */
    private readonly array $post;
    /** @var array<string, mixed> */
    private readonly array $server;
    private readonly string $body;
    private readonly int $maxBodyBytes;
    private readonly bool $bodyExceedsLimit;

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
        string $body = '',
        int $maxBodyBytes = self::DEFAULT_MAX_BODY_BYTES,
    ) {
        $this->method = strtoupper($method);
        $this->uri = '/' . ltrim(trim($uri), '/');
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;
        $this->body = $body;
        $this->maxBodyBytes = $maxBodyBytes;
        $this->bodyExceedsLimit = strlen($body) > $maxBodyBytes
            || self::contentLengthOverLimit($server, $maxBodyBytes);
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

    /**
     * Return the raw request body.
     *
     * @return string The raw request body, empty when the request carried
     *                no body. The returned value is at most
     *                maxBodyBytes() + 1 bytes; the final byte is a sentinel
     *                that must never be treated as part of the payload.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Return whether the request body exceeds the configured maximum.
     *
     * An oversized body must not be processed: the 1 byte sentinel makes
     * the detection reliable even without a Content-Length header, and a
     * truthful Content-Length over the limit fails closed up front.
     *
     * @return bool True when the request body is over the limit.
     */
    public function bodyExceedsLimit(): bool
    {
        return $this->bodyExceedsLimit;
    }

    /**
     * Return the configured maximum request-body size in bytes.
     *
     * @return int The maximum body size in bytes.
     */
    public function maxBodyBytes(): int
    {
        return $this->maxBodyBytes;
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
            self::readBody(self::DEFAULT_MAX_BODY_BYTES),
            self::DEFAULT_MAX_BODY_BYTES,
        );
    }

    /**
     * Read the raw request body with a hard byte ceiling.
     *
     * php://input is read for at most maxBodyBytes + 1 bytes. The one
     * extra byte is a sentinel: it is never processed inside the body, but
     * its presence makes strlen > maxBodyBytes true exactly when the input
     * was longer than the limit. This keeps the allocation bounded to a few
     * kilobytes while still detecting oversized bodies when the client
     * provides no Content-Length (for example chunked transfer encoding).
     *
     * @param int $maxBodyBytes The configured maximum body size in bytes.
     *
     * @return string The bounded body, at most maxBodyBytes + 1 bytes.
     */
    private static function readBody(int $maxBodyBytes): string
    {
        $limit = max(0, $maxBodyBytes + 1);

        return self::stringValue(file_get_contents('php://input', false, null, 0, $limit)) ?? '';
    }

    /**
     * Return whether a declared Content-Length exceeds the limit.
     *
     * A well-formed non-negative Content-Length over the limit fails closed
     * before the body is read. Malformed or negative values are not trusted
     * and never cause rejection by themselves; the actual bounded body read
     * remains the real enforcement.
     *
     * @param array<string, mixed> $server       The server values.
     * @param int                  $maxBodyBytes The configured maximum body
     *                                           size in bytes.
     *
     * @return bool True when the declared length exceeds the limit.
     */
    private static function contentLengthOverLimit(array $server, int $maxBodyBytes): bool
    {
        $value = $server['CONTENT_LENGTH'] ?? null;

        if (is_int($value)) {
            return $value > $maxBodyBytes;
        }

        if (!is_string($value) || preg_match('/^[0-9]+$/', $value) !== 1) {
            return false;
        }

        return (int) $value > $maxBodyBytes;
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
