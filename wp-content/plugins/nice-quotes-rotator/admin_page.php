<?php

// search and replace 'nicequote_' with something.


function nicequote_create_menu() {
  nicequote_add_submenu_page('plugins.php','Nice Quote Options', 'Nice Quote Options', 'manage_options', "nicequote-options");
}


function nicequote_api_init(){

	nicequote_add_settings_section('nicequote_setting_section', '', 'Where should quotes be displayed', "nicequote-options");
	nicequote_add_settings_field('nq_admin', 'Should quotes be shown on the admin page?', 'radio', "nicequote-options", 'nicequote_setting_section', array (
	 "yes" => "Yes",
	 "no" => "No",
	));
	nicequote_add_settings_field('nq_quotes', 'Enter custom quotes here separated by a new-line<br /><br />(You may use use <code>&lt;br /&gt;</code> for multi-line quotes)', 'textarea', "nicequote-options", 'nicequote_setting_section', array (

	));

	nicequote_add_settings_field('nq_hello', 'include \'Hello Dolly\' lyrics in the custom quotes', 'checkbox', "nicequote-options", 'nicequote_setting_section', array (
	 "hello" => "Include 'Hello Dolly' lyrics",
	));


	nicequote_add_settings_field('nq_excerpts', 'What should be displayed in addition to the quotes entered above?', 'radio', "nicequote-options", 'nicequote_setting_section', array (
	 "no" => "No additional quotes <br />",
	 "excerpt" => "A random post excerpt<br />",
	 "link" => "A random link<br />",
	 "excerpt,link" => "both a random post excerpt and a random link<br />",
	));

	nicequote_add_settings_field('nq_links', 'Links from the following link-category may be added to the list of quotes depending on the option above.', 'dropdown_terms', "nicequote-options", 'nicequote_setting_section', array (
		'link_category'
	));

	nicequote_add_settings_field('nq_cats', 'Excerpts from the following category may be added to the list of quotes depending on the option above,', 'dropdown_cat', "nicequote-options", 'nicequote_setting_section', array (

	));

	nicequote_add_settings_field('nq_tag', 'This option defines which HTML tag is used to wrap the quote; this is especially useful if the theme has styling set up for specific tags', 'select', "nicequote-options", 'nicequote_setting_section', array (
	 "span" => "span",
	 "q" => "quote tag &lt;q>",	
	 "blockquote" => "blockquote",	
	 "p" => "paragraph text &lt;p>",	
	 "div" => "div",
	 "pre" => "pre",
	 "tt" => "teletype (for monospace fonts)",
	 "code" => "code (for monospace fonts)",
	));
}


// CHANGE THE LINES BELOW AT YOUR OWN RISK
// THE SKY WILL FALL ON YOUR HEAD

add_action('admin_menu', 'nicequote_create_menu');
add_action('admin_init', 'nicequote_api_init');

if ( ! function_exists( 'nicequote_plugin_options' ) ){
function nicequote_plugin_options() {
	global $nicequote_page_title;
	global $nicequote_page_parent;
	$page = $_GET["page"];
	echo '<div class="wrap">';
	echo "<div class='icon32 icon_$page' id='icon-options-general'><br/></div>";
	echo '<h2>' . $nicequote_page_title[$page] . '</h2>';
	echo '</div>';
	echo "<style>textarea.nq_quotes{width:90%; height:12em}</style>";
////	echo '<table class="form-table"><tr><td>';
	echo "<br /><a href='" .get_bloginfo("url"). "/wp-admin/plugin-install.php?tab=search&mc_find_plugins=TRUE'>" .__("Find more plugins by this author"). "</a>";
////	echo "</td></tr></table>";
	echo '<form action="options.php" method="post">';
	settings_fields( $page );
	do_settings_sections($page);
	echo '<br /><input type="submit" class="button-primary" value="' .  __('Save Changes') . '" />';
	echo '</form>';
}
}

if ( ! function_exists( 'nicequote_add_submenu_page' ) ){
function nicequote_add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function="", $icon_url="", $position=""){
	global $nicequote_page_title;
	global $nicequote_page_parent;
////	$temp_array = array("".$menu_slug => $page_title);
////	$nicequote_page_title = array_merge($nicequote_page_title, $temp_array);
	$nicequote_page_title[$menu_slug] = $page_title;
	$parent_slug = explode(",", $parent_slug);
	foreach ($parent_slug as $parent_slugX) {
		if($parent_slugX) {
			add_submenu_page($parent_slugX, $page_title, $menu_title, $capability, $menu_slug, "nicequote_plugin_options");
		} else {
			add_menu_page($page_title, $menu_title, $capability, $menu_slug, "nicequote_plugin_options", $icon_url, $position);
		}
	}
}
}

