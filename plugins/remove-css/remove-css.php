<?php

/**
 *   Plugin Name: Remove Un-needed CSS from your website
 * 
 *   Plugin URI: https://maplesyrupweb.com
 *   Description: Remove Un-needed CSS from your website
 *   Version: 1.0
 *   Author: Maple Syrup Web
 *   Author URI: https://maplesyrupweb.com
 *   Text Domain: Remove Un-needed CSS from your website
 *   Domain Path: /lang
 * 
 */

    remove_action('wp_print_styles','print_emoji_styles');



/**
 *  Remove Block Library CSS
 */
function remove_block_library()
{
    wp_dequeue_style('wp-block-library');
    

    
}

add_action('wp_print_styles', 'remove_block_library');


/**
 *  Remove Dashicons CSS
 */
 
function remove_dashicons()
 {
    wp_dequeue_style('dashicons');
    wp_deregister_style( 'dashicons' );
 }

 add_action('wp_print_styles', 'remove_dashicons'); 

 /**
 *  Remove Other CSS That you don't need
 *  When viewing page source, look for link rel="stylesheet" id='name of CSS Here'
 *  
 *  
 */

function remove_travern_theme_css()
{
    wp_dequeue_style('travern-gfonts-Assistant');
    wp_dequeue_style('travern-gfonts-Oleo');
    wp_dequeue_style('travern-gfonts-Source');
    wp_dequeue_style('travern-gfonts-Rajdhani');
    wp_dequeue_style('travern-gfonts-Tangerine');
    wp_dequeue_style('travern-gfonts-Poppins');
    wp_dequeue_style('travern-gfonts-DScript');
    wp_dequeue_style('travern-gfonts-Satisfy');
    wp_dequeue_style('travern-gfonts-Playfair');
    wp_dequeue_style('travern-opal-style');
    wp_dequeue_style('travern-hotel-booking-style');
    wp_dequeue_style('travern-font-awesome-style');
    wp_dequeue_style('travern-gfonts-RobotoCo');
    wp_dequeue_style('travern-gfonts-Roboto-Slab');
    
}

add_action('wp_print_styles', 'remove_travern_theme_css');



 ?>
