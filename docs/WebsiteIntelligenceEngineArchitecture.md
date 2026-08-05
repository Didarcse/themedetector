# Website Intelligence Engine — Orchestration Architecture

> **Status:** Official architecture (design only, no implementation)
> **Project:** ThemeDetectorTool v2 · **Framework:** Kernel Framework v1
> **Runtime:** PHP 8.2 · **Code style:** PSR-12 · **Analysis:** PHPStan Level MAX · **Testing:** PHPUnit 11
> **Supersedes/extends:** `docs/DetectionModuleArchitectureStandard.md`, `docs/WebsiteAnalysisArchitecture.md`

This document is the canonical orchestration architecture for the **Website
Intelligence Engine**. The engine coordinates every detection module — existing
and future — into a single deterministic pipeline that produces one unified,
immutable `WebsiteIntelligenceReport`.

This specification contains **no production code**. It defines structure, classes,
responsibilities, relationships, and rules only.

---

## 1. Purpose and Non-goals

### Purpose

- Expose exactly one public entry point for full-site intelligence: `WebsiteIntelligenceEngine`.
- Coordinate every detection module in a fixed, deterministic order.
- Aggregate each module's normalized output into one immutable report.
- Remain open for future modules (Technology, Analytics, CDN, Security, SEO,
  Performance) with **no breaking API changes**.

### Non-goals

The engine never performs:

- detection logic;
- parsing;
- HTTP;
- business logic;
- persistence.

All of those belong to the individual modules and to `App\Modules\Http`. The engine
is a pure orchestrator: it routes, collects, and assembles.

---

## 2. Architecture Diagram

```
                         URL (string)
                              │
                              ▼
              ┌──────────────────────────────────────────────┐
              │          WebsiteIntelligenceEngine          │   facade — the ONLY public API
              │  (single delegated fetch + context build)   │
              └──────────────────────────────────────────────┘
                  │ HttpClientInterface │ DetectionContextFactory
                  ▼                     ▼
              ┌──────────────────────────────────────────────┐
              │          WebsiteContextResolver              │   transport boundary
              │         URL → DetectionContext               │
              └──────────────────────────────────────────────┘
                              │ DetectionContext (immutable, shared)
                              ▼
              ┌──────────────────────────────────────────────┐
              │        WebsiteIntelligenceManager            │   orchestrator — pure
              │  iterate registry · run supporting modules   │
              └──────────────────────────────────────────────┘
                              │
                              ▼
              ┌──────────────────────────────────────────────┐
              │         WebsiteModuleRegistry                │   deterministic collection
              │  stores WebsiteModuleInterface in order      │
              └──────────────────────────────────────────────┘
                              │  supports() / run()
                              ▼
   ┌────────────┬─────────────┬─────────────┬─────────────┬────────────┐
   ▼            ▼             ▼             ▼             ▼            ▼
CmsDetection  ThemeDetection ThemeExtraction PluginDetection  ...future modules
   Module       Module         Module         Module       (Technology, Analytics,
   │            │              │              │             CDN, Security, SEO,
   ▼            ▼              ▼              ▼             Performance)
WebsiteModuleResult  ·  WebsiteModuleResult  ·  WebsiteModuleResult
                              │
                              ▼
              ┌──────────────────────────────────────────────┐
              │      WebsiteIntelligenceReport (immutable)   │   aggregate — canonical output
              │   url · schemaVersion · list<WebsiteModuleResult>  │
              └──────────────────────────────────────────────┘
```

### 2.1 Canonical pipeline

```
URL
 ↓
DetectionContext          ← WebsiteContextResolver (Http + DetectionContextFactory)
 ↓
WebsiteModuleRegistry     ← ordered module collection
 ↓
WebsiteIntelligenceManager
 ↓
Theme Detection      Module
 ↓
Theme Extraction     Module
 ↓
Plugin Detection     Module
 ↓
Technology Detection Module
 ↓
Analytics Detection  Module
 ↓
CDN Detection        Module
 ↓
Security Detection   Module
 ↓
SEO Detection        Module
 ↓
Performance Detection Module
 ↓
WebsiteIntelligenceReport
```

