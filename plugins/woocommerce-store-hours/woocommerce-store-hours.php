<?php

/**
 * Plugin Name:       Woocommerce Opening Hours 
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       Control when your store is open
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-store-hours
 * Domain Path:       /languages
 */


// Check to make sure WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // only run if there's no other class with this name
    if ( ! class_exists('WC_Opening_Hours')){
        class WC_Opening_Hours{
            public function __construct(){
                add_filter('woocommerce_settings_tabs_array', array( $this, 'add_settings_tab'), 50);
                add_action('woocommerce_settings_opening_hours', array( $this, 'add_settings'), 10);
                add_action('woocommerce_update_options_opening_hours', array( $this, 'update_settings'), 10);
                add_action('wp', array ($this, 'maybe_disable_checkout'));
            }

        /**
         *  Add custom hours tab in WooCommerce settings
         */
        public function add_settings_tab($settings_tabs){
            $settings_tabs['opening_hours'] = __('Opening Hours', 'woocommerce-opening-hours');
            return $settings_tabs;
        }

        /**
         *  Add the custom settings tab in WooCommerce settings
         */
        
        public function add_settings(){
            woocommerce_admin_fields( self::get_settings() );
        }

        /**
         *  Save and update the settings
         */
        
        public function update_settings(){
            woocommerce_update_options( self::get_settings() );
        }

        /**
         *  Disable the checkout if religious holiday or other specified reason and redirect to the correct page
         */
    

        public function maybe_disable_checkout(){

            //get_option gets data out of the WP options table

            $disable_checkout_sundays = get_option('wc_settings_closed_sundays') == 'yes' ? true : false;

            $disable_checkout_maintenance = get_option('wc_settings_closed_maintenace') == 'yes' ? true : false;

            $disable_checkout_employee_sick = get_option('wc_settings_closed_sick') == 'yes' ? true : false;

            // check if the setting is checked and it's saturday
            // TODO actually check that it's saturday

            // https://docs.woocommerce.com/document/conditional-tags/

            if($disable_checkout_sundays && TRUE && is_checkout()){
                
                //194 is the page ID
                wp_safe_redirect(get_permalink(194));
            }

            else if($disable_checkout_maintenance && TRUE && is_checkout()){
                
                //199 is the page ID
                wp_safe_redirect(get_permalink(199));
            }

            else if ($disable_checkout_employee_sick && TRUE && is_checkout()){
                
                //200 is the page ID
                wp_safe_redirect(get_permalink(200));
            }
        }


        /**
         *  Get the settings
         */
        
        public function get_settings(){
            $settings = array(
                'section_title' => array(
                    'name'          => __( 'Store Hours', 'woocommerce-opening-hours'),
                    'type'          => 'title',
                    'desc'          => 'Please choose a reason for the checkout being closed',
                    'id'            => 'wc_settings_opening_hours_section_title'
                ),
                'checkout_disabled' => array(
                    'name'          => __( 'Closed on Sundays', 'woocommerce-opening-hours'),
                    'type'          => 'checkbox',
                    'desc'          => __('For religious reasons', 'woocommerce-opening-hours'),
                    'id'            => 'wc_settings_closed_sundays'
                ),

                'checkout_disabled2' => array(
                    'name'          => __( 'Closed for maintenanace', 'woocommerce-opening-hours'),
                    'type'          => 'checkbox',
                    'desc'          => __('Closed for maintenanace', 'woocommerce-opening-hours'),
                    'id'            => 'wc_settings_closed_maintenace'
                ),

                'checkout_disabled3' => array(
                    'name'          => __( 'Closed for employee sickness', 'woocommerce-opening-hours'),
                    'type'          => 'checkbox',
                    'desc'          => __('Closed for employee sick leave', 'woocommerce-opening-hours'),
                    'id'            => 'wc_settings_closed_sick'
                ),

                'section_end' => array(
                    'type'          => 'sectionend',
                    'id'            => 'wc_settings_opening_hous_section_end'
                )
            );
            return $settings;
        }

        }
        $GLOBALS['wc_opening_hours'] = new WC_Opening_Hours();
    }
}
