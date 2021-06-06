<?php

// remove the WordPress number manually from the generator meta tag
remove_action('wp_head', 'wp_generator');

// remove version from rss feed
add_filter('the_generator', '__return_empty_string');


/* 
*  Remove WP version number
*/

function remove_version_info() {
	return '';
}

add_filter('the_generator', 'remove_version_info');

/**
 *  Remove version number from scripts and styles
 */

function remove_version_css_js($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}

add_filter('style_loader_src', 'remove_version_css_js', 9999);
add_filter('script_loader_src', 'remove_version_css_js', 9999);
