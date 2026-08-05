# ThemeDetectorTool v2 — Detection Module Architecture Standard

> **Status:** Official standard
> **Applies to:** Theme Detection, Plugin Detection, Technology Detection, Analytics
> Detection, CDN Detection, Security Detection, SEO Detection, Performance Detection,
> and every future detection module.
> **Framework:** Kernel Framework v1
> **Runtime:** PHP 8.2
> **Code style:** PSR-12
> **Static analysis:** PHPStan Level MAX (zero warnings)
> **Testing:** PHPUnit 11

This document is the canonical architecture specification for every detection
module in ThemeDetectorTool v2. It codifies the conventions already established by
the Detection, ThemeExtraction, and PluginDetection modules and prescribes the
standard every future module **must** follow.

---

## 1. Purpose and Scope

A detection module is a self-contained engine that consumes the shared
`DetectionContext`, runs a platform-specific detection pipeline, and returns an
immutable result value object.

The standard defines:

- the module skeleton (folders, classes, namespaces);
- the responsibilities of every class;
- the pipeline and its data flow;
- the value object model;
- the registry / manager / detector contract;
- the test structure and quality gates.

The standard **does not** prescribe business logic, platform-specific rules, or
confidence thresholds. Those belong to the individual modules.

---

## 2. Architecture Diagram

```
                        ┌────────────────────────────────────────────────┐
                        │            Shared Framework (Kernel v1)        │
                        │  App\Core\Container · ServiceProviderInterface │
                        └────────────────────────────────────────────────┘
                                          │ boot() registers providers, in order:
                                          │ Http → Detection → ThemeExtraction →
                                          │ PluginDetection → Technology → Analysis
                                          ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                      Shared Input Contract (App\Modules\Detection)               │
│                                                                                 │
│   DetectionContext (immutable)  ◄── DetectionContextFactory (HttpResponse →)     │
│   originalUrl · finalUrl · html · statusCode · headers · responseTime · isSuccess│
└─────────────────────────────────────────────────────────────────────────────────┘
                                          │
              ┌───────────────────────────┼───────────────────────────┐
              ▼                           ▼                           ▼
┌─────────────────────┐   ┌──────────────────────┐   ┌──────────────────────┐
│    DetectionModule   │   │  ThemeExtractionModule│  │  PluginDetectionModule│
│      (standard)      │   │      (standard)       │  │      (standard)       │
└─────────────────────┘   └──────────────────────┘  └──────────────────────┘
              │                           │                           │
        every future module             ...                        ...
              │                           │                           │
        Technology · Analytics · CDN · Security · SEO · Performance · ...
```

### 2.1 Module-internal pipeline (canonical)

```
                    ┌──────────────────────────────────────────────┐
                    │            <Module>Facade (public API)      │  ← the ONLY public entry point
                    └──────────────────────────────────────────────┘
                                          │  delegate
                                          ▼
                    ┌──────────────────────────────────────────────┐
                    │             <Module>Manager                  │  ← orchestrator (pure)
                    │  iterate registry · first-supporting wins    │
                    └──────────────────────────────────────────────┘
                                          │  supports() / detect()
                                          ▼
                    ┌──────────────────────────────────────────────┐
                    │             <Module>Registry                 │  ← deterministic collection
                    │  stores <Contract>Interface in order         │
                    └──────────────────────────────────────────────┘
                                          │
                                          ▼
                    ┌──────────────────────────────────────────────┐
                    │       <Platform><Module>Detector             │  ← thin facade, DI-injected
                    └──────────────────────────────────────────────┘
                       │             │             │
                       ▼             ▼             ▼
              ┌────────────┐  ┌────────────┐  ┌────────────┐
              │   Rules    │  │ Extractors │  │  Mappers   │  ← dedicated single-purpose
              └────────────┘  └────────────┘  └────────────┘     collaborators
                       │             │             │
                       └─────────────┼─────────────┘
                                     ▼
                    ┌──────────────────────────────────────────────┐
                    │         Raw<Module>Metadata (transport)      │  ← untouched rule output
                    └──────────────────────────────────────────────┘
                                     │  map
                                     ▼
                    ┌──────────────────────────────────────────────┐
                    │            <Module>Metadata (domain)         │  ← normalized, immutable
                    └──────────────────────────────────────────────┘
                                     │  assemble
                                     ▼
                    ┌──────────────────────────────────────────────┐
                    │           <Module>Result (immutable)         │  ← canonical output
                    └──────────────────────────────────────────────┘
```

