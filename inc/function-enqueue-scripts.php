<?php
/**
 * Theme asset enqueue routines.
 *
 * @package GWT
 */

/**
 * Enqueues theme scripts and styles.
 */
function gwt_wp_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue styles.
	wp_enqueue_style( 'gwt_wp-foundation', get_template_directory_uri() . '/foundation/css/foundation.min.css', array(), '6.9.0' );
	wp_enqueue_style( 'gwt_wp-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	wp_enqueue_style( 'gwt_wp-style', get_template_directory_uri() . '/theme.css', array(), $theme_version );
	wp_enqueue_style( 'gwt_wp-user-style', get_stylesheet_uri(), array(), $theme_version );

	// Enqueue scripts.
	wp_enqueue_script( 'gwt_wp-what-input', get_template_directory_uri() . '/foundation/js/vendor/what-input.min.js', array(), '5.2.12', true );
	wp_enqueue_script( 'gwt_wp-foundation', get_template_directory_uri() . '/foundation/js/vendor/foundation.min.js', array( 'jquery', 'gwt_wp-what-input' ), '6.9.0', true );
	wp_enqueue_script( 'gwt_wp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'gwt_wp-theme-js', get_template_directory_uri() . '/js/theme.js', array( 'jquery', 'gwt_wp-foundation' ), $theme_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'gwt_wp-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'gwt_wp_scripts' );
