<?php


function pageBanner ($args = NULL) {
/**
 *  Set up the page banner which contains title, subtitle, and image. $args is optional
 */

    // if no title is provided, use the wordpress page title
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    //if no subtitle, use the custom field subtitle
    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    // if no photo, check for custom fields photo, else use theme photo
    if (!$args['photo']) {
        if (get_field('page_banner_background_image')) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        }
        else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

    
    ?>
    
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(
        <?php 
        echo $args['photo'];
        //$pageBannerImage = get_field('page_banner_background_image');
        //echo $pageBannerImage['url']?>);">
    </div>
    
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php 
            echo $args['subtitle'];
            //the_field('page_banner_subtitle');
            ?></p>
      </div>
    </div>  
  </div>  <!-- page-banner -->


    <?php

}


function college_theme_files() {
/**
 * Load essential files for our theme 
 */
    
    // load theme JS
     wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=enterYourKeyHere', NULL, '1.0', true);

      

     // load theme JS
     wp_enqueue_script('college_theme_script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);

     // load your un-bundled JS and your jquery
     wp_enqueue_script('college_theme_script', get_theme_file_uri('/js/scripts.js'), array('jquery'), microtime(), true);


    // load google font
    wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i" rel="stylesheet');
        
    // load font awesome
    wp_enqueue_style('font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    // load theme CSS. Null means no dependancies 
    wp_enqueue_style('college_theme_styles', get_theme_file_uri() .'/style.css', NULL, microtime());

    
}



add_action('wp_enqueue_scripts', 'college_theme_files');




function college_features(){
 /**
 * WordPress Theme Support
 */
    add_theme_support('title-tag');
    // //adds new menu locations to admin dashboard for dynamic menu
    // register_nav_menu('header-menu-location', 'Header Location');
    // //adds new menu locations to admin dashboard for dynamic menu
    // register_nav_menu('footer-location-1', 'Footer Location 1');
    // //adds new menu locations to admin dashboard for dynamic menu
    // register_nav_menu('footer-location-2', 'Footer Location 2');
    add_theme_support('post-thumbnails');
    add_image_size('teacherLandscape', 400, 260, true);
    add_image_size('teacherPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'college_features');



function college_adjust_queries($query){

/**
 *  For the "All Events" page, list the events by chronological order
 *  from the upcoming to the farthest away.  If the event is past, don't
 *  display it.  Note we could have achieved this with a custom query like
 *  we did in front-page.php but this way is more efficient
 */
 
    // if you are on front end of website and the post type is campus
    if (!is_admin() AND is_post_type_archive('campus') AND 
    $query->is_main_query()) {
    // we only want to manipulate main URL-based query

    // display all
    $query->set('posts_per_page', '-1');

}
    // if you are on front end of website and the post type is program
    if (!is_admin() AND is_post_type_archive('program') AND 
    $query->is_main_query()) {
    // we only want to manipulate main URL-based query
    
        // display all
        
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', '-1');

    }

    if (!is_admin() AND is_post_type_archive('event') AND 
        $query->is_main_query()) {

        //this will apply universially to front end posts, front end custom post types, back end pages, and back end posts.
        // $query->set('posts_per_page', '1');

        $today = date('Y/m/d');
        // $query->set('posts_per_page', '1');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        
        //copy and paste from front-page.php
        $query->set('meta_query',array(
            array(
                'key' =>  'event_date',
                'compare' => '>=',
                'value' => $today
                

        )
        ));
    }
    
    
}

add_action('pre_get_posts','college_adjust_queries');

function collegeMapKey($api){
    $api['key'] = 'AIzaSyA1nfOqfj1Tj1-bvYA9qzx-I5tsU-U7CcQ';
    return $api;
}

add_filter('acf/fields/google_map/api', 'collegeMapKey');

function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyA1nfOqfj1Tj1-bvYA9qzx-I5tsU-U7CcQ');
}
add_action('acf/init', 'my_acf_init');

?>
