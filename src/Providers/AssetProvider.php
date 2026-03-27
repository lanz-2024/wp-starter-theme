<?php
/**
 * Asset enqueueing and editor styles.
 *
 * @package WPStarterTheme\Providers
 */

declare(strict_types=1);

namespace WPStarterTheme\Providers;

/**
 * Enqueues front-end and editor assets.
 *
 * Philosophy:
 * - No jQuery dependency — modern vanilla JS only.
 * - Assets versioned by filemtime to bust caches reliably.
 * - Editor CSS loaded only inside the block editor via add_editor_style().
 */
class AssetProvider {

	/**
	 * Absolute path to the theme directory.
	 *
	 * @var string
	 */
	private readonly string $theme_dir;

	/**
	 * URI to the theme directory.
	 *
	 * @var string
	 */
	private readonly string $theme_uri;

	/**
	 * Constructor — resolves theme paths.
	 */
	public function __construct() {
		$this->theme_dir = get_template_directory();
		$this->theme_uri = get_template_directory_uri();
	}

	/**
	 * Wire up WordPress hooks.
	 */
	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'add_editor_styles' ) );
	}

	/**
	 * Enqueue front-end JavaScript.
	 */
	public function enqueue_scripts(): void {
		$nav_file = $this->theme_dir . '/assets/js/dist/navigation.js';

		if ( file_exists( $nav_file ) ) {
			wp_enqueue_script(
				'wp-starter-theme-navigation',
				$this->theme_uri . '/assets/js/dist/navigation.js',
				array(),
				(string) filemtime( $nav_file ),
				true // Load in footer.
			);
		}

		// Customizer live-preview script — only loaded inside the Customizer preview.
		if ( is_customize_preview() ) {
			$preview_file = $this->theme_dir . '/assets/js/dist/customizer-preview.js';

			if ( file_exists( $preview_file ) ) {
				wp_enqueue_script(
					'wp-starter-theme-customizer-preview',
					$this->theme_uri . '/assets/js/dist/customizer-preview.js',
					array( 'customize-preview' ),
					(string) filemtime( $preview_file ),
					true
				);
			}
		}
	}

	/**
	 * Enqueue front-end stylesheets.
	 *
	 * Block themes handle most styling through theme.json; this only
	 * enqueues supplementary front-end CSS that cannot live in theme.json.
	 */
	public function enqueue_styles(): void {
		// The main style.css is the theme header file only — no rules live there.
		// Supplementary front-end styles go here if needed.
	}

	/**
	 * Register editor stylesheet so it mirrors the front-end.
	 */
	public function add_editor_styles(): void {
		$editor_css = 'assets/css/editor.css';

		if ( file_exists( $this->theme_dir . '/' . $editor_css ) ) {
			add_editor_style( $editor_css );
		}
	}

	/**
	 * Return the version string for an asset, derived from filemtime.
	 *
	 * Falls back to theme version when the file does not exist (e.g. pre-build).
	 *
	 * @param string $relative_path Path relative to theme root.
	 */
	public function asset_version( string $relative_path ): string {
		$absolute = $this->theme_dir . '/' . ltrim( $relative_path, '/' );

		if ( file_exists( $absolute ) ) {
			return (string) filemtime( $absolute );
		}

		$version = wp_get_theme()->get( 'Version' );
		return $version ? $version : '1.0.0';
	}
}
