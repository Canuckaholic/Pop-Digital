<?php
/**
 *  Dynamic css style
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

$css = "";

/**
* Header
* ----------------------------------------------------------------------------
*/

/* Top Bar Settings */

$css .= "
#grve-top-bar {
	line-height: " . grve_option( 'top_bar_height', 40 ) . "px;
	background-color: " . grve_option( 'top_bar_bg_color' ) . ";
	color: " . grve_option( 'top_bar_font_color' ) . ";
}

#grve-top-bar a {
	color: " . grve_option( 'top_bar_link_color' ) . ";
}

#grve-top-bar a:hover {
	color: " . grve_option( 'top_bar_hover_color' ) . ";
}

#grve-top-bar .grve-language ul li a {
	background-color: " . grve_option( 'submenu_bg_color' ) . ";
	color: " . grve_option( 'submenu_text_color' ) . ";
}

#grve-top-bar .grve-language ul li a:hover {
	background-color: " . grve_option( 'submenu_active_bg_color' ) . ";
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
}

#grve-header[data-overlap='yes'][data-header-position='above-feature'][data-topbar='yes'] #grve-header-wrapper,
#grve-header[data-overlap='yes'][data-header-position='above-feature'][data-topbar='yes'] #grve-inner-header {
	top: " . grve_option( 'top_bar_height', 40 ) . "px;
}

#grve-top-bar,
#grve-top-bar ul li.grve-topbar-item ul li a,
#grve-top-bar ul.grve-bar-content,
#grve-top-bar ul.grve-bar-content > li {
	border-color: " . grve_option( 'top_bar_border_color' ) . " !important;
}


";

/* Header Height */
$css .= "

#grve-header #grve-inner-header {
	height: " . grve_option( 'header_height', 70 ) . "px;
	line-height: " . grve_option( 'header_height', 70 ) . "px;
}

#grve-header #grve-header-wrapper {
	height: " . grve_option( 'header_height', 70 ) . "px;
}

#grve-header #grve-inner-header h1.grve-logo img {
	max-height: " . grve_option( 'header_height', 70 ) . "px;
}

#grve-header #grve-header-options a.grve-open-button,
#grve-header #grve-header-options a .grve-icon {
	width: " . grve_option( 'safe_button_size', 50 ) . "px;
	height: " . grve_option( 'safe_button_size', 50 ) . "px;
	line-height: " . grve_option( 'safe_button_size', 50 ) . "px;
}

#grve-header[data-safebutton='right'] #grve-header-options {
	right: " . grve_option( 'safe_button_right_space', 20 ) . "px;
}

#grve-header[data-safebutton='left'] #grve-header-options {
	left: " . grve_option( 'safe_button_left_space', 20 ) . "px;
}

#grve-header .grve-menu-options {
	height: " . grve_option( 'header_height', 70 ) . "px;
	line-height: " . grve_option( 'header_height', 70 ) . "px;
}

#grve-header #grve-header-options .grve-options-wrapper,
#grve-header #grve-header-options ul.grve-options li a .grve-icon::before {
	width: " . grve_option( 'safe_button_size', 50 ) . "px;
}

#grve-header #grve-header-options ul.grve-options {
	line-height: " . grve_option( 'safe_button_size', 50 ) . "px;
}


#grve-header #grve-header-options ul.grve-options li a {
	padding-left: " . grve_option( 'safe_button_size', 50 ) . "px;
}


";

/* Responsive Menu --------------------------------------------------------------------------------------- */
$css .= "

#grve-main-menu-responsive {
	color: " . grve_option( 'submenu_text_color' ) . ";
	background-color: " . grve_option( 'submenu_bg_color' ) . ";
}

#grve-main-menu-responsive li a {
	color: " . grve_option( 'submenu_text_color' ) . ";
	background-color: " . grve_option( 'submenu_bg_color' ) . ";
}

#grve-main-menu-responsive li a:hover {
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
}

#grve-main-menu-responsive ul li.current-menu-item > a,
#grve-main-menu-responsive ul li.current-menu-parent > a,
#grve-main-menu-responsive ul li.current_page_item > a,
#grve-main-menu-responsive ul li.current_page_ancestor > a {
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
}

#grve-main-menu-responsive .grve-close-menu-button {
	color: " . grve_option( 'menu_active_text_color' ) . ";
	background-color: " . grve_option( 'menu_active_bg_color' ) . ";
}

#grve-main-menu-responsive .grve-menu-options li a {
	color: " . grve_option( 'submenu_text_color' ) . " !important;
}

#grve-main-menu-responsive ul li a .label {
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
	background-color: " . grve_option( 'submenu_active_bg_color' ) . ";
}

";


/* Header Default Colors --------------------------------------------------------------------------------------- */

$grve_header_background_color = grve_option( 'header_background_color', '#ffffff' );
$css .= "

#grve-header.grve-default #grve-inner-header,
#grve-header.grve-default[data-sticky-header='shrink'] {
	background-color: rgba(" . grve_hex2rgb( $grve_header_background_color ) . "," . grve_option( 'header_background_color_opacity', '1') . ");
}

";

/* Menu Default Colors --------------------------------------------------------------------------------------- */

$css .= "

#grve-header.grve-default #grve-main-menu > ul > li > a,
#grve-header.grve-default .grve-menu-options li a {
	color: " . grve_option( 'menu_text_color' ) . ";
}

#grve-header.grve-default .grve-menu-button-line {
	background-color: " . grve_option( 'menu_text_color' ) . ";
}

";

/* Simply Menu Type */

$css .= "

#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li:hover > a,
#grve-header[data-menu-type='simply'].grve-default #grve-main-menu > ul > li.current-menu-ancestor > a,
#grve-header.grve-default .grve-menu-options li a:hover {
	color: " . grve_option( 'menu_text_hover_color' ) . ";
}

";

/* Button Menu Type */

$css .= "

#grve-header[data-menu-type='button'].grve-default #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='button'].grve-default #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='button'].grve-default #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='button'].grve-default #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='button'].grve-default #grve-main-menu > ul > li:hover > a,
#grve-header.grve-default .grve-menu-options li a .grve-purchased-items {
	color: " . grve_option( 'menu_active_text_color' ) . ";
	background-color: " . grve_option( 'menu_active_bg_color' ) . ";
}

";

/* Box Menu Type */

$css .= "

#grve-header[data-menu-type='box'].grve-default #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='box'].grve-default #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='box'].grve-default #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='box'].grve-default #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='box'].grve-default #grve-main-menu > ul > li:hover > a {
	color: " . grve_option( 'menu_active_text_color' ) . ";
	background-color: " . grve_option( 'menu_active_bg_color' ) . ";
}
";

/* Submenu Colors */

$css .= "

#grve-header.grve-default #grve-main-menu ul li ul a,
#grve-header.grve-default #grve-header-options ul.grve-options a,
#grve-header.grve-default #grve-main-menu ul li a:hover .label,
#grve-header.grve-default #grve-main-menu > ul > li.megamenu > ul > li > a:hover,
#grve-header.grve-default #grve-main-menu > ul > li.megamenu > ul {
	color: " . grve_option( 'submenu_text_color' ) . ";
	background-color: " . grve_option( 'submenu_bg_color' ) . ";
}

#grve-header.grve-default #grve-main-menu ul li.current-menu-item > a,
#grve-header.grve-default #grve-main-menu > ul > li.megamenu > ul > li > a {
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
}

#grve-header.grve-default #grve-main-menu ul li ul a:hover,
#grve-header.grve-default #grve-header-options ul.grve-options a:hover,
#grve-header.grve-default #grve-main-menu ul li a .label {
	color: " . grve_option( 'submenu_text_hover_color' ) . ";
	background-color: " . grve_option( 'submenu_active_bg_color' ) . ";
}

