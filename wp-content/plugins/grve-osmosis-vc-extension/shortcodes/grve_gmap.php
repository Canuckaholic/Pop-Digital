<?php
/**
 * Google Map Shortcode
 */

if( !function_exists( 'grve_gmap_shortcode' ) ) {

	function grve_gmap_shortcode( $atts, $content ) {
		$output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'map_lat' => '51.516221',
					'map_lng' => '-0.136986',
					'map_height' => '280',
					'map_marker' => '',
					'map_zoom' => 14,
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		wp_enqueue_script( 'grve-googleapi-script' );
		wp_enqueue_script( 'grve-maps-script' );

		$gmap_classes = array( 'grve-element', 'grve-map' );

		if ( !empty ( $el_class ) ) {
			array_push( $gmap_classes, $el_class );
		}
		$gmap_class_string = implode( ' ', $gmap_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );
		if ( empty( $map_marker ) ) {
			$map_marker = get_template_directory_uri() . '/images/markers/markers.png';
		} else {
			$id = preg_replace('/[^\d]/', '', $map_marker);
			$full_src = wp_get_attachment_image_src( $id, 'full' );
			$map_marker = $full_src[0];
		}

		$map_title = '';

		$data_map = 'data-lat="' . esc_attr( $map_lat ) . '" data-lng="' . esc_attr( $map_lng ) . '" data-zoom="' . esc_attr( $map_zoom ) . '"';
		$output .= '<div class="grve-map-wrapper">';
		$output .= '  <div style="display:none" class="grve-map-point" data-point-lat="' . esc_attr( $map_lat ) . '" data-point-lng="' . esc_attr( $map_lng ) . '" data-point-marker="' . esc_attr( $map_marker ) . '" data-point-title="' . esc_attr( $map_title ) . '"></div>';
		$output .= '  <div class="' . esc_attr( $gmap_class_string ) . '" ' . $data_map . ' style="' . $style . grve_vce_build_dimension( 'height', $map_height ) . '"></div>';
		$output .= '</div>';


		return $output;
	}
	add_shortcode( 'grve_gmap', 'grve_gmap_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Google Map", "grve-osmosis-vc-extension" ),
	"description" => __( "Freely place your Google Map", "grve-osmosis-vc-extension" ),
	"base" => "grve_gmap",
	"class" => "",
	"icon"      => "icon-wpb-grve-gmap",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Map Latitude", "grve-osmosis-vc-extension" ),
			"param_name" => "map_lat",
			"value" => "51.516221",
			"description" => __( "Type map Latitude.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Map Longtitude", "grve-osmosis-vc-extension" ),
			"param_name" => "map_lng",
			"value" => "-0.136986",
			"description" => __( "Type map Longtitude.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Map Zoom", "grve-osmosis-vc-extension" ),
			"param_name" => "map_zoom",
			"value" => array( 1, 2, 3 ,4, 5, 6, 7, 8 ,9 ,10 ,11 ,12, 13, 14, 15, 16, 17, 18, 19 ),
			"std" => 14,
			"description" => __( "Zoom of the map.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Map Height", "grve-osmosis-vc-extension" ),
			"param_name" => "map_height",
			"value" => "280",
			"description" => __( "Type map height.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Custom marker", "grve-osmosis-vc-extension" ),
			"param_name" => "map_marker",
			"description" => __( "Select an icon for custom marker.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>