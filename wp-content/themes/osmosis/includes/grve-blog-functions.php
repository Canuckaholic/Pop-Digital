<?php

/*
 *	Blog Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Prints excerpt
 */
function grve_print_post_excerpt() {

	$excerpt_length = grve_option( 'blog_excerpt_length' );
	$excerpt_more = grve_option( 'blog_excerpt_more' );

	if ( '1' == grve_option( 'blog_auto_excerpt' ) ) {
		echo grve_excerpt( $excerpt_length, $excerpt_more  );
	} else {
		if ( '1' == grve_option( 'blog_excerpt_more' ) ) {
			the_content( __( 'read more', GRVE_THEME_TRANSLATE ) );
		} else {
			the_content( '' );
		}
	}

}

/**
 * Gets post class
 */
function grve_get_post_class( $extra_class = '' ) {

	$post_classes = array( 'grve-blog-item grve-big-post' );
	if ( !empty( $extra_class ) ){
		array_push( $post_classes, $extra_class );
	}

	return implode( ' ', $post_classes );

}


 /**
 * Prints feature media
 */
function grve_print_post_feature_media() {

	if ( is_singular( 'post' ) ) {
		$image_href = "#";
		$image_size = 'grve-image-fullscreen';
	} else if ( is_singular( 'portfolio' ) ) {
		$image_href = "#";
		$image_size = 'grve-image-fullscreen';
	} else {
		$image_size = 'grve-image-fullscreen';
		$image_href = esc_url( get_permalink() );
	}

	if ( !empty( $image_size ) && has_post_thumbnail() ) {

		if ( is_singular() ) {
?>
			<div class="grve-media">
				<?php the_post_thumbnail( $image_size ); ?>
			</div>

<?php
		} else {
?>
			<div class="grve-media">
				<a href="<?php echo $image_href; ?>"><?php the_post_thumbnail( $image_size ); ?></a>
			</div>
<?php
		}

	}

}

 /**
 * Prints post author by
 */
function grve_print_post_author_by() {
?>
	<div class="grve-post-author">
		<span><?php echo __( 'By:', GRVE_THEME_TRANSLATE ) . ' '; ?></span><?php the_author_posts_link(); ?>
	</div>
<?php

}

 /**
 * Prints like counter
 */
function grve_print_like_counter() {

	$post_likes = grve_option( 'blog_social', '', 'grve-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
?>
		<div class="grve-like-counter"><span class="grve-icon-heart"></span><?php echo grve_likes( $post_id ); ?></div>
<?php
	}

}

/**
 * Prints post date
 */
function grve_print_post_date() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type || 'portfolio' == $post_type ) {
	 return;
	}

?>
	<div class="grve-post-date">
		<?php echo get_the_date(); ?>
	</div>
<?php
}

/**
 * Prints post comments
 */
function grve_print_post_comments() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type && !grve_visibility( 'page_comments_visibility' ) ) {
	 return;
	} else if ( 'portfolio' == $post_type && !grve_visibility( 'portfolio_comments_visibility' ) ) {
	 return;
	} else if ( 'post' == $post_type && !grve_visibility( 'blog_comments_visibility' ) ) {
	 return;
	}

?>
	<span class="grve-post-comments">
		<a href="<?php the_permalink(); ?>#commentform"><?php comments_number( __( 'no comments', GRVE_THEME_TRANSLATE ), __( '1 comment', GRVE_THEME_TRANSLATE ), '% ' . __( 'comments', GRVE_THEME_TRANSLATE ) ); ?></a>
	</span>
<?php

}

/**
 * Prints author avatar
 */
function grve_print_post_author() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type ||  'portfolio' == $post_type  ) {
		return;
	}
?>
	<div class="grve-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
	</div>
<?php

}

/**
 * Prints audio shortcode of post format audio
 */
function grve_print_post_audio() {
	global $wp_embed;

	$audio_mode = grve_post_meta( 'grve_post_type_audio_mode' );
	$audio_mp3 = grve_post_meta( 'grve_post_audio_mp3' );
	$audio_ogg = grve_post_meta( 'grve_post_audio_ogg' );
	$audio_wav = grve_post_meta( 'grve_post_audio_wav' );
	$audio_embed = grve_post_meta( 'grve_post_audio_embed' );

	$audio_output = '';

	if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
		$audio_output .= '<div class="grve-media">';
		$audio_output .= $audio_embed;
		$audio_output .= '</div>';
		echo $audio_output;
	} else {
		if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {

			$audio_output .= '[audio ';

			if ( !empty( $audio_mp3 ) ) {
				$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
			}
			if ( !empty( $audio_ogg ) ) {
				$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
			}
			if ( !empty( $audio_wav ) ) {
				$audio_output .= 'wav="'. esc_url( $audio_wav ) .'" ';
			}

			$audio_output .= ']';

			echo '<div class="grve-media">';
			echo  do_shortcode( $audio_output );
			echo '</div>';
		}
	}

}

