<?php

/*
*	Main theme functions and definitions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Theme Definitions
 * Please leave these settings unchanged
 */

define( 'GRVE_THEME_SHORT_NAME', 'osmosis' );
define( 'GRVE_THEME_TRANSLATE', 'osmosis' );
define( 'GRVE_THEME_NAME', 'Osmosis' );
define( 'GRVE_THEME_MAJOR_VERSION', 1 );
define( 'GRVE_THEME_MINOR_VERSION', 0 );
define( 'GRVE_THEME_HOTFIX_VERSION', 0 );
define( 'GRVE_REDUX_CUSTOM_PANEL', false );

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

/**
 * Include Global helper files
 */
require_once( get_template_directory() . '/includes/grve-global.php' );
/**
 * Include WooCommerce helper files
 */
require_once( get_template_directory() . '/includes/grve-woocommerce-functions.php' );

/**
 * Register Plugins Libraries
 */
if ( is_admin() ) {
	require_once( get_template_directory() . '/includes/plugins/tgm-plugin-activation/register-plugins.php' );
	require_once( get_template_directory() . '/includes/plugins/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
}

/**
 * ReduxFramework
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/includes/framework/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/framework/framework.php' );
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/includes/admin/grve-redux-framework-config.php' );
}

/**
 * Visual Composer Extentions
 */
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	function grve_add_vc_extentions() {
		require_once( get_template_directory() . '/vc_extend/grve-shortcodes-vc-helper.php' );
		require_once( get_template_directory() . '/vc_extend/grve-shortcodes-vc-remove.php' );
		require_once( get_template_directory() . '/vc_extend/grve-shortcodes-vc-add.php' );
	}
	add_action( 'init', 'grve_add_vc_extentions', 5 );

}

/**
 * Include admin helper files
 */
require_once( get_template_directory() . '/includes/admin/grve-admin-functions.php' );
require_once( get_template_directory() . '/includes/admin/grve-admin-custom-sidebars.php' );
require_once( get_template_directory() . '/includes/admin/grve-admin-media-functions.php' );
require_once( get_template_directory() . '/includes/admin/grve-admin-feature-functions.php' );

require_once( get_template_directory() . '/includes/admin/grve-update-functions.php' );
require_once( get_template_directory() . '/includes/admin/grve-meta-functions.php' );
require_once( get_template_directory() . '/includes/admin/grve-page-meta.php' );
require_once( get_template_directory() . '/includes/admin/grve-post-meta.php' );

require_once( get_template_directory() . '/includes/admin/grve-portfolio-post-type.php' );
require_once( get_template_directory() . '/includes/admin/grve-portfolio-meta.php' );
require_once( get_template_directory() . '/includes/admin/grve-testimonial-post-type.php' );
require_once( get_template_directory() . '/includes/admin/grve-testimonial-meta.php' );

/**
 * Include Dynamic css
 */
require_once( get_template_directory() . '/includes/grve-dynamic-css-loader.php' );

/**
 * Include helper files
 */
require_once( get_template_directory() . '/includes/grve-excerpt.php' );
require_once( get_template_directory() . '/includes/grve-vce-functions.php' );
require_once( get_template_directory() . '/includes/grve-header-functions.php' );
require_once( get_template_directory() . '/includes/grve-feature-functions.php' );
require_once( get_template_directory() . '/includes/grve-layout-functions.php' );
require_once( get_template_directory() . '/includes/grve-blog-functions.php' );
require_once( get_template_directory() . '/includes/grve-media-functions.php' );
require_once( get_template_directory() . '/includes/grve-portfolio-functions.php' );
require_once( get_template_directory() . '/includes/grve-footer-functions.php' );

/**
 * Include Theme Widgets
 */
