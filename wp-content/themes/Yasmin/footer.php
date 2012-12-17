<div class='clear'></div>
</div>

<div class="container" id="bottom">
	<ul>

	<?php if ( !function_exists('dynamic_sidebar')
	        || !dynamic_sidebar("Footer") ) : ?>  
	
	<?php endif; ?>
	
	</ul>
	<div class='clear'></div>
</div>

<div class="container" id="footer">
	<div class="fcred">
		Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
		<a href="http://www.designcontest.com/website-design/" title="Website Design">Website Design</a> by <a href="http://www.fabthemes.com/" title="WordPress Themes - FabThemes.com">Fab Themes</a>.
	</div>	
<div class='clear'></div>	
<?php wp_footer(); ?>
</div>
<div class='clear'></div>	
</div>
</body>
</html>      