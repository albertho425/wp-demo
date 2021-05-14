<?php

/**
 * Post Type: Accommodation.
 */


function register_accomodation_type() {


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

add_action( 'init', 'register_accomodation_type' );


//******************************************************************** */

/**
 *  Add a metabox for the custom post type.  Note that
 *  other options are to enable custom meta fields in WordPress, 
 *  or using plugin such as Advanced Custom Fields
 */


function hotel_metabox()
{

    // https://developer.wordpress.org/reference/functions/add_meta_box/

    add_meta_box('hotel_metabox_customfields', 'Hotel Custom Fields', 
    'hotel_metabox_display','accommodation', 'normal', 'high');
}

add_action('add_meta_boxes', 'hotel_metabox');

//********************************************************************

/**
 *  Diplsy the HTML form for the meta box
 */

function hotel_metabox_display()
{
    global $post;
    $sub_title = get_post_meta($post->ID, 'sub_title', true);
    $hotel = get_post_meta($post->ID, 'hotel', true);

    ?>
    <lable>Hotel Custom Field 1</label>
    <input type="text" name="sub_title" placeholder="Placeholder" class="widefat" value="<?php print $sub_title;?>">
    <br><br>

    <lable>Hotel Custom Field 2</label>
    <input type="text" name="hotel" placeholder="Placeholder" class="widefat" value="<?php print $hotel;?>">
    <br><br>

    <?php
}

//********************************************************************

/**
 *  Save the data in the metabox form
 */

function hotel_post_type_save($post_id)
{
    // for production site, add nonce
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    
    // for custom fields we want the user to click on update
    if ($is_autosave || $is_revision) {
        return;
    }
    $post = get_post($post_id);

    if($post->post_type == "accommodation") 
    {
        // save the custom field data
        if (array_key_exists('sub_title', $_POST))
        {
            update_post_meta($post_id, 'sub_title', $_POST['sub_title']);
        }

        if (array_key_exists('hotel', $_POST))
        {
            update_post_meta($post_id, 'hotel', $_POST['hotel']);
        }

    }
}

add_action('save_post', 'hotel_post_type_save');

//********************************************************************


/**
 *  Print the coffee shop post type to the front end using a short code
 */

function get_hotel_post_types() 
{

    // you can change the order of posts, order by category, published status, etc

    $args = array (
        'posts_per_page' => 3,
        'post_type' => 'accommodation'
    );
    $ourPosts = get_posts($args);

    //print_r($ourPosts);

    // echo "<pre>";
    // print_r($ourPosts);
    // echo "</pre>";

      /* String to return */
      $content = '';

    foreach ($ourPosts as $key=>$val)
    {
        // use arrrow -> for objects. if it was array then we can print $val[ID];

        //get the data from the metabox form
        $sub_title = get_post_meta($val->ID, 'sub_title', true);
        $hotel = get_post_meta($val->ID, 'hotel', true);
    
        //print the post type title and the permalink to the post type
        $content .= '<a href="'.get_permalink($val->ID).'"><strong>'. $val->post_title. '</strong></a><br/>';
        
        //if the custom meta box is not empty, then print it
        if ($sub_title != "")
        {
            $content .= '<em>Custom Field 1: '. $sub_title . '<br>';
        }
        
        //print the content of the post type
        $content .= $val->post_content. '<br>';

        //if the custom meta box is not empty, then print it
        if ($hotel != "")
        {
            $content .= '<em>Custom Field 2 '.$hotel .  '</em><br><hr>';
        }
    }


    //return $ourPosts;
    return $content;
}

add_shortcode('hotels', 'get_hotel_post_types');

//******************************************************************** */


/**
* Post Type: Coffee Shops.
*/


function register_coffee_shop_type() {

	
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
        "register_meta_box" => 'coffee_metabox',
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "coffee_shops", $args );
}

add_action( 'init', 'register_coffee_shop_type' );


//********************************************************************

/**
 *  Add a metabox for the custom post type.  Note that
 *  other options are to enable custom meta fields in WordPress, 
 *  or using plugin such as Advanced Custom Fields
 */


function coffee_metabox()
{

    // https://developer.wordpress.org/reference/functions/add_meta_box/

    add_meta_box('coffee_metabox_customfields', 'Coffee Custom Fields', 
    'coffee_metabox_display','coffee_shops', 'normal', 'high');
}

add_action('add_meta_boxes', 'coffee_metabox');

//********************************************************************

/**
 *  Diplsy the HTML form for the meta box
 */

function coffee_metabox_display()
{
    global $post;
    $sub_title = get_post_meta($post->ID, 'sub_title', true);
    $coffee = get_post_meta($post->ID, 'coffee', true);

    ?>
    <lable>Custom Field Label</label>
    <input type="text" name="sub_title" placeholder="Placeholder" class="widefat" value="<?php print $sub_title;?>">
    <br><br>

    <lable>Coffee Flavor</label>
    <input type="text" name="coffee" placeholder="Placeholder" class="widefat" value="<?php print $coffee;?>">
    <br><br>

    <?php
}

//********************************************************************

/**
 *  Save the data in the metabox form
 */

function coffee_post_type_save($post_id)
{
    // for production site, add nonce
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    
    // for custom fields we want the user to click on update
    if ($is_autosave || $is_revision) {
        return;
    }
    $post = get_post($post_id);

    if($post->post_type == "coffee_shops") 
    {
        // save the custom field data
        if (array_key_exists('sub_title', $_POST))
        {
            update_post_meta($post_id, 'sub_title', $_POST['sub_title']);
        }

        if (array_key_exists('coffee', $_POST))
        {
            update_post_meta($post_id, 'coffee', $_POST['coffee']);
        }

    }
}

