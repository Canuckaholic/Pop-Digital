<?php get_header(); ?>

<?php if (of_get_option('w2f_feat_slide')== "1") { ?>
<div class="container" id="feature">
	<div class="flexslider">
	    <ul class="slides">
		
	    <?php 	$count = of_get_option('w2f_slide_number');
				$slidecat = of_get_option('w2f_slide_categories');
				$query = new WP_Query( array( 'cat' => $slidecat,'posts_per_page' =>$count ) );
	           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
	 	
		<li> 
				<?php $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'top_feature'); ?>	
				<a href="<?php the_permalink() ?>">	<img src="<?php echo $image_attr[0]; ?>"></a>
				
				<div class="flex-caption"> 
					<h3> <?php the_title(); ?></h3> 
				</div>
			 
		</li>
	
		<?php endwhile; endif; ?>
	    </ul>
	</div>
</div>

<?php } ?>

 <!-- end feature -->
<?php if (of_get_option('w2f_callout_box')== "1") { ?>
<div class="container" id="callout">
	<p> <?php echo of_get_option('w2f_callout'); ?> </p>
</div>
<?php } ?>

 <!-- end callout -->

<div class="container" id="recent-projects">
	
	<div class="four columns leftbox">
		<h2>latest projects</h2>
		<p>These are few latest projects published on my site</p>
		<span><?php $portlink = of_get_option('w2f_port_page'); ?> <a href="<?php echo get_page_link($portlink); ?>">View All</a>  </span>
	</div>
	
	 	<?php 	$query = new WP_Query( array( 'post_type' => 'portfolio','posts_per_page' =>'3' ) );
	           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
	
	<div class="four columns rightbox">
					<?php $foliotype = get_post_meta( get_the_ID(), 'WTF_protype', true ); ?>
			<?php if ($foliotype == 'i') { ?>
				<img class="overlay" src="<?php echo get_template_directory_uri(); ?>/images/cover.png">  </img>
			<?php } else { ?>	
				<img class="overlay" src="<?php echo get_template_directory_uri(); ?>/images/mover.png"></img>
		    <?php } ?>
			<?php $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'index_box'); ?>
			<a href="<?php the_permalink() ?>">	<img src="<?php echo $image_attr[0]; ?>" class="index-img scale-with-grid"></a>
		<div class="panelbox">		
			<h2> <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h2>
			<p> <?php echo get_post_meta( get_the_ID(), 'WTF_subtitle', true ); ?> </p>
			
		</div>	 
	</div>
	
		<?php endwhile; endif; ?>
</div>
 <!-- end projects -->

<div class="container" id="recent-posts">
	<div class="four columns leftbox">
		<h2>latest articles</h2>
		<p>These are few latest articles published on my site</p>
		<span> <?php $bloglink = of_get_option('w2f_blog_page'); ?> <a href="<?php echo get_page_link($bloglink); ?>">View All</a>  </span>
	</div>
	
	 	<?php 	$query = new WP_Query( array( 'posts_per_page' =>'3' ) );
	           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
	
	<div class="four columns rightbox">
			<?php $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'index_wide'); ?>
			<a href="<?php the_permalink() ?>">	<img src="<?php echo $image_attr[0]; ?>" class="index-wideimg scale-with-grid"></a>
	
			<div class="panelpost">
			<h2><a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h2> 	
			<span class="paneldate"><?php the_time('l, n F Y'); ?></span>	
			<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
			</div>
	</div>
	
		<?php endwhile; endif; ?>
</div>
 <!-- end posts -->
<?php get_footer(); ?>