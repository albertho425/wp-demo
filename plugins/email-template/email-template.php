<?php 
/**
* Plugin Name: Maple Syrup Web Email Template
* Plugin URI: https://maplesyrupweb.com
* Description: Email Template for Contact forms, form submissions, new users, etc.
* Version: 0.0.1
* Author: Maple Syrup Web
* Author URI: https://maplesyrupweb.com
* Text Domain: maplesyrupweb-email-template
**/

/**
 *  Format text email to HTML email
 */

function maplesyrupweb_content_filter()
{
	return "text/html";
}

/**
 *   Replace the message placeholder with the actual message and template
 */

function maplesyrupweb_email_filter($args)
{

    // call the email template function
	$template = maplesyrupweb_email_template();

    //replace "[message]" in line 70 with the message coming into the function and the template
    $args['message'] = str_replace("[message]",$args['message'],$template);
    

	add_filter('wp_mail_content_type','maplesyrupweb_content_filter');

	return $args;
}
// wp_mail function, callback function, default priority is 10, 1 the number of arguments
add_filter('wp_mail','maplesyrupweb_email_filter',10,1);

/**
 *  Template that contains markup, styling and body of the email.  Returns the HTML content of the email.
 */

function maplesyrupweb_email_template()
{
	$info = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
       <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Maple Syrup Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      </head>';

  $info .= '<body style="margin: 0; padding: 0px 0px 150px 0px; background-color:#e7e7e7;">';

  $info .= '<table border="0" cellpadding="0" cellspacing="0" style="background-color:#e7e7e7; width:775px; max-width:90%; margin:0 auto;" >';

  $info .= '<tr><td style="padding: 20px 0px 20px 0px;">';
  
  //your logo here
  $info .= 'Maple Syryp Web <img src="" width="100px" height="100px" />';
  $info .= '</td></tr>';

  $info .= '<tr><td style="padding: 60px 30px 60px 30px; background-color:#FFFFFF; text-align:left; font-size:14px; color:#656565;">';
  //email message is here
  $info .= '[message]';
  $info .= '</td></tr>';

  $info .= '<tr><td style="text-align:center; font-size:10px; padding:30px 0px 0px 0px; color:#656565;">';


  $info .= '&copy; '.date("Y").' Maple Syrup Web';
          
  $info .= '</td></tr>';
  $info .= '<tr><td style="text-align:center; font-size:10px; padding:10px 0px 0px 0px; color:#656565;">';
 
   // If you have social media links, include them below
   // $info .= 'Social media links';

  $info .= '</td></tr>';

  $info .= '</table>';


  $info .= '</body></html>';

  return $info;
}

?>
