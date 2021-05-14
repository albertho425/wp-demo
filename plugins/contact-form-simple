<?php
/*
Plugin Name: Example Contact Form
Plugin URI: https://maplesyrupweb.com
Description: An example contact form
Version: 0.0.1
Author: Maple Syrup Web
Author URI: https://maplesyrupweb.com
Text Domain: Example Contact Form
Domain Path: /lang
*/
 function contact_form_plugin()
{

    $content = '';
    
    //type your web address
    $content .= '<form method="post" action="http://advanced-custom-fields-demo.local/thank-you/"';
    $content .= '<br><label for="your_name">Name</label>';
    $content .= '<input type = "text" name = "your_name" class="form-control" placeholder="Type your name"><br/>';

    $content .= '<br><label for="your_email">Email</label>';
    $content .= '<input type = "email" name = "your_email" class="form-control" placeholder="Type your email"><br/>';

    $content .= '<br><label for="your_message">Message</label>';
    $content .= '<textarea name = "your_message" class="form-control" placeholder="Type your message"></textarea><br/>';

    $content .= '<br><input type="submit" name="contact_form_submit" class="btn btn-lg btn-danger" value="Submit Message">';
    $content .= '</form>';    
    return $content;

 }
 add_shortcode('conatct_form', 'contact_form_plugin');

 function contact_form_capture() {

    if (isset($_POST['contact_form_submit']))
    {
    
        $name = sanitize_text_field($_POST['your_name']);
        $email = sanitize_text_field($_POST['your_email']);
        $message = sanitize_text_field($_POST['your_message']);
    
    $to = $email;

    $subject = 'Contact Form';

    $body = "Name: $name \n\nEmail: $email \n\nMessage: $message";

    $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;


    wp_mail($email, $subject, $body, $headers);
    } 
 }
 add_action('wp_head', 'contact_form_capture');

?>
