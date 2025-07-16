<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class F12SliderShortcode
 * Handles the shortcode for the slider
 */
class F12SliderShortcode {
	/**
	 * F12SliderShortcode constructor.
	 */
	public function __construct() {
		add_shortcode( "f12-slider", array( &$this, "add_shortcode" ) );
	}

	/**
	 * Run the shortcode
	 */
	public function add_shortcode( $atts ) {
		if ( ! isset( $atts["id"] ) ) {
			return "no id assigned";
		}

		$args = array(
			"post_type"      => "f12s_slider",
			"posts_per_page" => - 1,
			"meta_query"     => array(
				array(
					"key"   => "f12s-slider-group",
					"value" => $atts["id"]
				)
			),
			"orderby"        => "meta_value_num",
			"meta_key"       => "f12-sort",
			"order"          => "ASC"
		);

		$query = new WP_Query( $args );
		$posts = $query->get_posts();

		?>
        <!-- COMPONENT SLIDER BEGIN -->
        <div class="f12-js-slider" data-animation="fade">
            <div class="f12-js-slider__items">
				<?php

				foreach ( $posts as $item ) {
					/* @var $item WP_Post */
					$stored_meta_data = get_post_meta( $item->ID );
					if ( $stored_meta_data["type"][0] == "a" ) {
						$args = array(
							"row_1" => F12SliderUtils::get_field( $stored_meta_data, "row_1" ),
							"row_2" => F12SliderUtils::get_field( $stored_meta_data, "row_2" ),
							"image" => F12SliderUtils::get_field( $stored_meta_data, "image" )
						);
						echo F12SliderUtils::loadTemplate( "type_a.php", $args );

						unset( $row_1, $row_2, $image );
					} else {

						$args = array(
							"title"        => F12SliderUtils::get_field( $stored_meta_data, "title" ),
							"content"      => F12SliderUtils::get_field( $stored_meta_data, "content" ),
							"button_label" => F12SliderUtils::get_field( $stored_meta_data, "button_label" ),
							"button_link"  => F12SliderUtils::get_field( $stored_meta_data, "button_link" ),
							"button_title" => F12SliderUtils::get_field( $stored_meta_data, "button_title" ),
							"is_quote"     => F12SliderUtils::get_field( $stored_meta_data, "is-quote", false ),
							"author"       => F12SliderUtils::get_field( $stored_meta_data, "quote_author" )
						);

						$image = F12SliderUtils::get_field( $stored_meta_data, "image" );

						if ( $image ) {
						    // with image
							$image_responsive_src = "";
							$image_responsive     = wp_get_attachment_image_src( get_option( "f12s_slider_settings" )["slider-responsive-default-image"], "" );
							if ( $image_responsive ) {
								$image_responsive_src = $image_responsive[0];
							}

							$args["image"]                = $image;
							$args["image_responsive_src"] = $image_responsive_src;
							echo F12SliderUtils::loadTemplate( "type_b.php", $args );

						} else {
						    // with gradient
							$args["f12-gradient-color-1"] = F12SliderUtils::get_field( $stored_meta_data, "f12-gradient-color-1" );
							$args["f12-gradient-color-2"] = F12SliderUtils::get_field( $stored_meta_data, "f12-gradient-color-2" );

							echo F12SliderUtils::loadTemplate( "type_b_gradient.php", $args );
						}
					}
				}
				?>
            </div>
            <div class="f12-slider__navigation">
                <!--
				<span class="active"></span>
				<span></span>
				<span></span>
				-->
            </div>
        </div>
		<?php
	}
}

new F12SliderShortcode();