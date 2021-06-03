<?php

/**
 * Plugin Name:       Woocommerce Custom Order Status
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       Woocommerce Custom Order Status. Adding a custom order status to an order.
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-custom-order-status
 * Domain Path:       /languages
 */

// Check to make sure WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // only run if there's no other class with this name
    if ( ! class_exists('WC_Customizing_Status')){
        class WC_Customizing_Status{

            /**
             *  Constructor
             */

            public function __construct(){
                add_action('init', array($this, 'register_custom_order_status'));
                add_filter('wc_order_statuses', array($this, 'add_customizing_to_order_statuses'));
                add_action('admin_footer', array($this, 'customizing_order_status_style'));
                add_action('woocommerce_order_status_changed', array($this, 'customizing_status_message'), 1, 3);
            }

            /**
             *  Register the new order status "Customizing" in admin menu
             */

            public function register_custom_order_status(){
                register_post_status('wc-customizing', array(
                    'label'     => 'Customizing',
                    'public'    => true,
                    'exclude_from_search'   => false,
                    'show_in_admin_all_list'    => true,
                    'show_in_admin_status_list' => true,
                    'label_count'   => _n_noop(
                        'Customizing <span class="count">(%s)</span>',
                        'Customizing <span class="count">(%s)</span>')
                ));

            }

            /**
             *  Add the new order status "Customizing" to admin menu
             */

            public function add_customizing_to_order_statuses( $order_statuses){
                $new_order_statuses = array();

                //add new order status _after_ processing
                foreach($order_statuses as $key => $status){
                    $new_order_statuses[$key] = $status;
                    if ('wc-processing' === $key ) {
                        $new_order_statuses['wc-customizing'] = 'Customizing';
                    }
                    
                }
                return $new_order_statuses;
            }

            /**
             *  For small ammount of CSS it's ok to add here.  For large amount, add a CSS file and then include it
            */
          
            public function customizing_order_status_style() {
                ?>
                <style>

                
                     .order-status.status-customizing.tips {
                    background: #fc0;
                    color: black;
                    }
                
                </style>
                <?php 
            }

        /**
         *  Email the status message to the user
         */
        
        public function customizing_status_message( $order_id, $old_status, $new_status ){
            
            global $woocommerce;

            if( 'customizing' == $new_status ) {
                $order = new WC_Order($order_id);

                // load the mailer
                $mailer = WC()->mailer();

                // set the content
                $subject = 'Your Order is being customized!';
                $message_body = "Your Order is being customized to exactly the way that you want it"; 
                $message = $mailer->wrap_message( $subject, $message_body );

                // send the message using Woocommerce amil function.  could also use wp_mail
                $mailer->send( $order->billing_email, $subject, $message);
            }
        }

    }  

        // In case we need to access it in the future

        $GLOBALS['WC_Customizing_Status'] = new WC_Customizing_Status();
    }
}
