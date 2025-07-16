<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12SliderMetaBox {
	/**
	 * Constructor
	 */
	public function __construct() {
		// actions
		add_action( "admin_init", 'wp_enqueue_media' );
		add_action( "admin_enqueue_scripts", array( &$this, "add_custom_scripts" ) );
		add_action( "add_meta_boxes", array( &$this, "add_meta_box_slider" ) );
		add_action( 'save_post', array( &$this, "save_meta_box_slider" ) );
		add_action( 'trashed_post', array( &$this, "trashed_post" ) );
	}

	public function trashed_post() {
		$group_id = isset( $_GET["f12s-slider-group-id"] ) ? $_GET["f12s-slider-group-id"] : - 1;
		if ( $group_id !== - 1 ) {
			$redirect = get_edit_post_link( $group_id, "intern" );
			wp_redirect( $redirect );
			exit;
		}
	}

	public function add_custom_scripts() {
		if ( ! wp_style_is( "f12-admin-style", "enqueued" ) ) {
			wp_enqueue_style( "f12-admin-style", plugin_dir_url( __FILE__ ) . "../assets/css/f12-admin-style.css" );
		}

		if ( ! wp_script_is( "f12-admin-script", "enqueued" ) ) {
			wp_enqueue_script( "f12-admin-script-form-validate", plugin_dir_url( __FILE__ ) . "../assets/js/f12-admin-script-form-validate.js", array( "jquery" ) );
			wp_enqueue_script( "f12-admin-script", plugin_dir_url( __FILE__ ) . "../assets/js/f12-admin-script.js", array( "jquery" ) );
		}

		if ( ! wp_script_is( "f12-slider-media-picker", "enqueued" ) ) {
			wp_register_script( "f12-slider-media-picker", plugins_url( '../assets/js/f12-slider-media-picker.js', __FILE__ ), array( "jquery" ), false, true );
			wp_enqueue_script( "f12-slider-media-picker" );
		}

		if ( ! wp_script_is( "f12-slider-type-picker", "enqueued" ) ) {
			wp_register_script( "f12-slider-type-picker", plugins_url( "../assets/js/f12-slider-type-picker.js", __FILE__ ), array( "jquery" ), false, true );
			wp_enqueue_script( "f12-slider-type-picker" );
		}

		if ( ! wp_script_is( "f12-slider-colorpicker", "enqueued" ) ) {
			wp_register_script( "f12-slider-colorpicker", plugins_url( "../assets/js/f12-slider-colorpicker.js", __FILE__ ), array( "jquery" ), false, true );
			wp_enqueue_script( "f12-slider-colorpicker" );
		}

		if ( ! wp_style_is( "f12-form-validate", "enqueued" ) ) {
			wp_enqueue_style( "f12-form-validate", plugin_dir_url( __FILE__ ) . "../assets/css/f12-form-validate.css" );
		}

		if(!wp_style_is("f12-slider-style","enqueued")){
			wp_enqueue_style( "f12-slider-style", plugin_dir_url( __FILE__ ) . "../assets/css/f12-slider-style.css" );
		}

		// Add the color picker css file
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Hooked into add_meta_boxes to create
	 * an additional metabox for the Slider
	 */
	public function add_meta_box_slider() {
		add_meta_box(
			"f12s_meta_box_slider_content",
			"Informationen",
			array( &$this, "add_meta_box_slider_content_html" ),
			"f12s_slider"
		);

		add_meta_box(
			"f12s_meta_box_slider_image",
			"Bild",
			array( &$this, "add_meta_box_slider_image_html" ),
			"f12s_slider"
		);

		add_meta_box(
			"f12s_meta_box_slider_type_a",
			"Typ A",
			array( &$this, "add_meta_box_slider_type_a_html" ),
			"f12s_slider"
		);

		add_meta_box(
			"f12s_meta_box_slider_type_b",
			"Typ B",
			array( &$this, "add_meta_box_slider_type_b_html" ),
			"f12s_slider"
		);
	}


	/**
	 * Save the content of the metabox slider
	 */
	public function save_meta_box_slider() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['f12s_slider_nonce'] ) && wp_verify_nonce( $_POST['f12s_slider_nonce'], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			$f12s_slider_group = isset( $_POST['f12s-slider-group'] ) ? $_POST['f12s-slider-group'] : - 1;
			$type              = isset( $_POST['type'] ) ? $_POST['type'] : "a";
			$image             = isset( $_POST['image'] ) ? sanitize_text_field( $_POST['image'] ) : "";
			$row_1             = isset( $_POST['row_1'] ) ? sanitize_text_field( $_POST['row_1'] ) : "";
			$row_2             = isset( $_POST['row_2'] ) ? sanitize_text_field( $_POST['row_2'] ) : "";
			$title             = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : "";
			$content           = isset( $_POST['content'] ) ?  $_POST['content']  : "";
			$button_label      = isset( $_POST['button_label'] ) ? sanitize_text_field( $_POST['button_label'] ) : "";
			$button_title      = isset( $_POST['button_title'] ) ? sanitize_text_field( $_POST['button_title'] ) : "";
			$button_link       = isset( $_POST['button_link'] ) ? $_POST['button_link'] : - 1;
			$f12_sort          = isset( $_POST["f12-sort"] ) ? $_POST["f12-sort"] : 0;
			$is_quote          = isset( $_POST["is_quote"] ) ? $_POST["is_quote"] : 0;
			$author            = isset( $_POST["quote_author"] ) ? $_POST["quote_author"] : "";
			$gradient_color_1 = isset($_POST["f12-gradient-color-1"]) ? $_POST["f12-gradient-color-1"] : "";
			$gradient_color_2 = isset($_POST["f12-gradient-color-2"]) ? $_POST["f12-gradient-color-2"] : "";

			update_post_meta( $post_id, "type", $type );
			update_post_meta( $post_id, "row_1", $row_1 );
			update_post_meta( $post_id, "row_2", $row_2 );
			update_post_meta( $post_id, "image", $image );
			update_post_meta( $post_id, "title", $title );
			update_post_meta( $post_id, "content", $content );
			update_post_meta( $post_id, "button_label", $button_label );
			update_post_meta( $post_id, "button_title", $button_title );
			update_post_meta( $post_id, "button_link", $button_link );
			update_post_meta( $post_id, "f12s-slider-group", $f12s_slider_group );
			update_post_meta( $post_id, "f12-sort", $f12_sort );
			update_post_meta( $post_id, "is-quote", $is_quote );
			update_post_meta( $post_id, "quote_author", $author );
			update_post_meta($post_id, "f12-gradient-color-1",$gradient_color_1);
			update_post_meta($post_id, "f12-gradient-color-2",$gradient_color_2);

			wp_redirect( "post.php?post=" . $f12s_slider_group . "&action=edit" );
			exit;
		}
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_slider_content_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$group_id = F12SliderUtils::get_field( $stored_meta_data, "f12s-slider-group", - 1 );

		if ( isset( $_GET['f12s-slider-group-id'] ) && $group_id == - 1 ) {
			$group_id = $_GET["f12s-slider-group-id"];
		}


		$args = array(
			"wp_nonce_field"    => wp_nonce_field( basename( __FILE__ ), "f12s_slider_nonce" ),
			"type"              => F12SliderUtils::get_field( $stored_meta_data, "type", "a" ),
			"f12s-slider-group" => F12SliderGroup::get_option_list( $group_id ),
			"f12-sort"          => F12SliderUtils::get_field( $stored_meta_data, "f12-sort", 0 ),
		);

		F12SliderUtils::loadAdminTemplate( "meta-box-slider.php", $args );
	}

	/**
	 * The output for the Image Metabox as HTML
	 */
	public function add_meta_box_slider_image_html() {
		global $post;
		add_thickbox();

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			"image" => ! empty( $stored_meta_data['image'] ) ? $stored_meta_data['image'][0] : "",
			"f12-gradient-color-1" => ! empty( $stored_meta_data['f12-gradient-color-1'] ) ? $stored_meta_data['f12-gradient-color-1'][0] : "",
			"f12-gradient-color-2" => ! empty( $stored_meta_data['f12-gradient-color-2'] ) ? $stored_meta_data['f12-gradient-color-2'][0] : ""
		);

		F12SliderUtils::loadAdminTemplate( "meta-box-slider-image.php", $args );
	}

	/**
	 * The output for the Type B
	 */
	public function add_meta_box_slider_type_b_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$button_link       = F12SliderUtils::get_field( $stored_meta_data, "button_link", - 1 );
		$option_list_pages = F12SliderUtils::get_option_list_pages( $button_link );

		$args = array(
			"title"        => F12SliderUtils::get_field( $stored_meta_data, "title" ),
			"content"      => F12SliderUtils::get_field( $stored_meta_data, "content" ),
			"button_title" => F12SliderUtils::get_field( $stored_meta_data, "button_title" ),
			"button_label" => F12SliderUtils::get_field( $stored_meta_data, "button_label" ),
			"button_link"  => $option_list_pages,
			"is_quote"     => F12SliderUtils::get_field( $stored_meta_data, "is-quote", false ),
			"quote_author" => F12SliderUtils::get_field( $stored_meta_data, "quote_author", "" )
		);

		F12SliderUtils::loadAdminTemplate( "meta-box-slider-type-b.php", $args );
	}

	/**
	 * The output for the Type A
	 */
	public function add_meta_box_slider_type_a_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			"row_1" => F12SliderUtils::get_field( $stored_meta_data, "row_1" ),
			"row_2" => F12SliderUtils::get_field( $stored_meta_data, "row_2" )
		);

		F12SliderUtils::loadAdminTemplate( "meta-box-slider-type-a.php", $args );
	}
}