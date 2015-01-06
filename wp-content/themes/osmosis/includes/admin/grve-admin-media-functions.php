<?php
/*
*	Collection of functions for the media items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

$grve_media_align_selection = array(
	'left' => __( 'Left', GRVE_THEME_TRANSLATE ),
	'right' => __( 'Right', GRVE_THEME_TRANSLATE ),
	'center' => __( 'Center', GRVE_THEME_TRANSLATE ),
);

$grve_media_color_selection = array(
	'dark' => __( 'Dark', GRVE_THEME_TRANSLATE ),
	'light' => __( 'Light', GRVE_THEME_TRANSLATE ),
	'primary-1' => __( 'Primary 1', GRVE_THEME_TRANSLATE ),
	'primary-2' => __( 'Primary 2', GRVE_THEME_TRANSLATE ),
	'primary-3' => __( 'Primary 3', GRVE_THEME_TRANSLATE ),
	'primary-4' => __( 'Primary 4', GRVE_THEME_TRANSLATE ),
	'primary-5' => __( 'Primary 5', GRVE_THEME_TRANSLATE ),
);

$grve_media_header_style_selection = array(
	'default' => __( 'Default', GRVE_THEME_TRANSLATE ),
	'dark' => __( 'Dark', GRVE_THEME_TRANSLATE ),
	'light' => __( 'Light', GRVE_THEME_TRANSLATE ),
);

$grve_media_color_overlay_selection = array(
	'' => __( 'None', GRVE_THEME_TRANSLATE ),
	'dark' => __( 'Dark', GRVE_THEME_TRANSLATE ),
	'light' => __( 'Light', GRVE_THEME_TRANSLATE ),
	'primary-1' => __( 'Primary 1', GRVE_THEME_TRANSLATE ),
	'primary-2' => __( 'Primary 2', GRVE_THEME_TRANSLATE ),
	'primary-3' => __( 'Primary 3', GRVE_THEME_TRANSLATE ),
	'primary-4' => __( 'Primary 4', GRVE_THEME_TRANSLATE ),
	'primary-5' => __( 'Primary 5', GRVE_THEME_TRANSLATE ),
);

$grve_media_style_selection = array(
	'default' => __( 'Default', GRVE_THEME_TRANSLATE ),
	'1' => __( 'Style 1', GRVE_THEME_TRANSLATE ),
	'2' => __( 'Style 2', GRVE_THEME_TRANSLATE ),
	'3' => __( 'Style 3', GRVE_THEME_TRANSLATE ),
	'4' => __( 'Style 4', GRVE_THEME_TRANSLATE ),
);

$grve_media_pattern_overlay_selection = array(
	'' => __( 'No', GRVE_THEME_TRANSLATE ),
	'default' => __( 'Yes', GRVE_THEME_TRANSLATE ),
);

$grve_media_text_animation_selection = array(
	'fade-in' => __( 'Default', GRVE_THEME_TRANSLATE ),
	'fade-in-up' => __( 'Fade In Up', GRVE_THEME_TRANSLATE ),
	'fade-in-down' => __( 'Fade In Down', GRVE_THEME_TRANSLATE ),
	'fade-in-left' => __( 'Fade In Left', GRVE_THEME_TRANSLATE ),
	'fade-in-right' => __( 'Fade In Right', GRVE_THEME_TRANSLATE ),
);

$grve_media_button_color_selection = array(
	'primary-1' => __( 'Primary 1', GRVE_THEME_TRANSLATE ),
	'primary-2' => __( 'Primary 2', GRVE_THEME_TRANSLATE ),
	'primary-3' => __( 'Primary 3', GRVE_THEME_TRANSLATE ),
	'primary-4' => __( 'Primary 4', GRVE_THEME_TRANSLATE ),
	'primary-5' => __( 'Primary 5', GRVE_THEME_TRANSLATE ),
	'green' => __( 'Green', GRVE_THEME_TRANSLATE ),
	'orange' => __( 'Orange', GRVE_THEME_TRANSLATE ),
	'red' => __( 'Red', GRVE_THEME_TRANSLATE ),
	'blue' => __( 'Blue', GRVE_THEME_TRANSLATE ),
	'aqua' => __( 'Aqua', GRVE_THEME_TRANSLATE ),
	'purple' => __( 'Purple', GRVE_THEME_TRANSLATE ),
	'black' => __( 'Black', GRVE_THEME_TRANSLATE ),
	'grey' => __( 'Grey', GRVE_THEME_TRANSLATE ),
	'white' => __( 'White', GRVE_THEME_TRANSLATE ),
);

$grve_media_button_size_selection = array(
	'extrasmall' => __( 'Extra Small', GRVE_THEME_TRANSLATE ),
	'small' => __( 'Small', GRVE_THEME_TRANSLATE ),
	'medium' => __( 'Medium', GRVE_THEME_TRANSLATE ),
	'large' => __( 'Large', GRVE_THEME_TRANSLATE ),
	'extralarge' => __( 'Extra Large', GRVE_THEME_TRANSLATE ),
);

$grve_media_button_shape_selection = array(
	'square' => __( 'Square', GRVE_THEME_TRANSLATE ),
	'round' => __( 'Round', GRVE_THEME_TRANSLATE ),
	'extra-round' => __( 'Extra Round', GRVE_THEME_TRANSLATE ),
);

$grve_media_button_type_selection = array(
	'' => __( 'Default', GRVE_THEME_TRANSLATE ),
	'outline' => __( 'Outline', GRVE_THEME_TRANSLATE ),
);

$grve_media_button_target_selection = array(
	'_self' => __( 'Same Page', GRVE_THEME_TRANSLATE ),
	'_blank' => __( 'New page', GRVE_THEME_TRANSLATE ),
);

$grve_media_bg_position_selection = array(
	'left-top' => __( 'Left Top', GRVE_THEME_TRANSLATE ),
	'left-center' => __( 'Left Center', GRVE_THEME_TRANSLATE ),
	'left-bottom' => __( 'Left Bottom', GRVE_THEME_TRANSLATE ),
	'center-top' => __( 'Center Top', GRVE_THEME_TRANSLATE ),
	'center-center' => __( 'Center Center', GRVE_THEME_TRANSLATE ),
	'center-bottom' => __( 'Center Bottom', GRVE_THEME_TRANSLATE ),
	'right-top' => __( 'Right Top', GRVE_THEME_TRANSLATE ),
	'right-center' => __( 'Right Center', GRVE_THEME_TRANSLATE ),
	'right-bottom' => __( 'Right Bottom', GRVE_THEME_TRANSLATE ),
);

$grve_media_bg_effect_selection = array(
	'none' => __( 'None', GRVE_THEME_TRANSLATE ),
	'zoom' => __( 'Zoom', GRVE_THEME_TRANSLATE ),
);


/**
 * Print Media Selector Functions
 */
