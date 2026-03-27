<?php
/**
 * Header Section configuration helper.
 *
 * @package WPStarterTheme\Customizer\Sections
 */

declare(strict_types=1);

namespace WPStarterTheme\Customizer\Sections;

/**
 * Provides default arguments and setting definitions for the Header section.
 *
 * This is a value-object helper — it does not register anything directly.
 * CustomizerProvider reads the configuration arrays it returns.
 */
class HeaderSection {

	/**
	 * Section registration arguments for WP_Customize_Manager::add_section().
	 *
	 * @return array<string, mixed>
	 */
	public static function section_args(): array {
		return array(
			'title'       => __( 'Header Options', 'wp-starter-theme' ),
			'description' => __( 'Customise the site header appearance and behaviour.', 'wp-starter-theme' ),
			'panel'       => 'wp_starter_theme_options',
			'priority'    => 10,
		);
	}

	/**
	 * Setting definitions.
	 *
	 * Returns an associative array keyed by setting ID, each containing
	 * 'default', 'transport', and 'sanitize_callback' keys.
	 *
	 * @return array<string, array<string, mixed>>
	 */
	public static function settings(): array {
		return array(
			'header_sticky'   => array(
				'default'           => false,
				'transport'         => 'refresh',
				'sanitize_callback' => 'rest_sanitize_boolean',
			),
			'header_bg_color' => array(
				'default'           => '#ffffff',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			),
			'header_height'   => array(
				'default'           => 64,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			),
		);
	}
}
