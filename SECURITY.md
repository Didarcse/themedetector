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

## Security Best Practices for Contributors

- Never log full HTTP bodies, headers, or response payloads to logs or the
  browser.
- Never commit secrets, `.env` contents, or API keys — see `.gitignore`.
- Treat all fetched site content as untrusted input; escape before rendering.
- Run the full quality gates before landing security-sensitive changes:
  `composer test`, `composer analyse`, `composer cs-check`.