if ( ! function_exists( 'nicequote_add_settings_section' ) ){
function nicequote_add_settings_section($id, $title, $text, $pageX) {
	global $nicequote_setting_section_text;
	$nicequote_setting_section_text[$id] = $text;
	$pageX = explode(",", $pageX);
	foreach ($pageX as $page) {
		add_settings_section($id, $title, "nicequote_section_callback_function", $page);
	}
}
}


if ( ! function_exists( 'nicequote_add_settings_field' ) ){
function nicequote_add_settings_field($idSettingName, $title, $type, $pageX, $section, $args	){
	global $color_picker_count;
	if ($type=="colorpicker"){
		$color_picker_count++;
		if (!isset($color_picker_count)){
			$color_picker_count = 0;
		}
	}
	$args[] = $idSettingName;
	$args[] = $type;
	$pageX = explode(",", $pageX);
	foreach ($pageX as $page) {
		add_settings_field($idSettingName, $title, 'nicequote_field_callback_function', $page, $section, $args	);
		register_setting($page,$idSettingName);
	}
}
}

if ( ! function_exists( 'nicequote_section_callback_function' ) ){
function nicequote_section_callback_function($x) {
	global $nicequote_setting_section_text;
	echo $nicequote_setting_section_text[$x["id"]];
///	settings_fields( $x["id"] );
}
}

if ( ! function_exists( 'nicequote_field_callback_function' ) ){
function nicequote_field_callback_function($x){
	$type = array_pop($x);
	$id = array_pop($x);
	makeAdminOption($x, $id, $type);
}
}



if ( ! function_exists( 'makeAdminOption' ) ){

function makeAdminOption($vals, $my_field, $type) {
	global $color_picker_count;
	$my_string = "";
	$labelStart	= "";
	$labelEnd = "";
	$tag = "input";
	$option_test = get_option($my_field);
	if ($type=="checkbox"){
		echo "<input type='hidden' value='' name='$my_field' />";

	}
	elseif ($type=="dropdown_pages"){
		wp_dropdown_pages(array('name' => $my_field, 'selected' => $option_test));
		return;
	}
	elseif ($type=="dropdown_posts"){
		wp_dropdown_pages(array('name' => $my_field, 'selected' => $option_test, 'taxonomy' => $vals));
		return;
	}
	elseif ($type=="dropdown_author"){
		wp_dropdown_users(array('name' => $my_field, 'selected' => $option_test));
		return;
	}
	elseif ($type=="dropdown_terms"){
		wp_dropdown_categories(array('name' => $my_field, 'selected' => $option_test, 'taxonomy' => $vals));
		return;
	}
	elseif ($type=="dropdown_link" || $type=="dropdown_links"){
		wp_dropdown_categories(array('name' => $my_field, 'selected' => $option_test, 'taxonomy' => 'link_category'));
		return;
	}
	elseif ($type=="dropdown_categories" || $type=="dropdown_cat" || $type=="dropdown_cats"){
		wp_dropdown_categories(array('name' => $my_field, 'selected' => $option_test));
		return;
	}elseif ($type=="textarea"){
		echo "<textarea class='$my_field' name='$my_field'>" . $option_test . "</textarea>";
		return;
	}
	elseif ($type=="text" || $type=="password"){
		echo "<input type='$type' name='$my_field' value='$option_test' />";
		return;
	}
	elseif ($type=="colorpicker"){
		echo " <div id='colorpicker$color_picker_countX'></div>";
		echo "<input type='$text' id='color$color_picker_countX' name='$my_field' value='$option_test'/>" . $option_test, $my_field;
		$color_picker_count++;
		return;
	}
	elseif ($type=="select"){
		echo "<select id='$my_field' name='$my_field'>";
		$tag = "option";
	}

	foreach ($vals as $stateKey => $stateValue) {
		$is_selected = "";
		$option_test = get_option($my_field);
		if ($option_test== $stateKey) {
			if ($type == "radio" || $type == "checkbox"){
				$is_selected = "checked='checked'";
			} else {
				$is_selected = "selected='selected'";
			}
		}
		if ($type == "radio" || $type == "checkbox"){
			$is_selected .= "type='$type' name = '$my_field' id='" . $type . $stateKey . $stateValue . "' /";
			$labelStart = " &nbsp;<label for='"	.$type . $stateKey . $stateValue.	"'>";
			$labelEnd   = "</label> &nbsp;";
		}
		echo "<$tag value='$stateKey' $is_selected>";
		echo $labelStart . $stateValue . $labelEnd;	
		if ($type != "radio" && $type != "checkbox"){
			echo "</$tag>";	
		} elseif ($type == "checkbox") {
			return;
		}
	}
	if ($type=="select"){
		echo "</select>";
	}
	return $my_string;
}
}

?>