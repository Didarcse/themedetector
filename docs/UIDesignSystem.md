# ThemeDetectorTool v2 - UI Design System & Component Library

> Official UI specification for ThemeDetectorTool v2, built on Kernel Framework v1
> and Bootstrap 5.3.3.
>
> Status: **Public MVP design baseline**
> Scope: UI architecture only. This document is the source of truth every
> future page, partial, and style rule must conform to. It defines the design
> system, component library, and page wireframes - not production code.

## Table of Contents

1. Design Principles
2. Brand Identity
3. Color Palette
4. Typography
5. Spacing System
6. Border Radius
7. Shadows
8. Buttons
9. Forms
10. Cards
11. Tables
12. Badges
13. Alerts
14. Icons
15. Navigation
16. Footer
17. Page Containers
18. Responsive Grid
19. Loading Components
20. Empty States
21. Error States
22. Report Cards
23. Confidence Indicators
24. Component Library
25. Page Wireframes
26. Responsive Rules
27. Naming Convention
28. Development Guidelines

---

## 1. Design Principles

1. **Forensic clarity.** The product reports technical facts. Every surface
   leads with the answer (detected CMS, theme, confidence), never with
   marketing noise around it.
2. **Minimal SaaS.** One idea per screen. Generous whitespace, restrained
   decoration, subtle borders over heavy boxes.
3. **Trust through precision.** Confidence scores, versions, and HTTP status
   are always shown in machine-precise form (mono for technical values), never
   paraphrased.
4. **Mobile first.** Layouts are designed for the smallest viewport first and
   enhanced at each breakpoint.
5. **Accessible by default.** AA contrast, keyboard operability, focus
   visibility, and semantic landmarks are non-negotiable.
6. **Fast.** System fonts, no jQuery, no extra icon libraries, nothing render
   blocking beyond Bootstrap + one app stylesheet.
7. **Developer friendly.** Class names follow one convention; partials are
   configurable via arrays; no inline styles in views.

Reference aesthetics: Wappalyzer (detection clarity), GTmetrix (report
structure), BuiltWith (information density), Stripe Dashboard (component
quality), Vercel (hero and type), GitHub (neutral surfaces and states).

---

## 2. Brand Identity

| Attribute | Value |
| --- | --- |
| Product name | ThemeDetectorTool v2 |
| Display name | **Theme Detector** |
| Tagline | Reveal the technology behind any website |
| Value proposition | CMS, theme, version, author, and plugins - in seconds, free, no sign-up |
| Personality | Precise, Technical, Trustworthy, Modern |
| Voice | Neutral, confident, developer-oriented; short sentences; no hype |
| Logo mark | Rounded tile (`border-radius: 0.6rem`) with `bi-boxes` glyph on the brand gradient |
| Wordmark | "Theme" (white/ink) + "Detector" (brand tint) in `fw-bold` |
| Signature gradient | `linear-gradient(135deg, #6d5dfc 0%, #4f3fd6 100%)` |

The brand mark must never be recolored, rotated, or given a drop shadow. On
dark surfaces the mark keeps its gradient; on light surfaces it may sit on a
white tile with a 1px border.

---

## 3. Color Palette

All colors are expressed as CSS custom properties prefixed `--td-` and must
override the matching Bootstrap 5.3 semantic roles so utilities
(`text-primary`, `bg-body`, `border-danger`) resolve to the product palette.

### 3.1 Brand (primary)

| Token | Value | Usage |
| --- | --- | --- |
| `--td-brand-50` | `#F3F2FE` | brand tint fills, icon-tile backgrounds |
| `--td-brand-100` | `#E8E6FD` | selected rows, hover fills |
| `--td-brand-200` | `#C5C0FB` | focus-visible ring (at 60% alpha) |
| `--td-brand-500` | `#6D5DFC` | **primary action**, links, active nav |
| `--td-brand-600` | `#5A4BE3` | primary hover |
| `--td-brand-700` | `#4F3FD6` | primary active/pressed, eyebrow text |
| `--td-brand-800` | `#3E31A9` | focus ring border (AA on white) |
| `--td-brand-900` | `#2A2572` | deep accents |

### 3.2 Ink and surfaces

| Token | Value | Usage |
| --- | --- | --- |
| `--td-ink` | `#0A1128` | dark text, hero gradient start, header/footer |
| `--td-navy` | `#101C45` | hero gradient mid, header alt |
| `--td-ink-700` | `#131C3A` | hover on dark |
| `--td-surface` | `#FFFFFF` | primary surface (cards, page) |
| `--td-surface-subtle` | `#F6F7FB` | `bg-body-tertiary`, alternating sections |
| `--td-border` | `#E4E7F0` | default 1px borders, dividers |
| `--td-border-strong` | `#C9CFE0` | hover borders, table separators |

### 3.3 Semantic