The module order above is the canonical pipeline order. Modules that do not support
the context are skipped and produce no result entry; supporting modules are run in
registration order and every result is collected. The pipeline never short-circuits:
a report aggregates **all** module outcomes, including zero.

---

## 3. Folder Structure

```
app/Modules/WebsiteIntelligence/
├── Contracts/
│   ├── WebsiteModuleInterface.php          # common contract for every module
│   └── ContextResolverInterface.php        # URL → DetectionContext boundary
├── Providers/
│   └── WebsiteIntelligenceServiceProvider.php   # idempotent container wiring
├── Exceptions/
│   └── WebsiteIntelligenceException.php    # extends RuntimeException
├── WebsiteIntelligenceEngine.php           # facade — the only public API
├── WebsiteIntelligenceManager.php          # orchestrator — runs modules in order
├── WebsiteIntelligenceReport.php           # aggregate immutable value object
├── WebsiteModuleRegistry.php               # deterministic collection of modules
├── WebsiteModuleResult.php                 # normalized per-module outcome
├── WebsiteContextResolver.php              # URL → DetectionContext (single fetch)
└── Modules/                                # one adapter per detection module
    ├── CmsDetectionModule.php              # wraps the CMS Detection engine
    ├── ThemeDetectionModule.php            # wraps the Theme Detection engine
    ├── ThemeExtractionModule.php           # wraps the Theme Extraction engine
    ├── PluginDetectionModule.php           # wraps the Plugin Detection engine
    ├── TechnologyDetectionModule.php       # future
    ├── AnalyticsDetectionModule.php        # future
    ├── CdnDetectionModule.php              # future
    ├── SecurityDetectionModule.php         # future
    ├── SeoDetectionModule.php              # future
    └── PerformanceDetectionModule.php      # future
```

Tests mirror the tree:

```
tests/Unit/WebsiteIntelligence/
├── WebsiteModuleRegistryTest.php
├── WebsiteIntelligenceManagerTest.php
├── WebsiteIntelligenceEngineTest.php
├── WebsiteIntelligenceReportTest.php
├── WebsiteModuleResultTest.php
├── WebsiteContextResolverTest.php
└── Modules/
    ├── CmsDetectionModuleTest.php
    ├── ThemeDetectionModuleTest.php
    ├── ThemeExtractionModuleTest.php
    └── PluginDetectionModuleTest.php
tests/Integration/WebsiteIntelligence/
└── WebsiteIntelligenceIntegrationTest.php
```

---

## 4. Class List

| Class | Kind | Role |
| ------------------------------ | ------------------ | ---------------------------------------------------------- |
| `WebsiteIntelligenceEngine` | Facade | The only public entry point. Accepts a URL, delegates the single fetch and context build, then delegates analysis to the manager. |
| `WebsiteIntelligenceManager` | Orchestrator | Iterates the registry in order, runs every supporting module, collects the normalized results, and assembles the report. Pure orchestration. |
| `WebsiteIntelligenceReport` | Aggregate value object | Immutable aggregation of every module result plus the analyzed URL and schema version. |
| `WebsiteModuleRegistry` | Collection | Deterministic registry of `WebsiteModuleInterface` in registration order. |
| `WebsiteModuleResult` | Value object | Immutable normalized outcome of a single module run. |
| `WebsiteModuleInterface` | Contract | `name()`, `supports()`, `run()` for every module. |
| `ContextResolverInterface` | Contract | `resolve(string $url): DetectionContext` boundary. |
| `WebsiteContextResolver` | Adapter | Implements the boundary using `HttpClientInterface` + `DetectionContextFactory`. |
| `<X>DetectionModule` | Adapter | Wraps one detection engine and normalizes its output into `WebsiteModuleResult`. |
| `WebsiteIntelligenceServiceProvider` | Provider | Idempotently registers the registry (empty), the manager, and the facade. |
| `WebsiteIntelligenceException` | Exception | Domain exception; only when a module cannot produce a result. |

