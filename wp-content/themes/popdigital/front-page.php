<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>
	
	<div id="homepageTopContent">
    	<div id="textBox">
        	<h1>Welcome to Pop Digital</h1>
            <p>We are a digital creative agency that specializes in building websites that jump off the screen and grab the attention of your audience. Work with us to maximize your business' potential and build a powerful online presence to help meet your business objectives.</p>
            <p>Websites, graphic design, logo design, application development, Flash design, SEO, user-experience design, video production... if it's a new media term, chances are we do it!</p>
		</div>
    </div>
    
    <div class="contentDividerBar"></div>
    
    <div class="contentBox">
    
    	<div class="popText">STUFF WE'VE DONE</div>
        <hr />
	
		<?php if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); } ?>
    
    </div>
    
    <div class="contentDividerBar"></div>
    
    <div id="homepageBottomContent">
    	<div class="column">
        	<div class="popText">SERVICES</div>
            <hr />
            <ul>
            	<li>Web Design</li>
            	<li>Web Development</li>
            	<li>Application Development</li>
            	<li>Graphic Design</li>
            	<li>Logo Design</li>
            	<li>Re-branding</li>
                <li>User Experience (UX) Design</li>
            	<li>User Interface (UI) Design</li>
            	<li>Wireframing</li>
            	<li>Information Architecture (IA) for Websites</li>
            	<li>SEO</li>
                <li>Flash Development</li>
            	<li>Video Production</li>
            	<li>Audio Production</li>
            	<li>Social Media Consulting</li>
            	<li>Social Media Application Development</li>
            </ul>
            <div class="moreLink"><a href="http://popdigital.ca/services/">[more...]</a></div>
            
            <div style="clear: both;"></div>
	  	</div>
        <div class="column">
        	<div class="popText">WEBSITES</div>          	
            <hr />
            
            <div class="website"><a href="http://popdigital.ca/2011/02/06/vancouver-canucks-website/" title="canucks.com"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/websites/canucks_thumbnail.jpg" title="canucks.com" /></a>
          	<a href="http://popdigital.ca/2011/02/06/vancouver-canucks-website/" title="canucks.com">Vancouver Canucks</a></div>
            
            <div class="website"><a href="http://popdigital.ca/2009/04/24/rogers-arena-website/"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/websites/rogers_arena_thumbnail.jpg" title="rogersarena.ca" /></a>
            <a href="http://popdigital.ca/2009/04/24/rogers-arena-website/" title="rogersarena.ca">Rogers Arena</a></div>
            
            <div class="website"><a href="http://popdigital.ca/2011/02/25/allison-wondeland-website/"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/websites/allison_wonderland_thumbnail.jpg" title="allisonwonderland.ca" /></a>
            <a href="http://popdigital.ca/2011/02/25/allison-wondeland-website/" title="allisonwonderland.ca">Allison Wonderland</a></div>
            
            <div class="moreLink"><a href="http://popdigital.ca/work/">[more...]</a></div>
            
            <div style="clear: both;"></div>
        </div>
        <div class="column last">
        	<div class="popText">BLOG</div>
            <hr />
            <p>
            <?php
            query_posts('posts_per_page=5&cat=-32');
			add_filter('excerpt_length', 'home_excerpt_length');
			add_filter('excerpt_more', 'home_excerpt_more');
			if (have_posts()) :
              	while (have_posts()) :
                  	the_post();										
					echo "<h3>";
					the_title();
					echo "</h3>";					
                  	the_excerpt();
               	endwhile;
            endif;
			?>
            </p>
            
        </div>
        
        <div style="clear: both;"></div>
    </div>

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>