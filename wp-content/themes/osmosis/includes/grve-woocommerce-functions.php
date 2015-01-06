<?php

/*
*	Woocommerce helper functions and configuration
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Helper function to check if woocommerce is enabled
 */
function grve_woocommerce_enabled() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}

//If woocomerce plugin is not enabled return
if ( !grve_woocommerce_enabled() ) {
	return false;
}

//Add Theme support for woocommerce
add_theme_support( 'woocommerce' );

/**
 * Add Meta fields To Products
 */
require_once( get_template_directory() . '/includes/admin/grve-product-meta.php' );

/**
 * Helper function to get shop custom fields with fallback
 */
function grve_post_meta_shop( $id, $fallback = false ) {
	$post_id = wc_get_page_id( 'shop' );
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to skin Product Search
 */
function grve_woo_product_search( $form ) {
	$new_custom_id = uniqid( 'grve_product_search_' );
	$form =  '<form role="search" class="grve-search" method="get" action="' . home_url( '/' ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" id="' . $new_custom_id . '" value="' . get_search_query() . '" name="s" placeholder="' . __( 'Search for ...', GRVE_THEME_TRANSLATE ) . '" />';
	$form .= '  <input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;
}

/**
 * Helper function to notify about Shop Pages in Admin Pages
 */
function grve_woo_admin_notice() {
	global $post;

	$woo_page_found = false;
	$notify_out = '';

	$woo_page_ids = array(
		'shop' => wc_get_page_id( 'shop' ),
		'cart' => wc_get_page_id( 'cart' ),
		'checkout' => wc_get_page_id( 'checkout' ),
		'myaccount' => wc_get_page_id( 'myaccount' ),
	);

	if ( isset( $post->ID ) ) {
		$current_page_id = $post->ID;
		$woo_page_found = in_array( $current_page_id, $woo_page_ids );
	}

	if ( $woo_page_found  ) {
		$notify_out .= '<div class="updated">';
		$notify_out .= '  <p>';

		if ( $current_page_id == $woo_page_ids['shop'] ) {
			$notify_out .= __( 'This page is assigned from WooCommerce: Product Archive / Shop Page', GRVE_THEME_TRANSLATE );
		} else if ( $current_page_id == $woo_page_ids['cart'] ) {
			$notify_out .= __( 'This page is assigned from WooCommerce: Cart Page', GRVE_THEME_TRANSLATE );
		} else if ( $current_page_id == $woo_page_ids['checkout'] ) {
			$notify_out .= __( 'This page is assigned from WooCommerce: Checkout Page', GRVE_THEME_TRANSLATE );
		} else if ( $current_page_id == $woo_page_ids['myaccount'] ) {
			$notify_out .= __( 'This page is assigned from WooCommerce: My Account Page', GRVE_THEME_TRANSLATE );
		}

		$notify_out .= '  </p>';
		$notify_out .= '</div>';
	}

	echo $notify_out;
}
add_action( 'admin_notices', 'grve_woo_admin_notice' );

/**
 * Helper function to return empty
 */
function grve_woo_empty( $param = '' ) {
	return '';
}

/**
 * Helper function to update cart count on header icon via ajax
 */
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<span class="grve-purchased-items"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
<?php
	$fragments['span.grve-purchased-items'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

/**
 * Helper function to add cart button on shop overview/ archive / search
 */
function grve_woo_add_to_cart() {

	global $product;

	if ( $product->is_purchasable() ) {

		echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s grve-add-cart" title="%s">'.  __( 'Add to cart', GRVE_THEME_TRANSLATE ) .'</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				$product->is_purchasable() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text() )
			);
	} else {
		echo '';
	}
}

/**
 * Function to add check icon after add to cart
 */
function grve_woo_added_to_cart() {
	echo '<i class="grve-cart-tick grve-icon-check"></i>';
}

/**
 * Function to modify columns number on related products
 */
function grve_woo_output_related_products_args() {

	$columns = 4;
	if( is_product() ) {
		$grve_sidebar_id = grve_post_meta( 'grve_product_sidebar', 'grve-woocommerce-sidebar-product' );
		$grve_sidebar_layout = grve_post_meta( 'grve_product_layout', 'right' );
		if ( 'none' != $grve_sidebar_layout && is_active_sidebar( $grve_sidebar_id ) ) {
			if ( 'left' == $grve_sidebar_layout || 'right' == $grve_sidebar_layout ) {
				$columns = 3;
			}
		}
	}

	$args = array(
		'posts_per_page' => $columns,
		'columns' => $columns,
		'orderby' => 'rand'
	);

	return $args;
}

/**
 * Function to modify columns number on product thumbnails
 */
function grve_woo_product_thumbnails_columns() {
	return 4;
}

/**
 * Function to add before main woocommerce content
 */
function grve_woo_before_main_content() {
?>
	<div id="grve-main-content">
		<?php
			if ( is_shop() && !is_search() ) {
				grve_print_header_title();
				$page_nav_menu = grve_post_meta_shop( 'grve_page_navigation_menu' );
				if ( !empty( $page_nav_menu ) ) {
		?>

				<div id="grve-anchor-menu" class="grve-fields-bar">
						<div class="grve-icon-menu"></div>
						<?php
						wp_nav_menu(
							array(
								'menu' => $page_nav_menu, /* menu id */
								'container' => false, /* no container */
								'depth' => '1',
							)
						);
						?>
				</div>

		<?php
				}
			}
		?>
		<div class="grve-container <?php echo grve_sidebar_class(); ?>">
			<div id="grve-content-area">
				<!-- Content -->
				<div id="grve-woocommerce-<?php echo wc_get_page_id('shop'); ?>" <?php post_class(); ?>>
	<?php
}

/**
 * Function to add after main woocommerce content
 */
function grve_woo_after_main_content() {
?>
				</div>
			</div>
			<!-- End Content -->

			<?php get_sidebar(); ?>
		</div>
	</div>
<?php
}

/**
 * Function to add before shop loop item
 */
function grve_woo_before_shop_loop_item() {
?>
	<div class="grve-product-item">
		<div class="grve-product-media">
<?php
}

/**
 * Function to add after shop loop item
 */
function grve_woo_after_shop_loop_item() {
?>
			<div class="grve-product-options">
				<?php woocommerce_template_loop_rating(); ?>
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div>
		<div class="grve-product-content">
			<span class="grve-product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
			<span class="grve-product-price"><?php woocommerce_template_loop_price(); ?></span>
		</div>
	</div>
<?php
}

/**
 * Function to add before single product images
 */
function grve_woo_before_product_images() {

	if ( 'yes' != get_option( 'woocommerce_enable_lightbox', '' ) ) {
?>
		<div class="grve-gallery-popup">
<?php
	}

}

/**
 * Function to add after single product images
 */
function grve_woo_after_product_images() {

	if ( 'yes' != get_option( 'woocommerce_enable_lightbox', '' ) ) {
?>
	</div>
<?php
	}

}

/**
 * De-register WooCommerce styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/**
 * Unhook WooCommerce actions
 */

//Remove Content Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

//Remove Breadcrubs
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

//Remove Shop Actions
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//Remove Single Product Images
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );


/**
 * Overwrite the WooCommerce actions and filters
 */
add_action('woocommerce_before_main_content', 'grve_woo_before_main_content', 10);
add_action('woocommerce_after_main_content', 'grve_woo_after_main_content', 10);

add_action('woocommerce_before_shop_loop_item', 'grve_woo_before_shop_loop_item', 10);
add_action('woocommerce_after_shop_loop_item', 'grve_woo_after_shop_loop_item', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'grve_woo_added_to_cart' );

add_action( 'woocommerce_before_single_product_summary', 'grve_woo_before_product_images', 9 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product_summary', 'grve_woo_after_product_images', 21 );

add_filter( 'get_product_search_form', 'grve_woo_product_search' );

add_filter( 'woocommerce_output_related_products_args', 'grve_woo_output_related_products_args' );
add_filter( 'woocommerce_loop_add_to_cart_link', 'grve_woo_add_to_cart' );
add_filter( 'woocommerce_product_thumbnails_columns', 'grve_woo_product_thumbnails_columns' );


?>