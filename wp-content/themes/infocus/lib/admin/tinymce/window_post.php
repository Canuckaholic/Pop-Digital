<?php

// Bootstrap file for getting the ABSPATH constant to wp-load.php
require_once('config.php');

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $themename .' Shortcode'; ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/admin/tinymce/tinymce.js"></script>
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('portfolio_category').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="webtreats_portfolio" action="#">
	<div class="tabs">
		<ul>
			<li id="portfolio_tab" style="display:none;"><span><a href="javascript:mcTabs.displayTab('portfolio_tab','portfolio_panel');" onmousedown="return false;"><?php echo 'Portfolio'; ?></a></span></li>
			<li id="style_tab" class="current"><span><a href="javascript:mcTabs.displayTab('style_tab','style_panel');" onmousedown="return false;"><?php echo 'Styles'; ?></a></span></li>
			<li id="contact_tab"><span><a href="javascript:mcTabs.displayTab('contact_tab','contact_panel');" onmousedown="return false;"><?php echo 'Contact Form'; ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height:142px;">
		<!-- portfolio_panel -->
		<div id="portfolio_panel" class="panel">
		<br />
		<fieldset>
			<legend>Select the Category and Gallery Type Below for your Portfolio</legend>
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="portfolio_category">Select category</label></td>
            <td><select id="portfolio_category" name="portfolio_category" style="width: 200px">
                <option value="0">No Category</option>
				<?php
					if(is_array($webtreats_categories)) {
						foreach($webtreats_categories as $webtreats_catid => $webtreats_catname) {
							if ($webtreats_catname !='') {
								echo '<option value="' . $webtreats_catid . '" >' . $webtreats_catid . ' - ' . $webtreats_catname . '</option>' . "\n";
							}
						}
					}
				?>
            </select></td>
          </tr>
          <tr>
            <td nowrap="nowrap" valign="top"><label for="portfolio_max">Images per page<br />(default is 9)</label></td>
            <td><input type="text" id="portfolio_max" name="portfolio_max" value="9"/><br /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" valign="top"><label for="showtype">Show as</label></td>
            <td><label><input name="showtype" type="radio" value="gallery" checked="checked" /> Gallery View</label><br />
			<label><input name="showtype" type="radio" value="full" /> Full View</label><br /></td>
          </tr>
        </table>
		</fieldset>
		</div><!-- portfolio_panel -->
		
		<!-- style_panel -->
		<div id="style_panel" class="panel current">
		<br />
		<fieldset>
			<legend>Select the Style Shortcode you would like to insert into the post.</legend>
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="style_shortcode">Select Custom Style:</label></td>
            <td><select id="style_shortcode" name="style_shortcode" style="width: 200px">
                <option value="0">No Style</option>
				<?php
				if(is_array($shortcode_tags)) {
					foreach ($shortcode_tags as $webtreats_sc_key => $webtreats_sc_value) {
						if( preg_match('/webtreats/', $webtreats_sc_value) ) {
							$webtreats_sc_name = str_replace('webtreats_', '' ,$webtreats_sc_value);
							$webtreats_sc_name = str_replace('_', ' ' ,$webtreats_sc_name);
							$webtreats_sc_name = ucwords($webtreats_sc_name);
							echo '<option value="' . $webtreats_sc_key . '" >' . $webtreats_sc_name . '</option>' . "\n";
						}
					}
				}
				?>
            </select></td>
          </tr>
        </table>
		</fieldset>
		</div>
		
		<!-- contact_panel -->
		<div id="contact_panel" class="panel">
		<br />
		<fieldset>
			<legend>Enter your Email address for the contact form below</legend>
		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="contact_email">Email Address:</label></td>
            <td><input type="text" id="contact_email" name="contact_email" size="44" /><br /></td>
          </tr>
        </table>
		</fieldset>
		</div><!-- contact_panel -->
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onclick="insertWebtreatsLink();" />
		</div>
	</div>
</form>
</body>
</html>
