<?php
/**
*Plugin Name: Maple Syrup Web
*Description: Some sample functionality
**/

    /**
     *  Display content to a page / post via shortcode.
     *  Add via plugin/ must-use plugin or child theme
     */

	function maplesyrupweb_example_function()
	{
        $content = '';


		$content .= "<div>This is a div</div>";
		$content .= "<p>This is a block of paragraph text.</p>";

		return $content;
	}
	add_shortcode('example','maplesyrupweb_example_function');

    //***************************************************************************** */

    /**
     *  Display content to a page / post via shortcode.
     *  Add via plugin/ must-use plugin or child theme
     */


	function maplesyrupweb_admin_menu_option()
	{
        add_menu_page('Header & Footer Scripts',
                      'Custom Scripts',
                      // users that can manage options can access 
                      'manage_options',
                       // slug
                       'maplesyrupweb-admin-menu',
                       // call back function
                      'maplesyrupweb_scripts_page',
                      // dashicons
                      'dashicons-admin-tools',200);
	}

	add_action('admin_menu','maplesyrupweb_admin_menu_option');

    //***************************************************************************** */

    /**
     *      Useful for gopgle analytics, google tag manager, jqeury etc.
     */

	function maplesyrupweb_scripts_page()
	{

        // if the form is submitted
        if(array_key_exists('submit_scripts_update',$_POST))
		{
			update_option('maplesyrupweb_header_scripts',$_POST['header_scripts']);
			update_option('maplesyrupweb_footer_scripts',$_POST['footer_scripts']);

			?>
			<div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Settings have been saved.</strong></div>
			<?php

		}

        //second value of get_option is the value to return if none
		$header_scripts = get_option('maplesyrupweb_header_scripts', 'none');
		$footer_scripts = get_option('maplesyrupweb_footer_scripts','none');


		?>
		<div class="wrap">
			<h2>Update Scripts</h2>
			<form method="post" action="">
                <label for="header_scripts">Header Scripts</label>
                <textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>
                <p>Paste in your code snippets to run in the <head> section</p><br><br>
                <label for="footer_scripts">Footer Scripts</label>
                <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts; ?></textarea><p>Paste in your code snippets to run before </body> section</p><br><br>
                <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS">
			</form>
		</div>	
		<?php
	}

    //*****************************************************************************

    /**
     *  Display the header scripts.  
     */

	function maplesyrupweb_display_header_scripts()
	{
        //$header_scripts = get_option('maplesyrupweb_header_scripts','none');
        $header_scripts = get_option('maplesyrupweb_header_scripts','none');

		print $header_scripts;
	}
   // add_action('wp_head','maplesyrupweb_display_header_scripts');
    
    //*****************************************************************************

    /**
     *  Display the footer scripts
     */


	function maplesyrupweb_display_footer_scripts()
	{
		$footer_scripts = get_option('maplesyrupweb_footer_scripts','none');
		print $footer_scripts;
	}
    //add_action('wp_footer','maplesyrupweb_display_footer_scripts');
    
    //*****************************************************************************

    /**
     *  Display the contact form.   Routes to a thank you page upon submission
     */


	function maplesyrupweb_form()
	{
		/* content variable */
		$content = '';

            // create a thank you page and also update the address to your wordpress address
            // Note we are using form method post instead of get
            
            $content .= '<form method="post" action="http://devsiteforweb.local/thank-you/">';

            
			$content .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
			$content .= '<br /><br />';

			$content .= '<input type="text"  name="email_address" placeholder="Email Address" />';
			$content .= '<br /><br />';

			$content .= '<input type="text" name="phone_number" placeholder="Phone Number" />';
			$content .= '<br /><br />';

			$content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
			$content .= '<br /><br />';

            $content .= '<input type="submit" name="maplesyrupweb_submit_form" value="SUBMIT" />';
            $content .= '<br /><br />';


		$content .= '</form>';

		return $content;
	}
	add_shortcode('maplesyrupweb_contact_form','maplesyrupweb_form');


    //*****************************************************************************

    /**
     *  Used for the contact form to send a form submission as HTML instead
     */

	function set_html_content_type()
	{
		return 'text/html';

	}

    //*****************************************************************************s

    /**
     *  Process the form submission
     */

	function maplesyrupweb_form_capture()
	{
        // know which post/page you are on
        global $post;
        
        // WordPress databse object
        global $wpdb;

		if(array_key_exists('maplesyrupweb_submit_form',$_POST))
		{
            // the email that the form will send to
            $to = "albert.cw.ho@gmail.com";
            
            // the subject of the email
			$subject = "Maplesyrup Web Form Submission";
			$body = '';

            // body of the email that comes from the form
			$body .= 'Name: '.$_POST['full_name'].' <br /> ';
			$body .= 'Email: '.$_POST['email_address'].' <br /> ';
			$body .= 'Phone: '.$_POST['phone_number']. ' <br /> ';
			$body .= 'Comments: '.$_POST['comments'].' <br /> ';


			add_filter('wp_mail_content_type','set_html_content_type');
            
            // wordpress mail function
			wp_mail($to,$subject,$body);

			remove_filter('wp_mail_content_type','set_html_content_type');

			/* Form submission to comments in the admin dashbaord */

			$time = current_time('mysql');

			$data = array(
			    'comment_post_ID' => $post->ID,
                'comment_content' => $body,
                //user IP address
			    'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
			    'comment_date' => $time,
			    'comment_approved' => 1,
			);

			wp_insert_comment($data);

			/* add the submission to the database using the table we created */ 

            // form submission to databse.  on a production site,
            // 1. use JavaScript on front end and 
            // 2. PHP on back end to ensure the data submitted is valid
            // 3. Use MySQL prepared statements
            
            // we are inserting into wp_form_submissions
             $insertData = $wpdb->get_results(" INSERT INTO ".$wpdb->prefix."form_submissions (data) VALUES ('".$body."') ");



		}

	}
	add_action('wp_head','maplesyrupweb_form_capture');





?>
