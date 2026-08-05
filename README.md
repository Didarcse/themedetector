# ThemeDetectorTool v2

> Theme detection and analysis platform built on **Kernel Framework v1**.

**Author:** Didar Alam  
**Company:** Global Kernel  
**Package:** `globalkernel/themedetector-tool`  
**Framework:** Kernel Framework v1  
**PHP:** 8.2+  
**License:** MIT (placeholder — see `LICENSE`)

---

## Project Overview

ThemeDetectorTool v2 is a website analysis platform that inspects a target site and
answers the questions that matter for theme and plugin intelligence:

- **What CMS runs this site?**
- **Which theme is active, and what do we know about it?**
- **Which plugins / extensions are installed?**

The platform is built on the in-house **Kernel Framework v1** — an enterprise
dependency-injection and HTTP framework — and a set of self-contained detection
modules that share an immutable `DetectionContext`. The **Detection Engine**
identifies the CMS platform with confidence-scored results, the **Theme Extraction
Engine** extracts active-theme metadata, and the **Plugin Detection Engine**
discovers installed plugins. A **Detection Pipeline** orchestrates the detection
stages.

## Features

- **Kernel Framework v1** — application container, service providers, HTTP kernel,
  router, dispatcher, exception handling, views.
- **Detection Engine** — multi-platform CMS detection with confidence-scored,
  immutable results.
- **Supported platforms** — WordPress, Shopify, Wix, Squarespace, Joomla, Drupal,
  Ghost, TYPO3, Webflow.
- **Theme Extraction Engine** — extracts active theme metadata, WordPress-first.
- **Plugin Detection Engine** — enterprise-grade WordPress plugin detection.
- **Detection Pipeline** — orchestrates detection stages via pipeline stage
  contracts.
- **Facade-first public API** — every module exposes a single public facade
  (`WebsiteDetector`, `ThemeExtractionManager`, `PluginDetectionManager`, ...).
- **Quality gates** — PHP 8.2, `declare(strict_types=1)`, PSR-12, PHPStan Level MAX,
  PHPUnit 11 (729 tests, 1310 assertions).

## Requirements

- PHP 8.2 or higher
- Composer 2.x
- `ext-json` and `ext-curl` (HTTP fetching, JSON handling)
- Apache/Nginx with `mod_rewrite` enabled, or the PHP built-in server for development

## Installation

```bash
# Clone the repository
git clone https://github.com/Didarcse/themedetector.git
cd themedetector

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php -r "echo bin2hex(random_bytes(32));"
# Paste the output into APP_KEY in .env
```

> The application runs with zero configuration in development. Set `APP_ENV`,
> `APP_DEBUG`, `APP_URL`, and the `DB_*` values in `.env` when wiring real
> infrastructure.

## Directory Structure

```
themedetector/
├── app/                        # Application layer
│   ├── Controllers/            # HTTP controllers (placeholder shells)
│   ├── Core/                   # Kernel Framework v1
│   │   ├── Contracts/          # Framework contracts (ServiceProviderInterface, ...)
│   │   ├── Providers/          # Service providers
│   │   └── ...                 # Application, Container, Router, Kernel, Request, ...
│   ├── Helpers/                # Helper functions (app(), view(), ...)
│   └── Modules/                # Self-contained detection modules
│       ├── Detection/          # Detection Engine (shared DetectionContext)
│       ├── Http/               # HTTP client (cURL-based)
│       ├── Pipeline/           # Detection Pipeline
│       ├── PluginDetection/    # Plugin Detection Engine
│       ├── TechnologyDetection/# Technology Detection (foundation only)
│       └── ThemeExtraction/    # Theme Extraction Engine
├── bootstrap/
│   └── app.php                 # Application bootstrap
├── config/                     # Configuration (empty; Kernel v1 is config-less)
├── database/                   # Migrations, seeders
├── docs/                       # Architecture documentation
├── public/
│   └── index.php               # Web root / entry point
├── resources/
│   └── views/                  # View templates
├── routes/
│   └── web.php                 # Route definitions
├── storage/
│   ├── logs/                   # Application logs
│   └── phpstan/                # PHPStan cache
├── tests/
│   ├── Benchmark/              # Benchmark runners (NOT PHPUnit — run manually)
│   ├── Fixtures/               # HTML fixtures (WordPress, Shopify, ...)
│   ├── Integration/            # Integration test suite
│   └── Unit/                   # Unit test suite (default)
├── .env.example                # Environment template
├── .gitignore                  # Git ignore rules
├── composer.json               # Composer configuration
├── phpstan.neon.dist           # PHPStan configuration (level max)
├── phpunit.xml                 # PHPUnit configuration
└── README.md                   # This file
```

