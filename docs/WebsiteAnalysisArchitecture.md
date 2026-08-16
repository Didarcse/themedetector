# Website Analysis Architecture

**ThemeDetectorTool v2** — Kernel Framework v1
**Document type:** Architecture (design only, no implementation)
**Scope:** Website Analysis engine — the highest-level public API of ThemeDetectorTool v2

---

## 1. Overview

Website Analysis is the top-level orchestration layer of ThemeDetectorTool v2.
It coordinates every detection and analysis engine into a single, deterministic
workflow and produces one unified, immutable result.

```
          ┌────────────────────────────────────────────────────────────┐
          │                    WebsiteAnalyzer                         │
          │               (only public entry point)                    │
          └───────────────┬────────────────────────────────────────────┘
                          │ analyze(string $url)
                          ▼
          ┌────────────────────────────────────────────────────────────┐
          │  WebsiteAnalysisManager  (pure orchestrator / pipeline)    │
          └───┬──────────┬──────────────┬──────────────┬───────────────┘
              │          │              │              │
              ▼          ▼              ▼              ▼
        Detection   ThemeExtraction PluginDetection Technology  WebsiteIntelligence
        Engine       Engine           Engine          Engine       Engine
        (exists)     (exists)         (future)        (exists)     (future)
              │          │              │              │              │
              └──────────┴──────────────┴──────────────┴───────────────┘
                          │
                          ▼
              WebsiteAnalysisResult (unified)
```

The five engines are composed in a strict order. Each engine consumes the
immutable analysis context produced by the previous stage, appends its own
normalized result, and passes the context forward. The final context is
compiled into a single `WebsiteAnalysisResult`.

---

## 2. Goals

- Expose exactly one public API for full-site analysis: `WebsiteAnalyzer`.
- Coordinate all engines with zero business logic in the coordinator.
- Guarantee deterministic, side-effect-free execution for identical inputs.
- Keep every engine independently extensible (Open/Closed).
- Remain transport-agnostic (HTTP today; queue, CLI, REST, SaaS tomorrow).
- Produce AI-consumable, schema-versioned, evidence-backed results.
- Keep the analysis module free of platform-specific knowledge
  (WordPress, Shopify, Ghost, Joomla, Drupal, TYPO3, etc.).

### Non-goals

- The Analysis module does not perform CMS detection, theme extraction,
  plugin detection, technology detection, or SEO/security/performance/
  accessibility analysis itself. It coordinates engines that do.
- It performs no HTTP requests beyond a single delegated fetch through the
  HTTP module.

---

## 3. Module placement

The Analysis module lives alongside the existing modules:

```
app/
├── Core/                                  # Kernel Framework core (existing)
├── Modules/
│   ├── Http/                              # Transport (existing)
│   ├── Detection/                         # Detection Engine (existing)
│   ├── ThemeExtraction/                   # Theme Extraction Engine (existing)
│   ├── PluginDetection/                   # Plugin Detection Engine (future)
│   ├── TechnologyDetection/                # Technology Detection Engine v1 (shipped)
│   ├── Analysis/                          # Website Analysis Engine (this module)
│   └── ...
└── ...
```

### Folder structure

```
app/Modules/Analysis/
├── Providers/
│   └── WebsiteAnalysisServiceProvider.php   # composition root of the module
├── Contracts/
│   ├── AnalysisStageInterface.php           # contract for every pipeline stage
│   ├── IntelligenceAnalyzerInterface.php    # contract for every intelligence analyzer
│   └── ResultSerializerInterface.php        # contract for result serializers
├── WebsiteAnalyzer.php                      # facade — the only public API
├── WebsiteAnalysisManager.php               # orchestrator — runs the stage pipeline
├── WebsiteAnalysisContext.php               # immutable per-run state (value object)
├── WebsiteAnalysisResult.php                # unified immutable output (value object)
├── AnalysisStage.php                        # enum of pipeline stages
├── AnalysisStageResult.php                  # immutable per-stage outcome (value object)
├── Core/
│   └── AnalysisPipeline.php                 # executes an ordered stage list
├── Stages/
│   ├── CmsDetectionStage.php                # adapter → Detection Engine
│   ├── ThemeExtractionStage.php             # adapter → Theme Extraction Engine
│   ├── PluginDetectionStage.php             # adapter → Plugin Detection Engine
│   ├── TechnologyDetectionStage.php         # adapter → Technology Engine
│   └── IntelligenceStage.php                # adapter → Website Intelligence Engine
├── Intelligence/
│   ├── WebsiteIntelligenceEngine.php        # orchestrates the sub-analyzers
│   ├── WebsiteIntelligenceReport.php        # aggregate intelligence value object
│   ├── Seo/                                # SEO analyzers (future)
│   ├── Security/                           # Security analyzers (future)
│   ├── Performance/                        # Performance analyzers (future)
│   └── Accessibility/                      # Accessibility analyzers (future)
├── Serializers/
│   ├── JsonResultSerializer.php            # REST/CLI/SaaS JSON output
│   └── AnalysisBriefCompiler.php           # token-efficient AI summary
└── Exceptions/
    └── AnalysisException.php
```