/**
 * Prints video of the video post format
 */
function grve_print_post_video() {

	$video_mode = grve_post_meta( 'grve_post_type_video_mode' );
	$video_webm = grve_post_meta( 'grve_post_video_webm' );
	$video_mp4 = grve_post_meta( 'grve_post_video_mp4' );
	$video_ogv = grve_post_meta( 'grve_post_video_ogv' );
	$video_embed = grve_post_meta( 'grve_post_video_embed' );

	grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed );
}

/**
 * Prints a bar with tags and social icons ( Single Post Only )
 */
function grve_print_blog_meta_bar() {
	global $post;
	$post_id = $post->ID;
?>
	<div id="grve-tags-categories">
		<div class="grve-row">

			<div class="grve-column-1-2">
				<div class="grve-tags">
					<?php the_tags('<ul><li>' . __( 'Post Tags:', GRVE_THEME_TRANSLATE ) . '</li><li>','</li><li>','</li></ul>'); ?>
				</div>
			</div>

			<div class="grve-column-1-2">
				<div class="grve-categories">
				 <?php
					$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
					if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
						$term_ids = implode( ',' , $post_terms );
						$terms = wp_list_categories( 'title_li=&style=list&echo=0&hierarchical=0&taxonomy=category&include=' . $term_ids );
						echo '<ul>';
						echo '<li>' . __( 'Posted In:', GRVE_THEME_TRANSLATE ) . '</li>';
						echo  $terms;
						echo '</ul>';
					}
					?>
				</div>
			</div>

		</div>
	</div>

<?php
}

/**
 * Prints related posts ( Single Post )
 */
function grve_print_related_posts() {

	$grve_tag_ids = array();
	$grve_tags_delimited = '';
	$grve_max_related = 3;

	$grve_tags_list = get_the_tags();
	if ( ! empty( $grve_tags_list ) ) {

		foreach ( $grve_tags_list as $tag ) {
			array_push( $grve_tag_ids, $tag->term_id );
		}
		$grve_tags_delimited = implode( ',', $grve_tag_ids );
	}

	$exclude_ids = array( get_the_ID() );
	$tag_found = false;

	$query = array();
	if ( ! empty( $grve_tags_delimited ) ) {
		$args = array(
			'tag__in' => $grve_tags_delimited,
			'post__not_in' => $exclude_ids,
			'posts_per_page' => $grve_max_related,
			'paged' => 1,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$tag_found = true;
		}
	}

	if ( $tag_found ) {
?>

	<div class="grve-related-post">
		<h5 class="grve-related-title"><?php _e( 'You might also like', GRVE_THEME_TRANSLATE ); ?></h5>
		<ul>
			<?php grve_print_loop_related( $query ); ?>
		</ul>

	</div>
<?php
	}
}

/**
 * Prints single related item ( used in related posts )
 */
function grve_print_loop_related( $query, $filter = ''  ) {

	$image_size = 'grve-image-small-rect-horizontal';
	$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		$grve_link = get_permalink();
		$grve_target = '_self';

		if ( 'link' == get_post_format() ) {
			$grve_link = get_post_meta( get_the_ID(), 'grve_post_link_url', true );
			$new_window = get_post_meta( get_the_ID(), 'grve_post_link_new_window', true );
			if( empty( $grve_link ) ) {
				$grve_link = get_permalink();
			}

			if( !empty( $new_window ) ) {
				$grve_target = '_blank';
			}
		}


?>
		<li>
			<article id="grve-related-post-<?php the_ID(); ?>" <?php post_class( 'grve-related-item' ); ?>>
				<div class="grve-media grve-image-hover">
					<?php
						if ( has_post_thumbnail() ) {
					?>
						<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
							<?php the_post_thumbnail( $image_size ); ?>
						</a>
					<?php
						} else {
					?>
						<a class="grve-no-image" href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
							<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
					<?php
						}
					?>
				</div>
				<div class="grve-content">
					<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
						<h6 class="grve-title"><?php the_title(); ?></h6>
					</a>
					<div class="grve-caption"><?php grve_print_post_date(); ?></div>
				</div>
			</article>
		</li>
<?php

	endwhile;
	else :
	endif;

	wp_reset_postdata();

}