require_once( get_template_directory() . '/includes/widgets/grve-widget-social.php' );
require_once( get_template_directory() . '/includes/widgets/grve-widget-latest-posts.php' );
require_once( get_template_directory() . '/includes/widgets/grve-widget-latest-comments.php' );
require_once( get_template_directory() . '/includes/widgets/grve-widget-latest-combo.php' );
require_once( get_template_directory() . '/includes/widgets/grve-widget-latest-portfolio.php' );
require_once( get_template_directory() . '/includes/widgets/grve-widget-contact-info.php' );

//Add shortcodes to widget text
add_filter( 'widget_text' , 'do_shortcode' );

add_action( "after_switch_theme", "grve_theme_activate" );
add_action( 'after_setup_theme', 'grve_theme_setup' );
add_action( 'widgets_init', 'grve_register_sidebars' );

/**
 * Theme activation function
 * Used whe activating the theme
 */
function grve_theme_activate() {

	$grve_version = array (
		"major" => GRVE_THEME_MAJOR_VERSION,
		"minor" => GRVE_THEME_MINOR_VERSION,
		"hotfix" => GRVE_THEME_HOTFIX_VERSION,
	);
	update_option( 'grve_theme_' . GRVE_THEME_SHORT_NAME . '_version', $grve_version );
	flush_rewrite_rules();
}

/**
 * Theme setup function
 * Theme translations and support
 */
function grve_theme_setup() {

	load_theme_textdomain( GRVE_THEME_TRANSLATE, get_template_directory() . '/languages' );

	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails', array( 'post', 'portfolio' ) );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
	add_theme_support( 'title-tag' );

	add_image_size( 'grve-image-extrasmall-square', 80, 80, true );
	add_image_size( 'grve-image-large-rect-horizontal', 1170, 658, true );
	add_image_size( 'grve-image-small-square', 560, 560, true );
	add_image_size( 'grve-image-small-rect-horizontal', 560, 315, true );
	add_image_size( 'grve-image-medium-rect-vertical', 560, 1120, true );
	add_image_size( 'grve-image-medium-rect-horizontal', 1120, 560, true );
	add_image_size( 'grve-image-medium-square', 1120, 1120, true );
	add_image_size( 'grve-image-fullscreen', 1920, 1920, false );

	register_nav_menus(
		array(
			'grve_header_nav' => __( 'Header Menu', GRVE_THEME_TRANSLATE ),
			'grve_footer_nav' => __( 'Footer Menu', GRVE_THEME_TRANSLATE ),
		)
	);

}

/**
 * Navigation Menus
 */
function grve_get_header_nav() {

	$grve_main_menu = '';

	if ( is_singular() ) {
		if ( 'yes' == grve_post_meta( 'grve_disable_menu' ) ) {
			return 'disabled';
		} else {
			$grve_main_menu	= grve_post_meta( 'grve_main_navigation_menu' );
		}
	}
	if( grve_woocommerce_enabled() && is_shop() && !is_search()  ) {
		if ( 'yes' == grve_post_meta_shop( 'grve_disable_menu' ) ) {
			return 'disabled';
		} else {
			$grve_main_menu	= grve_post_meta_shop( 'grve_main_navigation_menu' );
		}
	}

	return $grve_main_menu;
}

function grve_header_nav( $grve_main_menu = '') {

	if ( empty( $grve_main_menu ) ) {
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'theme_location' => 'grve_header_nav', /* where in the theme it's assigned */
				'container' => false,
				'fallback_cb' => 'grve_fallback_menu',
			)
		);
	} else {
		//Custom Alternative Menu
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'menu' => $grve_main_menu, /* menu name */
				'container' => false,
				'fallback_cb' => 'grve_fallback_menu',
			)
		);
	}
}

function grve_footer_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_footer_nav',
			'container' => false, /* no container */
			'depth' => '1',
		)
	);

}

/**
 * Sidebars & Widgetized Areas
 */
