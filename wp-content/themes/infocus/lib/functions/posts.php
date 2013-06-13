<?php
/**
 * Popular and Related Posts Modules
 */
function webtreats_related_post() {
	global $post, $wpdb;
	$backup = $post;  // backup the current object
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
	  $tagcount = count($tags);
	  for ($i = 0; $i < $tagcount; $i++) {
	    $tagIDs[$i] = $tags[$i]->term_id;
	  }
	  $args=array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post->ID),
	    'showposts'=>3,
	    'caller_get_posts'=>1
	  );
	  $my_query = new WP_Query($args);
	  if( $my_query->have_posts() ) { $related_post_found = true; ?>
		<h3>Related Posts</h3>
			<ul class="thumbnail_list">		
	    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<?php $post_id = get_the_ID(); ?> 
		<?php $meta_image = get_post_meta($post->ID, "post_image", true);
				if(!$meta_image){
					$meta_image = get_template_directory_uri() .'/images/empty_thumb.gif';
				}else{
					$meta_image = WEBTREATS_SCRIPTS_FOLDER .'/thumb.php?src=' .$meta_image. '&amp;w=60&amp;h=60&amp;zc=1&amp;q=100';
				}
				?>
				<li>
					<a class="alignleft" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
					<span class="small_frame"><img src="<?php echo $meta_image; ?>" width="60" height="60" alt="<?php echo $post_title; ?>"/></span></a>
					<a class="thumbnail_title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><br/>
					<a class="date" href="#"><?php the_time('F j, Y'); ?></a>
					<div class="clearboth" />
				</li>				
	    <?php endwhile; ?>
			</ul>		
	  <?php }
	}
	$post = $backup;  // copy it back
	//wp_reset_query(); // to use the original query again
	
	//show recent posts if no related found
	if(!$related_post_found){
		$posts = get_posts('numberposts=3&offset=0');
		if($posts){ ?>
		<h3>Recent Posts</h3>
		<ul class="thumbnail_list">
			<?php foreach($posts as $post){
					$post_title = stripslashes($post->post_title);
					$post_date = $post->post_date;
					$post_date = mysql2date('F j, Y', $post_date, false);
					$permalink = get_permalink($post->ID);
					$meta_image = get_post_meta($post->ID, "post_image", true);
					if(!$meta_image){
						$meta_image = get_template_directory_uri() .'/images/empty_thumb.gif';
					}else{
						$meta_image = WEBTREATS_SCRIPTS_FOLDER .'/thumb.php?src=' .$meta_image. '&amp;w=60&amp;h=60&amp;zc=1&amp;q=100';
					}
					?>			
			<li>
				<a class="alignleft" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
				<span class="small_frame"><img src="<?php echo $meta_image; ?>" width="60" height="60" alt="<?php echo $post_title; ?>"/></span></a>
				<a class="thumbnail_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br/>
				<a class="date" href="#"><?php echo $post_date; ?></a>
				<div class="clearboth" />
			</li>
				<?php } ?>
		</ul>
			<?php }
	}
	wp_reset_query();
}

function webtreats_popular_post() {
	global $wpdb;
	$pop_posts = get_option('webtreats_popular_posts');
	if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 3;
	$now = gmdate("Y-m-d H:i:s",time());
	$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
	$popularposts = "SELECT ID, post_title, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
	$posts = $wpdb->get_results($popularposts);
	$popular = '';
	if($posts){ ?>
		<h3>Popular Posts</h3>
			<ul class="thumbnail_list">
				
		<?php foreach($posts as $post){ 
				$post_title = stripslashes($post->post_title);
				$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
				$permalink = get_permalink($post->ID);
				$meta_image = get_post_meta($post->ID, "post_image", true);
					if(!$meta_image){
						$meta_image = get_template_directory_uri() .'/images/empty_thumb.gif';
					}else{
						$meta_image = WEBTREATS_SCRIPTS_FOLDER .'/thumb.php?src=' .$meta_image. '&amp;w=60&amp;h=60&amp;zc=1&amp;q=100';
					}
					?>
					<li>
						<a class="alignleft" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
						<span class="small_frame"><img src="<?php echo $meta_image; ?>" width="60" height="60" alt="<?php echo $post_title; ?>"/></span></a>
						<a class="thumbnail_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br/>
						<a class="date" href="#"><?php echo $post_date; ?></a>
						<div class="clearboth" />
					</li>
		<?php } ?>
		</ul>
	<?php }		
}

function webtreats_author_info() { ?>
<div class="gradient_box_middle" id="about_the_author">
	<div class="gradient_box_top">
		<div class="gradient_box_bottom">
			<span class="sprite"></span>
			<?php echo get_avatar( get_the_author_email(), '80' ); ?>
			<p class="padding"><strong><?php the_author_link(); ?> - </strong><?php the_author_description(); ?></p>
			<div class="clearboth"></div>	
		</div>	
	</div>	
</div>	
<?php 
}
?>