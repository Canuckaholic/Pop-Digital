<?php

/*
*	Feature Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Header Feature Section Data
 */

function grve_get_feature_data() {
	global $post;

	$feature_data_fullscreen = 'no';
	$feature_data_overlap = 'no';
	$feature_data_header_position = 'above-feature';
	$feature_header_style = 'default';

	$grve_woo_shop = false;
	$feature_size = '';

	if ( grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		$grve_woo_shop = true;
	}

	if ( is_singular() || $grve_woo_shop  ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );

		if ( ( $post_type == 'page' && is_singular( 'page' ) ) || ( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) || $grve_woo_shop ) {
			$feature_element = get_post_meta( $post_id, 'grve_page_feature_element', true );
			if ( !empty( $feature_element ) ) {
				$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
				$feature_header_position = get_post_meta( $post_id, 'grve_page_feature_header_position', true );
				if ( 'below' == $feature_header_position ) {
					$feature_data_header_position = 'bellow-feature';
				}
				$feature_header_integration = get_post_meta( $post_id, 'grve_page_feature_header_integration', true );
				if ( empty($feature_size) ) {
					$feature_data_fullscreen = 'yes';
				}
				$feature_data_overlap = !empty( $feature_header_integration ) ? $feature_header_integration : 'no';
				if ( 'slider' == $feature_element ) {
					$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
					if ( !empty( $slider_items ) ) {
						$feature_header_style = isset( $slider_items[0]['header_style'] ) && 'yes' == $feature_data_overlap ? $slider_items[0]['header_style'] : 'default';
					}
				} else {
					$feature_header_style = get_post_meta( $post_id, 'grve_page_feature_header_style', true );
					if ( empty( $feature_header_style ) ) {
						$feature_header_style = 'default';
					}
				}
			}
		}
	}
	return array(
		'data_fullscreen' => $feature_data_fullscreen,
		'data_overlap' => $feature_data_overlap,
		'data_header_position' => $feature_data_header_position,
		'header_style' => 'grve-' . $feature_header_style,
	);

}

/**
 * Prints Header Feature Section Page/Post/Portfolio
 */
function grve_print_header_feature() {
	global $post;

	$grve_woo_shop = false;
	if ( grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		$grve_woo_shop = true;
	}

	if ( is_singular() || $grve_woo_shop  ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}

		$post_type = get_post_type( $post_id );

		if ( ( $post_type == 'page' && is_singular( 'page' ) ) || ( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) || $grve_woo_shop ) {

			$feature_element = get_post_meta( $post_id, 'grve_page_feature_element', true );
			if ( !empty( $feature_element ) ) {

				switch( $feature_element ) {

					case 'image':
						$image_item = get_post_meta( $post_id, 'grve_page_image_item', true );
						if ( !empty( $image_item ) ) {
							grve_print_header_feature_image( $post_id, $image_item );
						}
						break;
					case 'video':
						$video_item = get_post_meta( $post_id, 'grve_page_video_item', true );
						if ( !empty( $video_item ) ) {
							grve_print_header_feature_video( $post_id, $video_item );
						}
						break;
					case 'slider':
						$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
						if ( !empty( $slider_items ) ) {
							grve_print_header_feature_slider( $post_id, $slider_items );
						}
						break;
					case 'title':
						$title_item = get_post_meta( $post_id, 'grve_page_title_item', true );
						if ( !empty( $title_item ) ) {
							grve_print_header_feature_title( $post_id, $title_item );
						}
						break;
					case 'map':
						$map_items = get_post_meta( $post_id, 'grve_page_map_items', true );
						if ( !empty( $map_items ) ) {
							grve_print_header_feature_map( $post_id, $map_items );
						}
						break;
					default:
						break;

				}
			}
		} else if ( $post_type == 'post' && is_singular( 'post' )  ) {
			if ( get_post_format() == 'gallery' ) {
				$gallery_mode = get_post_meta( $post_id, 'grve_post_type_gallery_mode', true );
				if ( 'slider_top' == $gallery_mode ) {
					$slider_items = get_post_meta( $post_id, 'grve_post_slider_items', true );
					if ( !empty( $slider_items ) ) {
						grve_print_header_feature_slider_simple( $post_id, $slider_items, 'post'   );
					}
				}
			}

		}
	}
}

