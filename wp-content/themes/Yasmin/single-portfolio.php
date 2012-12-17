<?php get_header(); ?>

<div id="left" class="eleven columns" >
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title">
				<?php $foliotype = get_post_meta( get_the_ID(), 'WTF_protype', true ); ?>
				<div class="portype pro-<?php echo $foliotype == 'i' ? 'image' : 'video' ?> "></div>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="projmeta"><?php echo get_post_meta( get_the_ID(), 'WTF_subtitle', true ); ?></div>
			</div>
		<div class="projectbox">
			<?php $foliotype = get_post_meta( get_the_ID(), 'WTF_protype', true ); ?>
			<?php if ($foliotype == 'i') { ?>
			<div class="flexslider">
	    			<ul class="slides">
			<?php 	 $images = get_post_meta( get_the_ID(), 'WTF_images', false );
    			foreach ( $images as $att )
    			{
        			$src = wp_get_attachment_image_src( $att, 'top_feature' );
    				$src = $src[0];
    // Show image
    			echo "<li> <img src='{$src}' /></li>";
    			} ?>
		  			</ul>
			</div>
			<?php } else { ?>
				<?php echo get_post_meta( get_the_ID(), 'WTF_video', true ); ?>
			<?php } ?>
			
		</div>
		
			<div class="entry">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
				<div class="clear"></div>
				Filters: <?php echo get_the_term_list( $post->ID, 'filter', '', ', ', '' ); ?>
			</div>
		</div>
		
	<?php endwhile; endif; ?>	
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>