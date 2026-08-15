# Public API v1 — Website Detection

> **Status:** Implemented (Sprint 52)
> **Project:** ThemeDetectorTool v2 · **Framework:** Kernel Framework v1
> **Runtime:** PHP 8.2 · **Code style:** PSR-12 · **Analysis:** PHPStan Level MAX · **Testing:** PHPUnit 11
> **Base path:** `/api/v1` · **Schema version:** `v1`

This document is the canonical contract for the public website detection API. It
describes the endpoint, authentication, the request and response schemas, error
codes, rate limiting, caching, and the security behaviour of the outbound HTTP
boundary. Everything described here is implemented; nothing is speculative.

---

## 1. Overview

The public API exposes the existing website detection pipeline over JSON. A
single endpoint, `POST /api/v1/detect`, accepts a target URL and returns the
whitelisted detection report: detected CMS, theme, plugins, technologies, and
confidence scores.

The API is a **boundary only**. It reuses `App\Services\WebsiteReportAnalyzer` —
the exact same analyzer the web `/detect` page uses — so it inherits the Sprint 49
SSRF protection with no second HTTP client. The API never re-implements
detection, extraction, or parsing logic.

### Design principles

- **Same pipeline, new boundary.** One analyzer, two front-ends (web + API).
- **Whitelist-only responses.** The response contains only fields the schema
  explicitly lists. Raw HTML context, response headers, engine metadata, and
  error `source`/`context` are deliberately unreachable.
- **No CORS headers.** The API does not emit `Access-Control-Allow-*` headers.
  It is a server-to-server endpoint, not a browser-facing one.
- **Stateless boundary.** The controller holds no request or session state; the
  current `Request` is resolved from the container at invocation time, exactly
  like `DetectionController`.

---

## 2. Endpoint

```
POST /api/v1/detect
Content-Type: application/json
Authorization: Bearer <api-key>        (required when API_KEYS is configured)
```

Request body:

```json
{
    "url": "https://example.com"
}
```

- The `url` field is the only allowed field. **Unknown fields are rejected** so
  the API surface stays stable.
- A scheme-less host is inferred as `https://` (mirroring the web analyzer).
- The maximum URL length is **2048 characters**.

### Curl example

```bash
curl -X POST https://themedetectortool.com/api/v1/detect \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer your-api-key" \
  -d '{"url":"example.com"}'
```

---

## 3. Authentication

Authentication is **Bearer-token based**. The key is read only from the
`Authorization` header; it is never accepted from the query string and never
logged.

Keys are configured through the environment (the git-ignored `.env` file):

| Variable   | Meaning                                             | Example |
|------------|-----------------------------------------------------|---------|
| `API_KEYS` | Comma-separated list of accepted keys (preferred).  | `k1,k2,k3` |
| `API_KEY`  | Single accepted key (fallback).                     | `solo-key` |

Both variables may be set; the accepted set is the union.

| Request state                                                        | Behaviour                                        |
|----------------------------------------------------------------------|--------------------------------------------------|
| `API_KEYS`/`API_KEY` **set**, `Authorization` missing                | `401 unauthorized`                                |
| `API_KEYS`/`API_KEY` **set**, `Authorization` present but invalid    | `401 unauthorized`                                |
| `API_KEYS`/`API_KEY` **set**, `Authorization: Bearer <valid key>`    | Request proceeds on the **keyed** rate-limit tier |
| No keys configured, `Authorization` missing                          | Request proceeds on the **anonymous** tier        |
| No keys configured, `Authorization` present                          | Still `401` (an invalid credential is never ignored) |

> **Open tier.** When no keys are configured the API runs open, protected only by
> the per-IP rate limit. Configure keys in production.

---

## 4. Request validation

The validator is strict and deterministic. The body is decoded with
`json_decode(..., true)` and then checked in two stages: first whether it is a
JSON object at all, then whether that object satisfies the `url` schema. This
produces four distinct classes of validation outcome:

1. **Malformed JSON** — the body cannot be decoded as JSON at all.
2. **Non-object JSON** — the body decodes to a JSON array, a scalar, or `null`.
3. **Object missing `url`** — the body is a genuine JSON object but has no
   `url` member.
4. **Object with an invalid `url`** — the object has a `url` member that fails
   one of the schema checks below.

| Condition                                               | Status | Error code          |
|---------------------------------------------------------|--------|---------------------|
| `Content-Type` is not `application/json`                | 415    | `unsupported_media_type` |
| Body is malformed JSON (cannot be decoded)              | 400    | `invalid_json`      |
| Body decodes to a non-object JSON value (`null`, a scalar, or a JSON array) | 422 | `body_not_object` |
| Body is an empty JSON object `{}`                       | 422    | `body_not_object`   |
| Body contains an unknown field                          | 422    | `unknown_field`     |
| Object has no `url` member                              | 422    | `url_required`      |
| `url` is not a string                                   | 422    | `url_invalid_type`  |
| `url` is empty after trimming                           | 422    | `url_empty`         |
| `url` exceeds 2048 characters                           | 422    | `url_too_long`      |
| `url` is not a valid http(s) URL                        | 422    | `url_invalid_format`|

