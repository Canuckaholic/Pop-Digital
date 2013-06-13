<?php
global $shortname;
$slider_options = get_option($shortname.'_custom_slider');
if($slider_options){
	foreach ($slider_options as $key => $value) {
		$$key = $value;	
	}
}

if(!$custom_slider_count){$custom_slider_count = 1;}
if(!$custom_slider_url_0){$no_first_slider = true;}
if($custom_slider_stage_0 == 'stage'){$intro_stage = true;}
if( ($intro_stage) && (!$no_first_slider) && ($custom_slider_count==1)){$stage_top = '20px';}else{$stage_top = '0px';}

$number = $custom_slider_count; $numbers = range(1,$number);
?>
<div id="home_feature">
	<div class="background">
		<div class="inner">

<div id="slider_thumbnails" style="display:none;">
	<div id="slider_preview_img">
		<?php $counter = 0;
		
		foreach ($numbers as $number) {
			$custome_image = 'custom_slider_url_' . $counter;
			if ($$custome_image && $custom_slider_count !=1) {
				?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/transparent.png" alt="" width="14" height="14" class="slider_preview_img" />
			<?php } $counter++;
		} ?>
	</div><!-- end slider_preview_img -->
</div><!-- end slider_thumbnails -->

<div id="loading_slider"></div>
<div id="slider_img" style="display:none;position:relative;">
	<?php $number = $custom_slider_count; $numbers = range(1,$number);
	$counter = 0;
	$counter_2 = 1;

	foreach ($numbers as $number) {
		$custome_image = 'custom_slider_url_' . $counter;
		$custome_url = 'custom_slider_link_' . $counter;
		$custome_title = 'custom_slider_title_' . $counter;
		$custome_desc = 'custom_slider_desc_' . $counter;
		$stage_effect = 'custom_slider_stage_' . $counter;
		$disable_btn = 'custom_slider_btn_' . $counter;
		$stage_effect_class = ($$stage_effect == 'full' || $$stage_effect == 'full-cropped') ? ' class="slider_full"' : ' class="slider_cropped"';
		?>
		
		<?php 
		if($no_first_slider) {
			$$custome_image = get_template_directory_uri() .'/images/infocus_banner.jpg';
			$stage_effect_class	=' class="slider_cropped"'; 
			$stage_top = '20px'; } ?>
		
		<?php if ($$custome_image) { ?>
		<div id="image_loader_<?php echo $counter_2; ?>"<?php echo $stage_effect_class; ?>>
			
			<div class="slider_content" style="display:none;left:0;position:absolute;top:0;z-index:10">
				<h2><?php echo stripslashes($$custome_title); ?></h2>
				<p><?php echo stripslashes($$custome_desc); ?></p>
				<?php if($$custome_url && !$$disable_btn) { ?>
				<a href="<?php echo $$custome_url; ?>" class="button">Read More</a>
				<?php } ?>
			</div>
			
			<?php
			if($$stage_effect == 'full-cropped') { 
				$custome_image = webtreats_image_resize($height='340', $width='600', $$custome_image);
			?>
			
			<div style="position:absolute;right:0;top:0;margin:20px 0 0 0;">
				<a href="<?php if(!$$custome_url){echo '#';}else{echo $$custome_url;} ?>" class="load_slider_img">
					<span class="rm_portfolio_img"><img src="<?php echo $custome_image; ?>" alt="" /></span>
					<div class="slider_frame"></div>
				</a>
			</div>
			
			<?php }else{ ?>
				
			<div style="position:absolute;right:0;top:<?php echo $stage_top; ?>;">
				<a href="<?php if(!$$custome_url){echo '#';}else{echo $$custome_url;} ?>" class="load_slider_img">
					<span class="rm_portfolio_img"><img src="<?php echo $$custome_image; ?>" alt="" /></span>	
				</a>
			</div>
				
			<?php } ?>

		</div>
		<?php $counter_2++; } ?>
		
	<?php $counter++;
	} ?>
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