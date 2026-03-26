<?php
/**
 * Navigation menu registration and customisation.
 *
 * @package WPStarterTheme\Providers
 */

declare(strict_types=1);

namespace WPStarterTheme\Providers;

/**
 * Registers nav menu locations and injects UI chrome (search icon) into menus.
 */
class MenuProvider {

    /**
     * Wire up WordPress hooks.
     */
    public function register(): void {
        add_action( 'after_setup_theme',     [ $this, 'register_menus' ] );
        add_filter( 'wp_nav_menu_items',     [ $this, 'add_search_to_primary_menu' ], 10, 2 );
    }

    /**
     * Declare the theme's navigation menu locations.
     */
    public function register_menus(): void {
        register_nav_menus( [
            'primary' => __( 'Primary Navigation', 'wp-starter-theme' ),
            'footer'  => __( 'Footer Navigation', 'wp-starter-theme' ),
            'mobile'  => __( 'Mobile Navigation', 'wp-starter-theme' ),
        ] );
    }

    /**
     * Append an accessible search toggle to the primary menu.
     *
     * @param string    $items HTML list items.
     * @param \stdClass $args  wp_nav_menu() arguments.
     *
     * @return string Modified menu HTML.
     */
    public function add_search_to_primary_menu( string $items, \stdClass $args ): string {
        if ( ( $args->theme_location ?? '' ) !== 'primary' ) {
            return $items;
        }

        $search_icon = sprintf(
            '<li class="menu-item menu-item--search">
                <button
                    class="site-search-toggle"
                    aria-label="%s"
                    aria-expanded="false"
                    aria-controls="site-search"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <span class="screen-reader-text">%s</span>
                </button>
            </li>',
            esc_attr__( 'Toggle search', 'wp-starter-theme' ),
            esc_html__( 'Search', 'wp-starter-theme' )
        );

        return $items . $search_icon;
    }
}
