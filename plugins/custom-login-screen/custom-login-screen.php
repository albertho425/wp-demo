<?php

/**
 * Plugin Name:  Custom Login Screen
 * Description:  Customize Your Login Screen
 * Plugin URI:   https://maplesyrupweb.com
 * Author:       Maple Syrup Web
 * Version: 1.0
 * Text Domain:  custom-login-screen
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


/**
*   The default plugin options which will be display on the admin dashboard and on the login screen
**/

function myplugin_options_default() {

	return array(
		'custom_url'     => 'https://maplesyrupweb.com/',
		'custom_title'   => esc_html__('Powered by Maple Syrup Web', 'custom-login-screen'),
		'custom_style'   => 'disable',
		'custom_message' => '<p class="custom-message">'. esc_html__('My custom message', 'myplugin') .'</p>',
		
	);
}

/**
*   Remove option on uninstall
**/

function myplugin_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_option( 'myplugin_options' );

}
register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );

