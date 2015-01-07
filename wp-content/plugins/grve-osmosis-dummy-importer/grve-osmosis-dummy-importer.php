<?php
/*
 * Plugin Name: Osmosis Demo Data Importer
 * Description: Import Osmosis Demo Content
 * Author: Greatives Team
 * Author URI: http://greatives.eu
 * Version: 1.0.0
 * Text Domain: grve-osmosis-importer
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'admin_menu', 'grve_osmosis_importer_menu_page' );
function grve_osmosis_importer_menu_page(){
	add_menu_page( 'Osmosis Demos', 'Osmosis Demos', 'manage_options', 'admin.php?import=osmosis-demo-importer', '', plugin_dir_url(__FILE__).'/assets/images/grve-import.png');
}

/** Display verbose errors */
if ( ! defined( 'GRVE_IMPORT_DEBUG' ) ) {
	define( 'GRVE_IMPORT_DEBUG', false);
}

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

if ( ! class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
		require $class_wp_importer;
}

// include WXR file parsers
require dirname( __FILE__ ) . '/parsers.php';

/**
 * Greatives Importer class for managing the import process
 */
if ( class_exists( 'WP_Importer' ) ) {
class GRVE_Osmosis_Importer extends WP_Importer {
	var $max_wxr_version = 1.2; // max. supported WXR version

	var $id; // WXR attachment ID

	// information to import from WXR file
	var $version;
	var $authors = array();
	var $posts = array();
	var $terms = array();
	var $categories = array();
	var $tags = array();
	var $base_url = '';

	// mappings from old information to new
	var $processed_authors = array();
	var $author_mapping = array();
	var $processed_terms = array();
	var $processed_posts = array();
	var $post_orphans = array();
	var $processed_menu_items = array();
	var $menu_item_orphans = array();
	var $missing_menu_items = array();

	var $fetch_attachments = false;
	var $url_remap = array();
	var $featured_images = array();

	function GRVE_Osmosis_Importer() {
		add_action( 'wp_ajax_grve_import_dummy_data', array( $this, 'grve_importer_data' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'grve_importer_scripts' ) );
	}

	/**
	 * Imports stylesheet and scripts
	 */
	function grve_importer_scripts( $hook ) {

		if ( 'admin.php' == $hook ) {

			wp_register_style( 'grve-import', plugins_url( '/assets/css/grve-import.css', __FILE__  ), array(), '1.0' );
			wp_register_style( 'grve-import-countdown', plugins_url( '/assets/css/jquery.countdown.css', __FILE__  ), array(), '1.0' );

			$grve_import_texts = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'confirmation_text' => __( "You are about to import dummy data!\nIt is recommended to clear your data first.\n\nDo you want to continue?", ' grve-osmosis-importer' ),
			);

			wp_register_script( 'grve-import-script', plugins_url( '/assets/js/grve-import.js', __FILE__  ), array( 'jquery'), false, '1.0' );
			wp_localize_script( 'grve-import-script', 'grve_import_texts', $grve_import_texts );
			wp_register_script( 'grve-import-plugin-script', plugins_url( '/assets/js/jquery.plugin.min.js', __FILE__  ), array( 'jquery'), false, '1.0' );
			wp_register_script( 'grve-import-countdown-script', plugins_url( '/assets/js/jquery.countdown.min.js', __FILE__  ), array( 'jquery'), false, '1.0' );

			wp_enqueue_style( 'grve-import' );
			wp_enqueue_style( 'grve-import-countdown' );
			wp_enqueue_script( 'grve-import-script' );
			wp_enqueue_script( 'grve-import-plugin-script' );
			wp_enqueue_script( 'grve-import-countdown-script' );
		}
	}

	/**
	 * Demo data values
 	 */
	function grve_get_demo_data() {
		$grve_dummy_data_list = array(
			array(
				'id'   => 'osmosis',
				'name' => 'Osmosis Demo',
				'dir'  => 'osmosis',
			),
			array(
				'id'   => 'osmosis-corporate',
				'name' =>  'Osmosis Corporate Demo',
				'dir'  => 'corporate',
			),
			array(
				'id'   => 'osmosis-blog',
				'name' => 'Osmosis Blog Demo',
				'dir'  => 'blog',
			),
			array(
				'id'   => 'osmosis-interior',
				'name' => 'Osmosis Interior Demo',
				'dir'  => 'interior'
			),
			array(
				'id'   => 'osmosis-photography',
				'name' => 'Osmosis Photography Demo',
				'dir'  => 'photography'
			),
			array(
				'id'   => 'osmosis-one-page',
				'name' => 'Osmosis One Page Demo',
				'dir'  => 'one-page'
			),
		);

		return $grve_dummy_data_list;
	}

	/**
	 * Imports dummy data ( Central function )
 	 */
	function grve_importer_data() {

		$importer_info = '';

		if ( isset( $_POST['grve_import_data'] ) ) {

			ob_start();

			$dummy_id = $_POST['grve_import_data'];
			$grve_importer_error = false;
			$grve_changed = false;
			check_ajax_referer( $dummy_id, 'nonce', true );
			echo '<br />';

			if ( function_exists( 'grve_theme_osmosis_info') ) {
				//Import Dummy Data
				if ( isset( $_POST['grve_import_content'] ) && 'true' == $_POST['grve_import_content'] ) {
					$grve_changed = true;
					$import_file = plugin_dir_path(__FILE__) . 'import/data/' . $dummy_id  .  '/dummy.xml.gz';

					if ( empty( $import_file ) || ! file_exists( $import_file ) ) {
						$grve_importer_error = true;
						$importer_info.=  '<i class="dashicons dashicons-no"></i> ' . __( "Dummy Content: File empty ot not existing!", 'grve-osmosis-importer' );
						$importer_info.=  '<br />';
					} else {
						set_time_limit(0);
						$this->fetch_attachments = true;

						$import_output = $this->import( $import_file );

						if ( is_wp_error( $import_output ) ) {
							$grve_importer_error = true;
							$importer_info.=  '<i class="dashicons dashicons-no"></i> ' . __( "Dummy Content: Error During Import!", ' grve-osmosis-importer' );
							$importer_info.=  '<br />';
						} else {

							$grve_menus  = wp_get_nav_menus();
							$locations = get_theme_mod( 'nav_menu_locations' );
							if( ! empty( $grve_menus ) ) {

								foreach ( $grve_menus as $grve_menu ) {

									if( 'main-menu' == $grve_menu->slug ) {
										$locations['grve_header_nav'] = $grve_menu->term_id;
									}
									if( 'bottom-menu' == $grve_menu->slug ) {
										$locations['grve_footer_nav'] = $grve_menu->term_id;
									}

								}
								set_theme_mod( 'nav_menu_locations', $locations );
							}

							//Set Home page
							$homepage = get_page_by_title( 'home' );
							if ( $homepage ) {
								update_option( 'page_on_front', $homepage->ID );
								update_option( 'show_on_front', 'page' );
							}

							//Import Revolution Slider
							if ( class_exists('RevSlider') ) {
								$import_file = plugin_dir_path(__FILE__) . 'import/data/' . $dummy_id  .  '/rev-slider.zip';
								if ( empty( $import_file ) || ! file_exists( $import_file ) ) {
									//No revolution slider available for this demo
								} else {
									$revslider = new RevSlider();
									$revslider->importSliderFromPost( false, false, $import_file );
								}
							}

							$importer_info.=  '<i class="dashicons dashicons-yes"></i> ' . __( "Dummy Content: imported!", ' grve-osmosis-importer' );
							$importer_info.=  '<br />';
						}
					}
				}

				//Import Theme Options
				if ( isset( $_POST['grve_import_options'] ) && 'true' == $_POST['grve_import_options'] ) {
					$grve_changed = true;
					$import_file = plugin_dir_path(__FILE__) . 'import/data/' . $dummy_id  .  '/grve-options.json';
					if ( empty( $import_file ) || ! file_exists( $import_file ) ) {
						$grve_importer_error = true;
						$importer_info.=  '<i class="dashicons dashicons-no"></i> ' . __( "Theme Options: file empty ot not existing!", ' grve-osmosis-importer' );
						$importer_info.=  '<br/>';
					} else {
						if ( $this->grve_import_options( $import_file ) ) {
							$importer_info.=  '<i class="dashicons dashicons-yes"></i> ' . __( "Theme Options: imported!", ' grve-osmosis-importer' );
							$importer_info.=  '<br/>';
						}
					}
				}

				//Import Widgets
				if ( isset( $_POST['grve_import_widgets'] ) && 'true' == $_POST['grve_import_widgets'] ) {
					$grve_changed = true;
					$import_file = plugin_dir_path(__FILE__) . 'import/data/' . $dummy_id  .  '/widget_data.json';
					if ( empty( $import_file ) || ! file_exists( $import_file ) ) {
						$importer_info.=  '<i class="dashicons dashicons-info"></i> ' . __( "Widgets: no widgets available for this Demo!", ' grve-osmosis-importer' );
						$importer_info.=  '<br/>';
					} else {
						if ( $this->grve_import_demo_widgets( $import_file ) ) {
							$importer_info.=  '<i class="dashicons dashicons-yes"></i> ' . __( "Widgets: imported!", ' grve-osmosis-importer' );
							$importer_info.=  '<br/>';
						}
					}
				}

				if ( !$grve_importer_error ) {
					if( $grve_changed ) {
						$importer_info.=  '<br/>';
						$importer_info.=  '<i class="dashicons dashicons-yes"></i> <b>' .  __( "Import finished!", ' grve-osmosis-importer' ) . '</b>';
						$importer_info.=  ' <a href="' . home_url() . '">' .  __( "Visit Site", ' grve-osmosis-importer' ) . '</a>';
						$importer_info.=  '<br/>';
					} else {
						$importer_info.=  '<i class="dashicons dashicons-info"></i> <b>' .  __( "No options selected, please select some options and press the import button!", ' grve-osmosis-importer' ) . '</b>';
						$importer_info.=  '<br/>';
					}
				} else {
					$importer_info.=  '<br/>';
					$importer_info.=  '<i class="dashicons dashicons-no"></i> <b>' .  __( "Import finished with errors!", ' grve-osmosis-importer' ) . '</b>';
					$importer_info.=  ' <a href="' . home_url() . '">' .  __( "Visit Site", ' grve-osmosis-importer' ) . '</a>';
					$importer_info.=  '<br/>';
				}
			} else {
					$importer_info.=  '<i class="dashicons dashicons-no"></i> <b>' .  __( "Osmosis Theme is not activated! Osmosis Theme needs to be installed and activated!", ' grve-osmosis-importer' ) . '</b>';
					$importer_info.=  '<br/>';
			}

			$importer_output = "";
			$importer_debug_output = ob_get_clean();

			if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
				$importer_output = $importer_debug_output;
			}

			$response = array(
				'errors' => $grve_importer_error,
				'changed' => $grve_changed,
				'info' => $importer_info,
				'output' => $importer_output,
			);
			wp_send_json( $response );

		}
		if ( isset( $_POST['grve_import_data'] ) ) { die(); }
	}

	/**
	 * Additional function to get a new widget name
	 * Used from grve_import_demo_widgets
 	 */
	function grve_get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( ! empty( $widgets ) && is_array( $widgets ) && 'wp_inactive_widgets' != $sidebar ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}

	/**
	 * Imports widgets from file
 	 */
	function grve_import_demo_widgets( $import_file ) {

		if ( file_exists( $import_file ) ){

			$import_array = file_get_contents( $import_file );
			$import_array = json_decode( $import_array, true );

			$sidebars_data = $import_array[0];
			$widget_data = $import_array[1];
			$new_widgets = array( );

			//Get Existing Custom sidebars
			$grve_custom_sidebars = get_option( 'grve-osmosis-custom-sidebars' );
			if ( empty( $grve_custom_sidebars ) ) {
				$grve_custom_sidebars = array();
			}

			$custom_sidebars_ids = array();
			if ( ! empty( $grve_custom_sidebars ) ) {
				foreach ( $grve_custom_sidebars as $grve_custom_sidebar ) {
					array_push( $custom_sidebars_ids, $grve_custom_sidebar['id'] );
				}
			}

			$current_sidebars = wp_get_sidebars_widgets();

			$current_sidebars['grve-single-portfolio-sidebar'] = array();
			$current_sidebars['grve-woocommerce-sidebar-shop'] = array();
			$current_sidebars['grve-woocommerce-sidebar-product'] = array();
			$current_sidebars['grve-footer-1-sidebar'] = array();
			$current_sidebars['grve-footer-2-sidebar'] = array();
			$current_sidebars['grve-footer-3-sidebar'] = array();
			$current_sidebars['grve-footer-4-sidebar'] = array();

			//Check if includes custom sidebars
			$sidebar_index = 0;
			$new_sidebars = false;

			foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

				if( strpos( $import_sidebar, "grve_sidebar_" ) !== false ) {
					if ( !in_array( $import_sidebar, $custom_sidebars_ids ) ) {
						$sidebar_index++;
						$this_sidebar = array ( 'id' => $import_sidebar , 'name' => "Demo Sidebar " . $sidebar_index );
						array_push( $grve_custom_sidebars, $this_sidebar );
						if( ! isset( $current_sidebars[ $import_sidebar ] ) ) {
							$current_sidebars[ $import_sidebar ] = array();
						}
						$new_sidebars = true;
					}
				}

			endforeach;

			//Update and Register Custom Sidebars if needed
			if ( ! empty( $grve_custom_sidebars ) && $new_sidebars ) {
				update_option( 'grve-osmosis-custom-sidebars', $grve_custom_sidebars );
				wp_set_sidebars_widgets( $current_sidebars );
			}

			//Get Current Sidebars and Widgets
			$current_sidebars = wp_get_sidebars_widgets();

			//Import Widget Data
			foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

				foreach ( $import_widgets as $import_widget ) :
					//if the sidebar exists
					if ( isset( $current_sidebars[$import_sidebar] ) ) :
						$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
						$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
						$current_widget_data = get_option( 'widget_' . $title );
						$new_widget_name = $this->grve_get_new_widget_name( $title, $index );
						$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

						if ( ! empty( $new_widgets[ $title ] ) && is_array( $new_widgets[ $title ] ) ) {
							while ( array_key_exists( $new_index, $new_widgets[ $title ] ) ) {
								$new_index++;
							}
						}
						$current_sidebars[ $import_sidebar ][] = $title . '-' . $new_index;
						if ( array_key_exists( $title, $new_widgets ) ) {
							$new_widgets[$title][ $new_index ] = $widget_data[ $title ][ $index ];
							$multiwidget = $new_widgets[ $title ]['_multiwidget'];
							unset( $new_widgets[ $title ]['_multiwidget'] );
							$new_widgets[ $title ]['_multiwidget'] = $multiwidget;
						} else {
							$current_widget_data[ $new_index ] = $widget_data[ $title ][ $index ];
							$current_multiwidget = '';
							if ( isset($current_widget_data['_multiwidget'] ) ) {
								$current_multiwidget = $current_widget_data['_multiwidget'];
							}
							$new_multiwidget = $widget_data[ $title ]['_multiwidget'];
							$multiwidget = ( $current_multiwidget != $new_multiwidget ) ? $current_multiwidget : 1;
							unset( $current_widget_data['_multiwidget'] );
							$current_widget_data['_multiwidget'] = $multiwidget;
							$new_widgets[ $title ] = $current_widget_data;
						}

					endif;
				endforeach;
			endforeach;

			if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
				wp_set_sidebars_widgets( $current_sidebars );

				foreach ( $new_widgets as $title => $content )
					update_option( 'widget_' . $title, $content );

				return true;
			}

			return false;

		}
		else{
			return false; //Widget File not found
		}
	}

	/**
	 * Imports theme options from file ( Redux Framework )
 	 */
	function grve_import_options( $import_file ) {
		global $grveReduxFramework;

		$import_array = file_get_contents( $import_file );

		if ( !empty( $import_array ) ) {

			$imported_options = array();
			$imported_options = json_decode( htmlspecialchars_decode( $import_array ), true );

			foreach($imported_options as $key => $value) {
				$grveReduxFramework->ReduxFramework->set($key, $value);
			}

		} else {
			return false;
		}

		return true;
	}

	/**
	 * Registered callback function for the WordPress Importer
	 *
	 * Manages the three separate stages of the WXR import process
	 */
	function dispatch() {
		$this->header();

		$step = empty( $_GET['step'] ) ? 0 : (int) $_GET['step'];
		switch ( $step ) {
			case 0:
				$this->greet();
				break;
		}

		$this->footer();
	}

	/**
	 * The main controller for the actual import stage.
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import( $file ) {
		add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );

		$this->import_start( $file );

		wp_suspend_cache_invalidation( true );
		$this->process_categories();
		$this->process_tags();
		$this->process_terms();
		$this->process_posts();
		wp_suspend_cache_invalidation( false );

		// update incorrect/missing information in the DB
		$this->backfill_parents();
		$this->backfill_attachment_urls();
		$this->remap_featured_images();

		$this->import_end();
	}

	/**
	 * Parses the WXR file and prepares us for the task of processing parsed data
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import_start( $file ) {
		if ( ! is_file($file) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', ' grve-osmosis-importer' ) . '</strong><br />';
			echo __( 'The file does not exist, please try again.', ' grve-osmosis-importer' ) . '</p>';
			$this->footer();
			die();
		}

		$import_data = $this->parse( $file );

		if ( is_wp_error( $import_data ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', ' grve-osmosis-importer' ) . '</strong><br />';
			echo esc_html( $import_data->get_error_message() ) . '</p>';
			$this->footer();
			die();
		}

		$this->version = $import_data['version'];
		$this->get_authors_from_import( $import_data );
		$this->posts = $import_data['posts'];
		$this->terms = $import_data['terms'];
		$this->categories = $import_data['categories'];
		$this->tags = $import_data['tags'];
		$this->base_url = esc_url( $import_data['base_url'] );

		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );

		do_action( 'import_start' );
	}

	/**
	 * Performs post-import cleanup of files and the cache
	 */
	function import_end() {
		wp_import_cleanup( $this->id );

		wp_cache_flush();
		foreach ( get_taxonomies() as $tax ) {
			delete_option( "{$tax}_children" );
			_get_term_hierarchy( $tax );
		}

		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );

		do_action( 'import_end' );
	}

	/**
	 * Handles the WXR upload and initial parsing of the file to prepare for
	 * displaying author import options
	 *
	 * @return bool False if error uploading or invalid file, true otherwise
	 */
	function handle_upload() {
		$file = wp_import_handle_upload();

		if ( isset( $file['error'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', ' grve-osmosis-importer' ) . '</strong><br />';
			echo esc_html( $file['error'] ) . '</p>';
			return false;
		} else if ( ! file_exists( $file['file'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', ' grve-osmosis-importer' ) . '</strong><br />';
			printf( __( 'The export file could not be found at <code>%s</code>. It is likely that this was caused by a permissions problem.', ' grve-osmosis-importer' ), esc_html( $file['file'] ) );
			echo '</p>';
			return false;
		}

		$this->id = (int) $file['id'];
		$import_data = $this->parse( $file['file'] );
		if ( is_wp_error( $import_data ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', ' grve-osmosis-importer' ) . '</strong><br />';
			echo esc_html( $import_data->get_error_message() ) . '</p>';
			return false;
		}

		$this->version = $import_data['version'];
		if ( $this->version > $this->max_wxr_version ) {
			echo '<div class="error"><p><strong>';
			printf( __( 'This WXR file (version %s) may not be supported by this version of the importer. Please consider updating.', ' grve-osmosis-importer' ), esc_html($import_data['version']) );
			echo '</strong></p></div>';
		}

		$this->get_authors_from_import( $import_data );

		return true;
	}

	/**
	 * Retrieve authors from parsed WXR data
	 *
	 * Uses the provided author information from WXR 1.1 files
	 * or extracts info from each post for WXR 1.0 files
	 *
	 * @param array $import_data Data returned by a WXR parser
	 */
	function get_authors_from_import( $import_data ) {
		if ( ! empty( $import_data['authors'] ) ) {
			$this->authors = $import_data['authors'];
		// no author information, grab it from the posts
		} else {
			foreach ( $import_data['posts'] as $post ) {
				$login = sanitize_user( $post['post_author'], true );
				if ( empty( $login ) ) {
					printf( __( 'Failed to import author %s. Their posts will be attributed to the current user.', ' grve-osmosis-importer' ), esc_html( $post['post_author'] ) );
					echo '<br />';
					continue;
				}

				if ( ! isset($this->authors[$login]) )
					$this->authors[$login] = array(
						'author_login' => $login,
						'author_display_name' => $post['post_author']
					);
			}
		}
	}

	/**
	 * Create new categories based on import information
	 *
	 * Doesn't create a new category if its slug already exists
	 */
	function process_categories() {
		$this->categories = apply_filters( 'wp_import_categories', $this->categories );

		if ( empty( $this->categories ) )
			return;

		foreach ( $this->categories as $cat ) {
			// if the category already exists leave it alone
			$term_id = term_exists( $cat['category_nicename'], 'category' );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($cat['term_id']) )
					$this->processed_terms[intval($cat['term_id'])] = (int) $term_id;
				continue;
			}

			$category_parent = empty( $cat['category_parent'] ) ? 0 : category_exists( $cat['category_parent'] );
			$category_description = isset( $cat['category_description'] ) ? $cat['category_description'] : '';
			$catarr = array(
				'category_nicename' => $cat['category_nicename'],
				'category_parent' => $category_parent,
				'cat_name' => $cat['cat_name'],
				'category_description' => $category_description
			);

			$id = wp_insert_category( $catarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($cat['term_id']) )
					$this->processed_terms[intval($cat['term_id'])] = $id;
			} else {
				if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
					printf( __( 'Failed to import category %s', ' grve-osmosis-importer' ), esc_html($cat['category_nicename']) );
					echo ': ' . $id->get_error_message();
					echo '<br />';
				}
				continue;
			}
		}

		unset( $this->categories );
	}

	/**
	 * Create new post tags based on import information
	 *
	 * Doesn't create a tag if its slug already exists
	 */
	function process_tags() {
		$this->tags = apply_filters( 'wp_import_tags', $this->tags );

		if ( empty( $this->tags ) )
			return;

		foreach ( $this->tags as $tag ) {
			// if the tag already exists leave it alone
			$term_id = term_exists( $tag['tag_slug'], 'post_tag' );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($tag['term_id']) )
					$this->processed_terms[intval($tag['term_id'])] = (int) $term_id;
				continue;
			}

			$tag_desc = isset( $tag['tag_description'] ) ? $tag['tag_description'] : '';
			$tagarr = array( 'slug' => $tag['tag_slug'], 'description' => $tag_desc );

			$id = wp_insert_term( $tag['tag_name'], 'post_tag', $tagarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($tag['term_id']) )
					$this->processed_terms[intval($tag['term_id'])] = $id['term_id'];
			} else {
				printf( __( 'Failed to import post tag %s', ' grve-osmosis-importer' ), esc_html($tag['tag_name']) );
				if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG )
					echo ': ' . $id->get_error_message();
				echo '<br />';
				continue;
			}
		}

		unset( $this->tags );
	}

	/**
	 * Create new terms based on import information
	 *
	 * Doesn't create a term its slug already exists
	 */
	function process_terms() {
		$this->terms = apply_filters( 'wp_import_terms', $this->terms );

		if ( empty( $this->terms ) )
			return;

		foreach ( $this->terms as $term ) {
			// if the term already exists in the correct taxonomy leave it alone
			$term_id = term_exists( $term['slug'], $term['term_taxonomy'] );
			if ( $term_id ) {
				if ( is_array($term_id) ) $term_id = $term_id['term_id'];
				if ( isset($term['term_id']) )
					$this->processed_terms[intval($term['term_id'])] = (int) $term_id;
				continue;
			}

			if ( empty( $term['term_parent'] ) ) {
				$parent = 0;
			} else {
				$parent = term_exists( $term['term_parent'], $term['term_taxonomy'] );
				if ( is_array( $parent ) ) $parent = $parent['term_id'];
			}
			$description = isset( $term['term_description'] ) ? $term['term_description'] : '';
			$termarr = array( 'slug' => $term['slug'], 'description' => $description, 'parent' => intval($parent) );

			$id = wp_insert_term( $term['term_name'], $term['term_taxonomy'], $termarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset($term['term_id']) )
					$this->processed_terms[intval($term['term_id'])] = $id['term_id'];
			} else {
				if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
					printf( __( 'Failed to import %s %s', ' grve-osmosis-importer' ), esc_html($term['term_taxonomy']), esc_html($term['term_name']) );
					echo ': ' . $id->get_error_message();
					echo '<br />';
				}
				continue;
			}
		}

		unset( $this->terms );
	}

	/**
	 * Remap Categories in shortcodes
	 *
	 */
	function grve_categories_callback($matches)
	{
		$matches[0] = '';
		foreach( $matches as $match ){
			$cats = explode(",", $match);
			$new_cats = array();
			foreach( $cats as $cat ){
				if ( isset( $this->processed_terms[intval($cat)] ) ) {
					array_push($new_cats, $this->processed_terms[intval($cat)]);
				}
			}
			if(!empty($new_cats)){
				$matches[0] .= 'categories="' . implode(",", $new_cats) . '"';
			}
		}
		return $matches[0];
	}

	/**
	 * Create new posts based on import information
	 *
	 * Posts marked as having a parent which doesn't exist will become top level items.
	 * Doesn't create a new post if: the post type doesn't exist, the given post ID
	 * is already noted as imported or a post with the same title and date already exists.
	 * Note that new/updated terms, comments and meta are imported for the last of the above.
	 */

	function process_posts() {
		$this->posts = apply_filters( 'wp_import_posts', $this->posts );

		foreach ( $this->posts as $post ) {
			$post = apply_filters( 'wp_import_post_data_raw', $post );

			if ( ! post_type_exists( $post['post_type'] ) ) {
				if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
					printf( __( 'Failed to import &#8220;%s&#8221;: Invalid post type %s', ' grve-osmosis-importer' ),
						esc_html($post['post_title']), esc_html($post['post_type']) );
					echo '<br />';
				}
				do_action( 'wp_import_post_exists', $post );
				continue;
			}

			if ( isset( $this->processed_posts[$post['post_id']] ) && ! empty( $post['post_id'] ) )
				continue;

			if ( $post['status'] == 'auto-draft' )
				continue;

			if ( 'nav_menu_item' == $post['post_type'] ) {
				$this->process_menu_item( $post );
				continue;
			}

			$post_type_object = get_post_type_object( $post['post_type'] );
			$post_exists = post_exists( $post['post_title'], '', $post['post_date'] );

			if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {
				if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
					printf( __('%s &#8220;%s&#8221; already exists.', ' grve-osmosis-importer'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
					echo '<br />';
				}
				$comment_post_ID = $post_id = $post_exists;
			} else {
				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( isset( $this->processed_posts[$post_parent] ) ) {
						$post_parent = $this->processed_posts[$post_parent];
					// otherwise record the parent for later
					} else {
						$this->post_orphans[intval($post['post_id'])] = $post_parent;
						$post_parent = 0;
					}
				}

				// map the post author
				$author = sanitize_user( $post['post_author'], true );
				if ( isset( $this->author_mapping[$author] ) )
					$author = $this->author_mapping[$author];
				else
					$author = (int) get_current_user_id();

				//Remap Categories
				$pattern = '|categories="([^"]*)"|';
				$post['post_content'] = preg_replace_callback($pattern, "self::grve_categories_callback", $post['post_content']);

				if ( 'attachment' != $post['post_type'] ) {
					$post['guid'] = '';
				}
				$postdata = array(
					'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
					'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $post['post_content'],
					'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
					'post_status' => $post['status'], 'post_name' => $post['post_name'],
					'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
					'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
					'post_type' => $post['post_type'], 'post_password' => $post['post_password']
				);

				$original_post_ID = $post['post_id'];
				$postdata = apply_filters( 'wp_import_post_data_processed', $postdata, $post );

				if ( 'attachment' == $postdata['post_type'] ) {

					$real_remote_url = ! empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid'];
					$remote_url = ! empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid'];

					//Greatives Demo Dummy Image
					$parts = pathinfo( $remote_url );
					if ( 'jpg' == $parts['extension'] || 'png' == $parts['extension'] || 'gif' == $parts['extension'] ) {
						$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image.png', __FILE__ );
						$postdata['upload_date'] = '2000/01';

						if ( isset( $post['postmeta'] ) ) {
							foreach( $post['postmeta'] as $meta ) {
								if ( $meta['key'] == '_wp_attachment_metadata' ) {
									$metavalue = maybe_unserialize( $meta['value'] );

									$width = $metavalue['width'];
									$height = $metavalue['height'];
									if ( $width <= 80 ) {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image-extra-small.png', __FILE__ );
									} else if ( $width <= 120 ) {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image-extra-small@2x.png', __FILE__ );
									} else if ( $width <= 200 ) {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image-small.png', __FILE__ );
									} else if ( $width <= 400 ) {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image-medium.png', __FILE__ );
									} else if ( $width <= 800 ) {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image-large.png', __FILE__ );
									} else {
										$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-image.png', __FILE__ );
									}
								}
							}
						}

					} elseif ( 'mp4' == $parts['extension'] || 'webm' == $parts['extension'] || 'ogv' == $parts['extension'] ) {
						$remote_url = plugins_url( '/import/dummy/grve-dummy-sample-video.' . $parts['extension'] , __FILE__ );
						$postdata['upload_date'] = '2000/01';
					} else {

						// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
						// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
						$postdata['upload_date'] = $post['post_date'];
						if ( isset( $post['postmeta'] ) ) {
							foreach( $post['postmeta'] as $meta ) {
								if ( $meta['key'] == '_wp_attached_file' ) {
									if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) )
										$postdata['upload_date'] = $matches[0];
									break;
								}
							}
						}
					}

					$comment_post_ID = $post_id = $this->process_attachment( $postdata, $remote_url, $real_remote_url );
				} else {
					$comment_post_ID = $post_id = wp_insert_post( $postdata, true );
					do_action( 'wp_import_insert_post', $post_id, $original_post_ID, $postdata, $post );
				}

				if ( is_wp_error( $post_id ) ) {
					if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
						printf( __( 'Failed to import %s &#8220;%s&#8221;', ' grve-osmosis-importer' ),
						$post_type_object->labels->singular_name, esc_html($post['post_title']) );
						echo ': ' . $post_id->get_error_message();
						echo '<br />';
					}
					continue;
				}

				if ( $post['is_sticky'] == 1 )
					stick_post( $post_id );
			}

			// map pre-import ID to local ID
			$this->processed_posts[intval($post['post_id'])] = (int) $post_id;

			if ( ! isset( $post['terms'] ) )
				$post['terms'] = array();

			$post['terms'] = apply_filters( 'wp_import_post_terms', $post['terms'], $post_id, $post );

			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$terms_to_set = array();
				foreach ( $post['terms'] as $term ) {
					// back compat with WXR 1.0 map 'tag' to 'post_tag'
					$taxonomy = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
					$term_exists = term_exists( $term['slug'], $taxonomy );
					$term_id = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
					if ( ! $term_id ) {
						$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
						if ( ! is_wp_error( $t ) ) {
							$term_id = $t['term_id'];
							do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
						} else {
							if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
								printf( __( 'Failed to import %s %s', ' grve-osmosis-importer' ), esc_html($taxonomy), esc_html($term['name']) );
								echo ': ' . $t->get_error_message();
								echo '<br />';
							}
							do_action( 'wp_import_insert_term_failed', $t, $term, $post_id, $post );
							continue;
						}
					}
					$terms_to_set[$taxonomy][] = intval( $term_id );
				}

				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
					do_action( 'wp_import_set_post_terms', $tt_ids, $ids, $tax, $post_id, $post );
				}
				unset( $post['terms'], $terms_to_set );
			}

			if ( ! isset( $post['comments'] ) )
				$post['comments'] = array();

			$post['comments'] = apply_filters( 'wp_import_post_comments', $post['comments'], $post_id, $post );

			// add/update comments
			if ( ! empty( $post['comments'] ) ) {
				$num_comments = 0;
				$inserted_comments = array();
				foreach ( $post['comments'] as $comment ) {
					$comment_id	= $comment['comment_id'];
					$newcomments[$comment_id]['comment_post_ID']      = $comment_post_ID;
					$newcomments[$comment_id]['comment_author']       = $comment['comment_author'];
					$newcomments[$comment_id]['comment_author_email'] = $comment['comment_author_email'];
					$newcomments[$comment_id]['comment_author_IP']    = $comment['comment_author_IP'];
					$newcomments[$comment_id]['comment_author_url']   = $comment['comment_author_url'];
					$newcomments[$comment_id]['comment_date']         = $comment['comment_date'];
					$newcomments[$comment_id]['comment_date_gmt']     = $comment['comment_date_gmt'];
					$newcomments[$comment_id]['comment_content']      = $comment['comment_content'];
					$newcomments[$comment_id]['comment_approved']     = $comment['comment_approved'];
					$newcomments[$comment_id]['comment_type']         = $comment['comment_type'];
					$newcomments[$comment_id]['comment_parent'] 	  = $comment['comment_parent'];
					$newcomments[$comment_id]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
					if ( isset( $this->processed_authors[$comment['comment_user_id']] ) )
						$newcomments[$comment_id]['user_id'] = $this->processed_authors[$comment['comment_user_id']];
				}
				ksort( $newcomments );

				foreach ( $newcomments as $key => $comment ) {
					// if this is a new post we can skip the comment_exists() check
					if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
						if ( isset( $inserted_comments[$comment['comment_parent']] ) )
							$comment['comment_parent'] = $inserted_comments[$comment['comment_parent']];
						$comment = wp_filter_comment( $comment );
						$inserted_comments[$key] = wp_insert_comment( $comment );
						do_action( 'wp_import_insert_comment', $inserted_comments[$key], $comment, $comment_post_ID, $post );

						foreach( $comment['commentmeta'] as $meta ) {
							$value = maybe_unserialize( $meta['value'] );
							add_comment_meta( $inserted_comments[$key], $meta['key'], $value );
						}

						$num_comments++;
					}
				}
				unset( $newcomments, $inserted_comments, $post['comments'] );
			}

			if ( ! isset( $post['postmeta'] ) )
				$post['postmeta'] = array();

			$post['postmeta'] = apply_filters( 'wp_import_post_meta', $post['postmeta'], $post_id, $post );

			// add/update post meta
			if ( ! empty( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					$key = apply_filters( 'import_post_meta_key', $meta['key'], $post_id, $post );
					$value = false;

					if ( '_edit_last' == $key ) {
						if ( isset( $this->processed_authors[intval($meta['value'])] ) )
							$value = $this->processed_authors[intval($meta['value'])];
						else
							$key = false;
					}

					if ( $key ) {
						// export gets meta straight from the DB so could have a serialized string
						if ( ! $value )
							$value = maybe_unserialize( $meta['value'] );

						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );

						// if the post has a featured image, take note of this in case of remap
						if ( '_thumbnail_id' == $key )
							$this->featured_images[$post_id] = (int) $value;
					}
				}
			}
		}

		unset( $this->posts );
	}

	/**
	 * Attempt to create a new menu item from import data
	 *
	 * Fails for draft, orphaned menu items and those without an associated nav_menu
	 * or an invalid nav_menu term. If the post type or term object which the menu item
	 * represents doesn't exist then the menu item will not be imported (waits until the
	 * end of the import to retry again before discarding).
	 *
	 * @param array $item Menu item details from WXR file
	 */
	function process_menu_item( $item ) {
		// skip draft, orphaned menu items
		if ( 'draft' == $item['status'] )
			return;

		$menu_slug = false;
		if ( isset($item['terms']) ) {
			// loop through terms, assume first nav_menu term is correct menu
			foreach ( $item['terms'] as $term ) {
				if ( 'nav_menu' == $term['domain'] ) {
					$menu_slug = $term['slug'];
					break;
				}
			}
		}

		// no nav_menu term associated with this menu item
		if ( ! $menu_slug ) {
			if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
				_e( 'Menu item skipped due to missing menu slug', ' grve-osmosis-importer' );
				echo '<br />';
			}
			return;
		}

		$menu_id = term_exists( $menu_slug, 'nav_menu' );
		if ( ! $menu_id ) {
			if ( defined('GRVE_IMPORT_DEBUG') && GRVE_IMPORT_DEBUG ) {
				printf( __( 'Menu item skipped due to invalid menu slug: %s', ' grve-osmosis-importer' ), esc_html( $menu_slug ) );
				echo '<br />';
			}
			return;
		} else {
			$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
		}

		foreach ( $item['postmeta'] as $meta )
			$$meta['key'] = $meta['value'];

		if ( 'taxonomy' == $_menu_item_type && isset( $this->processed_terms[intval($_menu_item_object_id)] ) ) {
			$_menu_item_object_id = $this->processed_terms[intval($_menu_item_object_id)];
		} else if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[intval($_menu_item_object_id)] ) ) {
			$_menu_item_object_id = $this->processed_posts[intval($_menu_item_object_id)];
		} else if ( 'custom' != $_menu_item_type ) {
			// associated object is missing or not imported yet, we'll retry later
			$this->missing_menu_items[] = $item;
			return;
		}

		if ( isset( $this->processed_menu_items[intval($_menu_item_menu_item_parent)] ) ) {
			$_menu_item_menu_item_parent = $this->processed_menu_items[intval($_menu_item_menu_item_parent)];
		} else if ( $_menu_item_menu_item_parent ) {
			$this->menu_item_orphans[intval($item['post_id'])] = (int) $_menu_item_menu_item_parent;
			$_menu_item_menu_item_parent = 0;
		}

		// wp_update_nav_menu_item expects CSS classes as a space separated string
		$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
		if ( is_array( $_menu_item_classes ) )
			$_menu_item_classes = implode( ' ', $_menu_item_classes );

		$args = array(
			'menu-item-object-id' => $_menu_item_object_id,
			'menu-item-object' => $_menu_item_object,
			'menu-item-parent-id' => $_menu_item_menu_item_parent,
			'menu-item-position' => intval( $item['menu_order'] ),
			'menu-item-type' => $_menu_item_type,
			'menu-item-title' => $item['post_title'],
			'menu-item-url' => $_menu_item_url,
			'menu-item-description' => $item['post_content'],
			'menu-item-attr-title' => $item['post_excerpt'],
			'menu-item-target' => $_menu_item_target,
			'menu-item-classes' => $_menu_item_classes,
			'menu-item-xfn' => $_menu_item_xfn,
			'menu-item-status' => $item['status']
		);

		$id = wp_update_nav_menu_item( $menu_id, 0, $args );
		if ( $id && ! is_wp_error( $id ) )
			$this->processed_menu_items[intval($item['post_id'])] = (int) $id;
	}

	/**
	 * If fetching attachments is enabled then attempt to create a new attachment
	 *
	 * @param array $post Attachment post details from WXR
	 * @param string $url URL to fetch attachment from ( Dummy )
	 * @param string $real_url URL to fetch attachment from
	 * @return int|WP_Error Post ID on success, WP_Error otherwise
	 */
	function process_attachment( $post, $url, $real_url ) {
		if ( ! $this->fetch_attachments )
			return new WP_Error( 'attachment_processing_error',
				__( 'Fetching attachments is not enabled', ' grve-osmosis-importer' ) );

		// if the URL is absolute, but does not contain address, then upload it assuming base_site_url
		if ( preg_match( '|^/[\w\W]+$|', $url ) )
			$url = rtrim( $this->base_url, '/' ) . $url;

		if ( preg_match( '|^/[\w\W]+$|', $real_url ) )
			$real_url = rtrim( $this->base_url, '/' ) . $real_url;

		$upload = $this->fetch_remote_file( $url, $real_url, $post );

		if ( is_wp_error( $upload ) ) {
			return $upload;
		}
		if ( $info = wp_check_filetype( $upload['file'] ) )
			$post['post_mime_type'] = $info['type'];
		else
			return new WP_Error( 'attachment_processing_error', __('Invalid file type', ' grve-osmosis-importer') );

		$post['guid'] = $upload['url'];

		// as per wp-admin/includes/upload.php
		$post_id = wp_insert_attachment( $post, $upload['file'] );
		if ( isset( $upload['metadata'] ) && !empty( $upload['metadata'] ) ) {
			wp_update_attachment_metadata( $post_id, $upload['metadata'] );
		} else {
			wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );
		}

		// remap resized image URLs, works by stripping the extension and remapping the URL stub.
		if ( preg_match( '!^image/!', $info['type'] ) ) {
			$parts = pathinfo( $url );
			$name = basename( $parts['basename'], ".{$parts['extension']}" ); // PATHINFO_FILENAME in PHP 5.2

			$parts_new = pathinfo( $upload['url'] );
			$name_new = basename( $parts_new['basename'], ".{$parts_new['extension']}" );

			$this->url_remap[$parts['dirname'] . '/' . $name] = $parts_new['dirname'] . '/' . $name_new;
		}

		return $post_id;
	}

	/**
	 * Attempt to download a remote file attachment
	 *
	 * @param string $url URL of item to fetch
	 * @param array $post Attachment details
	 * @return array|WP_Error Local file location details on success, WP_Error otherwise
	 */
	function fetch_remote_file( $url, $real_url, $post ) {
		// extract the file name and extension from the url
		$file_name = basename( $url );

		//Check if attachment already uploaded
		$upload_dir = wp_upload_dir( $post['upload_date'] );
		$upload_file_dir = $upload_dir['path'] . '/' . $file_name;
		if( file_exists( $upload_file_dir ) ) {
			$upload_file_url = $upload_dir['url'] . '/' . $file_name;

			$import_file = plugin_dir_path(__FILE__) . 'import/dummy/' . $file_name . '.json' ;
			$meta_array = array();
			if ( file_exists( $import_file ) ) {
				$import_array = file_get_contents( $import_file );
				$meta_array = json_decode( $import_array, true );
			}

			$upload = array(
				'file' => $upload_file_dir,
				'url' => $upload_file_url,
				'metadata' => $meta_array,
				'error' => false,
			);
		} else {
			// get placeholder file in the upload dir with a unique, sanitized filename
			$upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );

			if ( $upload['error'] )
				return new WP_Error( 'upload_dir_error', $upload['error'] );

			// fetch the remote url and write it to the placeholder file
			$headers = wp_get_http( $url, $upload['file'] );

			// request failed
			if ( ! $headers ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', __('Remote server did not respond', ' grve-osmosis-importer') );
			}

			// make sure the fetch was successful
			if ( $headers['response'] != '200' ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', ' grve-osmosis-importer'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
			}

			$filesize = filesize( $upload['file'] );

			if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', __('Remote file is incorrect size', ' grve-osmosis-importer') );
			}

			if ( 0 == $filesize ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', __('Zero size file downloaded', ' grve-osmosis-importer') );
			}

			$max_size = (int) $this->max_attachment_size();
			if ( ! empty( $max_size ) && $filesize > $max_size ) {
				@unlink( $upload['file'] );
				return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', ' grve-osmosis-importer'), size_format($max_size) ) );
			}
		}

		// keep track of the old and new urls so we can substitute them later
		$this->url_remap[$real_url] = $upload['url'];
		//$this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
		// keep track of the destination if the remote url is redirected somewhere else
		if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
			$this->url_remap[$headers['x-final-location']] = $upload['url'];

		return $upload;
	}

	/**
	 * Attempt to associate posts and menu items with previously missing parents
	 *
	 * An imported post's parent may not have been imported when it was first created
	 * so try again. Similarly for child menu items and menu items which were missing
	 * the object (e.g. post) they represent in the menu
	 */
	function backfill_parents() {
		global $wpdb;

		// find parents for post orphans
		foreach ( $this->post_orphans as $child_id => $parent_id ) {
			$local_child_id = $local_parent_id = false;
			if ( isset( $this->processed_posts[$child_id] ) )
				$local_child_id = $this->processed_posts[$child_id];
			if ( isset( $this->processed_posts[$parent_id] ) )
				$local_parent_id = $this->processed_posts[$parent_id];

			if ( $local_child_id && $local_parent_id )
				$wpdb->update( $wpdb->posts, array( 'post_parent' => $local_parent_id ), array( 'ID' => $local_child_id ), '%d', '%d' );
		}

		// all other posts/terms are imported, retry menu items with missing associated object
		$missing_menu_items = $this->missing_menu_items;
		foreach ( $missing_menu_items as $item )
			$this->process_menu_item( $item );

		// find parents for menu item orphans
		foreach ( $this->menu_item_orphans as $child_id => $parent_id ) {
			$local_child_id = $local_parent_id = 0;
			if ( isset( $this->processed_menu_items[$child_id] ) )
				$local_child_id = $this->processed_menu_items[$child_id];
			if ( isset( $this->processed_menu_items[$parent_id] ) )
				$local_parent_id = $this->processed_menu_items[$parent_id];

			if ( $local_child_id && $local_parent_id )
				update_post_meta( $local_child_id, '_menu_item_menu_item_parent', (int) $local_parent_id );
		}
	}

	/**
	 * Use stored mapping information to update old attachment URLs
	 */
	function backfill_attachment_urls() {
		global $wpdb;
		// make sure we do the longest urls first, in case one is a substring of another
		uksort( $this->url_remap, array(&$this, 'cmpr_strlen') );

		foreach ( $this->url_remap as $from_url => $to_url ) {
			// remap urls in post_content
			$wpdb->query( $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", $from_url, $to_url) );
			// remap enclosure urls
			$result = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key='enclosure'", $from_url, $to_url) );
		}
	}

	/**
	 * Update _thumbnail_id meta to new, imported attachment IDs
	 */
	function remap_featured_images() {
		// cycle through posts that have a featured image
		foreach ( $this->featured_images as $post_id => $value ) {
			if ( isset( $this->processed_posts[$value] ) ) {
				$new_id = $this->processed_posts[$value];
				// only update if there's a difference
				if ( $new_id != $value )
					update_post_meta( $post_id, '_thumbnail_id', $new_id );
			}
		}
	}

	/**
	 * Parse a WXR file
	 *
	 * @param string $file Path to WXR file for parsing
	 * @return array Information gathered from the WXR file
	 */
	function parse( $file ) {
		$parser = new GRVE_WXR_Parser();
		return $parser->parse( $file );
	}

	// Display import page title
	function header() {
		echo '<div class="wrap">';
		screen_icon();
		echo '<h2>' . __( 'Import Osmosis Demos', ' grve-osmosis-importer' ) . '</h2>';
	}

	// Close div.wrap
	function footer() {
		echo '</div>';
	}

	/**
	 * Display introductory text and file upload form
	 */
	function greet() {

	$grve_dummy_data_list = $this->grve_get_demo_data();
?>

			<div id="grve-import-settings-note-wrap" class="wrap clearfix">
				<h3><?php _e( 'Please note the following points:', ' grve-osmosis-importer' ); ?></h3>
				<ol>
					<li><?php _e( 'The import process will work best on a clean installation. You can use a plugin such as WordPress Reset to clear your data first.', ' grve-osmosis-importer' ); ?></li>
					<li><?php _e( 'Ensure all needed plugins are already installed and activated, e.g. WPBakery Visual Composer, Osmosis Visual Composer Extension, WooCommerce, Contact Form 7 etc.', ' grve-osmosis-importer' ); ?></li>
					<li><?php _e( 'To import one of our Demos, select all or some of the options of any demo and press the import button.', ' grve-osmosis-importer' ); ?></li>
					<li><?php _e( 'Keep in mind not to run importer twice without clearing your data first. You might end up with duplicate data e.g duplicate menu items and/or widgets.', ' grve-osmosis-importer' ); ?></li>
					<li><?php _e( 'Once you start the process, please leave it running and uninterrupted! After the import, a status will be displayed with the results!', ' grve-osmosis-importer' ); ?></li>
				</ol>
			</div>
			<span id="grve-import-countdown" class="clearfix" style="display:none;"></span>
			<div class="clear"></div>
			<div id="grve-import-loading" style="display:none;"><?php _e( 'Importing...', ' grve-osmosis-importer' ); ?></div>
			<div id="grve-import-output-info" class="wrap clearfix" style="display:none;"></div>
			<div id="grve-import-output-container" style="display:none;"></div>

			<ul id="grve-import-dummy-list" class="grve-admin-dummy-list">
<?php
			foreach ( $grve_dummy_data_list as $grve_dummy_data ) {
				$image_src = plugins_url( '/import/data/' . $grve_dummy_data['dir'] . '/screenshot.png', __FILE__ );
?>
				<li class="grve-admin-dummy-item">
					<input type="hidden" class="grve-admin-dummy-option-dummy-nonce" value="<?php echo wp_create_nonce( $grve_dummy_data['dir'] ); ?>"/>
					<a href="<?php echo 'http://greatives.eu/themes/' . $grve_dummy_data['id']; ?>" target="_blank">
						<div class="grve-admin-dummy-screenshot">
								<img src="<?php echo esc_url( $image_src ); ?>" title="<?php $grve_dummy_data['name']; ?>" alt="<?php $grve_dummy_data['name']; ?>"/>
						</div>
					</a>
					<div class="grve-admin-dummy-options">
						<div class="grve-admin-dummy-option">
							<input type="checkbox" class="grve-admin-dummy-option-dummy-content" value="yes"/><?php _e( 'Dummy Content', ' grve-osmosis-importer' ); ?>
						</div>
						<div class="grve-admin-dummy-option">
							<input type="checkbox" class="grve-admin-dummy-option-theme-options" value="yes"/><?php _e( 'Theme Options', ' grve-osmosis-importer' ); ?>
						</div>
						<div class="grve-admin-dummy-option">
							<input type="checkbox" class="grve-admin-dummy-option-widgets" value="yes"/><?php _e( 'Widgets', ' grve-osmosis-importer' ); ?>
						</div>
					</div>
					<h3 class="grve-admin-dummy-name"><?php echo $grve_dummy_data['name']; ?></h3>
					<div class="grve-admin-dummy-buttons">
						<input type="button" class="button button-primary grve-import-dummy-data" data-dummy-id="<?php echo $grve_dummy_data['dir']; ?>" value="<?php _e( 'Import', ' grve-osmosis-importer' ); ?>"/>
					</div>
				</li>
<?php
			}
?>
			</ul>
<?php
	}

	/**
	 * Decide if the given meta key maps to information we will want to import
	 *
	 * @param string $key The meta key to check
	 * @return string|bool The key if we do want to import, false if not
	 */
	function is_valid_meta_key( $key ) {
		// skip attachment metadata since we'll regenerate it from scratch
		// skip _edit_lock as not relevant for import
		if ( in_array( $key, array( '_wp_attached_file', '_wp_attachment_metadata', '_edit_lock' ) ) )
			return false;
		return $key;
	}

	/**
	 * Decide whether or not the importer is allowed to create users.
	 * Default is true, can be filtered via import_allow_create_users
	 *
	 * @return bool True if creating users is allowed
	 */
	function allow_create_users() {
		return apply_filters( 'import_allow_create_users', true );
	}

	/**
	 * Decide whether or not the importer should attempt to download attachment files.
	 * Default is true, can be filtered via import_allow_fetch_attachments. The choice
	 * made at the import options screen must also be true, false here hides that checkbox.
	 *
	 * @return bool True if downloading attachments is allowed
	 */
	function allow_fetch_attachments() {
		return apply_filters( 'import_allow_fetch_attachments', true );
	}

	/**
	 * Decide what the maximum file size for downloaded attachments is.
	 * Default is 0 (unlimited), can be filtered via import_attachment_size_limit
	 *
	 * @return int Maximum attachment file size to import
	 */
	function max_attachment_size() {
		return apply_filters( 'import_attachment_size_limit', 0 );
	}

	/**
	 * Added to http_request_timeout filter to force timeout at 120 seconds during import
	 * @return int 120
	 */
	function bump_request_timeout( $val ) {
		return 120;
	}

	// return the difference in length between two strings
	function cmpr_strlen( $a, $b ) {
		return strlen($b) - strlen($a);
	}
}

} // class_exists( 'GRVE_Importer' )

function grve_osmosis_importer_init() {
	load_plugin_textdomain( 'grve-osmosis-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	$GLOBALS['grve_osmosis_importer'] = new GRVE_Osmosis_Importer();
	register_importer( 'osmosis-demo-importer', 'Osmosis Demo Importer', __('Import Osmosis Demos, Dummy Content, Theme Options and Widgets.', 'grve-osmosis-importer'), array( $GLOBALS['grve_osmosis_importer'], 'dispatch' ) );
}
add_action( 'admin_init', 'grve_osmosis_importer_init' );