#grve-header.grve-default #grve-main-menu > ul > li.megamenu > ul > li {
	border-color: " . grve_option( 'submenu_border_color' ) . ";
}

";

/* Safe Button Colors */

$grve_safe_button_bg_color = grve_option( 'safe_button_bg_color' );
$grve_safe_button_bg_hover_color = grve_option( 'safe_button_bg_hover_color' );
$css .= "

#grve-header.grve-default #grve-header-options > li > a.grve-open-button,
#grve-language-modal .grve-language li a:hover,
#grve-language-modal .grve-language li a.active,
#grve-share-modal .grve-social li a:hover {
	color: " . grve_option( 'safe_button_icon_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_safe_button_bg_color ) . "," . grve_option( 'safe_button_bg_color_opacity' ) . ");
}

#grve-header.grve-default #grve-header-options > li:hover > a.grve-open-button {
	color: " . grve_option( 'safe_button_icon_hover_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_safe_button_bg_hover_color ) . "," . grve_option( 'safe_button_bg_hover_color_opacity' ) . ");
}

";

/* Header Light Colors --------------------------------------------------------------------------------------- */

$grve_header_light_background_color = grve_option( 'header_light_background_color', '#323232' );
$css .= "

#grve-header.grve-light #grve-inner-header,
#grve-header.grve-light[data-sticky-header='shrink'] {
	background-color: rgba(" . grve_hex2rgb( $grve_header_light_background_color ) . "," . grve_option( 'header_light_background_color_opacity', '0') . ");
}

";


/* Menu Light Colors --------------------------------------------------------------------------------------- */

$css .= "

#grve-header.grve-light #grve-main-menu > ul > li > a,
#grve-header.grve-light .grve-menu-options li a {
	color: " . grve_option( 'light_menu_text_color' ) . ";
}

#grve-header.grve-light .grve-menu-button-line {
	background-color: " . grve_option( 'light_menu_text_color' ) . ";
}

";

/* Simply Menu Type */

$css .= "

#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li:hover > a,
#grve-header[data-menu-type='simply'].grve-light #grve-main-menu > ul > li.current-menu-ancestor > a,
#grve-header.grve-light .grve-menu-options li a:hover {
	color: " . grve_option( 'light_menu_text_hover_color' ) . ";
}

";

/* Button Menu Type */

$css .= "

#grve-header[data-menu-type='button'].grve-light #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='button'].grve-light #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='button'].grve-light #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='button'].grve-light #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='button'].grve-light #grve-main-menu > ul > li:hover > a,
#grve-header.grve-light .grve-menu-options li a .grve-purchased-items {
	color: " . grve_option( 'light_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'light_menu_active_bg_color' ) . ";
}

";

/* Box Menu Type */

$css .= "

#grve-header[data-menu-type='box'].grve-light #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='box'].grve-light #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='box'].grve-light #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='box'].grve-light #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='box'].grve-light #grve-main-menu > ul > li:hover > a {
	color: " . grve_option( 'light_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'light_menu_active_bg_color' ) . ";
}
";

/* Submenu Colors */

$css .= "

#grve-header.grve-light #grve-main-menu ul li ul a,
#grve-header.grve-light #grve-header-options ul.grve-options a,
#grve-header.grve-light #grve-main-menu ul li a:hover .label,
#grve-header.grve-light #grve-main-menu > ul > li.megamenu > ul > li > a:hover,
#grve-header.grve-light #grve-main-menu > ul > li.megamenu > ul {
	color: " . grve_option( 'light_submenu_text_color' ) . ";
	background-color: " . grve_option( 'light_submenu_bg_color' ) . ";
}

#grve-header.grve-light #grve-main-menu ul li.current-menu-item > a,
#grve-header.grve-light #grve-main-menu > ul > li.megamenu > ul > li > a {
	color: " . grve_option( 'light_submenu_text_hover_color' ) . ";
}

#grve-header.grve-light #grve-main-menu ul li ul a:hover,
#grve-header.grve-light #grve-header-options ul.grve-options a:hover,
#grve-header.grve-light #grve-main-menu ul li a .label {
	color: " . grve_option( 'light_submenu_text_hover_color' ) . ";
	background-color: " . grve_option( 'light_submenu_active_bg_color' ) . ";
}

#grve-header.grve-light #grve-main-menu > ul > li.megamenu > ul > li {
	border-color: " . grve_option( 'light_submenu_border_color' ) . ";
}

";

/* Safe Button Colors */
$grve_light_safe_button_bg_color = grve_option( 'light_safe_button_bg_color' );
$grve_light_safe_button_bg_hover_color = grve_option( 'light_safe_button_bg_hover_color' );
$css .= "

#grve-header.grve-light #grve-header-options > li > a.grve-open-button {
	color: " . grve_option( 'light_safe_button_icon_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_light_safe_button_bg_color ) . "," . grve_option( 'light_safe_button_bg_color_opacity' ) . ");
}

#grve-header.grve-light #grve-header-options > li:hover > a.grve-open-button {
	color: " . grve_option( 'light_safe_button_icon_hover_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_light_safe_button_bg_hover_color ) . "," . grve_option( 'light_safe_button_bg_hover_color_opacity' ) . ");
}

";

/* Header Dark Colors --------------------------------------------------------------------------------------- */

$grve_header_dark_background_color = grve_option( 'header_dark_background_color', '#ffffff' );
$css .= "

#grve-header.grve-dark #grve-inner-header,
#grve-header.grve-light[data-sticky-header='shrink'] {
	background-color: rgba(" . grve_hex2rgb( $grve_header_dark_background_color ) . "," . grve_option( 'header_dark_background_color_opacity', '0') . ");
}

";

/* Menu Dark Colors --------------------------------------------------------------------------------------- */

$css .= "

#grve-header.grve-dark #grve-main-menu > ul > li > a,
#grve-header.grve-dark .grve-menu-options li a {
	color: " . grve_option( 'dark_menu_text_color' ) . ";
}

#grve-header.grve-dark .grve-menu-button-line {
	background-color: " . grve_option( 'dark_menu_text_color' ) . ";
}

";

/* Simply Menu Type */

$css .= "

#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li:hover > a,
#grve-header[data-menu-type='simply'].grve-dark #grve-main-menu > ul > li.current-menu-ancestor > a,
#grve-header.grve-dark .grve-menu-options li a:hover {
	color: " . grve_option( 'dark_menu_text_hover_color' ) . ";
}

";

/* Button Menu Type */

$css .= "

#grve-header[data-menu-type='button'].grve-dark #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='button'].grve-dark #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='button'].grve-dark #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='button'].grve-dark #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='button'].grve-dark #grve-main-menu > ul > li:hover > a,
#grve-header.grve-dark .grve-menu-options li a .grve-purchased-items {
	color: " . grve_option( 'dark_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'dark_menu_active_bg_color' ) . ";
}

";

/* Box Menu Type */

$css .= "

#grve-header[data-menu-type='box'].grve-dark #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='box'].grve-dark #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='box'].grve-dark #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='box'].grve-dark #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='box'].grve-dark #grve-main-menu > ul > li:hover > a {
	color: " . grve_option( 'dark_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'dark_menu_active_bg_color' ) . ";
}
";

/* Submenu Colors */

$css .= "

#grve-header.grve-dark #grve-main-menu ul li ul a,
#grve-header.grve-dark #grve-header-options ul.grve-options a,
#grve-header.grve-dark #grve-main-menu ul li a:hover .label,
#grve-header.grve-dark #grve-main-menu > ul > li.megamenu > ul > li > a:hover,
#grve-header.grve-dark #grve-main-menu > ul > li.megamenu > ul {
	color: " . grve_option( 'dark_submenu_text_color' ) . ";
	background-color: " . grve_option( 'dark_submenu_bg_color' ) . ";
}

