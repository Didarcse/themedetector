<?php

declare(strict_types=1);

namespace App\Modules\Http;

use Closure;

/**
 * SSRF-safe destination policy for every outbound HTTP request.
 *
 * UrlHostPolicy decides whether an absolute URL may be fetched by the
 * detection service. Only public HTTP/HTTPS destinations are allowed by
 * default: loopback, private, link-local, multicast, reserved, and
 * documentation address ranges are rejected, along with encoded
 * representations of them (decimal integer, hexadecimal, and octal IPv4
 * forms, IPv4-mapped and IPv4-compatible IPv6, and scope-zone IPv6).
 * Hostnames are resolved through an injectable resolver and rejected when
 * they resolve to a blocked address; destinations that cannot be safely
 * classified fail closed.
 *
 * The policy is deterministic, dependency-free, and reusable. It performs
 * no network activity of its own: hostname resolution is delegated to the
 * injected resolver (the real DNS by default) so callers stay in control
 * of when and how lookups happen.
 *
 * Responsibilities:
 *
 * - Validate that the URL scheme is exactly http or https.
 * - Parse and normalize the host safely, rejecting malformed or
 *   non-ASCII hosts.
 * - Normalize IP representations to a canonical address.
 * - Reject loopback, private, link-local, and other non-public ranges for
 *   both IPv4 and IPv6.
 * - Reject IPv4-mapped private/loopback IPv6 and encoded IPv4 forms.
 * - Reject localhost and internal hostnames when they resolve to a
 *   blocked address.
 * - Fail closed when the destination cannot be safely classified.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is the destination policy only.
 *   It performs no requests, no redirect handling, and no response
 *   processing.
 * - Dependency Inversion: hostname resolution is injected, never called
 *   statically, so the policy is fully testable and deterministic.
 * - Fail closed: any host that cannot be parsed, resolved, or classified
 *   is rejected rather than accepted.
 * - Stateless apart from a per-instance DNS result cache.
 *
 * Security limitation (DNS rebinding / TOCTOU):
 *
 * - Hostname validation resolves DNS through the injected resolver and
 *   rejects hosts that resolve to a blocked address, but the transport
 *   resolves the hostname again at connection time. A DNS-rebinding race
 *   (validate-then-connect TOCTOU) is therefore not fully prevented by
 *   this minimal policy.
 * - Full protection requires pinning the resolved addresses at the
 *   transport layer (for example CURLOPT_RESOLVE-style binding), which
 *   needs a broader transport redesign and is intentionally outside
 *   Sprint 49.
 */
final class UrlHostPolicy
{
    /** @var array<string, list<string>> */
    private array $resolvedCache = [];

    private Closure $resolver;

    /**
     * @param (callable(string): list<string>)|null $resolver Maps a
     *                                                         hostname to
     *                                                         its resolved
     *                                                         IP addresses.
     *                                                         Defaults to
     *                                                         the system
     *                                                         resolver.
     */
    public function __construct(?callable $resolver = null)
    {
        $this->resolver = $resolver !== null
            ? Closure::fromCallable($resolver)
            : Closure::fromCallable(fn (string $host): array => $this->resolveDns($host));
    }

