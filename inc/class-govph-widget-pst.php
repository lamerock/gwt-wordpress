<?php
/**
 * Philippine Standard Time widget.
 *
 * @package GWT
 */

/**
 * Displays the Philippine Standard Time widget.
 */
class Govph_Widget_Pst extends WP_Widget {
	/**
	 * Sets up the widget.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'pst_widget',
			'description' => 'A widget for Philippine Standard Time.',
		);
		parent::__construct( 'govph_widget_pst', 'Philippine Standard Time', $widget_ops );
	}

	/**
	 * Outputs the widget content.
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Saved widget settings.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		echo '<div id="pst-container">
				<div>Philippine Standard Time:</div>
				<div id="pst-time"></div>
			</div>';
		echo wp_kses_post( $args['after_widget'] );
	}
}
