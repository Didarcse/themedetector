# Contributing to ThemeDetectorTool v2

Thanks for considering a contribution to ThemeDetectorTool v2. This project ships
its own framework (Kernel Framework v1) and a strict quality bar — please read this
guide before opening an issue or a pull request.

## Table of Contents

- [Development Setup](#development-setup)
- [Branch Strategy](#branch-strategy)
- [Commit Message Convention](#commit-message-convention)
- [Coding Standards](#coding-standards)
- [PHPUnit Requirements](#phpunit-requirements)
- [PHPStan Requirements](#phpstan-requirements)
- [Module Conventions](#module-conventions)
- [Pull Request Checklist](#pull-request-checklist)

## Development Setup

```bash
composer install
cp .env.example .env
php -r "echo bin2hex(random_bytes(32));"   # paste into APP_KEY in .env
```

Every contribution must pass all quality gates locally before being submitted:

```bash
composer test      # PHPUnit 11
composer analyse   # PHPStan Level MAX
composer cs-check  # PSR-12 (PHP_CodeSniffer)
```

## Branch Strategy

- `main` is the **stable** branch. Only reviewed, gated, and release commits land
  here.
- Work happens on short-lived branches named by purpose:

| Branch name            | Purpose                              |
|------------------------|--------------------------------------|
| `feature/<scope>-<description>` | New feature or module      |
| `fix/<scope>-<description>`     | Bug fix                    |
| `refactor/<scope>-<description>`| Refactoring                |
| `docs/<description>`            | Documentation              |
| `release/<version>`             | Release preparation (e.g. `release/0.1.0`) |

Scope examples: `detection`, `theme`, `plugin-detection`, `core`, `http`, `pipeline`.

Keep branches up to date with `main` before opening a PR, and rebase rather than
merge when resolving conflicts.

## Commit Message Convention

This repository uses **Conventional Commits** with a scope:

```
<type>(<scope>): <subject>
```

Examples from the project history:

```
feat(plugin-detection): implement enterprise plugin detection architecture
feat(theme): complete theme extraction engine
feat(core): complete detection and theme extraction foundation
release(theme): complete Theme Extraction Engine v0.3.0 RC1
```

- **Types:** `feat`, `fix`, `refactor`, `docs`, `style`, `test`, `perf`, `build`,
  `ci`, `chore`, `revert`, `release`.
- **Subject:** imperative, lowercase, no trailing period, under ~72 characters.
- **Body** (optional): explain *why*, not *what*. Wrap at 72 columns.
- A `release` commit may carry a version tag (e.g. `v0.1.0`).

## Coding Standards

- **PHP 8.2+** and `declare(strict_types=1)` at the top of every source file.
- **PSR-12** enforced with PHP_CodeSniffer. Check with `composer cs-check`, auto-fix
  with `composer cs-fix`.
- **Final/readonly** classes for value objects, orchestrators, and managers;
  `final class` by default.
- **Immutable results** — result value objects are constructed once and expose
  getters only.
- **Enterprise PHPDoc** on every class and public method (purpose, responsibilities,
  `@param`/`@return`, and `@var` where non-obvious). Follow the doc style used in
  `app/Core/` and `app/Modules/`.
- No commented-out code. No `TODO`/`FIXME` merged without an associated issue.
- Naming: `camelCase` methods and variables, `StudlyCase` classes, `snake_case`
  test methods with a `test_` prefix, PSR-4 namespaces (`App\Core`,
  `App\Modules\...`, `Tests\...`).

## PHPUnit Requirements

- **PHPUnit 11**, configured in `phpunit.xml`. The default suite is `unit`
  (`tests/Unit`); run the full suite with
  `vendor/bin/phpunit --testsuite tests`.
- New or modified behavior **must** be covered by tests (unit and/or integration
  as appropriate).
- The suite is strict and **must pass cleanly**:
  - `composer test` → `OK (729 tests, 1310 assertions)` at the time of writing.
  - No warnings, notices, deprecations, risky tests, unexpected output, or global
    state changes (`failOn*` flags are all on).
- Test fixtures (HTML samples) go in `tests/Fixtures/`. Benchmark runners go in
  `tests/Benchmark/` and are **not** PHPUnit classes — run them manually with
  `php tests/Benchmark/<file>.php`.

## PHPStan Requirements

- **PHPStan Level MAX** over both `app/` and `tests/` (`phpstan.neon.dist`,
  `phpVersion: 80200`).
- `composer analyse` must report **zero errors**.
- New code must pass without `@phpstan-ignore` annotations; if one is truly needed,
  justify it in a PR comment and use the precise error code.

## Module Conventions

Detection modules are the heart of this project and follow the canonical
architecture in:

- `docs/DetectionModuleArchitectureStandard.md` — the module skeleton, pipeline,
  value-object model, and registry/manager/facade contract for **every** detection
  module.
- `docs/WebsiteAnalysisArchitecture.md` and
  `docs/WebsiteIntelligenceEngineArchitecture.md` — how modules compose into the
  analysis and intelligence engines.

Before starting a new detection module, study the existing `Detection`,
`ThemeExtraction`, and `PluginDetection` modules — they are the reference
implementations of the standard.

## Pull Request Checklist

Before requesting review, confirm:

- [ ] Branched from `main` and rebased onto the latest `main`.
- [ ] Scope matches the branch name; commits follow Conventional Commits.
- [ ] `composer test` passes (unit + integration suites).
- [ ] `composer analyse` passes with zero errors at Level MAX.
- [ ] `composer cs-check` passes (PSR-12).
- [ ] New code follows the module architecture standard and the enterprise PHPDoc
      style.
- [ ] New behavior is covered by tests; fixtures and benchmarks placed correctly.
- [ ] `CHANGELOG.md` updated under `[Unreleased]` when the change is user-visible.
- [ ] No unrelated changes, secrets, or debug artifacts in the diff.