#grve-header.grve-dark #grve-main-menu ul li.current-menu-item > a,
#grve-header.grve-dark #grve-main-menu > ul > li.megamenu > ul > li > a {
	color: " . grve_option( 'dark_submenu_text_hover_color' ) . ";
}

#grve-header.grve-dark #grve-main-menu ul li ul a:hover,
#grve-header.grve-dark #grve-header-options ul.grve-options a:hover,
#grve-header.grve-dark #grve-main-menu ul li a .label {
	color: " . grve_option( 'dark_submenu_text_hover_color' ) . ";
	background-color: " . grve_option( 'submenu_active_bg_color' ) . ";
}

#grve-header.grve-dark #grve-main-menu > ul > li.megamenu > ul > li {
	border-color: " . grve_option( 'dark_submenu_border_color' ) . ";
}

";

/* Safe Button Colors */
$grve_dark_safe_button_bg_color = grve_option( 'dark_safe_button_bg_color' );
$grve_dark_safe_button_bg_hover_color = grve_option( 'dark_safe_button_bg_hover_color' );
$css .= "

#grve-header.grve-dark #grve-header-options > li > a.grve-open-button {
	color: " . grve_option( 'dark_safe_button_icon_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_dark_safe_button_bg_color ) . "," . grve_option( 'dark_safe_button_bg_color_opacity' ) . ");
}

#grve-header.grve-dark #grve-header-options > li:hover > a.grve-open-button {
	color: " . grve_option( 'dark_safe_button_icon_hover_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_dark_safe_button_bg_hover_color ) . "," . grve_option( 'dark_safe_button_bg_hover_color_opacity' ) . ");
}

";

/* Sticky Header */
$grve_header_sticky_background_color = grve_option( 'header_sticky_background_color', '#ffffff' );

$css .= "

#grve-header.grve-default.grve-header-sticky #grve-inner-header,
#grve-header.grve-light.grve-header-sticky #grve-inner-header,
#grve-header.grve-dark.grve-header-sticky #grve-inner-header {
	background-color: rgba(" . grve_hex2rgb( $grve_header_sticky_background_color ) . "," . grve_option( 'header_sticky_background_color_opacity', '1') . ");
}

#grve-header[data-sticky-header='advanced'][data-safebutton='right'].grve-header-sticky #grve-inner-header .grve-container {
	padding-right: " . grve_option( 'safe_button_size', 50 ) . "px;
}

#grve-header[data-sticky-header='advanced'][data-safebutton='left'].grve-header-sticky #grve-inner-header .grve-container {
	padding-left: " . grve_option( 'safe_button_size', 50 ) . "px;
}

/* Sticky Logo */
#grve-header.grve-header-sticky h1.grve-logo a.grve-sticky {
	display: inline-block;
}

";

/* Sticky Menu Colors */

$css .= "

#grve-header.grve-header-sticky #grve-main-menu > ul > li > a,
#grve-header.grve-header-sticky .grve-menu-options li a {
	color: " . grve_option( 'sticky_menu_text_color' ) . ";
}

#grve-header.grve-header-sticky .grve-menu-button-line {
	background-color: " . grve_option( 'sticky_menu_text_color' ) . ";
}

/* Sticky Simply Menu Type */
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li:hover > a,
#grve-header[data-menu-type='simply'].grve-header-sticky #grve-main-menu > ul > li.current-menu-ancestor > a,
#grve-header.grve-header-sticky .grve-menu-options li a:hover {
	color: " . grve_option( 'sticky_menu_text_hover_color' ) . ";
}

/* Sticky Button Menu Type */
#grve-header[data-menu-type='button'].grve-header-sticky #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='button'].grve-header-sticky #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='button'].grve-header-sticky #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='button'].grve-header-sticky #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='button'].grve-header-sticky #grve-main-menu > ul > li:hover > a,
#grve-header.grve-header-sticky .grve-menu-options li a .grve-purchased-items {
	color: " . grve_option( 'sticky_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'sticky_menu_active_bg_color' ) . ";
}

/* Sticky Box Menu Type */
#grve-header[data-menu-type='box'].grve-header-sticky #grve-main-menu > ul > li.current-menu-item > a,
#grve-header[data-menu-type='box'].grve-header-sticky #grve-main-menu > ul > li.current-menu-parent > a,
#grve-header[data-menu-type='box'].grve-header-sticky #grve-main-menu > ul > li.current_page_item > a,
#grve-header[data-menu-type='box'].grve-header-sticky #grve-main-menu > ul > li.current_page_ancestor > a,
#grve-header[data-menu-type='box'].grve-header-sticky #grve-main-menu > ul > li:hover > a {
	color: " . grve_option( 'sticky_menu_active_text_color' ) . ";
	background-color: " . grve_option( 'sticky_menu_active_bg_color' ) . ";
}

/* Sticky Submenu Colors */
#grve-header.grve-header-sticky #grve-main-menu ul li ul a,
#grve-header.grve-header-sticky #grve-header-options ul.grve-options a,
#grve-header.grve-header-sticky #grve-main-menu ul li a:hover .label,
#grve-header.grve-header-sticky #grve-main-menu > ul > li.megamenu > ul > li > a:hover,
#grve-header.grve-header-sticky #grve-main-menu > ul > li.megamenu > ul {
	color: " . grve_option( 'sticky_submenu_text_color' ) . ";
	background-color: " . grve_option( 'sticky_submenu_bg_color' ) . ";
}

#grve-header.grve-header-sticky #grve-main-menu ul li.current-menu-item > a,
#grve-header.grve-header-sticky #grve-main-menu > ul > li.megamenu > ul > li > a {
	color: " . grve_option( 'sticky_submenu_text_hover_color' ) . ";
}

#grve-header.grve-header-sticky #grve-main-menu > ul > li.megamenu > ul > li,
#grve-header.grve-header-sticky #grve-main-menu ul li.divider {
	color: " . grve_option( 'sticky_submenu_text_color' ) . ";
}

#grve-header.grve-header-sticky #grve-main-menu ul li ul a:hover,
#grve-header.grve-header-sticky #grve-header-options ul.grve-options a:hover,
#grve-header.grve-header-sticky #grve-main-menu ul li a .label {
	color: " . grve_option( 'sticky_submenu_text_hover_color' ) . ";
	background-color: " . grve_option( 'sticky_submenu_hover_bg_color' ) . ";
}

#grve-header.grve-header-sticky #grve-main-menu > ul > li.megamenu > ul > li {
	border-color: " . grve_option( 'sticky_submenu_border_color' ) . ";
}

";

/* Sticky Safe Button Colors */
$grve_sticky_safe_button_bg_color = grve_option( 'sticky_safe_button_bg_color' );
$grve_sticky_safe_button_bg_hover_color = grve_option( 'sticky_safe_button_bg_hover_color' );
$css .= "

#grve-header.grve-header-sticky #grve-header-options > li > a.grve-open-button {
	color: " . grve_option( 'sticky_safe_button_icon_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_sticky_safe_button_bg_color ) . "," . grve_option( 'sticky_safe_button_bg_color_opacity' ) . ");
}

#grve-header.grve-header-sticky #grve-header-options > li:hover > a.grve-open-button {
	color: " . grve_option( 'sticky_safe_button_icon_hover_color' ) . ";
	background-color: rgba(" . grve_hex2rgb( $grve_sticky_safe_button_bg_hover_color ) . "," . grve_option( 'sticky_safe_button_bg_hover_color_opacity' ) . ");
}

";

/**
 * Logo
 * ----------------------------------------------------------------------------
 */

/* Default Logo */
$css .= "

#grve-header[data-logo-background='colored'].grve-default h1.grve-logo,
#grve-header[data-logo-background='advanced'].grve-default h1.grve-logo {
	background-color: " . grve_option( 'logo_background_color' ) . ";
}

#grve-header.grve-default h1.grve-logo a.grve-dark,
#grve-header.grve-default h1.grve-logo a.grve-light,
#grve-header.grve-default h1.grve-logo a.grve-sticky {
	display: none;
}

