<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable HTTP response representation.
 */
final class Response
{
    /**
     * HSTS max-age in seconds (180 days).
     *
     * Long enough to give repeat visitors real protection while keeping the
     * commitment short until operators have confirmed that every route of the
     * origin (and, if ever enabled, its subdomains) is HTTPS-only. The policy
     * deliberately omits includeSubDomains and preload so the site cannot be
     * locked into a broader commitment than has been verified.
     */
    public const HSTS_MAX_AGE = 15552000;

    /**
     * Baseline Content-Security-Policy for every response.
     *
     * The policy reflects the actual application dependencies:
     *
     * - script-src/style-src: local bundles plus Bootstrap 5.3.3 and Bootstrap
     *   Icons 1.11.3 served from cdn.jsdelivr.net (both scripts carry SRI).
     * - font-src: Bootstrap Icons webfonts are served from the same CDN.
     * - img-src: same-origin images plus data: URIs used by Bootstrap form
     *   control backgrounds.
     * - connect-src/form-action: the loading screen fetches POST /detect and
     *   the forms submit to the same origin only.
     *
     * No inline scripts or styles are used by the application, so
     * 'unsafe-inline' and 'unsafe-eval' are intentionally absent. The JSON-LD
     * block on the homepage is a non-executing script data block and is not
     * subject to script-src.
     */
    public const CONTENT_SECURITY_POLICY = "default-src 'self'; "
        . "base-uri 'self'; "
        . "object-src 'none'; "
        . "frame-ancestors 'none'; "
        . "script-src 'self' https://cdn.jsdelivr.net; "
        . "style-src 'self' https://cdn.jsdelivr.net; "
        . "font-src 'self' https://cdn.jsdelivr.net; "
        . "img-src 'self' data:; "
        . "connect-src 'self'; "
        . "form-action 'self'; "
        . "manifest-src 'self'";

    private readonly string $content;
    private readonly int $status;
    /** @var array<string, string> */
    private readonly array $headers;

    /** @param array<string, string> $headers */
    public function __construct(
        string $content = '',
        int $status = 200,
        array $headers = [],
    ) {
        $this->content = $content;
        $this->status = $status;
        $this->headers = array_merge(self::defaultSecurityHeaders(), $headers);
    }

    /**
     * Build an HTML response that must not be cached.
     *
     * HTML pages carry a per-session CSRF token, so shared caches must not
     * store or reuse them. Vary: Cookie keeps cache keys session-aware.
     *
     * @param array<string, string> $headers Additional or overridden headers.
     */
    public static function html(string $content, int $status = 200, array $headers = []): self
    {
        foreach (array_keys($headers) as $name) {
            if (strcasecmp($name, 'Cache-Control') === 0 || strcasecmp($name, 'Vary') === 0) {
                unset($headers[$name]);
            }
        }

        return new self(
            $content,
            $status,
            $headers + [
                'Cache-Control' => 'no-store',
                'Vary' => 'Cookie',
            ],
        );
    }

    /**
     * @param array<mixed>|object $data
     */
    public static function json(array|object $data, int $status = 200): self
    {
        $encoded = json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);

        return new self(
            $encoded,
            $status,
            ['Content-Type' => 'application/json; charset=UTF-8'],
        );
    }

    /**
     * Return a copy of the response carrying an additional or replaced header.
     *
     * The response stays immutable: the receiver is never modified.
     *
     * @param string $name  The header name.
     * @param string $value The header value.
     *
     * @return self The new response instance.
     */
    public function withHeader(string $name, string $value): self
    {
        return new self(
            $this->content,
            $this->status,
            [$name => $value] + $this->headers,
        );
    }

    public function content(): string
    {
        return $this->content;
    }

    public function status(): int
    {
        return $this->status;
    }

    /** @return array<string, string> */
    public function headers(): array
    {
        return $this->headers;
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->content;
    }

    /**
     * Return the security headers applied to every response by default.
     *
     * These headers are transport independent and therefore static.
     * Strict-Transport-Security is applied separately by the Kernel because it
     * depends on how the request was received.
     *
     * @return array<string, string> The default security headers.
     */
    private static function defaultSecurityHeaders(): array
    {
        return [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Content-Security-Policy' => self::CONTENT_SECURITY_POLICY,
        ];
    }
}
