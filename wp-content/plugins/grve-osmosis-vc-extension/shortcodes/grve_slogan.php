<?php
/**
 * Slogan Shortcode
 */

if( !function_exists( 'grve_slogan_shortcode' ) ) {

	function grve_slogan_shortcode( $atts, $content ) {

		$output = $data = $el_class = $text_style_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading' => 'h1',
					'line_type' => 'no-line',
					'subtitle' => '',
					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'button2_text' => '',
					'button2_link' => '',
					'button2_type' => 'simple',
					'button2_size' => 'medium',
					'button2_color' => 'primary-1',
					'button2_shape' => 'square',
					'button2_class' => '',
					'text_style' => 'none',
					'align' => 'left',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		//Title
		if ( !empty( $title ) ) {
			//Title Classes
			$title_classes = array( 'grve-slogan-title' );

			array_push( $title_classes, 'grve-align-' . $align );
			array_push( $title_classes, 'grve-title-' . $line_type );

			$title_class_string = implode( ' ', $title_classes );
		}

		//Slogan
		$slogan_classes = array( 'grve-element', 'grve-slogan', 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $slogan_classes, 'grve-animated-item' );
			array_push( $slogan_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $slogan_classes, $el_class);
		}
		$slogan_class_string = implode( ' ', $slogan_classes );

		// Paragraph
		if ( 'none' != $text_style ) {
			$text_style_class = 'grve-' .$text_style;
		}

		//First Button
		$button1 = grve_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class );
		//Second Button
		$button2 = grve_vce_get_button( $button2_text, $button2_link, $button2_type, $button2_size, $button2_color, $button2_shape, $button2_class );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $slogan_class_string ) . '" style="' . $style. '"' . $data . '>';
		if ( !empty( $subtitle ) ) {
			$output .= '<div class="grve-subtitle">' . $subtitle . '</div>';
		}
		if ( !empty( $title ) ) {
			$output .= '<' . $heading . ' class="' . esc_attr( $title_class_string ) . '"><span>' . $title . '</span></' . $heading . '>';
		}
		$output .= '  <p class="' . esc_attr( $text_style_class ) . '">' . $content . '</p>';

		$output .= $button1;
		$output .= $button2;

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_slogan', 'grve_slogan_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Slogan", "grve-osmosis-vc-extension" ),
	"description" => __( "Create easily appealing slogans", "grve-osmosis-vc-extension" ),
	"base" => "grve_slogan",
	"class" => "",
	"icon"      => "icon-wpb-grve-slogan",
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
			"description" => __( "Heading size of the title", "grve-osmosis-vc-extension" ),
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
			"description" => __( "Line Type of the title.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Sub-Title", "grve-osmosis-vc-extension" ),
			"param_name" => "subtitle",
			"value" => "",
			"description" => __( "Enter your sub-title here.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "Sample Text",
			"description" => __( "Type your text.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Text Style", "grve-osmosis-vc-extension" ),
			"param_name" => "text_style",
			"value" => array(
				__( "None", "grve-osmosis-vc-extension" ) => '',
				__( "Leader", "grve-osmosis-vc-extension" ) => 'leader-text',
				__( "Subtitle", "grve-osmosis-vc-extension" ) => 'subtitle',
			),
			"description" => 'Select your text style',
		),
		array(
			"type" => "dropdown",
			"heading" => __( "First Button type", "grve-osmosis-vc-extension" ),
			"param_name" => "button_type",
			"value" => array(
				__( "Simple", "grve-osmosis-vc-extension" ) => 'simple',
				__( "Outline", "grve-osmosis-vc-extension" ) => 'outline',
			),
			"description" => __( "Select button type.", "grve-osmosis-vc-extension" ),
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "First Button Color", "grve-osmosis-vc-extension" ),
			"param_name" => "button_color",
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
			"description" => __( "Color of the button.", "grve-osmosis-vc-extension" ),
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "First Button Text", "grve-osmosis-vc-extension" ),
			"param_name" => "button_text",
			"value" => "",
			"description" => __( "Leave this field empty if you don't want to show this button.", "grve-osmosis-vc-extension" ),
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "First Button Size", "grve-osmosis-vc-extension" ),
			"param_name" => "button_size",
			"value" => array(
				__( "Extra Small", "grve-osmosis-vc-extension" ) => 'extrasmall',
				__( "Small", "grve-osmosis-vc-extension" ) => 'small',
				__( "Medium", "grve-osmosis-vc-extension" ) => 'medium',
				__( "Large", "grve-osmosis-vc-extension" ) => 'large',
				__( "Extra Large", "grve-osmosis-vc-extension" ) => 'extralarge',
			),
			"description" => '',
			"admin_label" => true,
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "First Button Shape", "grve-osmosis-vc-extension" ),
			"param_name" => "button_shape",
			"value" => array(
				__( "Square", "grve-osmosis-vc-extension" ) => 'square',
				__( "Round", "grve-osmosis-vc-extension" ) => 'round',
				__( "Extra Round", "grve-osmosis-vc-extension" ) => 'extra-round',
			),
			"description" => '',
			"std" => 'square',
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "First Button Link", "grve-osmosis-vc-extension" ),
			"param_name" => "button_link",
			"value" => "",
			"description" => __( "Enter a link for your button.", "grve-osmosis-vc-extension" ),
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "First Button class name", "grve-osmosis-vc-extension" ),
			"param_name" => "button_class",
			"description" => __( "If you wish to style your button differently, then use this field to add a class name and then refer to it in your css file.", "grve-osmosis-vc-extension" ),
			"group" => __( "First Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Second Button type", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_type",
			"value" => array(
				__( "Simple", "grve-osmosis-vc-extension" ) => 'simple',
				__( "Outline", "grve-osmosis-vc-extension" ) => 'outline',
			),
			"description" => __( "Select button type.", "grve-osmosis-vc-extension" ),
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Second Button Color", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_color",
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
			"description" => __( "Color of the button.", "grve-osmosis-vc-extension" ),
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Second Button Text", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_text",
			"value" => "",
			"description" => __( "Leave this field empty if you don't want to show this button.", "grve-osmosis-vc-extension" ),
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Second Button Size", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_size",
			"value" => array(
				__( "Extra Small", "grve-osmosis-vc-extension" ) => 'extrasmall',
				__( "Small", "grve-osmosis-vc-extension" ) => 'small',
				__( "Medium", "grve-osmosis-vc-extension" ) => 'medium',
				__( "Large", "grve-osmosis-vc-extension" ) => 'large',
				__( "Extra Large", "grve-osmosis-vc-extension" ) => 'extralarge',
			),
			"description" => '',
			"admin_label" => true,
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Button Shape", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_shape",
			"value" => array(
				__( "Square", "grve-osmosis-vc-extension" ) => 'square',
				__( "Round", "grve-osmosis-vc-extension" ) => 'round',
				__( "Extra Round", "grve-osmosis-vc-extension" ) => 'extra-round',
			),
			"description" => '',
			"std" => 'square',
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "Second Button Link", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_link",
			"value" => "",
			"description" => __( "Enter a link for your button.", "grve-osmosis-vc-extension" ),
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Second Button class name", "grve-osmosis-vc-extension" ),
			"param_name" => "button2_class",
			"description" => __( "If you wish to style your button differently, then use this field to add a class name and then refer to it in your css file.", "grve-osmosis-vc-extension" ),
			"group" => __( "Second Button", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_align,
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>