---

## 5. Responsibilities

### 5.1 `WebsiteIntelligenceEngine` (facade)

- Accept a URL and return a `WebsiteIntelligenceReport`.
- Perform the single delegated fetch through `ContextResolverInterface`.
- Delegate analysis to `WebsiteIntelligenceManager`.
- Own no detection, parsing, business logic, or HTTP of its own.

```php
final readonly class WebsiteIntelligenceEngine
{
    public function __construct(
        private WebsiteIntelligenceManager $manager,
        private ContextResolverInterface $contextResolver,
    ) {}

    public function analyze(string $url): WebsiteIntelligenceReport;
}
```

### 5.2 `WebsiteIntelligenceManager` (orchestrator)

- Iterate `WebsiteModuleRegistry::all()` in registration order.
- Invoke `supports($context)` on each module.
- Run every supporting module once via `run($context)`.
- Collect all `WebsiteModuleResult` in pipeline order.
- Assemble the `WebsiteIntelligenceReport`.
- Perform **no** detection, parsing, HTTP, or business logic.

```php
final readonly class WebsiteIntelligenceManager
{
    public function __construct(private WebsiteModuleRegistry $registry) {}

    public function analyze(DetectionContext $context): WebsiteIntelligenceReport;
}
```

Behaviour contract:

- A module whose `supports()` returns `false` is skipped and never run.
- Every supporting module is run exactly once, in registration order.
- The manager never modifies the `DetectionContext`.
- Deterministic: same registry + same context ⇒ same report.
- An empty or all-unsupported registry yields a valid empty report (never an exception).

### 5.3 `WebsiteModuleRegistry` (collection)

- Store `WebsiteModuleInterface` implementations in registration order.
- Return them unchanged via `all()`.
- Perform no filtering, deduplication, sorting, or orchestration.

```php
final class WebsiteModuleRegistry
{
    public function register(WebsiteModuleInterface $module): void;

    /** @return list<WebsiteModuleInterface> */
    public function all(): array;
}
```

### 5.4 `WebsiteModuleInterface` (contract)

```php
interface WebsiteModuleInterface
{
    /** Canonical module identifier, e.g. 'theme-detection'. */
    public function name(): string;

    /** Whether the module can analyze this context. */
    public function supports(DetectionContext $context): bool;

    /** Run the module and return its normalized outcome. */
    public function run(DetectionContext $context): WebsiteModuleResult;
}
```

Rules:

- `name()` returns a stable, unique, snake_case identifier used for lookup and reporting.
- `run()` must return a `WebsiteModuleResult`; a module that cannot detect returns a
  failed result, never an exception.
- The contract is platform-agnostic and module-agnostic; it knows nothing about
  WordPress, Shopify, or any sibling module.

### 5.5 `WebsiteModuleResult` (value object)

```php
final readonly class WebsiteModuleResult
{
    public function __construct(
        private string $module,          // matches the module's name()
        private bool $detected,
        private int $confidence,         // 0–100
        private array $payload = [],     // array<string, mixed> normalized domain output
        private array $extra = [],       // array<string, mixed> extension point
    ) {}
}
```

- `payload` is the normalized module output (e.g. theme summary, plugin list,
  security findings). It is the module's responsibility to normalize; the engine
  never interprets it.
- `extra()` is the future-proof extension point; it must never duplicate first-class
  properties.
- Failed modules produce `detected: false, confidence: 0, payload: []`.

### 5.6 `WebsiteIntelligenceReport` (aggregate)

```php
final readonly class WebsiteIntelligenceReport
{
    public const SCHEMA_VERSION = 1;

    public function __construct(
        private string $url,             // final analyzed URL
        private array $results,          // list<WebsiteModuleResult>, pipeline order
        private int $schemaVersion = self::SCHEMA_VERSION,
        private array $extra = [],
    ) {}
}
```

