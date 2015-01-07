<?php
/**
 * Slider Shortcode
 */

if( !function_exists( 'grve_slider_shortcode' ) ) {

	function grve_slider_shortcode( $attr, $content ) {

		$output = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'ids' => '',
					'slideshow_speed' => '3500',
					'navigation_type' => '1',
					'navigation_color' => 'light',
					'image_custom_title' => 'default',
					'hide_image_title' => '',
					'hide_image_caption' => '',
					'custom_title' => '',
					'custom_caption' => '',
					'title_color' => 'dark',
					'custom_title_align' => 'left',
					'custom_title_line_type' => 'no-line',
					'pause_hover' => 'no',
					'auto_height' => 'no',
					'margin_bottom' => '',
					'zoom_effect' => 'in',
					'overlay_color' => 'dark',
					'overlay_opacity' => '60',
					'el_class' => '',
				),
				$attr
			)
		);

		$attachments = explode( ",", $ids );

		if ( empty( $attachments ) ) {
			return '';
		}

		$image_size = 'grve-image-fullscreen';

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$slider_data = '';
		$slider_data .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$slider_data .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$slider_data .= ' data-navigation-type="' . esc_attr( $navigation_type ) . '"';
		$slider_data .= ' data-slider-autoheight="' . esc_attr( $auto_height ) . '"';

		$output .= '<div class="grve-element grve-carousel-wrapper"  style="' . $style . ' ">';

		if ( 0 != $navigation_type ) {
			$output .= '<div class="grve-carousel-navigation grve-' . esc_attr( $navigation_color ) . '" data-navigation-type="' . esc_attr( $navigation_type ) . '">';
			$output .= '	<div class="grve-carousel-buttons">';
			$output .= '		<div class="grve-carousel-prev grve-icon-nav-left"></div>';
			$output .= '		<div class="grve-carousel-next grve-icon-nav-right"></div>';
			$output .= '	</div>';
			$output .= '</div>';
		}

		// Custom Title
		if( 'default' != $image_custom_title ) {
			$output .= '<div class="grve-custom-title-wrapper">';
			$output .= '	<div class="grve-custom-title-content grve-align-' . esc_attr( $custom_title_align ) . ' grve-' . esc_attr( $title_color ) . '">';
				if ( !empty( $custom_title ) ) {
				$output .= '	<h3 class="grve-title grve-title-' . esc_attr( $custom_title_line_type ) . '"><span>' . $custom_title .'</span></h3>';
			}
			if ( !empty( $custom_caption ) ) {
				$output .= '	<div class="grve-caption">' . $custom_caption .'</div>';
			}
			$output .= '	</div>';
			$output .= '</div>';
		}

		$output .= '<div class="grve-slider grve-carousel-element ' . esc_attr( $el_class ) . '"' . $slider_data . '>';

		foreach ( $attachments as $id ) {
			$image_link_href =  wp_get_attachment_url( $id );
			$thumb_src = wp_get_attachment_image_src( $id, $image_size );
			$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

			$image_title = get_post_field( 'post_title', $id );
			$caption = get_post_field( 'post_excerpt', $id );
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : wptexturize( $image_title );

			$output .= '<div class="grve-slider-item">';
			$output .= '	<figure class="grve-image-hover grve-zoom-' . esc_attr( $zoom_effect ) . '">';
			$output .= '		<div class="grve-media grve-' . esc_attr( $overlay_color ) . '-overlay grve-opacity-' . esc_attr( $overlay_opacity ) . '">';
			$output .= '			<img src="' . esc_url( $thumb_src[0] ) . '" alt="' . $alt . '" ' . $image_dimensions . '>';
			$output .= '		</div>';
			if ( 'custom-title' != $image_custom_title ) {
				$output .= '<figcaption>';

					if ( !empty( $image_title ) && 'yes' != $hide_image_title ) {
						$output .= '<h6 class="grve-title grve-' . esc_attr( $overlay_color ) . '">' . wptexturize( $image_title ) . '</h6>';
					}

					if ( !empty( $caption ) && 'yes' != $hide_image_caption ) {
						$output .= '<span class="grve-caption grve-' . esc_attr( $overlay_color ) . '">' . wptexturize( $caption ) . '</span>';
					}

				$output .= '</figcaption>';
			}
			$output .= '	</figure>';
			$output .= '</div>';

		}
		$output .= '	</div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'grve_slider', 'grve_slider_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Slider", "grve-osmosis-vc-extension" ),
	"description" => __( "Create a simple slider", "grve-osmosis-vc-extension" ),
	"base" => "grve_slider",
	"class" => "",
	"icon"      => "icon-wpb-grve-slider",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type"			=> "attach_images",
			"admin_label"	=> true,
			"class"			=> "",
			"heading"		=> __( "Attach Images", "grve-osmosis-vc-extension" ),
			"param_name"	=> "ids",
			"description"	=> __( "Select your slider images.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Slider Title & Caption", "grve-osmosis-vc-extension" ),
			"param_name" => "image_custom_title",
			"value" => array(
				__( "Default Image Title & Caption", "grve-osmosis-vc-extension" ) => 'default',
				__( "Custom Title", "grve-osmosis-vc-extension" ) => 'custom-title',
			),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Hide Image Title", "grve-osmosis-vc-extension" ),
			"param_name" => "hide_image_title",
			"value" => Array( __( "If selected, image title will be hidden", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'default' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Hide Image Caption", "grve-osmosis-vc-extension" ),
			"param_name" => "hide_image_caption",
			"value" => Array( __( "If selected, image caption will be hidden", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'default' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "custom_title",
			"value" => "",
			"description" => __( "Enter your title.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'custom-title' ) ),
		),
		array(
			"type" => "textarea",
			"heading" => __( "Caption", "grve-osmosis-vc-extension" ),
			"param_name" => "custom_caption",
			"value" => "",
			"description" => __( "Enter your caption.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'custom-title' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Line type", "grve-osmosis-vc-extension" ),
			"param_name" => "custom_title_line_type",
			"value" => array(
				__( "None", "grve-osmosis-vc-extension" ) => 'no-line',
				__( "Simple", "grve-osmosis-vc-extension" ) => 'line',
				__( "Double", "grve-osmosis-vc-extension" ) => 'double-line',
				__( "Double Bottom", "grve-osmosis-vc-extension" ) => 'double-bottom-line',
			),
			"description" => '',
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'custom-title' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Title & Caption Color", "grve-osmosis-vc-extension" ),
			"param_name" => "title_color",
			"value" => array(
				__( "Dark", "grve-osmosis-vc-extension" ) => 'dark',
				__( "Light", "grve-osmosis-vc-extension" ) => 'light',
				__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
				__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
				__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
				__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
				__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
			),
			"description" => __( "Color of title and caption.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'custom-title' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Slider Title & Caption Align", "grve-osmosis-vc-extension" ),
			"param_name" => "custom_title_align",
			"value" => array(
				__( "Left", "grve-osmosis-vc-extension" ) => 'left',
				__( "Center", "grve-osmosis-vc-extension" ) => 'center',
				__( "Right", "grve-osmosis-vc-extension" ) => 'right',
			),
			"dependency" => Array( 'element' => "image_custom_title", 'value' => array( 'custom-title' ) ),
		),
		$grve_vce_add_slideshow_speed,
		array(
			"type" => 'checkbox',
			"heading" => __( "Pause on Hover", "grve-osmosis-vc-extension" ),
			"param_name" => "pause_hover",
			"value" => Array( __( "If selected, slider will be paused on hover", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		$grve_vce_add_auto_height,
		$grve_vce_add_navigation_type,
		$grve_vce_add_navigation_color,
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
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Overlay Opacity", "grve-osmosis-vc-extension" ),
			"param_name" => "overlay_opacity",
			"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
			"std" => 80,
			"description" => __( "Choose the opacity for the overlay.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>