<?php
/**
* Single Image Shortcode
*/

if( !function_exists( 'grve_single_image_shortcode' ) ) {

	function grve_single_image_shortcode( $attr, $content ) {

		$output = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'retina_image' => '',
					'image_type' => 'image',
					'link' => '',
					'video_link' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

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

		$single_image_classes = array( 'grve-element', 'grve-image', 'grve-align-center' );

		if ( !empty( $animation ) ) {
			array_push( $single_image_classes, 'grve-animated-item' );
			array_push( $single_image_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $single_image_classes, $el_class);
		}
		$single_image_classe_string = implode( ' ', $single_image_classes );


		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $single_image_classe_string ) . '" style="' . $style . '"' . $data . '>';

		if ( !empty( $image ) ) {
			$id = preg_replace('/[^\d]/', '', $image);
			$image_link_href =  wp_get_attachment_url( $id );
			$thumb_src = wp_get_attachment_image_src( $id, 'full' );
			$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

			$full_src = wp_get_attachment_image_src( $id, 'large' );
			if ( !empty( $retina_image ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_data = ' data-at2x="' . esc_attr( $img_retina_src[0] ) . '"';
			}
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

			if ( 'image-popup' == $image_type ) {
				$output .= '<a class="grve-image-popup" href="' . esc_url( $full_src[0] ) . '">';
				$output .= '  <img alt="' . $alt . '" src="' . esc_url( $thumb_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
				$output .= '</a>';
			} else if ( 'image-link' == $image_type ) {
				$output .= '<a href="' . esc_url( $url ) . '" target="' . $target . '">';
				$output .= '  <img alt="' . $alt . '" src="' . esc_url( $thumb_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
				$output .= '</a>';
			} else if ( 'image-video-popup' == $image_type ) {
				if ( !empty( $video_link ) ) {
					$output .= '<div class="grve-media">';
					$output .= '	<a class="grve-vimeo-popup grve-icon-video" href="' . esc_url( $video_link ) . '">';
					$output .= '		<img alt="' . $alt . '" src="' . esc_url( $thumb_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
					$output .= '	</a>';
					$output .= '</div>';
				} else {
					$output .= '<div class="grve-media">';
					$output .= '  <img alt="' . $alt . '" src="' . esc_url( $thumb_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
					$output .= '</div>';
				}
			} else {
				$output .= '  <img alt="' . $alt . '" src="' . esc_url( $thumb_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
			}
		}

		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'grve_single_image', 'grve_single_image_shortcode' );

}

/**
* Add shortcode to Visual Composer
*/

vc_map( array(
	"name" => __( "Single Image", "grve-osmosis-vc-extension" ),
	"description" => __( "Image or Video popup in various uses", "grve-osmosis-vc-extension" ),
	"base" => "grve_single_image",
	"class" => "",
	"icon"      => "icon-wpb-grve-single-image",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Type", "grve-osmosis-vc-extension" ),
			"param_name" => "image_type",
			"value" => array(
				__( "Image", "grve-osmosis-vc-extension" ) => 'image',
				__( "Image Link", "grve-osmosis-vc-extension" ) => 'image-link',
				__( "Image Popup", "grve-osmosis-vc-extension" ) => 'image-popup',
				__( "Image Video Popup", "grve-osmosis-vc-extension" ) => 'image-video-popup',
			),
			"description" => __( "Select your image type.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
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
			"type" => "textfield",
			"heading" => __( "Video Link", "grve-osmosis-vc-extension" ),
			"param_name" => "video_link",
			"value" => "",
			"description" => __( "Type video URL e.g Vimeo/YouTube.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-video-popup') ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "Link", "grve-osmosis-vc-extension" ),
			"param_name" => "link",
			"value" => "",
			"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-link' ) ),
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>