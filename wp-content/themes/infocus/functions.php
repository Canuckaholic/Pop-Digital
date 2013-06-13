<?php
/**
 * Defines the necessary constants and includes the necessary files.
 */

// Define Directory Constants
define('WEBTREATS_LIB', TEMPLATEPATH . '/lib');
define('WEBTREATS_ADMIN', WEBTREATS_LIB . '/admin');
define('WEBTREATS_CLASSES', WEBTREATS_LIB . '/classes');
define('WEBTREATS_FUNCTIONS', WEBTREATS_LIB . '/functions');
define('WEBTREATS_INCLUDES', WEBTREATS_LIB . '/includes');
define('WEBTREATS_ADMIN_CSS', get_template_directory_uri() . '/lib/admin/css' );
define('WEBTREATS_ADMIN_JS', get_template_directory_uri() . '/lib/admin/js' );
define('WEBTREATS_JS', get_template_directory_uri() . '/lib/scripts' );

// Define Folder Constants
define('WEBTREATS_SCRIPTS_FOLDER', get_bloginfo('template_url') . '/lib/scripts');

// Load Theme Options
require_once(WEBTREATS_ADMIN . '/admin-options.php');

// Load Admin Interface
require_once(WEBTREATS_ADMIN . '/admin-interface.php');

// Load Admin Scripts and Css
require_once(WEBTREATS_ADMIN . '/admin-scripts.php');

// Load TinyMCE Plugin
require_once(WEBTREATS_ADMIN . '/tinymce/tinymce.php');

// Load Admin Meta Boxes
require_once(WEBTREATS_ADMIN . '/post-options.php');

// Load wp-pagenavi
require_once(WEBTREATS_INCLUDES . '/wp-pagenavi.php');

// Load Options from the Database
require_once(WEBTREATS_INCLUDES . "/var.php");

// Load Parse Twitter Feeds
require_once(WEBTREATS_FUNCTIONS . '/twitter.php');

// Load Widgets
require_once(WEBTREATS_FUNCTIONS . '/widgets.php');

// Load Social Bookmarks
require_once(WEBTREATS_FUNCTIONS . '/bookmarks.php');

// Load Portfolio
require_once(WEBTREATS_FUNCTIONS . '/portfolio.php');

// Load Related Posts
require_once(WEBTREATS_FUNCTIONS . '/posts.php');

// Load Theme Functions
require_once(WEBTREATS_FUNCTIONS . '/theme-functions.php');

// Load Custom Shortcodes
require_once(WEBTREATS_FUNCTIONS . '/shortcode.php');

// Load Header Scripts
require_once(WEBTREATS_FUNCTIONS . '/scripts.php');

// Load Breadcrumbs
require_once(WEBTREATS_CLASSES . '/breadcrumb.php');

// Load Sidebar Generator Class
require_once(WEBTREATS_CLASSES . '/sidebar-generator.php');

// Redirect To Theme Options Page on Activation
if ($_GET['activated']){
wp_redirect(admin_url("admin.php?page=$page_handle&upgraded=true"));
}

?>