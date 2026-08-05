# Changelog

All notable changes to ThemeDetectorTool v2 are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/Didarcse/themedetector/compare/v0.1.0...HEAD
[0.1.0]: https://github.com/Didarcse/themedetector/releases/tag/v0.1.0
