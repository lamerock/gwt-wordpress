<?php
/**
 * Functions for disabling comments.
 *
 * @package GWT
 */

/**
 * Removes comment and trackback support from post types.
 */
function gwt_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'gwt_disable_comments_post_types_support' );

/**
 * Prevents comments and pings from opening.
 *
 * @return bool Whether comments can be opened.
 */
function gwt_disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'gwt_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'gwt_disable_comments_status', 20, 2 );

/**
 * Hides existing comments.
 *
 * @param array $comments Existing comments for the post.
 * @return array An empty comments list.
 */
function gwt_disable_comments_hide_existing_comments( $comments ) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'gwt_disable_comments_hide_existing_comments', 10, 2 );

/**
 * Removes the comments admin menu.
 */
function gwt_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'gwt_disable_comments_admin_menu' );

/**
 * Redirects users away from the comments admin page.
 */
function gwt_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ( 'edit-comments.php' === $pagenow ) {
		wp_safe_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'gwt_disable_comments_admin_menu_redirect' );

/**
 * Removes the comments metabox from the dashboard.
 */
function gwt_disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'gwt_disable_comments_dashboard' );

/**
 * Removes the comments link from the admin bar.
 */
function gwt_disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}
add_action( 'init', 'gwt_disable_comments_admin_bar' );
