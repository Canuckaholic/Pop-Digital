<?php

	$output = $img_class = $el_class = $section_id = $section_id_string = $out_overlay = $out_image_bg = $out_video_bg = '';

	extract(
		shortcode_atts(
			array(
				'section_id'      => '',
				'font_color'      => '',
				'heading_color' => '',
				'section_type'      => 'fullwidth-background',
				'section_full_height' => 'no',
				'bg_color'        => '',
				'bg_type'        => '',
				'bg_image'        => '',
				'bg_image_type' => 'none',
				'pattern_overlay' => '',
				'color_overlay' => '',
				'opacity_overlay' => '',
				'bg_video_webm' => '',
				'bg_video_mp4' => '',
				'bg_video_ogv' => '',
				'padding_top' => '',
				'padding_bottom' => '',
				'margin_bottom' => '',
				'header_feature' => '',
				'footer_feature' => '',
				'el_class'        => '',
				'css' => '',
			),
			$atts
		)
	);


	if ( 'vc_row' == $this->shortcode ) {


		if ( !empty ( $section_id ) ) {
			$section_id_string = 'id="' . $section_id . '"';
		}

		$section_data = 'data-section-type="' . esc_attr( $section_type ) . '" data-image-type="' . esc_attr( $bg_image_type ) . '" data-full-height="' . esc_attr( $section_full_height ) . '"';

		//Section Style
		$style = grve_build_shortcode_style( $bg_color, $font_color, $padding_top, $padding_bottom, $margin_bottom );

		//Section Classses
		$section_classes = array( 'grve-section' );

		if ( !empty ( $heading_color ) ) {
			array_push( $section_classes, 'grve-' . $heading_color );
		}
		if ( !empty ( $header_feature ) ) {
			array_push( $section_classes, 'grve-feature-header');
		}
		if ( !empty ( $footer_feature ) ) {
			array_push( $section_classes, 'grve-feature-footer');
		}
		if ( !empty ( $el_class ) ) {
			array_push( $section_classes, $el_class);
		}
		$section_string = implode( ' ', $section_classes );

		//Overlay Classes
		$overlay_classes = array();
		if ( !empty ( $pattern_overlay ) ) {
			array_push( $overlay_classes, 'grve-pattern');
		}
		if ( !empty ( $color_overlay ) ) {
			array_push( $overlay_classes, 'grve-' . $color_overlay . '-overlay');
			if ( !empty ( $opacity_overlay ) ) {
				array_push( $overlay_classes, 'grve-overlay-' . $opacity_overlay );
			}
		}
		$overlay_string = implode( ' ', $overlay_classes );

		if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type ) && !empty ( $overlay_classes ) ) {
			$out_overlay .= '  <div class="' . esc_attr( $overlay_string ) .'"></div>';
		}


		//Background Image
		$img_style = grve_build_shortcode_img_style( $bg_image ,$bg_image_type );

		if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' !== $bg_image_type ) ) {
			$out_image_bg .= '  <div class="grve-bg-image"  ' . $img_style . '></div>';
		}

		if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' == $bg_image_type ) ) {
			$out_image_bg .= '  <div class="grve-bg-image" data-stellar-ratio="0.5" ' . $img_style . '></div>';
		}

		//Background Video
		if ( 'hosted_video' == $bg_type && ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) ) {
			$out_video_bg .= '<div class="grve-bg-video" data-stellar-ratio="0.5">';
			$out_video_bg .=  '<video preload="auto" autoplay="" loop="" muted="muted">';
			if ( !empty ( $bg_video_webm ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_webm ) . '" type="video/webm">';
			}
			if ( !empty ( $bg_video_mp4 ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty ( $bg_video_ogv ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_ogv ) . '" type="video/ogg">';
			}
			$out_video_bg .=  '</video>';
			$out_video_bg .= '</div>';
		}


		//Section Output
		$output .= '<div ' . $section_id_string . ' class="' . esc_attr( $section_string ) . '" ' . $style . ' ' . $section_data . '>';

		$output	.= '  <div class="grve-row">';
		$output	.= do_shortcode( $content );
		$output	.= '  </div>';

		$output .= $out_overlay;

		$output .= $out_image_bg;
		$output .= $out_video_bg;

		$output	.= '</div>';

	} else{

		$css_custom = grve_vc_shortcode_custom_css_class( $css, '' );
		$row_classes = array( 'grve-row' );
		if ( !empty( $css_custom ) ) {
			array_push( $row_classes, $css_custom );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $row_classes, $el_class );
		}
		$row_css_string = implode( ' ', $row_classes );

		$output .= '<div class="' . esc_attr( $row_css_string ) . '">';
		$output	.= do_shortcode( $content );
		$output	.= '</div>';
	}

	echo $output;
?>