/**
 * Prints Simple Header Feature Slider ( Post/Portfolio )
 */
function grve_print_header_feature_slider_simple( $post_id, $slider_items, $type ) {

	$slider_data = '';

	if ( 'portfolio' == $type ) {

		$slider_size = get_post_meta( $post_id, 'grve_portfolio_feature_size', true );
		$slider_height = get_post_meta( $post_id, 'grve_portfolio_feature_height', true );
		if ( empty( $slider_height ) ) {
			$slider_height = '550';
		}
		if ( !empty( $slider_size ) && !empty( $slider_height ) ) {
			$slider_data_class = 'data-height="' . esc_attr( $slider_height ) . '" style="height:' . esc_attr( $slider_height ) . 'px;"';
		} else {
			$slider_data_class = 'class="grve-fullscreen"';
		}

		$slider_settings = get_post_meta( $post_id, 'grve_portfolio_slider_settings', true );
		$slider_data = grve_get_slider_settings_data( $slider_settings );


	} else {

		$slider_height = get_post_meta( $post_id, 'grve_post_slider_height', true );
		if ( empty( $slider_height ) ) {
			$slider_height = '550';
		}
		$slider_data_class = 'data-height="' . esc_attr( $slider_height ) . '" style="height:' . esc_attr( $slider_height ) . 'px;"';

	}
?>
	<div id="grve-feature-section" <?php echo $slider_data_class; ?>>
		<div class="grve-feature-element grve-slider"<?php echo $slider_data; ?>>
			<ul class="slides">
<?php
			foreach ( $slider_items as $slider_item ) {
				$media_id = $slider_item['id'];
				$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
				$image_url = esc_url( $full_src[0] );
				$image_dimensions = 'width="' . $full_src[1] . '" height="' . $full_src[2] . '"';
				$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
				$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
				echo '<li><img src="' . $image_url . '" alt="' . $alt . '" ' . $image_dimensions . '></li>';
			}
?>
			</ul>
		</div>
	</div>
<?php

}

/**
 * Prints Overlay Container
 */
function grve_print_overlay_container( $pattern_overlay, $color_overlay, $opacity_overlay  ) {

	$overlay_classes = array();

	if ( !empty ( $pattern_overlay ) ) {
		array_push( $overlay_classes, 'grve-pattern');
	}
	if ( !empty ( $color_overlay ) ) {
		array_push( $overlay_classes, 'grve-' . $color_overlay . '-overlay');
	}
	if ( !empty ( $opacity_overlay ) ) {
		array_push( $overlay_classes, 'grve-overlay-' . $opacity_overlay );
	}

	$overlay_string = implode( ' ', $overlay_classes );
	if ( !empty ( $overlay_string ) ) {
		echo '<div class="' . esc_attr( $overlay_string ) . '"></div>';
	}
}

/**
 * Prints Background Image Container
 */
function grve_print_bg_image_container( $media_id, $bg_position = 'center-center' ) {

	$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
	$image_url = esc_url( $full_src[0] );

	echo '<div class="grve-bg-image grve-bg-position-' . esc_attr( $bg_position ) . '" style="background-image: url(' . $image_url . ');"></div>';

}


/**
 * Prints Background Video Container
 */
