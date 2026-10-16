<?php
/**
 * File containing GovPH widget registration functions.
 *
 * @file
 * @package GWT
 * @since Government Website Template 2.0
 */

/**
 * Registers the Philippine Standard Time widget.
 */
function pst_register_widgets() {
	register_widget( 'Govph_Widget_Pst' );
}

/**
 * Registers the Transparency Seal widget.
 */
function transparency_register_widgets() {
	register_widget( 'Govph_Widget_Transparency' );
}

require_once get_template_directory() . '/inc/class-govph-widget-pst.php';
require_once get_template_directory() . '/inc/class-govph-widget-transparency.php';

add_action( 'widgets_init', 'transparency_register_widgets' );
add_action( 'widgets_init', 'pst_register_widgets' );
