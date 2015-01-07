<?php
/**
 * Dropcap Shortcode
 */

if( !function_exists( 'grve_dropcap_shortcode' ) ) {

	function grve_dropcap_shortcode( $atts, $content ) {

		$output = $style = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'dropcap_style' => '1',
					'bg_color' => 'primary-1',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);


		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$dropcap_classes = array( 'grve-element', 'grve-dropcap' );

		if ( !empty( $animation ) ) {
			array_push( $dropcap_classes, 'grve-animated-item' );
			array_push( $dropcap_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $dropcap_classes, $el_class);
		}
		$dropcap_class_string = implode( ' ', $dropcap_classes );

		if ( !empty( $content ) ) {

			$dropcap_char = mb_substr( $content, 0, 1, 'UTF8' );
			$dropcap_content = mb_substr( $content, 1, mb_strlen( $content ) , 'UTF8' );
			$output .= '<div class="' . esc_attr( $dropcap_class_string ) . '" style="' . $style . '"' . $data .'>';
			$output .= '<p><span class="grve-style-' . esc_attr( $dropcap_style ) . ' grve-bg-' . esc_attr( $bg_color ) . '">' . $dropcap_char . '</span>' . $dropcap_content . '</p>';
			$output .= '</div>';

		}


		return $output;
	}
	add_shortcode( 'grve_dropcap', 'grve_dropcap_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Dropcap", "grve-osmosis-vc-extension" ),
	"description" => __( "Two separate styles for your dropcaps", "grve-osmosis-vc-extension" ),
	"base" => "grve_dropcap",
	"class" => "",
	"icon"      => "icon-wpb-grve-dropcap",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Style", "grve-osmosis-vc-extension" ),
			"param_name" => "dropcap_style",
			"value" => array(
				__( "Style 1", "grve-osmosis-vc-extension" ) => '1',
				__( "Style 2", "grve-osmosis-vc-extension" ) => '2',
			),
			"description" => __( "Style of the dropcap.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "Sample Text",
			"description" => __( "Type your dropcap text.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Dropcap Color", "grve-osmosis-vc-extension" ),
			"param_name" => "bg_color",
			"value" => array(
				__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
				__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
				__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
				__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
				__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
			),
			"description" => __( "First character background color", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>