<?php
/**
 *   Plugin Name: Example Contact Form with Ajax
 *   Plugin URI: https://maplesyrupweb.com
 *   Description: An example contact form with Ajax
 *   Version: 0.0.1
 *   Author: Maple Syrup Web
 *   Author URI: https://maplesyrupweb.com
 *   Text Domain: example-contact-form-ajax
 *   Domain Path: /lang
 */

 

/**
 *  Contact Form
 */

function maplesyrupweb_contact_form()
{
    
	$content = ''; 

    // submitting form through ajax so commenting out form
	// $content .= '<form method="post" action="" >';

    // Concatenate the content of the form to the varible
	$content .= '<style>.ajax_form label { display:block; padding:15px 0px 4px 0px; } .ajax_form input[type=text],input[type=email] { width:400px; padding:8px; } .ajax_form textarea { width:400px; height:200px; padding:8px;}</style>';

	$content .= '<div id="response_div"></div>';

	$content .= '<div class="ajax_form">';
	$content .= '<label for="your_name">Your Name</label>';
	$content .= '<input type="text" name="your_name" id="your_name" placeholder="Your Full Name" />';

	$content .= '<label for="your_email">Your Email Address</label>';
	$content .= '<input type="email" name="your_email" id="your_email" placeholder="Enter Your Email Address" />';

	$content .= '<label for="phone_number">Phone Number</label>';
	$content .= '<input type="text" name="phone_number" id="phone_number" placeholder="Your Phone Number" />';

	$content .= '<label for="your_comments">Comments</label>';
	$content .= '<textarea name="your_comments" id="your_comments" placeholder="Say something nice"></textarea>';

	$content .= '<br /><br /><input type="submit" name=" " id="contact_form_submit" onclick="submit_contact_form()" value="SUBMIT YOUR INFORMATION" />';

	$content .= '</div>';

    // submitting form through ajax so commenting out form
	//$content .= '</form>';

	return $content;



}

// 2nd argument must match the function name. 
// make sure the shortcode is unique and does not conflict with other plugins
add_shortcode('ajax_contact_form', 'maplesyrupweb_contact_form');


function maplesyrupweb_contact_form_js()
{
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://sitewpdevdev2live.local/wp-content/plugins/contact-form-ajax/js/contact-form-ajax.js"></script>
	<?php	
}

//2nd argument of add_action is the callback function
add_action('wp_footer','maplesyrupweb_contact_form_js');
