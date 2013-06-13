<?php
/**
 * Portfolio Page Short-code Functions
 */
function portfolio_page_redirect() {
	global $post;	
	$search = "@(?:<p>)*\s*\[portfolio\s*\s*cat\s*=\s*(\w+|^\+)\s*\s*style\s*=\s*(gallery|full)\s*\s*max\s*=\s*(\w+|^\+)\]\s*(?:</p>)*@i";
	if	(preg_match_all($search, $post->post_content, $matches)) {
		if (is_array($matches)) {
			$portfolio_cat = $matches[1][0]; 
			$portfolio_style = $matches[2][0];
			$portfolio_max = $matches[3][0];
				
			if($portfolio_style == 'gallery') {
				include(WEBTREATS_INCLUDES . '/template-portfolio-gallery.php');
				exit;
				
			}
			if($portfolio_style == 'full') {
				include(WEBTREATS_INCLUDES . '/template-portfolio-full.php');
				exit;
				
			}
		}	
	}
}

function portfolio_page_remove_shortcode($content) {
	global $wpdb;
	
	if ( stristr( $content, '[portfolio' )) {
		$search = "@(?:<p>)*\s*\[portfolio\s*\s*cat\s*=\s*(\w+|^\+)\s*\s*style\s*=\s*(gallery|full)\s*\s*max\s*=\s*(\w+|^\+)\]\s*(?:</p>)*@i";
		
		if	(preg_match_all($search, $content, $matches)) {
			
			if (is_array($matches)) {
				$search = $matches[0][0];
				$replace= '';
				$content = str_replace ($search, $replace, $content);

			}
			
		}
		
	}
	return $content;
}

add_action('template_redirect', 'portfolio_page_redirect');
add_filter('the_content', 'portfolio_page_remove_shortcode', 10);
?>