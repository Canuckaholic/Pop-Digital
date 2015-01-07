<?php
/*
 * Plugin Name: Osmosis Visual Composer Extension
 * Description: This plugin extends Visual Composer.
 * Author: Greatives Team
 * Author URI: http://greatives.eu
 * Version: 1.0.0
 * Text Domain: grve-osmosis-vc-extension
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'GRVE_OSMOSIS_VC_Extension_Plugin' ) ) {

	class GRVE_OSMOSIS_VC_Extension_Plugin {

		/**
		 * @action plugins_loaded
		 * @return GRVE_Osmosis_Visual_Composer_Extension_Plugin
		 * @static
		 */
		public static function init()
		{

			static $instance = false;

			if ( ! $instance ) {
				load_plugin_textdomain( 'grve-osmosis-vc-extension' , false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
				$instance = new GRVE_OSMOSIS_VC_Extension_Plugin;
			}
			return $instance;

		}

		/* Add Visual Composer Plugin*/
		public function GRVE_OSMOSIS_VC_Extension_Plugin() {

			if ( ! defined( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH' ) ) {
				define( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL' ) ) {
				define( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
			}

			if ( is_user_logged_in() ) {
				add_action( 'admin_enqueue_scripts' , $this->marshal( 'grve_vc_extension_add_scripts' ) );
			}
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-functions.php';
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-add-param.php';
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-shortcode-param.php';


			//Shortcodes
			if( function_exists( 'vc_map' ) ) {

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_title.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_divider.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_list.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_button.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_quote.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_dropcap.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_slogan.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_callout.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_progress_bar.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_pricing_table.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_message_box.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_icon_box.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_image_text.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_media_box.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_single_image.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_gallery.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_slider.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_video.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_social.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_gmap.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_team.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_blog.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_portfolio.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_testimonial.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_promo.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_counter.php';
				if ( class_exists( 'GW_GoPricing' ) ) {
					require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_go_pricing.php';
				}
			}

		}


		public function grve_vc_extension_add_scripts( $hook ) {
			wp_enqueue_style('grve-vc-awsome-fonts', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/font-awesome.min.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-elements', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-vc-elements.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-icon-box', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-icon-preview.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-multi-checkbox', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-multi-checkbox.css', array(), time(), 'all');
		}

		public function marshal( $method_name ) {
			return array( &$this , $method_name );
		}
	}

	/**
	 * Initialize the Visual Composer Extension Plugin
	 */
	add_action( 'init' , array( 'grve_osmosis_vc_extension_plugin' , 'init' ) );

}

?>