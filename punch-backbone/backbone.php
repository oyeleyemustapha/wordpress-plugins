<?php
/****
 * Plugin Name: Punch Backbone
 * Plugin URI: #
 * Description: This plugin manages the ads placements, insertions
 * Version: 1.2.0
 * Author: Punch Tech
 * Author URI: #
 * License: GPLv2 or later
 * 
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// $plugin_data    = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
// $plugin_version = ( ! empty( $plugin_data ) ) ? $plugin_data['Version'] : '1.0.0';

define( 'BKB_VERSION', '1.0' );
define( 'BKB__MINIMUM_WP_VERSION', '5.0' ); 
define( 'BKB__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
// defined( 'BKB_URL',  plugin_dir_url( __FILE__ ) );


function add_to_header(){
	include('inc/head-scripts.php');
} 
add_action( 'wp_head', 'add_to_header' );


require('inc/index.php');

require('inc/widgets/homepage.php');

require('templates/index.php');

