<?php

/* child style */
function childtheme_enqueue_styles() {


// enqueue parent styles
wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');
	
// enqueue child styles
wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/style.css', array('parent-theme'));



}
add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles', 999 );



// code snippet below moves the SKU and category of a single product page


//first arg is the name of the hook, second arg is what is hooked, 3rd arg is the prioirity
//listed in content-single-product.php
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//first arg is the name of the hook, second arg is what is hooked, 3rd arg is the prioirity
//listed in content-single-product.php
add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 30);

?>