### Namespace map

| Location                          | Namespace                              |
|-----------------------------------|----------------------------------------|
| `app/Modules/Analysis`            | `App\Modules\Analysis`                 |
| `app/Modules/Analysis/Providers`  | `App\Modules\Analysis\Providers`       |
| `app/Modules/Analysis/Contracts`  | `App\Modules\Analysis\Contracts`       |
| `app/Modules/Analysis/Core`       | `App\Modules\Analysis\Core`            |
| `app/Modules/Analysis/Stages`     | `App\Modules\Analysis\Stages`          |
| `app/Modules/Analysis/Intelligence`| `App\Modules\Analysis\Intelligence`   |
| `app/Modules/Analysis/Serializers`| `App\Modules\Analysis\Serializers`    |
| `app/Modules/Analysis/Exceptions` | `App\Modules\Analysis\Exceptions`     |
| `app/Modules/PluginDetection`     | `App\Modules\PluginDetection`          |
| `app/Modules/TechnologyDetection`  | `App\Modules\TechnologyDetection`       |

---

## 4. Public API

`WebsiteAnalyzer` is the only class external consumers interact with.

```php
final readonly class WebsiteAnalyzer
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private WebsiteAnalysisManager $manager,
    );

    public function analyze(string $url): WebsiteAnalysisResult;
}
```

- `analyze()` performs the transport fetch, builds the
  `WebsiteAnalysisContext`, delegates to `WebsiteAnalysisManager`, and
  returns the compiled `WebsiteAnalysisResult`.
- It performs no detection, no extraction, and no analysis logic.

---

## 5. Core types

### 5.1 `WebsiteAnalysisContext` (value object)

Immutable per-run state carried through the pipeline.

```php
final readonly class WebsiteAnalysisContext
{
    // originalUrl, finalUrl, statusCode, responseTime, headers
    // DetectionContext (transport view)
    // map of stage → AnalysisStageResult (append-only)

    public function withStageResult(AnalysisStageResult $result): self; // returns new context
    public function stageResult(AnalysisStage $stage): ?AnalysisStageResult;
    public function allStageResults(): array;
}
```

- Append-only: stages never mutate state; they return a new context.
- Deterministic: identical inputs produce identical contexts.

### 5.2 `AnalysisStage` (enum)

```php
enum AnalysisStage
{
    case CMS_DETECTION;
    case THEME_EXTRACTION;
    case PLUGIN_DETECTION;
    case TECHNOLOGY_DETECTION;
    case INTELLIGENCE;
}
```

The enum is the single source of truth for stage identity and ordering.

### 5.3 `AnalysisStageResult` (value object)

```php
final readonly class AnalysisStageResult
{
    // stage: AnalysisStage
    // payload: object|null          (engine result, e.g. DetectionResult)
    // confidence: ?int              (0–100, null when the stage is a no-op)
    // evidence: list<string>        (normalized evidence strings)
    // ok: bool
}
```

- Uniform envelope for every engine result so the pipeline is homogeneous.

### 5.4 `WebsiteAnalysisResult` (value object)

The unified output of one analysis run.

```php
final readonly class WebsiteAnalysisResult
{
    // analysisId: string             (idempotency key, e.g. UUID)
    // url: string
    // analyzedAt: DateTimeImmutable
    // duration: float                (seconds)
    // schemaVersion: int             (breaking-change counter for consumers)
    // cms: DetectionResult|null
    // theme: ThemeExtractionResult|null
    // plugins: PluginDetectionResult|null
    // technology: TechnologyResult|null
    // intelligence: WebsiteIntelligenceReport|null
}
```

