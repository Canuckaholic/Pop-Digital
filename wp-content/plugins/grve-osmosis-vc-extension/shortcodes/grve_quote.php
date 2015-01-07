<?php
/**
 * Quote Shortcode
 */

if( !function_exists( 'grve_quote_shortcode' ) ) {

	function grve_quote_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$quote_classes = array( 'grve-element' );

		if ( !empty( $animation ) ) {
			array_push( $quote_classes, 'grve-animated-item' );
			array_push( $quote_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty( $el_class ) ) {
			array_push( $quote_classes, $el_class);
		}

		$quote_class_string = implode( ' ', $quote_classes );


		$style = grve_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<blockquote class="' . esc_attr( $quote_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '<p>' . $content . '</p>';
		$output .= '</blockquote>';


		return $output;
	}
	add_shortcode( 'grve_quote', 'grve_quote_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Quote", "grve-osmosis-vc-extension" ),
	"description" => __( "Easily create your Quote Text", "grve-osmosis-vc-extension" ),
	"base" => "grve_quote",
	"class" => "",
	"icon"      => "icon-wpb-grve-quote",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "Sample Quote",
			"description" => __( "Type your quote.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>