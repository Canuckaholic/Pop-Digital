<?php
/**
 * Single Promo Shortcode
 */

if( !function_exists( 'grve_promo_shortcode' ) ) {

	function grve_promo_shortcode( $atts, $content ) {

		$output = $button = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'retina_image' => '',
					'align' => 'left',
					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		//Button
		$button = grve_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class );
		$image_string = '';

		if ( !empty( $image ) ) {

			$id = preg_replace('/[^\d]/', '', $image);
			$thumb_src = wp_get_attachment_image_src( $id, 'full' );
			$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';
			if ( !empty( $retina_image ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_data = ' data-at2x="' . esc_attr( $img_retina_src[0] ) . '"';
			}
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

			$image_string .= '<img class="grve-partner-logo" src="' . esc_url( $thumb_src[0] ) . '" alt="' . $alt . '" ' . $image_dimensions . $retina_data . '>';
		}

		$output .= '<div class="grve-element grve-partner-advanced grve-align-' . $align . ' ' . esc_attr( $el_class ) . '">';
		$output .= $image_string;
		$output .= '  <div class="grve-partner-content">';
		$output .= '    <p class="grve-leader-text">' . $content. '</p>';
		$output .= $button;
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_promo', 'grve_promo_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Advanced Promo", "grve-osmosis-vc-extension" ),
	"description" => __( "Advanced, impressive promotion for whatever you like", "grve-osmosis-vc-extension" ),
	"base" => "grve_promo",
	"class" => "",
	"icon"      => "icon-wpb-grve-promo",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "attach_image",
			"heading" => __( "Image", "grve-osmosis-vc-extension" ),
			"param_name" => "image",
			"description" => __( "Select an image.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Retina Image", "grve-osmosis-vc-extension" ),
			"param_name" => "retina_image",
			"description" => __( "Select a 2x image.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "Sample Text",
			"description" => __( "Enter your text.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_align,
		$grve_vce_add_button_type,
		$grve_vce_add_button_color,
		$grve_vce_add_button_text,
		$grve_vce_add_button_size,
		$grve_vce_add_button_shape,
		$grve_vce_add_button_link,
		$grve_vce_add_button_class,
		$grve_vce_add_el_class,
	),
) );

?>