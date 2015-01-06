<?php
/*
*	Portfolio Post Type Registration
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! class_exists( 'GRVE_Portfolio_Post_Type' ) ) {
	class GRVE_Portfolio_Post_Type {

		function __construct() {

			// Adds the portfolio post type and taxonomies
			add_action( 'init', array( &$this, 'grve_portfolio_init' ), 0 );

			// Manage Columns for portfolio overview
			add_filter( 'manage_edit-portfolio_columns',  array( &$this, 'grve_portfolio_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'grve_portfolio_custom_columns' ), 10, 2 );

		}

		function grve_portfolio_init() {

			$portfolio_base_slug = grve_option( 'portfolio_slug', 'portfolio' );


			$labels = array(
				'name' => _x( 'Portfolio Items', 'Portfolio General Name', GRVE_THEME_TRANSLATE ),
				'singular_name' => _x( 'Portfolio Item', 'Portfolio Singular Name', GRVE_THEME_TRANSLATE ),
				'add_new' => __( 'Add New', GRVE_THEME_TRANSLATE ),
				'add_new_item' => __( 'Add New Portfolio Item', GRVE_THEME_TRANSLATE ),
				'edit_item' => __( 'Edit Portfolio Item', GRVE_THEME_TRANSLATE ),
				'new_item' => __( 'New Portfolio Item', GRVE_THEME_TRANSLATE ),
				'view_item' => __( 'View Portfolio Item', GRVE_THEME_TRANSLATE ),
				'search_items' => __( 'Search Portfolio Items', GRVE_THEME_TRANSLATE ),
				'not_found' =>  __( 'No Portfolio Items found', GRVE_THEME_TRANSLATE ),
				'not_found_in_trash' => __( 'No Portfolio Items found in Trash', GRVE_THEME_TRANSLATE ),
				'parent_item_colon' => '',
			);

			$category_labels = array(
				'name' => __( 'Portfolio Categories', GRVE_THEME_TRANSLATE ),
				'singular_name' => __( 'Portfolio Category', GRVE_THEME_TRANSLATE ),
				'search_items' => __( 'Search Portfolio Categories', GRVE_THEME_TRANSLATE ),
				'all_items' => __( 'All Portfolio Categories', GRVE_THEME_TRANSLATE ),
				'parent_item' => __( 'Parent Portfolio Category', GRVE_THEME_TRANSLATE ),
				'parent_item_colon' => __( 'Parent Portfolio Category:', GRVE_THEME_TRANSLATE ),
				'edit_item' => __( 'Edit Portfolio Category', GRVE_THEME_TRANSLATE ),
				'update_item' => __( 'Update Portfolio Category', GRVE_THEME_TRANSLATE ),
				'add_new_item' => __( 'Add New Portfolio Category', GRVE_THEME_TRANSLATE ),
				'new_item_name' => __( 'New Portfolio Category Name', GRVE_THEME_TRANSLATE ),
			);

			$field_labels = array(
				'name' => __( 'Portfolio Fields', GRVE_THEME_TRANSLATE ),
				'singular_name' => __( 'Portfolio Field', GRVE_THEME_TRANSLATE ),
				'search_items' => __( 'Search Portfolio Fields', GRVE_THEME_TRANSLATE ),
				'all_items' => __( 'All Portfolio Fields', GRVE_THEME_TRANSLATE ),
				'parent_item' => __( 'Parent Portfolio Field', GRVE_THEME_TRANSLATE ),
				'parent_item_colon' => __( 'Parent Portfolio Field:', GRVE_THEME_TRANSLATE ),
				'edit_item' => __( 'Edit Portfolio Field', GRVE_THEME_TRANSLATE ),
				'update_item' => __( 'Update Portfolio Field', GRVE_THEME_TRANSLATE ),
				'add_new_item' => __( 'Add New Portfolio Field', GRVE_THEME_TRANSLATE ),
				'new_item_name' => __( 'New Portfolio Field Name', GRVE_THEME_TRANSLATE ),
			);

			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-format-gallery',
				'supports' => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'custom-fields', 'comments' ),
				'rewrite' => array( 'slug' => $portfolio_base_slug, 'with_front' => false ),
			);

			register_post_type( 'portfolio' , $args );

			register_taxonomy(
				'portfolio_category',
				array( 'portfolio' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Portfolio Categories', GRVE_THEME_TRANSLATE ),
					'labels' => $category_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'portfolio_category', 'portfolio' );

			register_taxonomy(
				'portfolio_field',
				array( 'portfolio' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Portfolio Fields', GRVE_THEME_TRANSLATE ),
					'labels' => $field_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'portfolio_field', 'portfolio' );

		}

		function grve_portfolio_edit_columns( $columns ) {
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'portfolio_thumbnail' => __( 'Featured Image', GRVE_THEME_TRANSLATE ),
				'title' => __( 'Title', GRVE_THEME_TRANSLATE ),
				'author' => __( 'Author', GRVE_THEME_TRANSLATE ),
				'portfolio_category' => __( 'Portfolio Categories', GRVE_THEME_TRANSLATE ),
				'portfolio_field' => __( 'Portfolio Fields', GRVE_THEME_TRANSLATE ),
				'date' => __( 'Date', GRVE_THEME_TRANSLATE ),
			);
			return $columns;
		}

		function grve_portfolio_custom_columns( $column, $post_id ) {

			switch ( $column ) {
				case "portfolio_thumbnail":
					if ( has_post_thumbnail( $post_id ) ) {
						$thumbnail_id = get_post_thumbnail_id( $post_id );
						$attachment_src = wp_get_attachment_image_src( $thumbnail_id, array( 80, 80 ) );
						$thumb = $attachment_src[0];
					} else {
						$thumb = get_template_directory_uri() . '/includes/images/no-image.jpg';
					}
					echo '<img class="attachment-80x80" width="80" height="80" alt="portfolio image" src="' . $thumb . '">';
					break;
				case 'portfolio_category':
					echo get_the_term_list( $post_id, 'portfolio_category', '', ', ','' );
				break;
				case 'portfolio_field':
					echo get_the_term_list( $post_id, 'portfolio_field', '', ', ','' );
				break;
			}
		}

	}
	new GRVE_Portfolio_Post_Type;
}

?>