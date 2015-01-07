<?php
/**
 * Pricing Table Shortcode
 */

if( !function_exists( 'grve_pricing_table_shortcode' ) ) {

	function grve_pricing_table_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'price' => '',
					'interval' => '',
					'feature' => '',
					'values' => '',
					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'bg_color' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$button = grve_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class );

		//Pricing Table Classes
		$pricing_classes = array( 'grve-element', 'grve-pricing-table' );
		if( 'yes' == $feature ) {
			array_push( $pricing_classes, 'grve-pricing-feature' );
		}
		if ( !empty( $animation ) ) {
			array_push( $pricing_classes, 'grve-animated-item' );
			array_push( $pricing_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $pricing_classes, $el_class);
		}
		$pricing_class_string = implode( ' ', $pricing_classes );

		//Pricing Lines
		$pricing_lines = explode(",", $values);

		$pricing_lines_data = array();
		foreach ($pricing_lines as $line) {
			$new_line = array();
			$data_line = explode("|", $line);
			$new_line['value1'] = isset( $data_line[0] ) && !empty( $data_line[0] ) ? $data_line[0] : '';
			$new_line['value2'] = isset( $data_line[1] ) && !empty( $data_line[1] ) ? $data_line[1] : '';
			$pricing_lines_data[] = $new_line;
		}

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . $pricing_class_string . '" style="' . $style . '"' . $data . '>';
		$output .= '  <div class="grve-pricing-header">';
		$output .= '    <h6 class="grve-pricing-title">' . $title . '</h6>';
		$output .= '    <h4 class="grve-price">' . $price . ' <span>' . $interval . '</span></h4>';
	    $output .= '  </div>';
	    $output .= '  <ul>';
		foreach($pricing_lines_data as $line) {
			$output .= '<li><strong>' .  $line['value1'] . ' </strong>' .  $line['value2'] . '</li>';
		}
		$output .= '  </ul>';
		$output .= $button;
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_pricing_table', 'grve_pricing_table_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Pricing Table", "grve-osmosis-vc-extension" ),
	"description" => __( "Stylish pricing tables", "grve-osmosis-vc-extension" ),
	"base" => "grve_pricing_table",
	"class" => "",
	"icon"      => "icon-wpb-grve-pricing-table",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Title", "grve-osmosis-vc-extension" ),
			"param_name" => "title",
			"value" => "Title",
			"description" => __( "Enter your title here.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Price", "grve-osmosis-vc-extension" ),
			"param_name" => "price",
			"value" => "$0",
			"description" => __( "Enter your price here. eg $80.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "textfield",
			"heading" => __( "Interval", "grve-osmosis-vc-extension" ),
			"param_name" => "interval",
			"value" => "/month",
			"description" => __( "Enter interval period here. e.g: /month, per month, per year.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "exploded_textarea",
			"heading" => __("Attributes", "grve-osmosis-vc-extension"),
			"param_name" => "values",
			"description" => __( "Input attribute values. Divide values with linebreaks (Enter). Example: 100|Users.", "grve-osmosis-vc-extension" ),
			"value" => "100|Users,8 Gig|Disc Space,Unlimited|Data Transfer",
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Featured", "grve-osmosis-vc-extension" ),
			"param_name" => "feature",
			"description" => __( "If selected, element will be shown as feature.", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show as featured", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		$grve_vce_add_button_text,
		$grve_vce_add_button_link,
		$grve_vce_add_button_type,
		$grve_vce_add_button_color,
		$grve_vce_add_button_size,
		$grve_vce_add_button_shape,
		$grve_vce_add_button_class,
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>