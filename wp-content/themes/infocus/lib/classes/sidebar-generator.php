<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish.
Version: 1.0.1
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Clickcom, Inc.
*/

/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class sidebar_generator_webtreats {
	
	function sidebar_generator_webtreats() {
		add_action('init',array('sidebar_generator_webtreats','init'));		
	}
	
	function init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator_webtreats::get_sidebars();
	    

	    if(is_array($sidebars)){
			$z=1;
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator_webtreats::name_to_class($sidebar);
				register_sidebar(array(
			    	'name'=>$sidebar,
					'id'=> "webtreats_sidebar-$z",
			    	'before_widget' => '<div id="%1$s" class="widget scg_widget '.$sidebar_class.' %2$s">',
		   			'after_widget' => '</div>',
		   			'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>',
		    	));	 $z++;
			}
		}
	}
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	function get_sidebar($index){
		//if(!is_singular()){
		//	dynamic_sidebar();
		//	return true;//dont do anything
		//}
		wp_reset_query();
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'selected_sidebar', true);
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "\n\n<!-- begin generated sidebar [$selected_sidebar] -->\n";
			//echo "<!-- selected: $selected_sidebar -->";
			dynamic_sidebar($selected_sidebar);
			echo "\n<!-- end generated sidebar -->\n\n";			
		}else{
			//dynamic_sidebar($index);
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($index) ) :
			
				echo '<div id="search" class="widget widget_search">';
				get_search_form();
				echo '</div>';
				
				$args = array('title' => '', 'before_widget' => '<div id="custom-recent-widget" class="widget widget_recent_entries">','after_widget' => '</div>','before_title' => '<h3 class="widgettitle">','after_title' => '</h3>');
				WP_Widget_Recent_Posts::widget($args, $instance);
				
			endif;
		}
	}
	
	/**
	 * gets the generated sidebars
	 */
	function get_sidebars(){
		global $shortname;
		$sidebars = get_option( $shortname. '_sidebar_generator');
		return $sidebars;
	}
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
}
$sbg = new sidebar_generator_webtreats;

function generated_dynamic_sidebar_webtreats($index){
	sidebar_generator_webtreats::get_sidebar($index);	
	return true;
}
?>