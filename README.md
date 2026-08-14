# ThemeDetectorTool v2

> Theme detection and analysis platform built on **Kernel Framework v1**.

**Author:** Didar Alam  
**Company:** Global Kernel  
**Package:** `globalkernel/themedetector-tool`  
**Framework:** Kernel Framework v1  
**PHP:** 8.2+  
**License:** MIT (see `LICENSE`)

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
- **Theme Extraction Engine** — extracts active theme metadata for WordPress,
  Shopify, Joomla, and Drupal.
- **Plugin Detection Engine** — enterprise-grade WordPress plugin detection.
- **Detection Pipeline** — orchestrates detection stages via pipeline stage
  contracts.
- **Facade-first public API** — every module exposes a single public facade
  (`WebsiteDetector`, `ThemeExtractionManager`, `PluginDetectionManager`, ...).
- **Quality gates** — PHP 8.2, `declare(strict_types=1)`, PSR-12, PHPStan Level MAX,
  PHPUnit 11 (974 tests, 1923 assertions).

## Theme Extraction Support

The **Theme Extraction Engine** extracts active-theme metadata only where a
reliable, page-level identity exists. It never guesses: when no trustworthy
evidence is found, the theme is reported as not extracted (no name, no
fabricated version or author).

| Platform      | Theme extraction      | Why |
| ------------- | --------------------- | --- |
| WordPress     | Supported             | Canonical `style.css` header is fetched and parsed. |
| Shopify       | Supported             | `window.Shopify.theme` carries the theme name on every page. |
| Joomla        | Supported             | The active template is exposed as `/templates/{slug}/` (gated by Joomla evidence). |
| Drupal        | Supported             | The active theme is exposed as `/themes/{contrib\|custom}/{slug}/` (gated by Drupal evidence). |
| Ghost         | Not supported         | Theme identity exists only in the admin area, not in the public page. |
| TYPO3         | Not supported         | Public asset paths expose extensions (`/typo3conf/ext/`), not the active sitepackage theme. |
| Squarespace   | Not supported         | Pages expose only an opaque template id with no offline name mapping; v7.1 has no theme at all. |
| Wix           | No theme concept      | Sites are assembled from an opaque cloud builder; the served HTML carries no theme identity. |
| Webflow       | No theme concept      | Every site is a bespoke published artifact with no theme identity in the served HTML. |

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

> The application runs with zero configuration in development — the Kernel v1
> framework is configuration-less and does not read `.env`. `.env.example` is
> provided as a reference for future infrastructure wiring only; `APP_KEY` is
> not required to run the application.

## Directory Structure

```
themedetector/
├── app/                        # Application layer
│   ├── Controllers/            # HTTP controllers (Home, Loading, Detection)
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
Kernel and dispatches `routes/web.php`: the homepage accepts a website URL, the
loading page runs the client-side progress flow, and the report page shows the
detected CMS, theme, and plugins with confidence scores.

## Deployment

The web server **document root must point to `public/`**. The application entry
point is `public/index.php`; everything outside `public/` (application code,
config, tests, storage) must not be web-accessible.

- **Apache** — the repository ships `public/.htaccess`, which enables
  `mod_rewrite` front-controller routing: requests that are not existing files
  or directories are rewritten to `index.php`. Configure
  `DocumentRoot /path/to/themedetector/public` with `AllowOverride All`
  (or import the equivalent `<Directory>` directives).
- **Nginx** — point `root` at the `public/` directory and route all non-file
  requests to the front controller, e.g.:

  ```nginx
  root /path/to/themedetector/public;

  location / {
      try_files $uri $uri/ /index.php?$query_string;
  }

  location ~ \.php$ {
      include fastcgi_params;
      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
      fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
  }
  ```

- **Permissions** — `storage/` must be writable by the web server user for
  application logs.
- **Requirements** — PHP 8.2+, `ext-curl`, `ext-json`, and Composer 2.x.

## Known Limitations

- **Blocked or protected websites.** Sites behind a WAF, geo/bot protection, or
  that refuse automated HTTP requests return a `transport_failure` error report.
  Detection is limited to what a single public HTTP GET can observe.
- **Inaccessible theme stylesheet.** Theme extraction requires the canonical
  stylesheet (`style.css` on WordPress); when it cannot be fetched, the theme is
  reported as not detected even when the CMS is identified.
- **Intentionally conservative fingerprints.** Fingerprints favour precision
  over recall: generic patterns (bare path segments like `/templates/`, asset
  names like `theme.css`) are deliberately excluded, so heavily customised
  sites or sites built with generic frameworks may not be detected.
- **URL scheme.** A missing scheme is inferred as HTTPS; HTTP URLs must be
  entered explicitly. Redirects are followed up to a maximum of 10.
- **Not yet shipped.** PDF export and public REST API access are planned but not
  yet available.

## Running PHPUnit

```bash
# Run the default (unit) suite
composer test

# Run the entire test suite (unit + integration)
vendor/bin/phpunit --testsuite tests
```

`phpunit.xml` is strict: the suite fails on warnings, notices, deprecations, risky
tests, unexpected global state, and unexpected output. Current status:
**OK (974 tests, 1923 assertions)**. Benchmark classes live in `tests/Benchmark/`
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
