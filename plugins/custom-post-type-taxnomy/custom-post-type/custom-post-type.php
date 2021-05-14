<?php

/**
*Plugin Name: Maple Syrup Web
* Description: Some sample functionality2
**/

//define the domain
define( 'MYDOMAIN', 'cpt' );

//define the path
define( 'MYPATH', plugin_dir_path( __FILE__ ) );

//custom post types
require_once( MYPATH . '/post-types/register.php' );
add_action( 'init', 'register_accomodation_type' );
add_action( 'init', 'register_coffee_shop_type' );
add_action( 'init', 'register_attractions_type' );

//taxonomies
require_once( MYPATH . '/taxonomies/register.php' );
add_action( 'init', 'register_location_taxonomy' );

?>