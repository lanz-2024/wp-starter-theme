<?php
/**
 * Block pattern category registration.
 *
 * @package WPStarterTheme\Providers
 */

declare(strict_types=1);

namespace WPStarterTheme\Providers;

/**
 * Registers the theme's custom block pattern categories.
 *
 * Individual patterns are auto-discovered by WordPress from the /patterns/
 * directory via the PHP file headers — no manual registration required in WP 6.0+.
 * This provider handles only the custom categories those patterns reference.
 */
class PatternProvider {

    /**
     * Wire up WordPress hooks.
     */
    public function register(): void {
        add_action( 'init', [ $this, 'register_pattern_categories' ] );
    }

    /**
     * Declare custom pattern categories used by this theme.
     */
    public function register_pattern_categories(): void {
        $categories = [
            'wp-starter-theme' => [
                'label' => __( 'WP Starter Theme', 'wp-starter-theme' ),
            ],
            'banner' => [
                'label' => __( 'Banners', 'wp-starter-theme' ),
            ],
            'call-to-action' => [
                'label' => __( 'Call to Action', 'wp-starter-theme' ),
            ],
            'testimonials' => [
                'label' => __( 'Testimonials', 'wp-starter-theme' ),
            ],
            'portfolio' => [
                'label' => __( 'Portfolio', 'wp-starter-theme' ),
            ],
        ];

        foreach ( $categories as $slug => $args ) {
            register_block_pattern_category( $slug, $args );
        }
    }
}