- Immutable aggregate: one per analyzed URL.
- `results()` returns every module result in pipeline order.
- `schemaVersion()` enables schema evolution without breaking consumers.
- Getters only — no derived business values, no aggregation math.

### 5.7 `WebsiteContextResolver` (adapter / boundary)

- Resolve a URL into a `DetectionContext` by delegating the single HTTP request to
  `App\Modules\Http\HttpClientInterface` and building the context through
  `DetectionContextFactory`.
- The **only** network touchpoint in the engine.
- Injected through `ContextResolverInterface` so the engine stays transport-agnostic.

### 5.8 `<X>DetectionModule` (adapters)

Each module adapter:

- wraps one underlying detection engine (e.g. `PluginDetectionManager`);
- maps `supports()` onto the underlying engine;
- maps the underlying result into `WebsiteModuleResult` with a normalized `payload`;
- is `final readonly`, constructed with the underlying engine via DI;
- contains no engine logic of its own.

---

## 6. Dependency Graph

```
WebsiteIntelligenceEngine
 ├── WebsiteIntelligenceManager
 └── ContextResolverInterface
      └── WebsiteContextResolver
           ├── HttpClientInterface          (App\Modules\Http)
           └── DetectionContextFactory      (App\Modules\Detection)

WebsiteIntelligenceManager
 └── WebsiteModuleRegistry
      └── list<WebsiteModuleInterface>

WebsiteModuleInterface (Contracts)
 └── DetectionContext                       (App\Modules\Detection, shared)

<X>DetectionModule  ──▶  underlying engine   (App\Modules\PluginDetection, etc.)
<X>DetectionModule  ──▶  WebsiteModuleResult

WebsiteIntelligenceReport
 └── list<WebsiteModuleResult>
```

Dependency rules:

1. `WebsiteIntelligence` depends only on `App\Modules\Detection` (shared context +
   factory) and `App\Modules\Http` (transport boundary). Never the reverse.
2. The engine, manager, registry, and report never reference a concrete module or
   concrete platform.
3. Module adapters point **outward** to their engine; the engine never points inward
   to the adapters.
4. `App\Core` touches the module only via `ServiceProviderInterface`.

---

## 7. SOLID Compliance

| Principle | Application |
| --------- | ------------------------------------------------------------------ |
| **S** | Engine fetches+delegates, manager coordinates, registry stores, modules detect, result carries data. One job per class. |
| **O** | New modules implement `WebsiteModuleInterface` and are registered. Engine, manager, registry, and report never change. |
| **L** | Every module is a drop-in for `WebsiteModuleInterface`; the manager treats all modules identically. |
| **I** | `WebsiteModuleInterface` exposes only `name()`, `supports()`, `run()`. `ContextResolverInterface` only `resolve()`. No fat interfaces. |
| **D** | The engine depends on `ContextResolverInterface`; the manager on `WebsiteModuleInterface`. Concretes are injected through constructors. |

---

## 8. Development Rules

1. **Pure orchestration.** The manager and engine never contain detection, parsing,
   business logic, or HTTP.
2. **Deterministic pipeline.** Module order is registration order; identical input
   yields identical output.
3. **Fail closed, never throw.** A non-supporting or failed module contributes a
   failed/skipped outcome — never an exception. The empty report is valid.
4. **Immutable everything.** Report, result, and context are `final readonly`.
5. **Single transport boundary.** The only HTTP is the delegated fetch in
   `WebsiteContextResolver`.
6. **Interfaces only in composition.** Concretes are wired through constructor
   injection at the service provider.
7. **Schema-versioned output.** The report carries `SCHEMA_VERSION`; any output-shape
   change bumps it rather than mutating fields.
8. **No module knowledge leak.** The engine never inspects `payload` structure.

---

## 9. Service Provider Wiring

