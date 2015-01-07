<?php
/**
 * Icon Box Shortcode
 */

if( !function_exists( 'grve_icon_box_shortcode' ) ) {

	function grve_icon_box_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $text_style_class = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'icon' => '',
					'icon_type' => 'icon',
					'icon_size' => 'medium',
					'icon_shape' => 'no-shape',
					'shape_type' => 'simple',
					'icon_color' => 'primary-1',
					'icon_animation' => 'no',
					'icon_char' => '',
					'icon_image' => '',
					'retina_icon_image' => '',
					'align' => 'left',
					'text_style' => 'none',
					'link' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$icon_box_classes = array( 'grve-element' );

		array_push( $icon_box_classes, 'grve-box-icon' );
		array_push( $icon_box_classes, 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $icon_box_classes, 'grve-animated-item' );
			array_push( $icon_box_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( 'yes' == $icon_animation ) {
			array_push( $icon_box_classes, 'grve-advanced-hover' );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $icon_box_classes, $el_class);
		}

		$icon_box_class_string = implode( ' ', $icon_box_classes );


		$icon_classes = array( 'grve-icon' );

		array_push( $icon_classes, 'grve-' . $icon_size );
		array_push( $icon_classes, 'grve-' . $shape_type );
		array_push( $icon_classes, 'grve-' . $icon_shape );

		if ( 'no-shape' != $icon_shape && 'outline' != $shape_type ) {
			array_push( $icon_classes, 'grve-bg-' . $icon_color );
		} else {
			array_push( $icon_classes, 'grve-color-' . $icon_color );
		}

		if ( 'icon' == $icon_type ) {
			array_push( $icon_classes, 'fa fa-' . $icon );
		}

		if ( 'image' == $icon_type ) {
			array_push( $icon_classes, 'grve-image-icon' );
		}

		$icon_class_string = implode( ' ', $icon_classes );


		if ( !empty( $link ) ){
			$href = vc_build_link( $link );
			$url = $href['url'];
			if ( !empty( $href['target'] ) ){
				$target = $href['target'];
			} else {
				$target= "_self";
			}
		} else {
			$url = "#";
			$target= "_self";
		}
		if ( !empty( $url ) && '#' != $url ) {
			$link_start = '<a href="' . esc_url( $url ) . '" target="' . $target . '">';
			$link_end = '</a>';
		}

		// Paragraph
		if ( 'none' != $text_style ) {
			$text_style_class = 'grve-' .$text_style;
		}

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $icon_box_class_string ) . '" style="' . $style . '"' . $data . '>';

		$output .= $link_start;

		if ( 'image' == $icon_type ) {
			if ( !empty( $icon_image ) ) {
				$img_id = preg_replace('/[^\d]/', '', $icon_image);
				$img_src = wp_get_attachment_image_src( $img_id, 'full' );
				$image_dimensions = 'width="' . $img_src[1] . '" height="' . $img_src[2] . '"';
				if ( !empty( $retina_icon_image ) ) {
					$img_retina_id = preg_replace('/[^\d]/', '', $retina_icon_image);
					$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
					$retina_data = ' data-at2x="' . esc_attr( $img_retina_src[0] ) . '"';
				}
				$output .= '  <div class="' . esc_attr( $icon_class_string ) . '"><img alt="icon" src="' . esc_url( $img_src[0] ) . '"' . $retina_data . ' ' . $image_dimensions . '></div>';
			}
		} else if( 'char' == $icon_type ) {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . '">'. $icon_char. '</div>';
		} else {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . '"></div>';
		}

		$output .= $link_end;

		$output .= '  <div class="grve-box-content">';
		if ( !empty( $title ) ) {
		$output .= $link_start;
		$output .= '      <h5 class="grve-box-title">' . $title. '</h5>';
		$output .= $link_end;
		}
		if ( !empty( $content ) ) {
		$output .= '    <p class="' . esc_attr( $text_style_class ) . '">' . $content . '</p>';
		}
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_icon_box', 'grve_icon_box_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Icon Box", "grve-osmosis-vc-extension" ),
	"description" => __( "Add an icon, character or image with title and text", "grve-osmosis-vc-extension" ),
	"base" => "grve_icon_box",
	"class" => "",
	"icon"      => "icon-wpb-grve-icon-box",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Icon size", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_size",
			"value" => array(
				__( "Large", "grve-osmosis-vc-extension" ) => 'large',
				__( "Medium", "grve-osmosis-vc-extension" ) => 'medium',
				__( "Small", "grve-osmosis-vc-extension" ) => 'small',
			),
			"std" => 'medium',
			"description" => '',
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Icon shape", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_shape",
			"value" => array(
				__( "None", "grve-osmosis-vc-extension" ) => 'no-shape',
				__( "Square", "grve-osmosis-vc-extension" ) => 'square',
				__( "Round", "grve-osmosis-vc-extension" ) => 'round',
				__( "Circle", "grve-osmosis-vc-extension" ) => 'circle',
			),
			"description" => '',
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Icon type", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_type",
			"value" => array(
				__( "Icon", "grve-osmosis-vc-extension" ) => 'icon',
				__( "Image", "grve-osmosis-vc-extension" ) => 'image',
				__( "Character", "grve-osmosis-vc-extension" ) => 'char',
			),
			"description" => '',
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Shape type", "grve-osmosis-vc-extension" ),
			"param_name" => "shape_type",
			"value" => array(
				__( "Simple", "grve-osmosis-vc-extension" ) => 'simple',
				__( "Outline", "grve-osmosis-vc-extension" ) => 'outline',
			),
			"description" => __( "Select shape type.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_align,
		array(
			"type" => 'checkbox',
			"heading" => __( "Enable Advanced Hover", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_animation",
			"value" => Array( __( "If selected, you will have advanced hover.", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "align", 'value' => array( 'center' ) ),
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
			"heading" => __( "Box Color", "grve-osmosis-vc-extension" ),
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
			"description" => __( "Color of the icon box.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Icon Image", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_image",
			"description" => __( "Select an icon image.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "icon_type", 'value' => array( 'image' ) ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Retina Icon Image", "grve-osmosis-vc-extension" ),
			"param_name" => "retina_icon_image",
			"description" => __( "Select a 2x icon.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "icon_type", 'value' => array( 'image' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Character", "grve-osmosis-vc-extension" ),
			"param_name" => "icon_char",
			"value" => "A",
			"description" => __( "Type a single character.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "icon_type", 'value' => array( 'char' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "title",
			"value" => "",
			"description" => __( "Enter icon box title.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "",
			"description" => __( "Enter your content.", "grve-osmosis-vc-extension" ),
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
			"type" => "vc_link",
			"heading" => __( "Link", "grve-osmosis-vc-extension" ),
			"param_name" => "link",
			"value" => "",
			"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>