<?php
/*
*	Testimonial Post Type Registration
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! class_exists( 'GRVE_Testimonial_Post_Type' ) ) {
	class GRVE_Testimonial_Post_Type {

		function __construct() {

			// Adds the testimonial post type and taxonomies
			add_action( 'init', array( &$this, 'grve_testimonial_init' ), 0 );

			// Manage Columns for testimonial overview
			add_filter( 'manage_edit-testimonial_columns',  array( &$this, 'grve_testimonial_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'grve_testimonial_custom_columns' ), 10, 2 );

		}

		function grve_testimonial_init() {


			$labels = array(
				'name' => _x( 'Testimonial Items', 'Testimonial General Name', GRVE_THEME_TRANSLATE ),
				'singular_name' => _x( 'Testimonial Item', 'Testimonial Singular Name', GRVE_THEME_TRANSLATE ),
				'add_new' => __( 'Add New', GRVE_THEME_TRANSLATE ),
				'add_new_item' => __( 'Add New Testimonial Item', GRVE_THEME_TRANSLATE ),
				'edit_item' => __( 'Edit Testimonial Item', GRVE_THEME_TRANSLATE ),
				'new_item' => __( 'New Testimonial Item', GRVE_THEME_TRANSLATE ),
				'view_item' => __( 'View Testimonial Item', GRVE_THEME_TRANSLATE ),
				'search_items' => __( 'Search Testimonial Items', GRVE_THEME_TRANSLATE ),
				'not_found' =>  __( 'No Testimonial Items found', GRVE_THEME_TRANSLATE ),
				'not_found_in_trash' => __( 'No Testimonial Items found in Trash', GRVE_THEME_TRANSLATE ),
				'parent_item_colon' => '',
			);

			$category_labels = array(
				'name' => __( 'Testimonial Categories', GRVE_THEME_TRANSLATE ),
				'singular_name' => __( 'Testimonial Category', GRVE_THEME_TRANSLATE ),
				'search_items' => __( 'Search Testimonial Categories', GRVE_THEME_TRANSLATE ),
				'all_items' => __( 'All Testimonial Categories', GRVE_THEME_TRANSLATE ),
				'parent_item' => __( 'Parent Testimonial Category', GRVE_THEME_TRANSLATE ),
				'parent_item_colon' => __( 'Parent Testimonial Category:', GRVE_THEME_TRANSLATE ),
				'edit_item' => __( 'Edit Testimonial Category', GRVE_THEME_TRANSLATE ),
				'update_item' => __( 'Update Testimonial Category', GRVE_THEME_TRANSLATE ),
				'add_new_item' => __( 'Add New Testimonial Category', GRVE_THEME_TRANSLATE ),
				'new_item_name' => __( 'New Testimonial Category Name', GRVE_THEME_TRANSLATE ),
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
				'menu_icon' => 'dashicons-testimonial',
				'supports' => array( 'title', 'editor', 'author' ),
				'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
			  );

			register_post_type( 'testimonial' , $args );

			register_taxonomy(
				'testimonial_category',
				array( 'testimonial' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Testimonial Categories', GRVE_THEME_TRANSLATE ),
					'labels' => $category_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'testimonial_category', 'testimonial' );

		}

		function grve_testimonial_edit_columns( $columns ) {
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => __( 'Title', GRVE_THEME_TRANSLATE ),
				'author' => __( 'Author', GRVE_THEME_TRANSLATE ),
				'testimonial_category' => __( 'Testimonial Categories', GRVE_THEME_TRANSLATE ),
				'date' => __( 'Date', GRVE_THEME_TRANSLATE ),
			);
			return $columns;
		}

		function grve_testimonial_custom_columns( $column, $post_id ) {

			switch ( $column ) {
				case 'testimonial_category':
					echo get_the_term_list( $post_id, 'testimonial_category', '', ', ','' );
				break;
			}
		}

	}
	new GRVE_Testimonial_Post_Type;
}

?>