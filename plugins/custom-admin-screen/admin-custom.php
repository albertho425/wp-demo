<?php

/**
 * Plugin Name:  Custom Admin Functions
 * Description:  Some custom admin functions on the admin dashboard
 * Plugin URI:   https://maplesyrupweb.com
 * Author:       Maple Syrup Web
 * Version: 1.0
 * Text Domain:  custom_admin
 * License:      GPL v2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
 **/



// disable direct file access to this file
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


 
 // include plugin dependencies

 if ( is_admin() ) {

 require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
 require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
 require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
 require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
 require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
 
 }

 // include dependencies: admin and public
 require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';


// default plugin options
function custom_admin_options_default() {

	return array(
		'custom_message' => '<p class="custom-message">'. esc_html__('My custom message', 'custom_admin') .'</p>',
		'custom_footer'  => esc_html__('Special message for users', 'custom_admin'),
		'custom_toolbar' => false,
		'custom_scheme'  => 'default',
	);
}

// remove options on uninstall
function custom_admin_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_option( 'custom_admin_options' );

}
register_uninstall_hook( __FILE__, 'custom_admin_on_uninstall' );

