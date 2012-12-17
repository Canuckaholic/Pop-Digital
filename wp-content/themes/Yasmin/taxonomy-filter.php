<?php get_header(); ?>

<div id="left" class="eleven columns" >

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	
<div class="five columns rightbox">
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

<?php endwhile; ?>

<?php getpagenavi(); ?>

<?php else : ?>

	<h1 class="title">Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>