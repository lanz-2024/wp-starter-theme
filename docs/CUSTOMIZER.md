# Customizer Reference

The theme registers a "Theme Options" panel in the WordPress Customizer (Appearance > Customizer > Theme Options) containing three sections.

---

## Panel: Theme Options

**ID:** `wp_starter_theme_options`
**Priority:** 130

---

## Section: Header Options

**ID:** `wp_starter_header_options`

| Setting ID | Type | Default | Transport | Description |
|-----------|------|---------|-----------|-------------|
| `header_sticky` | `checkbox` | `false` | `refresh` | Enable sticky header that stays fixed at the top on scroll |
| `header_bg_color` | `color` | `#ffffff` | `postMessage` | Background colour of the site header |
| `header_height` | `range` | `64` (px) | `postMessage` | Height of the header in pixels (48–120, step 4) |

### Live preview behaviour

- `header_bg_color` — immediately updates `background-color` on `.site-header` and `.wp-block-template-part[data-area="header"]` via `customizer-preview.ts`. Also sets `--wp-starter-header-bg` CSS variable.
- `header_height` — updates `min-height` and sets `--wp-starter-header-height` CSS variable.
- `header_sticky` — triggers a full preview reload (`transport: refresh`).

---

## Section: Footer Options

**ID:** `wp_starter_footer_options`

| Setting ID | Type | Default | Transport | Description |
|-----------|------|---------|-----------|-------------|
| `footer_copyright_text` | `text` | `© {year} WP Starter Theme...` | `postMessage` | Copyright / credit line rendered in the footer |
| `footer_bg_color` | `color` | `#111827` | `postMessage` | Background colour of the site footer |

### Live preview behaviour

- `footer_copyright_text` — uses **selective refresh** to re-render `.site-footer__copyright` server-side. The partial's `render_callback` returns the sanitised setting value via `wp_kses_post()`.
- `footer_bg_color` — immediately updates `background-color` on `.site-footer` and `[data-area="footer"]`.

---

## Section: Colors

**ID:** `wp_starter_colors`

| Setting ID | Type | Default | Transport | Description |
|-----------|------|---------|-----------|-------------|
| `primary_color` | `color` | `#2563eb` | `postMessage` | Brand primary colour; used for links, buttons, and accents |
| `secondary_color` | `color` | `#7c3aed` | `postMessage` | Brand secondary colour; used for highlights and gradients |

### Live preview behaviour

Both colour settings override the corresponding theme.json CSS custom properties directly on `<html>`:

- `primary_color` → `--wp--preset--color--primary`
- `secondary_color` → `--wp--preset--color--secondary`

Because all theme.json-derived properties cascade to every block that references `var(--wp--preset--color--primary)`, updating one value here refreshes the entire colour system instantly without reloading the page.

---

## Custom Controls

### RangeControl

**Class:** `WPStarterTheme\Customizer\Controls\RangeControl`
**File:** `src/Customizer/Controls/RangeControl.php`

Extends `WP_Customize_Control` to render a native HTML `<input type="range">` paired with a linked `<input type="number">` for keyboard-accessible value entry.

**Constructor parameters** (passed in the `$args` array):

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `min` | `int` | `0` | Minimum slider value |
| `max` | `int` | `100` | Maximum slider value |
| `step` | `int` | `1` | Slider increment |

The number input mirrors the range via an inline `oninput` handler and dispatches a bubbling `input` event so the Customizer's core postMessage plumbing picks it up normally.

---

## Selective Refresh Partials

| Partial ID | Selector | Render callback |
|-----------|---------|----------------|
| `header_bg_color` | `.site-header` | `__return_null` (JS handles the update) |
| `footer_copyright_text` | `.site-footer__copyright` | Returns sanitised setting value |

---

## Adding New Settings

1. Add a setting in `CustomizerProvider::setup_customizer()`:

```php
$wp_customize->add_setting( 'my_setting', [
    'default'           => 'default_value',
    'transport'         => 'postMessage', // or 'refresh'
    'sanitize_callback' => 'sanitize_text_field',
] );
```

2. Add a control:

```php
$wp_customize->add_control( 'my_setting', [
    'label'   => __( 'My Setting', 'wp-starter-theme' ),
    'section' => 'wp_starter_header_options', // or any section ID
    'type'    => 'text',
] );
```

3. If `transport` is `postMessage`, add a handler in `assets/js/customizer-preview.ts`:

```typescript
customize('my_setting', (value) => {
    value.bind((newVal: string) => {
        document.querySelectorAll<HTMLElement>('.my-selector').forEach((el) => {
            el.textContent = newVal;
        });
    });
});
```

4. Run `pnpm build` to compile the TypeScript.
