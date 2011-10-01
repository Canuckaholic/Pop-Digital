<?php get_header(); ?>
<?php
if (have_posts()) : $first = true;
while (have_posts()) : the_post(); 
$arc_year = get_the_time('Y');
$arc_month = get_the_time('m');
$arc_day = get_the_time('d');
if ($first) :
$first = false;
?>
<!-- begin latest post -->
<div id="latest">
	<div class="l">
	<h3>Latest Blog Post</h3>
	<img src="<?php dp_attachment_image(0, 'full', '290', '180'); ?>" alt="Latest Blog Post" />
	</div>
	<div class="post">
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="noimage"><?php the_content('&nbsp; Read More'); ?></div>
	</div>
<div class="break"></div>
</div>
<!-- end latest post -->
<!-- begin content -->
<div id="content">
<?php else: ?>
<!-- begin post -->
<div class="post">
	<span class="l top"><a href="<?php echo get_day_link("$arc_year", "$arc_month", "$arc_day"); ?>"><?php the_time('F j, Y') ?></a></span>
	<span class="r top"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php the_content(); ?>
	<div class="details">
		<p class="l"><strong>Filed under:</strong> <?php the_category(', ') ?></p>
		<p class="r"><strong>Tags:</strong> <?php the_tags( '', ', ', ''); ?></p>
	</div>
</div>
<!-- end post -->
<?php endif; endwhile; ?>
<div id="page"><?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?></div>
<?php else : ?>
<div class="notfound">
<h2>Not Found</h2>
<p>Sorry, but you are looking for something that is not here.</p>
</div>
<?php endif; ?>
</div>
<!-- end content -->
<?php get_sidebar(); get_footer(); ?>
