<?php

/*
*	Theme update functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Envato Upgrader Check for updates
 */
function grve_envato_toolkit_update_check() {

	if ( is_super_admin() && 1 == grve_option('update_enabled') ) {

		$envato_username = grve_option('update_user_name');
		$envato_api_key = grve_option('update_api_key');
		$show_admin_notice = false;

		if ( empty( $envato_username ) || empty( $envato_api_key ) ) {
			$message = __( "To enable theme update notifications, please enter your Envato Marketplace credentials via:", GRVE_THEME_TRANSLATE ) . " " . __( "Theme Options - Theme Update", GRVE_THEME_TRANSLATE );
			$message_id = 'theme_update_error';
			$message_type = 'error';
			$show_admin_notice = true;
		} else {

			$current_screen = get_current_screen();

			if ( 'themes' == $current_screen->id || 'toplevel_page_grve_options' == $current_screen->id ) {

				// Check for updates
				$upgrader = new Envato_WordPress_Theme_Upgrader( $envato_username, $envato_api_key );
				$updates = $upgrader->check_for_theme_update( GRVE_THEME_NAME );

				$current_theme = wp_get_theme( GRVE_THEME_SHORT_NAME );
				$update_needed = false;

				//check is current theme up to date
				if ( isset($updates->updated_themes) ) {
					foreach ( $updates->updated_themes as $updated_theme ) {

						if ( $updated_theme->version == $current_theme->version && $updated_theme->name == $current_theme->name ) {
							$update_needed = true;
						}
					}
				}

				if ( !empty( $updates->errors ) ) {
					$message = __( "Theme Updater Error:", GRVE_THEME_TRANSLATE ) . implode( '<br \>', $updates->errors );
					$message_id = 'theme_update_error';
					$message_type = 'error';
					$show_admin_notice = true;
				} else if ( $update_needed ) {
					$change_log_url = "http://greatives.eu/osmosis-theme-updates/";

					$message = __( "New version of Osmosis theme is available!", GRVE_THEME_TRANSLATE ) . " " .
						__( "View", GRVE_THEME_TRANSLATE ) . " " .
						"<a href='" . $change_log_url . "' target='_blank'>" .
						__( "changelog", GRVE_THEME_TRANSLATE ) .
						"</a>.<br/>" . __( "It is recommended to make a backup before performing an update.", GRVE_THEME_TRANSLATE ) . "<br/>" .
						__( "To update click", GRVE_THEME_TRANSLATE ) . " " .
						"<a href='" . admin_url() . "themes.php?theme=" . GRVE_THEME_SHORT_NAME . "&grve-theme-update=update'>" .
						__( "here", GRVE_THEME_TRANSLATE ) .
						"</a>.";
					$message_id = 'theme_update_available';
					$message_type = 'updated';
					$show_admin_notice = true;
				}
			}
		}

		if ( $show_admin_notice ) {
			add_settings_error(
				'grve-theme-update-message',
				esc_attr( $message_id ),
				$message,
				$message_type
			);
		}
	}

}
add_action( 'admin_head', 'grve_envato_toolkit_update_check' );

/**
 * Envato Upgrader Theme Update
 */
function grve_envato_toolkit_update() {

	if ( isset($_GET['grve-theme-update']) && 'update' == $_GET['grve-theme-update'] ) {
		if ( is_super_admin() && 1 == grve_option('update_enabled') ) {

			$envato_username = grve_option('update_user_name');
			$envato_api_key = grve_option('update_api_key');

			if ( empty( $envato_username ) || empty( $envato_api_key ) ) {
				return;
			} else {
				$upgrader = new Envato_WordPress_Theme_Upgrader( $envato_username, $envato_api_key );
				$update_response = $upgrader->upgrade_theme( GRVE_THEME_NAME );
			}
			wp_safe_redirect( remove_query_arg('grve-theme-update') );
		}
	}

}
add_action( 'admin_init', 'grve_envato_toolkit_update' );

/**
 * Display theme update notices in the admin area
 */
function grve_theme_update_admin_notices() {
     settings_errors( 'grve-theme-update-message' );
}
add_action( 'admin_notices', 'grve_theme_update_admin_notices' );

?>