<?php
/*
Plugin Name: Envato FlexSlider
Plugin URI:
Description: A simple plugin that integrates FlexSlider (http://flex.madebymufffin.com/) with WordPress using custom post types!
Author: Joe Casabona
Version: 0.5
Author URI: http://www.casabona.org
*/

/*Some Set-up*/
define( 'EFS_PATH', get_template_directory_uri() . '/inc/vendors/' . basename( __DIR__ ) . '/' );
define( 'EFS_NAME', 'Envato FlexSlider' );
define( 'EFS_VERSION', '0.5' );

/*Files to Include*/
require_once 'slider-img-type.php';

function efs_get_slider() {
	$efs_query = 'post_type=slider-image';
	query_posts( $efs_query );

	$slider = '';
	$count  = 0;

	if ( have_posts() ) :

		$slider = '<div class="orbit" role="region" aria-label="Banner Slider" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out">
					<div class="orbit-wrapper">';

		$count = 0;
		$x     = 1;
		while ( have_posts() ) :
			the_post();
			++$count;
		endwhile;

		if ( $count > 1 ) {
			$slider .= '<div class="orbit-controls">
						<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
						<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
					</div>';
		}
		$slider .= '<ul class="orbit-container">';

		while ( have_posts() ) :
			the_post();
			// Lazy images in a zero-height container never load, so Orbit never sizes it.
			$img = get_the_post_thumbnail(
				get_the_ID(),
				'full',
				array(
					'class'   => 'orbit-image',
					'loading' => 'eager',
				)
			);

			$slide_link = slider_link_get_meta_box_data( get_the_ID() );
			$caption    = get_the_title();
			$active     = ( 1 === $x ) ? ' is-active' : '';

			$slider .= '<li class="orbit-slide' . $active . '"><div class="orbit-slide-number"><span>' . $x . '</span> of <span>' . $count . '</span></div><a href="' . $slide_link . '">' . $img . '</a><figcaption class="orbit-caption">' . $caption . '</figcaption></li>';
			++$x;
		endwhile;
	endif;
	wp_reset_query();

	if ( $count > 1 ) {
		$slider .= '</ul></div>
		<nav class="orbit-bullets">';

		for ( $x = 0; $x < $count; $x++ ) {
			$class   = ( 0 === $x ) ? 'is-active' : '';
			$slider .= '<button class="' . $class . '" data-slide="' . $x . '"><span class="show-for-sr">Current Slide</span></button>';
		}

		$slider .= '</nav></div>';
	} elseif ( $count > 0 ) {
		$slider .= '</ul></div></div>';
	}

	return $slider;
}

/**add the shortcode for the slider- for use in editor**/
function efs_insert_slider( $atts, $content = null ) {
	$slider = efs_get_slider();
	return $slider;
}
add_shortcode( 'ef_slider', 'efs_insert_slider' );

/**add template tag- for use in themes**/
function efs_slider() {
	print efs_get_slider();
}
