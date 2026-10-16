<?php
/**
 * Walker for the top-bar navigation menu.
 *
 * @package GWT
 */

/**
 * Builds the top-bar navigation menu markup.
 */
class Topbar_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Starts a submenu level.
	 *
	 * @param string &$output The menu output buffer.
	 * @param int    $depth   The current menu depth.
	 * @param object $args    Menu rendering arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown vertical menu\">\n";
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
		$output .= "$indent</ul>\n";
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

		$mega_menu_id = apply_filters( 'the_title', $item->title, $item->ID );
		$mega_menu_id = strtolower( $mega_menu_id );
		$mega_menu_id = sanitize_html_class( str_replace( ' ', '_', $mega_menu_id ) );

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		if ( false !== strpos( $class_names, 'has-megamenu' ) ) {
			$id = ' id="' . esc_attr( $mega_menu_id . '-menu' ) . '"';
		}

		$args    = (object) $args;
		$output .= $indent . '<li' . $id . $class_names . '>';

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
		$output .= "</li>\n";
	}

	/**
	 * Displays the menu item and its children.
	 *
	 * @param object $element           The current menu item.
	 * @param array  $children_elements The menu items with children.
	 * @param int    $max_depth         The maximum menu depth.
	 * @param int    $depth             The current menu depth.
	 * @param array  $args              Menu rendering arguments.
	 * @param string &$output           The menu output buffer.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-dropdown';
		}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
