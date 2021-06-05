<?php // custom_admin - Settings Page


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 *  display the plugin settings page
 */

function custom_admin_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<!-- <?php settings_errors(); ?> -->

		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'custom_admin_options' );
			
			// output setting sections
			do_settings_sections( 'custom_admin' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php	
}

/**
 *  display admin notices
 */

function custom_admin_admin_notices() {
	
	settings_errors();
	
}
add_action( 'admin_notices', 'custom_admin_admin_notices' );