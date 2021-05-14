<?php
/*
Plugin Name: Use Bootstrap
Plugin URI: https://maplesyrupweb.com
Description: Use Bootstrap on your WordPress website or blog
Version: 0.0.1
Author: Maple Syrup Web
Author URI: https://maplesyrupweb.com
Text Domain: Bootstrap CSS
*/

function include_bootstrap()
{



    wp_enqueue_style('demo-bootstrap',plugin_dir_url(__FILE__).'css/bootstrap.css');
    
    wp_enqueue_style('demo-script',plugin_dir_url(__FILE__).'js/bootstrap.js');


}



add_action('wp_enqueue_scripts', 'include_bootstrap');

?>