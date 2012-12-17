<?php
add_action('init', 'portfolio_register');

function portfolio_register() {

	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => null,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 

	register_post_type( 'portfolio' , $args );
}



function add_filter_taxonomies() {

	register_taxonomy('filter', 'portfolio', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Filter', 'taxonomy general name' ),
			'singular_name' => _x( 'Filter', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Filters' ),
			'all_items' => __( 'All Filters' ),
			'parent_item' => __( 'Parent Filter' ),
			'parent_item_colon' => __( 'Parent Filter:' ),
			'edit_item' => __( 'Edit Filter' ),
			'update_item' => __( 'Update Filter' ),
			'add_new_item' => __( 'Add New Filter' ),
			'new_item_name' => __( 'New Filter Name' ),
			'menu_name' => __( 'Filters' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'filter', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_filter_taxonomies', 0 );

?>