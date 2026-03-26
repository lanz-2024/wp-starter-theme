# Testing

## Manual Testing Checklist

### Theme activation

- [ ] Activate theme in Appearance > Themes — no PHP errors, no white screen.
- [ ] Front page loads with header and footer template parts.
- [ ] Admin bar visible for logged-in users.

### Templates

| Template | How to test |
|----------|-------------|
| `index.html` | Visit `/` with posts published |
| `single.html` | Open any post |
| `archive.html` | Visit a category page |
| `page.html` | Open any static page |
| `404.html` | Visit `/this-does-not-exist` |
| `search.html` | Submit the header search form |
| `single-portfolio.html` | Open a post of type `portfolio` |
| `blank.html` | Assign "Blank" template to a page in the editor |

### Block patterns

1. Open the block editor on a new page.
2. Click the `+` inserter > Patterns tab.
3. Filter by "WP Starter Theme".
4. Insert each pattern: Hero Banner, Call to Action, Testimonials Grid, Portfolio Showcase.
5. Verify patterns render without block validation errors.

### Style variations

1. Open Site Editor > Styles > Browse styles.
2. Activate "Dark" — verify background/text contrast inverts.
3. Activate "Minimal" — verify reduced spacing and static type scale.
4. Restore "Default".

### Customizer

1. Open Appearance > Customizer > Theme Options.
2. **Header Options**:
   - Toggle "Sticky header" — confirm no JS errors.
   - Change "Header background color" — preview updates live.
   - Drag "Header height" range slider — preview height updates live.
3. **Footer Options**:
   - Edit "Copyright text" — confirm selective refresh updates footer text.
   - Change "Footer background color" — preview updates live.
4. **Colors**:
   - Change "Primary color" — confirm links and buttons update live.
   - Change "Secondary color".
5. Click Publish — reload the front end and confirm settings persisted.

### Accessibility

- [ ] Tab through the entire page with keyboard only — focus never gets trapped unexpectedly.
- [ ] Open mobile menu (resize to < 600 px), verify Escape closes it.
- [ ] Run axe DevTools browser extension — zero critical violations.

### Performance baseline

- [ ] Run Lighthouse in Chrome DevTools on the front page.
  - Performance ≥ 90
  - Accessibility ≥ 95
  - Best Practices ≥ 95
  - SEO ≥ 90

---

## PHPCS (PHP Coding Standards)

```bash
composer install
vendor/bin/phpcs --standard=WordPress src/
```

Expected output: `0 errors, 0 warnings`.

To auto-fix:

```bash
vendor/bin/phpcbf --standard=WordPress src/
```

---

## PHPStan (Static Analysis)

```bash
vendor/bin/phpstan analyse src/ --level=5
```

Expected output: `[OK] No errors`.

A `phpstan.neon` configuration file can be added to the project root to
include the `szepeviktor/phpstan-wordpress` stubs:

```neon
includes:
    - vendor/szepeviktor/phpstan-wordpress/extension.neon

parameters:
    level: 5
    paths:
        - src/
```

---

## PHPUnit (Unit Tests)

```bash
vendor/bin/phpunit
```

Test files live in `tests/`. Brain\Monkey provides WordPress function stubs
so tests run without a WordPress installation.

### Example test

```php
use Brain\Monkey;
use PHPUnit\Framework\TestCase;
use WPStarterTheme\Theme;

class ThemeTest extends TestCase {
    protected function setUp(): void {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown(): void {
        Monkey\tearDown();
        Theme::reset();
        parent::tearDown();
    }

    public function test_init_is_idempotent(): void {
        Theme::init();
        Theme::init(); // Second call must not register hooks twice.
        $this->assertNotNull(Theme::get_provider(\WPStarterTheme\Providers\AssetProvider::class));
    }
}
```

---

## JavaScript Linting

```bash
pnpm lint:js
pnpm lint:style
```

---

## Block Validation

After any change to pattern PHP files or template HTML files:

1. Open the Site Editor.
2. Open each affected template/pattern.
3. Confirm no "This block contains unexpected or invalid content" warning appears.