- Immutable, JSON-serializable, schema-versioned, AI-consumable.
- Every engine result is optional: a stage that cannot run must not fail the
  whole analysis. Failures are recorded per-stage with evidence, never thrown
  upward past the manager.

### 5.5 `WebsiteIntelligenceReport` (value object)

Aggregates the four intelligence domains:

```php
final readonly class WebsiteIntelligenceReport
{
    // seo: SeoReport
    // security: SecurityReport
    // performance: PerformanceReport
    // accessibility: AccessibilityReport
    // overall: int    (0–100 composite score)
}
```

Each domain report is itself an immutable value object produced by an
`IntelligenceAnalyzerInterface` implementation.

---

## 6. Workflow

```
URL
 │
 │ (1) Transport         HttpClientInterface::get(url)
 ▼
HttpResponse
 │
 │ (2) Context           WebsiteAnalysisContext built from response
 ▼
WebsiteAnalysisContext
 │
 │ (3) Pipeline          WebsiteAnalysisManager::analyze(context)
 │
 ├─ Stage 1  CMS_DETECTION
 │           CmsDetectionStage → DetectionManager → DetectionResult
 │
 ├─ Stage 2  THEME_EXTRACTION
 │           ThemeExtractionStage → ThemeExtractionManager → ThemeExtractionResult
 │
 ├─ Stage 3  PLUGIN_DETECTION
 │           PluginDetectionStage → PluginDetectionEngine → PluginDetectionResult
 │
 ├─ Stage 4  TECHNOLOGY_DETECTION
 │           TechnologyDetectionStage → TechnologyEngine → TechnologyResult
 │
 └─ Stage 5  INTELLIGENCE
             IntelligenceStage → WebsiteIntelligenceEngine
             ├─ Seo Analyzer            → SeoReport
             ├─ Security Analyzer       → SecurityReport
             ├─ Performance Analyzer    → PerformanceReport
             └─ Accessibility Analyzer  → AccessibilityReport
 │
 ▼
WebsiteAnalysisResult
```

### Stage semantics

1. **Transport** — the single HTTP fetch, delegated through
   `HttpClientInterface`. One request per analysis run. All subsequent stages
   operate on the same immutable response data and perform **no** additional
   HTTP requests.
2. **CMS Detection** — delegates to the existing Detection Engine
   (`DetectorRegistry` + `DetectionManager`).
3. **Theme Extraction** — delegates to the existing Theme Extraction Engine
   (`ThemeExtractorRegistry` + `ThemeExtractionManager`).
4. **Plugin Detection** — delegates to the future Plugin Detection Engine.
5. **Technology Detection** — delegates to the shipped Technology Detection
   Engine (`TechnologyDetector` + `TechnologyDetectionManager`), which detects
   JavaScript libraries, CDNs, and analytics platforms from the existing
   context.
6. **Website Intelligence** — SEO, Security, Performance, Accessibility.

### Failure semantics

- Each stage is isolated. A stage failure is captured as `ok: false` in its
  `AnalysisStageResult` with diagnostic evidence.
- Downstream stages still run. The unified result is never aborted by a
  single engine failure.
- The transport failure is the only fatal path: with no response there is no
  context and no analysis.

---

## 7. Manager and pipeline

### 7.1 `WebsiteAnalysisManager` (orchestrator)

```php
final readonly class WebsiteAnalysisManager
{
    public function __construct(
        private list<AnalysisStageInterface> $stages,   // fixed order
    );

    public function analyze(WebsiteAnalysisContext $context): WebsiteAnalysisResult;
}
```

- Pure orchestration. No business logic, no analysis, no HTTP.
- Runs stages in the fixed `AnalysisStage` order. A stage that returns a
  context with no appended result is treated as a no-op.
- Compiles the final context into a `WebsiteAnalysisResult` (via an internal
  result compiler or the context itself).
- Stateless, deterministic, side-effect free.

### 7.2 `AnalysisPipeline` (`Core`)

```php
final readonly class AnalysisPipeline
{
    public function run(
        WebsiteAnalysisContext $context,
        list<AnalysisStageInterface> $stages,
    ): WebsiteAnalysisContext;
}
```

- Executes the ordered stage list, threading the immutable context through.
- Framework-level concern: validates stage ordering, guards against a stage
  executed more than once, and never reorders stages.

### 7.3 `AnalysisStageInterface` (contract)

```php
interface AnalysisStageInterface
{
    public function stage(): AnalysisStage;
    public function run(WebsiteAnalysisContext $context): WebsiteAnalysisContext;
}
```