---

## 3. Standard Folder Structure

```
app/Modules/<ModuleName>/
├── Contracts/
│   └── <Module>DetectorInterface.php       # platform-agnostic contract
├── Providers/
│   └── <ModuleName>ServiceProvider.php     # idempotent container wiring
├── Exceptions/
│   └── <ModuleName>Exception.php           # extends RuntimeException (only when needed)
├── <Platform>/                            # e.g. WordPress/, Shopify/, Ghost/
│   ├── Rules/
│   │   ├── RuleInterface.php               # extends the shared rule contract
│   │   └── <Evidence>Rule.php              # one class per evidence signal
│   ├── Parsers/                            # only when HTML/style parsing is needed
│   │   └── <Thing>Parser.php
│   ├── <Platform><Module>Detector.php      # thin facade wiring the platform pipeline
│   ├── Raw<Module>Metadata.php             # transport object (rule output, untouched)
│   ├── <Thing>Extractor.php                # rule-result → Raw*Metadata (transformer)
│   └── <Thing>Mapper.php                   # Raw*Metadata → <Module>Metadata
├── <Module>Metadata.php                    # normalized immutable domain metadata
├── <Module>Result.php                      # immutable result value object
├── <Module>Registry.php                    # deterministic collection
├── <Module>Manager.php                     # pure orchestrator
└── <Module>.php                            # public facade (the only public API)
```

Tests mirror the tree exactly:

```
tests/Unit/<Module>/
├── <Module>RegistryTest.php
├── <Module>ManagerTest.php
├── <Platform>/
│   ├── <Platform><Module>DetectorComponentTest.php
│   ├── Raw<Module>MetadataTest.php
│   ├── <Thing>ExtractorTest.php
│   ├── <Thing>MapperTest.php
│   └── Rules/
│       └── <Evidence>RuleTest.php
└── ...
tests/Integration/<Module>/
└── <Module>IntegrationTest.php
```

> A module with multiple platforms keeps a shared root (`<Module>Result`,
> `<Module>Metadata`, Registry, Manager, Facade) and isolates every platform under
> its own `<Platform>/` subtree. Platform folders never reach outside their subtree
> except through the shared root contracts.

---

## 4. Standard Class Names

| Role              | Class name                     | Example                                  |
| ----------------- | ------------------------------ | ---------------------------------------- |
| Public facade     | `<Module>`                     | `PluginDetection` facade                 |
| Manager           | `<Module>Manager`              | `PluginDetectionManager`                 |
| Registry          | `<Module>Registry`             | `PluginRegistry`                         |
| Result value      | `<Module>Result`               | `PluginDetectionResult`                  |
| Metadata value    | `<Module>Metadata`             | `PluginMetadata`                         |
| Contract          | `<Module>DetectorInterface`    | `PluginDetectorInterface`                |
| Platform detector | `<Platform><Module>Detector`   | `WordPressPluginDetector`                |
| Rule contract     | `RuleInterface` (per platform) | `App\Modules\X\WordPress\Rules\RuleInterface` |
| Rule              | `<Evidence>Rule`               | `PluginPathRule`, `GeneratorRule`        |
| Transport object  | `Raw<Module>Metadata`          | `RawPluginMetadata`                      |
| Mapper            | `<Thing>Mapper`                | `PluginMetadataMapper`                   |
| Extractor         | `<Thing>Extractor`             | `PluginSlugExtractor`                    |
| Parser            | `<Thing>Parser`                | `WordPressStyleCssParser`                |
| Provider          | `<ModuleName>ServiceProvider`  | `PluginDetectionServiceProvider`         |

