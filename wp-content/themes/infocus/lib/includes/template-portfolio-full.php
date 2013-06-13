<?php
/*
Template Name: Portfolio Full View
*/
get_header(); 
require(WEBTREATS_INCLUDES . "/var.php");
?>

<script type="text/javascript">
/* <![CDATA[ */
	document.write('<style type="text/css">.noscript { display:none; }</style>');
	jQuery.noConflict();
	
	function portfolio_img_hover() {
		jQuery(".portfolio_full_img_holder").hover(
			function() {
					jQuery(this).find('.hover_fade').stop().animate({opacity:0.4},400);
				},
				function() {
					jQuery(this).find('.hover_fade').stop().animate({opacity:1},400);
				});
	}

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

			// add image to div
			jQuery('<span id="img'+(index+1)+'"></span>').each(function() {
			   jQuery(this).appendTo('#image_loader_'+(index+1)+' a.load_portfolio_img');
			});

			// new image object
			var $img = new Image();
			
			// current image
			var $curr = jQuery("#img"+(index+1));
			
			// load current image
			jQuery($img).load(function () {
				
				// hide it first + .hide() failed in safari
				jQuery(this).css('display','none');
				
				//add alt attr & hover fade
				jQuery(this).attr({alt: ""});
				jQuery(this).addClass('hover_fade');
				
				// remove loading class from div and insert the image into it
				jQuery($curr).append(this);
				
				// fade it in
				jQuery(this).fadeIn(500,function() {
					
					jQuery('#image_loader_'+(index+1)).find('.loading_gallery_full').remove();
					jQuery('#image_loader_'+(index+1)).find('.roll_over').css('display','block');

					if(index == ($max-1)) {
						// activate hover class
						   portfolio_img_hover();
						}else{
						  // we are loading next item
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


<?php 
$teaser_text = get_post_meta($post->ID, 'teaser_text', true);
$teaser_text_custom = get_post_meta($post->ID, 'teaser_text_custom', true);
if ($teaser_text == 'disable' || $header_teaser == 'disable') {
	$header_disable = true; }
?>

<div id="intro_blurb"<?php if ($header_disable){echo ' style="display:none;"';}?>>
	<div class="inner">
		<div id="intro_blurb_title"><span><?php the_title(); ?></span></div>
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
		<?php if (!$breadcrumb_disable){ if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; }} ?>
	</div><!-- inner -->							
</div><!-- breadcrumbs -->

<div id="body_block">
	<div class="inner">
		<div id="primary_full">
			<div class="content">
				
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						
					<?php if ($header_disable) { ?>
					<h1><?php the_title(); ?></h1>
					<?php } ?>							

					<div class="entry">
						<?php the_content(); ?>
					</div>
						
				</div> <!-- .post -->
						
			<?php endwhile; endif; ?>
					

	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	query_posts("paged=$paged&cat=$portfolio_cat&posts_per_page=$portfolio_max");
	$counter = 0;

	if(have_posts()) : while(have_posts()) : the_post();
	
	$date = get_post_meta($post->ID, 'portfolio_date',true);
	$portfolio_link = get_post_meta($post->ID, 'portfolio_link',true);
	$portfolio_gallery = get_post_meta($post->ID, 'portfolio_gallery_img',true);
	$portfolio_full = get_post_meta($post->ID, 'portfolio_full_img',true);
	$teaser_text = get_post_meta($post->ID, 'portfolio_teaser_text',true);
	$portfolio_video = get_post_meta($post->ID, 'portfolio_video_link', true);
	$read_more_disable = get_post_meta($post->ID, 'portfolio_read_disable',true);
	$portfolio_video_link = ($portfolio_video) ? $portfolio_video : $portfolio_full;
	$rollover_class = ($portfolio_video) ? ' rollover_play' : ' rollover';
	
	if($portfolio_gallery){
		$gallery_image_url = webtreats_image_resize($height='246',$width='447',$portfolio_gallery);	
	}else{
		$gallery_image_url = webtreats_image_resize($height='246',$width='447',$portfolio_full);
	} ?>
 	
	<?php if($portfolio_full) { $counter++; ?>
		<div class="one_half">
			<div class="full_portfolio_frame">
				<div id="image_loader_<?php echo $counter; ?>">
					<div class="portfolio_full_img_holder">
						<div class="loading_gallery_full"></div>
						<a class="load_portfolio_img" rel="lightbox[portfolio]" href="<?php echo $portfolio_video_link; ?>">
							<span class="rm_portfolio_img noscript"><img src="<?php echo $gallery_image_url; ?>" alt="<?php the_title(); ?>" /></span>
							<span class="roll_over<?php echo $rollover_class; ?>"></span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="one_half last">
			
			<?php if(!$read_more_disable) { ?>
			<h2 class="portfolio"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php }else{ ?>
			<h2 class="portfolio"><?php the_title(); ?>		
			<?php } ?>
			
			<?php if($date) { ?>
			<br /><span class="date"><?php echo $date;?></span>
			<?php } ?>
			</h2>
		
			<?php if($teaser_text) { ?>	
			<p><?php echo $teaser_text; ?></p>
			<?php } ?>
		
			<?php if(!$read_more_disable) { ?>
			<a class="button_link" href="<?php the_permalink(); ?>"><span>Read More</span></a>
			<?php } ?>
		
			<?php if($portfolio_link) { ?>
			<a class="button_link" target="_blank" href="<?php echo $portfolio_link; ?>"><span>Visit Site</span></a>
			<?php } ?>
			
		</div>	
	
	<div class="clearboth"></div>
	<?php } ?>
	
	<?php endwhile; endif; ?>

	<div class="clearboth"></div>
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	
	</div> <!-- content -->
</div> <!-- primary_full -->

<?php get_footer(); ?>