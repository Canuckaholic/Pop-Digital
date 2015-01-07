<?php

/*
 *	Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

function grve_vce_starts_with( $haystack, $needle ) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}


 /**
 * Generates a button
 * Used in shortcodes to display a button
 */
function grve_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_extra_class, $style = '' ) {

	$button = "";

	if ( !empty( $button_text ) ) {
		$button_classes = array( 'grve-btn' );

		array_push( $button_classes, 'grve-btn-' . $button_size );
		array_push( $button_classes, 'grve-' . $button_shape );

		if ( grve_vce_starts_with( $button_color, 'primary' ) ) {
			array_push( $button_classes, 'grve-bg-' . $button_color );
		} else {
			array_push( $button_classes, 'grve-' . $button_color . '-color' );
		}

		if ( 'outline' == $button_type ) {
			array_push( $button_classes, 'grve-btn-line' );
		}

		if ( !empty( $button_extra_class ) ) {
			array_push( $button_classes, $button_extra_class );
		}

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_link ) ){
			$href = vc_build_link( $button_link );
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

		$button .= '<a class="' . esc_attr( $button_class_string ) . '" href="' . esc_url( $url ) . '" target="' . $target . '" style="' . $style . '">';
		$button .= '<span>';
		$button .= $button_text;
		$button .= '</span>';
		$button .= '</a>';
	}

	return $button;

}

 /**
 * Fetch Go Pricing Tables
 * Used in shortcodes to generate the list of Go Pricing Tables ( back end )
 */

function grve_vce_get_go_pricing_list() {

	$pricing_tables_list = array();

	if ( class_exists( 'GW_GoPricing' ) ) {
		$pricing_tables = get_option( GW_GO_PREFIX . 'tables' );
		if ( !empty( $pricing_tables ) ) {
			foreach( $pricing_tables as $pricing_table ) {
				if 	( isset ( $pricing_table['table-id'] ) ) {
					$table_id = $pricing_table['table-id'];
					if 	( isset ( $pricing_table['table-name'] ) && $pricing_table['table-name'] != '' ) {
						$table_name = '( ' . $pricing_table['table-name'] . ' ) ' . $table_id ;
					} else {
						$table_name = $table_id;
					}
					$pricing_tables_list[ $table_name ] = $table_id;
				}
			}
		} else {
			$pricing_tables_list[__( "No Pricing Tables Found", "grve-osmosis-vc-extension" )] = '';
		}
	}

	return $pricing_tables_list;
}

 /**
 * Fetch Portfolio Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_vce_get_portfolio_categories() {

	$portfolio_category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$portfolio_cats = get_terms( 'portfolio_category' );
	if ( is_array( $portfolio_cats ) ) {
	  foreach ( $portfolio_cats as $portfolio_cat ) {
		$portfolio_category[$portfolio_cat->name] = $portfolio_cat->term_id;

	  }
	}
	return $portfolio_category;

}

 /**
 * Fetch Portfolio Categories
 * Used in portfolio filter to generate the list of used categories ( front end )
 */
function grve_vce_get_portfolio_list() {

	$all_string =  apply_filters( 'grve_vce_portfolio_string_all_categories', __( 'All', 'grve-osmosis-vc-extension' ) );

	$get_portfolio_category = get_categories( array( 'taxonomy' => 'portfolio_category') );
	$portfolio_category_list = array( '0' => $all_string );

	foreach ( $get_portfolio_category as $portfolio_category ) {
		$portfolio_category_list[] = $portfolio_category->cat_name;
	}
	return $portfolio_category_list;

}

 /**
 * Print Portfolio Image
 * Used in portfolio to fetch feature image or link
 */
function grve_vce_print_portfolio_image( $image_size , $link = '' ) {
	if( function_exists( 'grve_print_portfolio_image' ) ) {
		grve_print_portfolio_image( $image_size , $link );
	}
}

 /**
 * Fetch Testimonial Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_vce_get_testimonial_categories() {
	$testimonial_category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$testimonial_cats = get_terms( 'testimonial_category' );
	if ( is_array( $testimonial_cats ) ) {
	  foreach ( $testimonial_cats as $testimonial_cat ) {
		$testimonial_category[$testimonial_cat->name] = $testimonial_cat->term_id;

	  }
	}
	return $testimonial_category;
}

 /**
 * Fetch Post Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_vce_get_post_categories() {
	$category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$cats = get_terms( 'category' );
	if ( is_array( $cats ) ) {
	  foreach ( $cats as $cat ) {
		$category[$cat->name] = $cat->term_id;

	  }
	}
	return $category;
}


 /**
 * Generates dimension string to concat in attribute style
 */
