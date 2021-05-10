<?php

function register_location_taxonomy() {

	/**
	 * Taxonomy: Locations.
	 */

	$labels = [
		"name" => __( "Locations", MYDOMAIN ),
		"singular_name" => __( "Location", MYDOMAIN ),
		"menu_name" => __( "Location", MYDOMAIN ),
	];

	
	$args = [
		"label" => __( "Locations", MYDOMAIN ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'location', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "location",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "location", [ "accommodation", "coffee_shops", "attractions" ], $args );
}
add_action( 'init', 'register_location_taxonomy' );


?>
