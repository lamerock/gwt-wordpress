<?php
/**
 * Registers GovPH blocks and migrates legacy widget instances.
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

/**
 * Registers the GovPH editor scripts and dynamic blocks.
 */
function govph_register_blocks() {
	$version = wp_get_theme()->get( 'Version' );

	wp_register_script(
		'govph-pst-block-editor',
		get_template_directory_uri() . '/blocks/pst/editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-i18n' ),
		$version,
		true
	);
	wp_register_script(
		'govph-transparency-block-editor',
		get_template_directory_uri() . '/blocks/transparency-seal/editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
		$version,
		true
	);

	wp_localize_script(
		'govph-transparency-block-editor',
		'govphTransparencyBlock',
		array(
			'imageUrl' => get_template_directory_uri() . '/images/transparency-seal-160x160.png',
		)
	);

	register_block_type(
		get_template_directory() . '/blocks/pst',
		array( 'render_callback' => 'govph_render_pst_block' )
	);
	register_block_type(
		get_template_directory() . '/blocks/transparency-seal',
		array( 'render_callback' => 'govph_render_transparency_block' )
	);
}
add_action( 'init', 'govph_register_blocks' );

/**
 * Renders the Philippine Standard Time block.
 *
 * @return string Block markup.
 */
function govph_render_pst_block() {
	return sprintf(
		'<div %1$s><div>%2$s</div><div id="pst-time"></div></div>',
		wp_kses_data(
			get_block_wrapper_attributes(
				array(
					'class' => 'pst_widget',
					'id'    => 'pst-container',
				)
			)
		),
		esc_html__( 'Philippine Standard Time:', 'gwt_wp' )
	);
}

/**
 * Renders the Transparency Seal block.
 *
 * @param array $attributes Block attributes.
 * @return string Block markup.
 */
function govph_render_transparency_block( $attributes ) {
	$url = isset( $attributes['url'] ) ? esc_url( $attributes['url'] ) : '';

	if ( '' === $url ) {
		return '';
	}

	return sprintf(
		'<div %1$s><a href="%2$s"><img id="tp-seal" src="%3$s" alt="%4$s" title="%5$s" /></a></div>',
		wp_kses_data( get_block_wrapper_attributes( array( 'class' => 'transparency_widget' ) ) ),
		$url,
		esc_url( get_template_directory_uri() . '/images/transparency-seal-160x160.png' ),
		esc_attr__( 'Transparency Seal logo', 'gwt_wp' ),
		esc_attr__( 'Transparency Seal', 'gwt_wp' )
	);
}

/**
 * Converts placed legacy GovPH widgets into their block equivalents.
 */
function govph_migrate_legacy_widgets_to_blocks() {
	if ( get_option( 'gwt_govph_blocks_migrated' ) ) {
		return;
	}

	$sidebars_widgets = get_option( 'sidebars_widgets', array() );
	if ( ! is_array( $sidebars_widgets ) ) {
		return;
	}

	$widget_blocks = get_option( 'widget_block', array() );
	if ( ! is_array( $widget_blocks ) ) {
		$widget_blocks = array();
	}

	$next_block_number = 1;
	foreach ( array_keys( $widget_blocks ) as $block_id ) {
		if ( preg_match( '/^block-(\d+)$/', (string) $block_id, $matches ) ) {
			$next_block_number = max( $next_block_number, (int) $matches[1] + 1 );
		}
	}

	$legacy_instances = array(
		'pst'          => get_option( 'widget_govph_widget_pst', array() ),
		'transparency' => get_option( 'widget_govph_widget_transparency', array() ),
	);

	foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {
		if ( ! is_array( $widget_ids ) ) {
			continue;
		}

		foreach ( $widget_ids as $index => $widget_id ) {
			if ( ! preg_match( '/^govph_widget_(pst|transparency)-(\d+)$/', (string) $widget_id, $matches ) ) {
				continue;
			}

			$widget_type = $matches[1];
			$instance_id = (int) $matches[2];
			$instance    = isset( $legacy_instances[ $widget_type ][ $instance_id ] ) && is_array( $legacy_instances[ $widget_type ][ $instance_id ] )
				? $legacy_instances[ $widget_type ][ $instance_id ]
				: array();
			$attributes  = array();

			if ( 'transparency' === $widget_type && isset( $instance['url'] ) ) {
				$attributes['url'] = esc_url_raw( $instance['url'] );
			}

			$block_name = 'pst' === $widget_type ? 'gwt/pst' : 'gwt/transparency-seal';
			$block      = array(
				'blockName'    => $block_name,
				'attrs'        => $attributes,
				'innerBlocks'  => array(),
				'innerHTML'    => '',
				'innerContent' => array(),
			);
			$new_id     = 'block-' . $next_block_number;
			++$next_block_number;

			$widget_blocks[ $new_id ]                  = array( 'content' => serialize_block( $block ) );
			$sidebars_widgets[ $sidebar_id ][ $index ] = $new_id;
		}
	}

	update_option( 'widget_block', $widget_blocks );
	update_option( 'sidebars_widgets', $sidebars_widgets );
	update_option( 'gwt_govph_blocks_migrated', 1 );
}
add_action( 'init', 'govph_migrate_legacy_widgets_to_blocks', 20 );
