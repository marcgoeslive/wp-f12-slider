<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12SliderCPTGroup{
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
		register_post_type("f12s_slider_group",array(
			'labels' => array(
				'name' => __('Slider Gruppe'),
				'singular_name' => __('Slider'),
				'menu_name'     => __( 'Slider' )
			),
			'menu_icon' => 'dashicons-images-alt',
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'f12_slider_group'),
			'capability_type' => 'page',
			'supports' => array(
				"title",
				"revisions"
			)
		));
	}
}