<?php // Custom Admin Dashboard - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


/**
 *  Display a welcome message for the admin settings page
 */

function custom_admin_callback_section_admin() {
	
	echo '<p>These settings enable you to customize the WP Admin Area. Have a good</p>';
	
}


/**
 *  Callback: Checkbox field
 */

function custom_admin_callback_field_checkbox( $args ) {
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	
	echo '<input id="custom_admin_options_'. $id .'" name="custom_admin_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="custom_admin_options_'. $id .'">'. $label .'</label>';
	
}


/**
 *  Callback: Text field
 */
function custom_admin_callback_field_text( $args ) {
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="custom_admin_options_'. $id .'" name="custom_admin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="custom_admin_options_'. $id .'">'. $label .'</label>';
	
}


/**
 *  Callabck: Dropdown select field
 */

function custom_admin_callback_field_select( $args ) {
	
	$options = get_option( 'custom_admin_options', custom_admin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
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
	
	echo '<select id="custom_admin_options_'. $id .'" name="custom_admin_options['. $id .']">';
	
	foreach ( $select_options as $value => $option ) {
		
		$selected = selected( $selected_option === $value, true, false );
		
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
		
	}
	
	echo '</select> <label for="custom_admin_options_'. $id .'">'. $label .'</label>';
	
}




