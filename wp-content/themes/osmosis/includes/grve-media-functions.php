<?php

/*
 *	Media functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


/**
 * Generic function that prints a slider or gallery
 */
function grve_print_gallery_slider( $gallery_mode, $slider_items , $image_size_slider = 'grve-image-large-rect-horizontal', $extra_class = "") {

	if ( empty( $slider_items ) ) {
		return;
	}
	$image_size_gallery_thumb = 'grve-image-small-square';
	if( 'gallery-vertical' == $gallery_mode ) {
		$image_size_gallery_thumb = 'grve-image-large-rect-horizontal';
	}

	$start_block = $end_block = $item_class = '';


	if ( 'gallery' == $gallery_mode || '' == $gallery_mode || 'gallery-vertical' == $gallery_mode ) {

		$gallery_index = 0;

?>
		<div class="grve-media">
			<ul class="grve-post-gallery grve-post-gallery-popup <?php echo esc_attr( $extra_class ); ?>">
<?php

		foreach ( $slider_items as $slider_item ) {

			$media_id = $slider_item['id'];
			$full_src = wp_get_attachment_image_src( $media_id, 'full' );
			$image_full_url = esc_url( $full_src[0] );

			$thumb_src = wp_get_attachment_image_src( $media_id, $image_size_gallery_thumb );
			$image_thumb_url = esc_url( $thumb_src[0] );
			$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

			$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
			$caption = get_post_field( 'post_excerpt', $media_id );
			$figcaption = '';

			if	( !empty( $caption ) ) {
				$figcaption = wptexturize( $caption );
			}
			echo '

				<li class="grve-image-hover">
					<a title="' . $figcaption . '" href="' . $image_full_url . '">
						<img src="' . $image_thumb_url . '" alt="' . $alt . '" ' . $image_dimensions . '>
					</a>
				</li>
			';
		}
?>
			</ul>
		</div>
<?php

	} else {
?>
		<div class="grve-media">
			<div class="grve-carousel-wrapper">
				<div class="grve-carousel-navigation grve-dark" data-navigation-type="2">
					<div class="grve-carousel-buttons">
						<div class="grve-carousel-prev grve-icon-nav-left"></div>
						<div class="grve-carousel-next grve-icon-nav-right"></div>
					</div>
				</div>
				<div class="grve-slider grve-carousel-element " data-slider-speed="2500" data-slider-pause="yes" data-slider-autoheight="no">
<?php
				foreach ( $slider_items as $slider_item ) {
					$media_id = $slider_item['id'];
					$full_src = wp_get_attachment_image_src( $media_id, $image_size_slider );
					$image_url = esc_url( $full_src[0] );
					$image_dimensions = 'width="' . $full_src[1] . '" height="' . $full_src[2] . '"';
					$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
					$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
					echo '<div class="grve-slider-item"><img src="' . $image_url . '" alt="' . $alt . '" ' . $image_dimensions . '></div>';
				}
?>
				</div>
			</div>
		</div>
<?php
	}
}

/**
 * Generic function that prints a video ( Embed or HTML5 )
 */
function grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed ) {
	global $wp_embed;
	$video_output = '';

	if( empty( $video_mode ) && !empty( $video_embed ) ) {
		$video_output .= '<div class="grve-media">';
		$video_output .= $wp_embed->run_shortcode( '[embed]' . $video_embed . '[/embed]' );
		$video_output .= '</div>';
	} else {

		if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {
			$video_output .= '<div class="grve-media">';
			$video_output .= '  <video controls>';

			if ( !empty( $video_webm ) ) {
				$video_output .= '<source src="' . $video_webm . '" type="video/webm">';
			}
			if ( !empty( $video_mp4 ) ) {
				$video_output .= '<source src="' . $video_mp4 . '" type="video/mp4">';
			}
			if ( !empty( $video_ogv ) ) {
				$video_output .= '<source src="' . $video_ogv . '" type="video/ogg">';
			}
			$video_output .='  </video>';
			$video_output .= '</div>';

		}
	}

	echo  $video_output;

}


?>