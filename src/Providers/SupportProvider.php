<?php
/**
 * Theme support & image sizes registration.
 *
 * @package WPStarterTheme\Providers
 */

declare(strict_types=1);

namespace WPStarterTheme\Providers;

/**
 * Registers all add_theme_support() declarations and custom image sizes.
 */
class SupportProvider {

	/**
	 * Wire up WordPress hooks.
	 */
	public function register(): void {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );
	}

	/**
	 * Declare theme support flags.
	 */
	public function setup(): void {
		// Core content width hint (pixels).
		$GLOBALS['content_width'] = 720;

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 200,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}

	/**
	 * Register custom image sizes for the theme.
	 */
	public function add_image_sizes(): void {
		add_image_size( 'portfolio-card', 640, 480, true );
		add_image_size( 'portfolio-hero', 1920, 600, true );
		add_image_size( 'blog-card', 800, 500, true );
	}
}
