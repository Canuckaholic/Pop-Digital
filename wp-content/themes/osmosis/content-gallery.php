<?php
/**
 * The Gallery Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('grve-single-post'); ?>>
<?php
		$slider_items = grve_post_meta( 'grve_post_slider_items' );
		$gallery_mode = grve_post_meta( 'grve_post_type_gallery_mode', 'gallery' );

		if ( !empty( $slider_items ) ) {
?>
			<div id="grve-single-media">
				<?php grve_print_gallery_slider( $gallery_mode, $slider_items  ); ?>
			</div>
<?php
		}
?>
		<div id="grve-post-content">
			<?php the_content(); ?>
		</div>

	</article>

<?php
} else {
	$grve_post_class = grve_get_post_class();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?>>
		<?php

			$slider_items = grve_post_meta( 'grve_post_slider_items' );
			$gallery_mode = grve_post_meta( 'grve_post_type_gallery_mode', 'gallery' );

			if ( !empty( $slider_items ) ) {
				$image_size = 'grve-image-large-rect-horizontal';
				grve_print_gallery_slider( $gallery_mode, $slider_items, $image_size  );
			}

		?>

		<div class="grve-post-content">
			<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h4 class="grve-post-title">', '</h4></a>' ); ?>
			<div class="grve-post-meta">
				<?php grve_print_post_author_by(); ?>
				<?php grve_print_post_date(); ?>
				<?php grve_print_like_counter(); ?>
			</div>
			<?php grve_print_post_excerpt(); ?>
		</div>

	</article>

<?php
}
?>



