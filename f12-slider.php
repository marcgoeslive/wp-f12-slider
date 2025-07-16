<?php
/**
 * Plugin Name: Forge12 Slider
 * Plugin URI: https://www.forge12.com
 * Description: Create a simple Slider
 * Version: v1.0
 * Author: Forge12 Interactive GmbH
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . "core/f12-slider-utils.php" );
require_once( plugin_dir_path( __FILE__ ) . "core/f12-slider-shortcode.php" );

if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . "admin/f12-slider-admin.php" );
}