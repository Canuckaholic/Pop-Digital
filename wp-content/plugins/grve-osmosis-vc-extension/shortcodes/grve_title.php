<?php
/**
 * Title Shortcode
 */

if( !function_exists( 'grve_title_shortcode' ) ) {

	function grve_title_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading' => 'h3',
					'line_type' => 'no-line',
					'align' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$title_classes = array( 'grve-element' );

		array_push( $title_classes, 'grve-align-' . $align );
		array_push( $title_classes, 'grve-title-' . $line_type );


		if ( !empty( $animation ) ) {
			array_push( $title_classes, 'grve-animated-item' );
			array_push( $title_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty( $el_class ) ) {
			array_push( $title_classes, $el_class );
		}

		$title_class_string = implode( ' ', $title_classes );

		$output .= '<' . $heading . ' class="' . esc_attr( $title_class_string ) . '" style="' . $style . '"' . $data . '><span>' . $title . '</span></' . $heading . '>';

		return $output;
	}
	add_shortcode( 'grve_title', 'grve_title_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Title", "grve-osmosis-vc-extension" ),
	"description" => __( "Add a title in many and diverse ways", "grve-osmosis-vc-extension" ),
	"base" => "grve_title",
	"class" => "",
	"icon"      => "icon-wpb-grve-title",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "title",
			"value" => "Sample Title",
			"description" => __( "Enter your title here.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Heading", "grve-osmosis-vc-extension" ),
			"param_name" => "heading",
			"admin_label" => true,
			"value" => array( 'h1', 'h2', 'h3', 'h4' , 'h5', 'h6' ),
			"description" => __( "Heading size", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Line type", "grve-osmosis-vc-extension" ),
			"param_name" => "line_type",
			"value" => array(
				__( "None", "grve-osmosis-vc-extension" ) => 'no-line',
				__( "Simple", "grve-osmosis-vc-extension" ) => 'line',
				__( "Double", "grve-osmosis-vc-extension" ) => 'double-line',
				__( "Double Bottom", "grve-osmosis-vc-extension" ) => 'double-bottom-line',
			),
			"description" => '',
		),
		$grve_vce_add_align,
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>