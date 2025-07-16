<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Includes
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-group.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-cpt-group.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-metabox.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-metabox-group.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-slider-options.php" );

/**
 * Class F12SliderAdmin
 */
class F12SliderAdmin {
	// Custom Post Types
	private $F12SliderCPT;
	private $F12SliderMetaBox;
	private $F12SliderCPTGroup;
	private $F12SliderMetaBoxGroup;
	private $F12Options;

	public function __construct() {
		$this->F12SliderCPT          = new F12SliderCPT();
		$this->F12SliderCPTGroup     = new F12SliderCPTGroup();
		$this->F12SliderMetaBox      = new F12SliderMetaBox();
		$this->F12SliderMetaBoxGroup = new F12SliderMetaBoxGroup();
		$this->F12Options            = new F12SliderOptions();

		// Actions
		add_action( "admin_menu", array( &$this, "admin_menu" ) );
	}

	public function admin_menu() {
		add_submenu_page( "edit.php?post_type=f12s_slider_group", "Einstellungen", "Einstellungen", "manage_options", "f12s_slider_settings", array(
			&$this->F12Options,
			"render"
		) );
	}

}

new F12SliderAdmin();