<?php

/*
 *	Excerpt functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Custom excerpt
 */
function grve_excerpt( $limit, $more = '0' ) {
	global $post;
	$post_id = $post->ID;

	if ( has_excerpt( $post_id ) ) {
		$excerpt = apply_filters( 'the_content', $post->post_excerpt );
		if ( '1' == $more ) {
			$excerpt .= grve_read_more();
		}
	} else {
		$content = get_the_content('');
		$content = do_shortcode( $content );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		if ( '1' == $more ) {
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			$excerpt .= grve_read_more();
		} else{
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
		}
	}
	return	$excerpt;
}

 /**
 * Custom more
 */
function grve_read_more() {
	global $post;
    return '<a class="grve-read-more" href="' . get_permalink( $post->ID ) . '"><span>' . __( 'read more', GRVE_THEME_TRANSLATE ) . '</span></a>';
}

 /**
 * Add filters for excerpt length
 */

function grve_new_excerpt_more( $more ) {
	return grve_read_more();
}
add_filter('excerpt_more', 'grve_new_excerpt_more');

?>