function grve_print_media_options( $selector_array, $current_value = "" ) {

	foreach ( $selector_array as $value=>$display_value ) {
	?>
		<option value="<?php echo $value; ?>" <?php selected( $current_value, $value ); ?>><?php echo $display_value; ?></option>
	<?php
	}

}

function grve_print_media_button_color_selection( $current_value = "" ) {
	global $grve_media_button_color_selection;
	grve_print_media_options( $grve_media_button_color_selection, $current_value );
}
function grve_print_media_button_size_selection( $current_value = "" ) {
	global $grve_media_button_size_selection;
	grve_print_media_options( $grve_media_button_size_selection, $current_value );
}
function grve_print_media_button_shape_selection( $current_value = "" ) {
	global $grve_media_button_shape_selection;
	grve_print_media_options( $grve_media_button_shape_selection, $current_value );
}
function grve_print_media_button_type_selection( $current_value = "" ) {
	global $grve_media_button_type_selection;
	grve_print_media_options( $grve_media_button_type_selection, $current_value );
}
function grve_print_media_button_target_selection( $current_value = "" ) {
	global $grve_media_button_target_selection;
	grve_print_media_options( $grve_media_button_target_selection, $current_value );
}

function grve_print_media_style_selection( $current_value = "" ) {
	global $grve_media_style_selection;
	grve_print_media_options( $grve_media_style_selection, $current_value );
}
function grve_print_media_color_selection( $current_value = "" ) {
	global $grve_media_color_selection;
	grve_print_media_options( $grve_media_color_selection, $current_value );
}
function grve_print_media_align_selection( $current_value = "" ) {
	global $grve_media_align_selection;
	grve_print_media_options( $grve_media_align_selection, $current_value );
}
function grve_print_media_header_style_selection( $current_value = "" ) {
	global $grve_media_header_style_selection;
	grve_print_media_options( $grve_media_header_style_selection, $current_value );
}

