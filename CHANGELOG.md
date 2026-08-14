# Changelog

All notable changes to ThemeDetectorTool v2 are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/Didarcse/themedetector/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/Didarcse/themedetector/compare/v0.1.0...v2.0.0
[0.1.0]: https://github.com/Didarcse/themedetector/releases/tag/v0.1.0
