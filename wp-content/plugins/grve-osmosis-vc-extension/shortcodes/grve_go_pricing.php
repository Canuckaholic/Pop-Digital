<?php
/**
 * Go Pricing Shortcode
 */


/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Go Pricing", "grve-osmosis-vc-extension" ),
	"description" => __( "Go Pricing Table", "grve-osmosis-vc-extension" ),
	"base" => "go_pricing",
	"class" => "",
	"icon"      => "icon-wpb-grve-go-pricing",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Table ID", "grve-osmosis-vc-extension" ),
			"param_name" => "id",
			"admin_label" => true,
			"value" => grve_vce_get_go_pricing_list(),
			"description" => __( "Select Pricing Table.", "grve-osmosis-vc-extension" ),
		),
	),
) );
?>