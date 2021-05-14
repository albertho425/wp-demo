<?php

/**
 * Adds dynamic theme support
 */
function maplesyrup_theme_support(){

    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');

}

add_action('after_setup_theme', 'maplesyrup_theme_support');

/**
 *  Add dynamic menus
 */

function maplesyrup_menus() {

    $locations = array(
      'primary'  => "Desktop Primary Left Sidebar",
      'footer' => "Footer Menu Items"
    );

    register_nav_menus($locations);
}

add_action('init', 'maplesyrup_menus');

/**
 *  Register CSS, Bootstrap CSS, and Fontawesome
 */


function maplesyrup_register_styles(){

    $version = wp_get_theme()->get('Version') ;

    
    // stylesheet is dependent on bootstrap
    wp_enqueue_style('maplesyryup-style', get_template_directory_uri() . "/style.css", array('maplesyrup-bootstrap'), $version, 'all');


    wp_enqueue_style('maplesyrup-bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.css", array(), '5.0.0', 'all');

    
    
    wp_enqueue_style('maplesyrup-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');


}

add_action('wp_enqueue_scripts', 'maplesyrup_register_styles' );


/**
 *  Register JS and Bootstrap JS
 */


function maplesyrup_register_scripts(){



    wp_enqueue_script('maplesyrup-bootstrap', get_template_directory_uri() . "/assets/js/bootstrap.js", array(), '5.0.0', 'all');

    //last argument true makes the javascript load in the footer
    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script('maplesyrup-main', get_template_directory_uri() . "/assets/js/main.js"
    , array(), '1.0', true );

}

add_action('wp_enqueue_scripts', 'maplesyrup_register_scripts' );

/**
 *  Allow user to use widgets
 */

function maplesyrup_widget_areas() {

    // https://developer.wordpress.org/reference/functions/register_sidebar/
    
    register_sidebar(
        array(
            'before_title' => '',
            'afer_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Sidebar Area',
            'id'   => 'sidebar-1',
            'description' => 'Sidebar Widget Area'
        ) 
    );

    register_sidebar(
        array(
            'before_title' => '',
            'afer_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Area',
            'id'   => 'footer-1',
            'description' => 'Footer Widget Area'
        )

    );

}

add_action('widgets_init', 'maplesyrup_widget_areas');


?>