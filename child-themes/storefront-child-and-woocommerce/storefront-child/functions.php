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

// Remove Additional Information Tab from the single product page of a product

add_filter('woocommerce_product_tabs', 'maplesyrupweb_product_tabs', 100 );

/**
 *  Update some of the product tab information
 */

function maplesyrupweb_product_tabs ( $tabs ) {

    // print_r($tabs);

    // additional_information] => Array ( [title] => Additional information [priority] => 20 [callback] => woocommerce_product_additional_information_tab ) [reviews] => Array ( [title] => Reviews (0) [priority] => 30 [callback] => comments_template ) ) 

    //unset($tabs['reviews']);
     unset($tabs['additional_information']);

    $tabs['reviews']['title'] = __("Success Stories");
    
    return $tabs;
}

// changing the breadcrumbs

add_filter('coocommerce_breadcrumb_defaults', 'maplesyrupweb_breadcrumb');


function maplesyrupweb_breadcrumb( $breadcrumb ) {

//print_r($breadcrumb);

$brreadcrumb['delimiter'] = ' %gt ';


return $breadcrumb;

}

 
//3rd arg is priority level, 4th arg means we need access to two parameters
add_filter('woocommerce_currency_symbol' ,'maplesyrupweb_currency_symbol', 30, 2);

/**
 *  Clarifying the Dollar Symbol.  Note this can be done in functions.php or via custom plugin 
 */

function maplesyrupweb_currency_symbol($currency_symbol, $currency) {
    
    if ( 'USD' === $currency ) {
		return 'USD';
	}

	if ( 'CAD' === $currency ) {
		return 'CAD';
	}

        return $symbols;



    //$currency_symbol = 'CAD $';
    return $currency_symbol;



}

// change the number of products per page

add_filter( 'loop_shop_per_page', 'maplesyrupweb_products_per_page', 20 );

/**
 *  Define the number or products per page maximum
 */

function maplesyrupweb_products_per_page( $num_prodcuts ){

//return $num_products * 2;    
return 20;

}

// chnage the number of columns

add_filter( 'loop_shops_columns', 'maplesyrupweb_number_columns', 20);

/**
 *  Define the number of columns per page
 */

function maplesyrupweb_number_columns( $cols ) {
    
    return 5; 
}

// Display the amount of money saved.  If less than $100 off, show percentage.  If more than $100 off, show the dollar amount

// note priority is 10 which is higher prioirty than loop_shopers_per page or loop_shops_columns,  2 refers to 2 paraemters

add_filter('woocommerce_sale_price_html', 'maplesyrupweb_sale_price_html', 10, 2);

/**
 *  Display the amount of money saved.  If less than $100 off, show percentage.  If more than $100 off, show the dollar amount
 */

function maplesyrupweb_sale_price_html( $html, $product) {
    
    // 75 - 50 =  (25 / 75 ) * 100 = 33 %
    
    $percentage = round( ( ($product->regular_price - $product->sale_price) / $product->regular_price ) * 100 );
    
    //using sprintf for string with placeholder for translation
    return $html . sprintf( __(' Save %s', 'woocommerce', $percentage . ' %') );
}

add_filter( 'woocommerce_catalog_orderby', 'maplesyrupweb_catalog_orderby', 20);

/**
 *  Customize the sort by filter on the shop page
 */

function maplesyrupweb_catalog_orderby( $orderby )

    //  Array ( [menu_order] => Default sorting 
    //         [popularity] => Sort by popularity
    //         [rating] => Sort by average rating 
    //         [date] => Sort by latest 
    //           [price] => Sort by price: low to high      
    //            [price-desc] => Sort by price: high to low )

{
    
    // disable the default order
    unset($orderby['menu_order']);
    
    // $orderby['most_popular'] = __('Sort by popularity: highest to lowest', 'woocommerce');
    // $orderby['least_popular'] = __('Sort by popularity: lowest to highest', 'woocommerce');

    // update the orderby comments for clarity and consistency
    $orderby['date'] = __('Sort by date: newest to oldest', 'woocomerce');
    
    // adding this so that we can toggle between newest products and oldest products
    $orderby['oldest_to_recent'] = __( 'Sort by date: oldest to newest', 'woocommerce');

    // update the orderby comments for clarity and consistency
    $orderby['price-desc'] = __('Sort by price: highest to lowest', 'woocommerce');
    
    // update the orderby comments for clarity and consistency 
    $orderby['price'] = __('Sort by price: lowest to highest', 'woocommerce');

    
    
    return $orderby;
    
} 