";


/* Light Logo */
$css .= "

#grve-header[data-logo-background='colored'].grve-light h1.grve-logo,
#grve-header[data-logo-background='advanced'].grve-light h1.grve-logo {
	background-color: " . grve_option( 'logo_light_background_color' ) . ";
}

";

/* Dark Logo */
$css .= "

#grve-header[data-logo-background='colored'].grve-dark h1.grve-logo,
#grve-header[data-logo-background='advanced'].grve-dark h1.grve-logo {
	background-color: " . grve_option( 'logo_dark_background_color' ) . ";
}

";


/* Sticky Logo */
$css .= "

#grve-header[data-logo-background='colored'].grve-header-sticky h1.grve-logo,
#grve-header[data-logo-background='advanced'].grve-header-sticky h1.grve-logo {
	background-color: " . grve_option( 'logo_sticky_background_color' ) . ";
}

";


/* Page Title Colors */

$css .= "

#grve-page-title,
.error404 #grve-main-content {
	background-color: " . grve_option( 'page_title_background_color' ) . ";
}

";

/**
 * Portfolio Title & Portfolio Description
 * ----------------------------------------------------------------------------
 */
$css .= "

#grve-portfolio-title {
	background-color: " . grve_option( 'portfolio_title_background_color' ) . ";
}

";


/**
 * Single Post Title
 * ----------------------------------------------------------------------------
 */
$css .= "

#grve-post-title {
	background-color: " . grve_option( 'post_title_background_color' ) . ";
}

";

/* Page Anchor Menu */

$css .= "
#grve-anchor-menu {
	height: " . grve_option( 'page_anchor_menu_height', 70 ) . "px;
	line-height: " . grve_option( 'page_anchor_menu_height', 70 ) . "px;
}

#grve-anchor-menu,
#grve-anchor-menu.grve-responsive-bar ul li {
	background-color: " . grve_option( 'page_anchor_menu_background_color' ) . ";

}

#grve-anchor-menu ul li a {
	color: " . grve_option( 'page_anchor_menu_text_color' ) . ";
	background-color: transparent;
}

#grve-anchor-menu ul li.current-menu-item a,
#grve-anchor-menu ul li a:hover,
#grve-anchor-menu ul li.primary-button a {
	color: " . grve_option( 'page_anchor_menu_text_hover_color' ) . ";
	background-color: " . grve_option( 'page_anchor_menu_background_hover_color' ) . ";
}

#grve-anchor-menu ul li {
	border-color: " . grve_option( 'page_anchor_menu_border_color' ) . ";
}

";

/* Post Meta Bar Settings */

$css .= "

#grve-meta-bar {
	height: " . grve_option( 'post_fields_bar_height', 70 ) . "px;
	line-height: " . grve_option( 'post_fields_bar_height', 70 ) . "px;
}

#grve-meta-bar {
	background-color: " . grve_option( 'post_fields_bar_background_color' ) . ";
}

#grve-meta-bar ul li,
#grve-meta-bar ul li a,
#grve-post-title #grve-social-share.in-bar ul li a {
	color: " . grve_option( 'post_fields_bar_text_color' ) . " !important;
	background-color: transparent !important;
}

#grve-meta-bar ul li.current-menu-item a,
#grve-meta-bar ul li a:hover,
#grve-post-title #grve-social-share.in-bar ul li a:hover {
	color: " . grve_option( 'post_fields_bar_text_hover_color' ) . " !important;
	background-color: " . grve_option( 'post_fields_bar_background_hover_color' ) . " !important;
}

#grve-meta-bar ul.grve-post-nav li a {
	width: " . grve_option( 'post_fields_bar_height', 70 ) . "px;
}

#grve-meta-bar ul li,
#grve-post-title #grve-social-share.in-bar ul li a {
	border-color: " . grve_option( 'post_fields_bar_border_color' ) . " !important;
}

";


/**
 * Portfolio Meta Bar Settings
 * ----------------------------------------------------------------------------
 */

$css .= "

#grve-portfolio-bar {
	background-color: " . grve_option( 'portfolio_fields_bar_background_color' ) . ";
}

#grve-portfolio-bar ul li a,
#grve-portfolio-bar #grve-social-share ul li .grve-like-counter {
	color: " . grve_option( 'portfolio_fields_bar_text_color' ) . ";
	background-color: transparent;
}

#grve-portfolio-bar ul li a:hover {
	color: " . grve_option( 'portfolio_fields_bar_text_hover_color' ) . ";
	background-color: " . grve_option( 'portfolio_fields_bar_background_hover_color' ) . ";
}


#grve-portfolio-bar ul li,
#grve-portfolio-bar #grve-social-share ul li a {
	border-color: " . grve_option( 'portfolio_fields_bar_border_color' ) . ";
}

";


/* Main Content Colors */
$css .= "
#grve-main-content {
	background-color: " . grve_option( 'theme_body_background_color' ) . ";
}

";

/* Main Content Link Colors */
$css .= "
a {
	color: " . grve_option( 'body_text_link_color' ) . ";
}

a:hover {
	color: " . grve_option( 'body_text_link_hover_color' ) . ";
}

";

/* Above Footer Section Colors */

$css .= "

#grve-above-footer {
	background-color: " . grve_option( 'bottom_bar_bg_color' ) . ";
}

#grve-above-footer .grve-social li a,
#grve-above-footer .grve-social li:after {
	color: " . grve_option( 'bottom_bar_link_color' ) . ";
}


#grve-above-footer .grve-social li a:hover {
	color: " . grve_option( 'bottom_bar_hover_color' ) . ";
}

#grve-above-footer .grve-newsletter {
	color: " . grve_option( 'bottom_bar_text_color' ) . ";
}

#grve-above-footer .grve-newsletter input[type='submit'] {
	background-color: " . grve_option( 'bottom_bar_button_bg' ) . ";
	color: " . grve_option( 'bottom_bar_link_color' ) . ";
}

#grve-above-footer .grve-newsletter input[type='submit']:hover {
	background-color: " . grve_option( 'bottom_bar_button_hover_bg' ) . ";
	color: " . grve_option( 'bottom_bar_hover_color' ) . ";
}

";

/* Footer */

$css .= "

#grve-footer-area {
	background-color: " . grve_option( 'footer_widgets_bg_color' ) . ";
}

/* Widget Title Color */
#grve-footer-area h1,
#grve-footer-area h2,
#grve-footer-area h3,
#grve-footer-area h4,
#grve-footer-area h5,
#grve-footer-area h6,
#grve-footer-area .grve-widget-title,
#grve-footer-area .widget.widget_recent_entries li span.post-date,
#grve-footer-area .widget.widget_rss .grve-widget-title a {
	color: " . grve_option( 'footer_widgets_headings_color' ) . ";
}

/* Footer Text Color */
#grve-footer-area,
#grve-footer-area .widget.widget_tag_cloud a{
	color: " . grve_option( 'footer_widgets_font_color' ) . ";
}

#grve-footer-area .widget li a {
	color: " . grve_option( 'footer_widgets_link_color' ) . ";
}


/* Footer Text Hover Color */
#grve-footer-area .widget li a:hover {
	color: " . grve_option( 'footer_widgets_hover_color' ) . ";
}

#grve-footer-area input,
#grve-footer-area input[type='text'],
#grve-footer-area input[type='input'],
#grve-footer-area input[type='password'],
#grve-footer-area input[type='email'],
#grve-footer-area input[type='number'],
#grve-footer-area input[type='date'],
#grve-footer-area input[type='url'],
#grve-footer-area input[type='tel'],
#grve-footer-area input[type='search'],
#grve-footer-area .grve-search button[type='submit'],
#grve-footer-area textarea,
#grve-footer-area select,
#grve-footer-area .widget.widget_calendar table th,
#grve-footer-area .grve-widget.grve-social li a {
	border-color: " . grve_option( 'footer_widgets_border_color' ) . ";
}

