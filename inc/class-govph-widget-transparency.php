<?php
/**
 * Transparency Seal widget.
 *
 * @package GWT
 */

/**
 * Displays and configures the Transparency Seal widget.
 */
class Govph_Widget_Transparency extends WP_Widget {
	/**
	 * Sets up the widget.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'transparency_widget',
			'description' => 'A widget for Transparency Seal logo.',
		);
		parent::__construct( 'govph_widget_transparency', 'Transparency Seal', $widget_ops );
	}

	/**
	 * Outputs the widget content.
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Saved widget settings.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['url'] ) ) {
			$image_url = get_template_directory_uri() . '/images/transparency-seal-160x160.png';
			echo '<a href="' . esc_url( $instance['url'] ) . '"><img id="tp-seal" src="' . esc_url( $image_url ) . '" alt="Transparency Seal logo" title="Transparency Seal"></a>';
		}
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Sanitizes and saves widget settings.
	 *
	 * @param array $new_instance Submitted widget settings.
	 * @param array $old_instance Previously saved widget settings.
	 * @return array Sanitized widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance        = array();
		$instance['url'] = ! empty( $new_instance['url'] ) ? esc_url_raw( $new_instance['url'] ) : 'http://domain.gov.ph/transparency';

		return $instance;
	}

	/**
	 * Outputs the widget settings form.
	 *
	 * @param array $instance Previously saved widget settings.
	 */
	public function form( $instance ) {
		$url       = ! empty( $instance['url'] ) ? $instance['url'] : 'http://domain.gov.ph/transparency';
		$image_url = get_template_directory_uri() . '/images/transparency-seal-160x160.png';
		?>
		<p style="text-align:center;"><img id="tp-seal" src="<?php echo esc_url( $image_url ); ?>" alt="Transparency Seal logo" title="Transparency Seal" /></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'URL:', 'gwt_wp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
			<span class="description"><em><?php esc_html_e( 'Insert the URL of the transparency page.', 'gwt_wp' ); ?></em></span>
		</p>
		<?php
	}
}
