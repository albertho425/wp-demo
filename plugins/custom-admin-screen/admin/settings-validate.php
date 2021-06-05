<?php //My Plugin - Validate Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


/**
 *  callback: validate options
 */

function custom_admin_callback_validate_options( $input ) {
	
	
	// custom footer message
	if ( isset( $input['custom_footer'] ) ) {
        
        // Sanitizes a string from user input or from the database
        
		$input['custom_footer'] = sanitize_text_field( $input['custom_footer'] );
		
	}
	
	// custom toolbar
	if ( ! isset( $input['custom_toolbar'] ) ) {
		
		$input['custom_toolbar'] = null;
		
	}
	
    $input['custom_toolbar'] = ($input['custom_toolbar'] == 1 ? 1 : 0);
        

	// custom scheme
	$select_options = array(
		
		'default'   => 'Default',
		'light'     => 'Light',
		'blue'      => 'Blue',
		'coffee'    => 'Coffee',
		'ectoplasm' => 'Ectoplasm',
		'midnight'  => 'Midnight',
		'ocean'     => 'Ocean',
		'sunrise'   => 'Sunrise',
		
	);
	
	if ( ! isset( $input['custom_scheme'] ) ) {
		
		$input['custom_scheme'] = null;
		
	}
	
	if ( ! array_key_exists( $input['custom_scheme'], $select_options ) ) {
		
		$input['custom_scheme'] = null;
	
	}
	
	return $input;
	
}
