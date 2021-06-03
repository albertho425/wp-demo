<?php

/**
 * Plugin Name:       Woocommerce Custom Product Info Page
 * Plugin URI:        https://maplesyrupweb.com
 * Description:       Woocommerce Custom Product Info Page for front and back end
 * Version:           1.0.0
 * Author:            Maple Syrup Web
 * Author URI:        https://maplesyrupweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       woocommerce-custom-product-info-page
 * Domain Path:       /languages
 */

 // Check that the WooCommerce plugin is active

 if ( in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // only run if the class is unique.  If another plugin has this name, it won't run

    if ( ! class_exists('WC_Product_page')){

        /**
         *  Class for a Woocommerce Product Page
         */

        class WC_Product_page{

            public function __construct(){

              add_action('init', array ($this, 'change_my_product_page'));

              // add a tab to the front page oa a product
              add_filter('woocommerce_product_tabs', array($this, 'additional_info_tab'));

              // limit length of tital for display consistency
              add_filter('the_title', array($this, 'shorten_product_title'), 20, 2);

              add_filter('woocommerce_product_data_tabs', array($this, 'my_product_data_tab'), 20);
              add_action('woocommerce_product_data_panels', array($this, 'woocommerce_product_data_panels'));

              //this action fires when extra product info is being saved
              //parameter 2 at the end because 2 parameters

              //follow Woocoomerce's way of saving data in a static way
              add_action('woocommerce_process_product_meta', 'WC_Product_page::save', 20, 2);

            }

            /**
             *  Adjust the order of inforation display on the a single product page
             */

            public function change_my_product_page() {

              remove_action('woocommerce_single_product_summary','woocommerce_template_single_price', 10 );

              add_action('woocommerce_single_product_summary','woocommerce_template_single_price', 25);
            }

            /**
             *  limit length of title for display consistency
             */

            public function shorten_product_title( $the_title, $id ){

                //if it's a WooCommerce product shop page, and title is a product title, not a post title

                //second condition is a yoda condition
                if(is_shop() && 'product' == get_post_type($id) ){
                    $the_title = wp_trim_words($the_title, 2);
                }
                return $the_title;
            }

            /**
             *  Add a new tab to a single product page
             */

            public function additional_info_tab( $tabs ){
                // add a new tabs
                $tabs['assembly_tab'] = array(
                    'title'     => __('Additional Info', 'woocommerce-product-pages'),
                    'priority'  => '50',
                    'callback'  => array( $this, 'additional_info_tab_content')
                );
                return $tabs;
            }

            /**
             *   The Additional info tab content on the front end
             */

            public function additional_info_tab_content(){

                global $post;

                $product = new WC_Product($post->ID);

                // get the instructions from the database
                // $instructions_url = $product->__get('additional_infos');

                $instructions_url = $product->get_meta('_additional_info');

                $consult_choice = $product->get_meta('_select');

                $duration = $product->get_meta('_assembly_duration');

                echo '<h2>Additional Info</h2>';
                ?>
                <p>Assembly Instructions: <?php echo ($instructions_url != "") ? $instructions_url : "N/A" ;?></p>
                <p>Assembly Support: <?php echo ($consult_choice != "") ? $consult_choice :  "N/A";?></p>
                <p>Assembly Duration: <?php echo ($duration != "") ? $duration : "N/A";?></p>

                <?php


                // to do: additional content here:
            }
    
            /**
            *  Data tab for a product
            */

            public function my_product_data_tab( $product_data_tabs ){

                //use Woocommerce class-wc-meta-box-product.php as a reference. located in includes/admin/meta-boxes
            
                $product_data_tabs[''] = array(
                'label'  => __( 'Additional info', 'additional_info' ),
                'target' => 'assembly_product_data',
                'class'  => array()
                );

                return $product_data_tabs;
            }

           /**
            *  Updadate the post meta data when user hits the save button
            */

            public static function save( $post_id, $post ){

                $product = new WC_Product($post_id);

                if (isset($_POST['_additional_info'])){

                    // 1st param is the same as above, 2nd param is the value
                    $product->update_meta_data('_additional_info',
                    $_POST['_additional_info']);
                }

                // check wc-formatting-functions.php for validation and formatting so we don't have to remmake froms scratch


                if (isset($_POST['_assembly_duration'])){
                    $product->update_meta_data('_assembly_duration',
                    $_POST['_assembly_duration']);
                }

                if (isset($_POST['_select'])){
                    $product->update_meta_data('_select',
                    $_POST['_select']);
                }

                $product->save();


                // for older versions of WooCommerce
                // if( isset( $_POST['_additional_info'])){
                //     update_post_meta($post_id, '_additional_info', wc_clean($_POST['_additional_info']));
                // }

                // if( isset( $_POST['_my_price'])){
                //     update_post_meta($post_id, '_my_price', wc_clean($_POST['_my_price']));
                // }
                // if( isset( $_POST['_select'])){
                //     update_post_meta($post_id, '_select', wc_clean($_POST['_select']));
                // }
            }

            

            /**
             *  The form for the additional data tab
             *  Note: reference html-product-data-panel.php and html-product-data-general in includes/admin/meta-boxes/views 
             */

            public function woocommerce_product_data_panels(){

                //disable PHP because of HTML
                ?>
                <div id='assembly_product_data' class='panel woocommerce_options_panel'>

                    <?php
                    woocommerce_wp_text_input( array(
        				'id'          => '_additional_info',
        				'label'       => __( 'Additional Information', 'additional_info' ),
        				'placeholder' => 'https://',
        				'description' => __( 'Enter the url of the Additional info', 'additional_info' ),
                    ) );

                    // reference wc-meta-box-functions.php

                    woocommerce_wp_select( array(
        				'id'          => '_assembly_duration',
        				'label'       => __( 'Assembly Duration', 'additional_info2' ),
                        'description' => __( 'Select the duration time for assembly', 'additional_info2' ),

                        
                        'options' => array(
                            '1 Hour' => __('1 Hour', 'additional_info2'),
                            '2 Hours' => __('2 Hours', 'additional_info2'),
                            '3 Hours' => __('3 Hours', 'additional_info2'),
                            '4 Hours' => __('4 Hours', 'additional_info2'),
                            '5 Hours' => __('5 Hours', 'additional_info2')
                        )

        			) );

                    woocommerce_wp_select( array(
        				'id'          => '_select',
                        'label'       => __( 'Assembly Options', 'additional_info3' ),
                        'description' => __( 'Select the type of support offered', 'additional_info3' ),

        				'options' => array(
                            'DIY' => __('DIY', 'additional_info3'),
                            'DIY with Email Consult' => __('DIY with Email Consult', 'additional_info3'),
                            'DIY with Video Support' => __('DIY with Video Support', 'additional_info3')
                        )

                    ) );

                    ?>
                </div>
                <?php
            }




      } //class

      // in case we need to use this in the future
      $GLOBALS['wc_product_page'] = new WC_Product_page();
  } //if

} //if
