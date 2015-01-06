<?php

/*
*	Main sidebar area
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


if( is_search() ) {
	return;
}

$fixed = "";
$grve_sidebar_bg_color = 'none';
$grve_sidebar_extra_content = false;

if ( is_singular() ) {
	if ( 'yes' == grve_post_meta( 'grve_fixed_sidebar' ) ) {
		$fixed = " grve-fixed-sidebar";
	}
}

if ( is_singular( 'post' ) ) {
	$grve_sidebar_id = grve_post_meta( 'grve_post_sidebar', grve_option( 'post_sidebar' ) );
	$grve_sidebar_layout = grve_post_meta( 'grve_post_layout', grve_option( 'post_layout', 'none' ) );
	$grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'post_sidebar_bg_color' ), 'none' );
} else if ( is_singular( 'page' ) ) {
		$grve_sidebar_id = grve_post_meta( 'grve_page_sidebar', grve_option( 'page_sidebar' ) );
		$grve_sidebar_layout = grve_post_meta( 'grve_page_layout', grve_option( 'page_layout', 'none' ) );
		$grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'page_sidebar_bg_color' ), 'none' );
} else if ( is_singular( 'portfolio' ) ) {
		$grve_sidebar_id = grve_post_meta( 'grve_portfolio_sidebar', grve_option( 'portfolio_sidebar' ) );
		$grve_sidebar_layout = grve_post_meta( 'grve_portfolio_layout', grve_option( 'portfolio_layout', 'none' ) );
		$grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'portfolio_sidebar_bg_color' ), 'none' );
		$grve_sidebar_extra_content = grve_check_portfolio_details();
		if( $grve_sidebar_extra_content && 'none' == $grve_sidebar_layout ) {
			$grve_sidebar_layout = 'right';
		}
}else {

	if ( grve_woocommerce_enabled() ) {
		if( is_product() ) {
			$grve_sidebar_id = grve_post_meta( 'grve_product_sidebar', 'grve-woocommerce-sidebar-product' );
			$grve_sidebar_layout = grve_post_meta( 'grve_product_layout', 'right' );
			$grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', 'none' );
		} else if ( is_shop() || is_product_category() || is_product_tag() ) {
			$grve_sidebar_id = grve_post_meta_shop( 'grve_page_sidebar', 'grve-woocommerce-sidebar-shop' );
			$grve_sidebar_layout = grve_post_meta_shop( 'grve_page_layout', 'right' );
			$grve_sidebar_bg_color = grve_post_meta_shop( 'grve_sidebar_bg_color', 'none' );
			if ( 'yes' == grve_post_meta_shop( 'grve_fixed_sidebar' ) ) {
				$fixed = " grve-fixed-sidebar";
			}
		} else {
			$grve_sidebar_id = grve_option( 'blog_sidebar' );
			$grve_sidebar_layout = grve_option( 'blog_layout', 'none' );
			$grve_sidebar_bg_color = grve_option( 'blog_sidebar_bg_color', 'none' );
		}
	} else {
		$grve_sidebar_id = grve_option( 'blog_sidebar' );
		$grve_sidebar_layout = grve_option( 'blog_layout', 'none' );
		$grve_sidebar_bg_color = grve_option( 'blog_sidebar_bg_color', 'none' );
	}
}

if ( 'none' != $grve_sidebar_layout && ( is_active_sidebar( $grve_sidebar_id ) || $grve_sidebar_extra_content ) ) {
	if ( 'left' == $grve_sidebar_layout || 'right' == $grve_sidebar_layout ) {

		if ( 'none' != $grve_sidebar_bg_color ) {
			$grve_sidebar_bg_color = ' grve-sidebar-colored grve-bg-' . $grve_sidebar_bg_color;
		} else {
			$grve_sidebar_bg_color = '';
		}
		$grve_sidebar_class = 'grve-sidebar' . $fixed . $grve_sidebar_bg_color;
?>
		<!-- Sidebar -->
		<aside id="grve-sidebar" class="<?php echo esc_attr( $grve_sidebar_class ); ?>">
			<?php
				if ( $grve_sidebar_extra_content ) {
					grve_print_portfolio_details();
				}
			?>
			<?php dynamic_sidebar( $grve_sidebar_id ); ?>
		</aside>
		<!-- End Sidebar -->
<?php
	}
}

?>