function grve_print_bg_video_container( $bg_video_webm, $bg_video_mp4, $bg_video_ogv, $image_url ) {

	$out_video_bg  = '';

	if ( !empty( $image_url ) ) {
		$out_video_bg .= '<div class="grve-bg-image" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
	}

	if ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) {
		$out_video_bg .= '<div class="grve-bg-video">';
		$out_video_bg .= '  <video preload="auto" autoplay="" loop="" muted="muted">';
		if ( !empty ( $bg_video_webm ) ) {
			$out_video_bg .= '<source src="' . esc_url( $bg_video_webm ) . '" type="video/webm">';
		}
		if ( !empty ( $bg_video_mp4 ) ) {
			$out_video_bg .= '<source src="' . esc_url( $bg_video_mp4 ) . '" type="video/mp4">';
		}
		if ( !empty ( $bg_video_ogv ) ) {
			$out_video_bg .= '<source src="' . esc_url( $bg_video_ogv ) . '" type="video/ogg">';
		}
		$out_video_bg .= '  </video>';
		$out_video_bg .= '</div>';


	}

	echo $out_video_bg;

}


/**
 * Get Feature Section position data
 */
function grve_get_feature_position_data( $feature_size, $feature_height , $bg_color = '' ) {

	$feature_style_height = $feature_data_style = '';

	if ( !empty($feature_size) ) {
		if ( empty( $feature_height ) ) {
			$feature_height = "550";
		}
		if ( !empty($bg_color) ) {
			$feature_data_style = 'data-height="' . esc_attr( $feature_height ) . '" style="height:' . esc_attr( $feature_height ) . 'px; background-color: ' . esc_attr( $bg_color ) . ';"';
		} else {
			$feature_data_style = 'data-height="' . esc_attr( $feature_height ) . '" style="height:' . esc_attr( $feature_height ) . 'px;"';
		}
		$feature_style_height = 'style="height:' . esc_attr( $feature_height ) . 'px;"';
	} else {
		if ( !empty($bg_color) ) {
			$feature_data_style = 'style="background-color: ' . esc_attr( $bg_color ) . ';"';
		}
	}
	return array(
		'style_height' => $feature_style_height,
		'data_style' => $feature_data_style,
	);
}

/**
 * Prints Header Section Feature Video
 */
