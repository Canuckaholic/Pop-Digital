<?php
/**
 * The Quote Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post grve-post-quote' ); ?>>
		<div id="grve-post-content">
			<?php the_content(); ?>
		</div>
	</article>

<?php
} else {
	$grve_post_class = grve_get_post_class( 'grve-label-post' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?>>

		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<div class="grve-post-meta">
				<?php grve_print_post_date(); ?>
			</div>
			<div class="grve-post-icon"></div>
			<p class="grve-subtitle">
			<?php
				global $allowedposttags;
				$mytags = $allowedposttags;
				unset($mytags['a']);
				unset($mytags['img']);
				unset($mytags['blockquote']);
				$content = wp_kses( get_the_content(), $mytags );
			?>
			<?php echo $content; ?>
			</p>
		</a>

	</article>

<?php
}
?>



