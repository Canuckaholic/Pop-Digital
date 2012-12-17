<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'WTF_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'project_info',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Project info',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'portfolio' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'		=> 'Project subtitle',
			// Field ID, i.e. the meta key
			'id'		=> $prefix . 'subtitle',
			// Field description (optional)
			'desc'		=> 'A small info about your project title',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone'		=> false,
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> 'My project subtitle'
		),
		
	
		// RADIO BUTTONS
		array(
			'name'		=> 'Project type',
			'id'		=> "{$prefix}protype",
			'type'		=> 'radio',
			// Array of 'key' => 'value' pairs for radio options.
			// Note: the 'key' is stored in meta field, not the 'value'
			'options'	=> array(
				'i'			=> 'Image',
				'v'			=> 'Video'
			),
			'std'		=> 'i',
			'desc'		=> 'Type of project'
		),
		
		// TEXTAREA
		array(
			'name'		=> 'Project video',
			'desc'		=> "Embed your project video here",
			'id'		=> "{$prefix}video",
			'type'		=> 'textarea',
			'cols'		=> "40",
			'rows'		=> "8"
		),
	
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'	=> 'Project images',
			'desc'	=> 'Upload portfolio images. Max 10',
			'id'	=> "{$prefix}images",
			'type'	=> 'plupload_image',
			'max_file_uploads' => 10,
		)
		
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );