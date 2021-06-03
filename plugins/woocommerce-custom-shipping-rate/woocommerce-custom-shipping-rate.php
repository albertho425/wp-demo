<?php

/**
 * Plugin Name:       Woocommerce 1-Day Shipping
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       Woocommerce 1-Day Shipping
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-one-day-shipping
 * Domain Path:       /languages
 */

 // Check that the WooCommerce plugin is active

 // Check to make sure WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
 
    // only run if there's no other class with this name
    if ( ! class_exists('WC_Fastest_Shipping')){
 
        class WC_Fastest_Shipping{
 
            /**
             *  Constructor
             */

            public function __construct(){
                add_action('woocommerce_flat_rate_shipping_add_rate', array($this, 'fastest_shipping'), 10, 2);
            }

            /**
             *   Update the cost and show on the front end when checking out
             */

            public function fastest_shipping($method, $rate){
                $new_rate = $rate;
                $new_rate['id'] .= ':' . 'fastest_rate';
                $new_rate['label'] = '1 Day shipping';
                $new_rate['cost'] += $new_rate['cost'];

                //WooCommerce method
                $method->add_rate( $new_rate );
            }

        }
        $GLOBALS['wc_fastest_shipping'] = new WC_Fastest_Shipping();
    }
}
