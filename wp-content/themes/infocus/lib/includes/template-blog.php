<?php
/*
Template Name: Blog
*/

$teaser_text = get_post_meta($blog_page, 'teaser_text', true);
$teaser_text_custom = get_post_meta($blog_page, 'teaser_text_custom', true);
if ($teaser_text == 'disable' || $header_teaser == 'disable') {
	$header_disable = true; }
?>
<script type="text/javascript">
/* <![CDATA[ */
	document.write('<style type="text/css">.noscript { display:none; }</style>');
	jQuery.noConflict();
	
	// preload ajax-loader.gif
	jQuery.preloadImages("<?php echo get_template_directory_uri();?>/images/ajax-loader.gif");
		
	// ajax page GET function
	jQuery(document).ready(function() {	
	
	// image loader
	jQuery(this).delay(500,function() {
		
		// id of the div containers
		var $imgContainerId = "div[id^='image_loader_']";
		
		// grab the images
		var $images = jQuery($imgContainerId+' span img');
		
		// image length
		var $max = $images.length;
		
		// remove them from DOM to prevent normal load
		jQuery('.rm_portfolio_img').remove();

		// loading div object
		var $loadDiv = null;
		
		// start loading
		if($max>0) {
			LoadImage(0,$max);
		}

	// loading function handler
	function LoadImage(index,$max) {
		if(index<$max) {

			// add list to div
			jQuery('<span id="img'+(index+1)+'"></span>').each(function() {
			   jQuery(this).appendTo('#image_loader_'+(index+1)+' a.load_blog_img');
			});

			// new image object
			var $img = new Image();
			
			// current image
			var $curr = jQuery("#img"+(index+1));
			
			// load current image
			jQuery($img).load(function () {
				
				// hide it first + .hide() failed in safari
				jQuery(this).css('display','none');
				
				// remove loading class from div and insert the image into it
				jQuery($curr).append(this);
				
				// fade it in
				jQuery(this).fadeIn(250,function() {
					
					jQuery('#image_loader_'+(index+1)).find('.loading_blog').remove();

					if(index == ($max-1)) {
							// remove loading div after all images loaded
							//jQuery($loadDiv).remove();
						}else{
						  // we are inform loading next item
						  //jQuery($loadDiv).html('Wait Loading Next Item ...');
						  LoadImage(index+1,$max);
						}
				});
			}).error(function () {
				// if loading error remove div
				jQuery($curr).remove();
				// try to load next item
				LoadImage(index+1,$max);
			}).attr('src', jQuery($images[index]).attr('src'));
	   	  }
    	}
    });
	
});	
/* ]]> */
</script>

<div id="intro_blurb"<?php if ($header_disable){echo ' style="display:none;"';}?>>
	<div class="inner">
		<div id="intro_blurb_title"><span><?php echo get_the_title($blog_page) ?></span></div>
			<div id="blurb">
			
			<?php
			//Header Teaser Text Options
			if (!$teaser_text || $teaser_text == 'default') {

				if ($header_teaser == 'customtext' && $teaser_custom) {
					echo stripslashes($teaser_custom);
				}
				if ($header_teaser == 'twitter' && !$twitter_id) {
					echo 'You must have your Twitter user name entered in the "General Settings" tab of your themes options for this to function properly.';
				}
				if ($header_teaser == 'twitter' && $twitter_id) {
					$usernames = $twitter_id; $limit = '1'; $type = 'teaser';
					parse_cache_feed($usernames, $limit, $type);
				}
			
			}else{
			
				if ($teaser_text == 'custom' && !$teaser_text_custom) {
					echo stripslashes($teaser_custom);
				}
				if ($teaser_text == 'custom' && $teaser_text_custom) {
					echo stripslashes($teaser_text_custom);
				}
				if ($teaser_text == 'twitter' && !$twitter_id) {
					echo 'You must have your Twitter user name entered in the "General Settings" tab of your themes options for this to function properly.';
				}
				if ($teaser_text == 'twitter' && $twitter_id) {
					$usernames = $twitter_id; $limit = '1'; $type = 'teaser';
					parse_cache_feed($usernames, $limit, $type);
				}
			}
			?> 
		</div>
	</div><!-- inner -->						
</div><!-- intro_blurb -->

<div class="clearboth"></div>

<div id="breadcrumbs">
	<div class="inner">
<?php 
$show_on_front = get_option('show_on_front');
$page_on_front = get_option('page_on_front');
	if ( (!$breadcrumb_disable) && ($show_on_front != 'page') && ($page_on_front != $blog_page) ) { 
		if (class_exists('simple_breadcrumb')) { 
			$bc = new simple_breadcrumb; 
			}
		} 
?>
	</div><!-- inner -->							
</div><!-- breadcrumbs -->

<div id="has_sidebar">
	<div id="body_block">
		<div class="inner">
			<div id="primary">
				<div class="content">

<?php if ($header_disable) { ?>
<h1><?php echo get_the_title($blog_page) ?></h1>
<?php } ?>

<?php
$exclude_blog_cats = preg_replace("!(\d)+!","-${0}$0", $blog_excludecats);
$query_string = "cat=".$exclude_blog_cats."&paged=$paged";
query_posts($query_string);
$counter=0;
?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div class="blog_module">

		<h2 class="blog_header"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>		

		<div class="top_metadata">
			<?php $get_year = get_the_time('Y'); $get_month = get_the_time('m'); ?>
			Posted <a href="<?php echo get_month_link($get_year, $get_month); ?>"><?php the_time('M j Y') ?></a> by <?php the_author_posts_link(); ?>		
					<?php if ( count(($categories=get_the_category())) > 1 || $categories[0]->cat_ID != 1 ) : ?>
						 in <?php the_category(', ') ?>
					<?php endif; ?>
			with <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
		</div>

		<?php
		$post_image = get_post_meta($post->ID, 'post_image', true);
		$post_image = webtreats_image_resize($height='234', $width='612', $post_image);
		?>
		
		<?php if ($post_image) { $counter++; ?>
			
		<div id="image_loader_<?php echo $counter; ?>">
			<div class="blog_frame">
				<div class="loading_blog"></div>
				<a class="load_blog_img" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
					<span class="rm_portfolio_img noscript"><img src="<?php echo $post_image; ?>" alt="" /></span>
				</a>
			</div>
		</div>
		
		<?php } ?>

		<div class="entry">
			<?php the_excerpt(); ?>
		</div>	

		<a class="button_link" href="<?php the_permalink(); ?>"><span>Read More</span></a>
		
	</div><!-- blog_module -->
</div><!-- post -->

<?php endwhile; ?>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	
<?php else : ?>

	<p>Sorry, that document can not be found.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>