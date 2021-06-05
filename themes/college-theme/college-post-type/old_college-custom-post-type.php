<!-- must use plugin -->

<?php

/**
 *  Register post type for college event and
 *  collage program
 */

function college_post_types()

{
    /**
     *  Academic Event Post Type
     */

    register_post_type('event1', array(
        
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            // Sub array
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    /**
     *  Academic Program Post Type
     */
    register_post_type('program1', array(
        
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            // Sub array
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-book'
    ));

}

add_action('init', 'college_post_types');

?>