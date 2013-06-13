<?php 
get_header();
require(WEBTREATS_INCLUDES . "/var.php");

$teaser_text = get_post_meta($post->ID, 'teaser_text', true);
$teaser_text_custom = get_post_meta($post->ID, 'teaser_text_custom', true);
if ($teaser_text == 'disable' || $header_teaser == 'disable') {
	$header_disable = true;
}
?>

<div id="intro_blurb"<?php if ($header_disable){echo ' style="display:none;"';}?>>
	<div class="inner">
		<div id="intro_blurb_title"><span>404 - Not Found</span></div>
			<div id="blurb">
				Looks like the page you're looking for isn't here anymore. Try using the search box or sitemap below.
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

<?php if ($header_disable) { ?>
<h1>404 - Not Found</h1>
<?php } ?>
<div <?php post_class() ?> id="post-404">
	
	<?php if ($header_disable) { ?>
	<h5>Looks like the page you're looking for isn't here anymore. Try using the search box or sitemap below.</h5>
	<?php } ?>

	<?php include(TEMPLATEPATH. '/searchform.php'); ?>

	<div class="divider top"><a href="#">Top</a></div>
	<?php require(WEBTREATS_INCLUDES . "/sitemap-content.php"); ?>
	
</div> <!-- .post -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>