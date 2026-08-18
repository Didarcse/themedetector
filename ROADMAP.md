# Roadmap

> ThemeDetectorTool v2 — theme detection and analysis platform built on Kernel
> Framework v1.

Legend: **Done** · **In progress** · **Planned**

## Completed

- **Kernel Framework v1** — *Done*
  Application container, service provider pattern, HTTP kernel, router,
  dispatcher, exception handling, views, and framework helpers. All framework
  modules boot through a deterministic composition root (`bootstrap/app.php`).

- **Detection Engine** — *Done*
  Shared immutable `DetectionContext` and multi-platform CMS detection with
  confidence-scored results. Detectors: WordPress, Shopify, Wix, Squarespace,
  Joomla, Drupal, Ghost, TYPO3, Webflow.

- **Theme Detection** — *Done*
  Theme detection rules layered on the shared `DetectionContext`, feeding the
  Detection Engine's result model.

- **Theme Extraction** — *Done*
  Theme Extraction Engine with extractor registry, immutable result/metadata
  value objects, and WordPress-first theme extraction.

- **Plugin Detection** — *Done*
  Enterprise WordPress plugin detection: plugin rules, slug extraction, metadata
  mapping, and immutable result value objects.

- **Technology Detection** — *Done*
  JavaScript library, CDN asset-host, and analytics/tagging detection with
  confidence-scored rules layered on the shared `DetectionContext`, shipped as
  part of v2.2.0 (`TechnologyDetectionManager` + registry/facade module).

- **Analytics Detection** — *Done*
  Shipped inside Technology Detection v1: Google Analytics (gtag), Google Tag
  Manager, Meta Pixel, Plausible, Matomo, Hotjar, and Clarity rule coverage.

- **CDN Detection** — *Done*
  Shipped inside Technology Detection v1: Cloudflare, CloudFront, jsDelivr, and
  unpkg asset-host rule coverage.

## Upcoming

- **Security Detection** — *Planned*
  Security posture signals: SSL/TLS headers, security headers (HSTS, CSP,
  X-Frame-Options), and known WAF fingerprints.

- **SEO Detection** — *Planned*
  On-page SEO signals: meta tags, Open Graph/Twitter cards, structured data,
  canonical, robots directives, and sitemap presence.

- **Performance Detection** — *Planned*
  Performance signals: response times, asset fingerprints, cache headers, and
  compression hints.

- **Website Intelligence** — *Planned*
  Composition engine aggregating all detection modules (CMS, theme, plugin,
  technology, analytics, CDN, security, SEO, performance) into a unified site
  report. See `docs/WebsiteIntelligenceEngineArchitecture.md`.

## Guiding Principles

- Every new module must follow
  `docs/DetectionModuleArchitectureStandard.md` (module skeleton, pipeline,
  value-object model, registry/manager/facade contract).
- Detection modules stay self-contained; the shared `DetectionContext` is the only
  cross-module input.
- Completed items land in `CHANGELOG.md` and are released under Semantic
  Versioning.
