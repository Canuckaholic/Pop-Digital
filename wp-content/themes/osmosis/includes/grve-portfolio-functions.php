<?php

/*
*	Portfolio Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Print portfolio sidebar class
 */
function grve_portfolio_sidebar_class() {

	$grve_sidebar_class = "";
	$grve_sidebar_layout = grve_post_meta( 'grve_portfolio_layout', 'none' );

	if ( 'none' != $grve_sidebar_layout ) {
		$grve_sidebar_class = 'grve-right-sidebar';
	}

	return $grve_sidebar_class;

}

/**
 * Prints Portfolio socials if used
 */
function grve_print_portfolio_media() {
	global $post;
	$post_id = $post->ID;

	$portfolio_media = get_post_meta( $post_id, 'grve_portfolio_media_selection', true );

	switch( $portfolio_media ) {

		case 'slider':
		case 'feature-slider':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			grve_print_gallery_slider( 'slider', $slider_items );
			break;
		case 'gallery':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			grve_print_gallery_slider( 'gallery', $slider_items, '', 'grve-classic-style' );
			break;
		case 'gallery-vertical':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			grve_print_gallery_slider( 'gallery-vertical', $slider_items, '', 'grve-vertical-style' );
			break;
		case 'video':
			grve_print_portfolio_video();
			break;
		case 'video-html5':
			grve_print_portfolio_video( 'html5' );
			break;
		case 'none':
			break;
		default:
			grve_print_post_feature_media();
			break;

	}
}


/**
 * Prints video of the portfolio media
 */
function grve_print_portfolio_video( $video_mode = '' ) {

	$video_webm = grve_post_meta( 'grve_portfolio_video_webm' );
	$video_mp4 = grve_post_meta( 'grve_portfolio_video_mp4' );
	$video_ogv = grve_post_meta( 'grve_portfolio_video_ogv' );
	$video_embed = grve_post_meta( 'grve_portfolio_video_embed' );

	grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed );
}

/**
 * Prints Portfolio socials if used
 */
function grve_print_portfolio_social( $element_id = 'grve-social-share' ) {

	global $post;
	$post_id = $post->ID;

	if ( grve_portfolio_social_visibility() ) {

		$grve_permalink = esc_url( get_permalink( $post_id ) );
		$grve_title = esc_attr( get_the_title( $post_id ) );
		$portfolio_facebook = grve_option( 'portfolio_social', '', 'facebook' );
		$portfolio_twitter = grve_option( 'portfolio_social', '', 'twitter' );
		$portfolio_linkedin = grve_option( 'portfolio_social', '', 'linkedin' );
		$portfolio_pinterest= grve_option( 'portfolio_social', '', 'pinterest' );
		$portfolio_googleplus= grve_option( 'portfolio_social', '', 'google-plus' );
		$portfolio_likes = grve_option( 'portfolio_social', '', 'grve-likes' );

?>
		<div id="<?php echo $element_id; ?>">

			<ul>

				<?php if ( !empty( $portfolio_facebook  ) ) { ?>
				<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-facebook grve-icon-facebook"></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_twitter  ) ) { ?>
				<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-twitter grve-icon-twitter"></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_linkedin  ) ) { ?>
				<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-linkedin grve-icon-linkedin"></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_googleplus  ) ) { ?>
				<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-googleplus grve-icon-google-plus"></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_pinterest  ) ) { ?>
				<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" data-pin-img="<?php grve_print_portfolio_image( 'grve-image-small-square', 'link' ); ?>" class="grve-social-share-pinterest grve-icon-pinterest"></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_likes  ) ) { ?>
				<li><a href="#" class="grve-like-counter-link grve-icon-heart" data-post-id="<?php echo $post_id; ?>"></a><span class="grve-like-counter"><?php echo grve_likes( $post_id ); ?></span></li>
				<?php } ?>

			</ul>

		</div>
<?php
	}
}

 /**
 * Prints portfolio like counter
 */
function grve_print_portfolio_like_counter() {

	$post_likes = grve_option( 'portfolio_social', '', 'grve-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
?>
		<div class="grve-like-counter grve-icon-heart"><span><?php echo grve_likes( $post_id ); ?></span></div>
<?php
	}

}


/**
 * Check Portfolio details if used
 */

