# Security Policy

ThemeDetectorTool v2 is a released project. This document describes how to
report a vulnerability and what you can expect in response.

## Reporting a Vulnerability

**Do not open a public GitHub issue for security vulnerabilities.**

Report security issues privately to the maintainers:

- **Email:** security@globalkernel.com (primary)
- **Maintainer:** Didar Alam — open a private advisory via the GitHub repository
  by using **Report a vulnerability** under the Security tab, or email the
  maintainer directly.

Please include:

- Affected version / commit (from `git log` or `composer.lock`).
- Steps to reproduce, including the target HTML/URL used.
- Impact assessment and, if known, a suggested fix.
- Proof-of-concept code (avoid including it in public pull requests).

## Response Expectations

- **Acknowledgment:** within 72 hours.
- **Assessment:** a triage decision and expected fix timeline within 7 days.
- **Disclosure:** coordinated — we will agree on timing with the reporter before
  public disclosure. Reports are acknowledged in the changelog unless the reporter
  requests otherwise.

## Supported Versions

The latest tagged release and `main` receive security fixes. Older tagged
versions are not security-supported.

| Version            | Supported          |
|--------------------|--------------------|
| `main` (latest)    | Yes                |
| `2.2.0`            | Yes                |
| `0.1.x` and older  | No                 |

## Scope

The following are in scope:

- Remote code execution, injection, or path traversal through the detection
  pipeline.
- Unsafe handling of fetched site content (HTML, headers, redirect chains) that
  could lead to XSS or memory/resource abuse.
- Data exposure through logs, errors, or the HTTP kernel.

Out of scope: unmodified third-party dependencies (report those to their
respective projects), social engineering, and denial-of-service via intentionally
hostile target content during manual analysis.

## HTTP Security Headers

Every response — HTML pages, API JSON, `robots.txt`, `sitemap.xml`, and error
responses — carries the following baseline headers:

- `X-Content-Type-Options: nosniff`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `X-Frame-Options: DENY`
- `Content-Security-Policy` (see below)

### Content-Security-Policy

The application ships no inline executable scripts or styles, so the policy is
restrictive and does **not** use `'unsafe-inline'` or `'unsafe-eval'`:

```
default-src 'self'; base-uri 'self'; object-src 'none'; frame-ancestors 'none';
script-src 'self' https://cdn.jsdelivr.net;
style-src 'self' https://cdn.jsdelivr.net;
font-src 'self' https://cdn.jsdelivr.net;
img-src 'self' data:; connect-src 'self'; form-action 'self';
manifest-src 'self'
```

Rationale for each external source:

- `https://cdn.jsdelivr.net` in `script-src`, `style-src`, and `font-src` is
  required by Bootstrap 5.3.3 (CSS/JS, loaded with Subresource Integrity) and
  Bootstrap Icons 1.11.3 (CSS plus its webfonts).
- `img-src data:` covers the inline SVG data URIs used by Bootstrap form
  control backgrounds.
- `connect-src 'self'` allows the loading screen's same-origin
  `fetch('POST /detect')`.
- `form-action 'self'` restricts the search forms to same-origin submissions.
- The homepage JSON-LD block is a non-executing script data block and is not
  subject to `script-src`.

If a dependency is ever loaded from a new origin, add that exact origin to the
relevant directive — do not widen the policy with `*` or `https:`.

`X-Frame-Options: DENY` is kept consistent with `frame-ancestors 'none'`, so
the site cannot be framed.

### Strict-Transport-Security

`Strict-Transport-Security: max-age=15552000` (180 days) is emitted **only**
when the request is genuinely HTTPS. `includeSubDomains` and `preload` are
intentionally not enabled until every subdomain is verified HTTPS-only.

Secure-transport detection trusts only direct signals:

1. The `HTTPS` server flag set to `on`, `1`, or `true` (case-insensitive), or
2. An explicit `SERVER_PORT` of `443`, or
3. `X-Forwarded-Proto: https` **only** when the direct peer (`REMOTE_ADDR`)
   matches the `TRUSTED_PROXIES` allowlist (IPs and/or CIDR blocks).

Arbitrary forwarded headers from unconfigured peers are never trusted, so a
client cannot force HSTS with a spoofed `X-Forwarded-Proto`.

Deployment requirements behind a TLS-terminating reverse proxy:

- Either configure the proxy to pass the `HTTPS` flag through to PHP (for
  example `fastcgi_param HTTPS on;` with nginx + PHP-FPM), or
- Set `TRUSTED_PROXIES` to the proxy address(es) that terminate TLS, and have
  the proxy set `X-Forwarded-Proto` from its own observed scheme.

Never expose HSTS on plain HTTP: browsers would reject future HTTP requests to
the host, and the header would be ignored over an insecure connection anyway.

## Security Best Practices for Contributors

- Never log full HTTP bodies, headers, or response payloads to logs or the
  browser.
- Never commit secrets, `.env` contents, or API keys — see `.gitignore`.
- Treat all fetched site content as untrusted input; escape before rendering.
- Run the full quality gates before landing security-sensitive changes:
  `composer test`, `composer analyse`, `composer cs-check`.
