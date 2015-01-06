<?php
/**
 * The Link Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post' ); ?>>
		<div id="grve-post-content">
			<?php the_content(); ?>
		</div>
	</article>

<?php
} else {

	$grve_post_class = grve_get_post_class( 'grve-label-post' );
	$grve_link = get_post_meta( get_the_ID(), 'grve_post_link_url', true );
	$new_window = get_post_meta( get_the_ID(), 'grve_post_link_new_window', true );

	if( empty( $grve_link ) ) {
		$grve_link = get_permalink();
	}

	$grve_target = '_self';
	if( !empty( $new_window ) ) {
		$grve_target = '_blank';
	}

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?>>

		<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>" rel="bookmark">
			<div class="grve-post-icon"></div>
			<p class="grve-subtitle">
			<?php
				global $allowedposttags;
				$mytags = $allowedposttags;
				unset($mytags['a']);
				unset($mytags['img']);
				$content = wp_kses( get_the_content(), $mytags );
			?>
			<?php echo $content; ?>
			</p>

		</a>

	</article>

<?php

}
?>



