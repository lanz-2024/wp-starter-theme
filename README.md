# WP Starter Theme

A modern WordPress 6.9 block theme demonstrating Full Site Editing, theme.json v3, block patterns, Customizer API, and a clean PSR-4 PHP architecture — built as a portfolio reference project.

---

## Screenshot

> _Place a 1200 × 900 px screenshot at `screenshot.png` in the theme root. WordPress displays it in Appearance > Themes._

---

## Why This Theme Exists

Most WordPress block theme examples stop at `theme.json` and a few templates. This project goes further:

- **theme.json v3** — fluid `clamp()` typography, a 7-token colour palette, a 7-step spacing scale, and element-level styles (links, headings, buttons) — all in one declarative file.
- **FSE templates** — every standard template (`index`, `single`, `archive`, `page`, `404`, `search`) plus a custom `single-portfolio` template for a portfolio CPT.
- **Block patterns** — four production-ready patterns auto-discovered by WordPress from `/patterns/`.
- **Style variations** — Dark and Minimal variations that override the default theme.json palette and type scale.
- **Customizer API** — a full `Theme Options` panel with live `postMessage` preview, selective refresh, a custom range-slider control, and colour pickers — all wired to CSS custom properties.
- **PSR-4 provider architecture** — no logic in `functions.php`; every feature lives in a single-responsibility provider class under `WPStarterTheme\`.

---

## Quick Start

```bash
# 1. Clone into your WordPress themes directory
git clone https://github.com/lanz-2024/wp-starter-theme \
  /path/to/wp-content/themes/wp-starter-theme

# 2. Install PHP dependencies
cd /path/to/wp-content/themes/wp-starter-theme
composer install

# 3. Install JS dependencies and build assets
pnpm install
pnpm build

# 4. Activate in WordPress
wp theme activate wp-starter-theme
```

Or symlink for local development:

```bash
ln -s /path/to/wp-starter-theme \
  /path/to/wordpress/wp-content/themes/wp-starter-theme
```

---

## Features

### theme.json v3

- Fluid typography via `clamp()` — 7 type sizes from `xs` (0.75 rem) to `3xl` (3 rem).
- 7-token colour palette: primary, primary-dark, secondary, neutral-900, neutral-100, white, black.
- 7-step spacing scale: `xs` (0.5 rem) through `3xl` (6 rem).
- Layout constraints: `contentSize: 720px`, `wideSize: 1200px`.
- Global element styles for links, all heading levels, and buttons.
- Appearance tools enabled — lets editors control borders, padding, and margin from the block toolbar.

### Full Site Editing

- All templates built entirely with block markup — zero PHP template files.
- Template parts for header, footer, sidebar, and comments are independently editable in the Site Editor.
- Custom template `single-portfolio.html` shows meta fields (client, year, services, URL) via `wp:post-meta` blocks.

### Block Patterns

| Pattern | Slug | Description |
|---------|------|-------------|
| Hero Banner | `wp-starter-theme/hero-banner` | Full-width cover with `clamp()` headline, subheading, and two CTA buttons |
| Call to Action | `wp-starter-theme/call-to-action` | Primary-coloured band with centred heading, text, and button |
| Testimonials Grid | `wp-starter-theme/testimonials-grid` | Three testimonial cards with quote, author avatar, name, and role |
| Portfolio Showcase | `wp-starter-theme/portfolio-showcase` | Query-powered 3-column grid for the `portfolio` CPT |

### Style Variations

| Variation | Description |
|-----------|-------------|
| Dark | Deep navy (`#0f172a`) background, slate text, blue accent — complete palette and element overrides |
| Minimal | Static (non-fluid) type scale, monochrome palette, light-weight headings, underline-style links |

### Customizer

Three sections under the **Theme Options** panel:

- **Header Options** — sticky toggle, background colour, height slider (custom `RangeControl`).
- **Footer Options** — copyright text (selective refresh), background colour.
- **Colors** — primary and secondary colours that update CSS custom properties live.

See `docs/CUSTOMIZER.md` for full setting reference.

### PSR-4 Provider Architecture

| Provider | Responsibility |
|----------|---------------|
| `SupportProvider` | `add_theme_support()`, `add_image_size()` |
| `AssetProvider` | `wp_enqueue_scripts`, `add_editor_style()` |
| `MenuProvider` | `register_nav_menus`, primary menu search icon filter |
| `PatternProvider` | `register_block_pattern_category` |
| `CustomizerProvider` | All Customizer panels, sections, settings, and controls |

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| CMS | WordPress 6.9 |
| PHP | 8.5 — strict types, readonly properties, named arguments |
| Templates | FSE block HTML |
| Design tokens | theme.json v3 |
| JavaScript | TypeScript 5, compiled by @wordpress/scripts (webpack) |
| CSS | theme.json + editor.css (no build step for CSS) |
| Dependency management | Composer (PHP), pnpm (JS) |
| Code quality | PHPCS (WordPress standard), PHPStan level 5 |
| Tests | PHPUnit 11, Brain\Monkey |

---

## Project Structure

```
wp-starter-theme/
├── style.css                    ← Theme header (no CSS rules)
├── functions.php                ← Autoload + Theme::init()
├── theme.json                   ← Design tokens & global styles
├── composer.json
├── package.json
│
├── templates/                   ← FSE block templates
│   ├── index.html
│   ├── single.html
│   ├── single-portfolio.html
│   ├── archive.html
│   ├── page.html
│   ├── 404.html
│   ├── search.html
│   └── blank.html
│
├── parts/                       ← Template parts
│   ├── header.html
│   ├── footer.html
│   ├── sidebar.html
│   └── comments.html
│
├── patterns/                    ← Block patterns (auto-discovered)
│   ├── hero-banner.php
│   ├── call-to-action.php
│   ├── testimonials-grid.php
│   └── portfolio-showcase.php
│
├── styles/                      ← Style variations
│   ├── dark.json
│   └── minimal.json
│
├── src/                         ← PHP source (PSR-4: WPStarterTheme\)
│   ├── Theme.php
│   ├── Providers/
│   │   ├── AssetProvider.php
│   │   ├── CustomizerProvider.php
│   │   ├── MenuProvider.php
│   │   ├── PatternProvider.php
│   │   └── SupportProvider.php
│   ├── Walkers/
│   │   └── MegaMenuWalker.php
│   └── Customizer/
│       ├── Controls/
│       │   └── RangeControl.php
│       └── Sections/
│           ├── HeaderSection.php
│           └── FooterSection.php
│
├── assets/
│   ├── css/
│   │   ├── editor.css           ← Block editor stylesheet
│   │   └── customizer-preview.css
│   └── js/
│       ├── navigation.ts        ← Mobile menu + keyboard nav
│       ├── customizer-preview.ts ← Customizer postMessage handler
│       └── dist/                ← Compiled output (gitignored)
│
├── docs/
│   ├── ARCHITECTURE.md
│   ├── CUSTOMIZER.md
│   └── TESTING.md
│
└── tests/                       ← PHPUnit test suite
```

---

## Development

### Build JavaScript

```bash
pnpm dev      # watch mode (rebuilds on save)
pnpm build    # production build (minified)
```

Output goes to `assets/js/dist/`.

### PHP linting

```bash
composer phpcs     # run PHPCS (WordPress standard)
composer phpcbf    # auto-fix PHPCS violations
composer phpstan   # run PHPStan level 5
composer test      # run PHPUnit test suite
```

---

## License

GPL-2.0-or-later. See [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).
