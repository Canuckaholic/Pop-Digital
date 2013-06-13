<?php
/**
 * Outputs the HTML for the Options page
 */
function webtreats_admin_options() {
global $themename, $shortname, $options, $webtreats_categories;
?>

<?php screen_icon('options-general'); ?>
<h2 class="webtreats-page-title"><?php echo $themename; ?> Theme Settings</h2>

<?php
$hidden_anchor = $_REQUEST['hidden_anchor'];
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade below-h2"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade below-h2"><p><strong>'.$themename.' settings reset.</strong></p></div>';
if ( $_REQUEST['error'] ) echo '<div id="message" class="updated fade below-h2"><p><strong>Sidebar already exists, please use a different name.</strong></p></div>';
if ( $_GET['upgraded'] )  echo '<div id="message" class="updated fade below-h2"><p><strong>'.$themename.' is now activated. To get the most out of everything '.$themename.' has to offer please refer to the PDF documentation file that was include in the download. Should you require further assistance you can contact us thru our ThemeForest profile page <a target="_blank" href="http://themeforest.net/user/Webtreats">here.</a></strong></p></div>';
?>

<div id="slider" class="wrap">
	<ul id="tabs">
		<li><a href="#generalsettings"><?php echo 'General Settings'; ?></a></li>
		<li><a href="#homepage"><?php echo 'Homepage'; ?></a></li>
		<li><a href="#blog"><?php echo 'Blog'; ?></a></li>
		<li><a href="#sidebar"><?php echo 'Sidebar'; ?></a></li>
		<li><a href="#footersettings"><?php echo 'Footer'; ?></a></li>
		<li><a href="#navsettings"><?php echo 'Navagation'; ?></a></li>
	</ul>

<form method="post" action="">
	
<input id="hidden_anchor" type="hidden" name="hidden_anchor" value="" />

<?php 
$get_options = get_option($shortname.'_general_settings');
foreach ($options as $value) {
$id = $value['id'];
$selector = ($value['selector']) ? ' class="selector"' : '';

switch ( $value['type'] ) {
	
case "opentab":
?>
<div id="<?php echo $value['id']; ?>">
	<h2><?php echo $value['name']; ?></h2>
<?php

break;
case "closetab":
?>
</div>
<?php

break;
case "title_h2":
?>
<table class="form-table webtreats-options">
<?php

break;
case "title_h3":
?>
<h3><?php echo $value['name']; ?></h3>
<table class="form-table webtreats-options">
<?php

break;
case "close":
?>
</table>
<?php

break;
case 'text':
?>
<tr valign="top" <?php if ($value['selector']) {echo 'id="toggle_click" class="selected_categories"';} if ( ($get_options['homepage_slider'] == 'custom' || $get_options['homepage_slider'] == 'flash' || $get_options['homepage_slider'] == '') && ($value['selector']) ){echo ' style="display:none"';} ?>>
<th align="left"><?php echo $value['name']; ?></th>
<td><input size="<?php echo $value['size']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo stripslashes(htmlspecialchars($get_options[$id])); ?>" />
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php 

break;
case 'text_teaser':
?>
<tr valign="top" <?php if ($value['selector']) {echo 'id="toggle_click" class="selected_customtext"';} if ( ($get_options['header_teaser'] == 'twitter' || $get_options['header_teaser'] == 'disable') && ($value['selector']) ){echo 'style=" display:none"';} ?>>
<th align="left"><?php echo $value['name']; ?></th>
<td><input size="70" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_options[$id])); ?>" />
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php

break;
case 'textarea':
?>
<tr valign="top">
<th><?php echo $value['name']; ?></th>
<td><textarea name="<?php echo $value['id']; ?>" cols="62" rows="7"><?php if ( $get_options[$id] != "") { echo stripslashes($get_options[$id]); } else { echo $value['std']; } ?></textarea>
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php

break;
case "checkbox":
?>
<tr>
<th align="left"><?php echo $value['name']; ?></th>
<td width="80%"><?php if($get_options[$id]){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />&nbsp;&nbsp;<span><?php echo $value['desc']; ?></span>
</td>
</tr>
<?php

break;
case 'select':
?>
<tr>
<th align="left"><?php echo $value['name']; ?></th>
<td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<option value="">Choose a color scheme</option>  
<?php
foreach ($value['options'] as $option){

if ($get_options[$id] == $option){
$selected = "selected='selected'";
	}else{
$selected = "";		
}
echo"<option $selected value='". $option."'>". $option."</option>";
}
?>
</select>
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php

break;
case 'select_pg':
?>
<tr>
<th align="left"><?php echo $value['name']; ?></th>
<td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<option value="">Select Page</option>  
<?php 
foreach ($value['options'] as $page){

if ($get_options[$id] == $page->ID){
$selected = "selected='selected'";
	}else{
$selected = "";		
}
echo"<option $selected value='". $page->ID."'>". $page->post_title."</option>";
}
?>
</select>
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php

break;
case "radio":
?>
<tr>
<th valign="top"><?php echo $value['name']; ?></th>
<td>
<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['value']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value'] || $get_options[$id] == ""){echo 'checked="checked"';}?> /> <?php echo $value['desc']; ?></label><br />
<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio" value="<?php echo $value['value2']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value2']){echo 'checked="checked"';}?> /> <?php echo $value['desc2']; ?></label>
</td>
</tr>
<?php

break;
case "radio_toggle":
?>
<tr>
<th valign="top"><?php echo $value['name']; ?></th>
<td>
<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['value']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value'] || $get_options[$id] == ""){echo 'checked="checked"';}?> /> <?php echo $value['desc']; ?></label><br />

<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio" value="<?php echo $value['value2']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value2']){echo 'checked="checked"';}?> /> <?php echo $value['desc2']; ?></label><br />

<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_3" type="radio" value="<?php echo $value['value3']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value3']){echo 'checked="checked"';}?> /> <?php echo $value['desc3']; ?></label>
</td>
</tr>
<?php

break;
case "exclude_include_checkbox":
?>
<?php if ($value['selector']) { ?>
<tr id="toggle_click" class="selected_categories" <?php if ($get_options['homepage_slider'] == 'custom' || $get_options['homepage_slider'] == 'flash' || $get_options['homepage_slider'] == ''){echo 'style="display:none"';}?>>
<?php }else{ ?>
<tr valign="top">
<?php } ?>
<th align="left"><?php echo $value['name']; ?></th>
<td id="<?php echo $value['id']; ?>" class="webtreats_box_select">
<?php if($get_options[$id]){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<?php
foreach ($value['options'] as $webtreats_pgid => $webtreats_pgname) {
if ($webtreats_pgname !='') {
echo '<div style="border:1px solid #cccccc;margin-right:4px;margin-bottom:4px;padding:4px;white-space:nowrap;float:left;width:120px;overflow:hidden;"><input type="checkbox" name="'.$webtreats_pgid.'" id="'.$value['id'].'_'.$webtreats_pgid.'" class="select_' .$value['id']. '" /> '.$webtreats_pgname.'</div>';
}
}
?>

<div style="clear:both"></div>
<input style="width:400px;" readonly="readonly" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( $get_options[$id] != '') { echo stripslashes($get_options[$id]); } else { echo $value['std']; } ?>" />
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php

break;
case "custom_slider":
?>
<?php if ($get_options['homepage_slider'] == 'categories' || $get_options['homepage_slider'] == 'flash'){$homepage_slider_custom = true;}

$get_custom_options = get_option($shortname.'_custom_slider');

if (!$get_custom_options['custom_slider_count']) {
	$get_custom_options['custom_slider_count'] = 1;
} 
?>

<div id="toggle_click" class="<?php if(!$homepage_slider_custom){echo 'multitables ';} ?>selected_custom"<?php if($homepage_slider_custom){echo ' style="display:none"';} ?>>

<input name="custom_slider_count" class="<?php if(!$homepage_slider_custom){echo 'slider_counter ';} ?>count_hide_rm" type="hidden" value="<?php echo $get_custom_options['custom_slider_count'] ?>" />
	
<p><input type="submit" class="button-secondary apply add_row" value="Click to add new row" /></p>

<table class="widefat table_sort">
	
<thead>
<tr>
<th width="60px">Reorder</th>
<th>Delete</th>
<th width="400px">Setting</th>
<th>Description</th>
</tr>
</thead>

<tfoot>
<tr>
<th>&nbsp;</th>
<th></th>
<th></th>
<th></th>
</tr>
</tfoot>

<tbody>
<?php 
$count = $get_custom_options['custom_slider_count'] +1;
for($z = 0; $z < $count; $z++) {
?>
<tr class="<?php if(!$homepage_slider_custom){echo 'multitable ';} ?>multitable_hide_rm<?php if ($z+1 == $count) echo ' hidden'; if($z+1 == $count && !$homepage_slider_custom) echo ' clone_row';?>">
	
<td class="slider_drag">
<span class="changenumber"><?php echo $z+1; ?></span>
</td>

<td>
<a href='#' title="Delete Row" class='del_row' id='del_number_<?php echo $z + 1; ?>'><img src="<?php echo get_template_directory_uri() .'/lib/admin/images/slider_delete.png'; ?>"  alt="Delete Row" /></a>
</td>

<td>
<div style="float:left;width:76px;">Image URL</div>
<input class="correct_num" id="custom_slider_url_<?php echo $z; ?>" name="custom_slider_url_<?php echo $z; ?>" type="text" value="<?php echo $get_custom_options['custom_slider_url_'.$z] ?>" size="30"/><br />
<div style="float:left;width:76px;">Link URL</div>
<input class="correct_num" id="custom_slider_link_<?php echo $z; ?>" name="custom_slider_link_<?php echo $z; ?>" type="text" value="<?php echo $get_custom_options['custom_slider_link_'.$z] ?>" size="30"/><br />
<div style="float:left;width:76px;">Title</div>
<input class="correct_num" id="custom_slider_title_<?php echo $z; ?>" name="custom_slider_title_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_custom_options['custom_slider_title_'.$z])); ?>" size="30"/><br />
<div style="float:left;width:76px;">Stage Effect</div>
<select class="correct_num" id="custom_slider_stage_<?php echo $z; ?>" name="custom_slider_stage_<?php echo $z; ?>">
<?php
$stage_effect = array("stage","full","full-cropped");
foreach ($stage_effect as $stage_effect) {
if ($get_custom_options['custom_slider_stage_'.$z] == $stage_effect && $z+1 != $count){
$selected = "selected='selected'";	
}else{
$selected = "";		
}
echo"<option $selected value='". $stage_effect."'>". $stage_effect."</option>";
}
?>
</select><br />
<?php if($get_custom_options['custom_slider_btn_'.$z]){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
<div style="float:left;width:150px;padding-right:1px">Disable "Read More" Button</div>
<input class="correct_num" type="checkbox" id="custom_slider_btn_<?php echo $z; ?>" name="custom_slider_btn_<?php echo $z; ?>" value="true" <?php echo $checked; ?> />
</td>

<td>
<textarea rows="3" cols="50" class="correct_num" id="custom_slider_desc_<?php echo $z; ?>" name="custom_slider_desc_<?php echo $z; ?>"><?php echo stripslashes(htmlspecialchars($get_custom_options['custom_slider_desc_'.$z])); ?></textarea>
</td>

</tr>
<?php } ?>
</tbody>
	
</table>
	
</div>
<?php

break;
case "sidebar":
?>
<tr valign="top">
<th align="left"><?php echo $value['name']; ?></th>
<td><input size="<?php echo $value['size']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( $get_options[$id] != "") { echo $get_options[$id]; } else { echo $value['std']; } ?>" />
<br /><span><?php echo $value['desc']; ?></span></td>
</tr>
<?php 

break;
case "sidebar_delete":
?>
<table class="form-table webtreats-options">
<?php
$get_sidebar_options = sidebar_generator_webtreats::get_sidebars();
if($get_sidebar_options != "") {
$i=1;

foreach ($get_sidebar_options as $sidebar_gen) { ?>
<?php if($i == 1) { ?>
<tr valign="top">
<th align="left"></th>
<td><div align="left"><h3 style="margin-bottom:0px"><?php echo $value['desc']; ?></h3></div></td>
</tr>
<?php } ?>

<tr id="sidebar_table_<?php echo $i; ?>">
<th align="left"></th>
<td>
<div align="left" style="float:left;font-size:13px;width:150px;overflow:hidden;"><?php echo $sidebar_gen; ?></div>
<div style="float:left;"><input type="submit" name="sidebar_rm_<?php echo $i; ?>" id="<?php echo $i; ?>" class="button" value="Delete" /></div>
<div style="margin:3px 0 0 8px;float:left;"><img class="sidebar_rm_<?php echo $i; ?>" style="display:none;" src="images/wpspin_light.gif" alt="Loading" /></div>
</td>
<th align="left"><input id="<?php echo 'sidebar_generator_'.$i ?>" type="hidden" name="<?php echo 'sidebar_generator_'.$i ?>" value="<?php echo $sidebar_gen; ?>" /></th>
</tr>
<?php $i++;  
} 
}

break;
case "submit":
?>
<div class="submit webtreats-submit"><input class="button-primary" type="submit" name="save" value="Save changes"/><input type="hidden" name="action" value="save" /></div>
<?php

break;

}
}
?>

</form>
</div><!-- slider -->
<?php 
}

/**
 * Start Admin Functions
 */
function webtreats_add_admin_options() {
	global $themename, $shortname, $options ,$page_handle;
	$hidden_anchor = $_REQUEST['hidden_anchor'];
	$send = $_GET['page'];
	if ( $_GET['page'] == $page_handle ) {
	if ( 'save' == $_REQUEST['action'] ) {
	
		// Updates homepage slider settings
		foreach ($_POST as $key => $value) {
			if ( preg_match("/flash_slider_/", $key) ) {
				$options_slider[$key] = $value;	
			}
			if ( preg_match("/custom_slider_/", $key) ) {
				$options_slider_custom[$key] = $value;
			}
		
			delete_option( $shortname.'_flash_slider');
			delete_option( $shortname.'_custom_slider');
			update_option( $shortname.'_flash_slider', $options_slider);
			update_option( $shortname.'_custom_slider', $options_slider_custom);
		}
		
		//Updates genearal settings
		foreach ($options as $value) {		
			if($value['id'] != 'sidebar_generator_0'){
				$options_array[$value['id']] = $_REQUEST[ $value['id'] ]; 
			}
		}
			update_option( $shortname.'_general_settings', $options_array);
	
		//Updates sidebar settings
		$get_sidebar_options = sidebar_generator_webtreats::get_sidebars();
		$sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_generator_0']);
		$sidebar_id = sidebar_generator_webtreats::name_to_class($sidebar_name);
		if($sidebar_id == '' ){
			$options_sidebar = $get_sidebar_options;
		}else{
			if(isset($get_sidebar_options[$sidebar_id])){
				header("Location: admin.php?page=$send&error=true$hidden_anchor");	
				die;
			}
			if ( is_array($get_sidebar_options) ) {
				$new_sidebar_gen[$sidebar_id] = $sidebar_id;
				$options_sidebar = array_merge($get_sidebar_options, (array) $new_sidebar_gen);	
			}else{
				$options_sidebar[$sidebar_id] = $sidebar_id;
			}		
		 }
		
		update_option( $shortname.'_sidebar_generator', $options_sidebar);
		header("Location: admin.php?page=$send&saved=true$hidden_anchor");
		die;
			} else if( 'reset' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
			delete_option( $value['id'] ); }
			header("Location: admin.php?page=$send&reset=true$hidden_anchor");
		die;
		}
	}
		add_menu_page($themename." Options", $themename, 'edit_themes', $page_handle, 'webtreats_admin_options');
}

