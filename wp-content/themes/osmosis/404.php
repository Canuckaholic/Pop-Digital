<!doctype html>
<html class="no-js grve-responsive" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<!-- allow pinned sites -->
		<meta name="application-name" content="<?php bloginfo('name'); ?>" />


		<?php
		$grve_favicon = grve_option('favicon','','url');
		if ( ! empty( $grve_favicon ) ) {
		?>
		<link href="<?php echo esc_url( $grve_favicon ); ?>" rel="icon" type="image/x-icon">
		<?php
		}
		?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>
	</head>

	<body id="grve-body" <?php body_class(); ?>>

		<!-- Theme Wrapper -->
		<div id="grve-theme-wrapper">
			<?php
				$page_title_color = grve_option( 'page_title_color', 'dark' );
				$page_section_class = 'grve-section grve-' . $page_title_color;
			?>
			<div id="grve-main-content">
				<div class="grve-container">
					<div class="<?php echo esc_attr( $page_section_class ); ?>" data-full-height="yes">
						<div class="grve-row">
							<div class="grve-column-1">

								<div class="grve-align-center">

									<div id="grve-content-area">
									<?php
										$grve_404_search_box = grve_option('page_404_search');
										$grve_404_home_button = grve_option('page_404_home_button');
										echo do_shortcode( grve_option( 'page_404_content' ) );
									?>
									</div>

									<br/>

									<?php if ( $grve_404_search_box ) { ?>
									<div class="grve-widget">
										<?php get_search_form(); ?>
									</div>
									<br/>
									<?php } ?>

									<?php if ( $grve_404_home_button ) { ?>
									<div class="grve-element">
										<a class="grve-btn grve-btn-large grve-square grve-bg-primary-1" target="_self" href="<?php echo esc_url( home_url( '/' ) ); ?>">
											<span><?php bloginfo('name'); ?></span>
										</a>
									</div>
									<?php } ?>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>


		</div> <!-- end #grve-theme-wrapper -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>