function grve_vce_build_dimension( $dimension, $value ) {
	$fixed_dimension = '';

	if( ! empty( $dimension ) &&  ! empty( $value )  ) {
		$fixed_dimension .= $dimension . ': '.(preg_match('/(px|em|\%|pt|cm)$/', $value) ? $value : $value.'px').';';
	}
	return $fixed_dimension;
}

 /**
 * Generates margin-bottom string to concat in attribute style
 */
function grve_vce_build_margin_bottom_style( $margin_bottom ) {
	$style = '';
	if( $margin_bottom != '' ) {
		$style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom .'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Generates padding-top string to concat in attribute style
 */
function grve_vce_build_padding_top_style( $padding_top ) {
	$style = '';
	if( $padding_top != '' ) {
		$style .= 'padding-top: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_top) ? $padding_top : $padding_top.'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Generates padding-bottom string to concat in attribute style
 */
function grve_vce_build_padding_bottom_style( $padding_bottom ) {
	$style = '';
	if( $padding_bottom != '' ) {
		$style .= 'padding-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_bottom) ? $padding_bottom : $padding_bottom.'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Prints blog class depending on the blog style
 */
function grve_vce_get_blog_class( $grve_blog_style = 'large-media'  ) {

	switch( $grve_blog_style ) {

		case 'small-media':
			$grve_blog_style_class = 'grve-blog grve-small-media';
			break;
		case 'masonry':
			$grve_blog_style_class = 'grve-blog grve-blog-masonry grve-isotope';
			break;
		case 'grid':
			$grve_blog_style_class = 'grve-blog grve-blog-grid grve-isotope';
			break;
		case 'carousel':
			$grve_blog_style_class = 'grve-carousel-wrapper';
			break;
		case 'large-media':
		default:
			$grve_blog_style_class = 'grve-blog grve-large-media';
			break;

	}

	return $grve_blog_style_class;

}


 /**
 * Prints excerpt depending on the blog style and post format
 */
function grve_vce_print_post_title( $blog_style, $post_format ) {
	global $allowedposttags;
	$mytags = $allowedposttags;

	$title_size = '5';
	if( 'large-media' == $blog_style || 'small-media' == $blog_style  ) {
		$title_size = '4';
	}
	if( 'carousel' == $blog_style ) {
		$title_size = '6';
	}

	switch( $post_format ) {
		case 'link':
			if( 'carousel' == $blog_style ) {
				the_title( '<a ' . grve_vce_print_post_link( 'link' ) . ' rel="bookmark"><h' . $title_size . ' class="grve-post-title">', '</h' . $title_size . '></a>' );
			} else {
				unset($mytags['a']);
				unset($mytags['img']);
				$content = wp_kses(get_the_content(), $mytags);
				echo '<a ' . grve_vce_print_post_link( 'link' ) . ' rel="bookmark">';
				echo '<div class="grve-post-icon"></div>';
				echo '<p class="grve-subtitle">' . $content . '</p>';
				echo '</a>';
			}
			break;
		case 'quote':
			if( 'carousel' == $blog_style ) {
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h' . $title_size . ' class="grve-post-title">', '</h' . $title_size . '></a>' );
			} else {
				unset($mytags['a']);
				unset($mytags['img']);
				unset($mytags['blockquote']);
				$content = wp_kses(get_the_content(), $mytags);

				echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
				grve_vce_print_post_date();
				echo '<div class="grve-post-icon"></div>';
				echo '<p class="grve-subtitle">' . $content . '</p>';
				echo '</a>';
			}
			break;
		default:
			 the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h' . $title_size . ' class="grve-post-title">', '</h' . $title_size . '></a>' );
			break;
	}

}

 /**
 * Prints post link
 */
function grve_vce_print_post_link( $post_format = 'standard') {
	global $post;
	$post_id = $post->ID;

	$grve_link = get_permalink();
	$grve_target = '_self';

	if ( 'link' == $post_format ) {
		$grve_link = get_post_meta( $post_id, 'grve_post_link_url', true );
		$new_window = get_post_meta( $post_id, 'grve_post_link_new_window', true );

		if( empty( $grve_link ) ) {
			$grve_link = get_permalink();
		}

		if( !empty( $new_window ) ) {
			$grve_target = '_blank';
		}
	}

	return 'href="' . esc_url( $grve_link ) . '" target="' . $grve_target . '"';

}

/**
 * Prints excerpt depending on the blog style and post format
 */
function grve_vce_print_post_excerpt( $blog_style, $post_format, $autoexcerpt = '', $excerpt_length = '55', $excerpt_more = '' ) {

	if ( 'link' == $post_format || 'quote' == $post_format ) {
		return;
	}

	switch( $blog_style ) {
		case 'large-media':
			if ( empty( $autoexcerpt ) ) {
				if ( empty( $excerpt_more ) ) {
					the_content( '' );
				} else {
					global $more;
					$more = 0;
					the_content( grve_vce_read_more_string() );
				}
			} else {
				echo grve_vce_excerpt( $excerpt_length, $excerpt_more );
			}
			break;
		default:
			echo grve_vce_excerpt( $excerpt_length, $excerpt_more );
			break;
	}

}

/**
 * Returns read more link
 */
function grve_vce_read_more() {
	$read_more_string =  apply_filters( 'grve_vce_string_read_more', __( 'read more', 'grve-osmosis-vc-extension' ) );
    return '<a class="grve-read-more" href="' . get_permalink( get_the_ID() ) . '"><span>' . $read_more_string . '</span></a>';
}

/**
 * Returns read more string
 */
function grve_vce_read_more_string() {
	$read_more_string =  apply_filters( 'grve_vce_string_read_more', __( 'read more', 'grve-osmosis-vc-extension' ) );
    return $read_more_string;
}

/**
 * Returns excerpt
 */
function grve_vce_excerpt( $limit, $more = "" ) {
	global $post;
	$post_id = $post->ID;

	if ( has_excerpt( $post_id ) ) {
		$excerpt = apply_filters( 'the_content', $post->post_excerpt );
		if ( 'yes' == $more ) {
			$excerpt .= grve_vce_read_more();
		}
	} else {
		$content = get_the_content('');
		$content = do_shortcode( $content );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		if ( 'yes' == $more ) {
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			$excerpt .= grve_vce_read_more();
		} else{
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
		}
	}
	return	$excerpt;
}

/**
 * Prints feature media depending on the blog style and post format
 */
function grve_vce_print_carousel_media( $image_size = 'grve-image-small-rect-horizontal' ) {
	global $post;
	$post_id = $post->ID;
	$image_href = esc_url( get_permalink() );
	$image_src = GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/images/empty/' . $image_size . '.jpg';
?>
		<div class="grve-media grve-image-hover">
			<?php if ( has_post_thumbnail( $post_id ) ) { ?>
			<a href="<?php echo $image_href; ?>"><?php the_post_thumbnail( $image_size ); ?></a>
			<?php } else { ?>
			<a class="grve-no-image" href="<?php echo $image_href; ?>"><img src="<?php echo $image_src; ?>" alt="no image"></a>
			<?php } ?>

		</div>
<?php
}

/**
 * Prints feature media depending on the blog style and post format
 */
function grve_vce_print_post_feature_media( $grve_blog_style = 'large-media', $post_format ) {
	global $post, $wp_embed;

	$post_id = $post->ID;

	switch( $grve_blog_style ) {

		case 'small-media':
		case 'grid':
		case 'carousel':
			$image_size = 'grve-image-small-rect-horizontal';
			break;
		case 'masonry' :
			 $image_masonry =  array(
			 		'grve-image-small-rect-horizontal',
			 		'grve-image-small-square',
			 );
			 $rand_index = rand( 0, 1 );
			 $image_size = $image_masonry[$rand_index];
			break;
		case 'large-media':
		default:
			$image_size = 'grve-image-large-rect-horizontal';
			break;
	}
	$image_href = esc_url( get_permalink() );


	if ( ( '' == $post_format || 'image' == $post_format ) &&  has_post_thumbnail( $post_id ) ) {
?>
		<div class="grve-media grve-image-hover">
			<a href="<?php echo $image_href; ?>"><?php the_post_thumbnail( $image_size ); ?></a>
		</div>
<?php

	} else if ( 'audio' == $post_format ) {

		$audio_mode = get_post_meta( $post_id, 'grve_post_type_audio_mode', true );
		$audio_mp3 = get_post_meta( $post_id, 'grve_post_audio_mp3', true );
		$audio_ogg = get_post_meta( $post_id, 'grve_post_audio_ogg', true );
		$audio_wav = get_post_meta( $post_id, 'grve_post_audio_wav', true );
		$audio_embed = get_post_meta( $post_id, 'grve_post_audio_embed', true );

		if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
			$audio_output = '';
			$audio_output .= '<div class="grve-media">';
			$audio_output .= $audio_embed;
			$audio_output .= '</div>';
			echo $audio_output;
		} else {

			if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {

				$audio_output = '[audio ';

				if ( !empty( $audio_mp3 ) ) {
					$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
				}
				if ( !empty( $audio_ogg ) ) {
					$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
				}
				if ( !empty( $audio_wav ) ) {
					$audio_output .= 'wav="'. esc_url ( $audio_wav ) .'" ';
				}

				$audio_output .= ']';

				echo '<div class="grve-media">';
				echo  do_shortcode( $audio_output );
				echo '</div>';

			}
		}
	} else if ( 'video' == $post_format ) {

		$video_mode = get_post_meta( $post_id, 'grve_post_type_video_mode', true );
		$video_webm = get_post_meta( $post_id, 'grve_post_video_webm', true );
		$video_mp4 = get_post_meta( $post_id, 'grve_post_video_mp4', true );
		$video_ogv = get_post_meta( $post_id, 'grve_post_video_ogv', true );
		$video_embed = get_post_meta( $post_id, 'grve_post_video_embed', true );

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
					$video_output .= '<source src="' . esc_url( $video_webm ) . '" type="video/webm">';
				}
				if ( !empty( $video_mp4 ) ) {
					$video_output .= '<source src="' . esc_url( $video_mp4 ) . '" type="video/mp4">';
				}
				if ( !empty( $video_ogv ) ) {
					$video_output .= '<source src="' . esc_url( $video_ogv ) . '" type="video/ogg">';
				}
				$video_output .='  </video>';
				$video_output .= '</div>';

			}
		}
		echo  $video_output;
	} else if ( 'gallery' == $post_format ) {

		$slider_items = get_post_meta( $post_id, 'grve_post_slider_items', true );

		$gallery_mode = get_post_meta( $post_id, 'grve_post_type_gallery_mode', true );
		if ( empty( $gallery_mode ) ) {
			$gallery_mode = 'gallery';
		} else {
			$gallery_mode = 'slider';
		}

		if ( !empty( $slider_items ) ) {
			grve_vce_print_gallery_slider( $gallery_mode, $slider_items, $image_size  );
		}

	}

}

 /**
 * Prints Gallery or Slider
 */
function grve_vce_print_gallery_slider( $gallery_mode, $slider_items, $image_size_slider ) {

	$image_size_gallery_thumb = 'grve-image-small-square';

	if ( $gallery_mode == 'gallery' ) {

?>
	<div class="grve-media">
		<ul class="grve-post-gallery grve-post-gallery-popup">
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
			<div class="grve-element grve-carousel-wrapper">
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
						echo '<div class="grve-slider-item"><img src="' . $image_url . '" alt="' . $alt . '" ' . $image_dimensions .'></div>';
					}
?>
				</div>
			</div>
		</div>
<?php
	}
}

 /**
 * Prints post categories depending on the blog style
 */
function grve_vce_print_post_categories( $grve_blog_style = 'large-media' ) {

	$show_categories = false;
	if ( is_singular() ) {
		$show_categories = true;
	} else {
		switch( $grve_blog_style ) {

			case 'small-media':
			case 'large-media':
			default:
				$show_categories = true;
				break;
		}
	}

	if ( $show_categories ) {
		$in_categories_string =  apply_filters( 'grve_vce_blog_string_categories_in', __( 'in', 'grve-osmosis-vc-extension' ) );
?>
		<span class="grve-post-categories">
			<?php echo $in_categories_string . ' '; ?><?php the_category(', '); ?>
		</span>
<?php

	}

}

 /**
 * Prints post date
 */
function grve_vce_print_post_date() {
?>
	<span class="grve-post-date">
		<?php echo get_the_date(); ?>
	</span>
<?php
}

 /**
 * Prints post comments
 */
function grve_vce_print_post_comments() {
	$no_comments_string =  apply_filters( 'grve_vce_blog_string_no_comments', __( 'no comments', 'grve-osmosis-vc-extension' ) );
	$one_comment_string =  apply_filters( 'grve_vce_blog_string_one_comment', __( '1 comment', 'grve-osmosis-vc-extension' ) );
	$comments_string =  apply_filters( 'grve_vce_blog_string_comments', __( 'comments', 'grve-osmosis-vc-extension' ) );
?>
	<span class="grve-post-comments">
		<a href="<?php the_permalink(); ?>#commentform"><?php comments_number( $no_comments_string, $one_comment_string, '% ' . $comments_string ); ?></a>
	</span>
<?php
}

 /**
 * Prints post author avatar
 */
function grve_vce_print_post_author( $grve_blog_style, $post_format ) {
	if ( 'large-media' == $grve_blog_style ) {
		if ( 'quote' != $post_format && 'link' != $post_format ) {
?>
	<div class="grve-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
	</div>
<?php
		}
	}
}

 /**
 * Prints post author by depending on the blog style
 */
function grve_vce_print_post_author_by( $grve_blog_style = 'large-media' ) {

	switch( $grve_blog_style ) {

		case 'small-media':
		case 'large-media':
		case 'masonry':
		case 'grid':
			$show_author_by = true;
			break;
		default:
			$show_author_by = false;
			break;
	}


	if ( $show_author_by ) {
		$author_by_string =  apply_filters( 'grve_vce_blog_string_by_author', __( 'Posted by', 'grve-osmosis-vc-extension' ) );
?>
		<div class="grve-post-author">
			<span><?php echo $author_by_string . ' '; ?></span><?php the_author_posts_link(); ?>
		</div>
<?php

	}

}

 /**
 * Prints blog data depending on the blog style
 */
function grve_vce_print_blog_data( $grve_blog_style, $grve_columns = "4" ) {
	$data = '';

	switch( $grve_blog_style ) {

		case 'masonry':
			$data .= 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="masonry"';
			break;

		case 'grid':
			$data .= 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="fitRows"';
			break;

		case 'large-media':
		case 'small-media':
		default:
			$data .= '';
			break;
	}

	echo $data;

}

/**
 * Gets post class depending on the blog style
 */
function grve_vce_get_post_class( $grve_blog_style = 'large-media', $extra_class = '' ) {

	$post_classes = array( 'grve-blog-item' );
	if ( !empty( $extra_class ) ){
		array_push( $post_classes, $extra_class );
	}

	switch( $grve_blog_style ) {

		case 'large-media':
			array_push( $post_classes, 'grve-big-post' );
			break;

		case 'small-media':
			array_push( $post_classes, 'grve-small-post' );
			break;

		case 'masonry':
		case 'grid':
			array_push( $post_classes, 'grve-isotope-item' );
			break;

		default:
			break;

	}

	return implode( ' ', $post_classes );

}

function grve_vce_get_packery_data( $index, $columns ) {

	$image_size_class = "grve-packery-image";
	$image_size = 'grve-image-small-square';

	if( '2' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 6  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
	}

	if( '3' == $columns ) {

		if ( $index % 3  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}
		if ( $index % 12  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
	}

	else if( '4' == $columns ) {

		if ( $index % 8  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}

	}

	else if( '5' == $columns ) {

		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}

		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 3  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}

		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}

		if ( $index % 8  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}

	}

	return array(
		'class' => $image_size_class,
		'image_size' => $image_size,
	);
}

function grve_vce_get_masonry_data( $index, $columns ) {

	$image_size_class = "grve-masonry-image";
	$image_size = 'grve-image-small-square';

	if( '2' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
	}

	if( '3' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
	}

	if( '4' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}

	}

	if( '5' == $columns ) {

		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}

		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
	}

	return array(
		'class' => $image_size_class,
		'image_size' => $image_size,
	);
}


?>