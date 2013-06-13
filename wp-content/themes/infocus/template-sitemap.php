<?php
/*
Template Name: Sitemap Template
*/
get_header();
require(WEBTREATS_INCLUDES . "/var.php");

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

<div id="has_sidebar">
	<div id="body_block">
		<div class="inner">
			<div id="primary">
				<div class="content">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">	
	
						<?php if ($header_disable) { ?>
						<h1><?php the_title(); ?></h1>
						<?php } ?>
	
						<div class="entry">
							<?php the_content(); ?>
							<?php require(WEBTREATS_INCLUDES . "/sitemap-content.php"); ?>
							<div class="clearboth"></div>
						</div>
	
					<?php wp_link_pages('before=<div id="page-links">Pages: &after=</div>'); ?>

				</div> <!-- .post -->

<?php endwhile; endif; ?>
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>