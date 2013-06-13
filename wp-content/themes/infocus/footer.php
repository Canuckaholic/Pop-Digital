<?php require(WEBTREATS_INCLUDES . "/var.php"); ?>
<div class="clearboth"></div>
</div><!-- inner -->								
</div><!-- body_block -->

<div id="footer">
	<div class="background">

		<div class="inner">
			<div class="two_third"><div class="content">
				<div class="one_fourth">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?> 
						<div class="widget widget_recent_entries" id="recent-posts-1">
							<h3 class="widgettitle">Recent</h3>
							<ul>
								<li><a title="Lorem sit amet" href="#">Lorem sit amet </a></li>
								<li><a title="Morbi vel est nunc" href="#">Morbi vel est nunc </a></li>
								<li><a title="Sed id est id tellus" href="#">Sed id est id tellus </a></li>
								<li><a title="Fusce quis nunc" href="#">Fusce quis nunc </a></li>
								<li><a title="Suspendisse vestibulum mollis" href="#">Suspendisse vestibulum mollis </a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="one_fourth">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?>
						<div class="widget widget_archive" id="archives-1">
							<h3 class="widgettitle">Archives</h3>
							<ul>
								<li><a title="February 2010" href="#">February 2010</a></li>
								<li><a title="January 2010" href="#">January 2010</a></li>
								<li><a title="December 2009" href="#">December 2009</a></li>
								<li><a title="November 2009" href="#">November 2009</a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				<div class="one_fourth">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?>
						<div class="widget widget_meta" id="meta-1">
							<h3 class="widgettitle">Meta</h3>
							<ul>
								<li><a href="#">Log in</a></li>
								<li><a title="Syndicate this site using RSS 2.0" href="#">Entries <abbr title="Really Simple Syndication">RSS</abbr></a></li>
								<li><a title="The latest comments to all posts in RSS" href="#">Comments <abbr title="Really Simple Syndication">RSS</abbr></a></li>
								<li><a title="Powered by WordPress, state-of-the-art semantic personal publishing platform." href="#">WordPress.org</a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				<div class="one_fourth last">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(5) ) : ?>
						<div class="widget widget_categories" id="categories-1">
							<h3 class="widgettitle">Categories</h3>
							<ul>
								<li class="cat-item cat-item-3"><a title="View all posts filed under Portfolio" href="#">Portfolio</a></li>
								<li class="cat-item cat-item-1"><a title="View all posts filed under News" href="#">News</a></li>
								<li class="cat-item cat-item-1"><a title="View all posts filed under Recent Works" href="#">Recent Works</a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>

				</div>
			</div>
			
				<div class="one_third last">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(6) ) : ?>
						<?php
						if ( !is_active_widget('webtreats_contact_form_widget') ){
						$args = array('title'=> '', 'before_widget' => '<div id="contact-form-widget" class="widget webtreats_contact_form_widget">','after_widget' => '</div>','before_title' => '<h3 class="widgettitle">','after_title' => '</h3>');
						webtreats_contact_form_widget($args);
						}
						?>
					<?php endif; ?>
				</div>
								
<div class="clearboth"></div>
	
		</div><!-- inner -->
	</div><!-- background -->
</div><!-- footer -->

<div id="sub_footer">
	<div class="inner">
		<div class="one_half"><?php echo stripslashes($footer_text); ?></div>				
			<div class="one_half last" style="text-align:right;">
				<div id="footer_nav">
					<?php if($footer_include) { ?>
					<ul>
						<?php wp_list_pages("depth=0&sort_column=menu_order&include=$footer_include&title_li="); ?>
					</ul>
					<?php } ?>
				</div>
			</div>											

<div class="clearboth"></div>
	
	</div><!-- inner -->							
</div><!-- sub_footer -->

<?php wp_footer(); ?>
<script type="text/javascript">Cufon.now();</script>
<?php if ( $analytics_code <> "" ) { echo stripslashes($analytics_code); } ?>
<script type="text/javascript">
/* <![CDATA[ */
function expandIt(getIt){getIt.style.display=(getIt.style.display=="none")?"":"none";}
/* ]]> */
</script>
</body>
</html>