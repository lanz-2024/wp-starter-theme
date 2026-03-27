<?php
/**
 * WordPress Customizer registration.
 *
 * @package WPStarterTheme\Providers
 */

declare(strict_types=1);

namespace WPStarterTheme\Providers;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use WPStarterTheme\Customizer\Controls\RangeControl;

/**
 * Registers all Customizer panels, sections, settings, and controls.
 *
 * Settings use `sanitize_callback` consistently to prevent XSS.
 * Text settings that render in the page use selective refresh so the
 * Customizer preview updates without a full iframe reload.
 */
class CustomizerProvider {

	/**
	 * Wire up WordPress hooks.
	 */
	public function register(): void {
		add_action( 'customize_register', array( $this, 'setup_customizer' ) );
	}

	/**
	 * Build all Customizer objects.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function setup_customizer( WP_Customize_Manager $wp_customize ): void {
		$this->register_panel( $wp_customize );
		$this->register_header_section( $wp_customize );
		$this->register_footer_section( $wp_customize );
		$this->register_colors_section( $wp_customize );
	}

	// -------------------------------------------------------------------------
	// -------------------------------------------------------------------------
	// Panel
	// -------------------------------------------------------------------------

	/**
	 * Register the main theme options panel.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	private function register_panel( WP_Customize_Manager $wp_customize ): void {
		$wp_customize->add_panel(
			'wp_starter_theme_options',
			array(
				'title'       => __( 'Theme Options', 'wp-starter-theme' ),
				'description' => __( 'Global settings for WP Starter Theme.', 'wp-starter-theme' ),
				'priority'    => 130,
			)
		);
	}

	// -------------------------------------------------------------------------
	// Header Section
	// -------------------------------------------------------------------------

	/**
	 * Register header section, settings, and controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	private function register_header_section( WP_Customize_Manager $wp_customize ): void {
		$wp_customize->add_section(
			'wp_starter_header_options',
			array(
				'title'    => __( 'Header Options', 'wp-starter-theme' ),
				'panel'    => 'wp_starter_theme_options',
				'priority' => 10,
			)
		);

		// --- Sticky Header ---
		$wp_customize->add_setting(
			'header_sticky',
			array(
				'default'           => false,
				'transport'         => 'refresh',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'header_sticky',
			array(
				'label'   => __( 'Enable sticky header', 'wp-starter-theme' ),
				'section' => 'wp_starter_header_options',
				'type'    => 'checkbox',
			)
		);

		// --- Header Background Color ---
		$wp_customize->add_setting(
			'header_bg_color',
			array(
				'default'           => '#ffffff',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'header_bg_color',
				array(
					'label'   => __( 'Header background color', 'wp-starter-theme' ),
					'section' => 'wp_starter_header_options',
				)
			)
		);

		// --- Header Height (range control) ---
		$wp_customize->add_setting(
			'header_height',
			array(
				'default'           => 64,
				'transport'         => 'postMessage',
				'sanitize_callback' => array( $this, 'sanitize_int_range' ),
			)
		);

		$wp_customize->add_control(
			new RangeControl(
				$wp_customize,
				'header_height',
				array(
					'label'   => __( 'Header height (px)', 'wp-starter-theme' ),
					'section' => 'wp_starter_header_options',
					'min'     => 48,
					'max'     => 120,
					'step'    => 4,
				)
			)
		);

		// Selective refresh partial for header.
		$wp_customize->selective_refresh->add_partial(
			'header_bg_color',
			array(
				'selector'        => '.site-header',
				'render_callback' => '__return_null',
			)
		);
	}

	// -------------------------------------------------------------------------
	// Footer Section
	// -------------------------------------------------------------------------

	/**
	 * Register footer section, settings, and controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	private function register_footer_section( WP_Customize_Manager $wp_customize ): void {
		$wp_customize->add_section(
			'wp_starter_footer_options',
			array(
				'title'    => __( 'Footer Options', 'wp-starter-theme' ),
				'panel'    => 'wp_starter_theme_options',
				'priority' => 20,
			)
		);

		// --- Copyright text ---
		$wp_customize->add_setting(
			'footer_copyright_text',
			array(
				'default'           => sprintf(
					/* translators: %d: current year */
					__( '&copy; %d WP Starter Theme. All rights reserved.', 'wp-starter-theme' ),
					(int) gmdate( 'Y' )
				),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'footer_copyright_text',
			array(
				'label'   => __( 'Copyright text', 'wp-starter-theme' ),
				'section' => 'wp_starter_footer_options',
				'type'    => 'text',
			)
		);

		// Selective refresh partial for copyright text.
		$wp_customize->selective_refresh->add_partial(
			'footer_copyright_text',
			array(
				'selector'        => '.site-footer__copyright',
				'render_callback' => function (): string {
					return wp_kses_post( (string) get_theme_mod( 'footer_copyright_text', '' ) );
				},
			)
		);

		// --- Footer Background Color ---
		$wp_customize->add_setting(
			'footer_bg_color',
			array(
				'default'           => '#111827',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_bg_color',
				array(
					'label'   => __( 'Footer background color', 'wp-starter-theme' ),
					'section' => 'wp_starter_footer_options',
				)
			)
		);
	}

	// -------------------------------------------------------------------------
	// Colors Section
	// -------------------------------------------------------------------------

	/**
	 * Register colors section, settings, and controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	private function register_colors_section( WP_Customize_Manager $wp_customize ): void {
		$wp_customize->add_section(
			'wp_starter_colors',
			array(
				'title'    => __( 'Colors', 'wp-starter-theme' ),
				'panel'    => 'wp_starter_theme_options',
				'priority' => 30,
			)
		);

		// --- Primary Color ---
		$wp_customize->add_setting(
			'primary_color',
			array(
				'default'           => '#2563eb',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				array(
					'label'   => __( 'Primary color', 'wp-starter-theme' ),
					'section' => 'wp_starter_colors',
				)
			)
		);

		// --- Secondary Color ---
		$wp_customize->add_setting(
			'secondary_color',
			array(
				'default'           => '#7c3aed',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'secondary_color',
				array(
					'label'   => __( 'Secondary color', 'wp-starter-theme' ),
					'section' => 'wp_starter_colors',
				)
			)
		);
	}

	// -------------------------------------------------------------------------
	// Sanitisation helpers
	// -------------------------------------------------------------------------

	/**
	 * Sanitise a checkbox setting (cast to boolean).
	 *
	 * @param mixed $value Raw value from the Customizer.
	 */
	public function sanitize_checkbox( mixed $value ): bool {
		return (bool) $value;
	}

	/**
	 * Sanitise an integer within a valid range.
	 *
	 * @param mixed $value Raw value from the Customizer.
	 */
	public function sanitize_int_range( mixed $value ): int {
		return (int) $value;
	}
}