add_filter('woocommerce_get_catalog_ordering_args', 'maplesyrupweb_get_catalog_ordering_args', 20);

/**
 *  Add a new function for  sorting by oldest to most recent
 *  Note:  Refernece class-wc-query.php 
 * */ 

function maplesyrupweb_get_catalog_ordering_args( $args ) {

    // (Condition) ? (Statement1) : (Statement2);
    // $marks=40; print ($marks>=40) ? "pass" : "Fail"; 

    $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( (string) wp_unslash( $_GET['orderby'] ) ) : wc_clean( get_query_var( 'orderby' ) );

    // the key from function maplesyrupweb_catalog_orderby( $orderby )

    if ('oldest_to_recent' == $orderby_value ) {

        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
        
    }
    return $args;

    // if ('least_popular' == $orderby_value ) {

    //     $args['orderby'] = 'rating';
    //     $args['order'] = 'ASC';
        
    // }
    // return $args;

    // if ('most_popular' == $orderby_value ) {

    //     $args['orderby'] = 'rating';
    //     $args['order'] = 'DESC';
    //     print_r($args);
        
    // }
    // return $args;

}

// add an empty cart button

//woocommerce has an update cart button with do_action(woocommerce_cart_actions) in cart.php


add_action('woocommerce_cart_actions', 'maplesyrupweb_empty_cart_button');

/**
 *  Display an empty cart button 
 */

function maplesyrupweb_empty_cart_button() {

    //print out achor tag with woocommerce button class and  it is ready for future translation 

    // notice that URL is now ?empty-cart=true

    echo "<a class='button' href='?empty-cart=true'>" . __( 'Empty Cart', 'woocommerce') . "</a>";
}

// Empty the shopping cart when a user is viewing their cart

add_action('init', 'maplesyrupweb_empty_cart');

/**
 *  Empty the shopping cart when a user is viewing their cart
 */

function maplesyrupweb_empty_cart() {
    
    global $woocommerce;

    if ( isset($_GET['empty-cart'])) {
        $woocommerce->cart->empty_cart();
    }
}

// Remove a field in checkout

add_filter('woocommerce_checkout_fields', 'maplesyrupweb_checkout_fields', 20 );

function maplesyrupweb_checkout_fields( $fields ) {

// note that $fields is a multidimensinoal array. use print_r($fields); to see all the fields

unset($fields['billing']['billing_phone']);

// if your theme has the email and phone field side by side, then make the email field full width if the phone field is removed by adding the CSS class form-row-wide

// $fields['billing']['billing_email']['class'] = array('form-row-wide');



return $fields;

}

// Add a field "How did you hear about is" in the checkout

//priority of 30 so that it runs after the one above
add_filter('woocommerce_checkout_fields', 'maplesyrupweb_hear_about_us', 30);

function maplesyrupweb_hear_about_us( $fields ) {
    $fields['order']['hear_about_us'] = array (
    'type'  => 'select',
    'class' =>  array( 'form-row-wide' ),
    'label' =>  'How did you hear about us?',
    'options' => array(
        'default' => '-- Select an option below --',
        'tv'      => 'TV',
        'news'    => 'Newspapers',
        'yelp'    => 'Yelp',
        'goggle'  => 'Google'
        )

    );
    return $fields;
}

// Add a field "How would you rate your shopping experience?"

//priority of 30 so that it runs after the one above
add_filter('woocommerce_checkout_fields', 'maplesyrupweb_shopping_experience', 30);

function maplesyrupweb_shopping_experience( $fields ) {
    $fields['order']['shopping_experience'] = array (
    'type'  => 'select',
    'class' =>  array( 'form-row-wide' ),
    'label' =>  'How would you rate your shopping experience?',
    'options' => array(
        'default' => '-- Select an option below --',
        'excellent'      => 'Excellent',
        'good'    => 'Good',
        'satisfactory'    => 'Satisfactory',
        'needs_improvement'  => 'Needs Improvement'
        )

    );
    return $fields;
}