";

/* Footer Bar */

$css .= "

#grve-footer-bar {
	background-color: " . grve_option( 'footer_bar_bg_color' ) . ";
	color: " . grve_option( 'footer_bar_font_color' ) . ";
}

#grve-footer-bar #grve-second-menu li a,
#grve-footer-bar .grve-social li a,
#grve-footer-bar .grve-social li:after {
	color: " . grve_option( 'footer_bar_link_color' ) . ";
}

#grve-footer-bar #grve-second-menu li a:hover,
#grve-footer-bar .grve-social li a:hover {
	color: " . grve_option( 'footer_bar_hover_color' ) . ";
}

";

/**
* Overlays
* ----------------------------------------------------------------------------
*/
/* Black */
$css .= "

.grve-dark-overlay:before {
	background-color: #000000;
}

";

/* White */
$css .= "

.grve-light-overlay:before {
	background-color: #ffffff;
}

";

/* Primary Colors */
$css .= "

.grve-primary-1-overlay:before {
	background-color: " . grve_option( 'body_primary_1_color' ) . ";
}

.grve-primary-2-overlay:before {
	background-color: " . grve_option( 'body_primary_2_color' ) . ";
}

.grve-primary-3-overlay:before {
	background-color: " . grve_option( 'body_primary_3_color' ) . ";
}

.grve-primary-4-overlay:before {
	background-color: " . grve_option( 'body_primary_4_color' ) . ";
}

.grve-primary-5-overlay:before {
	background-color: " . grve_option( 'body_primary_5_color' ) . ";
}


";

/**
 * Typography Colors
 * ----------------------------------------------------------------------------
 */

/* Text Color */
$css .= "

#grve-main-content,
.grve-bg-light,
#grve-main-content .grve-sidebar-colored.grve-bg-light a,
#grve-anchor-menu,
#grve-main-content .grve-post-author a,
#grve-main-content .widget.widget_categories li a,
#grve-main-content .widget.widget_pages li a,
#grve-main-content .widget.widget_archive li a,
#grve-main-content .widget.widget_nav_menu li a,
#grve-main-content .widget.widget_tag_cloud a,
#grve-main-content .widget.widget_meta a,
#grve-main-content .widget.widget_recent_entries a,
#grve-main-content .widget.widget_recent_comments a.url,
#grve-main-content .grve-widget.grve-comments a.url,
#grve-main-content .grve-widget.grve-latest-news a,
#grve-social-share-responsive ul li a,
#grve-main-content .grve-widget.grve-social li a,
.grve-tags li a,
.grve-categories li a,
#grve-comments .grve-comment-item .grve-comment-date a:hover,
.grve-pagination ul li a,
.grve-filter ul li:after,
input[type='text'],
input[type='input'],
input[type='password'],
input[type='email'],
input[type='number'],
input[type='date'],
input[type='url'],
input[type='tel'],
input[type='search'],
textarea,
select,
#grve-meta-responsive ul li a,
.grve-map-infotext p,
#grve-main-content .grve-image-hover .grve-light.grve-caption,
#grve-main-content .grve-image-hover .grve-light.grve-team-identity,
.grve-team .grve-team-social li a,
.grve-comment-nav ul li a,
.grve-pagination ul li:after,
.grve-search button[type='submit'] .grve-icon-search,
.grve-top-btn,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce #content nav.woocommerce-pagination ul li a,
.woocommerce #content nav.woocommerce-pagination ul li span,
.woocommerce-page nav.woocommerce-pagination ul li a,
.woocommerce-page nav.woocommerce-pagination ul li span,
.woocommerce-page #content nav.woocommerce-pagination ul li a,
.woocommerce-page #content nav.woocommerce-pagination ul li span,
.woocommerce ul.products li.product .price,
.woocommerce-page ul.products li.product .price,
.woocommerce-page .star-rating span:before,
.woocommerce-page .woocommerce-product-rating a,
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
ul.product-categories li a,
.woocommerce.widget_product_tag_cloud .tagcloud a,
.product_meta a {
	color: " . grve_option( 'body_text_color' ) . ";
}

.grve-testimonial .owl-controls .owl-page span {
	background-color: " . grve_option( 'body_text_color' ) . ";
}

";

/* Headings Color */
$css .= "

#grve-main-content h1,
#grve-main-content h2,
#grve-main-content h3,
#grve-main-content h4,
#grve-main-content h5,
#grve-main-content h6,
#grve-main-content .grve-post-title,
.grve-blog .grve-read-more,
#grve-main-content .more-link,
#grve-main-content .widget.widget_rss cite,
#grve-main-content .widget.widget_rss .grve-widget-title a,
#grve-main-content .widget.widget_recent_comments a:hover,
#grve-main-content .grve-widget.grve-comments a:hover,
#grve-main-content .widget.widget_recent_entries li span.post-date,
#grve-main-content .grve-widget.grve-comments .grve-comment-date,
#grve-main-content .grve-widget.grve-latest-news .grve-latest-news-date,
.widget.widget_calendar table th,
.grve-tags li:first-child,
.grve-categories li:first-child,
#grve-comments .comment-reply-link:hover,
#grve-comments .grve-comment-item .grve-author a,
#grve-comments .comment-edit-link,
#respond .comment-reply-title small a:hover,
#respond .comment-notes,
#grve-main-content .grve-read-more:hover,
#grve-main-content .more-link:hover,
.grve-label-post.format-quote .grve-post-meta .grve-like-counter span,
#grve-share-modal .grve-social li a,
#grve-language-modal .grve-language li a,
.grve-accordion .grve-title.active,
.grve-toggle .grve-title.active,
#grve-meta-responsive ul li span,
input[type='text']:hover,
input[type='input']:hover,
input[type='password']:hover,
input[type='email']:hover,
input[type='number']:hover,
input[type='date']:hover,
input[type='url']:hover,
input[type='tel']:hover,
input[type='search']:hover,
textarea:hover,
select:hover,
input[type='text']:focus,
input[type='password']:focus,
input[type='email']:focus,
input[type='number']:focus,
input[type='date']:focus,
input[type='url']:focus,
input[type='tel']:focus,
input[type='search']:focus,
textarea:focus,
#grve-main-content .grve-image-hover .grve-light.grve-title,
#grve-main-content .grve-image-hover.grve-style-1 .grve-light.grve-team-name,
.grve-related-wrapper small,
.grve-product-name a,
.woocommerce table.shop_table th,
.woocommerce-page table.shop_table th,
.woocommerce ul.cart_list li a,
.woocommerce ul.product_list_widget li a,
.woocommerce-page ul.cart_list li a,
.woocommerce-page ul.product_list_widget li a,
.product_meta {
	color: " . grve_option( 'body_heading_color' ) . ";
}

";

if ( is_singular( 'post' ) ) {
    $grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'post_sidebar_bg_color' ), 'none' );
} else if ( is_singular( 'page' ) ) {
        $grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'page_sidebar_bg_color' ), 'none' );
} else if ( is_singular( 'portfolio' ) ) {
        $grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', grve_option( 'portfolio_sidebar_bg_color' ), 'none' );
} else {
    if ( grve_woocommerce_enabled() ) {
        if( is_product() ) {
            $grve_sidebar_bg_color = grve_post_meta( 'grve_sidebar_bg_color', 'none' );
        } else if ( is_shop() || is_product_category() || is_product_tag() ) {
            $grve_sidebar_bg_color = grve_post_meta_shop( 'grve_sidebar_bg_color', 'none' );
        } else {
            $grve_sidebar_bg_color = grve_option( 'blog_sidebar_bg_color', 'none' );
        }
    } else {
        $grve_sidebar_bg_color = grve_option( 'blog_sidebar_bg_color', 'none' );
    }
}