Naming rules:

- `<Module>` is the domain noun, singular, PascalCase: `PluginDetection`, `ThemeExtraction`,
  `AnalyticsDetection`, `SecurityDetection`.
- Interfaces are suffixed `Interface`; value objects and orchestrators carry no suffix
  beyond their role.
- Test classes are `<ClassUnderTest>Test`; integration test is `<Module>IntegrationTest`.

---

## 5. Namespaces

- Production: `App\Modules\<ModuleName>\...` (PSR-4, folder mirrors namespace).
- Shared contract + context: `App\Modules\Detection\DetectionContext` is the single
  shared input for **all** modules. No module defines its own context.
- Framework: `App\Core`, `App\Core\Contracts`, `App\Core\Providers`.
- HTTP boundary: `App\Modules\Http` — the only module allowed to perform network I/O.
- Tests: `Tests\Unit\...` and `Tests\Integration\...`, mirroring the module tree.
- Every file declares `declare(strict_types=1);`.

---

## 6. Standard Responsibilities

| Class                      | Responsibility                                                          | Must NOT do                                                        |
| -------------------------- | ----------------------------------------------------------------------- | ------------------------------------------------------------------ |
| `DetectionContext`         | Carry immutable request/response data for every detector.                | Perform I/O, parse, or mutate.                                     |
| `<Module>DetectorInterface`| Contract: `supports()` + `detect()` for every detector.                 | Contain logic.                                                     |
| `<Module>Registry`         | Store detector instances in registration order; return them unchanged.   | Filter, sort, deduplicate, orchestrate, or execute.                |
| `<Module>Manager`          | Iterate in order, delegate to the first supporting detector, return its result verbatim; deterministic failed result otherwise. | Perform detection, parsing, mapping, or confidence math. |
| `<Module>` facade          | Single public entry point; pure delegation to the manager.               | Contain any pipeline logic.                                       |
| `<Platform>Detector`       | Thin facade wiring platform collaborators via constructor injection.     | Parse, map, apply business rules, or calculate confidence itself. |
| `<Evidence>Rule`           | Evaluate one evidence signal; return `{matched, confidence, metadata}`.  | Map, orchestrate, or perform I/O.                                 |
| `Raw*Metadata`             | Immutable transport of rule output, untouched.                           | Interpret or validate values.                                     |
| `<Thing>Extractor`         | Transform a rule result into `Raw*Metadata`; return null when absent.    | Apply regex, map, or compute confidence.                          |
| `<Thing>Mapper`            | Translate `Raw*Metadata` → `<Module>Metadata` directly, without inference.| Normalize, validate, or invent values.                            |
| `ServiceProvider`          | Register the empty registry and the manager idempotently.                | Run detection, load config, or block.                             |

---

## 7. Standard Detector Contract

Every detector contract follows the PluginDetection shape:

```php
interface <Module>DetectorInterface
{
    public function supports(DetectionContext $context): bool;
    public function detect(DetectionContext $context): <Module>Result;
}
```

Rules:

- `supports()` returns whether this detector can handle the context.
- `detect()` returns the module's canonical result.
- The contract must be platform-agnostic; it knows nothing about WordPress, Shopify, etc.
- The manager consults `supports()` in registration order and delegates to the **first**
  detector that returns `true`; detectors after it are never consulted.

---

## 8. Standard Rule Contract

Every rule returns the same array shape, **always**:

```php
/**
 * @return array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }
 */
public function evaluate(string $html, string $url): array;
```

Conventions:

- No-match is always `['matched' => false, 'confidence' => 0, 'metadata' => []]`.
- Confidence is an `int` on the 0–100 scale.
- Per-rule confidence is a low constant (10–50) representing the evidence strength.
- `metadata` carries only the evidence this rule produced.
- The platform `Rules\RuleInterface` must extend the shared
  `App\Modules\Detection\Contracts\RuleInterface`.

> **Migration rule:** legacy suites that still return `{matched, weight, metadata}`
> must be migrated to `confidence` before any new work is layered on them. New modules
> use `confidence` exclusively.

---

## 9. Standard Value Objects

All value objects are `final readonly`, immutable, one getter per property, and
side-effect free.

### Result (`<Module>Result`)

```php
final readonly class <Module>Result
{
    public function __construct(
        private bool $detected,
        private ?<Module>Metadata $metadata,
        private int $confidence,          // 0–100
    ) {}
}
```

- The **failed result** is the canonical empty outcome, constructed exactly as
  `detected: false, metadata: null, confidence: 0`. The manager owns this fallback.
- Confidence validation (0–100) belongs to the result or its calculator; it must throw
  `InvalidArgumentException` on out-of-range values (see `DetectionResult`).

### Metadata (`<Module>Metadata`)

```php
final readonly class <Module>Metadata
{
    // first-class, CMS-agnostic properties (string, ?string, list<string>, int, bool)
    // ...
    public function __construct(
        private array $extra = [],        // array<string, mixed> — the extension point
    ) {}
    public function extra(): array;
}
```

- `extra()` is the **only** platform-specific extension point. Platform facts that do
  not fit first-class properties live here.
- A first-class property must never be duplicated inside `extra()`.

### Transport (`Raw<Module>Metadata`)

```php
final readonly class Raw<Module>Metadata
{
    public function __construct(
        private string $slug,             // or the platform's primary key
        private int $confidence = 0,
        private array $extra = [],
    ) {}
}
```

- Plain field container; stores and returns values exactly as supplied.
- Sits under the platform subtree because it is platform-specific.

---

## 10. Standard Registry

The registry is a **deterministic collection object**. It performs no orchestration,
no filtering, no deduplication, and no business logic.

Two accepted shapes:

### 10.1 Immutable registry (constructor-injected)

```php
final readonly class <Module>Registry
{
    /** @param iterable<<Module>DetectorInterface> $detectors */
    public function __construct(private array $detectors) {}

    /** @return list<<Module>DetectorInterface> */
    public function all(): array;
}
```

Used when the detector set is fixed at composition time (Detection, ThemeExtraction).

### 10.2 Mutable registry (register())

```php
final class <Module>Registry
{
    public function register(<Module>DetectorInterface $detector): void;

    /** @return list<<Module>DetectorInterface> */
    public function all(): array;
}
```

Used when detectors are appended after construction (PluginDetection).

Contract, regardless of shape:

- `all()` returns exactly what was registered, in registration order.
- Detectors are never reordered, filtered, deduplicated, or modified.
- The registry is deterministic and side-effect free.

---

## 11. Standard Manager

```php
final readonly class <Module>Manager
{
    public function __construct(private <Module>Registry $registry) {}

    public function detect(DetectionContext $context): <Module>Result
    {
        foreach ($this->registry->all() as $detector) {
            if ($detector->supports($context)) {
                return $detector->detect($context);
            }
        }

        return new <Module>Result(detected: false, metadata: null, confidence: 0);
    }
}
```

Rules:

- Orchestration only. The manager performs no detection, parsing, mapping, or
  confidence math.
- Evaluates `supports()` in registration order; stops at the first supporting detector.
- Never invokes `detect()` on unsupported detectors.
- Returns the detector result **unchanged**.
- Never mutates the supplied `DetectionContext`.
- Deterministic: same registry + same context ⇒ same result.
- The empty-registry outcome is the deterministic failed result — never an exception.

