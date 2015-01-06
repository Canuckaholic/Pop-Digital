<?php get_header(); ?>

<?php the_post(); ?>


	<div id="grve-main-content">
		<?php grve_print_portfolio_header_title(); ?>

		<?php
			$grve_disable_portfolio_fields_bar = grve_post_meta( 'grve_disable_portfolio_fields_bar' );
			$grve_disable_portfolio_recent = grve_post_meta( 'grve_disable_portfolio_recent' );
			$grve_disable_comments = grve_post_meta( 'grve_disable_comments' );
			$grve_sidebar_layout = grve_post_meta( 'grve_portfolio_layout', grve_option( 'portfolio_layout', 'none' ) );
			$grve_sidebar_extra_content = grve_check_portfolio_details();
			$grve_portfolio_details_sidebar = false;
			if( $grve_sidebar_extra_content && 'none' == $grve_sidebar_layout ) {
				$grve_portfolio_details_sidebar = true;
			}
		?>

		<?php if ( 'yes' != $grve_disable_portfolio_fields_bar ) { ?>

		<div id="grve-portfolio-bar" class="grve-fields-bar">
			<?php grve_print_portfolio_social(); ?>
			<?php grve_print_header_item_navigation(); ?>
		</div>

		<?php } ?>


		<div class="grve-container <?php echo grve_sidebar_class(); ?>">

			<?php
				if ( $grve_portfolio_details_sidebar ) {
			?>
				<div id="grve-single-media">
					<?php grve_print_portfolio_media(); ?>
				</div>
			<?php
				}
			?>

			<div id="grve-portfolio-area">
				<article id="post-<?php the_ID(); ?>" <?php post_class('grve-single-porfolio'); ?>>

					<?php
						if ( !$grve_portfolio_details_sidebar ) {
					?>
						<div id="grve-single-media">
							<?php grve_print_portfolio_media(); ?>
						</div>
					<?php
						}
					?>
					<div id="grve-post-content">
						<?php the_content(); ?>
					</div>
					<?php
						if ( 'yes' != $grve_disable_portfolio_fields_bar ) {
							grve_print_header_item_navigation('grve-nav-wrapper-default');
							grve_print_portfolio_social( 'grve-social-share-responsive' );
						}
					?>
				</article>

				<?php if ( $grve_sidebar_extra_content ) { ?>
					<div id="grve-portfolio-info-responsive">
						<?php grve_print_portfolio_details(); ?>
					</div>
				<?php } ?>

				<?php if ( grve_visibility( 'portfolio_recents_visibility' ) && 'yes' != $grve_disable_portfolio_recent ) { ?>
					<?php grve_print_recent_portfolio_items(); ?>
				<?php } ?>

				<?php if ( grve_visibility( 'portfolio_comments_visibility' ) && 'yes' != $grve_disable_comments ) { ?>
					<?php comments_template(); ?>
				<?php } ?>

			</div>
			<?php
				if ( $grve_portfolio_details_sidebar ) {
			?>
				<aside id="grve-sidebar">
					<?php grve_print_portfolio_details(); ?>
				</aside>
			<?php
				} else {
					get_sidebar();
				}
			?>
		</div>

	</div>
	<!-- End Content -->

<?php get_footer(); ?>