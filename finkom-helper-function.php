<?php
/*
 * Plugin Name: Finkom Helper Functions
 * Description: Add functionality used in Finkom theme
 * Author: Steffen Bang Nielsen
 * Author URI: http://retrofitter.dk
 * Text Domain: prakmed_fields_taxonomies
 * Version: 0.4

 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Load plugin textdomain.
*
* @since 1.0.0
*/
add_action( 'plugins_loaded', 'finkom_helper_functions_load_textdomain' );
function finkom_helper_functions_load_textdomain() {
	load_plugin_textdomain( 'finkom_helper_functions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// load includes
require_once plugin_dir_path( __FILE__ ) . 'inc/display_contact_information.php';


// load admin

require_once plugin_dir_path( __FILE__ ) . 'admin/customizer.php';