> **Divergence note:** `DetectionManager` (highest-confidence selection) and
> `ThemeExtractionManager` predate the first-supporting contract and throw on an empty
> registry. The **first-supporting contract above is the standard for new modules**;
> existing managers are retained for backward compatibility.

---

## 12. Standard Pipeline and Data Flow

```
DetectionContext
  → <Module>Facade
  → <Module>Manager          (first-supporting dispatch)
  → <Platform><Module>Detector  (thin facade)
  → <Evidence>Rule::evaluate($html, $url)  → {matched, confidence, metadata}
  → <Thing>Extractor         → Raw<Module>Metadata | null
  → <Thing>Mapper            → <Module>Metadata
  → <Module>Result           (assembled by the platform detector)
```

Rules of the road:

- The `DetectionContext` is the only input; it is never modified.
- Rules consume `html` and `url` and produce evidence — nothing else.
- The platform detector owns **assembly** of the result, never interpretation.
- The manager owns **dispatch**, never the pipeline internals.
- Confidence flows from the rules through the transport object unchanged.

---

## 13. Standard Service Provider

```php
final class <Module>ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        if (!$container->has(<Module>Registry::class)) {
            $container->set(<Module>Registry::class, static fn (): <Module>Registry => new <Module>Registry());
        }

        if (!$container->has(<Module>Manager::class)) {
            $container->set(
                <Module>Manager::class,
                static fn (Container $container): <Module>Manager => new <Module>Manager($container->get(<Module>Registry::class)),
            );
        }
    }
}
```

Rules:

- Every module ships exactly one provider.
- Registration is **idempotent** (`has()` guard) and **lazy** (closures resolved by
  the container on first access).
- The registry is registered intentionally empty; detectors are added at composition
  time, never by the provider.
- Providers are registered in `Application::boot()` in dependency order:
  `Http → Detection → ThemeExtraction → PluginDetection → Technology → Analysis`.

---

## 14. Standard Testing Structure

### 14.1 Unit tests — one file per production class

Location: `tests/Unit/<Module>/` mirroring the production tree.

| Class under test            | Test file                                        | Style                                  |
| --------------------------- | ------------------------------------------------ | -------------------------------------- |
| `Registry`                  | `tests/Unit/<Module>/<Module>RegistryTest.php`    | real registry, mocked interface        |
| `Manager`                   | `tests/Unit/<Module>/<Module>ManagerTest.php`     | real manager + real registry, mocked detectors |
| `<Platform>Detector`        | `tests/Unit/<Module>/<Platform>/<Platform><Module>DetectorComponentTest.php` | real detector + real collaborators |
| `Raw*Metadata`              | `.../Raw<Module>MetadataTest.php`                 | no mocks, immutable contract           |
| `<Thing>Mapper`             | `.../<Thing>MapperTest.php`                       | real mapper + real transport           |
| `<Thing>Extractor`          | `.../<Thing>ExtractorTest.php`                    | real extractor + rule-result arrays    |
| `<Evidence>Rule`            | `.../Rules/<Evidence>RuleTest.php`                | real rule + representative HTML strings |

Unit test rules:

- Real registry, real manager, real detector under test; collaborators that are
  not under test are PHPUnit mocks of the *interface*, never of concrete classes.
- No filesystem, no HTTP, no fixtures, no network.
- Representative strings are embedded directly in the test.
- Behaviour-driven, fast, independent, deterministic.

### 14.2 Component tests

The `<Platform><Module>DetectorComponentTest` wires the **real** detector with its
**real** rules, extractor, and mapper. The only mock is the external transport
boundary (e.g. `HttpClientInterface`). It verifies collaboration of the platform
sub-pipeline.

### 14.3 Integration tests

Location: `tests/Integration/<Module>/<Module>IntegrationTest.php`.

