<?php get_header(); ?>
<div class="single"></div>
<!-- begin content -->
<div id="content">
<?php
if (have_posts()) : the_post(); 
$arc_year = get_the_time('Y');
$arc_month = get_the_time('m');
$arc_day = get_the_time('d');
?>
<!-- begin post -->
<div class="post">
	<span class="l top"><a href="<?php echo get_day_link("$arc_year", "$arc_month", "$arc_day"); ?>"><?php the_time('F j, Y') ?></a></span>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php the_content(); ?>
	<div class="details">
		<p class="l"><strong>Filed under:</strong> <?php the_category(', ') ?></p>
		<p class="r"><strong>Tags:</strong> <?php the_tags( '', ', ', ''); ?></p>
	</div>
</div>
<!-- end post -->
<div id="comments"><?php comments_template(); ?></div>
<?php else : ?>
<div class="notfound">
	<h2>Not Found</h2>
	<p>Sorry, but you are looking for something that is not here.</p>
</div>
<?php endif; ?>
</div>
<!-- end content -->
<?php get_sidebar(); get_footer(); ?>
