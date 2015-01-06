<?php
/*
*	Helper Functions for meta options ( Post / Page)
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Function to print menu selector
 */
function grve_print_menu_selection( $menu_id, $id, $name, $default = 'none' ) {

	?>
	<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
		<option value="" <?php selected( '', $menu_id ); ?>>
			<?php
				if ( 'none' == $default ){
					_e( 'None', GRVE_THEME_TRANSLATE );
				} else {
					_e( 'Default', GRVE_THEME_TRANSLATE );
				}
			?>
		</option>
	<?php
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $item ) {
	?>
				<option value="<?php echo $item->term_id; ?>" <?php selected( $item->term_id, $menu_id ); ?>>
					<?php echo $item->name; ?>
				</option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print menu type selector
 */
function grve_print_menu_type_selection( $menu_type, $id, $name, $default = '' ) {

	$menu_types = array(
		'' => __( 'Default', GRVE_THEME_TRANSLATE ),
		'simply' => __( 'Simple', GRVE_THEME_TRANSLATE ),
		'button' => __( 'Button', GRVE_THEME_TRANSLATE ),
		'box' => __( 'Box', GRVE_THEME_TRANSLATE ),
		'hidden' => __( 'Hidden', GRVE_THEME_TRANSLATE ),
	);

	?>
	<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
	<?php
		foreach ( $menu_types as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo $key; ?>" <?php selected( $key, $menu_type ); ?>><?php echo $value; ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print layout selector
 */
function grve_print_layout_selection( $layout, $id, $name ) {

	$layouts = array(
		'' => __( 'Default', GRVE_THEME_TRANSLATE ),
		'none' => __( 'Full Width', GRVE_THEME_TRANSLATE ),
		'left' => __( 'Left Sidebar', GRVE_THEME_TRANSLATE ),
		'right' => __( 'Right Sidebar', GRVE_THEME_TRANSLATE ),
	);

	?>
	<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
	<?php
		foreach ( $layouts as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo $key; ?>" <?php selected( $key, $layout ); ?>><?php echo $value; ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print sidebar selector
 */
function grve_print_sidebar_selection( $sidebar, $id, $name ) {
	global $wp_registered_sidebars;


	?>
	<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
		<option value="" <?php selected( '', $sidebar ); ?>><?php echo __( 'Default', GRVE_THEME_TRANSLATE ); ?></option>
	<?php
	foreach ( $wp_registered_sidebars as $key => $value ) {
		?>
		<option value="<?php echo $key; ?>" <?php selected( $key, $sidebar ); ?>><?php echo $value['name']; ?></option>
		<?php
	}
	?>
	</select>
	<?php
}

?>