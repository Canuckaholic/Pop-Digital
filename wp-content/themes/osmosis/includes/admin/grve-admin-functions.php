<?php

/*
*	Admin functions and definitions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Default hidden metaboxes for portfolio
 */
function grve_change_default_hidden( $hidden, $screen ) {
    if ( 'portfolio' == $screen->id ) {
        $hidden = array_flip( $hidden );
        unset( $hidden['portfolio_categorydiv'] ); //show portfolio category box
        $hidden = array_flip( $hidden );
        $hidden[] = 'postexcerpt';
		$hidden[] = 'postcustom';
		$hidden[] = 'commentstatusdiv';
		$hidden[] = 'commentsdiv';
		$hidden[] = 'authordiv';
    }
    return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'grve_change_default_hidden', 10, 2 );


/**
 * Enqueue scripts and styles for the back end.
 */
function grve_backend_scripts( $hook ) {
	global $post;

	wp_register_style( 'grve-page-feature-section', get_template_directory_uri() . '/includes/css/grve-page-feature-section.css', array(), '1.0' );
	wp_register_style( 'grve-admin-meta', get_template_directory_uri() . '/includes/css/grve-admin-meta.css', array(), '1.0' );
	wp_register_style( 'grve-modal', get_template_directory_uri() . '/includes/css/grve-modal.css', array(), '1.0' );
	wp_register_style( 'grve-custom-sidebars', get_template_directory_uri() . '/includes/css/grve-custom-sidebars.css' );


	$grve_upload_slider_texts = array(
		'modal_title' => __( 'Insert Images', GRVE_THEME_TRANSLATE ),
		'modal_button_title' => __( 'Insert Images', GRVE_THEME_TRANSLATE ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_replace_texts = array(
		'modal_title' => __( 'Replace Image', GRVE_THEME_TRANSLATE ),
		'modal_button_title' => __( 'Replace Image', GRVE_THEME_TRANSLATE ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_media_texts = array(
		'modal_title' => __( 'Insert Media', GRVE_THEME_TRANSLATE ),
		'modal_button_title' => __( 'Insert Media', GRVE_THEME_TRANSLATE ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_upload_image_texts = array(
		'modal_title' => __( 'Insert Image', GRVE_THEME_TRANSLATE ),
		'modal_button_title' => __( 'Insert Image', GRVE_THEME_TRANSLATE ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_feature_section_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	$grve_custom_sidebar_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);

	wp_register_script( 'grve-custom-sidebars', get_template_directory_uri() . '/includes/js/grve-custom-sidebars.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-custom-sidebars', 'grve_custom_sidebar_texts', $grve_custom_sidebar_texts );

	wp_register_script( 'grve-upload-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-slider.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-upload-slider-script', 'grve_upload_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'grve-upload-feature-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-feature-slider.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-upload-feature-slider-script', 'grve_upload_feature_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'grve-upload-image-replace-script', get_template_directory_uri() . '/includes/js/grve-upload-image-replace.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-upload-image-replace-script', 'grve_upload_image_replace_texts', $grve_upload_image_replace_texts );

	wp_register_script( 'grve-upload-simple-media-script', get_template_directory_uri() . '/includes/js/grve-upload-simple.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-upload-simple-media-script', 'grve_upload_media_texts', $grve_upload_media_texts );

	wp_register_script( 'grve-upload-image-script', get_template_directory_uri() . '/includes/js/grve-upload-image.js', array( 'jquery'), false, '1.0' );
	wp_localize_script( 'grve-upload-image-script', 'grve_upload_image_texts', $grve_upload_image_texts );

	wp_register_script( 'grve-page-feature-section-script', get_template_directory_uri() . '/includes/js/grve-page-feature-section.js', array( 'jquery', 'wp-color-picker' ), false, '1.0' );
	wp_localize_script( 'grve-page-feature-section-script', 'grve_feature_section_texts', $grve_feature_section_texts );

	wp_register_script( 'grve-post-options-script', get_template_directory_uri() . '/includes/js/grve-post-options.js', array( 'jquery'), false, '1.0' );

	wp_register_script( 'grve-modal-script' , get_template_directory_uri() . '/includes/js/grve-modal.js' , array( 'jquery', 'backbone', 'underscore'), false, '1.0' );



	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

        if ( 'post' === $post->post_type ) {

			wp_enqueue_style( 'grve-admin-meta' );
            wp_enqueue_style( 'grve-page-feature-section' );
			wp_enqueue_script( 'grve-upload-simple-media-script' );
			wp_enqueue_script( 'grve-upload-slider-script' );
			wp_enqueue_script( 'grve-post-options-script' );

        } else if ( 'page' === $post->post_type || 'portfolio' === $post->post_type) {

			wp_enqueue_style( 'grve-modal' );
			wp_enqueue_style( 'grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'grve-page-feature-section' );

			wp_enqueue_script( 'grve-modal-script' );
			wp_enqueue_script( 'grve-upload-simple-media-script' );
			wp_enqueue_script( 'grve-upload-image-script' );
			wp_enqueue_script( 'grve-upload-slider-script' );
			wp_enqueue_script( 'grve-upload-feature-slider-script' );
			wp_enqueue_script( 'grve-upload-image-replace-script' );
			wp_enqueue_script( 'grve-page-feature-section-script' );

        } else if ( 'testimonial' === $post->post_type ) {

			wp_enqueue_style( 'grve-admin-meta' );

        } else if ( 'product' === $post->post_type ) {
			wp_enqueue_style( 'grve-admin-meta' );
		}
    }


	if ( isset( $_GET['page'] ) && ( 'grve-custom-sidebar-settings' == $_GET['page'] ) ) {

		wp_enqueue_style( 'grve-custom-sidebars' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'grve-custom-sidebars' );
	}

	wp_register_style(
		'redux-custom-css',
		get_template_directory_uri() . '/includes/css/grve-redux-panel.css',
		array( 'redux-css' ),
		time(),
		'all'
	);
	wp_enqueue_style( 'redux-custom-css' );

}
add_action( 'admin_enqueue_scripts', 'grve_backend_scripts', 10, 1 );

/**
 * Helper function to get modal template
 */
function grve_get_modal_template_data() {
	include( 'grve-modal-template-data.php' );
	die();
}
add_action( 'wp_ajax_grve_get_modal_template_data' , 'grve_get_modal_template_data' );

/**
 * Helper function to get custom fields with fallback
 */
function grve_post_meta( $id, $fallback = false ) {
	global $post;
	$post_id = $post->ID;
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function grve_admin_post_meta( $post_id, $id, $fallback = false ) {
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to get theme options with fallback
 */
function grve_option( $id, $fallback = false, $param = false ) {
	global $grve_osmosis_options;
	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_osmosis_options[$id]) && $grve_osmosis_options[$id] !== '' ) ? $grve_osmosis_options[$id] : $fallback;
	if ( !empty($grve_osmosis_options[$id]) && $param ) {
		$output = ( isset($grve_osmosis_options[$id][$param]) && $grve_osmosis_options[$id][$param] !== '' ) ? $grve_osmosis_options[$id][$param] : $fallback;
	}
	return $output;
}

/**
 * Helper function to get array value with fallback
 */
function grve_array_value( $input_array, $id, $fallback = false, $param = false ) {

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
	if ( !empty($input_array[$id]) && $param ) {
		$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
	}
	return $output;
}

/**
 * Helper function for strings
 */
function grve_starts_with( $haystack, $needle ) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

/**
 * Helper function convert hex to rgb
 */
function grve_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1) );
	} else {
		$r = hexdec( substr( $hex, 0, 2) );
		$g = hexdec( substr( $hex, 2, 2) );
		$b = hexdec( substr( $hex, 4, 2) );
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}

/**
 * Helper function to get theme visibility options
 */
function grve_visibility( $id ) {
	$visibility = grve_option( $id );
	if ( '1' == $visibility ) {
		return true;
	}
	return false;
}

/**
 * Backend Theme Activation Actions
 */
function grve_backend_theme_activation() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

		$catalog = array(
			'width' => '560',	// px
			'height'	=> '560',	// px
			'crop'	=> 1 // true
		);

		$single = array(
			'width' => '560',	// px
			'height'	=> '560',	// px
			'crop'	=> 1 // false
		);

		$thumbnail = array(
			'width' => '120',	// px
			'height'	=> '120',	// px
			'crop'	=> 1 // true
		);

		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
		update_option( 'woocommerce_enable_lightbox', 'no' );

		//Redirect to Theme Options
		header( 'Location: ' . admin_url() . 'admin.php?page=grve_options&tab=0' ) ;
	}
}

add_action('admin_init','grve_backend_theme_activation');

/**
 * Check if Revolution slider is active
 */
function grve_is_revslider_active() {

	if ( class_exists('RevSlider') ) {
		return true;
	}
	return false;
}

/**
 * Check if to replace Backend Logo
 */
function grve_admin_login_logo() {

	$replace_logo = grve_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		$grve_logo = grve_option( 'logo','','url' );
		if ( !empty( $grve_logo ) ) {
			echo "
			<style>
			body.login #login h1 a {
				background: url('" . esc_url( $grve_logo ) . "');
				background-position: center top;
				background-repeat: no-repeat;
				background-size: inherit;
				width: 100%;
				height: auto;
			}
			</style>
			";
		}
	}
}
add_action( 'login_head', 'grve_admin_login_logo' );


?>