<?php
get_header();

$portfolio_post = get_post_meta($post->ID, 'portfolio_full_img', true);
$portfolio_layout = get_post_meta($post->ID, 'portfolio_post_layout', true);

if($portfolio_post && !$portfolio_layout){
	require(WEBTREATS_INCLUDES . "/template-portfolio-single.php");
}else{
	require(WEBTREATS_INCLUDES . "/template-single.php");
}

?>