<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

class F12Slider {
	/**
	 * Get all Slider by group id and return an multi array with all slider items
	 * array(
	 *      array(
	 *          [0] => {id}
	 *          [1] => {title}
	 *      )
	 * );
	 *
	 * @param $group_id
	 *
	 * @return array
	 */
	public static function get_slider_by_group_id( $group_id ) {
		$data = array();

		$args = array(
			"post_type"      => "f12s_slider",
			"nopaging"       => "true",
			"posts_per_page" => - 1,
			"meta_query"     => array(
				array(
					"key"   => "f12s-slider-group",
					"value" => $group_id
				)
			),
			"orderby" => "meta_value_num",
			"meta_key" => "f12-sort",
			"order" => "ASC"
		);

		$query = new WP_Query( $args );
		$posts = $query->get_posts();
		foreach($posts as $item){
			/* @var $item WP_Post */

			$stored_meta_data = get_post_meta( $item->ID );

			$data[] = array( $item->ID, $item->post_title, F12SliderUtils::get_field($stored_meta_data, "image"));
		}

		return $data;
	}
}