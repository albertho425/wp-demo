<?php // custom_admin - Core Functionality, Available to public and admin areas 


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 *  custom admin dashboard footer message 
 */

function custom_admin_custom_admin_footer( $message ) {
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
    
    // if there is a value and it's not empty
    if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {
        
        //sanitize and assign
		$message = sanitize_text_field( $options['custom_footer'] );
		
	}
	
	return $message;
	
}
add_filter( 'admin_footer_text', 'custom_admin_custom_admin_footer' );


/**
 *  Custom admin dashboard toolbar
 */

function custom_admin_custom_admin_toolbar() {
	
	$toolbar = false;
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
	if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {
		
		$toolbar = (bool) $options['custom_toolbar'];
		
	}
	
	if ( $toolbar ) {
		
		global $wp_admin_bar;
		
        // remove the WP Logo on the top left
        $wp_admin_bar->remove_node('wp-logo');
        
        //remove site-name and logo
        $wp_admin_bar->remove_node('site-name');

        // remove the number of updates
        $wp_admin_bar->remove_node('updates');

        // remove the comments icon and link from the top tool bar
        $wp_admin_bar->remove_node('comments');

	}
	
}
add_action( 'wp_before_admin_bar_render', 'custom_admin_custom_admin_toolbar', 999 );


/**
 *  Custom admin dashboard color scheme
 */

function custom_admin_custom_admin_scheme( $user_id ) {
	
	$scheme = 'default';
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
	if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {
		
		$scheme = sanitize_text_field( $options['custom_scheme'] );
		
	}
	
	$args = array( 'ID' => $user_id, 'admin_color' => $scheme );
	
	wp_update_user( $args );
	
}
add_action( 'user_register', 'custom_admin_custom_admin_scheme' );

