<?php

//////////////////
//  From Thematic:
//////////////////

// Unleash the power of Thematic's dynamic classes
// 
define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
define('THEMATIC_COMPATIBLE_FEEDLINKS', true);



/////////////////////////////////
//  Custom Child Theme Functions:
/////////////////////////////////

// Stylesheets. Use instead of @import commands in a master CSS file
function childtheme_create_stylesheet() {
	$templatedir = get_bloginfo('template_directory');
	$stylesheetdir = get_bloginfo('stylesheet_directory');
	?>
    
	<link rel="stylesheet" type="text/css" href="<?php echo $templatedir ?>/library/styles/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $templatedir ?>/library/styles/typography.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $templatedir ?>/library/styles/images.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $templatedir ?>/library/layouts/2c-r-fixed.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheetdir ?>/styles/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $templatedir ?>/library/styles/plugins.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheetdir ?>/style.css" />
	
	<?php
}
add_filter('thematic_create_stylesheet', 'childtheme_create_stylesheet');

function home_excerpt_length($length) {
	return 15;
}

function home_excerpt_more($more) {
	global $post;
	return ' <a href="'. get_permalink($post->ID) . '">[more...]</a>';
}


// HEADER //
function cufonToHeader() {
	echo "<script src='";
	
	echo get_stylesheet_directory_uri();
	
	echo "/js/cufon-yui.js' type='text/javascript'></script>
	<script src='";
	
	echo get_stylesheet_directory_uri();
	
	echo "/js/Alba_Super_400.font.js' type='text/javascript'></script>
    <script type='text/javascript'>
        Cufon.replace('.popText');
    </script>";
}
add_action('wp_head','cufonToHeader');

function googleAnalytics() {
	echo "<script type='text/javascript'>
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17960201-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>";
}
add_action('wp_head','googleAnalytics');



// FOOTER //
function custom_footer() {
	echo "<div id='footerContainer'>
            <div id='footerNav'>";
			
   //echo wp_nav_menu(thematic_nav_menu_args());
   echo wp_nav_menu( array('menu' => 'Footer'));
	
	echo "</div>
            <div id='footerQuotes'>";
			
	quotescollection_quote('ajax_refresh=0');
	
	echo "</div>
            <div id='footerLogo'>
                <a href='http://popdigital.ca' title='Pop Digital homepage'><img src='";
				
	echo get_stylesheet_directory_uri();
	
	echo "/images/layout/pop_digital_icon.png' alt='Pop Digital' /></a>
            </div>";
			
	/*echo "<div id='footerSocialLinks'>
                <a href='http://ca.linkedin.com/in/adrianderekjones' title='Adrian Jones on LinkedIn' target='_blank'><img src='";
				
	echo get_stylesheet_directory_uri();
	
	echo "/images/linkedin_icon.png' alt='LinkedIn' /></a>
            </div>*/
	
	echo "<div id='copyright'>copyright &copy; Pop Digital 2011</div>
		</div><!-- #footerContainer -->";
}
add_action('thematic_footer','custom_footer');

function footerScripts() {
	echo "<script type='text/javascript'> Cufon.now(); </script>
	<script type='text/javascript'>
        jQuery('.workBox img').hover(function () { jQuery(this).fadeTo('fast', 0.4); }, function () { jQuery(this).fadeTo('fast', 1); });
		jQuery('.website img').hover(function () { jQuery(this).fadeTo('fast', 0.4); }, function () { jQuery(this).fadeTo('fast', 1); });
    </script>";
}
add_action('thematic_after','footerScripts');

?>