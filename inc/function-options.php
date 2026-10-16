<?php
/**
 * Loads GWT theme options support.
 *
 * @package GWT
 */

/**
 * Loads the options class and its WordPress callbacks.
 */
function govph_load_options_support() {
	require_once get_template_directory() . '/inc/class-govph.php';
}

govph_load_options_support();