function grve_print_header_feature_video( $post_id, $video_item  ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$video_webm = grve_array_value( $video_item, 'video_webm' );
	$video_mp4 = grve_array_value( $video_item, 'video_mp4' );
	$video_ogv = grve_array_value( $video_item, 'video_ogv' );
	$video_bg_image = grve_array_value( $video_item, 'video_bg_image' );

	$title = grve_array_value( $video_item, 'title' );
	$caption = grve_array_value( $video_item, 'caption' );
	$text_align = grve_array_value( $video_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $video_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $video_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $video_item, 'caption_color', 'dark' );

	$style = grve_array_value( $video_item, 'style', 'default' );
	$el_class = grve_array_value( $video_item, 'el_class' );

	$pattern_overlay = grve_array_value( $video_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $video_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $video_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $video_item, 'button_text' );
	$button_url = grve_array_value( $video_item, 'button_url' );
	$button_type = grve_array_value( $video_item, 'button_type', '' );
	$button_size = grve_array_value( $video_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $video_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $video_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $video_item, 'button_target', '_self' );

	$button_text2 = grve_array_value( $video_item, 'button_text2' );
	$button_url2 = grve_array_value( $video_item, 'button_url2' );
	$button_type2 = grve_array_value( $video_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $video_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $video_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $video_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $video_item, 'button_target2', '_self' );

	$feature_position = grve_get_feature_position_data( $feature_size, $feature_height );
	$feature_go_to_section = get_post_meta( $post_id, 'grve_page_feature_go_to_section', true );
	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="<?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo $feature_position['style_height']; ?>>

		<div class="grve-feature-section-inner" data-item="video" <?php echo $feature_position['data_style']; ?>>
			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php if ( !empty( $title ) ) { ?>
					<h1 class="grve-title grve-<?php echo esc_attr( $title_color ); ?>"><span><?php echo $title; ?></span></h1>
					<?php } ?>
					<?php if ( !empty( $caption ) ) { ?>
					<div class="grve-description grve-<?php echo esc_attr( $caption_color ); ?>"><?php echo $caption; ?></div>
					<?php } ?>
					<?php if( !empty( $button_text ) || !empty( $button_text2 ) ) { ?>
					<div class="grve-button-wrapper">
						<?php grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target ); ?>
						<?php grve_print_feature_button( $button_text2, $button_url2, $button_type2, $button_size2, $button_color2, $button_shape2, $button_target2 ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
				grve_print_overlay_container( $pattern_overlay, $color_overlay, $opacity_overlay  );
				grve_print_bg_video_container( $video_webm, $video_mp4, $video_ogv, $video_bg_image );
				grve_print_feature_go_to_section( $feature_go_to_section, $title_color );
			?>
		</div>

	</div>
<?php
}

/**
 * Prints Header Section Feature Image
 */
function grve_print_header_feature_title( $post_id, $title_item  ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$title = grve_array_value( $title_item, 'title' );
	$caption = grve_array_value( $title_item, 'caption' );
	$text_align = grve_array_value( $title_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $title_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $title_item, 'title_color', '#ffffff' );
	$caption_color = grve_array_value( $title_item, 'caption_color', '#ffffff' );
	$bg_color = grve_array_value( $title_item, 'bg_color', '#303030' );

	$style = grve_array_value( $title_item, 'style', 'default' );
	$el_class = grve_array_value( $title_item, 'el_class' );


	$feature_position = grve_get_feature_position_data( $feature_size, $feature_height, $bg_color );
	$feature_go_to_section = get_post_meta( $post_id, 'grve_page_feature_go_to_section', true );
	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="<?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo $feature_position['style_height']; ?>>

		<div class="grve-feature-section-inner" data-item="title" <?php echo $feature_position['data_style']; ?>>

			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php if ( !empty( $title ) ) { ?>
					<h1 class="grve-title" style="color:<?php echo esc_attr( $title_color ); ?>"><span><?php echo $title; ?></span></h1>
					<?php } ?>
					<?php if ( !empty( $caption ) ) { ?>
					<div class="grve-description" style="color:<?php echo esc_attr( $caption_color ); ?>"><?php echo $caption; ?></div>
					<?php } ?>
				</div>
			</div>
			<!-- End Custom Title -->
			<?php grve_print_feature_go_to_section( $feature_go_to_section, $title_color ); ?>
		</div>

	</div>
<?php
}

/**
 * Prints Header Section Feature Image ( Page / Portfolio )
 */
function grve_print_header_feature_image( $post_id, $image_item ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$media_id = $image_item['id'];

	$title = grve_array_value( $image_item, 'title' );
	$caption = grve_array_value( $image_item, 'caption' );
	$text_align = grve_array_value( $image_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $image_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $image_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $image_item, 'caption_color', 'dark' );

	$bg_position = grve_array_value( $image_item, 'bg_position', 'center-center' );
	$bg_effect = grve_array_value( $image_item, 'bg_effect', 'none' );
	$style = grve_array_value( $image_item, 'style', 'default' );
	$el_class = grve_array_value( $image_item, 'el_class' );

	$pattern_overlay = grve_array_value( $image_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $image_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $image_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $image_item, 'button_text' );
	$button_url = grve_array_value( $image_item, 'button_url' );
	$button_type = grve_array_value( $image_item, 'button_type', '' );
	$button_size = grve_array_value( $image_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $image_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $image_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $image_item, 'button_target', '_self' );

	$button_text2 = grve_array_value( $image_item, 'button_text2' );
	$button_url2 = grve_array_value( $image_item, 'button_url2' );
	$button_type2 = grve_array_value( $image_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $image_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $image_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $image_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $image_item, 'button_target2', '_self' );

	$feature_position = grve_get_feature_position_data( $feature_size, $feature_height );
	$feature_go_to_section = get_post_meta( $post_id, 'grve_page_feature_go_to_section', true );
	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="<?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo $feature_position['style_height']; ?>>

		<div class="grve-feature-section-inner" data-bg-effect="<?php echo esc_attr( $bg_effect ); ?>"  data-item="image" <?php echo $feature_position['data_style']; ?>>
			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php if ( !empty( $title ) ) { ?>
					<h1 class="grve-title grve-<?php echo esc_attr( $title_color ); ?>"><span><?php echo $title; ?></span></h1>
					<?php } ?>
					<?php if ( !empty( $caption ) ) { ?>
					<div class="grve-description grve-<?php echo esc_attr( $caption_color ); ?>"><?php echo $caption; ?></div>
					<?php } ?>					
					<?php if( !empty( $button_text ) || !empty( $button_text2 ) ) { ?>
					<div class="grve-button-wrapper">
						<?php grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target ); ?>
						<?php grve_print_feature_button( $button_text2, $button_url2, $button_type2, $button_size2, $button_color2, $button_shape2, $button_target2 ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- End Custom Title -->

			<?php
				grve_print_overlay_container( $pattern_overlay, $color_overlay, $opacity_overlay  );
				grve_print_bg_image_container( $media_id, $bg_position );
				grve_print_feature_go_to_section( $feature_go_to_section, $title_color );
			?>
		</div>

	</div>
<?php
}

/**
 * Get slider settings data ( Page / Portfolio )
 */
function grve_get_slider_settings_data( $slider_settings ) {
	$slider_data = '';

	if ( !empty( $slider_settings ) ) {

		$slider_speed = grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
		$slider_pause = grve_array_value( $slider_settings, 'slider_pause', 'no' );
		$slider_transition = grve_array_value( $slider_settings, 'transition', 'slide' );

		$slider_data .= ' data-slider-speed="' . $slider_speed . '"';
		$slider_data .= ' data-slider-pause="' . $slider_pause . '"';
		$slider_data .= ' data-slider-transition="' . $slider_transition . '"';

	}
	return $slider_data;
}

/**
 * Prints Advanced Header Feature Slider ( Page / Portfolio )
 */
function grve_print_header_feature_slider( $post_id, $slider_items ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );
	$slider_settings = get_post_meta( $post_id, 'grve_page_slider_settings', true );

	$slider_data = grve_get_slider_settings_data( $slider_settings );
	$feature_position = grve_get_feature_position_data( $feature_size, $feature_height );

	$slider_dir_nav = grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_nav_advanced = grve_array_value( $slider_settings, 'nav_advanced' );

	$slider_nav_data = '';
	$slider_nav_data .= ' data-navigation-type="' . $slider_dir_nav . '"';

	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}

?>
	<div id="grve-feature-section" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo $feature_position['style_height']; ?>>
		<div class="grve-feature-section-inner grve-carousel-wrapper" <?php echo $feature_position['data_style']; ?> data-item="slider">

<?php
		if ( 0 != $slider_dir_nav ) {
?>
			<div class="grve-carousel-navigation grve-<?php echo esc_attr( $slider_dir_nav_color ); ?>" <?php echo $slider_nav_data; ?>>
				<div class="grve-carousel-buttons">
					<div class="grve-carousel-prev grve-icon-nav-left"></div>
					<div class="grve-carousel-next grve-icon-nav-right"></div>
				</div>
			</div>
<?php
		}
?>
			<div id="grve-feature-slider" class="grve-slider" <?php echo $slider_data; ?>>

<?php
			foreach ( $slider_items as $slider_item ) {
				$media_id = $slider_item['id'];

				$title = grve_array_value( $slider_item, 'title' );
				$caption = grve_array_value( $slider_item, 'caption' );
				$text_align = grve_array_value( $slider_item, 'text_align', 'left' );
				$text_animation = grve_array_value( $slider_item, 'text_animation', 'fade-in' );
				$title_color = grve_array_value( $slider_item, 'title_color', 'dark' );
				$caption_color = grve_array_value( $slider_item, 'caption_color', 'dark' );

				$bg_position = grve_array_value( $slider_item, 'bg_position', 'center-center' );
				$style = grve_array_value( $slider_item, 'style', 'default' );
				$header_style = grve_array_value( $slider_item, 'header_style', 'default' );
				$el_class = grve_array_value( $slider_item, 'el_class' );

				$pattern_overlay = grve_array_value( $slider_item, 'pattern_overlay' );
				$color_overlay = grve_array_value( $slider_item, 'color_overlay' );
				$opacity_overlay = grve_array_value( $slider_item, 'opacity_overlay', '10' );

				$button_text = grve_array_value( $slider_item, 'button_text' );
				$button_url = grve_array_value( $slider_item, 'button_url' );
				$button_type = grve_array_value( $slider_item, 'button_type', '' );
				$button_size = grve_array_value( $slider_item, 'button_size', 'medium' );
				$button_color = grve_array_value( $slider_item, 'button_color', 'primary-1' );
				$button_shape = grve_array_value( $slider_item, 'button_shape', 'square' );
				$button_target = grve_array_value( $slider_item, 'button_target', '_self' );

				$button_text2 = grve_array_value( $slider_item, 'button_text2' );
				$button_url2 = grve_array_value( $slider_item, 'button_url2' );
				$button_type2 = grve_array_value( $slider_item, 'button_type2', '' );
				$button_size2 = grve_array_value( $slider_item, 'button_size2', 'medium' );
				$button_color2 = grve_array_value( $slider_item, 'button_color2', 'primary-1' );
				$button_shape2 = grve_array_value( $slider_item, 'button_shape2', 'square' );
				$button_target2 = grve_array_value( $slider_item, 'button_target2', '_self' );


?>
				<div class="grve-slider-item <?php echo esc_attr( $el_class ); ?>" data-style="<?php echo esc_attr( $header_style ); ?>">
					<div class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
						<div class="grve-container">
							<?php if ( !empty( $title ) ) { ?>
							<h1 class="grve-title grve-<?php echo esc_attr( $title_color ); ?>"><span><?php echo $title; ?></span></h1>
							<?php } ?>
							<?php if ( !empty( $caption ) ) { ?>
							<div class="grve-description grve-<?php echo esc_attr( $caption_color ); ?>"><?php echo $caption; ?></div>
							<?php } ?>							
							<?php if( !empty( $button_text ) || !empty( $button_text2 ) ) { ?>
							<div class="grve-button-wrapper">
								<?php grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target ); ?>
								<?php grve_print_feature_button( $button_text2, $button_url2, $button_type2, $button_size2, $button_color2, $button_shape2, $button_target2 ); ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php
						grve_print_overlay_container( $pattern_overlay, $color_overlay, $opacity_overlay  );
						grve_print_bg_image_container( $media_id, $bg_position );
					?>
				</div>
<?php
			}
?>
			</div>
		</div>
	</div>
<?php

}