/**
 * Likes ajax callback ( used in Single Post )
 */
function grve_likes_callback( $post_id ) {

	if ( isset( $_POST['grve_likes_id'] ) ) {
		$post_id = $_POST['grve_likes_id'];
		echo grve_likes( $post_id, 'update' );
	} else {
		echo 0;
	}
	exit;
}

add_action( 'wp_ajax_grve_likes_callback', 'grve_likes_callback' );
add_action( 'wp_ajax_nopriv_grve_likes_callback', 'grve_likes_callback' );

function grve_likes( $post_id, $action = 'get' ) {

	if( !is_numeric( $post_id ) ) return 0;

	$likes = get_post_meta( $post_id, 'grve_likes', true );

	if( !$likes || !is_numeric( $likes ) ) {
		$likes = 0;
	}

	if ( 'update' == $action ) {
		if ( isset( $_COOKIE['grve_likes_' . $post_id] ) ) {
			return $likes;
		}
		$likes++;
		update_post_meta( $post_id, 'grve_likes', $likes );
		setcookie('grve_likes_' . $post_id, $post_id, time()*20, '/');
	}

	return $likes;
}

 /**
 * Prints social icons ( Post )
 */
function grve_print_post_social( $post_title_color = "light", $element_id = 'grve-social-share', $element_class = 'grve-social-style-default' ) {
	global $post;
	$post_id = $post->ID;

	$post_facebook = grve_option( 'blog_social', '', 'facebook' );
	$post_twitter = grve_option( 'blog_social', '', 'twitter' );
	$post_linkedin = grve_option( 'blog_social', '', 'linkedin' );
	$post_googleplus = grve_option( 'blog_social', '', 'google-plus' );
	$post_likes = grve_option( 'blog_social', '', 'grve-likes' );
	$grve_permalink = esc_url( get_permalink( $post_id ) );
	$grve_title = esc_attr( get_the_title( $post_id ) );
?>
	<!-- Socials -->
	<div id="<?php echo $element_id; ?>" class="<?php echo esc_attr( $element_class ); ?> grve-<?php echo esc_attr( $post_title_color ); ?>">
		<ul>

			<?php if ( !empty( $post_facebook  ) ) { ?>
			<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-facebook grve-icon-facebook"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_twitter  ) ) { ?>
			<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-twitter grve-icon-twitter"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_linkedin  ) ) { ?>
			<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-linkedin grve-icon-linkedin"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_googleplus  ) ) { ?>
			<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-googleplus grve-icon-google-plus"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_likes  ) ) { ?>
			<li><a href="#" class="grve-like-counter-link grve-icon-heart" data-post-id="<?php echo $post_id; ?>"></a><span class="grve-like-counter"><?php echo grve_likes( $post_id ); ?></span></li>
			<?php } ?>
		</ul>
	</div>
<?php
}

 /**
 * Prints Meta fields ( Post )
 */
function grve_print_post_meta( $element_id = 'grve-meta-responsive', $element_class = 'grve-meta-style-default' ) {
?>
	<div id="<?php echo $element_id; ?>" class="<?php echo esc_attr( $element_class ); ?>">
		<ul class="grve-meta-elements">
			<li class="grve-field-date"><span class="grve-icon-date"></span><?php echo get_the_date(); ?></li>
			<?php if ( grve_visibility( 'post_author_visibility' ) ) { ?>
			<li><a href="#grve-about-author"><span class="grve-icon-user"></span><?php the_author(); ?></a></li>
			<?php } ?>
			<?php if ( grve_visibility( 'blog_comments_visibility' ) ) { ?>
			<li><a href="#grve-comments"><span class="grve-icon-comment"></span><?php comments_number( __( 'no comments', GRVE_THEME_TRANSLATE ), __( '1 comment', GRVE_THEME_TRANSLATE ), '% ' . __( 'comments', GRVE_THEME_TRANSLATE ) ); ?></a></li>
			<?php } ?>
		</ul>
	</div>
<?php
}
?>