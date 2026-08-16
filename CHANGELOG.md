# Changelog

All notable changes to ThemeDetectorTool v2 are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.2.0] - 2026-08-16

### Added

#### Technology Detection Engine v1

- Technology Detection v1 — a new engine that inspects the already-fetched HTML
  and final URL for the technologies running on a site.
- JavaScript library detection: jQuery, jQuery UI, React, Vue, Angular,
  Bootstrap, Alpine.js, and Lodash.
- CDN detection: Cloudflare, CloudFront, jsDelivr, and unpkg.
- Analytics detection: Google Analytics, Google Tag Manager, Meta Pixel,
  Plausible, Matomo, Hotjar, and Microsoft Clarity.
- Multi-hit aggregation: every supporting category detector is consulted and
  its results are aggregated, then deduplicated deterministically by slug
  (highest confidence wins).
- Technologies report card on the Detection Report page.
- Public API v1 `technologies` field now also includes the detected JavaScript
  libraries, CDNs, and analytics platforms. The API schema stays `v1`.
- Fail-open behavior: a Technology Detection failure never breaks the report;
  it degrades to an empty technology list.
- No additional outbound HTTP requests: the engine runs against the existing
  `DetectionContext` only.

### Quality Gates

- PHPUnit 11: 1391 tests, 3530 assertions passing.
- PHPStan Level MAX: 0 errors.
- PHP_CodeSniffer PSR-12: 0 errors.
- Composer audit: 0 security advisories.

## [2.1.1] - 2026-08-15

### Added

- Outbound HTTP response-header size limit (64 KiB default, configurable via
  `HTTP_MAX_HEADER_BYTES`). Applied per HTTP hop across both HTTP clients;
  oversized header regions are failed closed as a transport failure.

### Quality Gates

- PHPUnit 11: 1270 tests, 3101 assertions passing.
- PHPStan Level MAX: 0 errors.
- PHP_CodeSniffer PSR-12: 0 errors.
- Composer audit: 0 security advisories.

## [2.1.0] - 2026-08-15

### Added

- Public Detection API v1 — a single `POST /api/v1/detect` endpoint exposing the
  existing detection pipeline over JSON.
- API authentication via Bearer API keys, per-IP and per-key rate limiting, a
  concurrency workload guard, and a response cache.
- Shopify theme extraction from the `window.Shopify` global.
- Joomla template extraction gated by Joomla evidence.
- Drupal theme extraction gated by Drupal evidence.
- `robots.txt` and `sitemap.xml` served through the front controller.
- Production-domain canonical SEO metadata.
- Outbound HTTP response-body size limit (5 MiB default, configurable via
  `HTTP_MAX_RESPONSE_BYTES`).
- Security response headers (`X-Content-Type-Options`, `Referrer-Policy`) on
  HTML and JSON responses.
- Runtime extension declarations for `ext-curl` and `ext-json`.
- Benchmark cases for Joomla, Drupal, Ghost, TYPO3, and Squarespace.

### Changed

- Outbound HTTP hardened against SSRF with a fail-closed URL policy covering
  loopback, private, link-local, multicast, and encoded-address forms.
- Theme extraction support scope frozen: WordPress, Shopify, Joomla, and Drupal
  are extracted; Ghost, TYPO3, and Squarespace are explicitly unsupported; Wix
  and Webflow expose no theme concept.

### Quality Gates

- PHPUnit 11: 1254 tests, 3058 assertions passing.
- PHPStan Level MAX: 0 errors.
- PHP_CodeSniffer PSR-12: 0 errors.
- Composer audit: 0 security advisories.

## [2.0.0] - 2026-08-14

### Added

#### Detection Report Workflow

- Complete end-to-end detection report workflow: homepage URL submission,
  loading/progress page, and a structured Detection Report page rendered
  through the shared layout system.
- `POST /detect` report endpoint, `GET /loading` flow, and `GET /health`
  health check route.
- Immutable domain `DetectionReport` and `DetectionReportViewModel`
  assembled by `WebsiteReportAnalyzer` (URL normalization, transport,
  detection, theme extraction, and plugin detection orchestration).
- In-memory detection: no results are stored and no account is required.

#### Shared Layout System

- Bootstrap 5.3 shared layout with SEO metadata (canonical, Open Graph,
  Twitter Cards, robots), semantic partials (navbar, footer, hero,
  FAQ schema), and responsive report/plugin cards.
- Copy-report action and "coming soon" placeholders for PDF export and API
  access.

#### Plugin Detection Engine

- WordPress plugin CSS asset rule and expanded plugin detection test
  coverage.

#### Benchmark Framework

- Manual detection benchmark runners under `tests/Benchmark/` covering
  WordPress, Shopify, Webflow, and Wix cases.

### Changed

- Improved WordPress theme stylesheet detection accuracy.
- Improved Detection Report presentation and UX (confidence scores,
  detection summary, empty states, error handling).
