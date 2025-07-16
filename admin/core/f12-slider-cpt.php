<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12SliderCPT{
	/**
	 * Constructor
	 */
	public function __construct() {

		// Add actions
		add_action("init",array(&$this,"add_custom_post_types"));
	}

	/**
	 * Add custom post types to wordpress
	 */
	public function add_custom_post_types(){
		register_post_type("f12s_slider",array(
			'labels' => array(
				'name' => __('Slider'),
				'singular_name' => __('Slider')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'f12_slider'),
			'capability_type' => 'page',
			'show_in_menu' => "edit.php?post_type=f12s_slider_group",
			'supports' => array(
				"title",
				"revisions"
			)
		));
	}
}