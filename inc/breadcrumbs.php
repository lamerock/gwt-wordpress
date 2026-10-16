<?php
/**
 * Template for displaying breadcrumb navigation.
 *
 * @file
 * @package GWT
 */

?>

<nav id="breadcrumbs" class="anchor" aria-label="You are here:" role="navigation">
	<div class="row">
		<div class="large-12 columns">
			<?php
			if ( is_active_sidebar( 'breadcrumb-widget' ) ) {
				dynamic_sidebar( 'breadcrumb-widget' );
			} else {
				gwt_wp_breadcrumb();
			}
			?>
		</div>
	</div>
</nav>
