# Deployment

## Local Development (LocalWP)

1. Clone the repo
2. Symlink the theme into your WordPress install:
```bash
ln -s /path/to/wp-starter-theme /path/to/wordpress/wp-content/themes/wp-starter-theme
```
3. Activate via WP Admin → Appearance → Themes

**Local test environment:**
- Path: `/Users/lan/Local Sites/alan-projects/app/public`
- WP version: 6.9.4, PHP: 8.5.4
- Edit in repo → symlink reflects changes immediately → test in browser

## Production

1. Zip the theme directory:
```bash
zip -r wp-starter-theme.zip wp-starter-theme/ --exclude "*.git*" --exclude "node_modules/*" --exclude "tests/*"
```
2. Upload via WP Admin → Appearance → Themes → Add New → Upload Theme

Or deploy via WP-CLI:
```bash
wp theme install wp-starter-theme.zip --activate
```

## Building Assets

```bash
pnpm install           # Install JS dependencies
pnpm build             # Build TS assets (navigation.ts, customizer-preview.ts)
pnpm dev               # Watch mode for development
```

## Requirements

- WordPress 6.8+
- PHP 8.3+
- wp-starter-plugin (companion plugin) activated

## CI/CD

GitHub Actions builds and lints on every push to main. See `.github/workflows/ci.yml`.
