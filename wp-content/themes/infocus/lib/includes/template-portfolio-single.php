<?php
/*
Template Name: Portfolio Single Template
*/
//get_header();
require(WEBTREATS_INCLUDES . "/var.php");
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
			   jQuery(this).appendTo('#image_loader_'+(index+1)+' .portfolio_single_pic');
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
					
					jQuery('#image_loader_'+(index+1)).find('.loading_gallery_post').remove();

					if(index == ($max-1)) {

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
$category = get_the_category(); 

$teaser_text = get_post_meta($post->ID, 'teaser_text', true);
$teaser_text_custom = get_post_meta($post->ID, 'teaser_text_custom', true);
if ($teaser_text == 'disable' || $header_teaser == 'disable') {
	$header_disable = true; }
?>

<div id="intro_blurb"<?php if ($header_disable){echo ' style="display:none;"';}?>>
	<div class="inner">
		<div id="intro_blurb_title"><span><?php echo $category[0]->cat_name; ?></span></div>
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
				
<?php 
if(have_posts()) : while(have_posts()) : the_post();

	$date = get_post_meta($post->ID, 'portfolio_date',true);
	$portfolio_full = get_post_meta($post->ID, 'portfolio_full_img',true);
	$portfolio_full = webtreats_image_resize($height='516',$width='945',$portfolio_full);
?>	
			
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">	
	

		<h1 class="portfolio"><?php the_title(); ?><br />
			<span class="date"><?php echo $date; ?></span></h1>		
		
		
		<div id="image_loader_1">
			<div class="portfolio_single_pic">
				<div class="loading_gallery_post"></div>
					<span class="rm_portfolio_img noscript"><img title="portfolio1" src="<?php echo $portfolio_full; ?>" alt="" /></span>
				</div>
			</div>
			
		<div class="entry">	
			<?php the_content(); ?>	
		</div>
	
<?php wp_link_pages('before=<div id="page-links">Pages: &after=</div>'); ?>

</div> <!-- .post -->

<div id="comments">
	<?php comments_template(); ?>
</div>

<?php endwhile; endif; ?>

	</div> <!-- content -->
</div> <!-- primary_full -->

<?php get_footer(); ?>