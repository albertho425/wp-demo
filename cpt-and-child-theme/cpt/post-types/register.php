<?php

function register_accomodation_type() {

/**
 * Post Type: Accommodation.
 */

$labels = [
    "name" => __( "Accommodation", MYDOMAIN ),
    "singular_name" => __( "Accommodation", MYDOMAIN ),
    "menu_name" => __( "Accommodation", MYDOMAIN ),
    "all_items" => __( "All Accommodation", MYDOMAIN ),
    "add_new" => __( "Add New Accommodation", MYDOMAIN ),
    "add_new_item" => __( "Add New Accomodation", MYDOMAIN ),
    "edit_item" => __( "Edit Accommodation", MYDOMAIN ),
    "new_item" => __( "New Accommodation", MYDOMAIN ),
    "view_item" => __( "View Accommodation", MYDOMAIN ),
];

$args = [
    "label" => __( "Accommodation", MYDOMAIN ),
    "labels" => $labels,
    "description" => "Accommodation",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "accommodation", "with_front" => true ],
    "query_var" => true,
    "menu_icon" => "dashicons-calendar",
    "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
    "show_in_graphql" => false,
];

register_post_type( "accommodation", $args );
}

function register_coffee_shop_type() {

	/**
	 * Post Type: Coffee Shops.
	 */

	$labels = [
		"name" => __( "Coffee Shops", MYDOMAIN ),
		"singular_name" => __( "Coffee Shop", MYDOMAIN ),
		"menu_name" => __( "Coffee Shops", MYDOMAIN ),
		"all_items" => __( "Al Coffee Shops", MYDOMAIN ),
		"add_new" => __( "Add new Coffee Shop", MYDOMAIN ),
		"add_new_item" => __( "Add new Coffee Shop", MYDOMAIN ),
		"edit_item" => __( "Edit Coffee Shop", MYDOMAIN ),
		"new_item" => __( "New Coffee Shop", MYDOMAIN ),
		"view_item" => __( "View Coffee Shop", MYDOMAIN ),
		"view_items" => __( "View Coffee Shops", MYDOMAIN ),
		"search_items" => __( "Search Coffee Shops", MYDOMAIN ),
		"featured_image" => __( "Featured Image for this Coffee Shop", MYDOMAIN ),
		"set_featured_image" => __( "Set Featured Image for Coffee Shop", MYDOMAIN ),
		"archives" => __( "Coffee Shops", MYDOMAIN ),
	];

	$args = [
		"label" => __( "Coffee Shops", MYDOMAIN ),
		"labels" => $labels,
		"description" => "Coffee Shops.  Get your caffeine fix",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "coffee_shops", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-coffee",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "coffee_shops", $args );
}

function register_attractions_type() {

	/**
	 * Post Type: Attractions.
	 */

	$labels = [
		"name" => __( "Attractions", MYDOMAIN ),
		"singular_name" => __( "Attractions", MYDOMAIN ),
		"menu_name" => __( "Attractions", MYDOMAIN ),
	];

	$args = [
		"label" => __( "Attractions", MYDOMAIN ),
		"labels" => $labels,
		"description" => "Attractions",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "attractions", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-buddicons-activity",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "attractions", $args );
}

add_action( 'init', 'register_attractions_type' );



?>