| Token | Value | Usage |
| --- | --- | --- |
| `--td-success` | `#16A34A` | detected / high confidence / 2xx |
| `--td-warning` | `#D97706` | medium confidence / warnings |
| `--td-danger` | `#DC2626` | errors, failed detection, 4xx/5xx |
| `--td-info` | `#0891B2` | informational notes, API docs accents |
| `--td-muted` | `#64748B` | secondary text on light |

Each semantic role has a soft tint (10% alpha of the hue) for alert/card
backgrounds and an `-emphasis` variant for AA text use.

### 3.4 Confidence scale (product rule)

| Range | Color | Token |
| --- | --- | --- |
| >= 80% | success green | `--td-success` |
| 50-79% | warning amber | `--td-warning` |
| 1-49% | neutral gray | `--td-muted` |
| none / unknown | neutral gray outline | `--td-muted` |

Confidence colors are the *only* place green/amber appear - reserving them
gives the scale instant meaning across the report.

### 3.5 Dark surfaces

Headers, footers, and the hero use `--td-ink` / `--td-navy`. On dark:

- text: `#FFFFFF` (headings), `rgba(255,255,255,.65)` (body), `.text-white-50`
- borders: `rgba(255,255,255,.08)`
- fills: `rgba(255,255,255,.06)`

---

## 4. Typography

### 4.1 Fonts

Default stack (no webfont request = fastest):

```
system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif
```

Monospace stack (URLs, slugs, versions, code, HTTP status, IDs):

```
ui-monospace, "SF Mono", SFMono-Regular, Consolas, "Liberation Mono", monospace
```

Optional: self-hosted **Inter** for display/body when network fonts are
acceptable; always `font-display: swap`. Never pair more than two families.

### 4.2 Type scale

| Token | Size / weight / height | Usage |
| --- | --- | --- |
| `display` | `clamp(2rem, 5vw + 1rem, 3.5rem)` / 800 / 1.05 | Hero H1 only |
| `h1` | `2rem` / 700 / 1.2 | Page titles |
| `h2` | `1.5rem` / 700 / 1.3 | Section titles, card headings |
| `h3` | `1.25rem` / 700 / 1.4 | Sub-sections |
| `h4` / `h5` / `h6` | `1.125 / 1 / 0.875rem` / 600 / 1.5 | Card titles, list headers |
| `body` | `1rem` / 400 / 1.6 | Default copy |
| `small` | `0.875rem` / 400 / 1.5 | Helper text, footer |
| `micro` | `0.75rem` / 700 / 1.4 / uppercase / letter-spacing .12em | Eyebrows, table headers, labels |
| `mono` | `0.85em` / 400 / 1.5 | Technical values |

Display and all headings get `letter-spacing: -0.02em` (tight tracking on
large sizes only). Body text never uses negative tracking.

### 4.3 Rules

- One H1 per page. Section headings are `h2`. Cards use `h3` or lower.
- URLs and technical values render `mono` unless the value is interactive
  (then it is a link, not mono bold).
- Eyebrows always precede titles in sections (`.eyebrow`).
- Measure: prose blocks capped at `max-width: 65ch` (reading pages use
  `col-lg-8` / `col-lg-9`).

---

## 5. Spacing System

4px base grid. Use Bootstrap spacing utilities exclusively (no ad-hoc rems).

| Step | rem | px | Common use |
| --- | --- | --- | --- |
| `gap-0` | 0 | 0 | - |
| `gap-1` | .25 | 4 | icon-to-text |
| `gap-2` | .5 | 8 | badge padding, small gaps |
| `gap-3` | 1 | 16 | card body padding, form gaps |
| `gap-4` | 1.5 | 24 | grid gutters (`g-4`), section gaps |
| `gap-5` | 3 | 48 | section vertical padding (`py-5`) |
| `gap-6` | 4 | 64 | desktop section padding (`py-6`) |
| `gap-7` | 5 | 80 | hero top/bottom |
| `gap-8` | 6 | 96 | marketing page rhythm |

Section rhythm: alternate white and `--td-surface-subtle`; every section is
`py-5` on mobile and `py-6` on `>=lg`. Card bodies `p-4` (feature cards `p-5`
on desktop).

---

## 6. Border Radius

| Token | Value | Usage |
| --- | --- | --- |
| `--td-radius-sm` | `.375rem` | small badges, tag chips |
| `--td-radius-md` | `.5rem` | default: inputs, buttons, tables |
| `--td-radius-lg` | `.75rem` | cards, cards with shadow |
| `--td-radius-xl` | `1rem` | report cards, hero panels, modals |
| `--td-radius-pill` | `999px` | pills, status badges, hero-badge |

Radii stay subtle (SaaS minimal). Never round interactive elements above
`.75rem` except pills.

---

## 7. Shadows

Shadows use ink at low alpha; the palette is cool, so shadows are never warm.

