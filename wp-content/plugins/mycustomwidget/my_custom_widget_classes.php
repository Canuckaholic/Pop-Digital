<?php
/*
Author: Janek Niefeldt
Author URI: http://www.janek-niefeldt.de/
Description: Configuration of My Custom Widgets Plugin.
*/
include_once('my_custom_widget_functions.php');
include_once('my_custom_widget_meta.php');
?><?php
class MCW_about_widget extends WP_Widget
{
	function MCW_about_widget(){
		$widget_ops = array('classname' => 'MCW_about_widget', 'description' => 'CustomWidget generated with MCW &raquo;' );
		$control_ops = array('width' => 345);
		$this->WP_Widget('MCW_about_widget', 'MCW: about_widget', $widget_ops, $control_ops);
	}
	function widget($args, $instance){
		$args['name'] = 'about_widget';
		MCW_eval_code($args);
	}
	function update($new_instance, $old_instance){
	  $new_instance['title'] = MCW_get_widget_info('about_widget', 'title');
		return $new_instance;
	}
	function form($instance){
    MCW_get_official_form('about_widget');	  
  }
}
	function MCW_about_widgetInit() {
	  register_widget('MCW_about_widget');
	}
	add_action('widgets_init', 'MCW_about_widgetInit');
?><?php
class MCW_contact_widget extends WP_Widget
{
	function MCW_contact_widget(){
		$widget_ops = array('classname' => 'MCW_contact_widget', 'description' => 'CustomWidget generated with MCW &raquo;' );
		$control_ops = array('width' => 345);
		$this->WP_Widget('MCW_contact_widget', 'MCW: contact_widget', $widget_ops, $control_ops);
	}
	function widget($args, $instance){
		$args['name'] = 'contact_widget';
		MCW_eval_code($args);
	}
	function update($new_instance, $old_instance){
	  $new_instance['title'] = MCW_get_widget_info('contact_widget', 'title');
		return $new_instance;
	}
	function form($instance){
    MCW_get_official_form('contact_widget');	  
  }
}
	function MCW_contact_widgetInit() {
	  register_widget('MCW_contact_widget');
	}
	add_action('widgets_init', 'MCW_contact_widgetInit');
?><?php
class MCW_services_list extends WP_Widget
{
	function MCW_services_list(){
		$widget_ops = array('classname' => 'MCW_services_list', 'description' => 'CustomWidget generated with MCW &raquo;' );
		$control_ops = array('width' => 345);
		$this->WP_Widget('MCW_services_list', 'MCW: services_list', $widget_ops, $control_ops);
	}
	function widget($args, $instance){
		$args['name'] = 'services_list';
		MCW_eval_code($args);
	}
	function update($new_instance, $old_instance){
	  $new_instance['title'] = MCW_get_widget_info('services_list', 'title');
		return $new_instance;
	}
	function form($instance){
    MCW_get_official_form('services_list');	  
  }
}
	function MCW_services_listInit() {
	  register_widget('MCW_services_list');
	}
	add_action('widgets_init', 'MCW_services_listInit');
?><?php
class MCW_work_widget extends WP_Widget
{
	function MCW_work_widget(){
		$widget_ops = array('classname' => 'MCW_work_widget', 'description' => 'CustomWidget generated with MCW &raquo;' );
		$control_ops = array('width' => 345);
		$this->WP_Widget('MCW_work_widget', 'MCW: work_widget', $widget_ops, $control_ops);
	}
	function widget($args, $instance){
		$args['name'] = 'work_widget';
		MCW_eval_code($args);
	}
	function update($new_instance, $old_instance){
	  $new_instance['title'] = MCW_get_widget_info('work_widget', 'title');
		return $new_instance;
	}
	function form($instance){
    MCW_get_official_form('work_widget');	  
  }
}
	function MCW_work_widgetInit() {
	  register_widget('MCW_work_widget');
	}
	add_action('widgets_init', 'MCW_work_widgetInit');
?>