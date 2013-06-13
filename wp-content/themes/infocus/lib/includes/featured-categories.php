<?php $featured_query = new WP_Query("cat=$slider_showcats&showposts=$slider_count"); ?>

<div id="home_feature">
	<div class="background">
		<div class="inner">
		
			<div id="slider_thumbnails" style="display:none;">
				<div id="slider_preview_img">
					<?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
						<?php $custome_image = get_post_meta($post->ID, 'frontpage_image', true); ?>
							<?php if ($custome_image) { ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/transparent.png" alt="" width="14" height="14" class="slider_preview_img" />
							<?php } ?>
					<?php endwhile ; ?>
				</div><!-- end slider_preview_img -->
			</div><!-- end slider_thumbnails -->
		
<div id="loading_slider"></div>											
<div id="slider_img" style="display:none;position:relative;">
		<?php
		$counter = 1;
	    while ($featured_query->have_posts()) : $featured_query->the_post();
	    $custome_image = get_post_meta($post->ID, 'frontpage_image', true);
		$stage_effect = get_post_meta($post->ID, 'frontpage_stage', true);
		$disable_text = get_post_meta($post->ID, 'frontpage_disable_text', true);
		$stage_effect_class = ($stage_effect == 'full' || $stage_effect == 'full-cropped') ? ' class="slider_full"' : ' class="slider_cropped"';
		?>
		
		<?php if ($custome_image) { ?>
		<div id="image_loader_<?php echo $counter; ?>"<?php echo $stage_effect_class; ?>>
		
			<?php if (!$disable_text) { ?>
			<div class="slider_content" style="display:none;left:0;position:absolute;top:0;z-index:10;">
				<h2><?php echo the_title(); ?></h2>
				<p><?php echo webtreats_excerpt(250, ' ... '); ?></p>
				<a href="<?php echo get_permalink(); ?>" class="button">Read More</a>
			</div>
			<?php } ?>

			<?php
			if($stage_effect == 'full-cropped') { 
				$custome_image = webtreats_image_resize($height='340', $width='600', $custome_image);
			?>
			
			<div style="position:absolute;right:0;top:0;margin:20px 0 0 0;">
				<a href="<?php echo get_permalink(); ?>" class="load_slider_img">
					<span class="rm_portfolio_img"><img src="<?php echo $custome_image; ?>" alt="" /></span>	
					<div class="slider_frame"></div>
				</a>
			</div>
			
			<?php }else{ ?>
				
			<div style="position:absolute;right:0;top:0;">
				<a href="<?php echo get_permalink(); ?>" class="load_slider_img">
					<span class="rm_portfolio_img"><img src="<?php echo $custome_image; ?>" alt="" /></span>	
				</a>
			</div>
				
			<?php } ?>
			
		</div>
		<?php $counter++; } ?>
			
		<?php endwhile ; ?>
</div><!-- end slider_img -->
	
		</div><!-- inner -->
	</div><!-- background -->							
</div><!-- home_feature -->

<?php if(!$home_teaser_disable) { ?>
<div id="call_to_action">
	<div class="inner">
			<div id="blurb">
				<?php echo stripslashes($teaser_text); ?>
			</div>
			
				<div id="call_to_action_button">
					<?php if($teaser_button) {$link = get_permalink($teaser_button); }else{$link = '#';}?>
					<a href="<?php echo $link; ?>"></a>
				</div>

	</div><!-- inner -->							
</div><!-- home_feature -->
<?php }else{ ?>

<div id="breadcrumbs">
	<div class="inner">
	</div><!-- inner -->							
</div><!-- breadcrumbs -->
			
<?php } ?>

<div class="clearboth"></div>

<div id="body_block">
	<div class="inner">
		<div id="primary_full">
			<div class="content">			
	
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">	
	<div class='entry'>
		<?php
		global $more;
		if($mainpage_content){
			$maincontent = $mainpage_content;
			$maincontent = "showposts=1&page_id=$maincontent";
			query_posts($maincontent);

			if (have_posts()) : 
			while (have_posts()) : the_post();
			$more = 0;
			?>
				<?php the_content("<span>Read More</span>",false);

			endwhile; 
			endif;
			} else {
				include(WEBTREATS_INCLUDES . "/homepage-default.php");
			} ?>

			</div><!-- entry-->
		</div> <!-- .post -->
	</div> <!-- content -->
</div> <!-- primary-full -->