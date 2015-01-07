<?php
/**
 * Divider Shortcode
 */

if( !function_exists( 'grve_divider_shortcode' ) ) {

	function grve_divider_shortcode( $atts, $content ) {

		$output = $class_fullwidth = $style = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'line_type' => 'space',
					'backtotop_title' => '',
					'padding_top' => '',
					'padding_bottom' => '',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style .= grve_vce_build_margin_bottom_style( $margin_bottom );
		$style .= grve_vce_build_padding_top_style( $padding_top );
		$style .= grve_vce_build_padding_bottom_style( $padding_bottom );

		$output .= '<div class="grve-element grve-hr grve-' . $line_type . '-divider' . $el_class.'" style="' . $style . '">';
		if ( !empty( $backtotop_title ) && 'top-line' == $line_type ) {
			$output .= '    <span class="grve-divider-backtotop">' . $backtotop_title. '</span>';
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_divider', 'grve_divider_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Divider", "grve-osmosis-vc-extension" ),
	"description" => __( "Insert dividers, just spaces or different lines", "grve-osmosis-vc-extension" ),
	"base" => "grve_divider",
	"class" => "",
	"icon"      => "icon-wpb-grve-divider",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Line type", "grve-osmosis-vc-extension" ),
			"param_name" => "line_type",
			"value" => array(
				__( "Space", "grve-osmosis-vc-extension" ) => 'space',
				__( "Simple", "grve-osmosis-vc-extension" ) => 'line',
				__( "Double", "grve-osmosis-vc-extension" ) => 'double-line',
				__( "Dashed", "grve-osmosis-vc-extension" ) => 'dashed-line',
				__( "Back to Top", "grve-osmosis-vc-extension" ) => 'top-line',
			),
			"description" => '',
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Back to Top Title", "grve-osmosis-vc-extension" ),
			"param_name" => "backtotop_title",
			"value" => "Back to top",
			"description" => __( "Set Back to top title.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "line_type", 'value' => array( 'top-line' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Top padding", "grve-osmosis-vc-extension" ),
			"param_name" => "padding_top",
			"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Bottom padding", "grve-osmosis-vc-extension" ),
			"param_name" => "padding_bottom",
			"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>