/**
 * Prints Header Feature Map ( Page / Portfolio )
 */
function grve_print_header_feature_map( $post_id, $map_items ) {

	wp_enqueue_script( 'grve-googleapi-script');
	wp_enqueue_script( 'grve-maps-script');

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$map_settings = get_post_meta( $post_id, 'grve_page_map_settings', true );
	$map_marker = grve_array_value( $map_settings, 'marker', get_template_directory_uri() . '/images/markers/markers.png' );
	$map_zoom = grve_array_value( $map_settings, 'zoom', 14 );

	$map_lat = grve_array_value( $map_items[0], 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_items[0], 'lng', '-0.136986' );


	$feature_position = grve_get_feature_position_data( $feature_size, $feature_height );

?>
	<div id="grve-feature-section" <?php echo $feature_position['style_height']; ?>>
		<div class="grve-feature-section-inner" data-item="map" <?php echo $feature_position['data_style']; ?>>
			<div class="grve-map" <?php echo $feature_position['style_height']; ?> data-lat="<?php echo esc_attr( $map_lat ); ?>" data-lng="<?php echo esc_attr( $map_lng ); ?>" data-zoom="<?php echo esc_attr( $map_zoom ); ?>"></div>
			<?php
				foreach ( $map_items as $map_item ) {
					grve_print_feature_map_point( $map_item, $map_marker );
				}
			?>
			</div>
	</div>
<?php
}