| Token | Value | Usage |
| --- | --- | --- |
| `--td-shadow-xs` | `0 1px 2px rgba(10,17,40,.05)` | inputs resting |
| `--td-shadow-sm` | `0 1px 3px rgba(10,17,40,.08)` | default cards |
| `--td-shadow-md` | `0 4px 12px rgba(10,17,40,.08)` | hovered cards, dropdowns |
| `--td-shadow-lg` | `0 12px 32px rgba(10,17,40,.12)` | modals, popovers |
| `--td-shadow-xl` | `0 24px 48px rgba(10,17,40,.16)` | CTA banner, hero accent |
| `--td-focus-ring` | `0 0 0 3px rgba(109,93,252,.35)` | keyboard focus |

Hover lift on interactive cards: `translateY(-3px)` + `--td-shadow-md`,
`transition: transform .15s ease, box-shadow .15s ease`.

---

## 8. Buttons

One component, three core variants, three sizes, icon support.

### 8.1 Variants

| Variant | Fill | Text | Border | Hover | Active |
| --- | --- | --- | --- | --- | --- |
| Primary `.btn-primary` | `--td-brand-500` | white | none | `--td-brand-600` | `--td-brand-700` |
| Secondary `.btn-secondary` | `--td-surface` | `--td-ink` | `--td-border-strong` | border+text to brand-700 | brand fill 8% |
| Outline-light `.btn-outline-light` | transparent | white | `rgba(255,255,255,.35)` | white 10% fill | white 18% fill |

### 8.2 Sizes

| Size | Font | Padding | Use |
| --- | --- | --- | --- |
| `btn-sm` | `.875rem` | `.375rem .75rem` | table actions, inline |
| default | `1rem` | `.5rem 1rem` | default actions |
| `btn-lg` | `1rem` | `.75rem 1.5rem` | hero CTAs, primary search |

### 8.3 Rules