- Every stage is a thin adapter over one engine.
- Open/Closed: new engines appear as new stages; the manager, pipeline, and
  provider composition order are the only wiring that changes.

---

## 8. Engine wiring

| Stage                    | Delegates to                                   | Produces                 | Status    |
|--------------------------|------------------------------------------------|--------------------------|-----------|
| `CmsDetectionStage`      | `DetectionManager`                             | `DetectionResult`        | Exists    |
| `ThemeExtractionStage`   | `ThemeExtractionManager`                       | `ThemeExtractionResult`  | Exists    |
| `PluginDetectionStage`   | `PluginDetectionEngine`                        | `PluginDetectionResult`  | Future    |
| `TechnologyDetectionStage`| `TechnologyDetector`                           | `TechnologyDetectionResult` | Exists    |
| `IntelligenceStage`      | `WebsiteIntelligenceEngine`                    | `WebsiteIntelligenceReport` | Future |

Stage adapters live in the Analysis module and are the **only** place that
touches engine entry points. This keeps the Analysis module's core decoupled
from the engines while giving the module a stable, explicit integration point
per engine.

### Future engines

```
app/Modules/PluginDetection/
├── PluginDetectionEngine.php       # facade
├── PluginDetectionManager.php      # orchestrator
├── PluginDetectorRegistry.php      # registry of PluginDetectorInterface
├── PluginDetectionResult.php       # value object
├── Contracts/
│   └── PluginDetectorInterface.php # plugin detection contract
└── Providers/
    └── PluginDetectionServiceProvider.php
```

> **Technology Detection** is shipped (v2.2.0) at
> `app/Modules/TechnologyDetection/`: facade `TechnologyDetector`, orchestrator
> `TechnologyDetectionManager`, registry `TechnologyRegistry` (composed by
> `TechnologyRegistryFactory`), and the immutable value objects
> `TechnologyDetectionResult` / `TechnologyMetadata`.

The future engine above follows the exact pattern established by Detection and
Theme Extraction: registry + manager + facade + idempotent provider.

---

## 9. Website Intelligence Engine

The Intelligence engine is itself a mini-pipeline with the same shape as the
top-level engine.

```php
final readonly class WebsiteIntelligenceEngine
{
    public function __construct(
        private list<IntelligenceAnalyzerInterface> $analyzers, // Seo, Security, Performance, Accessibility
    );

    public function analyze(WebsiteAnalysisContext $context): WebsiteIntelligenceReport;
}
```

### Contract

```php
interface IntelligenceAnalyzerInterface
{
    public function domain(): IntelligenceDomain;   // enum: SEO, SECURITY, PERFORMANCE, ACCESSIBILITY
    public function analyze(WebsiteAnalysisContext $context): IntelligenceDomainReport;
}
```

- One analyzer per domain, registered through the container.
- Each analyzer is stateless and reads only the immutable context.
- New domains (e.g. Best Practices) are added as new analyzers without
  modifying the engine — the same registry + orchestrator pattern used
  throughout the project.

---

## 10. Dependency injection

### 10.1 `WebsiteAnalysisServiceProvider`

Composition root for the Analysis module. Registers only, idempotently,
never overwriting an existing service, using the exact pattern of
`DetectionServiceProvider`.

```php
final class WebsiteAnalysisServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void;
}
```

Registrations:

| Service                          | Wired from                                            |
|----------------------------------|-------------------------------------------------------|
| `CmsDetectionStage`              | `DetectionManager`                                    |
| `ThemeExtractionStage`           | `ThemeExtractionManager`                              |
| `PluginDetectionStage`           | `PluginDetectionEngine` (future contract)             |
| `TechnologyDetectionStage`       | `TechnologyDetector` (shipped)                        |
| `IntelligenceStage`              | `WebsiteIntelligenceEngine`                           |
| `WebsiteIntelligenceEngine`      | registered analyzers (Seo, Security, Performance, Accessibility) |
| `WebsiteAnalysisManager`         | ordered stage list                                    |
| `WebsiteAnalyzer`                | `HttpClientInterface` + `WebsiteAnalysisManager`      |
| `JsonResultSerializer`           | `WebsiteAnalysisResult`                               |
| `AnalysisBriefCompiler`          | `WebsiteAnalysisResult`                               |

### 10.2 Boot order

`Application::boot()` (or consumer composition roots) register providers in
dependency order:

1. `HttpServiceProvider` (existing)
2. `DetectionServiceProvider` (existing)
3. `ThemeExtractionServiceProvider` (existing)
4. `PluginDetectionServiceProvider` (future)
5. Technology Detection engine wiring (shipped — container wiring in
   `bootstrap/app.php`)
6. `WebsiteAnalysisServiceProvider`

Registration is lazy: nothing is constructed until first resolution.

### 10.3 DI graph

```
HttpClientInterface ────────────────► WebsiteAnalyzer
WebsiteAnalysisManager ─────────────► WebsiteAnalyzer
CmsDetectionStage     ─ DetectionManager
ThemeExtractionStage  ─ ThemeExtractionManager
PluginDetectionStage  ─ PluginDetectionEngine        (future)
TechnologyDetectionStage ─ TechnologyDetector         (shipped)
IntelligenceStage     ─ WebsiteIntelligenceEngine
WebsiteIntelligenceEngine ─ SeoAnalyzer
                          ─ SecurityAnalyzer
                          ─ PerformanceAnalyzer
                          ─ AccessibilityAnalyzer
WebsiteAnalysisManager ── list of the five stages (ordered)
```

---

## 11. Caching strategy

Three independent cache levels. All caching is opt-in, configured, and
behind a `CacheInterface` contract (new `App\Modules\Cache` module or Core
infrastructure).

| Level | Key                        | TTL     | Invalidated by                       |
|-------|----------------------------|---------|--------------------------------------|
| 1. Response cache   | `http:{url}:{hash of response}`  | short (minutes) | URL change, forced refresh |
| 2. Analysis cache   | `analysis:{url}:{schemaVersion}:{profile}` | configurable | schema bump, TTL expiry, explicit purge |
| 3. Intelligence cache | `intel:{url}:{schemaVersion}`   | long    | schema bump, TTL expiry             |

### Rules

- **Never cache across schema versions.** `schemaVersion` is part of every
  analysis cache key.
- **Never serve a stale CMS/theme result for a changed site.** The response
  cache key incorporates the fetched HTML fingerprint so a site change
  produces a new analysis.
- **Cache entire results, never partial pipeline state.** The pipeline stays
  stateless; caching is an adapter concern at the facade boundary.
- **Determinism:** identical cached inputs return byte-identical serialized
  results.

---

## 12. Testing strategy

Mirrors the existing test pyramid (`tests/Unit`, `tests/Integration`,
`tests/Fixtures`).

| Layer | Scope | Approach |
|-------|-------|----------|
| Unit  | `WebsiteAnalysisResult`, `AnalysisStageResult`, `WebsiteAnalysisContext`, `AnalysisStage` enum | value-object invariants, append-only context, confidence bounds |
| Unit  | `WebsiteAnalysisManager`, `AnalysisPipeline` | stage order, no-op stages, single execution, failure isolation |
| Unit  | Each stage adapter | fake engine behind the engine entry point; assert delegation and evidence capture |
| Unit  | Intelligence analyzers | HTML fixtures (`tests/Fixtures/Analysis/*.html`) |
| Integration | `WebsiteAnalyzer` | fake `HttpClientInterface` returning fixtures; assert full unified result |
| Integration | Container boot | `ApplicationBootstrapTest`-style: provider registers every service; resolution works |
| Contract | `AnalysisStageInterface`, `IntelligenceAnalyzerInterface` | one test per implementation |
| Golden  | `JsonResultSerializer` | byte-for-byte output snapshots per `schemaVersion` |

Key invariant tested everywhere: **identical context in ⇒ identical result
out**.

---

## 13. AI Ready design

- **Schema-versioned, JSON-serializable value objects.** Every result
  serializes through `JsonResultSerializer` with a stable, versioned shape.
- **Uniform confidence (0–100) and evidence.** Every engine result carries
  normalized evidence strings; AI consumers can reason about *why* a
  conclusion was reached, not just *what* it was.
- **`AnalysisBriefCompiler`.** Produces a compact, token-efficient summary
  (markdown or JSON) of the full `WebsiteAnalysisResult` sized for LLM
  context windows.
- **Deterministic output.** Identical input produces identical bytes — no
  timestamps or ordering drift inside the result payload.
- **Platform-neutral vocabulary.** The result expresses facts about themes,
  plugins, and technologies in normalized form, independent of any CMS.
- **Idempotency keys.** `analysisId` lets AI/agent flows safely retry.

---

## 14. REST API Ready

