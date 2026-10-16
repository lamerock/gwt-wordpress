<?php
/**
 * Walker for the off-canvas navigation menu.
 *
 * @package GWT
 */

/**
 * Builds the off-canvas navigation menu markup.
 */
class Off_Canvass_Menu extends Walker_Nav_Menu {
	/**
	 * Starts a submenu level.
	 *
	 * @param string &$output The menu output buffer.
	 * @param int    $depth   The current menu depth.
	 * @param object $args    Menu rendering arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n\t\t\t\t\t" . $indent . "<ul class=\"vertical menu\">\n";
	}

	/**
	 * Ends a submenu level.
	 *
	 * @param string &$output The menu output buffer.
	 * @param int    $depth   The current menu depth.
	 * @param object $args    Menu rendering arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n\t\t\t\t\t" . $indent . "</ul>\n";
	}

	/**
	 * Starts a menu item.
	 *
	 * @param string  &$output The menu output buffer.
	 * @param WP_Post $item    The current menu item.
	 * @param int     $depth   The current menu depth.
	 * @param object  $args    Menu rendering arguments.
	 * @param int     $id      The current menu item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent      = $depth ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[]   = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$args    = (object) $args;
		$output .= $indent . "\t\t\t\t\t" . '<li' . $id . $class_names . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends a menu item.
	 *
	 * @param string  &$output The menu output buffer.
	 * @param WP_Post $item    The current menu item.
	 * @param int     $depth   The current menu depth.
	 * @param object  $args    Menu rendering arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent  = $depth ? str_repeat( "\t", $depth ) : '';
		$output .= $indent . "\t\t\t\t\t</li>\n";
	}
}