if( 'none' != $grve_sidebar_bg_color && 'light' != $grve_sidebar_bg_color ) {

/* Sidebar Colored */
$css .= "

#grve-main-content .grve-sidebar-colored h1,
#grve-main-content .grve-sidebar-colored h2,
#grve-main-content .grve-sidebar-colored h3,
#grve-main-content .grve-sidebar-colored h4,
#grve-main-content .grve-sidebar-colored h5,
#grve-main-content .grve-sidebar-colored h6,
#grve-main-content .grve-sidebar-colored a,
#grve-main-content .grve-sidebar-colored,
#grve-main-content .grve-sidebar-colored .widget.widget_categories li a,
#grve-main-content .grve-sidebar-colored .widget.widget_pages li a,
#grve-main-content .grve-sidebar-colored .widget.grve-contact-info li a,
#grve-main-content .grve-sidebar-colored .widget.widget_archive li a,
#grve-main-content .grve-sidebar-colored .widget.widget_nav_menu li a,
#grve-main-content .grve-sidebar-colored .widget.widget_tag_cloud a,
#grve-main-content .grve-sidebar-colored .widget.widget_meta a,
#grve-main-content .grve-sidebar-colored .widget.widget_recent_entries a,
#grve-main-content .grve-sidebar-colored .widget.widget_recent_comments a.url,
#grve-main-content .grve-sidebar-colored .grve-widget.grve-comments a.url,
#grve-main-content .grve-sidebar-colored .grve-widget.grve-latest-news a,
#grve-main-content .grve-sidebar-colored .grve-widget.grve-social li a,
#grve-main-content .grve-sidebar-colored .widget.widget_rss .grve-widget-title a,
#grve-main-content .grve-sidebar-colored .widget.widget_rss cite,
#grve-main-content .grve-sidebar-colored .grve-widget.grve-latest-news .grve-latest-news-date,
#grve-main-content .grve-sidebar-colored .grve-widget.grve-comments .grve-comment-date,
#grve-main-content .grve-sidebar-colored th {
	color: #ffffff;
}

";

}

/* Sidebar Primary Colored Headings */
$css .= "

#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_categories li a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_pages li a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_archive li a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_nav_menu li a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_tag_cloud a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_meta a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_recent_entries a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_recent_comments a.url:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .grve-widget.grve-comments a.url:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .grve-widget.grve-latest-news a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .grve-widget.grve-social li a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_rss .grve-widget-title a:hover,
#grve-main-content .grve-sidebar-colored.grve-bg-primary-1 .widget.widget_rss a {
	color: #000000 !important;
}

";



/* Primary #1 Colors */
$css .= "

.grve-color-primary-1,
.grve-color-primary-1:before,
.grve-color-primary-1:after,
#grve-main-content .grve-primary-1 h1,
#grve-main-content .grve-primary-1 h2,
#grve-main-content .grve-primary-1 h3,
#grve-main-content .grve-primary-1 h4,
#grve-main-content .grve-primary-1 h5,
#grve-main-content .grve-primary-1 h6,
#grve-meta-responsive li a:hover,
#grve-feature-section .grve-title.grve-primary-1,
#grve-page-title .grve-title.grve-primary-1,
#grve-post-title .grve-title.grve-primary-1,
#grve-portfolio-title .grve-title.grve-primary-1,
#grve-feature-section .grve-goto-section.grve-primary-1,
ul.grve-fields li:before,
.widget.widget_calendar a,
#grve-main-content .grve-post-title:hover,
#grve-main-content .grve-post-author a:hover,
.grve-blog.grve-isotope[data-type='pint-blog'] .grve-isotope-item .grve-media-content .grve-post-icon,
.grve-blog.grve-isotope[data-type='pint-blog'] .grve-isotope-item.grve-label-post.format-quote a .grve-post-icon:before,
#grve-main-content .widget.widget_categories li a:hover,
#grve-main-content .widget.widget_archive li a:hover,
#grve-main-content .widget.widget_pages li a:hover,
#grve-main-content .widget.widget_nav_menu li a:hover,
#grve-main-content .widget.widget_nav_menu li.current-menu-item a,
#grve-main-content .widget li .rsswidget,
#grve-main-content .widget.widget_recent_comments a.url:hover,
#grve-main-content .widget.widget_recent_comments a,
#grve-main-content .grve-widget.grve-comments a.url:hover,
#grve-main-content .grve-widget.grve-comments a,
#grve-main-content .widget.widget_meta a:hover,
#grve-main-content .widget.widget_recent_entries a:hover,
#grve-main-content .widget.grve-contact-info a,
#grve-main-content .grve-widget.grve-latest-news a:hover,
.grve-tags li a:hover,
.grve-categories li a:hover,
#grve-main-content .grve-read-more,
#grve-main-content .more-link,
#grve-comments .comment-reply-link,
#grve-comments .grve-comment-item .grve-author a:hover,
#grve-comments .grve-comment-item .grve-comment-date a,
#grve-comments .comment-edit-link:hover,
#respond .comment-reply-title small a,
.grve-blog .grve-like-counter span,
.grve-pagination ul li a.current,
.grve-pagination ul li a:hover,
.grve-accordion .grve-title.active:before,
.grve-toggle .grve-title.active:before,
.grve-filter ul li.selected,
.grve-portfolio-item .grve-portfolio-btns li a:hover,
#grve-main-content figure.grve-style-1 .grve-team-social li a:hover,
#grve-main-content figure.grve-style-2 .grve-team-social li a:hover,
#grve-main-content .grve-team a:hover .grve-team-name.grve-dark,
#grve-main-content .grve-team a:hover .grve-team-name,
.grve-hr .grve-divider-backtotop:after,
.grve-testimonial-name span,
.grve-testimonial-name:before,
.grve-list li:before,
#grve-feature-section .grve-description.grve-primary-1,
#grve-page-title .grve-description.grve-primary-1,
#grve-portfolio-title .grve-description.grve-primary-1,
.grve-carousel-wrapper .grve-custom-title-content.grve-primary-1 .grve-caption,
.grve-comment-nav ul li a:hover,
.grve-pagination ul li .current,
.grve-search button[type='submit']:hover .grve-icon-search,
.grve-product-item .star-rating span:before,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce #content nav.woocommerce-pagination ul li span.current,
.woocommerce #content nav.woocommerce-pagination ul li a:hover,
.woocommerce #content nav.woocommerce-pagination ul li a:focus,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a:focus,
.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
.woocommerce table.cart a.remove:hover,
.woocommerce #content table.cart a.remove:hover,
.woocommerce-page table.cart a.remove:hover,
.woocommerce-page #content table.cart a.remove:hover,
.woocommerce-page div.product p.price,
.woocommerce-page .single_variation,
.woocommerce-page tr.order-total td,
.woocommerce-checkout .product-quantity,
.woocommerce .widget_price_filter .price_slider_amount span.from,
.woocommerce-page .widget_price_filter .price_slider_amount span.from,
.woocommerce .widget_price_filter .price_slider_amount span.to,
.woocommerce-page .widget_price_filter .price_slider_amount span.to,
.woocommerce ul.cart_list li a:hover,
.woocommerce ul.product_list_widget li a:hover,
.woocommerce-page ul.cart_list li a:hover,
.woocommerce-page ul.product_list_widget li a:hover,
ul.product-categories li a:hover,
.woocommerce.widget_product_tag_cloud .tagcloud a:hover,
.product_meta a:hover {
	color: " . grve_option( 'body_primary_1_color' ) . ";
}

";


/* Primary #2 Colors */
$css .= "

