<?php
/**
 * Footer Section configuration helper.
 *
 * @package WPStarterTheme\Customizer\Sections
 */

declare(strict_types=1);

namespace WPStarterTheme\Customizer\Sections;

/**
 * Provides default arguments and setting definitions for the Footer section.
 *
 * This is a value-object helper — it does not register anything directly.
 * CustomizerProvider reads the configuration arrays it returns.
 */
class FooterSection {

    /**
     * Section registration arguments for WP_Customize_Manager::add_section().
     *
     * @return array<string, mixed>
     */
    public static function section_args(): array {
        return [
            'title'       => __( 'Footer Options', 'wp-starter-theme' ),
            'description' => __( 'Customise the site footer appearance and copyright text.', 'wp-starter-theme' ),
            'panel'       => 'wp_starter_theme_options',
            'priority'    => 20,
        ];
    }

    /**
     * Setting definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function settings(): array {
        return [
            'footer_copyright_text' => [
                'default'           => sprintf(
                    /* translators: %d: current year */
                    __( '&copy; %d WP Starter Theme. All rights reserved.', 'wp-starter-theme' ),
                    (int) gmdate( 'Y' )
                ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post',
            ],
            'footer_bg_color' => [
                'default'           => '#111827',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ],
        ];
    }
}
