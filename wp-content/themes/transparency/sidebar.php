<!-- begin sidebar -->
<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(1) ) : ?>
<!-- begin featured video -->
<div class="box">
<h2>Featured Video</h2>
<script type="text/javascript">showVideo("<?php echo dp_settings('youtube'); ?>");</script>
</div>
<!-- end featured video -->
<!-- begin recent posts -->
<div class="box">
<h2>Recent Posts</h2>
<ul><?php dp_recent_posts(5); ?></ul>
</div>
<!-- end recent posts -->
<!-- begin recent comments -->
<div class="box">
<h2>Recent Comments</h2>
<ul><?php dp_recent_comments(5); ?></ul>
</div>
<!-- end recent comments -->
<!-- begin tags -->
<div class="box">
<h2>Tags</h2>
<?php if (function_exists('wp_widget_tag_cloud')) wp_widget_tag_cloud(array('before_title'=>'<!--','after_title'=>'-->')); ?>
</div>
<!-- end tags -->
<?php endif; ?>
<!-- begin left -->
<div class="l">
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(2) ) : ?>
	<!-- begin pages -->
	<h2>Pages</h2><ul><?php dp_list_pages(); ?></ul>
	<!-- end pages -->
	<!-- begin categories -->
	<h2>Categories</h2>
	<ul><?php wp_list_categories('title_li=&depth=-1'); ?>	</ul>
	<!-- end categories -->
<?php endif; ?>
</div>
<!-- end left -->
<!-- begin right -->
<div class="r">
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(3) ) : ?>
	<!-- begin blogroll -->
	<?php wp_list_bookmarks('category_before=&category_after=&title_before=<h2>&title_after=</h2>'); ?>
	<!-- end blogroll -->
	<!-- begin archives -->
	<h2>Archives</h2>
	<ul><?php wp_get_archives('type=monthly'); ?></ul>
	<!-- end archives -->
	<!-- begin meta -->
	<h2>Meta</h2>
	<ul>
	<?php wp_register(); ?>
	<li><?php wp_loginout(); ?></li>
	<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php bloginfo('stylesheet_url'); ?>">Valid CSS</a></li>
	<li><a href="http://validator.w3.org/check/referer#">Valid XHTML</a></li>
	<?php wp_meta(); ?>
	</ul>
	<!-- end meta -->
<?php endif; ?>
</div>
<!-- end right -->
</div>
<!-- end sidebar -->
