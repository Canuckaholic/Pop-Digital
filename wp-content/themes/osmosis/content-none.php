<?php
/*
*	Template Content None
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>
<article <?php post_class(); ?>>
	<div class="grve-post-content">
		<p class="grve-align-center grve-leader-text">
			<?php _e( "Hey there mate!<br/>Your lost treasure is not found here...", GRVE_THEME_TRANSLATE ); ?>
			<br>
		<p class="grve-align-center">
			<?php _e( "Check again your spelling and rewrite the content you are seeking for in the search field.", GRVE_THEME_TRANSLATE ); ?>
		</p>
		<div class="grve-widget">
			<?php get_search_form(); ?>
		</div>
	</div>
</article>