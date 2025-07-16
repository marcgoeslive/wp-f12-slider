<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class F12SliderMetaBoxGroup
 */
class F12SliderMetaBoxGroup {
	/**
	 * F12SliderMetaBoxGroup constructor.
	 */
	function __construct() {
		add_action( "add_meta_boxes", array( &$this, "add_meta_boxes" ) );
		add_action( "admin_enqueue_scripts", array( &$this, "enqueue_scripts" ) );
		add_action( "wp_ajax_f12s_slider_sort", array( &$this, "sort_values" ) );
	}

	/**
	 * Add metabox for Group
	 */
	public function add_meta_boxes() {
		add_meta_box(
			"f12s_slider_meta_box_group",
			"Slider Gruppe",
			array( &$this, "add_meta_boxes_html" ),
			"f12s_slider_group"
		);
	}

	/**
	 * Updating sort order
	 */
	public function sort_values() {

		$ids = explode( ",", $_POST["order"] );

		$i = 0;
		foreach ( $ids as $id ) {
			update_post_meta( $id, "f12-sort", $i );
			$i++;
		}

		wp_die();
	}

	/**
	 * Adding scripts
	 */
	public function enqueue_scripts() {
		global $typenow;

		if ( $typenow == "f12s_slider_group" ) {
			wp_enqueue_script( 'slider-reorder-js', plugins_url( '../assets/js/f12-reorder-slider.js', __FILE__ ), array(
				'jquery',
				'jquery-ui-sortable'
			) );
		}
	}


	/**
	 * HTML of the meta box
	 */
	public function add_meta_boxes_html() {
		global $post;

		$args = array(
			"f12s-slider-group" => F12Slider::get_slider_by_group_id( $post->ID ),
			"f12s-slider-group-id" => $post->ID
		);

		F12SliderUtils::loadAdminTemplate( "meta-box-slider-group.php", $args );
	}
}