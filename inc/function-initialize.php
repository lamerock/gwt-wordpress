<?php
/**
 * Initializes theme setup and content width.
 *
 * @package GWT
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
if ( ! function_exists( 'gwt_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function gwt_wp_setup() {
		require_once get_template_directory() . '/inc/class-off-canvass-menu.php';
		require_once get_template_directory() . '/inc/class-topbar-nav-menu.php';

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on gwt_wp, use a find and replace
		 * to change 'gwt_wp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'gwt_wp', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		// Theme title-tag support is intentionally disabled.

		/*
		 * Enable support for custom logo.
		 *
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Make content links clickable.
		apply_filters( 'the_content', 'make_clickable' );

		add_editor_style();
	}
endif; // gwt_wp_setup.
add_action( 'after_setup_theme', 'gwt_wp_setup' );