The REST layer is a thin adapter over `WebsiteAnalyzer`. No business logic in
controllers.

```
routes/
├── web.php
└── api.php        # /api/v1/...
```

| Endpoint | Purpose |
|----------|---------|
| `POST /api/v1/analyses`  | Enqueue an analysis job (async) |
| `GET  /api/v1/analyses/{analysisId}` | Fetch a completed result |
| `GET  /api/v1/analyses/{analysisId}/brief` | Fetch the AI brief |
| `GET  /api/v1/analyses/{analysisId}/json` | Fetch schema-versioned JSON |

- Responses are produced by `JsonResultSerializer` and versioned through
  `schemaVersion`.
- Validation (URL format, quotas) lives in request adapters, never in the
  engine.
- Status mapping: `202` (accepted), `200` (ready), `404` (unknown id),
  `422` (validation), `500` (unexpected failure) — all engine exceptions are
  mapped at the boundary.

---

## 15. CLI Ready

```
app/Console/Commands/
└── AnalyzeCommand.php     # usage: theme:analyze {url} [--format=text|json] [--fresh]
```

- Calls `WebsiteAnalyzer::analyze()` directly.
- Exit codes: `0` success, `1` transport failure, `2` invalid arguments.
- Text output uses the `AnalysisBriefCompiler`; `--format=json` uses the
  `JsonResultSerializer`.
- `--fresh` bypasses the analysis cache.
- The command is a presenter only: it never interprets engine results.

---

## 16. Queue Ready

```
app/Modules/Analysis/Jobs/
└── AnalyzeWebsiteJob.php    # { url, analysisId, profile }
```

- A job carries only the URL, an idempotency `analysisId`, and the profile —
  never shared mutable state.
- The worker resolves `WebsiteAnalyzer` from the container and calls
  `analyze()`.
- Idempotent: retrying a job for the same `analysisId` must not duplicate
  analysis work or corrupt results.
- Stages are already isolated and deterministic, so partial execution is
  safe to re-run.
- Job events (started / completed / failed) are the hook points for SaaS
  webhooks and metering.

---

## 17. Future SaaS Ready

- **Tenant boundary at the transport/adapter layer.** Quotas, rate limits,
  and ownership wrap `WebsiteAnalyzer`; the engine never knows a tenant.
- **Metering via job events.** Completed analyses emit an event consumed by
  usage accounting — no engine changes required.
- **Webhooks.** Consume the same completion events; payloads come from
  `JsonResultSerializer`.
- **Plans.** Plan gates live in the API layer (queue depth, cache TTL,
  features). The core engine is identical for all plans.
- **Multi-tenant cache.** Cache keys gain a tenant namespace at the cache
  adapter, never in the engine.

---

## 18. Conformance

| Principle | How it is satisfied |
|-----------|---------------------|
| SOLID (SRP) | Analyzer/manager/stage/value objects each have exactly one role |
| SOLID (OCP) | New engines = new stages + container wiring; no core modification |
| SOLID (DIP) | Analysis depends on contracts (`AnalysisStageInterface`, engine entry points, `HttpClientInterface`) |
| DDD friendly | Ubiquitous language: *Analysis*, *Stage*, *Engine*, *Report*, *Evidence*, *Confidence*; value objects are immutable |
| Enterprise | Idempotent providers, lazy DI, schema-versioned serialization, contract tests |
| Future proof | Every engine is swappable behind a stage adapter; transports and delivery channels are boundary concerns |

---

## 19. Incremental adoption path

1. **Phase 1 — Skeleton.** `WebsiteAnalysisResult`, `WebsiteAnalysisContext`,
   `AnalysisStage`, `WebsiteAnalysisManager`, `AnalysisPipeline`,
   `WebsiteAnalyzer`, `WebsiteAnalysisServiceProvider`; wire
   `CmsDetectionStage` + `ThemeExtractionStage` (both engines exist today).
2. **Phase 2 — Intelligence.** `WebsiteIntelligenceEngine`, domain contracts,
   SEO/Security/Performance/Accessibility analyzers, reports.
3. **Phase 3 — Serializers.** `JsonResultSerializer`, `AnalysisBriefCompiler`,
   golden-file tests, REST endpoints.
4. **Phase 4 — Plugin + Technology engines.** New modules registered before
   the Analysis provider; two new stage adapters; no core changes.
5. **Phase 5 — Delivery channels.** CLI, queue jobs, caching adapters, SaaS
   boundary.
