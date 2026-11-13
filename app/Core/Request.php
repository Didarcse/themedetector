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
    private readonly string $requestId;
    /** @var array<string, mixed> */
    private readonly array $query;
    /** @var array<string, mixed> */
    private readonly array $post;
    /** @var array<string, mixed> */
    private readonly array $server;
    private readonly string $body;
    private readonly int $maxBodyBytes;
    private readonly bool $bodyExceedsLimit;
    /** @var list<string> */
    private readonly array $trustedProxies;

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $post
     * @param array<string, mixed> $server
     * @param list<string>         $trustedProxies The reverse-proxy addresses
     *                                             (IPs or CIDR blocks) allowed
     *                                             to assert the original
     *                                             request protocol through
     *                                             X-Forwarded-Proto.
     */
    public function __construct(
        string $method,
        string $uri,
        array $query = [],
        array $post = [],
        array $server = [],
        string $body = '',
        int $maxBodyBytes = self::DEFAULT_MAX_BODY_BYTES,
        array $trustedProxies = [],
    ) {
        $this->method = strtoupper($method);
        $this->uri = '/' . ltrim(trim($uri), '/');
        $this->requestId = bin2hex(random_bytes(16));
        $this->query = $query;
        $this->post = $post;
        $this->server = $server;
        $this->body = $body;
        $this->maxBodyBytes = $maxBodyBytes;
        $this->bodyExceedsLimit = strlen($body) > $maxBodyBytes
            || self::contentLengthOverLimit($server, $maxBodyBytes);
        $this->trustedProxies = $trustedProxies;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Return the server-generated correlation identifier for this request.
     *
     * The value is always generated locally and never derived from client
     * headers, preventing callers from choosing or spoofing log identifiers.
     *
     * @return string A 32-character lowercase hexadecimal identifier.
     */
    public function requestId(): string
    {
        return $this->requestId;
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
            self::trustedProxiesFromEnvironment(),
        );
    }

    /**
     * Determine whether the request arrived over a secure (HTTPS) transport.
     *
     * Only direct transport signals are trusted by default: the HTTPS server
     * flag or an explicit port 443. Forwarded protocol headers are honored
     * solely when the direct peer belongs to the configured trusted-proxy
     * list, so an untrusted client can never force HSTS by sending
     * X-Forwarded-Proto itself.
     *
     * @return bool True when the request is genuinely secure.
     */
    public function isSecure(): bool
    {
        if (self::requestUsedTls($this->server)) {
            return true;
        }

        if ($this->trustedProxies === []) {
            return false;
        }

        $remoteAddress = $this->server['REMOTE_ADDR'] ?? null;

        if (!is_string($remoteAddress) || !$this->remoteAddressIsTrustedProxy($remoteAddress)) {
            return false;
        }

        $forwardedProto = $this->server['HTTP_X_FORWARDED_PROTO'] ?? null;

        return is_string($forwardedProto)
            && strtolower(trim($forwardedProto)) === 'https';
    }

    /**
     * Detect direct TLS termination from the server variables.
     *
     * Apache/FPM set HTTPS=on when the connection was secured. Some SAPIs omit
     * the flag but still accept the request on port 443, which is equally
     * authoritative for the connection PHP handled.
     *
     * @param array<string, mixed> $server The server values.
     *
     * @return bool True when the direct connection used TLS.
     */
    private static function requestUsedTls(array $server): bool
    {
        $https = $server['HTTPS'] ?? null;

        if (is_string($https)) {
            $normalized = strtolower(trim($https));

            if (in_array($normalized, ['on', '1', 'true'], true)) {
                return true;
            }
        }

        $port = $server['SERVER_PORT'] ?? null;

        if (is_int($port)) {
            return $port === 443;
        }

        return is_string($port) && $port === '443';
    }

    /**
     * Determine whether the direct peer is a configured trusted proxy.
     *
     * @param string $remoteAddress The direct peer address.
     *
     * @return bool True when the address matches the trusted-proxy list.
     */
    private function remoteAddressIsTrustedProxy(string $remoteAddress): bool
    {
        foreach ($this->trustedProxies as $proxy) {
            if (self::addressMatches($remoteAddress, $proxy)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Match an IP address against an exact address or a CIDR block.
     *
     * IPv4 and IPv6 are both supported; address families must match.
     *
     * @param string $address The address to test.
     * @param string $pattern The exact address or CIDR block.
     *
     * @return bool True when the address falls inside the pattern.
     */
    private static function addressMatches(string $address, string $pattern): bool
    {
        if ($address === $pattern) {
            return true;
        }

        $separator = strpos($pattern, '/');

        if ($separator === false) {
            return false;
        }

        $subnet = substr($pattern, 0, $separator);
        $prefix = substr($pattern, $separator + 1);

        if (preg_match('/^[0-9]{1,3}$/', $prefix) !== 1) {
            return false;
        }

        $addressBytes = self::packAddress($address);
        $subnetBytes = self::packAddress($subnet);

        if (
            $addressBytes === null
            || $subnetBytes === null
            || strlen($addressBytes) !== strlen($subnetBytes)
        ) {
            return false;
        }

        $bits = (int) $prefix;
        $totalBits = strlen($addressBytes) * 8;

        if ($bits > $totalBits) {
            return false;
        }

        $wholeBytes = intdiv($bits, 8);
        $remainingBits = $bits % 8;

        if (
            $wholeBytes > 0
            && substr($addressBytes, 0, $wholeBytes) !== substr($subnetBytes, 0, $wholeBytes)
        ) {
            return false;
        }

        if ($remainingBits === 0) {
            return true;
        }

        $mask = (0xFF << (8 - $remainingBits)) & 0xFF;

        return (ord($addressBytes[$wholeBytes]) & $mask)
            === (ord($subnetBytes[$wholeBytes]) & $mask);
    }

    /**
     * Convert a textual IP address to its packed binary form.
     *
     * Invalid addresses are rejected before inet_pton() so no warning is
     * emitted for caller-supplied configuration values.
     *
     * @param string $address The textual IP address.
     *
     * @return string|null The packed address, or null when invalid.
     */
    private static function packAddress(string $address): ?string
    {
        if (filter_var($address, FILTER_VALIDATE_IP) === false) {
            return null;
        }

        $packed = inet_pton($address);

        return $packed === false ? null : $packed;
    }

    /**
     * Read the trusted-proxy list from the environment configuration.
     *
     * The value is a comma-separated list of IP addresses and CIDR blocks. An
     * unset or empty value disables forwarded-header trust entirely, which is
     * the safe default for direct deployments.
     *
     * @return list<string> The configured proxy entries.
     */
    private static function trustedProxiesFromEnvironment(): array
    {
        $configured = Environment::get('TRUSTED_PROXIES');

        if ($configured === null) {
            return [];
        }

        $proxies = [];

        foreach (explode(',', $configured) as $entry) {
            $proxy = trim($entry);

            if ($proxy !== '') {
                $proxies[] = $proxy;
            }
        }

        return $proxies;
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
