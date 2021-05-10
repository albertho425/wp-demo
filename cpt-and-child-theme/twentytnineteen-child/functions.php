<?php

/* child style */
function childtheme_enqueue_styles() {


// enqueue parent styles
wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');
	
// enqueue child styles
wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/style.css', array('parent-theme'));



}
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles', 999 );
?>