- Radius `--td-radius-md`; `fw-semibold`; `line-height 1.5`.
- Icon buttons: ghost fill, `bi` glyph, `aria-label` always, 44px hit target.
- Keyboard focus: `--td-focus-ring` (override Bootstrap's default ring color).
- Disabled: 60% opacity, `cursor: not-allowed`, `aria-disabled`.
- Loading: spinner glyph inline + disabled until done (see Search Form).

---

## 9. Forms

### 9.1 Inputs

- Surface white, 1px `--td-border`, radius `--td-radius-md`, `--td-shadow-xs`.
- Height: default `.875rem` font, `.5rem` vertical padding (~46px);
  `form-control-lg` (~58px) for the hero URL field.
- Focus: border `--td-brand-500` + `--td-focus-ring`.
- Placeholder: `--td-muted` at 70%.
- Labels: `micro` uppercase (restyled `form-label`); optional `form-text` below.

### 9.2 URL input (product field)

A large `input-group`:

- Leading icon `bi-link-45deg` (`input-group-text` or positioned icon).
- Placeholder `https://example.com`.
- Trailing action: Primary button, label per context ("Detect", "Re-detect").
- Enter submits; the button is `type="submit"`.

### 9.3 Validation

- Success: `--td-success` border + `bi-check-circle` + message (`is-valid`).
- Error: `--td-danger` border + `bi-exclamation-triangle` + message
  (`is-invalid`), `aria-invalid="true"`, message id in `aria-describedby`.
- Error messages sentence-case, one line where possible.

### 9.4 Accessibility

Every field has a `<label>`, `name`, and `aria-describedby` where helper or
error text exists. The URL field announces state on submit (see Loading).

---

## 10. Cards

Base card anatomy:

```
+------------------------------------------------+
|  [icon-tile] Title                     [action] |  <- card header (optional)
|  ---------------------------------------------- |
|  Body (p-4 / p-5)                               |
+------------------------------------------------+
```

| Variant | Style |
| --- | --- |
| Default | white, `--td-border`, `--td-shadow-sm`, radius `--td-radius-lg` |
| Flat | `border-0`, no shadow (on tinted sections) |
| Interactive | default + hover lift (`icon-card`, `plugin-card`) |
| Dark | `--td-ink` fill, white text (CTA banner, hero panels) |
| Stat | icon + big gradient number + caption |

Headers: `h2`/`h3` `fw-bold`, optional `bi` icon, optional action link in
`small`. Cards are full-height with `h-100` in grids
(`align-items-stretch`).

---

## 11. Tables

- Wrapper `table-responsive` (horizontal scroll on small screens).
- Header row: `micro` uppercase, `--td-muted`, no background fill.
- Rows: 1px bottom `--td-border`; hover row tint `--td-brand-50`.
- Cells: `py-2`/`py-3`, vertical-align top. Technical cells (`mono`): slug,
  version, text domain, HTTP status.
- Semantic: `<caption>` for complex tables, `scope="col"` on headers.
- Used for the Information Table component and report detail lists.

---

## 12. Badges

`badge rounded-pill fw-semibold` at 0.75rem. Variants map to palette:

| Variant | Fill / text | Use |
| --- | --- | --- |
| `text-bg-primary` | brand-500 / white | platform, "Primary", brand tags |
| `text-bg-success` | success / white | detected, 2xx status |
| `text-bg-warning` | warning / white | medium confidence |
| `text-bg-danger` | danger / white | failure, 4xx/5xx |
| `text-bg-secondary` | muted / white | neutral meta |
| outline | white / ink, brand border | soft meta on cards |

Confidence badges follow the Confidence scale (3.4). Badges may carry a `bi`
glyph (e.g., `bi-magic` on the example-report pill). Never nest a badge inside
a heading; keep it inline in card headers or definition rows.

---

## 13. Alerts

Bootstrap `alert` semantics, product styling:

- Radius `--td-radius-lg`, `--td-shadow-sm`, 1px border in hue.
- Soft tint background (10% hue) + icon in a colored circle + optional
  title (`alert-heading`) + description.
- Variants: `info`, `success`, `warning`, `danger`, all with `role="alert"`.
- Dismissible variant uses the BS close button (keeps focus and `aria-label`).
- Used for: API-key notices (info), success confirmations (success),
  warnings (warning), detection failures (danger - see report page).

---

## 14. Icons

- Single source: **Bootstrap Icons 1.11.3** (already loaded with SRI).
- Every `bi` glyph: `aria-hidden="true"`; meaning conveyed by adjacent text or
  an `aria-label` on the interactive parent.
- Sizes: `small` = `.75rem` inline meta; default 1-1.25rem; tiles 1.25rem.
- Icon tile (`.icon-tile`): `2.9rem` square, radius `.8rem`,
  `--td-brand-50` fill, `--td-brand-700` glyph - feature/platform cards.
- Semantic map (fixed):

| Meaning | Glyph |
| --- | --- |
| Detection / start | `bi-link-45deg`, `bi-magic` |
| CMS / platform | `bi-layers`, `bi-shop`, `bi-bezier2`, ... per platform |
| Theme | `bi-palette` |
| Plugin | `bi-plug`, `bi-puzzle` |
| Speed | `bi-lightning-charge` |
| Privacy | `bi-shield-lock` |
| API / dev | `bi-code-slash`, `bi-terminal` |
| Success / error | `bi-check-circle`, `bi-exclamation-triangle` |

---

## 15. Navigation

Top sticky navbar, dark (`--td-ink` fill, 1px white-8% bottom border):

```
[mark] Theme Detector   Home  API  Blog  Docs  About  GitHub /   [Detect Website]
```

- Brand left; links right (`ms-auto`), `nav-link` white-65%, hover white.
- Active link: white + brand underline or `bi-dot` indicator + `aria-current`.
- CTA: `btn-primary` labeled "Detect Website" (on other pages it links to
  `#detect` / `/`).
- Mobile: `navbar-expand-lg` collapse + toggler; links stack with `gap`; CTA
  becomes full-width below the links.
- Inner pages: optional breadcrumbs under the header (`nav` + `aria-label`).
- Height: ~64px desktop; sticky via `position: sticky` (existing
  `.site-header`).

---

## 16. Footer

Dark (`--td-ink`), four-column, existing `.site-footer`:

```
+---------------------------------------------------------------+
| [mark] Theme Detector   Product     Company      Built On      |
|  Detect any website...  Detect      About        ThemeDetector |
|  (blurb)                API         Blog         runs on       |
|                         Docs        GitHub /     Kernel Fw1    |
| -------------------------------------------------------------- |
| (c) 2026 Theme Detector          Built with Kernel Framework v1 |
+---------------------------------------------------------------+
```

- Columns: `col-lg-5` brand + blurb; `col-6 col-lg-2` Product; `col-6
  col-lg-2` Company; `col-lg-3` Built On.
- Links white-65%, hover white, focus-visible white ring.
- Bottom bar: `flex-column flex-sm-row`, copyright left, framework credit
  right.

---

## 17. Page Containers

| Page type | Container |
| --- | --- |
| Marketing (home) | `.container` full width |
| Report / app | `.container`, center with `col-lg-8` where it aids scanning |
| Reading (docs, blog, about) | `.container` + centered `col-lg-8`/`col-lg-9`, prose `max-width: 65ch` |
| Error (404 / 500) | `.container` + centered `col-md-8 col-lg-6` |

Page scaffold: `body.d-flex.flex-column.min-vh-100` + skip link >
`header.site-header` > `main#main-content` > `footer.site-footer`.

---

## 18. Responsive Grid

Bootstrap breakpoints: **xs < 576 - sm >= 576 - md >= 768 - lg >= 992 -
xl >= 1200 - xxl >= 1400**. Mobile-first; gutters `g-4`.

| Region | xs | sm | md | lg | xl+ |
| --- | --- | --- | --- | --- | --- |
| Platforms grid | 2 cols | 2 | 3 | 4 | 4 |
| Features grid | 1 | 2 | 2 | 3 | 3 |
| How-it-works steps | stacked | stacked | stacked | 3 col + arrows | 3 col + arrows |
| Report cards | 1 | 1 | 2 | 2 | 2 |
| Detection score column | 1 | 1 | 1 | `col-lg-5` beside summary | same |
| Reading prose | 1 | 1 | 1 | `col-lg-8` | `col-lg-8` |

---

## 19. Loading Components

Used on the Loading screen and inside buttons/forms.

| Component | Spec |
| --- | --- |
| Spinner | Bootstrap `.spinner-border`, color `--td-brand`, `aria-hidden` + visible `.visually-hidden` status text, `role="status"` on wrapper |
| Status line | `.loading-status`: current step text in `--td-brand-700`, spinner to the left |
| Progress bar | `.progress` + `.progress-bar-td` (brand gradient `90deg`), striped optional; `aria-valuenow/min/max`, live region |
| Step checklist | Ordered steps: done = `bi-check-circle` success, current = spinner + brand, pending = muted circle |

### Loading screen layout (see wireframe 25.3)

Detection runs server-side with client polling / redirect-to-report. The
screen shows: URL being analyzed (mono), current engine stage
(CMS > Theme > Plugins), an indeterminate progress bar, and a "This usually
takes a few seconds" helper line. Never show a timer that can appear stuck.

---

## 20. Empty States

For "nothing to show" regions (no CMS, no theme, no plugins, empty API list).

```
+-----------------------------------------------+
|              [ bi-hdd-network ]                |
|              No CMS detected                   |
|  We could not determine the platform powering  |
|  this website.                                 |
|             [ Try another URL ]                |
+-----------------------------------------------+
```

- Dashed 1px border (`rgba(10,17,40,.18)`, existing `.empty-state`), radius
  `--td-radius-lg`, centered content, `p-5`.
- Anatomy: muted `bi` icon, `h3` title, `small text-secondary` description,
  optional single primary/ghost CTA.
- Always explain *why* and *what to do next* in the description.

---

## 21. Error States

### In-page failure (report)

Danger alert (see 13) with icon, "Detection failed" title, the raw error
message, and a "Try again" secondary button that refocuses the URL field.

### 404 Not Found

Full-page error layout (see wireframe 25.4): status code in gradient
`display`, title, one-line explanation, primary "Go Home" + secondary "Detect
a website" links, plus the standard navbar/footer so navigation is never dead.

### 500 Server Error

Same scaffold with `bi-exclamation-triangle`, a neutral apology line, and a
"Reload" button. Never surface stack traces to visitors; log server-side.

---

## 22. Report Cards

The core report surface. Anatomy:

```
+--------------------------------------------------+
| [bi-clipboard-data]  Website Information   [meta] |
| -------------------------------------------------- |
|  Submitted URL      https://demo.example.com       |
|  Final URL          https://demo.example.com/      |
|  HTTP Status        Response received      [200]   |
|  Detection Time     1.24 seconds                   |
+--------------------------------------------------+
```

- `card border-0 shadow-sm rounded-4`, header (icon + `h2` title) then a
  definition list (`dl`): label left (`micro` muted) / value right
  (`body`, `mono` for technical values).
- Values that are URLs render as links (existing `report-card` partial).
- Value badges (status codes, confidence) on the right, right-aligned.
- Sits in 2-up grids (`col-lg-6`); score panel is `col-lg-5` beside a
  `col-lg-7` summary.

---

## 23. Confidence Indicators

The product's signature feedback. Three composable parts:

```
   92%   Detection Score
   [============----]   92%  <- gradient progress, color by threshold
   CMS detection    92%
   Theme extraction 98%
   Plugin detection 87%
```

| Part | Spec |
| --- | --- |
| Gradient number | `.score-value`: `display`-ish `3rem/800`, brand gradient text (existing) |
| Progress bar | `.progress-bar-td` gradient; **color shifts by threshold** (green/amber/gray) |
| List | label + mono percentage per signal, each with its own mini bar |

- Threshold color mapping is fixed (3.4): >=80 green, 50-79 amber, <50 gray.
- Every indicator carries `role="progressbar"` + `aria-valuenow` and an
  accessible text equivalent ("92 percent confident").
- A footnote explains the scale on first appearance (report/FAQ).

---

## 24. Component Library

Specified per component: purpose, anatomy, variants, tokens, states, a11y,
and the partial it maps to. All classes are Bootstrap 5.3 + `--td-` tokens.

### 24.1 Navbar
- **Partial:** `partials.header` (existing). **Anatomy:** brand mark +
  wordmark, links, GitHub link, CTA. **States:** active (`aria-current`),
  hover, mobile collapse. **A11y:** `aria-label`, skip link to `#main-content`.

### 24.2 Hero
- **Partial:** home section. **Anatomy:** eyebrow badge, display H1, lead,
  dual CTAs, Search Form, trust line. **Tokens:** ink/navy gradient + radial
  brand glows (existing `.hero`). **States:** n/a. **A11y:** single H1.

### 24.3 Search Form
- **Partial:** `partials.search-form`. **Anatomy:** label + URL input group +
  submit. **Variants:** hero (lg), inline report re-detect (default).
  **States:** loading (spinner in button + disabled), validation.

### 24.4 URL Input
- Part of Search Form. `input-group`, `bi-link-45deg` prefix, mono not
  required (plain text), placeholder `https://example.com`, lg on hero.

### 24.5 Primary Button
- 8.1 primary. Used for: Detect, hero CTA, form submit, primary modals.

### 24.6 Secondary Button
- 8.1 secondary. Used for: "View Demo", cancel, retry, secondary CTAs.

### 24.7 Feature Card
- **Partial:** `partials.icon-card` (feature mode). Icon tile + `h3` + body,
  interactive hover lift. Grid: 1/2/3 cols.

### 24.8 Platform Card
- **Partial:** `partials.icon-card` (platform mode). Platform icon + name +
  one-line description, optional "Supported" badge. Grid: 2/3/4 cols.

### 24.9 Report Card
- 22. Header icon + title + definition list. Mono values, badges, links.

### 24.10 Plugin Card
- **Partial:** `partials.plugin-card`. `bi-plug` tile, plugin name, slug
  (mono), version badge, optional confidence, optional external link. Hover
  lift. 2-up grid (`col-sm-6`).

### 24.11 Theme Card
- **Partial:** `partials.report-card` with Theme items, or a dedicated card
  when the theme has rich metadata. Leading `bi-palette` tile + Name/Version/
  Author/License/Tags (mono values), optional screenshot link.

### 24.12 Information Table
- 11. Responsive wrapper, `micro` headers, mono technical cells, hover rows.
  Used for API endpoints, changelog lists, metadata tables.

### 24.13 Loading Spinner
- 19. Brand-colored `.spinner-border` with `role="status"` + hidden text.

### 24.14 Progress Bar
- 19. `.progress-bar-td` gradient, threshold-colored, ARIA live.

### 24.15 Toast
- BS toast, `--td-radius-lg`, `--td-shadow-lg`, success/info/danger variants,
  auto-dismiss 5s for success only, close button always, `role="status"`.

### 24.16 Alert
- 13. Info/success/warning/danger, icon circle + title + text.

### 24.17 Modal
- BS modal, centered, `--td-radius-xl`, `--td-shadow-lg`, header/body/footer,
  `aria-labelledby` + `aria-describedby`, focus trap via BS. Used for confirm
  dialogs and docs/API key dialogs only - not for reports.

### 24.18 Footer
- 16. Four columns + bottom bar.

---

## 25. Page Wireframes

Legend: `[x]` button/badge, `>` link, `---` divider, `(..)` helper text.

### 25.1 Homepage

```
+------------------------------------------------------------------+
| [mark] Theme Detector  Home API Blog Docs About GitHub> [Detect>] |
+------------------------------------------------------------------+
|  (hero, ink gradient)                                             |
|   [bolt] Free website intelligence - no sign-up                   |
|   Detect Any Website's Theme & Plugins in Seconds                 |
|   Reveal the CMS, theme, theme version, author, and active plugins|
|   behind any website.                                             |
|   [Detect Website]  [View Demo]                                  |
|   [link-icon] https://example.com ............ [Detect]          |
|   (check) Free - No sign-up - 9+ platforms supported              |
+------------------------------------------------------------------+
|  SUPPORTED PLATFORMS (eyebrow)                                   |
|  Works Across the Web                                             |
|  [WP] [Shopify] [Webflow] [Wix] | [Ghost] [Joomla] [Drupal] ...  |
|  (2 cols mobile / 4 cols desktop icon-cards)                      |
+------------------------------------------------------------------+
|  FEATURES                                                        |
|  Everything You Need to Know a Site                               |
|  [Theme]  [Plugins] [Extraction] | [Speed] [Privacy] [API]       |
|  (1/2/3 col icon-cards, hover lift)                              |
+------------------------------------------------------------------+
|  HOW IT WORKS                                                    |
|  Three Steps to a Full Report                                    |
|   [1] Enter URL  -->  [2] Engine Detects  -->  [3] View Report   |
+------------------------------------------------------------------+
|  LIVE EXAMPLE (report preview)                                   |
|  [magic] Example report - WordPress site                         |
|  [Website Info]  [CMS: WordPress 92%]                           |
|  [Theme Info]    [Detected Plugins]  |  [Confidence Scores]      |
+------------------------------------------------------------------+
|  FAQ (accordion)  |  CTA banner (dark): Start Detecting Now      |
+------------------------------------------------------------------+
|  footer (4 cols)                                                 |
+------------------------------------------------------------------+
```

### 25.2 Detection Report

```
+------------------------------------------------------------------+
| [mark] Theme Detector        (navbar, "Detect Website" active)   |
+------------------------------------------------------------------+
|  [URL input + Re-detect]                                         |
+------------------------------------------------------------------+
|  Detection Report                          [WordPress detected]  |
|  https://demo.example.com/                                       |
|  +----------------------------+  +-----------------------------+ |
|  | Website Summary            |  | 92%  Detection Score        | |
|  | Submitted URL  <url mono>  |  | [progress 92%]             | |
|  | Final URL      <url mono>  |  | CMS detection      92%      | |
|  | HTTP Status    [200]       |  | Theme extraction   98%      | |
|  | Detection Time 1.24s       |  | Plugin detection   87%      | |
|  +----------------------------+  +-----------------------------+ |
|  | CMS Information            |  | Theme Information           | |
|  | Platform  WordPress [Primary] | Name   Twenty Twenty-Five  | |
|  | Confidence  92%             |  | Version 1.0.2               | |
|  | Detected   [Yoast SEO] 88% |  | Author  Automattic          | |
|  +----------------------------+  +-----------------------------+ |
|  | Theme Metadata             |  | Detected Plugins            | |
|  | Description ...             |  | [Contact Form 7] [WooCommerce]| |
|  | Text Domain twenty-...      |  | (plugin-cards 2-up)          | |
|  +----------------------------+  +-----------------------------+ |
|  | Detection Details          |  | Performance Summary         | |
|  | Theme Detection  WP [..]   |  | Detection Time  1.243s      | |
|  | Theme Extraction 25.1 [98%]|  | HTTP Status     [200]       | |
|  | Plugin Detection  CF7 [87%]|  | Technologies    3           | |
|  +----------------------------+  +-----------------------------+ |
|  [Copy report] [Print] [New detection]                            |
|  (empty-states replace card bodies when a signal is absent)       |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.3 Loading Screen

```
+------------------------------------------------------------------+
| [mark] Theme Detector        (navbar)                            |
+------------------------------------------------------------------+
|  Analyzing https://demo.example.com        (mono, muted)         |
|                                                                  |
|                 (spinner, brand, centered)                       |
|              Detecting WordPress theme...    (loading-status)    |
|  [======== progress indeterminate =======]                       |
|  (check) Fetching website     (check) Detecting CMS             |
|  (spinner) Extracting theme   (circle) Detecting plugins        |
|  (helper) This usually takes a few seconds...                    |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.4 404 Not Found

```
+------------------------------------------------------------------+
| [mark] Theme Detector        (navbar)                            |
+------------------------------------------------------------------+
|                    404   (gradient display)                      |
|              Page not found                                       |
|  The page you are looking for doesn't exist or was moved.        |
|              [Go Home]        [Detect a website]                 |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.5 500 Server Error

```
+------------------------------------------------------------------+
| [mark] Theme Detector        (navbar)                            |
+------------------------------------------------------------------+
|               [bi-exclamation-triangle]                          |
|              Something went wrong                                 |
|  Our servers hit an unexpected error. Please try again shortly.  |
|                 [Reload]       [Contact support >]               |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.6 About

```
+------------------------------------------------------------------+
|  (navbar)  Breadcrumb: Home > About                              |
+------------------------------------------------------------------+
|  About ThemeDetectorTool                                          |
|  Eyebrow + title + lead paragraph (reading column col-lg-8)      |
|  [Mission] [How detection works] [Privacy] [Technology]          |
|  (icon-cards 2-up)                                                |
|  Timeline / team / open-source section (optional)                |
|  CTA banner: Start Detecting Now                                  |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.7 API

```
+------------------------------------------------------------------+
|  (navbar)  Breadcrumb: Home > API                                |
+------------------------------------------------------------------+
|  Developer API                                                   |
|  [info alert] No API key required in the Public MVP              |
|  Endpoint card: POST /api/detect        [Try it]                 |
|  Request example (code block, mono)     Response example         |
|  Information Table: parameters / headers / errors                |
|  [security] Rate limits  [pricing] Free tier                     |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.8 Documentation

```
+------------------------------------------------------------------+
|  (navbar)  Breadcrumb: Home > Documentation                      |
+------------------------------------------------------------------+
|  left sidebar nav (docs tree, collapsible on mobile)             |
|  +-----------------------------+  +----------------------------+ |
|  | Getting started             |  | Title (h1)                 | |
|  | Detection API               |  | prose, code blocks (mono), | |
|  | Supported platforms         |  | information tables, alerts | |
|  | Errors & status codes       |  | prev/next pager at bottom  | |
|  +-----------------------------+  +----------------------------+ |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.9 Blog

```
+------------------------------------------------------------------+
|  (navbar)  Breadcrumb: Home > Blog                               |
+------------------------------------------------------------------+
|  Blog                                                            |
|  Featured post (large card: title, excerpt, date, read more >)   |
|  [Post card] [Post card] [Post card]   (1/2/3 col grid)          |
|  [Post card] [Post card] [Post card]                             |
|  pagination (first/prev/1..n/next/last)                          |
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

### 25.10 Contact

```
+------------------------------------------------------------------+
|  (navbar)  Breadcrumb: Home > Contact                            |
+------------------------------------------------------------------+
|  Contact Us                                                      |
|  [Contact form: name, email, subject, message]      [Send]      |
|  (right rail) Support options: GitHub Issues >, Docs >, FAQ >   |
|  [success alert] Message sent - we reply within 1-2 business days|
+------------------------------------------------------------------+
|  footer                                                           |
+------------------------------------------------------------------+
```

---

## 26. Responsive Rules

Global rules:

1. Mobile-first: default styles are the mobile layout; `md`/`lg`/`xl`
   modifiers enhance.
2. Gutters `g-4` everywhere; section padding `py-5` (mobile) -> `py-6` (`lg+`).
3. Multi-column grids collapse by region per 18. Never force horizontal
   overflow; wrap wide tables in `table-responsive`.
4. Navbar collapses below `lg`; CTA becomes a full-width row under the links.
5. Hero: stack search below CTAs on mobile; single centered column up to
   `col-lg-10 col-xl-9`; type scales fluidly via `clamp`.
6. Report grid: 1 column on xs, 2 columns from `md`; score panel sits beside
   the summary from `lg`.
7. Reading pages: single column on mobile, centered `col-lg-8` from `lg`;
   docs get a two-column layout (sidebar + content) at `lg+` only.
8. Buttons in card grids stretch full-width on xs (`w-100`) and auto on sm+.
9. Touch targets: interactive elements >= 44px (buttons, nav links, icon
   buttons).
10. Text: never scale below 16px in inputs (prevents iOS zoom on focus).

---

## 27. Naming Convention

### 27.1 Files (PHP partials, assets)

- Lowercase kebab-case: `home.php`, `report.php`, `partials/search-form.php`,
  `partials/report-card.php`, `assets/css/app.css`, `assets/js/app.js`.
- Partial invocation: `view('partials.report-card', [...])` (existing pattern).

### 27.2 CSS

- Bootstrap utility classes for layout (grid, spacing, typography).
- Custom component classes: kebab-case BEM-lite
  (`block__element--modifier` where needed), prefixed for product specifics:
  - Existing (kept): `.site-header`, `.site-footer`, `.hero`, `.hero-badge`,
    `.brand-mark`, `.display-title`, `.eyebrow`, `.icon-tile`, `.icon-card`,
    `.step-card`, `.step-number`, `.step-arrow`, `.cta-banner`, `.score-value`,
    `.score-suffix`, `.progress-bar-td`, `.empty-state`, `.plugin-card`,
    `.loading-spinner`, `.loading-status`, `.mono`.
  - Future: `.report-card`, `.confidence-bar`, `.status-dot`,
    `.docs-sidebar`, `.pagination`.
- Design tokens: CSS custom properties prefixed `--td-` (colors, `--td-radius-*`,
  `--td-shadow-*`, `--td-focus-ring`). Never hard-code hex/rgb in components.

### 27.3 JS

- camelCase for functions/variables; event data attributes `data-td-*`
  (e.g., `data-td-action="detect"`); Bootstrap events not re-declared.
- Scripts are progressive enhancement only; pages work without JS.

### 27.4 HTML / a11y

- Semantic landmarks: `header`, `nav`, `main#main-content`, `footer`;
  one `h1` per page; headings descend in order.
- States: `aria-current`, `aria-describedby`, `aria-invalid`, `role="status"`,
  `role="alert"`, `role="progressbar"` where defined in 19-23.

### 27.5 PHP

- Partials receive a flat config array; defaults set inside the partial
  (`$title = $title ?? '...'`); output always escaped with
  `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.

---

## 28. Development Guidelines

### 28.1 Stack

- Bootstrap 5.3.3 CSS/JS + Bootstrap Icons 1.11.3 via CDN with SRI
  (already in `partials.header` / `partials.footer`).
- One custom stylesheet: `public/assets/css/app.css` (tokens, base,
  components, utilities - in that order).
- One custom script: `public/assets/js/app.js`, `defer`, no jQuery.

### 28.2 Implementation order for new UI

1. Add needed `--td-*` tokens to `app.css` `:root` (never inline styles).
2. Build/refactor the partial under `resources/views/partials/`.
3. Compose pages from partials + config arrays.
4. Validate: responsive at xs/sm/md/lg/xl, keyboard-only, axe pass.
5. QA checklist below.

### 28.3 QA checklist (every page)

- Lighthouse >= 90 performance/accessibility/SEO on mobile & desktop.
- Tab order logical; visible focus ring on all interactive elements.
- Contrast AA on body text, badges, alerts.
- No console errors; no missing `aria-label` on icon-only controls.
- Page has unique `<title>`, `meta description`, OG tags (header partial).
- Works with JS disabled (forms degrade to full-page submit).

### 28.4 Performance budget

- First paint free of render-blocking custom fonts (system stack default).
- Single CSS file, minified; single JS file, minified + defer.
- Icons via icon font (no SVG sprite payload); images lazy-loaded.
- No third-party scripts on marketing pages beyond CDN Bootstrap assets.

### 28.5 Do not

- Do not introduce inline `style=` in views.
- Do not add a second CSS framework or icon set.
- Do not override Bootstrap core components globally unless this spec does.
- Do not invent colors outside the `--td-` palette.
- Do not ship pages not covered by a wireframe above without updating this
  document first.

---

*End of ThemeDetectorTool v2 UI Specification v1.0.*

