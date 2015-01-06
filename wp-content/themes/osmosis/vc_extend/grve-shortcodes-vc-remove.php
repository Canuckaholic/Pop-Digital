<?php
/*
*	Greatives Visual Composer Remove Unsupported Elements
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( function_exists( 'vc_remove_element' ) ) {

	add_action( 'init', 'grve_remove_vc_shortcodes' );

	if ( !function_exists( 'grve_remove_vc_shortcodes' ) && function_exists( 'vc_remove_element' ) ) {

		function grve_remove_vc_shortcodes() {

			//Social
			vc_remove_element("vc_facebook");
			vc_remove_element("vc_flickr");
			vc_remove_element("vc_googleplus");
			vc_remove_element("vc_pinterest");
			vc_remove_element("vc_tweetmeme");

			//Other
			vc_remove_element("vc_toggle");
			vc_remove_element("vc_text_separator");
			vc_remove_element("vc_message");
			vc_remove_element("vc_pie");
			vc_remove_element("vc_progress_bar");
			vc_remove_element("vc_tour");
			vc_remove_element('vc_teaser_grid');
			vc_remove_element('vc_posts_grid');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_separator');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_button');
			vc_remove_element('vc_button2');
			vc_remove_element('vc_cta_button');
			vc_remove_element('vc_cta_button2');
			vc_remove_element('vc_carousel');
			vc_remove_element('vc_images_carousel');
			vc_remove_element('vc_single_image');
			vc_remove_element('vc_video');
			vc_remove_element('vc_gmaps');
			vc_remove_element('vc_custom_heading');
			vc_remove_element('vc_empty_space');
			
			


			//WordPress
			vc_remove_element('vc_wp_custommenu');
			vc_remove_element('vc_wp_tagcloud');
			vc_remove_element('vc_wp_archives');
			vc_remove_element('vc_wp_calendar');
			vc_remove_element('vc_wp_pages');
			vc_remove_element('vc_wp_links');
			vc_remove_element('vc_wp_posts');
			vc_remove_element('vc_wp_categories');
			vc_remove_element('vc_wp_rss');
			vc_remove_element('vc_wp_text');
			vc_remove_element('vc_wp_meta');
			vc_remove_element('vc_wp_recentcomments');
		}
	}
}

if ( function_exists( 'vc_remove_param' ) ) {

	vc_remove_param('vc_row', 'font_color');
	vc_remove_param('vc_row', 'bg_color');
	vc_remove_param('vc_row', 'bg_image');
	vc_remove_param('vc_row', 'bg_image_repeat');
	vc_remove_param('vc_row', 'padding');
	vc_remove_param('vc_row', 'margin_bottom');
	vc_remove_param('vc_row', 'el_class');	
	vc_remove_param('vc_row', 'css');
	
	//vc_remove_param('vc_row_inner', 'css');
	//vc_remove_param('vc_column', 'css');
	//vc_remove_param('vc_column_inner', 'css');
	//vc_remove_param('vc_column_text', 'css');
	vc_remove_param('vc_column', 'offset');
	vc_remove_param('vc_column_inner', 'offset');
	

	vc_remove_param('vc_tabs', 'interval');
	vc_remove_param('vc_tabs', 'title');

	vc_remove_param('vc_accordion', 'active_tab');
	vc_remove_param('vc_accordion', 'collapsible');
	vc_remove_param('vc_accordion', 'el_class');
	vc_remove_param('vc_accordion', 'title');

	vc_remove_param('vc_column_text', 'css_animation');

	vc_remove_param('vc_widget_sidebar', 'title');

}

if ( is_admin() ) {
	if ( ! function_exists('grve_remove_vc_boxes') ) {
		function grve_remove_vc_boxes(){
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box('vc_teaser',  $post_type, 'side');
			}
		}
	}
	add_action('do_meta_boxes', 'grve_remove_vc_boxes');
}


?>