function ajax_update_widgets($sidebar_id) {
	$get_widgets = wp_get_sidebars_widgets();
	unset( $get_widgets['array_version'] );

	$before_delete = true; $i=0;
	foreach ($get_widgets as $key => $value) {
		if( !preg_match('/webtreats_sidebar-([0-9]+)/', $key) ) {
				$update_widgets[$key] = $value;			
		}
		if( preg_match('/webtreats_sidebar-([0-9]+)/', $key) ) {
			if($key == "webtreats_sidebar-$sidebar_id") {
				$before_delete = false; $inactive_widgets = $value; }
			if( ($key != "webtreats_sidebar-$sidebar_id") && ($before_delete == true) ) {
				$update_widgets[$key] = $value; }		
			if( ($key != "webtreats_sidebar-$sidebar_id") && ($before_delete == false) ) {
				$update_widgets['webtreats_sidebar-'.$i] = $value; }
			$i++;
		}
	}
	$update_widgets['wp_inactive_widgets'] = array_merge($inactive_widgets, (array) $update_widgets['wp_inactive_widgets']);
	wp_set_sidebars_widgets($update_widgets);
}

function ajax_sidebar_rm() {	
	global $shortname, $wpdb;
	$sidebar = $_POST['sidebar'];
	$sidebar_id = $_POST['sidebar_id'];
	$sidebar_name = $_POST['sidebar_name'];
	$pieces = explode(",", $sidebar);

	foreach ($pieces as $key => $value) {
		if($value != '')
			$options_sidebar_rm[ $value ] = $value;
		}
		update_option( $shortname.'_sidebar_generator', $options_sidebar_rm);
		ajax_update_widgets($sidebar_id);

		$sidebar_meta = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$sidebar_name'", ARRAY_A);
		if ( is_array($sidebar_meta) ){
			foreach ($sidebar_meta as $key => $value) {
				delete_post_meta($value['post_id'], 'selected_sidebar');
		}
	}
}

add_action('wp_ajax_sidebar_rm', 'ajax_sidebar_rm');
add_action('wp_ajax_show_hide_pgs', 'ajax_show_hide_pgs');
add_action('admin_menu', 'webtreats_add_admin_options');

?>