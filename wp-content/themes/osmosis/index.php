<?php get_header(); ?>

<div id="grve-main-content">

	<?php grve_print_header_title(); ?>
	
	<div class="grve-container <?php echo grve_sidebar_class(); ?>">
		<!-- Content -->
		<div id="grve-content-area">
					
			<div class="grve-section" data-section-type="in-container" data-parallax="no">
				<div class="grve-row">
					<div class="grve-column-1">
		
						<!-- Blog FitRows -->
						<div class="grve-element grve-blog grve-large-media">

							<?php
							if ( have_posts() ) :
							?>
							<div class="grve-standard-container">
							<?php

							// Start the Loop.
							while ( have_posts() ) : the_post();
								//Get post template
								get_template_part( 'content', get_post_format() );
							endwhile;

							?>
							</div>
							<?php
								// Previous/next post navigation.
								grve_pagination();
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'content', 'none' );
							endif;
							?>

						</div>
						<!-- End Element Blog -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->

		<?php get_sidebar(); ?>

	</div>
</div>
<?php get_footer(); ?>