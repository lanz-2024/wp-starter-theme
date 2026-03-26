<?php
/**
 * Custom navigation walker with mega-menu support.
 *
 * @package WPStarterTheme\Walkers
 */

declare(strict_types=1);

namespace WPStarterTheme\Walkers;

use Walker_Nav_Menu;

/**
 * Extends Walker_Nav_Menu to produce mega-menu markup.
 *
 * Behaviour:
 * - Top-level items with children receive aria-expanded + aria-controls.
 * - Second-level dropdowns render as standard submenus.
 * - Third-level items are detected and wrapped in a mega-menu column div,
 *   turning the second-level item into a mega-menu trigger.
 *
 * Usage:
 *   wp_nav_menu([
 *       'theme_location' => 'primary',
 *       'walker'         => new \WPStarterTheme\Walkers\MegaMenuWalker(),
 *   ]);
 */
class MegaMenuWalker extends Walker_Nav_Menu {

    /**
     * Track whether the current submenu has grandchildren (mega-menu trigger).
     */
    private bool $is_mega = false;

    /**
     * {@inheritdoc}
     *
     * Adds aria attributes to top-level items that have children.
     *
     * @param string    $output  Passed by reference. Used to append additional content.
     * @param \WP_Post  $item    Menu item data object.
     * @param int       $depth   Depth of menu item.
     * @param \stdClass $args    An object of wp_nav_menu() arguments.
     * @param int       $id      Current item/element ID.
     */
    public function start_el( // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
        &$output,
        $item,
        $depth = 0,
        $args = null,
        $id = 0,
    ): void {
        $indent = str_repeat( "\t", $depth );

        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Detect items with children for ARIA state management.
        $has_children = in_array( 'menu-item-has-children', $classes, true );

        if ( $depth === 0 && $has_children ) {
            $classes[] = 'has-dropdown';
        }

        $class_names = implode( ' ', array_filter( array_map( 'esc_attr', $classes ) ) );
        $class_names = $class_names ? ' class="' . $class_names . '"' : '';

        $id_attr = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id_attr = $id_attr ? ' id="' . esc_attr( $id_attr ) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        $atts = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';

        if ( $depth === 0 && $has_children ) {
            $dropdown_id             = 'dropdown-' . $item->ID;
            $atts['aria-expanded']   = 'false';
            $atts['aria-controls']   = $dropdown_id;
            $atts['aria-haspopup']   = 'true';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title      = apply_filters( 'the_title', $item->title, $item->ID );
        $title      = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );

        // Add chevron icon for items with children.
        if ( $depth < 2 && $has_children ) {
            $item_output .= ' <svg class="dropdown-chevron" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="6 9 12 15 18 9"/></svg>';
        }

        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * {@inheritdoc}
     *
     * Opens a submenu. At depth 1, checks for grandchildren to decide
     * whether to render a standard dropdown or a mega-menu panel.
     *
     * @param string    $output Passed by reference.
     * @param int       $depth  Depth of list item.
     * @param \stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ): void {
        $indent = str_repeat( "\t", $depth );

        if ( $depth === 0 ) {
            $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\" role=\"menu\">\n";
        } elseif ( $depth === 1 ) {
            $this->is_mega = true;
            $output       .= "\n$indent<ul class=\"sub-menu mega-menu__column\" role=\"menu\">\n";
        } else {
            $output .= "\n$indent<ul class=\"sub-menu\" role=\"menu\">\n";
        }
    }

    /**
     * {@inheritdoc}
     *
     * Closes the submenu; wraps mega-menu panels in an outer container div.
     *
     * @param string    $output Passed by reference.
     * @param int       $depth  Depth of list item.
     * @param \stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ): void {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";

        if ( $depth === 0 && $this->is_mega ) {
            $output       .= "$indent</div><!-- .mega-menu -->\n";
            $this->is_mega = false;
        }
    }
}