- Uses **only real production objects** from `<Module>Facade` down to `<Module>Result`.
- Real `DetectionContext` with representative HTML embedded in the test.
- No HTTP, no filesystem, no fixtures.
- Verifies observable behaviour only — never internal implementation details:
  - the supported-html → `detected = true` path and its metadata;
  - the empty-html → deterministic failed result path;
  - confidence preservation;
  - the context remains unchanged;
  - determinism across repeated runs.

---

## 15. Standard PHPStan Requirements

- Level: **MAX** (`level: max` in `phpstan.neon.dist`), target PHP 8.2 (`phpVersion: 80200`).
- Zero errors, zero warnings across `app` and `tests`.
- Project command: `vendor/bin/phpstan analyse`.
- The return value of a pure method is never discarded: every invocation is either
  asserted or stored in a variable that participates in the test.
- No `@phpstan-ignore-*` comments, no baselines, no type casts added to silence
  analysis.

## 16. Standard PHPUnit Requirements

- Version: PHPUnit 11.
- `phpunit.xml` with `failOnDeprecation`, `failOnPhpunitDeprecation`,
  `failOnPhpunitWarning`, `failOnNotice`, `failOnWarning`, `failOnRisky`, and
  `beStrictAboutChangesToGlobalState` / `beStrictAboutOutputDuringTests` all `true`.
- Test method names are snake_case, behaviour-descriptive, prefixed `test_`
  (repo convention; e.g. `test_returns_failed_result_for_empty_html`).
- Project command: `vendor/bin/phpunit` (unit suite) and
  `vendor/bin/phpunit --testsuite tests` (full suite).

---

## 17. Development Rules

1. **One responsibility per class.** If a class does two things, split it.
2. **Pure orchestration.** Managers and facades never contain business logic.
3. **Immutable everywhere.** Value objects, contexts, and results are `final readonly`.
4. **No I/O in detection logic.** HTTP lives only in `App\Modules\Http`; detection
   modules consume the already-fetched `DetectionContext`.
5. **Constructor injection only.** No service location, no static factories inside
   domain classes.
6. **Fail closed, deterministically.** The empty outcome is the canonical failed
   result, not an exception or a silent partial result.
7. **Add tests with every class.** A production class without a unit test and a
   module without an integration test are incomplete.
8. **Run the full gate before finishing:** `phpunit`, `phpstan analyse`, and a
   PSR-12 check must all pass.

---

## 18. Naming Conventions

| Item            | Convention                                               | Example                          |
| --------------- | ------------------------------------------------------- | -------------------------------- |
| Module          | PascalCase domain noun, `Detection` suffix where apt     | `SecurityDetection`              |
| Class           | PascalCase, role suffix                                  | `<Module>Manager`                |
| Interface       | `<Role>Interface`                                        | `DetectorInterface`              |
| Method          | camelCase, behaviour verbs                                | `supports()`, `detect()`, `all()`|
| Test method     | snake_case, `test_` prefix, behaviour description         | `test_preserves_registration_order` |
| Namespace       | PSR-4 `App\Modules\<Module>\...` / `Tests\Unit|Integration\...` | `App\Modules\AnalyticsDetection` |
| Rule constant   | `private const <EVIDENCE>_CONFIDENCE = 30;`              | `PLUGIN_PATH_CONFIDENCE`         |
| Private helper  | camelCase, no underscore prefix                           | `createDetector()`               |

---

## 19. Dependency Rules

1. Modules depend only on `App\Modules\Detection` (the shared `DetectionContext`)
   and `App\Modules\Http` (the transport boundary). Never the reverse.
2. A platform subtree (`<Platform>/`) never references another platform subtree.
3. Detectors depend on `Contracts\DetectorInterface`, never on a sibling concrete
   detector.
4. Domain classes (value objects, rules, mappers) never depend on the framework
   container, the HTTP client, or other modules.
5. The only allowed external boundary class is `DetectionContext`; modules never
   import each other's results or metadata.
6. `App\Core` knows about modules only through `ServiceProviderInterface` and the
   container.

---

## 20. SOLID Compliance

