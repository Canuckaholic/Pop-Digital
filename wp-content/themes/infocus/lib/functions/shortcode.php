<?php
/**
 * Theme Short-code Functions
 */

//************************************* Contact Form

function custom_contact_form_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'email'      => '',
    ), $atts));
    
    $out = webtreats_contact_form($email);
    
    return $out;
}
add_shortcode('contactform', 'custom_contact_form_sc');

//************************************* Buttons

function webtreats_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));

	$out = "<a class=\"button_link\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
    return $out;
}
add_shortcode('button', 'webtreats_button');


//************************************* Header

function webtreats_fancy_header( $atts, $content = null ) {
   return '<p class="fancy_header"><span>' . do_shortcode($content) . '</span></p>';
}
add_shortcode('fancy_header', 'webtreats_fancy_header');

//************************************* Dropcaps

function webtreats_drop_cap_1( $atts, $content = null ) {
   return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'webtreats_drop_cap_1');


function webtreats_drop_cap_2( $atts, $content = null ) {
   return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'webtreats_drop_cap_2');

//************************************* Pullquotes

function webtreats_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'webtreats_pullquote_right');


function webtreats_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'webtreats_pullquote_left');

//************************************* Image Frames

function webtreats_frame_left( $atts, $content = null ) {
   return '<span class="frame alignleft"><img src="' . do_shortcode($content) . '" /></span>';
}
add_shortcode('frame_left', 'webtreats_frame_left');


function webtreats_frame_right( $atts, $content = null ) {
   return '<span class="frame alignright"><img src="' . do_shortcode($content) . '" /></span>';
}
add_shortcode('frame_right', 'webtreats_frame_right');


function webtreats_frame_center( $atts, $content = null ) {
   return '<span class="frame aligncenter"><img src="' . do_shortcode($content) . '" /></span>';
}
add_shortcode('frame_center', 'webtreats_frame_center');

//************************************* Box Styles

function webtreats_download_box( $atts, $content = null ) {
   return '<div class="download_box">' . do_shortcode($content) . '</div>';
}
add_shortcode('download_box', 'webtreats_download_box');


function webtreats_warning_box( $atts, $content = null ) {
   return '<div class="warning_box">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning_box', 'webtreats_warning_box');


function webtreats_info_box( $atts, $content = null ) {
   return '<div class="info_box">' . do_shortcode($content) . '</div>';
}
add_shortcode('info_box', 'webtreats_info_box');


function webtreats_note_box( $atts, $content = null ) {
   return '<div class="note_box">' . do_shortcode($content) . '</div>';
}
add_shortcode('note_box', 'webtreats_note_box');


function webtreats_fancy_box( $atts, $content = null ) {
   return '<div class="fancy_box">' . do_shortcode($content) . '</div>';
}
add_shortcode('fancy_box', 'webtreats_fancy_box');



//************************************* List Styles

function webtreats_check_list( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check_list">', do_shortcode($content));
	return $content;
	
}
add_shortcode('check_list', 'webtreats_check_list');


function webtreats_arrow_list( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrow_list">', do_shortcode($content));
	return $content;
	
}
add_shortcode('arrow_list', 'webtreats_arrow_list');

//************************************* Toggle Content

function webtreats_toggle_content( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));
	
	$out .= '<h3 class="toggle"><a href="#">' .$title. '</a></h3>';
	$out .= '<div class="toggle_content" style="display: none;">';
	$out .= '<div class="block">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('toggle', 'webtreats_toggle_content');


//************************************* Highlight Styles

function webtreats_highlight1( $atts, $content = null ) {
   return '<span class="highlight1">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight1', 'webtreats_highlight1');


function webtreats_highlight2( $atts, $content = null ) {
   return '<span class="highlight2">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight2', 'webtreats_highlight2');


//************************************* Divider Styles

function webtreats_divider( $atts, $content = null ) {
   return '<div class="divider"></div>';
}
add_shortcode('divider', 'webtreats_divider');


function webtreats_divider_top( $atts, $content = null ) {
   return '<div class="divider top"><a href="#">Top</a></div>';
}
add_shortcode('divider_top', 'webtreats_divider_top');


//************************************* Columns


function webtreats_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');


function webtreats_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');


function webtreats_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');


function webtreats_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');


function webtreats_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');


function webtreats_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');


function webtreats_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');


function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');


function webtreats_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');


function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

?>