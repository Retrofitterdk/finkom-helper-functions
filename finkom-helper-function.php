<?php
/*
* Plugin Name: Finkom Helper Functions
* Description: Add functionality used in Finkom theme
* Author: Steffen Bang Nielsen
* Author URI: http://retrofitter.dk
* Text Domain: finkom_helper_functions
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
// require_once plugin_dir_path( __FILE__ ) . 'inc/display_contact_information.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/pages.php';

// load admin
require_once plugin_dir_path( __FILE__ ) . 'admin/customizer.php';

// load plugin dependent functions
function fhf_plugin_dependency_check() {
	if ( class_exists( 'CCP_Plugin' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'inc/custom_content_portfolio.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/portfolio-shortcode.php';
}
	if ( class_exists( 'Woothemes_Our_Team' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'inc/team-members.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/team-member-shortcode.php';
		require_once plugin_dir_path( __FILE__ ) . 'admin/team-settings.php';
	}
	if (class_exists('Woothemes_Features')) {
		require_once plugin_dir_path( __FILE__ ) . 'inc/features.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/feature-shortcode.php';
		require_once plugin_dir_path( __FILE__ ) . 'admin/feature-settings.php';
	}
}
add_action( 'plugins_loaded', 'fhf_plugin_dependency_check' );
