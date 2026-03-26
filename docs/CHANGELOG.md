# Changelog

## [0.1.0] - 2026-03-27

### Added
- Full Site Editing (FSE) theme with theme.json v3 configuration
- Block templates: index, single, archive, page, 404, search, single-portfolio
- Template parts: header, footer, sidebar, comments
- Block patterns: hero-banner, call-to-action, testimonials-grid, portfolio-showcase
- Style variations: dark, minimal
- theme.json v3: typography presets (fluid type), color palette, spacing scale, custom templates
- PSR-4 autoloader under `WPStarterTheme\` namespace
- Modular service providers: AssetProvider, MenuProvider, CustomizerProvider, PatternProvider, SupportProvider
- Custom Mega-Menu Walker (`MegaMenuWalker.php`)
- Full Theme Customizer: panels, sections, controls, selective refresh
- Custom Customizer controls: RangeControl
- `add_theme_support()`: wide alignment, responsive embeds, post thumbnails, custom image sizes
- TypeScript assets: navigation.ts, customizer-preview.ts
- PHPCS WordPress-Extra standard
- PHPStan level 8 with WordPress stubs
- GitHub Actions CI: PHPCS → PHPStan → Vitest (block JS) → build
- docs/: ARCHITECTURE.md, TESTING.md, CUSTOMIZER.md, DEPLOYMENT.md, SECURITY.md, CHANGELOG.md

### Requires
- WordPress 6.8+, PHP 8.3+, wp-starter-plugin
