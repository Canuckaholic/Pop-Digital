<?php
/**
 *  Add Dynamic css to header
 *  @version	1.0
 *  @author		Greatives Team
 *  @URI		http://greatives.eu
 */


add_action('wp_head', 'grve_load_dynamic_css');

if ( !function_exists( 'grve_load_dynamic_css' ) ) {

	function grve_load_dynamic_css() {
		include( 'grve-dynamic-typography-css.php' );
		include( 'grve-dynamic-css.php' );

		$custom_css_code = grve_option( 'css_code' );
		if ( !empty( $custom_css_code ) ) {
			$custom_css_trim =  preg_replace( '/\s+/', ' ', $custom_css_code );
			$custom_css_out = "<!-- Dynamic css -->\n<style type=\"text/css\">\n" . $custom_css_trim . "\n</style>";
			echo $custom_css_out;
		}
	}
}

?>
