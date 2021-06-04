<?php 

// Core Functionality, available to the admin dashboard and the public login screen


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 *  custom login logo url
 */

function myplugin_custom_login_url( $url ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
		
		$url = esc_url( $options['custom_url'] );
		
	}
	
	return $url;
	
}
add_filter( 'login_headerurl', 'myplugin_custom_login_url' );



/**
 *  custom login logo title
 */

function myplugin_custom_login_title( $title ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
		
		$title = esc_attr( $options['custom_title'] );
		
	}
	
	return $title;
	
}
add_filter( 'login_headertitle', 'myplugin_custom_login_title' );

/**
 *  Custom login logo.  Note that you need to upload a logo called logo.png to your uploads folder via SFTP
 */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo site_url(); ?>/wp-content/uploads/logo.jpg);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );



/**
 *  Custom login styles
 */

function myplugin_custom_login_styles() {
	
	$styles = false;
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {
		
		$styles = sanitize_text_field( $options['custom_style'] );
		
	}
	
	if ( 'enable' === $styles ) {
		
		/*
		
		wp_enqueue_style( 
			string           $handle, 
			string           $src = '', 
			array            $deps = array(), 
			string|bool|null $ver = false, 
			string           $media = 'all' 
		)
		
		wp_enqueue_script( 
			string           $handle, 
			string           $src = '', 
			array            $deps = array(), 
			string|bool|null $ver = false, 
			bool             $in_footer = false 
		)
		
		*/
		
		wp_enqueue_style( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/myplugin-login.css', array(), null, 'screen' );
		
		// wp_enqueue_script( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/myplugin-login.js', array(), null, true );
		
	}
	
}
add_action( 'login_enqueue_scripts', 'myplugin_custom_login_styles' );



// custom login message
function myplugin_custom_login_message( $message ) {
	
	$options = get_option( 'myplugin_options', myplugin_options_default() );
	
	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
        
        //built-in wp function for sanitizing
		$message = wp_kses_post( $options['custom_message'] ) . $message;
		
	}
	
	return $message;
	
}
add_filter( 'login_message', 'myplugin_custom_login_message' );


