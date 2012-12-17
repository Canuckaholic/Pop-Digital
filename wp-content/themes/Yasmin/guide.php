<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2>Theme Documentation</h2>
		
		<div class="metabox-holder">
		<div class="postbox-container" style="width:70%;">
		
		
		
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Theme License </span> </h3>
						
						<div class="inside">
						<p>	The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL. 
  							All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage.  </p>
  								<p> You are requested to retain the credit banners on the template. </p>
  								<p> You are allowed to use the theme on multiple installations, and to edit the template for your personal use. </p>
  								<p> You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it. </p>  
  								<p> You are NOT allowed to use the theme as a part of a template repository for any paid CMS service. </p>
							
						</div>
				</div> <!-- postbox end -->
				
				
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> About the theme </span> </h3>
						
						<div class="inside">
						<p>	Yasmin is a responsive blog/portfolio theme. That means the theme will adjust itself to the screen size of various devices used to browse the web. Let that be your desktop, laptop, tablet or even your smart phone. You will not have to swipe and drag to see the content overflowing your small screen sized devices. It is not only the site layout that is responsive, even the media elements like images, slideshows and videos are responsive in this theme.
						  </p>
  			
							
						</div>
				</div> <!-- postbox end -->
		
		
		    	<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Theme options explained </span> </h3>
						
						<div class="inside">
						<b> 1. Logo</b>
						<p>	You have an option to set an image logo for your website. You can upload your logo image and set it as your logo with this option. Mind the height and width limitation of the site header while creating your logo image.</p>
						
						<b> 2. Social network</b>
  						<p> You can set various social bookmark links like, Twitter, Facebook, Linkedin ec. </p>
							
						<b> 3. Featured slider</b>	
						<p>This is an area to display a large featured image slideshow. You can set this section to be visible or not. You will have the option to select the category from which the featured slider pulls the images and also set the number of images to be shown. </p>
						<b> 4. Callout box</b>
						<p> This is a customizable area that can display any callout text you want to display. You can choose to display or not to display this section. You can also enter the custom content via the theme option.</p>	
						
						<b> 5. Portfolio page</b>
						<p>Select the Portfolio page. But you will have to create the Portfolio page using the "Portfolio-page" custom page template.</p>	
						<b> 6. Blog page</b>	
						<p>Select the Blog page. But you will have to create the Blog page using the "Blog" custom page template.</p>	
							
							
							
						</div>
				</div> <!-- postbox end -->	
				
				
		    	<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Create portfolio item </span> </h3>
						
						<div class="inside">
						<p>	Portfolio post types are used to display your portfolio items. This theme supports 2 portfolio items. </p> 
						
						<p>1. Image</p>
						<p>2. Video</p>
						  
						<p>Watch the screencast below to see how to create the portfolio entries.</p>
						
						
						<p> <iframe src="http://www.screenr.com/embed/W0p8" width="650" height="396" frameborder="0"></iframe> </p>
  		
							
						</div>
				</div> <!-- postbox end -->		
				
				
		    	<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Custom page templates </span> </h3>
						
						<div class="inside">
						<p>	This theme comes with 2 custom page templates.</p> 
						<p>To use the custom page templates, just create a NEW PAGE and select the appropriate template from the template dropdown list in the page attributes.   </p>
						<b>Blog template</b>
						<p>The blog page template can be used to display the blog section of your site.</p>
						
  						<b>Portfolio template</b>
						<p>Use this template to show all the portfolio items you have on the site.</p>	
						
						</div>
				</div> <!-- postbox end -->								
		
		
		</div>
		</div>
		
		
		
		</div>';
}

 ?>