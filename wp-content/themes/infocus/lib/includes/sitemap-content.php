<h2>Pages</h2>
	<ul class="arrow_list"><?php wp_list_pages('title_li=' ); ?></ul>
	<div class="divider top"><a href="#">Top</a></div>



<h2>Feeds</h2>
	<ul class="arrow_list">
		<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
		<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
	</ul>	
	<div class="divider top"><a href="#">Top</a></div>



<h2>Categories</h2>
	<ul class="arrow_list"><?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0&feed=RSS'); ?></ul>
	<div class="divider top"><a href="#">Top</a></div>



<h2>All internal blog posts:</h2>
	<p><a href="javascript:expandIt(document.getElementById('link0055'))">[+/-]  Get all posts</a> </p>
	<div id="link0055" style="display: none;">
		<ul class="arrow_list"><?php $archive_query = new WP_Query('showposts=1000');
			while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> 
				 (<?php comments_number('0', '1', '%'); ?>)
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<div class="divider top"><a href="#">Top</a></div>



<h2>Archives</h2>
	<ul class="arrow_list">
		<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
	</ul>

	<div class="divider top"><a href="#">Top</a></div>