function grve_print_feature_map_point( $map_item, $default_marker ) {

	$map_lat = grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = grve_array_value( $map_item, 'marker', $default_marker );

	$map_title = grve_array_value( $map_item, 'title' );
	$map_infotext = grve_array_value( $map_item, 'info_text','' );

	$button_text = grve_array_value( $map_item, 'button_text' );
	$button_url = grve_array_value( $map_item, 'button_url' );
	$button_url = esc_url( $button_url );
	$button_type = grve_array_value( $map_item, 'button_type', '' );
	$button_size = grve_array_value( $map_item, 'button_size', 'extrasmall' );
	$button_color = grve_array_value( $map_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $map_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $map_item, 'button_target', '_self' );
	$button_target = esc_attr( $button_target );

?>
	<div style="display:none" class="grve-map-point" data-point-lat="<?php echo esc_attr( $map_lat ); ?>" data-point-lng="<?php echo esc_attr( $map_lng ); ?>" data-point-marker="<?php echo esc_attr( $map_marker ); ?>" data-point-title="<?php echo esc_attr( $map_title ); ?>">
		<div class="grve-map-infotext">
			<?php if ( !empty( $map_title ) ) { ?>
			<h6 class="grve-infotext-title"><?php echo $map_title; ?></h6>
			<?php } ?>
			<?php if ( !empty( $map_infotext ) ) { ?>
			<p class="grve-infotext-description"><?php echo $map_infotext; ?></p>
			<?php } ?>
			<?php if ( !empty( $button_text ) ) { ?>
			<a class="grve-infotext-link" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_text; ?></a>
			<?php } ?>
		</div>
	</div>
<?php

}

