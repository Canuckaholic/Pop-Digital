<?php get_header(); ?>

<?php the_post(); ?>

<?php
	if ( 'yes' == grve_post_meta( 'grve_disable_content' ) ) {
		get_footer();
	} else {
?>

		<div id="grve-main-content">

			<?php grve_print_header_title(); ?>

			<?php
				$page_nav_menu = grve_post_meta( 'grve_page_navigation_menu' );
				if ( !empty($page_nav_menu) ) {
			?>
			<div id="grve-anchor-menu" class="grve-fields-bar">
					<div class="grve-icon-menu"></div>
					<?php
					wp_nav_menu(
						array(
							'menu' => $page_nav_menu, /* menu id */
							'container' => false, /* no container */
							'depth' => '1',
						)
					);
					?>
			</div>
			<?php
				}
			?>
			<div class="grve-container <?php echo grve_sidebar_class(); ?>">

				<!-- Content Area -->
				<div id="grve-content-area">

					<!-- Content -->
					<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</div>
					<!-- End Content -->

					<?php if ( grve_visibility( 'page_comments_visibility' ) ) { ?>
						<?php comments_template(); ?>
					<?php } ?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	<?php get_footer(); ?>

<?php
	}
?>