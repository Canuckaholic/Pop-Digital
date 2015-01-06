<?php
/*
*	Template Portfolio Recent
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>

<article id="portfolio-recent-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'grve-portfolio' ); ?>>
	<div class="grve-media grve-image-hover">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php grve_print_portfolio_image( 'grve-image-small-rect-horizontal' ); ?>
		</a>
	</div>
	<div class="grve-content">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<h6 class="grve-title"><?php the_title(); ?></h6>
		</a>
		<?php
			$caption = grve_post_meta( 'grve_portfolio_description' );
			if ( !empty( $caption ) ) {
		?>
			<div class="grve-caption"><?php echo $caption; ?></div>
		<?php
			}
		?>
	</div>

</article>