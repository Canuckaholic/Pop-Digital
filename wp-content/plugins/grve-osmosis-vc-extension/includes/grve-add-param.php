<?php

/*
 *	Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */



 /**
 * Generic Parameters to reuse
 * Used in vc shortcodes
 */
$grve_vce_add_animation = array(
	"type" => "dropdown",
	"heading" => __("CSS Animation", "grve-osmosis-vc-extension"),
	"param_name" => "animation",
	"admin_label" => true,
	"value" => array(
		__( "No", "grve-osmosis-vc-extension" ) => '',
		__( "Fade In", "grve-osmosis-vc-extension" ) => "fadeIn",
		__( "Fade In Up", "grve-osmosis-vc-extension" ) => "fadeInUp",
		__( "Fade In Down", "grve-osmosis-vc-extension" ) => "fadeInDown",
		__( "Fade In Left", "grve-osmosis-vc-extension" ) => "fadeInLeft",
		__( "Fade In Right", "grve-osmosis-vc-extension" ) => "fadeInRight",
	),
	"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_animation_delay = array(
	"type" => "textfield",
	"heading" => __('Css Animation Delay', 'grve-osmosis-vc-extension'),
	"param_name" => "animation_delay",
	"value" => '200',
	"description" => __( "Add delay in milliseconds.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_margin_bottom = array(
	"type" => "textfield",
	"heading" => __('Bottom margin', 'grve-osmosis-vc-extension'),
	"param_name" => "margin_bottom",
	"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_el_class = array(
	"type" => "textfield",
	"heading" => __( "Extra class name", "grve-osmosis-vc-extension" ),
	"param_name" => "el_class",
	"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_align = array(
	"type" => "dropdown",
	"heading" => __( "Alignment", "grve-osmosis-vc-extension" ),
	"param_name" => "align",
	"value" => array(
		__( "Left", "grve-osmosis-vc-extension" ) => 'left',
		__( "Right", "grve-osmosis-vc-extension" ) => 'right',
		__( "Center", "grve-osmosis-vc-extension" ) => 'center',
	),
	"description" => '',
	"admin_label" => true,
);

$grve_vce_add_button_type = array(
	"type" => "dropdown",
	"heading" => __( "Button type", "grve-osmosis-vc-extension" ),
	"param_name" => "button_type",
	"value" => array(
		__( "Simple", "grve-osmosis-vc-extension" ) => 'simple',
		__( "Outline", "grve-osmosis-vc-extension" ) => 'outline',
	),
	"description" => __( "Select button type.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_color = array(
	"type" => "dropdown",
	"heading" => __( "Button Color", "grve-osmosis-vc-extension" ),
	"param_name" => "button_color",
	"value" => array(
		__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
		__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
		__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
		__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
		__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
		__( "Green", "grve-osmosis-vc-extension" ) => 'green',
		__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
		__( "Red", "grve-osmosis-vc-extension" ) => 'red',
		__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
		__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
		__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
		__( "Black", "grve-osmosis-vc-extension" ) => 'black',
		__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
		__( "White", "grve-osmosis-vc-extension" ) => 'white',
	),
	"description" => __( "Color of the button.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_text = array(
	"type" => "textfield",
	"heading" => __( "Button Text", "grve-osmosis-vc-extension" ),
	"param_name" => "button_text",
	"admin_label" => true,
	"value" => "Button",
	"description" => __( "Text of the button.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_text_empty = array(
	"type" => "textfield",
	"heading" => __( "Button Text", "grve-osmosis-vc-extension" ),
	"param_name" => "button_text",
	"admin_label" => true,
	"value" => "",
	"description" => __( "Text of the button.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_size = array(
	"type" => "dropdown",
	"heading" => __( "Button Size", "grve-osmosis-vc-extension" ),
	"param_name" => "button_size",
	"value" => array(
		__( "Extra Small", "grve-osmosis-vc-extension" ) => 'extrasmall',
		__( "Small", "grve-osmosis-vc-extension" ) => 'small',
		__( "Medium", "grve-osmosis-vc-extension" ) => 'medium',
		__( "Large", "grve-osmosis-vc-extension" ) => 'large',
		__( "Extra Large", "grve-osmosis-vc-extension" ) => 'extralarge',
	),
	"description" => '',
	"std" => 'medium',
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_shape = array(
	"type" => "dropdown",
	"heading" => __( "Button Shape", "grve-osmosis-vc-extension" ),
	"param_name" => "button_shape",
	"value" => array(
		__( "Square", "grve-osmosis-vc-extension" ) => 'square',
		__( "Round", "grve-osmosis-vc-extension" ) => 'round',
		__( "Extra Round", "grve-osmosis-vc-extension" ) => 'extra-round',
	),
	"description" => '',
	"std" => 'square',
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_link = array(
	"type" => "vc_link",
	"heading" => __( "Button Link", "grve-osmosis-vc-extension" ),
	"param_name" => "button_link",
	"value" => "",
	"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_button_class = array(
	"type" => "textfield",
	"heading" => __( "Button class name", "grve-osmosis-vc-extension" ),
	"param_name" => "button_class",
	"description" => __( "If you wish to style your button differently, then use this field to add a class name and then refer to it in your css file.", "grve-osmosis-vc-extension" ),
	"group" => __( "Button", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_order_by = array(
	"type" => "dropdown",
	"heading" => __( "Order By", "grve-osmosis-vc-extension" ),
	"param_name" => "order_by",
	"value" => array(
		__( "Date", "grve-osmosis-vc-extension" ) => 'date',
		__( "Last modified date", "grve-osmosis-vc-extension" ) => 'modified',
		__( "Number of comments", "grve-osmosis-vc-extension" ) => 'comment_count',
		__( "Title", "grve-osmosis-vc-extension" ) => 'title',
		__( "Author", "grve-osmosis-vc-extension" ) => 'author',
		__( "Random", "grve-osmosis-vc-extension" ) => 'rand',
	),
	"description" => '',
	"admin_label" => true,
);

$grve_vce_add_order = array(
	"type" => "dropdown",
	"heading" => __( "Order", "grve-osmosis-vc-extension" ),
	"param_name" => "order",
	"value" => array(
		__( "Descending", "grve-osmosis-vc-extension" ) => 'DESC',
		__( "Ascending", "grve-osmosis-vc-extension" ) => 'ASC'
	),
	"dependency" => Array( 'element' => "order_by", 'value' => array( 'date', 'modified', 'comment_count', 'name', 'author', 'title' ) ),
	"description" => '',
	"admin_label" => true,
);

$grve_vce_add_slideshow_speed = array(
	"type" => "textfield",
	"heading" => __( "Slideshow Speed", "grve-osmosis-vc-extension" ),
	"param_name" => "slideshow_speed",
	"value" => '3000',
	"description" => __( "Slideshow Speed in ms.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_navigation_type = array(
	"type" => "dropdown",
	"heading" => __( "Navigation Type", "grve-osmosis-vc-extension" ),
	"param_name" => "navigation_type",
	'value' => array(
		__( 'Style 1' , 'grve-osmosis-vc-extension' ) => '1',
		__( 'Style 2' , 'grve-osmosis-vc-extension' ) => '2',
		__( 'Style 3' , 'grve-osmosis-vc-extension' ) => '3',
		__( 'Style 4' , 'grve-osmosis-vc-extension' ) => '4',
		__( 'No Navigation' , 'grve-osmosis-vc-extension' ) => '0',
	),
	"description" => __( "Select your Navigation type.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_navigation_color = array(
	"type" => "dropdown",
	"heading" => __( "Navigation Color", "grve-osmosis-vc-extension" ),
	"param_name" => "navigation_color",
	'value' => array(
		__( 'Light' , 'grve-osmosis-vc-extension' ) => 'light',
		__( 'Dark' , 'grve-osmosis-vc-extension' ) => 'dark',
	),
	"description" => __( "Select the background Navigation color.", "grve-osmosis-vc-extension" ),
);

$grve_vce_add_auto_height = array(
	"type" => 'checkbox',
	"heading" => __( "Auto Height", "grve-osmosis-vc-extension" ),
	"param_name" => "auto_height",
	"value" => Array( __( "Select if you want smooth auto height", "grve-osmosis-vc-extension" ) => 'yes' ),
);

?>