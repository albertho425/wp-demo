<?php

/*
Plugin Name: College Post Types
Plugin URI: https://maplesyrupweb.com
Description: Custom Post Type Event, Program, and Teacher
Version: 1.0.0
Author: Maple Syrup Web
Author URI: https://maplesyrupweb.com
Text Domain: CPT, Custom Post Type, Maple Syrup Web
Domain Path: /lang
*/


/**
 * Custom Post Type: events.
 */

function cptui_register_my_cpts_event() {


$labels = [
    "name" => __( "events", "Maple Syrup Web College Theme" ),
    "singular_name" => __( "event", "Maple Syrup Web College Theme" ),
    "menu_name" => __( "Events", "Maple Syrup Web College Theme" ),
    "all_items" => __( "All Events", "Maple Syrup Web College Theme" ),
    "add_new" => __( "Add New Event", "Maple Syrup Web College Theme" ),
    "add_new_item" => __( "Add New Event", "Maple Syrup Web College Theme" ),
    "edit_item" => __( "Edit Event", "Maple Syrup Web College Theme" ),
    "new_item" => __( "Add New Event", "Maple Syrup Web College Theme" ),
    "view_item" => __( "View Event", "Maple Syrup Web College Theme" ),
    "view_items" => __( "View Events", "Maple Syrup Web College Theme" ),
    "featured_image" => __( "Featured Image for this Event", "Maple Syrup Web College Theme" ),
    "set_featured_image" => __( "Set Featured Image for this Event", "Maple Syrup Web College Theme" ),
];

$args = [
    "label" => __( "events", "Maple Syrup Web College Theme" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "event", "with_front" => true ],
    "query_var" => true,
    "menu_icon" => "dashicons-calendar",
    "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
    "show_in_graphql" => false,
];

register_post_type( "event", $args );



}

add_action( 'init', 'cptui_register_my_cpts_event' );

/**
 *  Custom Post Type: Programs
 */

function cptui_register_my_cpts_program() {

	$labels = [
		"name" => __( "programs", "Maple Syrup Web College Theme" ),
		"singular_name" => __( "program", "Maple Syrup Web College Theme" ),
		"menu_name" => __( "Programs", "Maple Syrup Web College Theme" ),
		"all_items" => __( "All Programs", "Maple Syrup Web College Theme" ),
		"add_new_item" => __( "Add New Program", "Maple Syrup Web College Theme" ),
		"edit_item" => __( "Edit Program", "Maple Syrup Web College Theme" ),
	];

	$args = [
		"label" => __( "programs", "Maple Syrup Web College Theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "program", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-welcome-learn-more",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "program", $args );
}

add_action( 'init', 'cptui_register_my_cpts_program' );


/**
 *  Custom Post Type: Teacher
 */

function register_my_cpts_teacher() {

	$labels = [
		"name" => __( "teachers", "Maple Syrup Web College Theme" ),
		"singular_name" => __( "Teacher", "Maple Syrup Web College Theme" ),
		"menu_name" => __( "Teachers", "Maple Syrup Web College Theme" ),
		"all_items" => __( "All Teachers", "Maple Syrup Web College Theme" ),
		"add_new_item" => __( "Add New Teacher", "Maple Syrup Web College Theme" ),
		"edit_item" => __( "Edit Teacher", "Maple Syrup Web College Theme" ),
	];

	// note that no archive so no rewrite needed.  note that false is also default 

	$args = [
		"label" => __( "teachers", "Maple Syrup Web College Theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		// "has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		// "rewrite" => [ "slug" => "teacher", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-megaphone",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "teacher", $args );
}

add_action( 'init', 'register_my_cpts_teacher' );

/**
 * Custom Post Type: campus.
 */

function cptui_register_my_cpts_campus() {


	$labels = [
		"name" => __( "campus", "Maple Syrup Web College Theme" ),
		"singular_name" => __( "campus", "Maple Syrup Web College Theme" ),
		"menu_name" => __( "Campus", "Maple Syrup Web College Theme" ),
		"all_items" => __( "All Campus", "Maple Syrup Web College Theme" ),
		"add_new" => __( "Add New campus", "Maple Syrup Web College Theme" ),
		"add_new_item" => __( "Add New campus", "Maple Syrup Web College Theme" ),
		"edit_item" => __( "Edit Campus", "Maple Syrup Web College Theme" ),
		"new_item" => __( "Add New Campus", "Maple Syrup Web College Theme" ),
		"view_item" => __( "View Campus", "Maple Syrup Web College Theme" ),
		"view_items" => __( "View Campus", "Maple Syrup Web College Theme" ),
		"featured_image" => __( "Featured Image for this Campus", "Maple Syrup Web College Theme" ),
		"set_featured_image" => __( "Set Featured Image for this Campus", "Maple Syrup Web College Theme" ),
	];
	
	$args = [
		"label" => __( "Campus", "Maple Syrup Web College Theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "event", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-location-alt",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];
	
	register_post_type( "campus", $args );
	
	
	
	}
	
	add_action( 'init', 'cptui_register_my_cpts_campus' );

	/**
 * Custom Post Type: coffee
 */

function register_coffee_shop() {


	$labels = [
		"name" => __( "Coffee", "Maple Syrup Web College Theme" ),
		"singular_name" => __( "Coffee Shop", "Maple Syrup Web College Theme" ),
		"menu_name" => __( "Coffee Shop", "Maple Syrup Web College Theme" ),
		"all_items" => __( "All Coffee Shops", "Maple Syrup Web College Theme" ),
		"add_new" => __( "Add New Coffee Shop", "Maple Syrup Web College Theme" ),
		"add_new_item" => __( "Add New Coffee Shop", "Maple Syrup Web College Theme" ),
		"edit_item" => __( "Edit Coffee Shop", "Maple Syrup Web College Theme" ),
		"new_item" => __( "Add New Coffee Shop", "Maple Syrup Web College Theme" ),
		"view_item" => __( "View Coffee Shop", "Maple Syrup Web College Theme" ),
		"view_items" => __( "View Coffee Shops", "Maple Syrup Web College Theme" ),
		"featured_image" => __( "Featured Image for this Coffee Shop", "Maple Syrup Web College Theme" ),
		"set_featured_image" => __( "Set Featured Image for this Coffee Shop", "Maple Syrup Web College Theme" ),
	];
	
	$args = [
		"label" => __( "Coffee", "Maple Syrup Web College Theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "event", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-coffee",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];
	
	register_post_type( "Coffee", $args );
	
	
	
	}
	
	add_action( 'init', 'register_coffee_shop' );


	

?>