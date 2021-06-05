<?php // custom_admin - WordPress Admin Dashbaord Menu

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 *  Add a submenu in the admin dashboard
 */

function custom_admin_add_sublevel_menu() {
	
	/*
	    add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = '');
	*/
	
	add_submenu_page(
		'options-general.php',
		'Custom Admin Dashboard Settings',
		'Custom Admin Dashboard',
		'manage_options',
		'custom_admin',
		'custom_admin_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'custom_admin_add_sublevel_menu' );


/**
 *  add top-level administrative menu
 */

function custom_admin_add_toplevel_menu() {
	
	/* 
	
	add_menu_page(
		string   $page_title, 
		string   $menu_title, 
		string   $capability, 
		string   $menu_slug, 
		callable $function = '', 
		string   $icon_url = '', 
		int      $position = null)
	
	*/
	
	add_menu_page(
		'Custom Admin Dashboard Settings',
		'Custom Admin',
		'manage_options',
		'custom_admin',
		'custom_admin_display_settings_page',
		'dashicons-admin-home',
		null
	);
	
}
 add_action( 'admin_menu', 'custom_admin_add_toplevel_menu' );