function grve_register_sidebars() {

	register_sidebar( array(
		'id' => 'grve-default-sidebar',
		'name' => __( 'Main Sidebar', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Main Sidebar Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));

	register_sidebar( array(
		'id' => 'grve-single-portfolio-sidebar',
		'name' => __( 'Single Portfolio', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Single Portfolio Sidebar Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));

	if ( grve_woocommerce_enabled() ) {

		register_sidebar( array(
			'id' => 'grve-woocommerce-sidebar-shop',
			'name' => __( 'Shop Overview Page', GRVE_THEME_TRANSLATE ),
			'description' => __( 'Shop Overview Widget Area', GRVE_THEME_TRANSLATE ),
			'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="grve-widget-title">',
			'after_title' => '</h5>',
		));
		register_sidebar( array(
			'id' => 'grve-woocommerce-sidebar-product',
			'name' => __( 'Shop Product Pages', GRVE_THEME_TRANSLATE ),
			'description' => __( 'Shop Product Widget Area', GRVE_THEME_TRANSLATE ),
			'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="grve-widget-title">',
			'after_title' => '</h5>',
		));
	}

	register_sidebar( array(
		'id' => 'grve-footer-1-sidebar',
		'name' => __( 'Footer 1', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Footer 1 Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-2-sidebar',
		'name' => __( 'Footer 2', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Footer 2 Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-3-sidebar',
		'name' => __( 'Footer 3', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Footer 3 Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-4-sidebar',
		'name' => __( 'Footer 4', GRVE_THEME_TRANSLATE ),
		'description' => __( 'Footer 4 Widget Area', GRVE_THEME_TRANSLATE ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="grve-widget-title">',
		'after_title' => '</h5>',
	));

	$grve_custom_sidebars = get_option( 'grve-osmosis-custom-sidebars' );
	if ( ! empty( $grve_custom_sidebars ) ) {
		foreach ( $grve_custom_sidebars as $grve_custom_sidebar ) {
			register_sidebar( array(
				'id' => $grve_custom_sidebar['id'],
				'name' => __( 'Custom Sidebar', GRVE_THEME_TRANSLATE ) . ': ' . $grve_custom_sidebar['name'],
				'description' => '',
				'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="grve-widget-title">',
				'after_title' => '</h5>',
			));
		}
	}

}

/**
 * Custom Search Form
 */
function grve_wpsearch( $form ) {
	$new_custom_id = uniqid( 'grve_search_' );
	$form =  '<form role="search" class="grve-search" method="get" action="' . home_url( '/' ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" id="' . $new_custom_id . '" value="' . get_search_query() . '" name="s" placeholder="' . __( 'Search for ...', GRVE_THEME_TRANSLATE ) . '" />';
	$form .= '</form>';
	return $form;
}
add_filter( 'get_search_form', 'grve_wpsearch' );

/**
 * Enqueue scripts and styles for the front end.
 */
function grve_frontend_scripts() {

	$template_dir_uri = get_template_directory_uri();
	$child_theme_dir_uri = get_stylesheet_directory_uri();

	wp_register_style( 'grve-style', $child_theme_dir_uri."/style.css", array(), '1.0.0', 'all' );
	wp_enqueue_style( 'grve-awsome-fonts', $template_dir_uri . '/css/font-awesome.min.css', array(), '4.2.0' );


	wp_enqueue_style( 'grve-basic', $template_dir_uri . '/css/basic.css', array(), '1.0.0' );
	wp_enqueue_style( 'grve-grid', $template_dir_uri . '/css/grid.css', array(), '1.0.0' );
	wp_enqueue_style( 'grve-theme-style', $template_dir_uri . '/css/theme-style.css', array(), '1.0.0' );
	wp_enqueue_style( 'grve-elements', $template_dir_uri . '/css/elements.css', array(), '1.0.0' );

	if ( grve_woocommerce_enabled() ) {
		wp_enqueue_style( 'grve-woocommerce-layout', $template_dir_uri . '/css/woocommerce-layout.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'grve-woocommerce-smallscreen', $template_dir_uri . '/css/woocommerce-smallscreen.css', array( 'grve-woocommerce-layout' ), '1.0.0', 'only screen and (max-width: 959px)' );
		wp_enqueue_style( 'grve-woocommerce-extrasmallscreen', $template_dir_uri . '/css/woocommerce-extrasmallscreen.css', array( 'grve-woocommerce-layout' ), '1.0.0', 'only screen and (max-width: 767px)' );
		wp_enqueue_style( 'grve-woocommerce-general', $template_dir_uri . '/css/woocommerce.css', array(), '1.0.0', 'all' );
	}

	if ( $child_theme_dir_uri !=  $template_dir_uri ) {
		wp_enqueue_style( 'grve-style');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'grve-responsive', $template_dir_uri . '/css/responsive.css', array(), '1.0.0' );

	wp_register_script( 'grve-googleapi-script', '//maps.googleapis.com/maps/api/js?v=3&sensor=false', NULL, NULL, true );
	wp_register_script( 'grve-maps-script', $template_dir_uri . '/js/maps.js', array( 'jquery', 'grve-googleapi-script' ), '1.0.0', true );
	$grve_maps_data = array(
		'hue_enabled' => grve_option( 'gmap_hue_enabled', '0' ) ,
		'hue' => grve_option( 'gmap_hue', '#ffffff' ) ,
		'saturation' => grve_option( 'gmap_saturation', '0' ) ,
		'lightness' => grve_option( 'gmap_hue', '0' ) ,
		'gamma' => grve_option( 'gmap_gamma', '0.1' ) ,
	);
	wp_localize_script( 'grve-maps-script', 'grve_maps_data', $grve_maps_data );
	wp_enqueue_script( 'grve-modernizr-script', $template_dir_uri . '/js/modernizr.custom.js', array( 'jquery' ), '2.8.3', false );
	$smooth_scroll = grve_option( 'smooth_scroll_enabled', '1' );
	if ( '1' == $smooth_scroll ) {
		wp_enqueue_script( 'grve-smoothscrolling-script', $template_dir_uri . '/js/smoothscrolling.js', array( 'jquery' ), '1.2.1', true );
	}
	wp_enqueue_script( 'grve-plugins', $template_dir_uri . '/js/plugins.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'grve-smartresize-script', $template_dir_uri . '/js/smartresize.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'grve-isotope-script', $template_dir_uri . '/js/isotope.pkgd.min.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'grve-packery-mode-script', $template_dir_uri . '/js/packery-mode.pkgd.min.js', array( 'jquery' ), '0.1.0', true );
	wp_enqueue_script( 'grve-main-script', $template_dir_uri . '/js/main.js', array( 'jquery' ), '1.0.0', true );

	$grve_form_data = array(
		'siteurl' => $template_dir_uri ,
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'grve-main-script', 'grve_form_data', $grve_form_data );

}
add_action( 'wp_enqueue_scripts', 'grve_frontend_scripts' );

/**
 * Pagination functions
 */
function grve_paginate_links() {
?>
	<div class="grve-pagination">
	<?php
		global $wp_query;
		$big = 999999999;
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'prev_text'    => "<i class='grve-icon-nav-left'></i>",
			'next_text'    => "<i class='grve-icon-nav-right'></i>",
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
		) );
	?>
	</div>
<?php
}

function grve_wp_link_pages() {
?>
	<?php
		$args = array(
			'before'           => '<p>',
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => "<i class='grve-icon-nav-right'></i>",
			'previouspagelink' => "<i class='grve-icon-nav-left'></i>",
			'pagelink'         => '%',
			'echo'             => 1
		);
	?>
	<div class="grve-pagination">
	<?php wp_link_pages( $args ); ?>
	</div>
<?php
}

function grve_pagination( $pages = '', $range = 2 ) {
	 $showitems = ( $range * 2 )+1;

	 global $paged;
	 if ( empty( $paged ) ) $paged = 1;

	 if ( $pages == '' ) {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages){
			 $pages = 1;
		 }
	 }

	if ( 1 != $pages ) {
		$pagination =  "<div class='grve-pagination'>";
		$pagination .=  "<ul>";

		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) {
			$pagination .= "<li><a class='grve-pagination-nav' href='" . get_pagenum_link( 1 ) . "' data-page='1'><i class='grve-icon-nav-double-left'></i></a></li>";
		}
		if( $paged > 1 && $showitems < $pages ){
			$this_page = $paged - 1;
			$pagination .= "<li><a class='grve-pagination-nav' href='" . get_pagenum_link( $paged - 1 ) . "' data-page='" . $this_page . "'><i class='grve-icon-nav-left'></i></a></li>";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ){
				$pagination .= ( $paged == $i )? "<li><a class='current' href='#'>" . $i . "</a></li>":"<li><a href='" . get_pagenum_link( $i )."' data-page='" . $i . "'>" . $i . "</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			$this_page = $paged + 1;
			$pagination .= "<li><a class='grve-pagination-nav' href='" . get_pagenum_link( $paged + 1 ) . "' data-page='" . $this_page . "'><i class='grve-icon-nav-right'></i></a></li>";
		}
        if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ){
			$pagination .= "<li><a class='grve-pagination-nav' href='" . get_pagenum_link( $pages ) . "' data-page='" . $pages . "'><i class='grve-icon-nav-double-right'></i></a></li>";
		}
		$pagination .=  "</ul>";
		$pagination .=  "</div>";
		echo $pagination;
     }
}

/**
 * Comments
 */
function grve_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li class="grve-comment-item">
		<!-- Comment -->
		<article id="comment-<?php comment_ID(); ?>"  <?php comment_class(); ?>>
			<?php echo get_avatar( $comment, 50 ); ?>
			<div class="grve-comment-content">

				<h6 class="grve-author">
					<a href="<?php comment_author_url( $comment->comment_ID ); ?>"><?php comment_author(); ?></a>
				</h6>
				<div class="grve-comment-date">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( ' %1$s ' . __( 'at', GRVE_THEME_TRANSLATE ) . ' %2$s', get_comment_date(),  get_comment_time() ); ?></a>
				</div>
				<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'REPLY', GRVE_THEME_TRANSLATE ) ) ) ); ?>
				<?php edit_comment_link( __( 'EDIT', GRVE_THEME_TRANSLATE ), '  ', '' ); ?>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><?php _e( 'Your comment is awaiting moderation.', GRVE_THEME_TRANSLATE ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
		</article>

	<!-- </li> is added by WordPress automatically -->
<?php
}