function grve_check_portfolio_details() {
	global $post;
	$post_id = $post->ID;

	$grve_portfolio_details = grve_post_meta( 'grve_portfolio_details', '' );
	$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );
	if ( !empty( $grve_portfolio_details ) || ! empty( $portfolio_fields ) ) {
		return true;
	}
	return false;

}

/**
 * Prints Portfolio details
 */
function grve_print_portfolio_details() {
	global $post;
	$post_id = $post->ID;

	$grve_portfolio_details = grve_post_meta( 'grve_portfolio_details', '' );
	$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );

?>
	<div class="grve-portfolio-info">

		<?php
		if ( !empty( $grve_portfolio_details ) ) {
		?>

			<!-- Portfolio Description -->
			<div class="grve-portfolio-description">
				<h5><?php _e( 'Project Details', GRVE_THEME_TRANSLATE ); ?></h5>
				<p><?php echo $grve_portfolio_details; ?></p>
			</div>
			<!-- End Portfolio Description -->

		<?php
		}
		?>

		<?php
		if ( ! empty( $portfolio_fields ) ) {
		?>

			<!-- Fields -->
			<ul class="grve-fields">
			<?php
				foreach( $portfolio_fields as $field ) {
					echo '<li class="grve-fields-title">' . $field->name . '</li>';
				}
			?>
			</ul>
			<!-- End Fields -->

		<?php
		}
		?>

	</div>
<?php

}

/**
 * Checks if portfolio has socials
 */
function grve_portfolio_social_visibility() {

	$social_options = grve_option('portfolio_social');
	if ( !empty( $social_options ) ) {
		foreach ( $social_options as $key => $value ) {
			if ( $value ) {
				return true;
			}
		}
	}
	return false;


}

/**
 * Prints Portfolio class
 */
function grve_print_portfolio_class( $grve_portfolio_style ) {


	switch( $grve_portfolio_style ) {

		case 'grid-2':
		case 'grid-3':
			$grve_portfolio_style_class = '';
			break;

		default:
			$grve_portfolio_style_class = 'grve-margin-0';
			break;

	}

	echo $grve_portfolio_style_class;

}

/**
 * Prints Portfolio Recents items. ( Used in Single Portfolio )
 */
function grve_print_recent_portfolio_items() {

	$exclude_ids = array( get_the_ID() );
	$args = array(
		'post_type' => 'portfolio',
		'post_status'=>'publish',
		'post__not_in' => $exclude_ids ,
		'posts_per_page' => 3,
		'paged' => 1,
	);


	$query = new WP_Query( $args );

	if ( $query->have_posts()  && $query->found_posts > 1 ) {
?>
	<div class="grve-related-post">
		<h5 class="grve-related-title"><?php _e( 'Recent Entries', GRVE_THEME_TRANSLATE ); ?></h5>
		<ul>

<?php

		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			echo '<li>';
			get_template_part( 'templates/portfolio', 'recent' );
			echo '</li>';
		endwhile;
		else :
		endif;
?>
		</ul>
	</div>
<?php
		wp_reset_postdata();
	}
}

/**
 * Prints Portfolio Feature Image
 */
function grve_print_portfolio_image( $image_size = 'grve-image-small-square', $link = '' ) {
	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
		$image_src = $attachment_src[0];
		$image_dimensions = 'width="' . $attachment_src[1] . '" height="' . $attachment_src[2] . '"';
	} else {
		$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';
		$image_dimensions = '';
	}

	if ( $link ){
		echo esc_url( $image_src );
	} else {
?>
	<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" <?php echo $image_dimensions; ?>/>
<?php
	}

}

/**
 * Adds portfolio categories in post_class. ( Used for Isotope Filter)
 */
add_filter( 'post_class', 'grve_portfolio_category_post_class', 10, 3 );

if( !function_exists( 'grve_portfolio_category_post_class' ) ) {

	function grve_portfolio_category_post_class( $classes, $class, $ID ) {

		$taxonomy = 'portfolio_category';

		$terms = get_the_terms( (int) $ID, $taxonomy );

		if( !empty( $terms ) ) {

			foreach( (array) $terms as $order => $term ) {

				if( !in_array( $term->slug, $classes ) ) {

					$classes[] = 'portfolio_category_' . $term->slug;

				}

			}

		}

		return $classes;

	}

}


?>