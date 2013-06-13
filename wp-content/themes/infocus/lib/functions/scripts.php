<?php 
/**
 * Stylesheets/JavaScripts In Header
 */
function webtreats_enqueue_scripts() {
	if(!is_admin()){
		wp_enqueue_script( 'custom-js', WEBTREATS_JS .'/custom.js', array('jquery'));
		wp_enqueue_script('jquery.easing' , WEBTREATS_JS . '/jquery.easing.js', array('jquery'), '1.3');
		wp_enqueue_script( 'cufon-yui', WEBTREATS_JS .'/cufon-yui.js', array('jquery'));
		wp_enqueue_script( 'colaborate', WEBTREATS_JS .'/ColaborateLight_400.font.js', array('jquery'));
		wp_enqueue_script( 'prettyPhoto', WEBTREATS_JS .'/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'));
	}
}

add_action('wp_print_scripts', 'webtreats_enqueue_scripts');
add_action('wp_print_styles', 'webtreats_enqueue_scripts');

?>