/**
 * Prints Header Feature Go to Section ( Bottom Arrow )
 */
function grve_print_feature_go_to_section( $feature_go_to_section, $title_color ) {

	if( !empty( $feature_go_to_section ) ) {
?>
		<div class="grve-goto-section grve-icon-nav-down grve-<?php echo esc_attr( $title_color ); ?>"></div>
<?php
	}

}

/**
 * Prints Header Feature Button
 */
function grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target = '_self' ) {

	$button = "";

	if ( !empty( $button_text ) ) {
		$button_classes = array( 'grve-btn' );

		array_push( $button_classes, 'grve-btn-' . $button_size );
		array_push( $button_classes, 'grve-' . $button_shape );

		if ( grve_starts_with( $button_color, 'primary' ) ) {
			array_push( $button_classes, 'grve-bg-' . $button_color );
		} else {
			array_push( $button_classes, 'grve-' . $button_color . '-color' );
		}

		if ( 'outline' == $button_type ) {
			array_push( $button_classes, 'grve-btn-line' );
		}

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_url ) ) {
			$url = $button_url;
			$target = $button_target;
		} else {
			$url = "#";
			$target= "_self";
		}

		$button .= '<a class="' . esc_attr( $button_class_string ) . '" href="' . esc_url( $url ) . '"  target="' . esc_attr( $target ) . '">';
		$button .= '<span>';
		$button .= $button_text;
		$button .= '</span>';
		$button .= '</a>';
	}

	echo $button;

}


?>