> **Empty object vs missing `url`.** Because the body is decoded as a PHP
> array, the empty JSON object `{}` becomes an empty array, which the
> validator treats as a non-object body and rejects with `422 body_not_object`
> — not `url_required`. The `url_required` code is only produced when the body
> is a genuine object with at least one named field that lacks the `url`
> member, e.g. `{"foo":"bar"}` yields both `unknown_field` and `url_required`.

> A scheme-less value is normalised before validation (see §2) by inferring
> `https://`, mirroring the existing analyzer. Only `http` and `https` schemes
> are accepted; any other explicit scheme (`ftp`, `file`, `gopher`, ...) is
> rejected with `422 url_invalid_format` at the API boundary, before the
> detection pipeline is ever invoked.

---

## 5. Response contract

Every response is a JSON envelope with the fixed top-level shape:

```json
{
    "schemaVersion": "v1",
    "requestId": "<32 hex chars>",
    "success": true,
    "data": { ... },
    "errors": []
}
```

- `schemaVersion` is always `"v1"`.
- `requestId` is a fresh, random 32-character hex string per request. It is
  regenerated on cache hits too, so it can never leak cache state.
- On success `data` holds the report and `errors` is an empty array.
- On request/analysis failure `data` is `null` and `errors` is a list of
  `{"code": "...", "message": "..."}` objects.

### 5.1 Success response (`200`)

```json
{
    "schemaVersion": "v1",
    "requestId": "f2a1...",
    "success": true,
    "data": {
        "website": {
            "url": "https://example.com",
            "finalUrl": "https://example.com",
            "statusCode": 200
        },
        "cms": "WordPress",
        "cmsConfidence": 55,
        "theme": {
            "name": "Twenty Twenty-Five",
            "version": "1.0",
            "author": "the WordPress team"
        },
        "plugins": ["contact-form-7"],
        "technologies": [
            { "name": "WordPress", "confidence": 55 }
        ],
        "detectionConfidence": 55,
        "detectionTimeMs": 1234
    },
    "errors": []
}
```

Field semantics:

| Field                 | Type                       | Meaning |
|-----------------------|----------------------------|---------|
| `website.url`         | string                     | The normalised submitted URL. |
| `website.finalUrl`    | string                     | The final URL after redirects. |
| `website.statusCode`  | int                        | The HTTP status of the final response. |
| `cms`                 | string                     | The detected CMS, or `""` when none. |
| `cmsConfidence`       | int (0–100)                | CMS confidence. |
| `theme`               | object/null                | Extracted theme; `null` when none. |
| `theme.name`          | string                     | Theme name. |
| `theme.version`       | string/null                | Theme version. |
| `theme.author`        | string/null                | Theme author. |
| `plugins`             | list<string>               | Detected plugin names in display order. |
| `technologies`        | list<{name, confidence}>   | Detected technologies and their confidence. |
| `detectionConfidence` | int (0–100)                | Highest confidence across detection/extraction. |
| `detectionTimeMs`     | int                        | Total analysis time in milliseconds. |

### 5.2 Error response (request/validation errors)

```json
{
    "schemaVersion": "v1",
    "requestId": "f2a1...",
    "success": false,
    "data": null,
    "errors": [
        { "code": "unknown_field", "message": "Unknown field [callback] is not allowed." },
        { "code": "url_required", "message": "The \"url\" field is required." }
    ]
}
```

### 5.3 Error response (analysis errors)

Analysis failures keep **HTTP 200** and express the failure in the envelope.
Only the whitelisted codes `invalid_url` and `transport_failure` are ever
exposed; any internal code is mapped to `analysis_failed`. Error entries expose
`code` and `message` **only** — never `source` or `context`.

```json
{
    "schemaVersion": "v1",
    "requestId": "f2a1...",
    "success": false,
    "data": null,
    "errors": [
        { "code": "transport_failure", "message": "The website could not be reached. Please check the URL and try again." }
    ]
}
```

### 5.4 HTTP status summary

| Status | Meaning |
|--------|---------|
| 200    | Detection completed, or analysis failed (see §5.3). |
| 400    | Malformed JSON body. |
| 401    | Missing or invalid API key. |
| 415    | Wrong `Content-Type`. |
| 422    | Schema/validation error. |
| 429    | Rate limit exceeded, or server busy. |

---

## 6. Rate limiting

Rate limiting is a **fixed-window counter** per identity, persisted to the local
filesystem under exclusive file locks. Identifiers are `sha256`-hashed before
they touch the filesystem, so raw API keys never appear in file names or
contents.

Two independent tiers:

| Tier        | Identity          | Default limit | Default window |
|-------------|-------------------|---------------|----------------|
| Anonymous   | Client IP         | 10            | 900 s (15 min) |
| Keyed       | Validated API key | 60            | 3600 s (1 h)   |

- **Only `REMOTE_ADDR` is trusted** for the anonymous tier; forwarded headers are
  ignored so a client cannot spoof its identity.
- The tier is chosen after authentication: keyed requests never consume the
  anonymous budget and vice-versa.
