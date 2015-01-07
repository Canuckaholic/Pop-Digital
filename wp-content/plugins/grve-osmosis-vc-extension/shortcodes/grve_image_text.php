<?php
/**
 * Image Text Shortcode
 */

if( !function_exists( 'grve_image_text_shortcode' ) ) {

	function grve_image_text_shortcode( $atts, $content ) {

		$output = $output_image = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'image' => '',
					'retina_image' => '',
					'image_align' => 'left',
					'video_popup' => '',
					'video_link' => '',
					'read_more_title' => '',
					'read_more_link' => '',
					'read_more_class' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		if ( !empty( $read_more_link ) ){
			$href = vc_build_link( $read_more_link );
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

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$image_text_classes = array( 'grve-element', 'grve-image-text' );

		if ( !empty( $animation ) ) {
			array_push( $image_text_classes, 'grve-animated-item' );
			array_push( $image_text_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $image_text_classes, $el_class);
		}
		$image_text_class_string = implode( ' ', $image_text_classes );


		$output .= '<div class="' . esc_attr( $image_text_class_string ) . '" style="' . $style . '"' . $data . '>';
		if ( !empty( $image ) ) {
			$img_id = preg_replace('/[^\d]/', '', $image);
			$img_src = wp_get_attachment_image_src( $img_id, 'full' );
			$image_dimensions = 'width="' . $img_src[1] . '" height="' . $img_src[2] . '"';
			if ( !empty( $retina_image ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_data = ' data-at2x="' . esc_attr( $img_retina_src[0] ) . '"';
			}
			$alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';


			if ( 'yes' == $video_popup && !empty( $video_link ) ) {
				$output_image .= '<div class="grve-image">';
				$output_image .= '	<a class="grve-vimeo-popup grve-icon-video" href="' . esc_url( $video_link ) . '">';
				$output_image .= '		<img alt="' . $alt . '" src="' . esc_url( $img_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
				$output_image .= '	</a>';
				$output_image .= '</div>';
			} else {
				$output_image .= '<div class="grve-image">';
				$output_image .= '  <img alt="' . $alt . '" src="' . esc_url( $img_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
				$output_image .= '</div>';
			}


			if ( 'left' == $image_align ) {
				$output .= $output_image;
			}

			$output .= '  <div class="grve-content grve-align-' . esc_attr( $image_align ) . '">';
			if ( !empty( $title ) ) {
			$output .= '    <h4>' . $title. '</h4>';
			}
			if ( !empty( $content ) ) {
			$output .= '    <p>' . $content. '</p>';
			}
			if ( !empty( $read_more_title ) && !empty( $url ) ) {
				$output .= '    <a href="' . esc_url( $url ) . '" target="' . $target . '" class="grve-read-more ' . esc_attr( $read_more_class ) . '">';
				$output .=  $read_more_title ;
				$output .= '</a>';
			}
			$output .= '  </div>';


			if ( 'right' == $image_align ) {
				$output .= $output_image;
			}

			$output .= '</div>';

		}


		return $output;
	}
	add_shortcode( 'grve_image_text', 'grve_image_text_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Image Text", "grve-osmosis-vc-extension" ),
	"description" => __( "Combine image or video with text and button", "grve-osmosis-vc-extension" ),
	"base" => "grve_image_text",
	"class" => "",
	"icon"      => "icon-wpb-grve-image-text",
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
			"type" => 'dropdown',
			"heading" => __( "Image align", "grve-osmosis-vc-extension" ),
			"param_name" => "image_align",
			"description" => __( "Set the alignment of your image", "grve-osmosis-vc-extension" ),
			"value" => array(
				__( "Left", "grve-osmosis-vc-extension" ) => 'left',
				__( "Right", "grve-osmosis-vc-extension" ) => 'right',
			),
		),
		array(
			"type" => 'dropdown',
			"heading" => __( "Video popup", "grve-osmosis-vc-extension" ),
			"param_name" => "video_popup",
			"description" => __( "If selected, a video popup will be appear on click.", "grve-osmosis-vc-extension" ),
			"value" => array(
				__( "No", "grve-osmosis-vc-extension" ) => '',
				__( "Yes", "grve-osmosis-vc-extension" ) => 'yes',
			),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Video Link", "grve-osmosis-vc-extension" ),
			"param_name" => "video_link",
			"value" => "",
			"description" => __( "Type video URL e.g Vimeo/YouTube.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "video_popup", 'not_empty' => true ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "title",
			"value" => "",
			"description" => __( "Enter your title.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textarea",
			"heading" => __( "Text", "grve-osmosis-vc-extension" ),
			"param_name" => "content",
			"value" => "",
			"description" => __( "Enter your text.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Read More Title", "grve-osmosis-vc-extension" ),
			"param_name" => "read_more_title",
			"value" => "",
			"description" => __( "Enter your title for your link.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Read More Link Class", "grve-osmosis-vc-extension" ),
			"param_name" => "read_more_class",
			"value" => "",
			"description" => __( "Enter extra class name for your link.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "Read More Link", "grve-osmosis-vc-extension" ),
			"param_name" => "read_more_link",
			"value" => "",
			"description" => __( "Enter read more link.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>