function grve_print_media_color_overlay_selection( $current_value = "" ) {
	global $grve_media_color_overlay_selection;
	grve_print_media_options( $grve_media_color_overlay_selection, $current_value );
}
function grve_print_media_pattern_overlay_selection( $current_value = "" ) {
	global $grve_media_pattern_overlay_selection;
	grve_print_media_options( $grve_media_pattern_overlay_selection, $current_value );
}
function grve_print_media_opacity_overlay_selection( $current_value = "" ) {

	for ( $i = 1; $i <= 9; $i++ ) {
		$value = $i*10 ;
?>
	<option value="<?php echo $value; ?>" <?php selected( $current_value, $value ); ?>>
		<?php echo $value; ?>
	</option>
<?php
	}
}

function grve_print_media_text_animation_selection( $current_value = "" ) {
	global $grve_media_text_animation_selection;
	grve_print_media_options( $grve_media_text_animation_selection, $current_value );
}

function grve_print_media_bg_position_selection( $current_value = "center-center" ) {
	global $grve_media_bg_position_selection;
	grve_print_media_options( $grve_media_bg_position_selection, $current_value );
}

function grve_print_media_bg_effect_selection( $current_value = "" ) {
	global $grve_media_bg_effect_selection;
	grve_print_media_options( $grve_media_bg_effect_selection, $current_value );
}



/**
 * Prints Media Slider items
 */
function grve_print_admin_media_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		grve_print_admin_media_slider_item( $slider_item, '' );
	}

}

/**
 * Get Single Slider Media with ajax
 */
function grve_get_slider_media() {

	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = $_POST['attachment_ids'];

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'id' => $media_id,
				);
				grve_print_admin_media_slider_item( $slider_item, "new" );
			}
		}
	}
	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_slider_media', 'grve_get_slider_media' );


/**
 * Prints Single Slider Media  Item
 */
function grve_print_admin_media_slider_item( $slider_item, $new = "" ) {
	$media_id = $slider_item['id'];

	$title = '';

	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-slider-item-delete-button";

	if( $new = "new" ) {
		$grve_button_class = "grve-slider-item-delete-button grve-item-new";
	}

?>
	<div class="grve-slider-item-minimal">
		<input class="<?php echo $grve_button_class; ?> button" type="button" value="<?php _e( 'Delete', GRVE_THEME_TRANSLATE ); ?>">
		<h3 class="hndle grve-title">
			<span><?php _e( 'Image', GRVE_THEME_TRANSLATE ); ?></span>
		</h3>
		<div class="inside">
			<input type="hidden" value="<?php echo $media_id; ?>" name="grve_media_slider_item_id[]">
			<?php echo '<img class="grve-thumb" src="' . $thumbnail_url . '" title="' . $title . '" attid="' . $media_id . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
		</div>
	</div>
<?php

}

?>