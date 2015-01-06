<?php get_header(); ?>

	<div id="grve-main-content">
		<?php
			the_post();
			$name =  grve_post_meta( 'grve_testimonial_name' );
			$identity =  grve_post_meta( 'grve_testimonial_identity' );
			if ( !empty( $identity ) ) {
				$identity = ', ' . $identity;
			}
			$name = '<span>' . $name . '</span>'
		?>

		<!-- Fields Bar -->
		<div id="grve-meta-bar" class="grve-fields-bar">
			<?php grve_print_header_item_navigation(); ?>
		</div>
		<!-- End Fields Bar -->		
			
		<div class="grve-container">
			
			<div id="grve-post-area">
				<div class="grve-element grve-testimonial">
					<div class="grve-testimonial-element">
						<?php the_content(); ?>
						<div class="grve-testimonial-name"><?php echo $name . $identity; ?></div>
					</div>
				</div>
				
				<?php wp_link_pages(); ?>
				
			</div>
		</div>
	</div>	

<?php get_footer(); ?>