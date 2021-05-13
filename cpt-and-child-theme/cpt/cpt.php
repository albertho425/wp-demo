<?php

/**
 * Plugin Name:       Post Types and Taxonomies
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       A simple plugin for creating custom post types and taxonomies related to a business directory.
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */


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