```php
final class WebsiteIntelligenceServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        // WebsiteModuleRegistry      → new WebsiteModuleRegistry()       (intentionally empty)
        // WebsiteIntelligenceManager → new WebsiteIntelligenceManager($registry)
        // WebsiteIntelligenceEngine  → new WebsiteIntelligenceEngine($manager, new WebsiteContextResolver(...))
    }
}
```

Rules:

- Idempotent (`has()` guard) and lazy (container closures).
- The registry is registered empty; modules are added at composition time.
- Boot order: `Http → Detection → … → WebsiteIntelligence` (after every module it
  coordinates).

---

## 10. Testing Strategy

### 10.1 Unit tests (real object under test, mocked collaborators)

| Class under test | Test | Style |
| ----------------------------- | ---------------------------------------------- | ------------------------------------------------- |
| `WebsiteModuleRegistry` | `WebsiteModuleRegistryTest` | real registry, mocked `WebsiteModuleInterface`. |
| `WebsiteIntelligenceManager` | `WebsiteIntelligenceManagerTest` | real manager + real registry, mocked modules. |
| `WebsiteIntelligenceReport` | `WebsiteIntelligenceReportTest` | real report, real `WebsiteModuleResult`. |
| `WebsiteModuleResult` | `WebsiteModuleResultTest` | no mocks, immutable contract. |
| `WebsiteContextResolver` | `WebsiteContextResolverTest` | real resolver, mocked `HttpClientInterface`. |
| `<X>DetectionModule` | `Modules/<X>DetectionModuleTest` | real adapter, mocked underlying engine. |

Manager test behaviour to verify explicitly:

- runs every supporting module in registration order;
- skips non-supporting modules without calling `run()`;
- calls `run()` exactly once per supporting module;
- collects results in pipeline order;
- never modifies the supplied `DetectionContext`;
- deterministic across repeated runs;
- empty / all-unsupported registry → valid empty report.

### 10.2 Integration test

`WebsiteIntelligenceIntegrationTest` assembles the **real** engine, manager,
registry, and all **real** module adapters wired to their **real** engines. The only
mock is `HttpClientInterface` injected into the real `WebsiteContextResolver` (the
transport boundary).

Verifies observable behaviour:

- a representative HTML page → report with every supporting module's result;
- results appear in canonical pipeline order;
- confidence values are preserved;
- the analyzed URL and schema version are correct;
- the failed/empty page → deterministic report with only failed/skipped outcomes;
- determinism across repeated runs.

### 10.3 Quality gates

- `vendor/bin/phpunit --testsuite tests` → green.
- `vendor/bin/phpstan analyse` → `[OK] No errors`.
- PSR-12 clean. PHP 8.2, `declare(strict_types=1)` in every file.

---

## 11. Future Extensibility

- **New detection module** (Technology, Analytics, CDN, Security, SEO, Performance):
  implement `WebsiteModuleInterface` under `Modules/`, register it at composition
  time. No changes to the engine, manager, registry, or report.
- **New module output field:** extend `WebsiteModuleResult::extra()` or bump the
  report `SCHEMA_VERSION`.
- **New transport** (queue, CLI, REST): add another `ContextResolverInterface`
  implementation; the engine is unchanged.
- **Consumers** rely only on `WebsiteIntelligenceReport` and `WebsiteModuleResult`;
  module specifics stay behind `payload`/`extra`.

---

## 12. Definition of Done

- [ ] Folder structure and class list match this specification.
- [ ] The engine exposes exactly one public method: `analyze()`.
- [ ] The manager is pure orchestration: order, supports, run, collect, assemble.
- [ ] The registry stores modules in registration order and nothing more.
- [ ] The report is `final readonly` and aggregates `list<WebsiteModuleResult>`.
- [ ] No detection, parsing, HTTP, business logic, or persistence in the engine layer.
- [ ] Unit test for every production class; integration test for the full pipeline.
- [ ] `phpunit --testsuite tests` green · `phpstan analyse` `[OK]` · PSR-12 clean.
