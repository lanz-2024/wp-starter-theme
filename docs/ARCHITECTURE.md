# Architecture

## Overview

WP Starter Theme is a **Full Site Editing (FSE) block theme** built on WordPress 6.9. It combines the declarative power of `theme.json` with a clean PHP provider system under a PSR-4 namespace, producing a codebase that is both easy to extend and straightforward to test.

---

## FSE Template Hierarchy

WordPress resolves block templates in this order (most specific wins):

```
templates/
├── index.html              ← Fallback for all requests
├── single.html             ← Single posts
├── single-portfolio.html   ← Custom: portfolio CPT
├── archive.html            ← Category, tag, date archives
├── page.html               ← Static pages
├── 404.html                ← Not found
├── search.html             ← Search results
└── blank.html              ← No chrome (page-level override)
```

Template parts are reusable fragments injected via `<!-- wp:template-part -->`:

```
parts/
├── header.html     ← area: header
├── footer.html     ← area: footer
├── sidebar.html    ← area: uncategorized
└── comments.html   ← area: uncategorized
```

---

## theme.json v3

`theme.json` is the single source of truth for design tokens. It replaces `add_theme_support()` calls for colours, typography, and spacing, and generates CSS custom properties automatically.

### Key sections

| Section | Purpose |
|---------|---------|
| `settings.color.palette` | 7-token colour palette → `--wp--preset--color--*` |
| `settings.typography.fluid: true` | Enables fluid type via `clamp()` |
| `settings.typography.fontFamilies` | Inter (sans), JetBrains Mono (mono) |
| `settings.typography.fontSizes` | 7-step scale using `clamp()` |
| `settings.spacing.spacingSizes` | 7-step spacing scale |
| `settings.layout` | `contentSize: 720px`, `wideSize: 1200px` |
| `styles.elements` | Global link, heading, and button styles |

---

## PHP Provider System

`functions.php` is intentionally minimal — it only loads the Composer autoloader and calls `Theme::init()`. All functionality is delegated to **providers**.

```
src/
├── Theme.php                           ← Bootstrapper; instantiates providers
├── Providers/
│   ├── AssetProvider.php               ← wp_enqueue_scripts, add_editor_style
│   ├── MenuProvider.php                ← register_nav_menus, menu filters
│   ├── PatternProvider.php             ← register_block_pattern_category
│   ├── SupportProvider.php             ← add_theme_support, add_image_size
│   └── CustomizerProvider.php          ← Customizer panels, settings, controls
├── Walkers/
│   └── MegaMenuWalker.php              ← Walker_Nav_Menu with mega-menu support
└── Customizer/
    ├── Controls/
    │   └── RangeControl.php            ← Custom range slider control
    └── Sections/
        ├── HeaderSection.php           ← Header section config helper
        └── FooterSection.php           ← Footer section config helper
```

### Provider contract

Each provider implements a single public `register(): void` method that wires up WordPress hooks. Providers are instantiated once and stored in `Theme::$providers`. This allows retrieval by class name (`Theme::get_provider(SomeProvider::class)`) in tests.

### Autoloading

PSR-4 mapping in `composer.json`:

```json
"autoload": {
    "psr-4": { "WPStarterTheme\\": "src/" }
}
```

Run `composer install` to generate `vendor/autoload.php`.

---

## Block Patterns

Patterns live in `patterns/` as PHP files with registration headers (WordPress 6.0+ auto-discovery):

```
patterns/
├── hero-banner.php           ← Full-width cover hero + two CTAs
├── call-to-action.php        ← Centered CTA band
├── testimonials-grid.php     ← 3-column testimonial cards
└── portfolio-showcase.php    ← Query-driven 3-col portfolio grid
```

Custom categories are registered by `PatternProvider` via `register_block_pattern_category()`.

---

## Style Variations

Alternate visual presentations declared in `styles/`:

| File | Description |
|------|-------------|
| `styles/dark.json` | Inverted palette on `#0f172a` background |
| `styles/minimal.json` | Static (non-fluid) type scale, neutral palette, light 300 weight headings |

Activated via Site Editor > Styles > Browse styles.

---

## Asset Pipeline

TypeScript sources in `assets/js/` are compiled by `@wordpress/scripts`:

```
assets/js/
├── navigation.ts           ← Mobile menu toggle + keyboard nav
├── customizer-preview.ts   ← Customizer postMessage live-preview
└── dist/                   ← Compiled output (gitignored)
```

Build commands:

```bash
pnpm build   # production build
pnpm dev     # watch mode
```

Editor styles (`assets/css/editor.css`) are loaded only inside the block editor via `add_editor_style()`.

---

## Custom Post Type: Portfolio

The theme declares image sizes for a `portfolio` CPT but deliberately does **not** register the CPT itself. This keeps the theme portable — register `portfolio` in a site-specific plugin to avoid data loss on theme switch.

Image sizes registered:

| Name | Dimensions | Crop |
|------|-----------|------|
| `portfolio-card` | 640 × 480 | Hard crop |
| `portfolio-hero` | 1920 × 600 | Hard crop |
| `blog-card` | 800 × 500 | Hard crop |

---

## Navigation

Three menu locations are registered:

| Slug | Label |
|------|-------|
| `primary` | Primary Navigation |
| `footer` | Footer Navigation |
| `mobile` | Mobile Navigation |

`MegaMenuWalker` extends `Walker_Nav_Menu` to:
- Add `aria-expanded` / `aria-controls` / `aria-haspopup` to top-level items with children.
- Wrap third-level items in `.mega-menu__column` divs.
- Inject SVG chevron icons into parent link elements.

---

## Customizer Integration

Settings use `postMessage` transport wherever possible for instant live preview. `customizer-preview.ts` listens to each setting's `bind()` callback and applies changes via CSS custom property overrides, so theme.json `var()` references pick them up automatically.

Selective refresh is registered for text-based settings (copyright text) to update rendered output server-side.
