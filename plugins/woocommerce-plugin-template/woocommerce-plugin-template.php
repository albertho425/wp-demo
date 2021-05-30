<?php

/**
 * Plugin Name:       Woocommerce Plugin Template
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       Woocommerce Plugin Template
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-plugin-template
 * Domain Path:       /languages
 */

 // Check that the WooCommerce plugin is active

 if ( in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    // only run if the class is unique.  If another plugin has this name, it won't run

    if ( ! class_exists('WC_Example')){
        
        class WC_Example{
        
            public function __construct(){
    
                // print a wordpress admin notice

                add_action('admin_notices', array( $this, 'print_admin_notice'));
            }

             public function print_admin_notice(){
        
            ?>
                <!-- Print success notice -->
                <div class="notice notice-success is-dismissible">
                    <p><?php _e( 'Success!', 'sample-text-domain' ); ?></p>
                </div>

                <!-- Print error notice -->
                <div class="notice notice-error is-dismissible">
                    <p><?php _e( 'Error!', 'sample-text-domain' ); ?></p>
                </div>

            <?php
        }
    }

        // in case we need to use this in the future

        $GLOBALS['wc_example'] = new WC_Example();
    }
}
