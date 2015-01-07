<?php
/**
 * Counter Shortcode
 */

if( !function_exists( 'grve_counter_shortcode' ) ) {

	function grve_counter_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'counter_start_val' => '0',
					'counter_end_val' => '100',
					'counter_prefix' => '',
					'counter_suffix' => '',
					'counter_decimal_points' => '0',
					'counter_color' => '',
					'title' => '',
					'icon' => '',
					'icon_type' => '',
					'icon_color' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$counter_classes = array( 'grve-element' );

		array_push( $counter_classes, 'grve-counter' );
		array_push( $counter_classes, 'grve-align-center' );

		if ( !empty( $animation ) ) {
			array_push( $counter_classes, 'grve-animated-item' );
			array_push( $counter_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $counter_classes, $el_class);
		}

		$counter_class_string = implode( ' ', $counter_classes );


		$icon_classes = array( 'grve-icon' );

		if ( 'icon' == $icon_type ) {
			array_push( $icon_classes, 'fa fa-' . $icon );
		}

		$icon_class_string = implode( ' ', $icon_classes );


		$style = grve_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<div class="' . esc_attr( $counter_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( 'icon' == $icon_type ) {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . ' grve-color-' . esc_attr( $icon_color ) . '"></div>';
		}

		$output .= '  <div class="grve-counter-content">';
		$output .= '  	  <div class="grve-counter-item grve-color-' . esc_attr( $counter_color ) . '">';
		$output .= '      <span data-prefix="' . esc_attr( $counter_prefix ) . '" data-suffix="' . esc_attr( $counter_suffix ) . '" data-start-val="' . esc_attr( $counter_start_val ) . '" data-end-val="' . esc_attr( $counter_end_val ) . '" data-decimal-points="' . esc_attr( $counter_decimal_points ) . '">' . $counter_start_val. '</span>';
		$output .= '</div>';
		$output .= '      <h5 class="grve-counter-title">' . $title. '</h5>';
		$output .= '  </div>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_counter', 'grve_counter_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Counter", "grve-osmosis-vc-extension" ),
	"description" => __( "Add a counter with icon and title", "grve-osmosis-vc-extension" ),
	"base" => "grve_counter",
	"class" => "",
	"icon"      => "icon-wpb-grve-counter",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Counter Start Number", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_start_val",
			"value" => "0",
			"description" => __( "Enter counter start number.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Counter End Number", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_end_val",
			"value" => "100",
			"description" => __( "Enter counter end number.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Counter Decimal Points", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_decimal_points",
			"value" => "0",
			"description" => __( "Number of decimal points.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Counter Prefix", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_prefix",
			"value" => "",
			"description" => __( "Enter counter prefix.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Counter Suffix", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_suffix",
			"value" => "",
			"description" => __( "Enter counter suffix.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Counter Color", "grve-osmosis-vc-extension" ),
			"param_name" => "counter_color",
			"value" => array(
				__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
				__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
				__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
				__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
				__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
				__( "Green", "grve-osmosis-vc-extension" ) => 'green',
				__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
				__( "Red", "grve-osmosis-vc-extension" ) => 'red',
				__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
				__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
				__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
				__( "Black", "grve-osmosis-vc-extension" ) => 'black',
				__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
				__( "White", "grve-osmosis-vc-extension" ) => 'white',
			),
			"description" => __( "Color of the counter.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Icon type", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_type",
			"value" => array(
				__( "No Icon", "grve-osmosis-vc-extension" ) => '',
				__( "Icon", "grve-osmosis-vc-extension" ) => 'icon',
			),
			"description" => '',
			"admin_label" => true,
		),
		array(
			"type" => "grve_icon",
			"heading" => __( 'Icon', "grve-osmosis-vc-extension" ),
			"param_name" => "icon",
			"value" => 'adjust',
			"description" => __( "Select an icon.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Icon Color", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_color",
			"value" => array(
				__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
				__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
				__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
				__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
				__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
				__( "Green", "grve-osmosis-vc-extension" ) => 'green',
				__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
				__( "Red", "grve-osmosis-vc-extension" ) => 'red',
				__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
				__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
				__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
				__( "Black", "grve-osmosis-vc-extension" ) => 'black',
				__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
				__( "White", "grve-osmosis-vc-extension" ) => 'white',
			),
			"description" => __( "Color of the icon.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "title",
			"value" => "Sample Title",
			"description" => __( "Enter counter title.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>