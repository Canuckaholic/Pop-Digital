<?php
/**
 * Sociable Bookmarks for Post Page
 */
function webtreats_save_tweet_link($id) {
	$url = wp_remote_retrieve_body(wp_remote_get('http://bit.ly/api?url=' .get_permalink($id)));
	if (!$url) {
	  return sprintf('%s?p=%s', get_bloginfo('url'), $id);
	}
	
	add_post_meta($id, 'tweet_trim_url', $url);
	return $url;
}

function webtreats_the_tweet_link() {
	if (!$url = get_post_meta(get_the_ID(), 'tweet_trim_url', true)) {
	  $url = webtreats_save_tweet_link(get_the_ID());
	}

	$output_url = sprintf(
	  'http://twitter.com/home?status=%s%s%s',
	  urlencode(get_the_title()),
	  urlencode(' - '),
	  $url
	);
	$output_url = str_replace('+','%20',$output_url);
	return $output_url;
}

function webtreats_sociable_bookmarks() {
	global $wp_query, $post;
	
	$sociable_sites = array (

		array( "name" => "Twitter",
			'icon' => 'twitter.png',
			'class' => 'twitter_icon',
			'url' => webtreats_the_tweet_link(),
		),

	    array( "name" => "StumbleUpon",
		    'icon' => 'stumbleupon.png',
			'class' => 'stumbleupon_icon',
		    'url' => 'http://www.stumbleupon.com/submit?url=PERMALINK&amp;title=TITLE',
		),

		array( "name" => "Reddit",
			'icon' => 'reddit-logo.png',
			'class' => 'reddit_icon',
			'url' => 'http://reddit.com/submit?url=PERMALINK&amp;title=TITLE',
		),

		array( "name" => "Digg",
			'icon' => 'digg-logo.png',
			'class' => 'digg_icon',
			'url' => 'http://digg.com/submit?phase=2&amp;url=PERMALINK&amp;title=TITLE&amp;bodytext=EXCERPT',
		),

		array( "name" => "del.icio.us",
			'icon' => 'delicious.png',
			'class' => 'delicious_icon',
			'url' => 'http://delicious.com/post?url=PERMALINK&amp;title=TITLE&amp;notes=EXCERPT',
		),
		
		array( "name" => "Facebook",
			'icon' => 'facebook-logo-square.png',
			'class' => 'facebook_icon',
			'url' => 'http://www.facebook.com/share.php?u=PERMALINK&amp;t=TITLE',
		),
		
		array( "name" => "LinkedIn",
			'icon' => 'linkedin-square.png',
			'class' => 'linkedin_icon',
			'url' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url=PERMALINK&amp;title=TITLE&amp;source=BLOGNAME&amp;summary=EXCERPT',
		),

	);
	
	// Load the post's and blog's data
	$blogname = urlencode(get_bloginfo('name')." ".get_bloginfo('description'));
	$post = $wp_query->post;
	
	
	// Grab the excerpt, if there is no excerpt, create one
	$excerpt = urlencode(strip_tags(strip_shortcodes($post->post_excerpt)));
	if ($excerpt == "") {
		$excerpt = urlencode(substr(strip_tags(strip_shortcodes($post->post_content)),0,250));
	}
	
	// Clean the excerpt for use with links
	$excerpt = str_replace('+','%20',$excerpt);
	$excerpt = str_replace('%0D%0A','',$excerpt);
	$permalink 	= urlencode(get_permalink($post->ID));
	$title = str_replace('+','%20',urlencode($post->post_title));
	
	foreach($sociable_sites as $bookmark) {	
		$url = $bookmark['url'];
		$url = str_replace('TITLE', $title, $url);
		$url = str_replace('BLOGNAME', $blogname, $url);
		$url = str_replace('EXCERPT', $excerpt, $url);
		$url = str_replace('PERMALINK', $permalink, $url);
		
		$output .= '<div class="' .$bookmark['class']. '">';
		$output .= '<a title="' .$bookmark['name']. '" href="' .$url. '">';
		$output .= '</a>';
		$output .= '</div>';
	}

	return $output;
}

?>