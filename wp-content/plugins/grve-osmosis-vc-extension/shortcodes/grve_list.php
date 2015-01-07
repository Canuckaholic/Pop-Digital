<?php
/**
 * List Shortcode
 */

if( !function_exists( 'grve_list_shortcode' ) ) {

	function grve_list_shortcode( $atts, $content ) {

		$el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'icon' => '',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );
		$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");
		return '<div class="grve-element grve-list grve-list-' . esc_attr( $icon ) . ' ' . esc_attr( $el_class ) . '" style="' . $style . '">' . $content . '</div>';
	}
	add_shortcode( 'grve_list', 'grve_list_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "List", "grve-osmosis-vc-extension" ),
	"description" => __( "Select among several different styles", "grve-osmosis-vc-extension" ),
	"base" => "grve_list",
	"class" => "",
	"icon"      => "icon-wpb-grve-list",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "grve_icon",
			"heading" => __( "Icon", "grve-osmosis-vc-extension" ),
			"param_name" => "icon",
			"param_subset" => "list",
			"value" => 'check',
			"description" => __( "Select an icon.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type"			=> "textarea_html",
			"heading"		=> __( "List", "grve-osmosis-vc-extension" ),
			"param_name"	=> "content",
			"value"			=> "<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>",
			"description"	=> __( "Insert your unordered list here.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>