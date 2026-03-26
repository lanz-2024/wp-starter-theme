# Security

## WordPress Security Standards

All theme code follows WordPress security best practices:

### Output Escaping
- All output escaped with appropriate functions: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- No raw `echo` of user-supplied or database data

### Input Sanitization
- Customizer settings sanitized with `sanitize_text_field()`, `sanitize_hex_color()`, `absint()`
- All `get_theme_mod()` values sanitized before use

### Nonces
- All form submissions verified with `wp_verify_nonce()`
- AJAX requests verify nonces via `check_ajax_referer()`

### Capability Checks
- Admin-only functionality gated with `current_user_can('manage_options')`
- No privilege escalation possible through theme hooks

## Content Security Policy

Recommended CSP headers (set via server or plugin):
```
default-src 'self';
script-src 'self' 'nonce-{RANDOM}';
style-src 'self' 'unsafe-inline';
img-src 'self' data: https:;
frame-ancestors 'none';
```

## Asset Security

- All scripts and styles enqueued via `wp_enqueue_scripts()` — no inline scripts
- Script versioning prevents cache poisoning
- External resources loaded only from trusted CDNs (none in default config)

## PHPCS / PHPStan

- PHPCS enforces WordPress-Extra coding standards — zero errors required
- PHPStan level 8 with WordPress stubs — no type errors
- Both run in CI on every push
