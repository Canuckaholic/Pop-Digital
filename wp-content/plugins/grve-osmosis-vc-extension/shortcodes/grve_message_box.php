<?php
/**
 * Message Box Shortcode
 */

if( !function_exists( 'grve_message_box_shortcode' ) ) {

	function grve_message_box_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'icon' => '',
					'bg_color' => 'green',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$message_box_classes = array( 'grve-element', 'grve-message' );

		array_push( $message_box_classes, 'grve-bg-' . $bg_color );

		if ( !empty( $animation ) ) {
			array_push( $message_box_classes, 'grve-animated-item' );
			array_push( $message_box_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $message_box_classes, $el_class);
		}

		$message_box_class_string = implode( ' ', $message_box_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $message_box_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '  <i class="grve-icon fa fa-'. $icon. '"></i>';
		$output .= '  <p>' . $content. '</p>';
		$output .= '  <i class="grve-close grve-icon-close"></i>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_message_box', 'grve_message_box_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Message Box", "grve-osmosis-vc-extension" ),
	"description" => __( "Info text with icons", "grve-osmosis-vc-extension" ),
	"base" => "grve_message_box",
	"class" => "",
	"icon"      => "icon-wpb-grve-message-box",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "grve_icon",
			"heading" => __( 'Icon', "grve-osmosis-vc-extension" ),
			"param_name" => "icon",
			"value" => 'exclamation-circle',
			"description" => __( "Select an icon.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "Sample Text",
			"description" => __( "Enter your content.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Background Color", "grve-osmosis-vc-extension" ),
			"param_name" => "bg_color",
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
			"description" => __( "Background color of the box.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>