## Quick Start

```bash
# Start the built-in PHP server (development)
php -S localhost:8000 -t public/
```

Open <http://localhost:8000>. The web entry point (`public/index.php`) boots the
Kernel and dispatches `routes/web.php`; the current controllers and views are
placeholder shells awaiting the analysis UI.

## Running PHPUnit

```bash
# Run the default (unit) suite
composer test

# Run the entire test suite (unit + integration)
vendor/bin/phpunit --testsuite tests
```

`phpunit.xml` is strict: the suite fails on warnings, notices, deprecations, risky
tests, unexpected global state, and unexpected output. Current status:
**OK (729 tests, 1310 assertions)**. Benchmark classes live in `tests/Benchmark/`
and are deliberately **not** part of the PHPUnit suites — run them manually with
`php tests/Benchmark/<file>.php`.

## Running PHPStan

```bash
# Static analysis at Level MAX (app + tests, PHP 8.2)
composer analyse
```

`phpstan.neon.dist` analyzes `app/` and `tests/` at **level `max`** with
`phpVersion: 80200`. Zero errors required.

## Composer Commands

| Command             | Script                  | Purpose                                   |
|---------------------|-------------------------|-------------------------------------------|
| `composer test`     | `phpunit`               | Run the default PHPUnit suite             |
| `composer analyse`  | `phpstan analyse`       | Static analysis (Level MAX)               |
| `composer cs-check` | `phpcs`                 | Check code style (PSR-12)                 |
| `composer cs-fix`   | `phpcbf`                | Fix code style automatically              |

## Development Workflow

1. Branch from `main` with a scoped name (`feature/...`, `fix/...`, `release/...`).
2. Implement the change following the module conventions (see
   `docs/DetectionModuleArchitectureStandard.md`).
3. Add tests — new or modified code must be covered (unit and/or integration).
4. Gate the change locally:

   ```bash
   composer test
   composer analyse
   composer cs-check
   ```

5. Submit a pull request with the quality gates green.

## Coding Standards

- **PHP 8.2+** and `declare(strict_types=1)` in every source file.
- **PSR-12** code style, enforced with PHP_CodeSniffer.
- **PHPStan Level MAX** — zero warnings, no `@phpstan-ignore` unless justified.
- **Final/readonly value objects** and orchestration classes; immutable results.
- **Enterprise PHPDoc** on every class and public method.
- Naming: `snake_case` test methods, `test_` prefix, `camelCase` methods,
  `StudlyCase` classes, PSR-4 namespaces (`App\Core`, `App\Modules\...`).

## Architecture Overview

Kernel Framework v1 is a composition-root framework: `bootstrap/app.php` creates the
`Application`, `boot()` registers service providers in a deterministic order
(HTTP → Detection → ThemeExtraction → PluginDetection → ...), and each provider
wires its services into the `Container`. The HTTP `Kernel` matches the route,
dispatches it, and renders errors through the `ExceptionHandler`.

Detection modules follow one shared contract (canonical spec in
`docs/DetectionModuleArchitectureStandard.md`):

1. `HttpResponse` from the **Http** module feeds the `DetectionContextFactory`,
   which produces an immutable `DetectionContext` (url, final url, html, status,
   headers, response time).
2. A module **facade** delegates to a **manager**, which iterates its
   **detector registry** and lets the first supporting detector win.
3. Detectors return immutable **result value objects** carrying raw metadata,
   platform, and confidence.

Current modules:

- **Detection Engine** — CMS detection (WordPress, Shopify, Wix, Squarespace,
  Joomla, Drupal, Ghost, TYPO3, Webflow). Facade: `WebsiteDetector`.
- **Theme Extraction Engine** — active theme metadata. WordPress-first. Facade:
  `ThemeExtractionManager`.
- **Plugin Detection Engine** — WordPress plugin detection. Facade:
  `PluginDetectionManager`.
- **Detection Pipeline** — orchestration of stages. Facade: `DetectionPipeline`.

Related docs: `docs/DetectionModuleArchitectureStandard.md`,
`docs/WebsiteAnalysisArchitecture.md`, `docs/WebsiteIntelligenceEngineArchitecture.md`.

## License

MIT — see [LICENSE](LICENSE).