    /**
     * Return whether the given absolute URL may be fetched.
     *
     * The scheme must be exactly http or https, and the destination must
     * classify as a public address (for IP literals) or resolve to only
     * public addresses (for hostnames). Any other outcome — unsupported
     * scheme, empty or malformed host, blocked or unclassifiable address —
     * returns false.
     *
     * @param string $url The absolute URL to classify.
     *
     * @return bool True when the destination is safe to fetch.
     */
    public function isAllowed(string $url): bool
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);

        if (!is_string($scheme) || !in_array(strtolower($scheme), ['http', 'https'], true)) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);

        if (!is_string($host) || $host === '') {
            return false;
        }

        $host = $this->normalizeHost($host);

        if ($host === null) {
            return false;
        }

        $canonicalIp = $this->canonicalIp($host);

        if ($canonicalIp !== null) {
            return $this->isPublicIp($canonicalIp);
        }

        return $this->isSafeHostname($host);
    }

    /**
     * Normalize a host into a lower-case, bracket-free form.
     *
     * Returns null when the host is empty, overlong, contains a scope
     * zone, or carries control or non-ASCII characters that prevent safe
     * classification.
     *
     * @param string $host The raw host as returned by parse_url.
     *
     * @return string|null The normalized host, or null when unsafe.
     */
    private function normalizeHost(string $host): ?string
    {
        $host = strtolower(trim($host));

        if ($host === '' || strlen($host) > 253) {
            return null;
        }

        if (str_starts_with($host, '[') && str_ends_with($host, ']')) {
            $host = substr($host, 1, -1);

            if ($host === '') {
                return null;
            }
        }

        if (str_contains($host, '%') || preg_match('/[\x00-\x20\x7F]/', $host) === 1) {
            return null;
        }

        if (preg_match('/[^\x20-\x7E]/', $host) === 1) {
            return null;
        }

        return $host;
    }

    /**
     * Normalize a host into a canonical IP address.
     *
     * Accepts standard dotted IPv4, encoded IPv4 forms (single decimal
     * integer, hexadecimal, octal, and short dotted forms), IPv6 literals,
     * and IPv4-mapped or IPv4-compatible IPv6. Returns null when the host
     * is not an IP address in any supported representation.
     *
     * @param string $host The normalized host.
     *
     * @return string|null The canonical IP address, or null.
     */
    private function canonicalIp(string $host): ?string
    {
        if (str_contains($host, ':')) {
            $bytes = @inet_pton($host);

            if ($bytes === false || strlen($bytes) !== 16) {
                return null;
            }

            $mapped = substr($bytes, 0, 10) === "\0\0\0\0\0\0\0\0\0\0"
                && substr($bytes, 10, 2) === "\xff\xff";
            $compatible = substr($bytes, 0, 12) === "\0\0\0\0\0\0\0\0\0\0\0\0";

            if ($mapped || $compatible) {
                $v4 = inet_ntop(substr($bytes, 12, 4));

                return $v4 === false ? null : $v4;
            }

            $v6 = inet_ntop($bytes);

            return $v6 === false ? null : $v6;
        }

        return $this->canonicalIpv4($host);
    }

    /**
     * Normalize an IPv4 literal in any supported representation.
     *
     * Handles dotted decimal, short dotted forms (a.b, a.b.c), and
     * per-part decimal, hexadecimal (0x...), and octal (leading zero)
     * notation, including single-part integer forms such as 2130706433,
     * 0x7f000001, and 017700000001.
     *
     * @param string $host The normalized host.
     *
     * @return string|null The canonical dotted-quad address, or null.
     */
    private function canonicalIpv4(string $host): ?string
    {
        $parts = explode('.', $host);

        if (count($parts) > 4) {
            return null;
        }

        $num = 0;

        foreach ($parts as $index => $part) {
            $value = $this->ipv4PartValue($part);

            if ($value === null) {
                return null;
            }

            if ($index < count($parts) - 1) {
                if ($value > 255) {
                    return null;
                }

                $num = ($num << 8) | $value;
            } else {
                $bits = 8 * (4 - count($parts) + 1);
                $max = $bits === 32 ? 0xffffffff : (1 << $bits) - 1;

                if ($value > $max) {
                    return null;
                }

                $num = ($num << $bits) | $value;
            }

            if ($num > 0xffffffff) {
                return null;
            }
        }

        $ip = long2ip($num);

        return $ip === false ? null : $ip;
    }

    /**
     * Convert a single IPv4 part to its integer value.
     *
     * Supports decimal, hexadecimal (0x...), and octal (leading zero)
     * notation. Returns null when the part is not a valid numeric literal
     * or overflows a 32-bit value.
     *
     * @param string $part The part to convert.
     *
     * @return int|null The integer value, or null when invalid.
     */
    private function ipv4PartValue(string $part): ?int
    {
        if ($part === '' || preg_match('/^[0-9a-fA-FxX]+$/', $part) !== 1) {
            return null;
        }

        if (preg_match('/^0[xX][0-9a-fA-F]+$/', $part) === 1) {
            $value = hexdec(substr($part, 2));
        } elseif (preg_match('/^0[0-7]+$/', $part) === 1) {
            $value = octdec($part);
        } elseif (preg_match('/^[0-9]+$/', $part) === 1) {
            $value = intval($part);
        } else {
            return null;
        }

        if (!is_int($value) || $value < 0 || $value > 0xffffffff) {
            return null;
        }

        return $value;
    }

    /**
     * Return whether a canonical IP address is publicly routable.
     *
     * @param string $ip The canonical IP address.
     *
     * @return bool True when the address is public.
     */
    private function isPublicIp(string $ip): bool
    {
        if (str_contains($ip, ':')) {
            return $this->isPublicIpv6($ip);
        }

        return $this->isPublicIpv4($ip);
    }

    /**
     * Return whether a canonical IPv4 address is publicly routable.
     *
     * @param string $ip The canonical dotted-quad address.
     *
     * @return bool True when the address is public.
     */
    private function isPublicIpv4(string $ip): bool
    {
        $num = ip2long($ip);

        if ($num === false) {
            return false;
        }

        $num = $num & 0xffffffff;

        if (($num >> 24) === 0) {
            return false;
        }

        if (($num & 0xff000000) === 0x7f000000) {
            return false;
        }

        if (($num & 0xff000000) === 0x0a000000) {
            return false;
        }

        if (($num & 0xffc00000) === 0x64400000) {
            return false;
        }

        if (($num & 0xffff0000) === 0xa9fe0000) {
            return false;
        }

        if (($num & 0xfff00000) === 0xac100000) {
            return false;
        }

        if (($num & 0xffff0000) === 0xc0a80000) {
            return false;
        }

        if (($num & 0xffffff00) === 0xc0000000) {
            return false;
        }

        if (($num & 0xffffff00) === 0xc0000200) {
            return false;
        }

        if (($num & 0xfffe0000) === 0xc6120000) {
            return false;
        }

        if (($num & 0xffffff00) === 0xc6336400) {
            return false;
        }

        if (($num & 0xffffff00) === 0xcb007100) {
            return false;
        }

        if (($num & 0xf0000000) === 0xe0000000) {
            return false;
        }

        if (($num & 0xf0000000) === 0xf0000000) {
            return false;
        }

        if ($num === 0xffffffff) {
            return false;
        }

        return true;
    }

    /**
     * Return whether a canonical IPv6 address is publicly routable.
     *
     * @param string $ip The canonical IPv6 address.
     *
     * @return bool True when the address is public.
     */
    private function isPublicIpv6(string $ip): bool
    {
        $bytes = @inet_pton($ip);

        if ($bytes === false || strlen($bytes) !== 16) {
            return false;
        }

        if ($bytes === "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0") {
            return false;
        }

        if ($bytes === "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\x01") {
            return false;
        }

        $first = ord($bytes[0]);
        $second = ord($bytes[1]);

        if (($first & 0xfe) === 0xfc) {
            return false;
        }

        if ($first === 0xfe && (($second & 0xc0) === 0x80 || ($second & 0xc0) === 0xc0)) {
            return false;
        }

        if ($first === 0xff) {
            return false;
        }

        if (
            $bytes[0] === "\x20"
            && $bytes[1] === "\x01"
            && $bytes[2] === "\x0d"
            && $bytes[3] === "\xb8"
        ) {
            return false;
        }

        return true;
    }

    /**
     * Return whether a hostname is safe to fetch.
     *
     * The hostname must be a structurally valid DNS name that is not
     * localhost and that resolves exclusively to public addresses. Names
     * that cannot be resolved fail closed and are rejected.
     *
     * @param string $host The normalized hostname.
     *
     * @return bool True when the hostname resolves to public addresses only.
     */
    private function isSafeHostname(string $host): bool
    {
        $host = rtrim($host, '.');

        if ($host === '') {
            return false;
        }

        if ($host === 'localhost' || str_ends_with($host, '.localhost')) {
            return false;
        }

        if (preg_match('/^[0-9.]+$/', $host) === 1) {
            return false;
        }

        $pattern = '/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)(?:\.(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?))*$/';

        if (preg_match($pattern, $host) !== 1) {
            return false;
        }

        $ips = $this->resolve($host);

        if ($ips === []) {
            return false;
        }

        foreach ($ips as $ip) {
            if (!$this->isPublicIp($ip)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Resolve a hostname to its IP addresses.
     *
     * @param string $host The hostname to resolve.
     *
     * @return list<string> The resolved IP addresses.
     */
    private function resolve(string $host): array
    {
        if (isset($this->resolvedCache[$host])) {
            return $this->resolvedCache[$host];
        }

        $ips = ($this->resolver)($host);

        $ips = is_array($ips) ? $ips : [];

        $ips = array_values(array_filter(
            $ips,
            static fn (mixed $ip): bool => is_string($ip) && $ip !== '',
        ));

        return $this->resolvedCache[$host] = $ips;
    }

    /**
     * Resolve a hostname using the system resolver.
     *
     * Collects every A and AAAA record; falls back to gethostbynamel when
     * dns_get_record produces nothing. An empty result indicates the name
     * could not be resolved and is treated as a failed-closed outcome by
     * the caller.
     *
     * @param string $host The hostname to resolve.
     *
     * @return list<string> The resolved IP addresses.
     */
    private function resolveDns(string $host): array
    {
        $ips = [];

        $records = @dns_get_record($host, DNS_A | DNS_AAAA);

        if (is_array($records)) {
            foreach ($records as $record) {
                $type = $record['type'] ?? '';

                if ($type === 'A' && isset($record['ip']) && is_string($record['ip'])) {
                    $ips[] = $record['ip'];
                }

                if ($type === 'AAAA' && isset($record['ipv6']) && is_string($record['ipv6'])) {
                    $ips[] = $record['ipv6'];
                }
            }
        }

        if ($ips === []) {
            $lookup = @gethostbynamel($host);

            if (is_array($lookup)) {
                foreach ($lookup as $ip) {
                    $ips[] = $ip;
                }
            }
        }

        return array_values(array_unique($ips));
    }
}
