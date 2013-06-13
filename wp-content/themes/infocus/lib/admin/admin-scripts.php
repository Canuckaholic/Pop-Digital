<?php 
/**
 * Stylesheets/JavaScripts In WP-Admin
 */
function webtreats_admin_enqueue_scripts($hook) {
	global $page_handle;
	
	if ( ($hook == 'post.php') || ($hook == 'post-new.php') || ($hook == 'page.php') || ($hook == 'page-new.php') || ($_GET['page'] == $page_handle) ) {

	wp_enqueue_style( 'webtreats-tabs', WEBTREATS_ADMIN_CSS .'/jquery.ui.tabs.css', false, '1.0.0', 'screen' );
	wp_enqueue_style( 'webtreats-admin', WEBTREATS_ADMIN_CSS .'/admin.css', false, '1.0.0', 'screen' );
	wp_register_script('tablednd', WEBTREATS_ADMIN_JS .'/jquery.tablednd.js', array('jquery'), '0.5');
	wp_register_script('webtreats-admin', WEBTREATS_ADMIN_JS .'/admin.js', array('jquery'), '1.0.0');
	wp_enqueue_script('webtreats-wpms', WEBTREATS_ADMIN_JS .'/wp-menu-order.js', array('jquery'), '1.0.0');
	wp_enqueue_script('jquery-json', WEBTREATS_ADMIN_JS . '/jquery.json-2.2.min.js', array('jquery'), '2.2');
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-sortable' ); 
	wp_enqueue_script( 'jquery-ui-droppable' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	}
}

function webtreats_admin_print_scripts($hook) {
	global $page_handle;
	$nonce = wp_create_nonce( 'sidebar_rm' );
		
	echo '<script type="text/javascript">
	//<![CDATA[
	var $rmSidebarAjaxUrl = "' .admin_url('admin-ajax.php'). '";
	var $ajaxNonce = "' .$nonce. '";
	//]]></script>';
	
	wp_print_scripts( 'tablednd' );
	wp_print_scripts( 'webtreats-admin' );
}

function webtreats_admin_scripts_hook() {
	global $page_handle;

	$svr_uri = $_SERVER['REQUEST_URI'];
	if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php') || strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php') || strstr($svr_uri, $page_handle) ) { 
		return true; 
	}			
}

add_action('admin_enqueue_scripts', 'webtreats_admin_enqueue_scripts');
if(webtreats_admin_scripts_hook()) {
add_action('admin_print_scripts', 'webtreats_admin_print_scripts');
}

?>