| Principle | How the standard satisfies it                                          |
| --------- | ---------------------------------------------------------------------- |
| **S**ingle responsibility | Manager orchestrates, registry stores, rules evaluate, mappers translate, detectors assemble. No class does more than one job. |
| **O**pen/closed           | New platforms are added as new `<Platform>/` subtrees implementing the contract; registries, managers, and facades are never modified. |
| **L**iskov substitution   | Every platform detector is a drop-in for `<Module>DetectorInterface`; the manager treats all detectors identically. |
| **I**nterface segregation | `DetectorInterface` exposes only `supports()` and `detect()`; rule contracts expose only `evaluate()`. No fat interfaces. |
| **D**ependency inversion  | Detectors depend on the contract interface; concrete collaborators are injected through constructors, never resolved inside domain logic. |

---

## 21. Documentation Standard

Every production class carries an enterprise-grade PHPDoc block:

- a class-level description and the class **responsibilities**;
- a **design philosophy** paragraph (pattern used, why);
- a **future compatibility** paragraph;
- `@param` and `@return` on every public method, with array shapes for structured
  returns (e.g. `array{matched: bool, confidence: int, metadata: array<string, mixed>}`);
- `@var` inline only when required by array generics.

Every test class carries a PHPDoc explaining its **purpose**, **scope**, and
**testing philosophy**. Behaviour-critical tests carry a per-method PHPDoc stating
what behaviour is verified.

Module-level architecture changes are recorded in `docs/`, extending this standard.

---

## 22. Testing Philosophy

1. **Behaviour over implementation.** Tests assert observable behaviour, never
   internal calls, private methods, or structural details.
2. **Real assemblies in integration tests.** The pipeline is tested as one assembled
   component with real production objects.
3. **Mocks at the interface only.** A collaborator is mocked only when it is not
   under test and only through its interface.
4. **Determinism.** No randomness, no wall-clock dependence, no network.
5. **Speed.** Unit tests are sub-millisecond; integration tests avoid I/O by
   embedding representative strings.
6. **Full coverage of the public contract.** Every public method, every boundary
   case (empty input, unsupported input, deterministic failure) is exercised.
7. **Explicit ordering verification** where order is contractual (manager dispatch,
   registry storage) — asserted with PHPUnit expectations, not commentary.

---

## 23. Future Extensibility

- **New platform:** add `<Platform>/` subtree implementing `<Module>DetectorInterface`,
  register it in the module's composition point. No changes to the registry, manager,
  facade, or existing platforms.
- **New evidence signal:** add a rule to `<Platform>/Rules/` and wire it into the
  platform detector. No contract changes.
- **New metadata fields:** add first-class properties to `<Module>Metadata` or, when
  platform-specific, extend `extra()`. The mapper translates, nothing else.
- **New module:** clone the canonical skeleton (Contracts / Providers / registry /
  manager / facade / value objects / platform subtree), wire its provider into boot,
  and ship the unit + integration test set from this standard.
- **Multi-platform result consumers** rely only on `<Module>Result` and
  `<Module>Metadata`; platform details stay behind `extra()`.

---

## 24. Definition of Done

A detection module is complete when:

- [ ] the canonical skeleton matches this standard;
- [ ] `DetectionContext` is the only input;
- [ ] the manager dispatches first-supporting and returns a deterministic failed
      result;
- [ ] every rule returns `{matched, confidence, metadata}` with a 0–100 confidence;
- [ ] all value objects are `final readonly` with `extra()` as the extension point;
- [ ] the service provider is idempotent and wired into boot in dependency order;
- [ ] a unit test exists for every production class;
- [ ] a component test exists for every platform detector;
- [ ] an integration test exercises the full pipeline with real objects;
- [ ] `vendor/bin/phpunit --testsuite tests` → green;
- [ ] `vendor/bin/phpstan analyse` → `[OK] No errors`;
- [ ] PSR-12 passes with no warnings.
