<?php
/*
*	Greatives Visual Composer Shortcode helper functions
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

function grve_build_margin_bottom_style( $margin_bottom ) {
	$style = '';
	if( $margin_bottom != '' ) {
		$style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
	}
	return $style;
}

function grve_build_shortcode_img_style( $bg_image = '' , $bg_image_type = '' ) {

	$has_image = false;
	$style = '';

	if((int)$bg_image > 0 && ($attachment_src = wp_get_attachment_image_src( $bg_image, 'grve-image-fullscreen' )) !== false) {

		$image_url = $attachment_src[0];

		$has_image = true;
		$style .= "background-image: url(".$image_url.");";
		return ' style="'.$style.'"';
	}

}

function grve_vc_get_css_color( $prefix, $color ) {
	$rgb_color = preg_match( '/rgba/', $color ) ? preg_replace( array( '/\s+/', '/^rgba\((\d+)\,(\d+)\,(\d+)\,([\d\.]+)\)$/' ), array( '', 'rgb($1,$2,$3)' ), $color ) : $color;
	$string = $prefix . ':' . $rgb_color . ';';
	if ( $rgb_color !== $color ) $string .= $prefix . ':' . $color . ';';
	return $string;
}

function grve_vc_shortcode_custom_css_class( $param_value, $prefix = '' ) {
	$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
	return $css_class;
}

function grve_build_shortcode_style( $bg_color = '', $font_color = '', $padding_top = '', $padding_bottom = '', $margin_bottom = '') {

	$style = '';

	if(!empty($bg_color)) {
		$style .= grve_vc_get_css_color( 'background-color', $bg_color );
	}

	if( !empty($font_color) ) {
		$style .= grve_vc_get_css_color( 'color', $font_color );
	}
	if( $padding_top != '' ) {
		$style .= 'padding-top: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_top) ? $padding_top : $padding_top.'px').';';
	}
	if( $padding_bottom != '' ) {
		$style .= 'padding-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_bottom) ? $padding_bottom : $padding_bottom.'px').';';
	}
	if( $margin_bottom != '' ) {
		$style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
	}
	return empty($style) ? $style : ' style="'.$style.'"';
}



?>