<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Options
 */
class F12SliderOptions {
	/**
	 * F12SliderOptions constructor.
	 */
	public function __construct() {
		// Add actions
		add_action( "admin_init", array( &$this, "register_settings" ) );
		add_action( "admin_init", array( &$this, "enqueue_scripts" ) );
		add_action( "admin_post_f12s_slider_settings_save", array( &$this, "save" ) );
	}


	public function enqueue_scripts() {
		wp_enqueue_script( 'f12s_slider_uploadscript', plugin_dir_url( __FILE__ ) . "../assets/js/f12-slider-image-picker.js", array( "jquery" ), null, false );
	}

	public function save() {
		wp_redirect( add_query_arg( array(
			"page"      => "f12s_slider_settings",
			"post_type" => "f12s_slider_group"
		), "edit.php" ) );

		$reference_quote_default_image = isset( $_POST["slider-responsive-default-image"] ) ? $_POST["slider-responsive-default-image"] : "";

		// Update Data
		update_option( "f12s_slider_settings", array(
			"slider-responsive-default-image" => $reference_quote_default_image
		) );
	}

	public function register_settings() {
		// Default settings
		add_option( "f12s_slider_settings", array(
			"slider-responsive-default-image" => "",
		) );
	}

	/**
	 * @param $name
	 * @param string $value
	 *
	 * @return string
	 */
	public function image_uploader_field( $name, $value = "" ) {
		if ( ! is_array( $value ) ) {
			$value = array( $value );
		}

		if ( is_array( $value ) ) {
			$output = '
			<div>
				<a href="#" data-key-output=".f12l-image-galerie" data-key-id="' . $name . '" class="f12s_upload_image_button button">Upload image</a>
				<div class="f12l-image-galerie">
			';

			foreach ( $value as $key => $id ) {
				if ( ! empty( $id ) ) {
					$image = wp_get_attachment_image_src( $id );

					$output .= '
					<div data-key="' . $id . '">
						<img class="true_pre_image" src="' . $image[0] . '" style="max-width:30%;display:block;">
						<a href="#" class="f12s_remove_image_button">Bild entfernen</a>
						<input type="hidden" class="f12-form-validate" validation=\'{"validation":{"required":true}}\' name="' . $name . '" value="' . $id . '">
				</div>';
				}
			}

			$output .= '</div></div>';
		}

		return $output;
	}

	/**
	 * Output the Settings page
	 */
	public function render() {
		$args = array(
			//"reference_quote_default_image"                        => get_option("f12r_reference_settings" )["reference_quote_default_image"],
			"slider-responsive-default-image" => $this->image_uploader_field( "slider-responsive-default-image", get_option( "f12s_slider_settings" )["slider-responsive-default-image"] )
		);

		echo F12SliderUtils::loadAdminTemplate( "admin.php", $args );
	}
}