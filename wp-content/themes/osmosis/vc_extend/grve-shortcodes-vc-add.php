<?php
/*
 *	Greatives Visual Composer Shortcode Extentions
 *
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


if ( function_exists( 'vc_add_param' ) ) {

	//Generic css aniation for elements

	$grve_add_animation = array(
		"type" => "dropdown",
		"heading" => __("CSS Animation", GRVE_THEME_TRANSLATE ),
		"param_name" => "animation",
		"admin_label" => true,
		"value" => array(
			__( "No", GRVE_THEME_TRANSLATE ) => '',
			__( "Fade In", GRVE_THEME_TRANSLATE ) => "fadeIn",
			__( "Fade In Up", GRVE_THEME_TRANSLATE ) => "fadeInUp",
			__( "Fade In Down", GRVE_THEME_TRANSLATE ) => "fadeInDown",
			__( "Fade In Left", GRVE_THEME_TRANSLATE ) => "fadeInLeft",
			__( "Fade In Right", GRVE_THEME_TRANSLATE ) => "fadeInRight",
		),
		"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", GRVE_THEME_TRANSLATE ),
	);

	$grve_add_animation_delay = array(
		"type" => "textfield",
		"heading" => __( 'Css Animation Delay', GRVE_THEME_TRANSLATE ),
		"param_name" => "animation_delay",
		"value" => '200',
		"description" => __( "Add delay in milliseconds.", GRVE_THEME_TRANSLATE ),
	);

	$grve_add_margin_bottom = array(
		"type" => "textfield",
		"heading" => __( 'Bottom margin', GRVE_THEME_TRANSLATE ),
		"param_name" => "margin_bottom",
		"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", GRVE_THEME_TRANSLATE ),
	);

	$grve_add_el_class = array(
		"type" => "textfield",
		"heading" => __("Extra class name", GRVE_THEME_TRANSLATE ),
		"param_name" => "el_class",
		"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", GRVE_THEME_TRANSLATE ),
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __('Section ID', GRVE_THEME_TRANSLATE ),
			"param_name" => "section_id",
			"description" => __("If you wish you can type an id to use it as bookmark.", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => __('Font Color', GRVE_THEME_TRANSLATE ),
			"param_name" => "font_color",
			"description" => __("Select font color", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Heading Color", GRVE_THEME_TRANSLATE ),
			"param_name" => "heading_color",
			"value" => array(
				__( "Default", GRVE_THEME_TRANSLATE ) => '',
				__( "Dark", GRVE_THEME_TRANSLATE ) => 'dark',
				__( "Light", GRVE_THEME_TRANSLATE ) => 'light',
				__( "Primary 1", GRVE_THEME_TRANSLATE ) => 'primary-1',
				__( "Primary 2", GRVE_THEME_TRANSLATE ) => 'primary-2',
				__( "Primary 3", GRVE_THEME_TRANSLATE ) => 'primary-3',
				__( "Primary 4", GRVE_THEME_TRANSLATE ) => 'primary-4',
				__( "Primary 5", GRVE_THEME_TRANSLATE ) => 'primary-5',
			),
			"description" => __( "Select heading color", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row", $grve_add_el_class );


	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Section Type", GRVE_THEME_TRANSLATE ),
			"param_name" => "section_type",
			"value" => array(
				__( "Full Width Background", GRVE_THEME_TRANSLATE ) => 'fullwidth-background',
				__( "In Container", GRVE_THEME_TRANSLATE ) => 'in-container',
				__( "Full Width Element", GRVE_THEME_TRANSLATE ) => 'fullwidth-element',
			),
			"description" => __( "Select section type", GRVE_THEME_TRANSLATE ),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Section Window Height", GRVE_THEME_TRANSLATE ),
			"param_name" => "section_full_height",
			"value" => array(
				__( "No", GRVE_THEME_TRANSLATE ) => 'no',
				__( "Yes", GRVE_THEME_TRANSLATE ) => 'yes',
			),
			"description" => __( "Select if you want your section height to be equal with the window height", GRVE_THEME_TRANSLATE ),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => __( "Background Type", GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_type",
			"description" => __( "Select Background type", GRVE_THEME_TRANSLATE ),
			"value" => array(
				__("None", GRVE_THEME_TRANSLATE ) => '',
				__("Color", GRVE_THEME_TRANSLATE ) => 'color',
				__("Image", GRVE_THEME_TRANSLATE ) => 'image',
				__("Hosted Video", GRVE_THEME_TRANSLATE ) => 'hosted_video',
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => __( "Custom Background Color", GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_color",
			"description" => __( "Select backgound color for your row", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'color' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "attach_image",
			"heading" => __('Background Image', GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_image",
			"description" => __("Select background image for your row. Used also as fallback for video.", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Background Image Type", GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_image_type",
			"value" => array(
				__("Default", GRVE_THEME_TRANSLATE ) => '',
				__("Fixed", GRVE_THEME_TRANSLATE ) => 'fixed-bg',
				__("Parallax", GRVE_THEME_TRANSLATE ) => 'parallax',
				__("Animated", GRVE_THEME_TRANSLATE ) => 'animated'
			),
			"description" => __( "Select how a background image will be displayed", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __("WebM File URL", GRVE_THEME_TRANSLATE),
			"param_name" => "bg_video_webm",
			"description" => __( "Fill WebM and mp4 format for browser compatibility", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __( "MP4 File URL", GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_video_mp4",
			"description" => __( "Fill mp4 format URL", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __( "OGV File URL", GRVE_THEME_TRANSLATE ),
			"param_name" => "bg_video_ogv",
			"description" => __( "Fill OGV format URL ( optional )", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => __( "Pattern overlay", GRVE_THEME_TRANSLATE),
			"param_name" => "pattern_overlay",
			"description" => __( "If selected, a pattern will be added.", GRVE_THEME_TRANSLATE ),
			"value" => Array(__( "Add pattern", GRVE_THEME_TRANSLATE ) => 'yes'),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Color overlay", GRVE_THEME_TRANSLATE ),
			"param_name" => "color_overlay",
			"value" => array(
				__( "None", GRVE_THEME_TRANSLATE ) => '',
				__( "Dark", GRVE_THEME_TRANSLATE ) => 'dark',
				__( "Light", GRVE_THEME_TRANSLATE ) => 'light',
				__( "Primary 1", GRVE_THEME_TRANSLATE ) => 'primary-1',
				__( "Primary 2", GRVE_THEME_TRANSLATE ) => 'primary-2',
				__( "Primary 3", GRVE_THEME_TRANSLATE ) => 'primary-3',
				__( "Primary 4", GRVE_THEME_TRANSLATE ) => 'primary-4',
				__( "Primary 5", GRVE_THEME_TRANSLATE ) => 'primary-5',
			),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"description" => __( "A color overlay for the media", GRVE_THEME_TRANSLATE ),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Opacity overlay", GRVE_THEME_TRANSLATE ),
			"param_name" => "opacity_overlay",
			"value" => array( 10, 20, 30 ,40, 50, 60, 70, 80 ,90 ),
			"description" => __( "Opacity of the overlay", GRVE_THEME_TRANSLATE ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __( "Top padding", GRVE_THEME_TRANSLATE ),
			"param_name" => "padding_top",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", GRVE_THEME_TRANSLATE ),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => __( "Bottom padding", GRVE_THEME_TRANSLATE ),
			"param_name" => "padding_bottom",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", GRVE_THEME_TRANSLATE ),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
		"type" => "textfield",
		"heading" => __( 'Bottom margin', GRVE_THEME_TRANSLATE ),
		"param_name" => "margin_bottom",
		"description" => __( "You can use px, em, %, etc. or enter just number and it will use pixels.", GRVE_THEME_TRANSLATE ),
		"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => __( "Header Section", GRVE_THEME_TRANSLATE ),
			"param_name" => "header_feature",
			"description" => __( "Use this option if first section ( no gap from header )", GRVE_THEME_TRANSLATE ),
			"value" => Array(__( "Header section", GRVE_THEME_TRANSLATE ) => 'yes'),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => __( "Footer Section", GRVE_THEME_TRANSLATE ),
			"param_name" => "footer_feature",
			"description" => __( "Use this option if last section ( no gap from footer )", GRVE_THEME_TRANSLATE ),
			"value" => Array(__( "Footer section", GRVE_THEME_TRANSLATE ) => 'yes'),
			"group" => __( "Section Options", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => __( "Responsive Column", GRVE_THEME_TRANSLATE ),
			"param_name" => "tablet_width",
			"value" => array( '', '1-6', '1-4', '1-3' , '1-2', '2-3', '3-4', '4-6', '5-6' , '1' ),
			"description" => __( "Responsive column on tablets", GRVE_THEME_TRANSLATE ),
			'group' => __( 'Width & Responsiveness', 'js_composer' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => __( "Responsive Column", GRVE_THEME_TRANSLATE ),
			"param_name" => "tablet_width",
			"value" => array( '', '1-6', '1-4', '1-3' , '1-2', '2-3', '3-4', '4-6', '5-6' , '1' ),
			"description" => __( "Responsive column on tablets", GRVE_THEME_TRANSLATE ),
			'group' => __( 'Width & Responsiveness', 'js_composer' ),
		)
	);

	vc_add_param( "vc_tabs", $grve_add_margin_bottom );

	vc_add_param( "vc_accordion",
		array(
			"type" => 'checkbox',
			"heading" => __( "Toggle", GRVE_THEME_TRANSLATE),
			"param_name" => "toggle",
			"description" => __( "If selected, accordion will be displayed as toggle.", GRVE_THEME_TRANSLATE ),
			"value" => Array(__( "Convert to toggle.", GRVE_THEME_TRANSLATE ) => 'yes'),
		)
	);

	vc_add_param( "vc_accordion",
		array(
			"type" => "dropdown",
			"heading" => __( "Initial State", GRVE_THEME_TRANSLATE ),
			"param_name" => "initial_state",
			"admin_label" => true,
			"value" => array(
				__( "First Open", GRVE_THEME_TRANSLATE ) => 'first',
				__( "All Closed", GRVE_THEME_TRANSLATE ) => 'none',
			),
			"description" => __( "Accordion Initial State", GRVE_THEME_TRANSLATE ),
		)
	);

	vc_add_param( "vc_accordion", $grve_add_margin_bottom );
	vc_add_param( "vc_accordion", $grve_add_el_class );

	vc_add_param( "vc_column_text",
		array(
			"type" => "dropdown",
			"heading" => __( "Text Style", GRVE_THEME_TRANSLATE ),
			"param_name" => "text_style",
			"value" => array(
				__( "None", GRVE_THEME_TRANSLATE ) => '',
				__( "Leader", GRVE_THEME_TRANSLATE ) => 'leader-text',
				__( "Subtitle", GRVE_THEME_TRANSLATE ) => 'subtitle',
			),
			"description" => __( "Select your text style", GRVE_THEME_TRANSLATE ),
		)
	);
	vc_add_param( "vc_column_text", $grve_add_animation );
	vc_add_param( "vc_column_text", $grve_add_animation_delay );


}


?>