- Hardened detection transport and fingerprint handling.

### Fixed

- Hardened Drupal and TYPO3 detection fingerprints against false positives.
- Hardened Drupal API endpoint detection.
- Cross-CMS false-positive hardening for Joomla, Shopify, Wix, Ghost, and
  Squarespace: removed generic fingerprints (bare path segments, generic
  asset filenames, generic JavaScript idioms) that matched non-CMS content,
  keeping only platform-distinctive signals.

### Quality Gates

- PHPUnit 11: 793 tests, 1546 assertions passing.
- PHPStan Level MAX: 0 errors.
- PHP_CodeSniffer PSR-12: 0 errors.
- Composer audit: 0 security advisories.

## [0.1.0] - 2026-08-05

### Added

#### Kernel Framework v1

- `App\Core\Application` composition root: container ownership, service provider
  collection, and deterministic `boot()`.
- `App\Core\Container` dependency injection container (constructor injection,
  resolvable bindings, `Closure` support via `opis/closure`).
- `App\Core\ServiceProviderInterface` + `App\Core\Providers` service provider
  pattern for framework and module wiring.
- `App\Core\Kernel` HTTP request lifecycle (route matching, dispatch, exception
  rendering).
- `App\Core\Router`, `App\Core\Dispatcher`, `App\Core\ExceptionHandler`,
  `App\Core\Request`, `App\Core\Response`, `App\Core\Route`, `App\Core\View`, and
  the middleware contract.
- `bootstrap/app.php` entry bootstrap and `App\Helpers` (framework helpers).

#### Detection Engine

- Immutable, shared `DetectionContext` (`App\Modules\Detection`) produced by the
  `DetectionContextFactory` from HTTP responses.
- `App\Modules\Detection` platform detectors with confidence-scored, immutable
  results: WordPress, Shopify, Wix, Squarespace, Joomla, Drupal, Ghost, TYPO3,
  Webflow.
- `App\Modules\Detection` `DetectionManager` (highest-confidence wins),
  `DetectorRegistry`, `DetectorInterface`, and the `RuleInterface` contract.
- `WebsiteDetector` facade as the single public entry point.

#### Theme Detection

- Theme detection rules over the shared `DetectionContext`, integrated into the
  Detection Engine's result model.

#### Theme Extraction Engine

- `App\Modules\ThemeExtraction` extraction pipeline: `ThemeExtractionManager`,
  `ThemeExtractorRegistry`, `ThemeExtractor` contract, and immutable
  `ThemeExtractionResult` / `ThemeMetadata` value objects.
- WordPress theme extraction (active theme resolution and metadata mapping).
- `ThemeExtractionManager` facade as the public entry point.

#### Plugin Detection Engine

- `App\Modules\PluginDetection` WordPress plugin detection:
  `PluginDetectionManager`, `PluginRegistry`, `PluginMetadata`, immutable
  `PluginDetectionResult`/`PluginMetadata` value objects.
- WordPress plugin rules: path rules, CSS asset rules, slug extraction, and
  metadata mapping (`WordPressPluginDetector`, `PluginPathRule`,
  `PluginCssAssetRule`, `PluginSlugExtractor`, `PluginMetadataMapper`,
  `RawPluginMetadata`).

#### Detection Pipeline

- `App\Modules\Pipeline` orchestration: `DetectionPipeline` facade,
  `PipelineManager`, `PipelineResult`, `PipelineRegistry`, and the
  `PipelineStageInterface` contract.

#### HTTP Module

- `App\Modules\Http` cURL-based HTTP client (`HttpClient`, `CurlHttpClient`,
  `CurlFactory`, `UserAgent`, `RequestOptions`), immutable `HttpResponse`, and
  `HttpException` handling.

#### Quality Gates

- PHPUnit 11 suite (`phpunit.xml`): unit + integration suites, strict
  fail-on-warning/deprecation/risky configuration.
- PHPStan configuration (`phpstan.neon.dist`) at Level MAX over `app/` and
  `tests/`.
- PSR-12 code style via PHP_CodeSniffer.
- Architecture standards documentation
  (`docs/DetectionModuleArchitectureStandard.md`,
  `docs/WebsiteAnalysisArchitecture.md`,
  `docs/WebsiteIntelligenceEngineArchitecture.md`).

[Unreleased]: https://github.com/Didarcse/themedetector/compare/v2.2.0...HEAD
[2.2.0]: https://github.com/Didarcse/themedetector/compare/v2.1.1...v2.2.0
[2.1.1]: https://github.com/Didarcse/themedetector/compare/v2.1.0...v2.1.1
[2.1.0]: https://github.com/Didarcse/themedetector/compare/v2.0.0...v2.1.0
[2.0.0]: https://github.com/Didarcse/themedetector/compare/v0.1.0...v2.0.0
[0.1.0]: https://github.com/Didarcse/themedetector/releases/tag/v0.1.0
