<?php 
get_header();
require(WEBTREATS_INCLUDES . "/var.php");

$show_on_front = get_option('show_on_front');
$page_on_front = get_option('page_on_front');

if( ($show_on_front == 'page') && ($page_on_front == $blog_page) ) {
	require(WEBTREATS_INCLUDES . "/template-blog.php");
}else{
	require(WEBTREATS_INCLUDES . "/featured-" .$homepage_slider. ".php");
	
get_footer();
}

?>