<?php


/**
 *  Plugin Name: Example Contact Form to email, database, and comments
 *   Plugin URI: https://maplesyrupweb.com
 *   Description: An example contact form tha sends to email, database, and comments
 *   Version: 0.0.1
 *   Author: Maple Syrup Web
 *   Author URI: https://maplesyrupweb.com
 *   Text Domain: Example Contact Form
 *   Domain Path: /lang
 */


function maplesyrupweb_form()
{
    /* content variable */
    $content = '';

    
    // create a thank you page and also update the address to your wordpress address
    // Note we are using form method post instead of get
    $content .= '<form method="post" action="http://devsiteforweb.local/thank-you/">';

    //generate the HTML for the form
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

// this is the shortcode for the form.  use the short code in page/post/widget
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