.grve-color-primary-2,
.grve-color-primary-2:before,
.grve-color-primary-2:after,
#grve-main-content .grve-primary-2 h1,
#grve-main-content .grve-primary-2 h2,
#grve-main-content .grve-primary-2 h3,
#grve-main-content .grve-primary-2 h4,
#grve-main-content .grve-primary-2 h5,
#grve-main-content .grve-primary-2 h6,
#grve-feature-section .grve-title.grve-primary-2,
#grve-feature-section .grve-goto-section.grve-primary-2,
#grve-page-title .grve-title.grve-primary-2,
#grve-post-title .grve-title.grve-primary-2,
#grve-portfolio-title .grve-title.grve-primary-2,
.grve-blog.grve-isotope[data-type='pint-blog'] .grve-isotope-item.grve-label-post.format-link a .grve-post-icon:before,
#grve-feature-section .grve-description.grve-primary-2,
#grve-page-title .grve-description.grve-primary-2,
#grve-portfolio-title .grve-description.grve-primary-2,
.grve-carousel-wrapper .grve-custom-title-content.grve-primary-2 .grve-caption {
	color: " . grve_option( 'body_primary_2_color' ) . ";
}

";


/* Primary #3 Colors */
$css .= "

.grve-color-primary-3,
.grve-color-primary-3:before,
.grve-color-primary-3:after,
#grve-main-content .grve-primary-3 h1,
#grve-main-content .grve-primary-3 h2,
#grve-main-content .grve-primary-3 h3,
#grve-main-content .grve-primary-3 h4,
#grve-main-content .grve-primary-3 h5,
#grve-main-content .grve-primary-3 h6,
#grve-feature-section .grve-title.grve-primary-3,
#grve-feature-section .grve-goto-section.grve-primary-3,
#grve-page-title .grve-title.grve-primary-3,
#grve-post-title .grve-title.grve-primary-3,
#grve-portfolio-title .grve-title.grve-primary-3,
#grve-feature-section .grve-description.grve-primary-3,
#grve-page-title .grve-description.grve-primary-3,
#grve-portfolio-title .grve-description.grve-primary-3,
.grve-carousel-wrapper .grve-custom-title-content.grve-primary-3 .grve-caption {
	color: " . grve_option( 'body_primary_3_color' ) . ";
}

";


/* Primary #4 Colors */
$css .= "

.grve-color-primary-4,
.grve-color-primary-4:before,
.grve-color-primary-4:after,
#grve-main-content .grve-primary-4 h1,
#grve-main-content .grve-primary-4 h2,
#grve-main-content .grve-primary-4 h3,
#grve-main-content .grve-primary-4 h4,
#grve-main-content .grve-primary-4 h5,
#grve-main-content .grve-primary-4 h6,
#grve-feature-section .grve-title.grve-primary-4,
#grve-feature-section .grve-goto-section.grve-primary-4,
#grve-page-title .grve-title.grve-primary-4,
#grve-post-title .grve-title.grve-primary-4,
#grve-portfolio-title .grve-title.grve-primary-4,
#grve-feature-section .grve-description.grve-primary-4,
#grve-page-title .grve-description.grve-primary-4,
#grve-portfolio-title .grve-description.grve-primary-4,
.grve-carousel-wrapper .grve-custom-title-content.grve-primary-4 .grve-caption {
	color: " . grve_option( 'body_primary_4_color' ) . ";
}

";


/* Primary #5 Colors */
$css .= "

.grve-color-primary-5,
.grve-color-primary-5:before,
.grve-color-primary-5:after,
#grve-main-content .grve-primary-5 h1,
#grve-main-content .grve-primary-5 h2,
#grve-main-content .grve-primary-5 h3,
#grve-main-content .grve-primary-5 h4,
#grve-main-content .grve-primary-5 h5,
#grve-main-content .grve-primary-5 h6,
#grve-feature-section .grve-title.grve-primary-5,
#grve-feature-section .grve-goto-section.grve-primary-5,
#grve-page-title .grve-title.grve-primary-5,
#grve-post-title .grve-title.grve-primary-5,
#grve-portfolio-title .grve-title.grve-primary-5,
#grve-feature-section .grve-description.grve-primary-5,
#grve-page-title .grve-description.grve-primary-5,
#grve-portfolio-title .grve-description.grve-primary-5,
.grve-carousel-wrapper .grve-custom-title-content.grve-primary-5 .grve-caption {
	color: " . grve_option( 'body_primary_5_color' ) . ";
}

";


/* Dark Colors */
$css .= "

#grve-main-content .grve-dark h1,
#grve-main-content .grve-dark h2,
#grve-main-content .grve-dark h3,
#grve-main-content .grve-dark h4,
#grve-main-content .grve-dark h5,
#grve-main-content .grve-dark h6,
.grve-carousel-wrapper .grve-custom-title-content.grve-dark .grve-caption {
	color: #000000;
}

";

/* Dark Colors */
$css .= "

#grve-main-content .grve-light h1,
#grve-main-content .grve-light h2,
#grve-main-content .grve-light h3,
#grve-main-content .grve-light h4,
#grve-main-content .grve-light h5,
#grve-main-content .grve-light h6,
.grve-carousel-wrapper .grve-custom-title-content.grve-light .grve-caption {
	color: #ffffff;
}

";

/**
 * Main Body Borders
 * ----------------------------------------------------------------------------
 */
$css .= "

#grve-tags-categories,
#grve-about-author,
#grve-comments,
#grve-comments .grve-comment-item,
#grve-comments .children:before,
#grve-comments .children article.comment,
#grve-main-content .widget.widget_tag_cloud a,
#grve-meta-social-responsive,
#grve-main-content .grve-widget.grve-social li a,
#grve-post-area article.grve-single-post,
#respond,
.grve-related-wrapper small,
#respond input[type='text'],
#respond textarea,
.grve-blog.grve-large-media .grve-blog-item,
.grve-blog.grve-small-media .grve-blog-item,
.grve-newsletter-form input[type='email'],
.grve-search input[type='text'],
#grve-share-modal .grve-social li a,
#grve-social-share-responsive ul li a,
#grve-language-modal .grve-language li a,
.grve-accordion-wrapper li,
.grve-toggle-wrapper li,
.grve-bar,
.grve-pricing-table,
.grve-pricing-table ul li,
#grve-main-content table,
#grve-main-content tr,
#grve-main-content td,
#grve-main-content th,
pre,
hr,
.grve-hr.grve-element,
.grve-title-double-line span:before,
.grve-title-double-line span:after,
.grve-title-double-bottom-line span:after,
#grve-main-content input,
#grve-main-content input[type='text'],
#grve-main-content input[type='input'],
#grve-main-content input[type='password'],
#grve-main-content input[type='email'],
#grve-main-content input[type='number'],
#grve-main-content input[type='date'],
#grve-main-content input[type='url'],
#grve-main-content input[type='tel'],
#grve-main-content input[type='search'],
.grve-search button[type='submit'],
#grve-main-content textarea,
#grve-main-content select,
#grve-newsletter-modal input,
#grve-newsletter-modal input[type='text'],
#grve-newsletter-modal input[type='input'],
#grve-newsletter-modal input[type='password'],
#grve-newsletter-modal input[type='email'],
#grve-newsletter-modal input[type='number'],
#grve-newsletter-modal input[type='date'],
#grve-newsletter-modal input[type='url'],
#grve-newsletter-modal input[type='tel'],
#grve-newsletter-modal input[type='search'],
#grve-newsletter-modal textarea,
#grve-newsletter-modal select,
.grve-portfolio-description + ul.grve-fields,
.grve-portfolio-info + .widget,
.grve-related-post,
.grve-carousel-wrapper .grve-post-item .grve-content,
.woocommerce .product_meta,
#grve-shop-modal .cart_list.product_list_widget li,
#grve-shop-modal .cart_list.product_list_widget,
.woocommerce.widget_product_tag_cloud .tagcloud a,
.woocommerce ul.products li .grve-product-item,
.woocommerce-page ul.products li .grve-product-item,
.woocommerce ul.products li .grve-product-item .grve-product-media,
.woocommerce-page ul.products li .grve-product-item .grve-product-media {
	border-color: " . grve_option( 'body_border_color' ) . ";
}

