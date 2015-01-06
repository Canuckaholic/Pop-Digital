<?php

/*
*	Layout Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Function to fetch sidebar class
 */
function grve_sidebar_class() {

	if( is_search() ) {
		return '';
	}

	$grve_sidebar_class = "";
	$grve_sidebar_extra_content = false;

	if ( is_singular( 'post' ) ) {
		$grve_sidebar_id = grve_post_meta( 'grve_post_sidebar', grve_option( 'post_sidebar' ) );
		$grve_sidebar_layout = grve_post_meta( 'grve_post_layout', grve_option( 'post_layout', 'none' ) );
	} else if ( is_singular( 'page' ) ) {
		$grve_sidebar_id = grve_post_meta( 'grve_page_sidebar', grve_option( 'page_sidebar' ) );
		$grve_sidebar_layout = grve_post_meta( 'grve_page_layout', grve_option( 'page_layout', 'none' ) );
	} else if ( is_singular( 'portfolio' ) ) {
		$grve_sidebar_id = grve_post_meta( 'grve_portfolio_sidebar', grve_option( 'portfolio_sidebar' ) );
		$grve_sidebar_layout = grve_post_meta( 'grve_portfolio_layout', grve_option( 'portfolio_layout', 'none' ) );
		$grve_sidebar_extra_content = grve_check_portfolio_details();
		if( $grve_sidebar_extra_content && 'none' == $grve_sidebar_layout ) {
			$grve_sidebar_layout = 'right';
		}	
	}else {
		if ( grve_woocommerce_enabled() ) {
			if( is_product() ) {
				$grve_sidebar_id = grve_post_meta( 'grve_product_sidebar', 'grve-woocommerce-sidebar-product' );
				$grve_sidebar_layout = grve_post_meta( 'grve_product_layout', 'right' );
			} else if ( is_shop() || is_product_category() || is_product_tag() ) {
				$grve_sidebar_id = grve_post_meta_shop( 'grve_page_sidebar', 'grve-woocommerce-sidebar-shop' );
				$grve_sidebar_layout = grve_post_meta_shop( 'grve_page_layout', 'right' );
			} else {
				$grve_sidebar_id = grve_option( 'blog_sidebar' );
				$grve_sidebar_layout = grve_option( 'blog_layout', 'none' );
			}
		} else {
			$grve_sidebar_id = grve_option( 'blog_sidebar' );
			$grve_sidebar_layout = grve_option( 'blog_layout', 'none' );
		}
	}

	if ( 'none' != $grve_sidebar_layout && ( is_active_sidebar( $grve_sidebar_id ) || $grve_sidebar_extra_content ) ) {

		if ( 'right' == $grve_sidebar_layout ) {
			$grve_sidebar_class = 'grve-right-sidebar';
		} else if ( 'left' == $grve_sidebar_layout ) {
			$grve_sidebar_class = 'grve-left-sidebar';
		}
	}

	return $grve_sidebar_class;

}

?>