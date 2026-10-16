<?php
/**
 * GWT breadcrumb functions.
 *
 * @package GWT
 */

/**
 * Displays breadcrumb navigation.
 *
 * @return bool Whether breadcrumb navigation was displayed.
 */
function gwt_wp_breadcrumb() {
	global $post;
	$option = wp_parse_args(
		get_option( 'govph_options', array() ),
		array(
			'govph_breadcrumbs_enable'    => '',
			'govph_breadcrumbs_separator' => '',
			'govph_breadcrumbs_show_home' => '',
		)
	);

	if ( 'true' !== $option['govph_breadcrumbs_enable'] ) {
		return false;
	}
	$separator       = $option['govph_breadcrumbs_separator'] ? esc_html( $option['govph_breadcrumbs_separator'] ) : ' / ';
	$separator_block = '<span class="separator">' . $separator . '</span>';

	if ( ! is_home() ) {
		echo '<ul class="breadcrumbs">';
		if ( 'true' === $option['govph_breadcrumbs_show_home'] ) {
			echo '<li>You are here:</li>';
			echo '<li><a class="pathway" href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo 'Home';
			echo '</a>' . wp_kses_post( $separator_block ) . '</li>';
		} else {
			echo '<li>You are here:</li>';
		}
	} elseif ( 'true' === $option['govph_breadcrumbs_show_home'] ) {
			echo '<ul class="breadcrumbs">';
			echo '<li>You are here:</li>';
			echo '<li><a class="pathway" href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo 'Home';
			echo '</a>' . wp_kses_post( $separator_block ) . '</li>';
	}

	if ( is_category() || is_single() ) {
		echo '<li>';
		if ( is_category() ) {
			single_cat_title();
		}

		if ( is_single() ) {
			the_category( '</li><li> ' );
			echo wp_kses_post( $separator_block ) . '<li>';
			the_title();
			echo '</li>';
		}
		echo '</li>';
	} elseif ( is_page() ) {
		if ( $post->post_parent ) {
			$anc   = get_post_ancestors( $post->ID );
			$title = get_the_title();
			foreach ( $anc as $ancestor ) {
				$output = '<li><a class="pathway" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>' . wp_kses_post( $separator_block ) . '</li>';
			}
			echo wp_kses_post( $output );
			echo '<li><span class="current show-for-sr">Current: </span>' . esc_html( get_the_title() ) . '</li>';
		} else {
			echo '<li><span class="current show-for-sr">Current: </span>' . esc_html( get_the_title() ) . '</li>';
		}
	}

	if ( is_archive() ) {
		if ( is_day() ) {
			echo '<li>';
			the_time( 'F jS, Y' );
			echo '</li>';
		} elseif ( is_month() ) {
			echo '<li>';
			the_time( 'F Y' );
			echo '</li>';
		} elseif ( is_year() ) {
			echo '<li>';
			the_time( 'Y' );
			echo '</li>';
		} elseif ( is_author() ) {
			echo '<li>Author Archive</li>';
		} elseif ( get_query_var( 'paged' ) ) {
			echo '<li>Blog Archives</li>';
		} elseif ( is_search() ) {
			echo '<li>Search Results</li>';
		}
	}
	echo '</ul>';

	return true;
}
