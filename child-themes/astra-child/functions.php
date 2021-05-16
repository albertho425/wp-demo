<?php
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );
function astra_child_enqueue_styles() {
 
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'parent-style' )
    );
}



/**
 *  Food Block
 */

add_action('acf/init', 'define_food_block');
function define_food_block() {
	
	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a new block
		acf_register_block(array(
            'name'				=> 'favorite-food',
            //double underline is for internatinoalization function
            'title'				=> __( 'Favorite Food' ),
            //double underline is for internatinoalization function
			'description'		=> __('A custom favorite food block.'),
			'render_callback'	=> 'render_favorite_food_block',
			'category'			=> 'layout',
            // https://developer.wordpress.org/resource/dashicons/
            'icon'				=> 'food',
			'keywords'			=> array( 'favorite', 'fav', 'food', 'dessert', 'entree', 'appetizer', 'profiles', 'acf' ),
		));
	}
}

define( 'PATH', trailingslashit( get_stylesheet_directory() ) );

function render_favorite_food_block( $block ) {
	
	// convert name ("acf/fun-facts") into path friendly slug ("fav-quote")
	$slug = str_replace( 'acf/', '', $block['name'] );
	if( file_exists( PATH . "template-parts/block/content-{$slug}.php" ) ) {
		include( PATH . "template-parts/block/content-{$slug}.php" );
	}
}

add_action('acf/init', 'define_fav_tech_stack_block');

function define_fav_tech_stack_block() {
	
	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a new block
		acf_register_block(array(
            'name'				=> 'fav-tech-stack',
            //double underline is for internatinoalization function
            'title'				=> __( 'Favorite Tech Stack' ),
            //double underline is for internatinoalization function
			'description'		=> __('A custom favorite technology stack block.'),
			'render_callback'	=> 'render_fav_tech_stack_block',
			'category'			=> 'layout',
            // https://developer.wordpress.org/resource/dashicons/
            'icon'				=> 'laptop',
			'keywords'			=> array( 'favorite', 'tech', 'technology', 'stack', 'profiles', 'acf' ),
		));
	}
}

// define( 'PATH', trailingslashit( get_stylesheet_directory() ) );
function render_fav_tech_stack_block( $block ) {
	
	// convert name ("acf/block-name") into path friendly slug ("block-name")
	$slug = str_replace( 'acf/', '', $block['name'] );
	if( file_exists( PATH . "template-parts/block/content-{$slug}.php" ) ) {
		include( PATH . "template-parts/block/content-{$slug}.php" );
	}
}