- Every rate-limited response carries `X-RateLimit-Limit` and
  `X-RateLimit-Remaining` for the applied tier. A denied response additionally
  carries `Retry-After` (whole seconds until the window resets).

```
X-RateLimit-Limit: 10
X-RateLimit-Remaining: 0
Retry-After: 812
```

### Concurrency guard

A separate in-flight guard caps concurrent detections (`API_MAX_CONCURRENT`,
default `10`, `0` disables). When at capacity the request is rejected with
`429 rate_limited` and message "The server is busy. Try again later." The guard
recovers from crashed requests via a bounded TTL and fails closed when its
counter file cannot be opened.

---

## 7. Caching

Successful reports are cached per normalised URL:

- **TTL:** `API_CACHE_TTL` seconds (default `300`, 5 minutes). Values are used
  as configured; the 5–15 minute span is a recommended operating range, not an
  enforced limit.
- **Key:** `sha256(schemaVersion + ":" + normalisedUrl)` — no user-controlled
  value reaches the filesystem path, so path traversal is impossible.
- **Scope:** the schema version is baked into every key, so a schema change
  never serves stale-shaped data.
- **Storage:** atomic writes (unique temp file + rename) under
  `storage/cache/api`. A failed read/write degrades silently to a miss.
- Error responses are **never** cached.
- Each cache hit returns a fresh `requestId` with the same `data`.

The cache is used by the API only; the web `/detect` page never reads it.

---

## 8. SSRF protection

The API reuses the Sprint 49 SSRF protection exactly: every outbound request
(main page, theme stylesheet downloads, CMS probe fan-out) goes through HTTP
clients that enforce `App\Modules\Http\UrlHostPolicy`, which resolves the target
host and **fails closed** against loopback, link-local, and private addresses
including encoded forms (`127.0.0.1`, `127.1`, `2130706433`, `0x7f000001`,
`[::ffff:127.0.0.1]`, etc.).

The regression suite runs a real PHP built-in fixture server on `127.0.0.1` and
asserts, for every unsafe URL form, that:

1. the API returns a `200` envelope with `success: false` and
   `errors[0].code = "transport_failure"`, and
2. the fixture server's hit log stays **empty** — no request ever reaches the
   internal host.

### Known limitation — DNS rebinding (TOCTOU)

`UrlHostPolicy` resolves the host once during validation and once at connect
time. A DNS-rebinding attack that changes the answer between those two
resolutions is **not** fully eliminated in this release. The policy is
fail-closed and the boundary is safe for a single-instance deployment; a
hardened resolver that pins validated IPs for the request lifetime is a
documented future improvement.

---

## 9. Configuration reference

All configuration is environment-based and loaded from the git-ignored `.env`
file (existing `vlucas/phpdotenv` is used; no new dependency). Values are read
by the `bootstrap/app.php` container wiring.

| Variable               | Default | Meaning |
|------------------------|---------|---------|
| `API_KEYS`             | —       | Comma-separated accepted API keys. |
| `API_KEY`              | —       | Single accepted API key (fallback). |
| `API_ANON_LIMIT`       | `10`    | Anonymous per-IP requests per window. |
| `API_ANON_WINDOW`      | `900`   | Anonymous window in seconds. |
| `API_KEYED_LIMIT`      | `60`    | Per-key requests per window. |
| `API_KEYED_WINDOW`     | `3600`  | Keyed window in seconds. |
| `API_CACHE_TTL`        | `300`   | Analysis cache TTL in seconds. |
| `API_MAX_CONCURRENT`   | `10`    | Max concurrent detections (`0` disables). |
| `HTTP_MAX_RESPONSE_BYTES` | `5242880` | Outbound HTTP response-body size cap in bytes (5 MiB). Applied to every fetched resource across both HTTP clients; oversized responses fail closed as a transport failure. |
| `HTTP_MAX_HEADER_BYTES` | `65536` | Outbound HTTP response-header size cap in bytes (64 KiB). Applied per HTTP hop across both HTTP clients; oversized header regions fail closed as a transport failure. |

An example is provided in `.env.example`.

---

## 10. Deployment limitations

- **Single instance.** Rate-limit counters, the concurrency guard, and the cache
  are local-filesystem based. Accuracy is guaranteed for one application
  instance only; horizontal scaling needs a shared store (documented future
  work).
- **Storage directory.** The API writes under `storage/api/*` and
  `storage/cache/api`. The process must be able to create those directories.
- **No CORS.** Browsers calling the endpoint directly will be subject to
  same-origin policy; use a server-to-server client.

---

## 11. Scope and non-goals

Implemented:

- `POST /api/v1/detect` with the contract above.

Not implemented in this release:

- Additional endpoints, `GET` detection, response formats other than JSON.
- CORS headers, API-key management UI, key rotation endpoint.
- Multi-instance rate limiting or shared cache.
- DNS-rebinding-immune host pinning (see §8).

---

## 12. Validation

- `vendor/bin/phpunit --testsuite tests` — full suite green.
- `vendor/bin/phpstan analyse` — Level MAX, no errors over `app/` and `tests/`.
- `vendor/bin/phpcs` — PSR-12 clean.
- `composer validate --strict` and `composer audit` — clean.
