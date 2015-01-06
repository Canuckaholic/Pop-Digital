<?php
/*
*	Collection of functions for admin feature section
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Feature Single Image with ajax
 */
function grve_get_image_media() {


	if( isset( $_POST['attachment_id'] ) ) {

		$media_id  = $_POST['attachment_id'];

		if( !empty( $media_id  ) ) {

			$image_item = array (
				'id' => $media_id,
			);

			grve_print_admin_feature_image_item( $image_item, "new" );

		}
	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_image_media', 'grve_get_image_media' );

/**
 * Get Replaced Image with ajax
 */
function grve_get_replaced_image() {


	if( isset( $_POST['attachment_id'] ) ) {

		if ( isset( $_POST['attachment_mode'] ) && !empty( $_POST['attachment_mode'] ) ) {
			$mode = $_POST['attachment_mode'];
			switch( $mode ) {
				case 'image':
					$input_name = 'grve_image_item_id';
				break;
				case 'full-slider':
				default:
					$input_name = 'grve_slider_item_id[]';
				break;
			}
		} else {
			$input_name = 'grve_slider_item_id[]';
		}

		$media_id  = $_POST['attachment_id'];
		$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
		$thumbnail_url = $thumb_src[0];
		$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
		$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
?>
		<input type="hidden" value="<?php echo $media_id; ?>" name="<?php echo $input_name; ?>">
		<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . $media_id . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
<?php

	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_replaced_image', 'grve_get_replaced_image' );

/**
 * Get Single Feature Slider Media with ajax
 */
function grve_get_admin_feature_slider_media() {


	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = $_POST['attachment_ids'];

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'id' => $media_id,
				);

				grve_print_admin_feature_slider_item( $slider_item, "new" );
			}
		}
	}

	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_admin_feature_slider_media', 'grve_get_admin_feature_slider_media' );

/**
 * Get Single Feature Map Point with ajax
 */
function grve_get_map_point() {
	if( isset( $_POST['map_mode'] ) ) {
		$mode = $_POST['map_mode'];
		grve_print_admin_feature_map_point( array(), $mode );
	}
	if( isset( $_POST['map_mode'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_map_point', 'grve_get_map_point' );

/**
 * Prints Feature Map Points
 */
function grve_print_admin_feature_map_items( $map_items ) {

	if( !empty($map_items) ) {
		foreach ( $map_items as $map_item ) {
			grve_print_admin_feature_map_point( $map_item, $mode );
		}
	}

}

/**
 * Prints Feature Single Map Point
 */
function grve_print_admin_feature_map_point( $map_item, $mode = '' ) {


	$map_item_id = uniqid('grve_map_point_');
	$map_id = grve_array_value( $map_item, 'id', $map_item_id );

	$map_lat = grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = grve_array_value( $map_item, 'marker' );

	$map_title = grve_array_value( $map_item, 'title' );
	$map_infotext = grve_array_value( $map_item, 'info_text','' );

	$button_text = grve_array_value( $map_item, 'button_text' );
	$button_url = grve_array_value( $map_item, 'button_url' );
	$button_target = grve_array_value( $map_item, 'button_target', '_self' );
	$button_color = grve_array_value( $map_item, 'button_color', 'primary-1' );

	$grve_item_new = '';
	if( $mode = "new" ) {
		$grve_item_new = " grve-item-new";
	}

?>
	<div class="grve-map-item postbox">
		<input class="grve-map-item-delete-button button<?php echo $grve_item_new; ?>" type="button" value="<?php _e( 'Delete', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<input class="grve-open-map-modal button-primary<?php echo $grve_item_new; ?>" type="button" value="<?php _e( 'Edit Settings', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-title">
			<span><?php _e( 'Map Point', GRVE_THEME_TRANSLATE ); ?></span>
		</h3>
		<div class="inside">
			<input type="hidden" name="grve_map_item_point_id[]" value="<?php echo $map_id; ?>"/>
			<ul class="grve-map-setting">
				<li>
					<div class="grve-setting">
						<label><?php _e( 'Latitude', GRVE_THEME_TRANSLATE ); ?></label>
						<input type="text" name="grve_map_item_point_lat[]" value="<?php echo esc_attr( $map_lat ); ?>"/>
					</div>
				</li>
				<li>
					<div class="grve-setting">
						<label><?php _e( 'Longtitude', GRVE_THEME_TRANSLATE ); ?></label>
						<input type="text" name="grve_map_item_point_lng[]" value="<?php echo esc_attr( $map_lng ); ?>"/>
					</div>
				</li>
				<li>
					<div class="grve-setting">
						<label><?php _e( 'Marker', GRVE_THEME_TRANSLATE ); ?></label>
						<input type="text" name="grve_map_item_point_marker[]" class="grve-upload-simple-media-field" value="<?php echo esc_attr( $map_marker ); ?>"/>
						<label></label>
						<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary<?php echo $grve_item_new; ?>" value="<?php _e( 'Insert Marker', GRVE_THEME_TRANSLATE ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button<?php echo $grve_item_new; ?>" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
					</div>
				</li>
			</ul>
			<div class="grve-map-data-container">

				<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Title / Info Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
				<input type="hidden" id="grve_map_item_point_title<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $map_title ); ?>" name="grve_map_item_point_title[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the title.', GRVE_THEME_TRANSLATE ); ?>">
				<input type="hidden" id="grve_map_item_point_infotext<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $map_infotext ); ?>" name="grve_map_item_point_infotext[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Info Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the info text.', GRVE_THEME_TRANSLATE ); ?>">
				<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
				<input type="hidden" id="grve_map_item_point_button_text<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_map_item_point_button_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
				<input type="hidden" id="grve_map_item_point_button_url<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_map_item_point_button_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
				<input type="hidden" id="grve_map_item_point_button_target<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_map_item_point_button_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
				<input type="hidden" id="grve_map_item_point_button_color<?php echo $map_item_id ; ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_map_item_point_button_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
			</div>
		</div>
	</div>
<?php
}

/**
 * Prints Feature Single Image Item
 */
function grve_print_admin_feature_image_item( $image_item, $mode = "" ) {

	global $grve_media_color_overlay_selection;

	$media_id = $image_item['id'];

	$title = grve_array_value( $image_item, 'title' );
	$caption = grve_array_value( $image_item, 'caption' );
	$text_align = grve_array_value( $image_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $image_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $image_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $image_item, 'caption_color', 'dark' );

	$bg_position = grve_array_value( $image_item, 'bg_position', 'center-center' );
	$bg_effect = grve_array_value( $image_item, 'bg_effect', 'none' );
	$style = grve_array_value( $image_item, 'style', 'default' );
	$el_class = grve_array_value( $image_item, 'el_class' );

	$pattern_overlay = grve_array_value( $image_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $image_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $image_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $image_item, 'button_text' );
	$button_url = grve_array_value( $image_item, 'button_url' );
	$button_type = grve_array_value( $image_item, 'button_type', '' );
	$button_size = grve_array_value( $image_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $image_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $image_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $image_item, 'button_target', '_self' );

	$button_text2 = grve_array_value( $image_item, 'button_text2' );
	$button_url2 = grve_array_value( $image_item, 'button_url2' );
	$button_type2 = grve_array_value( $image_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $image_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $image_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $image_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $image_item, 'button_target2', '_self' );

	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-image-item-delete-button";
	$grve_open_modal_class = "grve-open-image-modal";
	$grve_replace_image_class = "grve-upload-replace-image";
	if( $mode = "new" ) {
		$grve_button_class = "grve-image-item-delete-button grve-item-new";
		$grve_replace_image_class = "grve-upload-replace-image grve-item-new";
		$grve_open_modal_class = "grve-open-image-modal grve-item-new";
	}
	$image_item_id = uniqid('_');
?>

	<div class="grve-image-item postbox">
		<input class="<?php echo $grve_button_class; ?> button" type="button" value="<?php _e( 'Delete', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<input class="<?php echo $grve_open_modal_class; ?> button-primary" type="button" value="<?php _e( 'Edit Settings', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-title">
			<span><?php _e( 'Image', GRVE_THEME_TRANSLATE ); ?></span>
		</h3>
		<div class="inside">
			<div class="grve-thumb-container" data-mode="image">
				<input type="hidden" value="<?php echo $media_id; ?>" name="grve_image_item_id">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" title="' . esc_attr( $title ) . '" attid="' . $media_id . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
			</div>
			<div class="<?php echo $grve_replace_image_class; ?>"></div>
			<div class="grve-image-settings">
				<div class="grve-image-data-container">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Title / Caption', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_title<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_image_item_title" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the image title.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_caption<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_image_item_caption" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Caption', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the image caption.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_title_color<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_image_item_title_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Title Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_caption_color<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_image_item_caption_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Caption Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the caption color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_style<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_image_item_style" data-meta-template="#grve-select-style-template" data-meta-title="<?php _e( 'Title / Caption Style', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption style.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_text_align<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_image_item_text_align" data-meta-template="#grve-select-align-template" data-meta-title="<?php _e( 'Alignment', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the content alignment.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_text_animation<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_image_item_text_animation" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php _e( 'Animation', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption animation.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Background', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_bg_position<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $bg_position ); ?>" name="grve_image_item_bg_position" data-meta-template="#grve-select-bg-position-template" data-meta-title="<?php _e( 'Background Position', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the background position of the image.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_bg_effect<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $bg_effect ); ?>" name="grve_image_item_bg_effect" data-meta-template="#grve-select-bg-effect-template" data-meta-title="<?php _e( 'Background Effect', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the background effect of the image.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_pattern_overlay<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_image_item_pattern_overlay" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php _e( 'Pattern Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the pattern overlay.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_color_overlay<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_image_item_color_overlay" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php _e( 'Color Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the color overlay.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_opacity_overlay<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_image_item_opacity_overlay" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php _e( 'Opacity Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the opacity overlay.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'First Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_button_text<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_image_item_button_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_url<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_image_item_button_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_target<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_image_item_button_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_color<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_image_item_button_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_size<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_image_item_button_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_shape<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_image_item_button_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button_type<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_image_item_button_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Second Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_button2_text<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_image_item_button2_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_url<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_image_item_button2_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_target<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_image_item_button2_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_color<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_image_item_button2_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_size<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_image_item_button2_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_shape<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_image_item_button2_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_image_item_button2_type<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_image_item_button2_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Extras', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_el_class<?php echo $image_item_id ; ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_image_item_el_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Extra Class', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type class name.', GRVE_THEME_TRANSLATE ); ?>">

				</div>
			</div>
		</div>

	</div>
<?php
}

/**
 * Prints Section Slider items
 */
function grve_print_admin_feature_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		grve_print_admin_feature_slider_item( $slider_item, '' );
	}

}

/**
* Prints Single Feature Slider Item
*/
function grve_print_admin_feature_slider_item( $slider_item, $new = "" ) {

	global $grve_media_align_selection, $grve_media_color_selection, $grve_media_color_overlay_selection;

	$media_id = $slider_item['id'];

	$title = grve_array_value( $slider_item, 'title' );
	$caption = grve_array_value( $slider_item, 'caption' );
	$text_align = grve_array_value( $slider_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $slider_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $slider_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $slider_item, 'caption_color', 'dark' );

	$bg_position = grve_array_value( $slider_item, 'bg_position', 'center-center' );
	$style = grve_array_value( $slider_item, 'style', 'default' );
	$header_style = grve_array_value( $slider_item, 'header_style', 'default' );
	$el_class = grve_array_value( $slider_item, 'el_class' );

	$pattern_overlay = grve_array_value( $slider_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $slider_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $slider_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $slider_item, 'button_text' );
	$button_url = grve_array_value( $slider_item, 'button_url' );
	$button_type = grve_array_value( $slider_item, 'button_type', '' );
	$button_size = grve_array_value( $slider_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $slider_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $slider_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $slider_item, 'button_target', '_self' );

	$button_text2 = grve_array_value( $slider_item, 'button_text2' );
	$button_url2 = grve_array_value( $slider_item, 'button_url2' );
	$button_type2 = grve_array_value( $slider_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $slider_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $slider_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $slider_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $slider_item, 'button_target2', '_self' );


	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-feature-slider-item-delete-button";
	$grve_replace_image_class = "grve-upload-replace-image";
	$grve_open_modal_class = "grve-open-slider-modal";
	if( $new = "new" ) {
		$grve_button_class = "grve-feature-slider-item-delete-button grve-item-new";
		$grve_replace_image_class = "grve-upload-replace-image grve-item-new";
		$grve_open_modal_class = "grve-open-slider-modal grve-item-new";
	}

	$slider_item_id = uniqid('_');
?>

	<div class="grve-slider-item postbox">
		<div class="handlediv" title="<?php _e( 'Click to toggle', GRVE_THEME_TRANSLATE ); ?>"></div>
		<input class="<?php echo $grve_button_class; ?> button" type="button" value="<?php _e( 'Delete', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<input class="<?php echo $grve_open_modal_class; ?> button-primary" type="button" value="<?php _e( 'Edit Settings', GRVE_THEME_TRANSLATE ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<span class="grve-modal-spinner"></span>
		<h3 class="hndle grve-title">
			<span><?php _e( 'Slide', GRVE_THEME_TRANSLATE ); ?> <?php if ( !empty ($title) ) { echo ': ' . $title; } ?></span>
		</h3>
		<div class="inside">
			<div class="grve-thumb-container" data-mode="slider-full">
				<input type="hidden" value="<?php echo $media_id; ?>" name="grve_slider_item_id[]">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" title="' . esc_attr( $title ) . '" attid="' . $media_id . '" alt="' . $alt . '" width="120" height="120"/>'; ?>
			</div>
			<div class="<?php echo $grve_replace_image_class; ?>"></div>

			<div class="grve-slider-settings">
				<div class="grve-slider-data-container">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Title / Caption', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_title<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_slider_item_title[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the title.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_caption<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_slider_item_caption[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Description', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the caption.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_title_color<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_slider_item_title_color[]" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Title Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_caption_color<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_slider_item_caption_color[]" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Description Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the caption color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_style<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_slider_item_style[]" data-meta-template="#grve-select-style-template" data-meta-title="<?php _e( 'Title / Caption Style', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption style.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_text_align<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_slider_item_text_align[]" data-meta-template="#grve-select-align-template" data-meta-title="<?php _e( 'Alignment', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the content alignment.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_text_animation<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_slider_item_text_animation[]" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php _e( 'Animation', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption animation.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Header / Background Position', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_bg_position<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $bg_position ); ?>" name="grve_slider_item_bg_position[]" data-meta-template="#grve-select-bg-position-template" data-meta-title="<?php _e( 'Background Position', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the background position of the image.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_header_style<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $header_style ); ?>" name="grve_slider_item_header_style[]" data-meta-template="#grve-select-header-style-template" data-meta-title="<?php _e( 'Header Style', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'With this option you can change the coloring of your header.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_pattern_overlay<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_slider_item_pattern_overlay[]" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php _e( 'Pattern Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the pattern overlay.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_color_overlay<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_slider_item_color_overlay[]" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php _e( 'Color Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the color overlay.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_opacity_overlay<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_slider_item_opacity_overlay[]" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php _e( 'Opacity Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the opacity overlay.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'First Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_button_text<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_slider_item_button_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_url<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_slider_item_button_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_target<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_slider_item_button_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_color<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_slider_item_button_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_size<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_slider_item_button_size[]" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_shape<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_slider_item_button_shape[]" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button_type<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_slider_item_button_type[]" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Second Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_button2_text<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_slider_item_button2_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_url<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_slider_item_button2_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_target<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_slider_item_button2_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_color<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_slider_item_button2_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_size<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_slider_item_button2_size[]" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_shape<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_slider_item_button2_shape[]" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
					<input type="hidden" id="grve_slider_item_button2_type<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_slider_item_button2_type[]" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Extras', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_el_class<?php echo $slider_item_id ; ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_slider_item_el_class[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Extra Class', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type class name.', GRVE_THEME_TRANSLATE ); ?>">

				</div>
			</div>

		</div>

	</div>
<?php

}

/**
* Prints Single Feature Viedo Item
*/
function grve_print_admin_feature_video_item( $video_item ) {

	$video_item_id = uniqid('_');

	$title = grve_array_value( $video_item, 'title' );
	$caption = grve_array_value( $video_item, 'caption' );
	$text_align = grve_array_value( $video_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $video_item, 'text_animation', 'fade-in' );

	$title_color = grve_array_value( $video_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $video_item, 'caption_color', 'dark' );

	$style = grve_array_value( $video_item, 'style', 'default' );
	$el_class = grve_array_value( $video_item, 'el_class' );

	$pattern_overlay = grve_array_value( $video_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $video_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $video_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $video_item, 'button_text' );
	$button_url = grve_array_value( $video_item, 'button_url' );
	$button_type = grve_array_value( $video_item, 'button_type', '' );
	$button_size = grve_array_value( $video_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $video_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $video_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $video_item, 'button_target', '_self' );

	$button_text2 = grve_array_value( $video_item, 'button_text2' );
	$button_url2 = grve_array_value( $video_item, 'button_url2' );
	$button_type2 = grve_array_value( $video_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $video_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $video_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $video_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $video_item, 'button_target2', '_self' );

?>
	<div class="grve-video-data-container">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Title / Caption', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_title<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_video_item_title" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the title.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_caption<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_video_item_caption" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Caption', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the caption.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_title_color<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_video_item_title_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Title Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title color.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_caption_color<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_video_item_caption_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php _e( 'Caption Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the caption color.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_style<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_video_item_style" data-meta-template="#grve-select-style-template" data-meta-title="<?php _e( 'Title / Caption Style', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption style', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_text_align<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_video_item_text_align" data-meta-template="#grve-select-align-template" data-meta-title="<?php _e( 'Alignment', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the content alignment', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_text_animation<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_video_item_text_animation" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php _e( 'Animation', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the title / caption animation', GRVE_THEME_TRANSLATE ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_pattern_overlay<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_video_item_pattern_overlay" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php _e( 'Pattern Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the pattern overlay.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_color_overlay<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_video_item_color_overlay" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php _e( 'Color Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the color overlay.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_opacity_overlay<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_video_item_opacity_overlay" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php _e( 'Opacity Overlay', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the opacity overlay.', GRVE_THEME_TRANSLATE ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'First Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_button_text<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_video_item_button_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_url<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_video_item_button_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_target<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_video_item_button_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_color<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_video_item_button_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_size<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_video_item_button_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_shape<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_video_item_button_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button_type<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_video_item_button_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Second Button', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_button2_text<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_video_item_button2_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button Text', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button text.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_url<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_video_item_button2_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Button URL', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type the button URL.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_target<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_video_item_button2_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php _e( 'Button Target', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button target.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_color<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_video_item_button2_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php _e( 'Button Color', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button color.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_size<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_video_item_button2_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php _e( 'Button Size', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button size.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_shape<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_video_item_button2_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php _e( 'Button Shape', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button shape.', GRVE_THEME_TRANSLATE ); ?>">
		<input type="hidden" id="grve_video_item_button2_type<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_video_item_button2_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php _e( 'Button Type', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Select the button type.', GRVE_THEME_TRANSLATE ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php _e( 'Extras', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_el_class<?php echo $video_item_id ; ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_video_item_el_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php _e( 'Extra Class', GRVE_THEME_TRANSLATE ); ?>" data-meta-desc="<?php _e( 'Type class name.', GRVE_THEME_TRANSLATE ); ?>">

	</div>
<?php
}

function grve_admin_get_feature_section( $post_id ) {

	//Feature Settings
	$feature_element = grve_admin_post_meta( $post_id, 'grve_page_feature_element' );
	$feature_size = grve_admin_post_meta( $post_id, 'grve_page_feature_size' );
	$feature_height = grve_admin_post_meta( $post_id, 'grve_page_feature_height', '550' );
	$feature_header_position = grve_admin_post_meta( $post_id, 'grve_page_feature_header_position', 'above' );
	$feature_header_integration = grve_admin_post_meta( $post_id, 'grve_page_feature_header_integration', 'no' );
	$feature_effect = grve_admin_post_meta( $post_id, 'grve_page_feature_effect' );
	$feature_go_to_section = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section' );

	$feature_header_style = grve_admin_post_meta( $post_id, 'grve_page_feature_header_style', 'default' );

	//Image Item
	$image_item = get_post_meta( $post_id, 'grve_page_image_item', true );

	//Title Item
	$title_item = get_post_meta( $post_id, 'grve_page_title_item', true );

	//Slider Item
	$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
	$slider_settings = get_post_meta( $post_id, 'grve_page_slider_settings', true );
	$slider_speed = grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = grve_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_dir_nav = grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_transition = grve_array_value( $slider_settings, 'transition', 'slide' );

	//Map Item
	$map_items = get_post_meta( $post_id, 'grve_page_map_items', true );
	$map_settings = get_post_meta( $post_id, 'grve_page_map_settings', true );
	$map_zoom = grve_array_value( $map_settings, 'zoom', 14 );
	$map_marker = grve_array_value( $map_settings, 'marker' );


	//Video Item
	$video_item = get_post_meta( $post_id, 'grve_page_video_item', true );
	$video_webm = grve_array_value( $video_item, 'video_webm' );
	$video_mp4 = grve_array_value( $video_item, 'video_mp4' );
	$video_ogv = grve_array_value( $video_item, 'video_ogv' );
	$video_bg_image = grve_array_value( $video_item, 'video_bg_image' );

?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-page-feature-element">
							<strong><?php _e( 'Feature Element', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select feature section element.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-element" name="grve_page_feature_element">
							<option value="" <?php if ( "" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'None', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="title" <?php if ( "title" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="image" <?php if ( "image" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'Image', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="video" <?php if ( "video" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'Video', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="slider" <?php if ( "slider" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'Slider', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="map" <?php if ( "map" == $feature_element ) { ?> selected="selected" <?php } ?>><?php _e( 'Map', GRVE_THEME_TRANSLATE ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-speed" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-speed">
							<strong><?php _e( 'Slideshow Speed', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<input type="text" id="grve-page-slider-speed" name="grve_page_slider_settings_speed" value="<?php echo esc_attr( $slider_speed ); ?>" /> ms
					</td>
				</tr>
				<tr id="grve-feature-section-slider-pause" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-pause">
							<strong><?php _e( 'Pause On Hover', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-page-slider-pause" name="grve_page_slider_settings_pause" value="yes" <?php checked( $slider_pause, 'yes' ); ?>/>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-direction-nav" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-direction-nav">
							<strong><?php _e( 'Navigation Buttons', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<select name="grve_page_slider_settings_direction_nav" id="grve-page-slider-direction-nav">
							<option value="1" <?php if ( "1" == $slider_dir_nav ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Style 1', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="2" <?php if ( "2" == $slider_dir_nav ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Style 2', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="3" <?php if ( "3" == $slider_dir_nav ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Style 3', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="4" <?php if ( "4" == $slider_dir_nav ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Style 4', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="0" <?php if ( "0" == $slider_dir_nav ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'No Navigation', GRVE_THEME_TRANSLATE ); ?>
							</option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-direction-nav-color" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-direction-nav-color">
							<strong><?php _e( 'Navigation color', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<select name="grve_page_slider_settings_direction_nav_color" id="grve-page-slider-direction-nav-color">
							<option value="light" <?php if ( "light" == $slider_dir_nav_color ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Light', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="dark" <?php if ( "dark" == $slider_dir_nav_color ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Dark', GRVE_THEME_TRANSLATE ); ?>
							</option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-transition" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-transition">
							<strong><?php _e( 'Transition', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<select name="grve_page_slider_settings_transition">
							<option value="slide" <?php if ( "slide" == $slider_transition ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Slide', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="fade" <?php if ( "fade" == $slider_transition ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Fade', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="backSlide" <?php if ( "backSlide" == $slider_transition ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Back Slide', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="goDown" <?php if ( "goDown" == $slider_transition ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Go Down', GRVE_THEME_TRANSLATE ); ?>
							</option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-size" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-size">
							<strong><?php _e( 'Feature Size', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'With Custom Size option you can select the feature height.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-size" name="grve_page_feature_size">
							<option value="" <?php if ( "" == $feature_size ) { ?> selected="selected" <?php } ?>><?php _e( 'Full Screen', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="custom" <?php if ( "custom" == $feature_size ) { ?> selected="selected" <?php } ?>><?php _e( 'Custom Size', GRVE_THEME_TRANSLATE ); ?></option>
						</select>
						<span id="grve-feature-section-height" class="grve-inner-field" <?php if ( "" == $feature_size ) { ?> style="display:none;" <?php } ?>>
							<label><?php _e( 'Height', GRVE_THEME_TRANSLATE ); ?></label>
							<input type="text" id="grve-page-feature-height" name="grve_page_feature_height" value="<?php echo esc_attr( $feature_height ); ?>" class="small-text" /> px
						</span>
					</td>
				</tr>
				<tr id="grve-feature-section-header-position" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-position">
							<strong><?php _e( 'Feature/Header Position', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'With this option header will be shown above or below feature section.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_position" id="grve-page-feature-header-position">
							<option value="above" <?php if ( "above" == $feature_header_position ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Header above Feature', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="below" <?php if ( "below" == $feature_header_position ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Header below Feature', GRVE_THEME_TRANSLATE ); ?>
							</option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-header-integration" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-integration">
							<strong><?php _e( 'Header Integration', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'With this option feature section will be integrated into the header.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_integration" id="grve-page-feature-header-integration">
							<option value="no" <?php if ( "no" == $feature_header_integration ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'No', GRVE_THEME_TRANSLATE ); ?>
							</option>
							<option value="yes" <?php if ( "yes" == $feature_header_integration ) { ?> selected="selected" <?php } ?>>
								<?php _e( 'Yes', GRVE_THEME_TRANSLATE ); ?>
							</option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-header-style" class="grve-feature-section-item" <?php if ( "" == $feature_element || "slider" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-integration">
							<strong><?php _e( 'Header Style', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'With this option you can change the coloring of your header.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_style" id="grve-page-feature-header-style">
							<?php grve_print_media_header_style_selection($feature_header_style); ?>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-effect" class="grve-feature-section-item" <?php if ( "" == $feature_element || "map" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-effect">
							<strong><?php _e( 'Enable Title Parallax Effect', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-page-feature-effect" name="grve_page_feature_effect" value="parallax" <?php checked( $feature_effect, 'parallax' ); ?>/>
					</td>
				</tr>
				<tr id="grve-feature-section-go-to-section" class="grve-feature-section-item" <?php if ( "" == $feature_element || "map" == $feature_element || "slider" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-go-to-sectio">
							<strong><?php _e( 'Enable Bottom Arrow', GRVE_THEME_TRANSLATE ); ?></strong>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-page-feature-go-to-section" name="grve_page_feature_go_to_section" value="yes" <?php checked( $feature_go_to_section, 'yes' ); ?>/>
					</td>
				</tr>

				<tr id="grve-feature-section-image" class="grve-feature-section-item" <?php if ( "image" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php _e( 'Feature Image', GRVE_THEME_TRANSLATE ); ?></label>
					</th>
					<td>

						<?php if( empty( $image_item ) ) { ?>
						<input type="button" class="grve-upload-image-button button-primary" value="<?php _e( 'Insert Image', GRVE_THEME_TRANSLATE ); ?>"/>
						<?php } else { ?>
						<input type="button" disabled="disabled" class="grve-upload-image-button button-primary disabled" value="<?php _e( 'Insert Image', GRVE_THEME_TRANSLATE ); ?>"/>
						<?php } ?>
						<span id="grve-upload-image-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
				<tr id="grve-feature-section-slider" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php _e( 'Feature Slider', GRVE_THEME_TRANSLATE ); ?></label>
					</th>
					<td>
						<input type="button" class="grve-upload-feature-slider-button button-primary" value="<?php _e( 'Insert Images to Slider', GRVE_THEME_TRANSLATE ); ?>"/>
						<span id="grve-upload-feature-slider-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
				<tr id="grve-feature-section-video" class="grve-feature-section-item" <?php if ( "video" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php _e( 'Feature Video', GRVE_THEME_TRANSLATE ); ?></label>
					</th>
					<td>
					</td>
				</tr>
				<tr id="grve-feature-section-map" class="grve-feature-section-item" <?php if ( "map" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php _e( 'Feature Map', GRVE_THEME_TRANSLATE ); ?></label>
					</th>
					<td>
						<input type="button" id="grve-upload-multi-map-point" class="grve-upload-multi-map-point button-primary" value="<?php _e( 'Insert Point to Map', GRVE_THEME_TRANSLATE ); ?>"/>
						<span id="grve-upload-multi-map-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
			</tbody>
		</table>
		<div id="grve-feature-image-container" data-mode="image" class="grve-feature-section-item" <?php if ( 'image' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $image_item ) ) {
					grve_print_admin_feature_image_item( $image_item );
				}
			?>
		</div>
		<div id="grve-feature-slider-container" data-mode="slider-full" class="grve-feature-section-item" <?php if ( 'slider' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $slider_items ) ) {
					grve_print_admin_feature_slider_items( $slider_items );
				}
			?>
		</div>

		<div id="grve-feature-title-container" class="grve-feature-section-item" <?php if ( 'title' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-title-item postbox">
				<h3 class="grve-title">
					<span><?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-title-setting">
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Title', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_title" value="<?php echo grve_array_value( $title_item, 'title' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Caption', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_caption" value="<?php echo grve_array_value( $title_item, 'caption' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Title Color', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_title_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'title_color',"#ffffff" ); ?>" data-default-color="#ffffff"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Caption Color', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_caption_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'caption_color',"#ffffff" ); ?>" data-default-color="#ffffff"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Background Color', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_bg_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'bg_color',"#303030" ); ?>" data-default-color="#303030"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Style', GRVE_THEME_TRANSLATE ); ?></label>
								<select name="grve_title_item_style">
									<?php
										$title_style = grve_array_value( $title_item, 'style', '' );
										grve_print_media_style_selection($title_style);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Alignment', GRVE_THEME_TRANSLATE ); ?></label>
								<select name="grve_title_item_text_align">
									<?php
										$title_text_align = grve_array_value( $title_item, 'text_align', 'left' );
										grve_print_media_align_selection($title_text_align);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Animation', GRVE_THEME_TRANSLATE ); ?></label>
								<select name="grve_title_item_text_animation">
									<?php
										$title_text_animation = grve_array_value( $title_item, 'text_animation', 'fade-in' );
										grve_print_media_text_animation_selection($title_text_animation);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Extra Class', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" name="grve_title_item_el_class" value="<?php echo grve_array_value( $title_item, 'el_class' ); ?>"/>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="grve-feature-map-container" class="grve-feature-section-item" <?php if ( 'map' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-map-item postbox">
				<h3 class="grve-title">
					<span><?php _e( 'Map', GRVE_THEME_TRANSLATE ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-map-setting">
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Single Point Zoom', GRVE_THEME_TRANSLATE ); ?></label>
								<select id="grve-page-feature-map-zoom" name="grve_page_feature_map_zoom">
									<?php for ( $i=1; $i < 20; $i++ ) { ?>
										<option value="<?php echo $i; ?>"<?php if ( $i == $map_zoom ) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Global Marker', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" class="grve-upload-simple-media-field" id="grve-page-feature-map-marker" name="grve_page_feature_map_marker" value="<?php echo esc_attr( $map_marker ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php _e( 'Insert Marker', GRVE_THEME_TRANSLATE ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<?php grve_print_admin_feature_map_items( $map_items ); ?>
		</div>
		<div id="grve-feature-video-container" class="grve-feature-section-item" <?php if ( 'video' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-video-item postbox">
				<input class="grve-open-video-modal button-primary" type="button" value="<?php _e( 'Edit Settings', GRVE_THEME_TRANSLATE ); ?>">
				<span class="grve-button-spacer">&nbsp;</span>
				<span class="grve-modal-spinner"></span>
				<h3 class="grve-title">
					<span><?php _e( 'Video', GRVE_THEME_TRANSLATE ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-video-setting">
						<li>
							<div class="grve-setting">
								<label><?php _e( 'WebM File URL', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" id="grve-page-feature-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_webm" value="<?php echo esc_attr( $video_webm ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'MP4 File URL', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" id="grve-page-feature-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_mp4" value="<?php echo esc_attr( $video_mp4 ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'OGV File URL', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" id="grve-page-feature-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_ogv" value="<?php echo esc_attr( $video_ogv ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php _e( 'Fallback Image', GRVE_THEME_TRANSLATE ); ?></label>
								<input type="text" id="grve-page-feature-video-bg-image" class="grve-upload-simple-media-field"  name="grve_video_item_bg_image" value="<?php echo esc_attr( $video_bg_image ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php _e( 'Upload Image', GRVE_THEME_TRANSLATE ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
							</div>
						</li>
					</ul>
					<?php grve_print_admin_feature_video_item( $video_item ); ?>
				</div>
			</div>
		</div>

<?php
}

function grve_admin_save_feature_section( $post_id ) {

	//Feature Slider Items
	$slider_items = array();
	if ( isset( $_POST['grve_slider_item_id'] ) ) {

		$num_of_images = sizeof( $_POST['grve_slider_item_id'] );
		for ( $i=0; $i < $num_of_images; $i++ ) {

			$this_image = array (
				'id' => $_POST['grve_slider_item_id'][ $i ],
				'title' => $_POST['grve_slider_item_title'][ $i ],
				'caption' => $_POST['grve_slider_item_caption'][ $i ],
				'text_align' => $_POST['grve_slider_item_text_align'][ $i ],
				'text_animation' => $_POST['grve_slider_item_text_animation'][ $i ],
				'bg_position' => $_POST['grve_slider_item_bg_position'][ $i ],
				'style' => $_POST['grve_slider_item_style'][ $i ],
				'title_color' => $_POST['grve_slider_item_title_color'][ $i ],
				'caption_color' => $_POST['grve_slider_item_caption_color'][ $i ],
				'pattern_overlay' => $_POST['grve_slider_item_pattern_overlay'][ $i ],
				'color_overlay' => $_POST['grve_slider_item_color_overlay'][ $i ],
				'opacity_overlay' => $_POST['grve_slider_item_opacity_overlay'][ $i ],
				'header_style' => $_POST['grve_slider_item_header_style'][ $i ],
				'el_class' => $_POST['grve_slider_item_el_class'][ $i ],
				'button_text' => $_POST['grve_slider_item_button_text'][ $i ],
				'button_url' => $_POST['grve_slider_item_button_url'][ $i ],
				'button_target' => $_POST['grve_slider_item_button_target'][ $i ],
				'button_color' => $_POST['grve_slider_item_button_color'][ $i ],
				'button_size' => $_POST['grve_slider_item_button_size'][ $i ],
				'button_shape' => $_POST['grve_slider_item_button_shape'][ $i ],
				'button_type' => $_POST['grve_slider_item_button_type'][ $i ],
				'button_text2' => $_POST['grve_slider_item_button2_text'][ $i ],
				'button_url2' => $_POST['grve_slider_item_button2_url'][ $i ],
				'button_target2' => $_POST['grve_slider_item_button2_target'][ $i ],
				'button_color2' => $_POST['grve_slider_item_button2_color'][ $i ],
				'button_size2' => $_POST['grve_slider_item_button2_size'][ $i ],
				'button_shape2' => $_POST['grve_slider_item_button2_shape'][ $i ],
				'button_type2' => $_POST['grve_slider_item_button2_type'][ $i ],
			);
			array_push( $slider_items, $this_image );
		}

	}

	if( empty( $slider_items ) ) {
		delete_post_meta( $post_id, 'grve_page_slider_items' );
		delete_post_meta( $post_id, 'grve_page_slider_settings' );
	} else{
		update_post_meta( $post_id, 'grve_page_slider_items', $slider_items );

		$slider_settings = array (
			'slideshow_speed' => $_POST['grve_page_slider_settings_speed'],
			'direction_nav' => $_POST['grve_page_slider_settings_direction_nav'],
			'direction_nav_color' => $_POST['grve_page_slider_settings_direction_nav_color'],
			'slider_pause' => $_POST['grve_page_slider_settings_pause'],
			'transition' => $_POST['grve_page_slider_settings_transition'],
		);
		update_post_meta( $post_id, 'grve_page_slider_settings', $slider_settings );
	}

	//Feature Map Items
	$map_items = array();
	if ( isset( $_POST['grve_map_item_point_id'] ) ) {

		$num_of_map_points = sizeof( $_POST['grve_map_item_point_id'] );
		for ( $i=0; $i < $num_of_map_points; $i++ ) {

			$this_point = array (
				'id' => $_POST['grve_map_item_point_id'][ $i ],
				'lat' => $_POST['grve_map_item_point_lat'][ $i ],
				'lng' => $_POST['grve_map_item_point_lng'][ $i ],
				'marker' => $_POST['grve_map_item_point_marker'][ $i ],
				'title' => $_POST['grve_map_item_point_title'][ $i ],
				'info_text' => $_POST['grve_map_item_point_infotext'][ $i ],
				'button_text' => $_POST['grve_map_item_point_button_text'][ $i ],
				'button_url' => $_POST['grve_map_item_point_button_url'][ $i ],
				'button_target' => $_POST['grve_map_item_point_button_target'][ $i ],
				'button_color' => $_POST['grve_map_item_point_button_color'][ $i ],
			);
			array_push( $map_items, $this_point );
		}

	}

	if( empty( $map_items ) ) {
		delete_post_meta( $post_id, 'grve_page_map_items' );
		delete_post_meta( $post_id, 'grve_page_map_settings' );
	} else{
		update_post_meta( $post_id, 'grve_page_map_items', $map_items );
		$map_settings = array (
			'zoom' => $_POST['grve_page_feature_map_zoom'],
			'marker' => $_POST['grve_page_feature_map_marker'],
		);
		update_post_meta( $post_id, 'grve_page_map_settings', $map_settings );
	}


	//Feature Image Item
	if ( isset( $_POST['grve_image_item_id'] ) ) {

		$image_item = array (
			'id' => $_POST['grve_image_item_id'],
			'title' => $_POST['grve_image_item_title'],
			'caption' => $_POST['grve_image_item_caption'],
			'text_align' => $_POST['grve_image_item_text_align'],
			'text_animation' => $_POST['grve_image_item_text_animation'],
			'bg_effect' => $_POST['grve_image_item_bg_effect'],
			'bg_position' => $_POST['grve_image_item_bg_position'],
			'style' => $_POST['grve_image_item_style'],
			'title_color' => $_POST['grve_image_item_title_color'],
			'caption_color' => $_POST['grve_image_item_caption_color'],
			'pattern_overlay' => $_POST['grve_image_item_pattern_overlay'],
			'color_overlay' => $_POST['grve_image_item_color_overlay'],
			'opacity_overlay' => $_POST['grve_image_item_opacity_overlay'],
			'el_class' => $_POST['grve_image_item_el_class'],
			'button_text' => $_POST['grve_image_item_button_text'],
			'button_url' => $_POST['grve_image_item_button_url'],
			'button_target' => $_POST['grve_image_item_button_target'],
			'button_color' => $_POST['grve_image_item_button_color'],
			'button_size' => $_POST['grve_image_item_button_size'],
			'button_shape' => $_POST['grve_image_item_button_shape'],
			'button_type' => $_POST['grve_image_item_button_type'],
			'button_text2' => $_POST['grve_image_item_button2_text'],
			'button_url2' => $_POST['grve_image_item_button2_url'],
			'button_target2' => $_POST['grve_image_item_button2_target'],
			'button_color2' => $_POST['grve_image_item_button2_color'],
			'button_size2' => $_POST['grve_image_item_button2_size'],
			'button_shape2' => $_POST['grve_image_item_button2_shape'],
			'button_type2' => $_POST['grve_image_item_button2_type'],
		);
		update_post_meta( $post_id, 'grve_page_image_item', $image_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_image_item' );
	}

	//Feature Title Item
	if ( isset( $_POST['grve_title_item_title'] ) ) {

		$text_item = array (
			'title' => $_POST['grve_title_item_title'],
			'caption' => $_POST['grve_title_item_caption'],
			'style' => $_POST['grve_title_item_style'],
			'text_align' => $_POST['grve_title_item_text_align'],
			'text_animation' => $_POST['grve_title_item_text_animation'],
			'bg_color' => $_POST['grve_title_item_bg_color'],
			'title_color' => $_POST['grve_title_item_title_color'],
			'caption_color' => $_POST['grve_title_item_caption_color'],
			'el_class' => $_POST['grve_title_item_el_class'],
		);
		update_post_meta( $post_id, 'grve_page_title_item', $text_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_title_item' );
	}

	//Feature Video Item
	if ( isset( $_POST['grve_video_item_title'] ) ) {

		$video_item = array (
			'title' => $_POST['grve_video_item_title'],
			'caption' => $_POST['grve_video_item_caption'],
			'text_align' => $_POST['grve_video_item_text_align'],
			'text_animation' => $_POST['grve_video_item_text_animation'],
			'style' => $_POST['grve_video_item_style'],
			'title_color' => $_POST['grve_video_item_title_color'],
			'caption_color' => $_POST['grve_video_item_caption_color'],
			'pattern_overlay' => $_POST['grve_video_item_pattern_overlay'],
			'color_overlay' => $_POST['grve_video_item_color_overlay'],
			'opacity_overlay' => $_POST['grve_video_item_opacity_overlay'],
			'video_webm' => $_POST['grve_video_item_webm'],
			'video_mp4' => $_POST['grve_video_item_mp4'],
			'video_ogv' => $_POST['grve_video_item_ogv'],
			'video_bg_image' => $_POST['grve_video_item_bg_image'],
			'el_class' => $_POST['grve_video_item_el_class'],
			'button_text' => $_POST['grve_video_item_button_text'],
			'button_url' => $_POST['grve_video_item_button_url'],
			'button_target' => $_POST['grve_video_item_button_target'],
			'button_color' => $_POST['grve_video_item_button_color'],
			'button_size' => $_POST['grve_video_item_button_size'],
			'button_shape' => $_POST['grve_video_item_button_shape'],
			'button_type' => $_POST['grve_video_item_button_type'],
			'button_text2' => $_POST['grve_video_item_button2_text'],
			'button_url2' => $_POST['grve_video_item_button2_url'],
			'button_target2' => $_POST['grve_video_item_button2_target'],
			'button_color2' => $_POST['grve_video_item_button2_color'],
			'button_size2' => $_POST['grve_video_item_button2_size'],
			'button_shape2' => $_POST['grve_video_item_button2_shape'],
			'button_type2' => $_POST['grve_video_item_button2_type'],
		);
		update_post_meta( $post_id, 'grve_page_video_item', $video_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_video_item' );
	}
}

?>