/**
 * Avatar additional Class
 */
function grve_add_gravatar_class( $class ) {
    $class = str_replace( "class='avatar", "class='avatar grve-circle", $class );
    return $class;
}
add_filter('get_avatar','grve_add_gravatar_class');

/**
 * Navigation links for prev/next in comments
 */
function grve_replace_reply_link_class( $output ) {
	$class = 'grve-btn grve-primary grve-btn-extrasmall grve-comment-reply';
	return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $class, $output, 1 );
}
add_filter('comment_reply_link', 'grve_replace_reply_link_class');

function grve_replace_edit_link_class( $output ) {
	$class = 'grve-btn grve-primary grve-btn-extrasmall grve-comment-edit';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $class, $output, 1 );
}
add_filter('edit_comment_link', 'grve_replace_edit_link_class');

/**
 * Main Navigation FallBack Menu
 */
function grve_fallback_menu(){

	echo '<ul class="grve-menu">';
	wp_list_pages('title_li=&sort_column=menu_order');
	echo '</ul>';
}

/**
 * Title Render Fallback before WordPress 4.1
 */
 if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function grve_theme_render_title() {
?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'grve_theme_render_title' );
}

/**
 * Theme identifier function
 * Used to get theme information
 */
function grve_theme_osmosis_info() {

	$grve_info = array (
		"major_version" => GRVE_THEME_MAJOR_VERSION,
		"minor_version" => GRVE_THEME_MINOR_VERSION,
		"hotfix_version" => GRVE_THEME_HOTFIX_VERSION,
		"short_name" => GRVE_THEME_SHORT_NAME,
	);

	return $grve_info;
}
?>