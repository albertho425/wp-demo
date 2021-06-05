<?php // custom_admin - Register Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 *  Register the plugin settings
 */

function custom_admin_register_settings() {
	
    /**
     *  register_setting( 
	 *	string   $option_group, 
	 *	string   $option_name, 
	 *	callable $sanitize_callback);
     */
	
	register_setting( 
		'custom_admin_options', 
		'custom_admin_options', 
		'custom_admin_callback_validate_options' 
	); 

	
    
    /**
    *  add_settings_section( 
	* string   $id, 
	* string   $title, 
	* callable $callback, 
	* string   $page);
    */
        
	
	
	add_settings_section( 
		'custom_admin_section_admin', 
		'Customize Admin Area', 
		'custom_admin_callback_section_admin', 
		'custom_admin'
	);

	
    /** 
	* add_settings_field(
    * 	string   $id,
	*	string   $title,
	*	callable $callback,
	*	string   $page,
	*	string   $section = 'default',
	*	array    $args = []);
    **/


	add_settings_field(
		'custom_footer',
		'Custom Footer',
		'custom_admin_callback_field_text',
		'custom_admin',
		'custom_admin_section_admin',
		[ 'id' => 'custom_footer', 'label' => 'Custom footer text' ]
	);

	add_settings_field(
		'custom_toolbar',
		'Simplify Toolbar',
		'custom_admin_callback_field_checkbox',
		'custom_admin',
		'custom_admin_section_admin',
		[ 'id' => 'custom_toolbar', 'label' => 'Remove Site Title, Logo, Updates, and Comments from the toolbar' ]
    );
    

	add_settings_field(
		'custom_scheme',
		'Custom Scheme',
		'custom_admin_callback_field_select',
		'custom_admin',
		'custom_admin_section_admin',
		[ 'id' => 'custom_scheme', 'label' => 'Default color scheme for new users' ]
	);

}
add_action( 'admin_init', 'custom_admin_register_settings' );

