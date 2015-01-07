<?php
/**
 * Gallery Shortcode
 */

if( !function_exists( 'grve_gallery_shortcode' ) ) {

	function grve_gallery_shortcode( $attr, $content ) {

		$output = $start_block = $end_block = $item_class = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'ids' => '',
					'gallery_type' => 'grid',
					'gallery_columns' => '3',
					'item_gutter' => 'yes',
					'hide_image_title' => '',
					'hide_image_caption' => '',
					'zoom_effect' => 'in',
					'overlay_color' => 'dark',
					'overlay_opacity' => '60',
					'items_per_page' => '4',
					'slideshow_speed' => '3000',
					'navigation_type' => '1',
					'navigation_color' => 'light',
					'pause_hover' => 'no',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$attachments = explode( ",", $ids );

		if ( empty( $attachments ) ) {
			return '';
		}

		//Gallery Classes
		$gallery_classes = array( 'grve-element', 'grve-gallery' , 'grve-isotope', 'grve-gallery-popup' );

		if ( !empty( $el_class ) ) {
			array_push( $gallery_classes, $el_class);
		}

		$gallery_class_string = implode( ' ', $gallery_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$data_string = '';

		switch( $gallery_type ) {
			case 'masonry':
				$data_string = ' data-gutter="' . esc_attr( $item_gutter ) . '" data-type="' . esc_attr( $gallery_columns ) . '-columns" data-layout="masonry"';
				break;
			case 'multi-grid':
				$data_string = ' data-gutter="' . esc_attr( $item_gutter ) . '" data-type="' . esc_attr( $gallery_columns ) . '-columns" data-layout="packery"';
				break;
			case 'carousel':
				$data_string = ' data-items="' . esc_attr( $items_per_page ) . '" data-slider-speed="' . esc_attr( $slideshow_speed ) . '" data-slider-pause="' . esc_attr( $pause_hover ) . '"';
				break;
			case 'grid':
			default:
				$data_string = ' data-gutter="' . esc_attr( $item_gutter ) . '" data-type="' . esc_attr( $gallery_columns ) . '-columns" data-layout="fitRows"';
				break;
		}


		if ( 'carousel' == $gallery_type ) {
			//Gallery Output ( carousel)

			$image_size = 'grve-image-small-rect-horizontal';



			$output .= '<div class="grve-element grve-carousel-wrapper" style="' . $style . '">';

			if ( 0 != $navigation_type ) {

				$output .= '<div class="grve-carousel-navigation grve-' . esc_attr( $navigation_color ) . '" data-navigation-type="' . esc_attr( $navigation_type ) . '">';
				$output .= '	<div class="grve-carousel-buttons">';
				$output .= '		<div class="grve-carousel-prev grve-icon-nav-left"></div>';
				$output .= '		<div class="grve-carousel-next grve-icon-nav-right"></div>';
				$output .= '	</div>';
				$output .= '</div>';

			}
			$output .= '	<div class="grve-carousel grve-carousel-element ' . esc_attr( $el_class ) . '"' . $data_string . '>

			';

				foreach ( $attachments as $id ) {
					$thumb_src = wp_get_attachment_image_src( $id, $image_size );
					$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

					$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
					$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

					$output .= '<div class="grve-carousel-item">';
					$output .= '	<figure class="grve-image-hover">';
					$output .= '		<div class="grve-media">';
					$output .= '			<img src="' . esc_url( $thumb_src[0] ) . '" alt="' . $alt . '" ' . $image_dimensions . '>';
					$output .= '		</div>';
					$output .= '	</figure>';
					$output .= '</div>';

				}
			$output .= '	</div>';
			$output .= '</div>';
		} else {
			//Gallery Output ( grid / multi-grid / masonry)
			$output .= '<div class="' . esc_attr( $gallery_class_string ) . '" style="' . $style . '"' . $data_string . '>';
			$output .= '  <div class="grve-isotope-container">';

			$gallery_index = 0;
			$image_size = 'grve-image-small-square';
			$image_size_class = '';

			foreach ( $attachments as $id ) {
				$gallery_index++;

				if ( 'multi-grid' == $gallery_type ) {

					$grve_packery_data = grve_vce_get_packery_data( $gallery_index, $gallery_columns );
					$image_size_class = ' ' . $grve_packery_data['class'];
					$image_size = $grve_packery_data['image_size'];

				} elseif ( 'masonry' == $gallery_type ) {

					$grve_masonry_data = grve_vce_get_masonry_data( $gallery_index, $gallery_columns );
					$image_size_class = ' ' . $grve_masonry_data['class'];
					$image_size = $grve_masonry_data['image_size'];

				}


				$image_link_href =  wp_get_attachment_url( $id );
				$thumb_src = wp_get_attachment_image_src( $id, $image_size );
				$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

				$full_src = wp_get_attachment_image_src( $id, 'grve-image-fullscreen' );
				$image_title = get_post_field( 'post_title', $id );
				$caption = get_post_field( 'post_excerpt', $id );
				$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
				$alt = ! empty( $alt ) ? esc_attr( $alt ) : wptexturize( $image_title );

				$output .= '<div class="grve-isotope-item ' . $image_size_class . '">';
				$output .= '  <a href="' . esc_url( $full_src[0] ) . '">';
				$output .= '    <figure class="grve-image-hover grve-zoom-' . $zoom_effect . '">';
				$output .= '      <div class="grve-media grve-' . $overlay_color . '-overlay grve-opacity-' . $overlay_opacity . '">';
				$output .= '        <img src="' . esc_url( $thumb_src[0] ) . '" alt="' . $alt . '" ' . $image_dimensions . '>';
				$output .= '      </div>';
				$output .= '      <figcaption>';

					if ( !empty( $image_title ) && 'yes' != $hide_image_title  ) {
						$output .= '<h6 class="grve-title grve-' . esc_attr( $overlay_color ) . '">' . wptexturize( $image_title ) . '</h6>';
					}

					if ( !empty( $caption ) && 'yes' != $hide_image_caption ) {
						$output .= '<span class="grve-caption grve-' . esc_attr( $overlay_color ) . '">' . wptexturize( $caption ) . '</span>';
					}

				$output .= '      </figcaption>';
				$output .= '    </figure>';
				$output .= '  </a>';
				$output .= '</div>';

			}

			$output .= '  </div>';
			$output .= '</div>';
		}


		return $output;

	}
	add_shortcode( 'grve_gallery', 'grve_gallery_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Gallery", "grve-osmosis-vc-extension" ),
	"description" => __( "Numerous styles, multiple columns for galleries", "grve-osmosis-vc-extension" ),
	"base" => "grve_gallery",
	"class" => "",
	"icon"      => "icon-wpb-grve-gallery",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Gallery type", "grve-osmosis-vc-extension" ),
			"param_name" => "gallery_type",
			"value" => array(
				__( "Grid", "grve-osmosis-vc-extension" ) => 'grid',
				__( "Multi Grid", "grve-osmosis-vc-extension" ) => 'multi-grid',
				__( "Masonry", "grve-osmosis-vc-extension" ) => 'masonry',
				__( "Carousel", "grve-osmosis-vc-extension" ) => 'carousel',
			),
			"description" => __( "Select your gallery type.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type"			=> "attach_images",
			"admin_label"	=> true,
			"class"			=> "",
			"heading"		=> __( "Attach Images", "grve-osmosis-vc-extension" ),
			"param_name"	=> "ids",
			"description"	=> __( "Select your gallery images.", "grve-osmosis-vc-extension" ),
		),
		//Gallery ( grid / multi-grid /masonry )
		array(
			"type" => "dropdown",
			"heading" => __( "Columns", "grve-osmosis-vc-extension" ),
			"param_name" => "gallery_columns",
			"value" => array( '3', '4', '5' ),
			"description" => __( "Select number of columns.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Gutter between images", "grve-osmosis-vc-extension" ),
			"param_name" => "item_gutter",
			"value" => array(
				__( "Yes", "grve-osmosis-vc-extension" ) => 'yes',
				__( "No", "grve-osmosis-vc-extension" ) => 'no',
			),
			"description" => __( "Add gutter among images.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Hide Image Title", "grve-osmosis-vc-extension" ),
			"param_name" => "hide_image_title",
			"value" => Array( __( "If selected, image title will be hidden", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Hide Image Caption", "grve-osmosis-vc-extension" ),
			"param_name" => "hide_image_caption",
			"value" => Array( __( "If selected, image caption will be hidden", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Image Zoom Effect", "grve-osmosis-vc-extension" ),
			"param_name" => "zoom_effect",
			"value" => array(
				__( "Zoom In", "grve-osmosis-vc-extension" ) => 'in',
				__( "Zoom Out", "grve-osmosis-vc-extension" ) => 'out',
				__( "None", "grve-osmosis-vc-extension" ) => 'none',
			),
			"description" => __( "Choose the image zoom effect.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Overlay Color", "grve-osmosis-vc-extension" ),
			"param_name" => "overlay_color",
			"value" => array(
				__( "Dark", "grve-osmosis-vc-extension" ) => 'dark',
				__( "Light", "grve-osmosis-vc-extension" ) => 'light',
			),
			"description" => __( "Choose the image color overlay.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Overlay Opacity", "grve-osmosis-vc-extension" ),
			"param_name" => "overlay_opacity",
			"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
			"std" => 80,
			"description" => __( "Choose the opacity for the overlay.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'grid', 'multi-grid', 'masonry' ) ),
		),
		//Gallery ( carousel )
		array(
			"type" => "dropdown",
			"heading" => __( "Items per page", "grve-osmosis-vc-extension" ),
			"param_name" => "items_per_page",
			"value" => array( '3', '4', '5' ),
			"description" => __( "Number of images per page", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Slideshow Speed", "grve-osmosis-vc-extension" ),
			"param_name" => "slideshow_speed",
			"value" => '3000',
			"description" => __( "Slideshow Speed in ms.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Pause on Hover", "grve-osmosis-vc-extension" ),
			"param_name" => "pause_hover",
			"value" => Array( __( "If selected, carousel will be paused on hover", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Navigation Type", "grve-osmosis-vc-extension" ),
			"param_name" => "navigation_type",
			'value' => array(
				__( 'Style 1' , 'grve-osmosis-vc-extension' ) => '1',
				__( 'Style 2' , 'grve-osmosis-vc-extension' ) => '2',
				__( 'Style 3' , 'grve-osmosis-vc-extension' ) => '3',
				__( 'Style 4' , 'grve-osmosis-vc-extension' ) => '4',
				__( 'No Navigation' , 'grve-osmosis-vc-extension' ) => '0',
			),
			"description" => __( "Select your Navigation type.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Navigation Color", "grve-osmosis-vc-extension" ),
			"param_name" => "navigation_color",
			'value' => array(
				__( 'Light' , 'grve-osmosis-vc-extension' ) => 'light',
				__( 'Dark' , 'grve-osmosis-vc-extension' ) => 'dark',
			),
			"description" => __( "Select the background Navigation color.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "gallery_type", 'value' => array( 'carousel' ) ),
		),
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>