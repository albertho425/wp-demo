<?php // MyPlugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


/**
 *  Display a welcome message for the login settings page
 */

 function myplugin_callback_section_login() {
	
	echo '<p>These settings enable you to customize the WP Login screen. Have a nice day.</p>';
	
}


/**
 *  callback: text field
 */

function myplugin_callback_field_text( $args ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';
	
}



/**
 *  Radio fields for enabling / disabling the custom CSS
 */

function myplugin_callback_field_radio( $args ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	$radio_options = array(
		
		'enable'  => 'Enable custom plugin stylesheet',
		'disable' => 'Disable custom plugin stylesheet'
		
	);
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = checked( $selected_option === $value, true, false );
		
		echo '<label><input name="myplugin_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}


/**
 *  Textarea field for custom login screen
 */

function myplugin_callback_field_textarea( $args ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<textarea id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';
	
}





