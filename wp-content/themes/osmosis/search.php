<?php get_header(); ?>

<div id="grve-main-content">

	<?php grve_print_header_title(); ?>

	<div class="grve-container">
		<!-- Content -->
		<div id="grve-content-area">
			<div class="grve-section" data-section-type="in-container" data-parallax="no">
				<div class="grve-row">
					<div class="grve-column-1">

					<?php
						if ( have_posts() ) :

					?>
						<div class="grve-element grve-blog grve-large-media">
							<div class="grve-standard-container">
							<?php

								// Start the Loop.
								while ( have_posts() ) : the_post();
									//Get post template
									get_template_part( 'templates/search', 'large' );

								endwhile;
							?>
							</div>
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
					<!-- End Content -->
				</div>
			</div>
		</div>

	</div>
</div>
<?php get_footer(); ?>