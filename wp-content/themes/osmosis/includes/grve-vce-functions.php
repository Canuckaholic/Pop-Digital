<?php

/*
*	Osmosis Greatives Visual Composer Extension Plugin Hooks
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Translation function returning the theme translations
 */

/* All */
function grve_theme_vce_get_string_all() {
    return __( 'All', GRVE_THEME_TRANSLATE );
}
/* Read more */
function grve_theme_vce_get_string_read_more() {
    return __( 'read more', GRVE_THEME_TRANSLATE );
}
/* In Categories */
function grve_theme_vce_get_string_categories_in() {
    return __( 'in', GRVE_THEME_TRANSLATE );
}
/* No comments */
function grve_theme_vce_get_string_no_comments() {
    return __( 'no comments', GRVE_THEME_TRANSLATE );
}
/* One comment */
function grve_theme_vce_get_string_one_comment() {
    return __( '1 comment', GRVE_THEME_TRANSLATE );
}
/* Comments */
function grve_theme_vce_get_string_comments() {
    return __( 'comments', GRVE_THEME_TRANSLATE );
}
/* Author By */
function grve_theme_vce_get_string_by_author() {
    return __( 'By:', GRVE_THEME_TRANSLATE );
}

/**
 * Hooks for portfolio translations
 */

add_filter( 'grve_vce_portfolio_string_all_categories', 'grve_theme_vce_get_string_all' );

 /**
 * Hooks for blog translations
 */

add_filter( 'grve_vce_string_read_more', 'grve_theme_vce_get_string_read_more' );
add_filter( 'grve_vce_blog_string_categories_in', 'grve_theme_vce_get_string_categories_in' );
add_filter( 'grve_vce_blog_string_no_comments', 'grve_theme_vce_get_string_no_comments' );
add_filter( 'grve_vce_blog_string_one_comment', 'grve_theme_vce_get_string_one_comment' );
add_filter( 'grve_vce_blog_string_comments', 'grve_theme_vce_get_string_comments' );
add_filter( 'grve_vce_blog_string_by_author', 'grve_theme_vce_get_string_by_author' );

?>