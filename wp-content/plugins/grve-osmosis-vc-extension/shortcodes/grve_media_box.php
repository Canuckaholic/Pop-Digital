<?php
/**
 * Media Box Shortcode
 */

if( !function_exists( 'grve_media_box_shortcode' ) ) {

	function grve_media_box_shortcode( $atts, $content ) {
		global $wp_embed;
		$output = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'media_type' => 'image',
					'image' => '',
					'retina_image' => '',
					'video_popup' => '',
					'video_link' => '',
					'map_lat' => '51.516221',
					'map_lng' => '-0.136986',
					'map_height' => '280',
					'map_marker' => '',
					'map_zoom' => 14,
					'title_link' => '',
					'read_more_title' => '',
					'align' => 'left',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		if ( !empty( $title_link ) ){
			$href = vc_build_link( $title_link );
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

		$media_box_classes = array( 'grve-element', 'grve-box', 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $media_box_classes, 'grve-animated-item' );
			array_push( $media_box_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $media_box_classes, $el_class);
		}
		$media_box_classe_string = implode( ' ', $media_box_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $media_box_classe_string ) . '" style="' . $style . '"' . $data . '>';


		switch( $media_type ) {
			case 'image':
			case 'image-video-popup':
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

					if ( 'image-video-popup' == $media_type && !empty( $video_link ) ) {
						$output .= '<div class="grve-media">';
						$output .= '	<a class="grve-vimeo-popup grve-icon-video" href="' . $video_link . '">';
						$output .= '		<img alt="' . $alt . '" src="' . esc_url( $img_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
						$output .= '	</a>';
						$output .= '</div>';
					} else {
						$output .= '<div class="grve-media">';
						$output .= '  <img alt="' . $alt . '" src="' . esc_url( $img_src[0] ) . '" ' . $image_dimensions . $retina_data . '>';
						$output .= '</div>';
					}
				}
				break;
			case 'video':
				if ( !empty( $video_link ) ) {
					$output .= '<div class="grve-media">';
					$output .= $wp_embed->run_shortcode( '[embed]' . $video_link . '[/embed]' );
					$output .= '</div>';
				}
				break;
			case 'map':
				wp_enqueue_script( 'grve-googleapi-script' );
				wp_enqueue_script( 'grve-maps-script' );
				if ( empty( $map_marker ) ) {
					$map_marker = get_template_directory_uri() . '/images/markers/markers.png';
				} else {
					$id = preg_replace('/[^\d]/', '', $map_marker);
					$full_src = wp_get_attachment_image_src( $id, 'full' );
					$map_marker = $full_src[0];
				}
				$map_title = '';

				$data_map = 'data-lat="' . esc_attr( $map_lat ) . '" data-lng="' . esc_attr( $map_lng ) . '" data-zoom="' . esc_attr( $map_zoom ) . '"';
				$output .= '<div class="grve-media">';
				$output .= '  <div class="grve-map" ' . $data_map . ' style="' . $style . grve_vce_build_dimension( 'height', $map_height ) . '"></div>';
				$output .= '  <div style="display:none" class="grve-map-point" data-point-lat="' . esc_attr( $map_lat ) . '" data-point-lng="' . esc_attr( $map_lng ) . '" data-point-marker="' . esc_attr( $map_marker ) . '" data-point-title="' . esc_attr( $map_title ) . '"></div>';
				$output .= '</div>';
				break;
			default :
				break;
		}


		$output .= '  <div class="grve-box-content">';
		if ( !empty( $title_link ) ) {
		$output .= '    <a href="' . esc_url( $url ) . '" target="' . $target . '">';
		}
		$output .= '      <h5 class="grve-box-title">' . $title. '</h5>';
		if ( !empty( $title_link ) ) {
		$output .= '    </a>';
		}
		$output .= '    <p>' . $content . '</p>';
		if ( !empty( $read_more_title ) && !empty( $url ) ) {
		$output .= '    <a href="' . esc_url( $url ) . '" target="' . $target . '" class="grve-read-more">';
		$output .=  $read_more_title ;
		$output .= '</a>';
		}
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_media_box', 'grve_media_box_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Media Box", "grve-osmosis-vc-extension" ),
	"description" => __( "Image, Video or Map combined with text", "grve-osmosis-vc-extension" ),
	"base" => "grve_media_box",
	"class" => "",
	"icon"      => "icon-wpb-grve-media-box",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Media type", "grve-osmosis-vc-extension" ),
			"param_name" => "media_type",
			"value" => array(
				__( "Image", "grve-osmosis-vc-extension" ) => 'image',
				__( "Image - Video Popup", "grve-osmosis-vc-extension" ) => 'image-video-popup',
				__( "Video", "grve-osmosis-vc-extension" ) => 'video',
				__( "Map", "grve-osmosis-vc-extension" ) => 'map',
			),
			"description" => __( "Select your media type.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Image", "grve-osmosis-vc-extension" ),
			"param_name" => "image",
			"description" => __( "Select an image.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Retina Image", "grve-osmosis-vc-extension" ),
			"param_name" => "retina_image",
			"description" => __( "Select a 2x image.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Video Link", "grve-osmosis-vc-extension" ),
			"param_name" => "video_link",
			"value" => "",
			"description" => __( "Type video URL e.g Vimeo/YouTube.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'image-video-popup', 'video' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Map Latitude", "grve-osmosis-vc-extension" ),
			"param_name" => "map_lat",
			"value" => "51.516221",
			"description" => __( "Type map Latitude.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'map' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Map Longtitude", "grve-osmosis-vc-extension" ),
			"param_name" => "map_lng",
			"value" => "-0.136986",
			"description" => __( "Type map Longtitude.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'map' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Map Zoom", "grve-osmosis-vc-extension" ),
			"param_name" => "map_zoom",
			"value" => array( 1, 2, 3 ,4, 5, 6, 7, 8 ,9 ,10 ,11 ,12, 13, 14, 15, 16, 17, 18, 19 ),
			"std" => 14,
			"description" => __( "Zoom of the map.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'map' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Map Height", "grve-osmosis-vc-extension" ),
			"param_name" => "map_height",
			"value" => "280",
			"description" => __( "Type map height.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'map' ) ),
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Custom marker", "grve-osmosis-vc-extension" ),
			"param_name" => "map_marker",
			"description" => __( "Select an icon for custom marker.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "media_type", 'value' => array( 'map' ) ),
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
			"value" => "Sample Text",
			"description" => __( "Enter your text.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "Title Link", "grve-osmosis-vc-extension" ),
			"param_name" => "title_link",
			"value" => "",
			"description" => __( "Enter title link.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Read More Title", "grve-osmosis-vc-extension" ),
			"param_name" => "read_more_title",
			"value" => "",
			"description" => __( "Enter your title for your link.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		$grve_vce_add_align,
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>