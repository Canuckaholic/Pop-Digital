<?php
/*
	Template Name:Portfolio-page
*/
?>
<?php get_header(); ?>

<div class="container" >
	<ul class="foliocontainer" >
	
	<?php
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('post_type=portfolio&paged='.$paged);
	?>
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		<li class="four columns rightbox">
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
</li>
	<?php endwhile; ?>
<div class="clear"></div>
</ul>
	<?php getpagenavi(); ?>
	
	<?php $wp_query = null; $wp_query = $temp;?>	
				

</div>
<?php get_footer(); ?>