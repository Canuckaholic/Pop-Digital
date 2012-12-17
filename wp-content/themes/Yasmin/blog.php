<?php
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>

<div id="left" class="eleven columns">
	<?php
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('paged='.$paged);
	?>
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="postmeta"> 	<span>Posted by <?php the_author_posts_link(); ?></span> | <span><?php the_time('l, n F Y'); ?></span> | <span><?php the_category(', '); ?></span> </div>
			</div>

			<div class="entry">
			<?php $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'top_feature'); ?>	
				<img src="<?php echo $image_attr[0]; ?>" class="postim scale-with-grid"  >
				<?php wpe_excerpt('wpe_excerptlength_archive', ''); ?>
				<div class="clear"></div>
			</div>
		</div>

	<?php endwhile; ?>

	<?php getpagenavi(); ?>
	
	<?php $wp_query = null; $wp_query = $temp;?>	
				
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>