";

/**
* Primary Backgrounds Colors
* ----------------------------------------------------------------------------
*/

/* Dark Bg #1 Colors */
$css .= "

.grve-bg-dark {
	background-color: #000000;
	color: #ffffff;
}

";

/* Light Bg #1 Colors */
$css .= "

.grve-bg-light {
	background-color: #ffffff;
}

";


/* Primary Bg #1 Colors */
$css .= "

.grve-bg-primary-1,
.grve-bar-line.grve-primary-1-color,
#grve-header #grve-main-menu > ul > li.primary-button > a,
#grve-feature-section .grve-style-4 .grve-title.grve-primary-1 span,
.grve-tabs-title li.active,
#grve-social-share-responsive ul li a:hover,
#grve-share-modal .grve-social li a:hover,
#grve-language-modal .grve-language li a:hover,
#grve-language-modal .grve-language li a.active,
#grve-main-content .grve-widget.grve-social li a:hover,
#grve-footer-area .grve-widget.grve-social li a:hover,
.grve-portfolio .grve-like-counter,
#grve-feature-section .grve-style-1 .grve-title:after,
#grve-feature-section .grve-style-4 .grve-title:before,
#grve-feature-section .grve-style-4 .grve-title span:before,
#grve-feature-section .grve-style-4 .grve-title:after,
#grve-feature-section .grve-style-4 .grve-title span:after,
.widget.widget_calendar caption,
.grve-element.grve-social ul li a,
#grve-post-title #grve-social-share.grve-primary-1 ul li a,
.wpcf7-validation-errors,
.grve-title-line span:after,
blockquote:before,
.grve-blog.grve-isotope[data-type='pint-blog'] .grve-isotope-item .grve-media-content .grve-read-more:before,
.grve-blog.grve-isotope[data-type='pint-blog'] .grve-isotope-item .grve-media-content .more-link:before,
.grve-blog .grve-label-post.format-quote a,
input[type='submit'],
.grve-testimonial .owl-controls .owl-page.active span,
.grve-testimonial .owl-controls.clickable .owl-page:hover span,
.grve-slider-item .grve-slider-content span:after,
.grve-pricing-feature .grve-pricing-header,
.grve-modal-content a.grve-close-modal,
.woocommerce span.onsale,
.woocommerce input.checkout-button,
#grve-shop-modal a.button.checkout,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: " . grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

.grve-btn.grve-btn-line.grve-bg-primary-1 {
	color: " . grve_option( 'body_primary_1_color' ) . ";
	border-color: " . grve_option( 'body_primary_1_color' ) . ";
}

#grve-social-share-responsive ul li a:hover,
#grve-main-content .grve-widget.grve-social li a:hover,
#grve-footer-area .grve-widget.grve-social li a:hover {
	border-color: " . grve_option( 'body_primary_1_color' ) . ";
}

.grve-btn.grve-bg-primary-1:hover,
.grve-tabs-title li:hover,
#grve-header #grve-main-menu > ul > li.primary-button > a:hover,
.grve-element.grve-social ul li a:hover,
.grve-modal-content a.grve-close-modal:hover,
#grve-post-title #grve-social-share.grve-primary-1 ul li a:hover {
	background-color: " . grve_option( 'body_primary_1_hover_color' ) . ";
	border-color: " . grve_option( 'body_primary_1_hover_color' ) . ";
	color: #ffffff;
}

/* Tagcloud Hover */
.widget.widget_tag_cloud a:hover,
.woocommerce.widget_product_tag_cloud .tagcloud a:hover {
	border-color: " . grve_option( 'body_primary_1_color' ) . ";
	background-color: " . grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff !important;
}

";

/* Primary Bg #2 Colors */
$css .= "

.grve-bg-primary-2,
.grve-pricing-header,
.grve-bar-line.grve-primary-2-color,
#grve-feature-section .grve-style-4 .grve-title.grve-primary-2 span,
.grve-blog .grve-label-post.format-link a,
#grve-post-title #grve-social-share.grve-primary-2 ul li a {
	background-color: " . grve_option( 'body_primary_2_color' ) . ";
	color: #ffffff;
}

.grve-btn.grve-btn-line.grve-bg-primary-2 {
	color: " . grve_option( 'body_primary_2_color' ) . ";
	border-color: " . grve_option( 'body_primary_2_color' ) . ";
}

.grve-btn.grve-bg-primary-2:hover,
#grve-post-title #grve-social-share.grve-primary-2 ul li a:hover {
	background-color: " . grve_option( 'body_primary_2_hover_color' ) . ";
	border-color: " . grve_option( 'body_primary_2_hover_color' ) . ";
	color: #ffffff;
}

";

/* Primary Bg #3 Colors */
$css .= "

.grve-bg-primary-3,
.grve-bar-line.grve-primary-3-color,
#grve-feature-section .grve-style-4 .grve-title.grve-primary-3 span,
#grve-post-title #grve-social-share.grve-primary-3 ul li a {
	background-color: " . grve_option( 'body_primary_3_color' ) . ";
	color: #ffffff;
}

.grve-btn.grve-btn-line.grve-bg-primary-3 {
	color: " . grve_option( 'body_primary_3_color' ) . ";
	border-color: " . grve_option( 'body_primary_3_color' ) . ";
}

.grve-btn.grve-bg-primary-3:hover,
#grve-post-title #grve-social-share.grve-primary-3 ul li a:hover {
	background-color: " . grve_option( 'body_primary_3_hover_color' ) . ";
	border-color: " . grve_option( 'body_primary_3_hover_color' ) . ";
	color: #ffffff;
}

";

/* Primary Bg #4 Colors */
$css .= "

.grve-bg-primary-4,
.grve-bar-line.grve-primary-4-color,
#grve-feature-section .grve-style-4 .grve-title.grve-primary-4 span,
#grve-post-title #grve-social-share.grve-primary-4 ul li a {
	background-color: " . grve_option( 'body_primary_4_color' ) . ";
	color: #ffffff;
}

.grve-btn.grve-btn-line.grve-bg-primary-4 {
	color: " . grve_option( 'body_primary_4_color' ) . ";
	border-color: " . grve_option( 'body_primary_4_color' ) . ";
}

.grve-btn.grve-bg-primary-4:hover,
#grve-post-title #grve-social-share.grve-primary-4 ul li a:hover {
	background-color: " . grve_option( 'body_primary_4_hover_color' ) . ";
	border-color: " . grve_option( 'body_primary_4_hover_color' ) . ";
	color: #ffffff;
}
";

/* Primary Bg #5 Colors */
$css .= "

.grve-bg-primary-5,
.grve-bar-line.grve-primary-5-color,
#grve-feature-section .grve-style-4 .grve-title.grve-primary-5 span,
#grve-post-title #grve-social-share.grve-primary-5 ul li a {
	background-color: " . grve_option( 'body_primary_5_color' ) . ";
	color: #ffffff;
}

.grve-btn.grve-btn-line.grve-bg-primary-5 {
	color: " . grve_option( 'body_primary_5_color' ) . ";
	border-color: " . grve_option( 'body_primary_5_color' ) . ";
}

.grve-btn.grve-bg-primary-5:hover,
#grve-post-title #grve-social-share.grve-primary-5 ul li a:hover {
	background-color: " . grve_option( 'body_primary_5_hover_color' ) . ";
	border-color: " . grve_option( 'body_primary_5_hover_color' ) . ";
	color: #ffffff;
}

";


/* Trim css for speed */
$css_trim =  preg_replace( '/\s+/', ' ', $css );

/* Add stylesheet Tag */
$css_out = "<!-- Dynamic css -->\n<style type=\"text/css\">\n" . $css_trim . "\n</style>";

echo $css_out;

?>