add_action('save_post', 'coffee_post_type_save');

//********************************************************************

/**
 *  Provide CSS styling for the custom field form of coffee
 */

function coffee_post_type_css_admin()
{
    ?>
    <style>
    
    .custom_field { font-size: 16px; padding; 16px: width: 100%;}

    </style>

    <?php 
}

add_action('admin_head', 'coffee_post_type_css_admin');

//******************************************************************** */

/**
 *  Display Custom Post Type on front end using a short code
 */

function get_coffee_shop_post_types() 
{

    // you can change the order of posts, order by category, published status, etc

    $args = array (
        'posts_per_page' => 3,
        'post_type' => 'coffee_shops'
    );
    $ourPosts = get_posts($args);

    //print_r($ourPosts);

    // echo "<pre>";
    // print_r($ourPosts);
    // echo "</pre>";

      /* String to return */
      $content = '';

    foreach ($ourPosts as $key=>$val)
    {
        // use arrrow -> for objects. if it was array then we can print $val[ID];

        //get the data from the metabox form
        $sub_title = get_post_meta($val->ID, 'sub_title', true);
        $coffee = get_post_meta($val->ID, 'coffee', true);
            
        //print the post type title and the permalink to the post type
        $content .= '<a href="'.get_permalink($val->ID).'"><strong>'. $val->post_title. '</strong></a><br/>';
        
        //if the custom meta box is not empty, then print it
        if ($sub_title != "")
        {
            $content .= '<em>Hot or Cold: '. $sub_title . '<br>';
        }
        
        //print the content of the post type
        $content .= $val->post_content. '<br>';

        //if the custom meta box is not empty, then print it
        if ($coffee != "")
        {
            $content .= '<em>Coffee Flavor: '.$coffee .  '</em><br><hr>';
        }
    }

    return $content;
    //return $ourPosts;
}

add_shortcode('coffee', 'get_coffee_shop_post_types');

//******************************************************************** */

/**
 *  Post Type: Attractions.
*/


function register_attractions_type() {

	
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

//******************************************************************** */


/**
 * *  Display Custom Post Type on front end using a short code
 */


function get_attraction_post_types() 
{

    // you can change the order of posts, order by category, published status, etc

    $args = array (
        'posts_per_page' => 3,
        'post_type' => 'attractions'
    );
    $ourPosts = get_posts($args);

    //print_r($ourPosts);

    // echo "<pre>";
    // print_r($ourPosts);
    // echo "</pre>";

    /* String to return */
    $content = '';

    foreach ($ourPosts as $key=>$val)
    {
        // use arrrow -> for objects. if it was array then we can print $val[ID];

        //get the data from the metabox form
        $sub_title = get_post_meta($val->ID, 'sub_title', true);
        $attractions = get_post_meta($val->ID, 'attractions', true);

        //print the post type title and the permalink to the post type
        $content .= '<a href="'.get_permalink($val->ID).'"><strong>'. $val->post_title. '</strong></a><br/>';
        
        //if the custom meta box is not empty, then print it
        if ($sub_title != "")
        {
            $content .= '<em>Attraction Custom Field 1: '. $sub_title . '<br>';
        }
        
        //print the content of the post type
        $content .= $val->post_content. '<br>';

        //if the custom meta box is not empty, then print it
        if ($attractions != "")
        {
            $content .= '<em>Attraction Custom Field 2: '. $attractions .  '</em><br><hr>';
        }

        
    }

    //return $ourPosts;

    return $content;
}

add_shortcode('attractions', 'get_attraction_post_types');

//********************************************************************

/**
 *  Add a metabox for the custom post type.  Note that
 *  other options are to enable custom meta fields in WordPress, 
 *  or using plugin such as Advanced Custom Fields
 */

function attractions_metabox()
{

    // https://developer.wordpress.org/reference/functions/add_meta_box/

    add_meta_box('attractions_metabox_customfields', 'Attractions Custom Fields', 
    'attractions_metabox_display','attractions', 'normal', 'high');
}

add_action('add_meta_boxes', 'attractions_metabox');

//********************************************************************

/**
 *  Diplsy the HTML form for the meta box
 */

function attractions_metabox_display()
{
    global $post;
    $sub_title = get_post_meta($post->ID, 'sub_title', true);
    $attractions = get_post_meta($post->ID, 'attractions', true);

    ?>
    <lable>Custom Field Label</label>
    <input type="text" name="sub_title" placeholder="Placeholder" class="widefat" value="<?php print $sub_title;?>">
    <br><br>

    <lable>Attraction Sub Field</label>
    <input type="text" name="attractions" placeholder="Placeholder" class="widefat" value="<?php print $attractions;?>">
    <br><br>

    <?php
}

//********************************************************************


/**
 *  Save the data in the metabox form
 */

function attractions_post_type_save($post_id)
{
    // for production site, add nonce
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);

    
    // for custom fields we want the user to click on update
    if ($is_autosave || $is_revision) {
        return;
    }
    $post = get_post($post_id);

    if($post->post_type == "attractions") 
    {
        // save the custom field data
        if (array_key_exists('sub_title', $_POST))
        {
            update_post_meta($post_id, 'sub_title', $_POST['sub_title']);
        }

        if (array_key_exists('attractions', $_POST))
        {
            update_post_meta($post_id, 'attractions', $_POST['attractions']);
        }

    }
}

add_action('save_post', 'attractions_post_type_save');


?>
