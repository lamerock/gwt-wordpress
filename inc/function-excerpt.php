<?php
/**
 * GovPH excerpt customization.
 *
 * @package govph
 */

/**
 * Replaces the excerpt "more" text with a link.
 *
 * @param string $more The default excerpt continuation text.
 * @return string The excerpt continuation link.
 */
function new_excerpt_more( $more ) {
	unset( $more );
	global $post;
	return '<a class="moretag" href="' . get_permalink( $post->ID ) . '"> continue reading : ' . get_the_title( $post->ID ) . ' </a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
