<?php
$themename = "inFocus";
$shortname = "infocus";
$page_handle = $shortname . '-options';

/* Get Categories */
$webtreats_categories_obj = get_categories('hide_empty=0');
$webtreats_categories = array();
$webtreats_categories[] = '';
foreach ($webtreats_categories_obj as $webtreats_cat) {
	$webtreats_categories[$webtreats_cat->cat_ID] = $webtreats_cat->cat_name;
}

/* Get Pages into a drop-down list */
$pages_list = get_pages();
$getpagnav = array();
foreach($pages_list as $apage) {
	$getpagnav[$apage->ID] = $apage->post_title;
}

/* Get Stylesheets into a drop-down list */
$styles = array();
if(is_dir(TEMPLATEPATH . "/styles/")) {
	if($open_dirs = opendir(TEMPLATEPATH . "/styles/")) {
		while(($style = readdir($open_dirs)) !== false) {
			if(stristr($style, ".css") !== false) {
				$styles[] = $style;
			}
		}
	}
}
$style_dropdown = $styles;

/* The Options*/
$options = array (
		
		array(	"name" => "General Settings",
			"id" => "generalsettings",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
		
		
		array(	"name" => "Theme Stylesheet",
			"desc" => "Please select your color scheme here.",
			"id" => "color_scheme",
			"type" => "select",
			"std" => "deep_blue.css",
			"options" => $styles),
			
		array(	"name" => "Display Blog Title or Custom of Logo",
			"desc" => "Display Logo",
			"desc2" => "Display Blog Title",
			"value" => "",
			"value2" => "1",
			"id" => "site_name",
			"type" => "radio"),
		
		array(	"name" => "Custom Logo",
			"desc" => "Paste the full URL of your custom logo image e.g. 'http://www.yoursite.com/logo.png'.",
			"id" => "custom_logo",
			"type" => "text",
			"size" => "70"),
			
		array(	"name" => "Twitter Username",
			"desc" => "Enter your Twitter Username.",
			"id" => "twitter_id",
			"type" => "text",
			"size" => "70"),
			
		array(	"name" => "Header Teaser Text",
			"desc" => "Custom",
			"desc2" => "Twitter",
			"desc3" => "Disable",
			"value" => "customtext",
			"value2" => "twitter",
			"value3" => "disable",
			"id" => "header_teaser",
			"type" => "radio_toggle",
			"std" => "customtext",
			'selector' => true),
			
		array(	"name" => "Header Teaser Style",
			"desc" => "Outset",
			"desc2" => "Inset",
			"value" => "",
			"value2" => "1",
			"id" => "teaser_style",
			"type" => "radio"),
			
		array(	"name" => "Header Teaser Custom Text",
			"desc" => "Enter your header teaser custom text here.",
			"id" => "teaser_custom",
			"type" => "text_teaser",
			"std" => "A state permitting clear perception and understanding; the area that may be seen distinctly or resolved into a clear image.",
			'selector' => true),
						
		array(	"name" => "Disable Cufon?",
			"desc" => "Check this box if you want to disable the Cufon Font Replacement Plugin.",
			"id" => "cufon_disable",
			"type" => "checkbox"),
			
		array(	"name" => "Disable Breadcrumbs?",
			"desc" => "Check this box if you want to disable Breadcrumb navigation.",
			"id" => "breadcrumb_disable",
			"type" => "checkbox"),
			
		array(	"name" => "Google Analytics",
			"desc" => "Insert your Google Analytics (or other) code here.",
			"id" => "analytics_code",
			"type" => "textarea"),
			
		array(	"type" => "close"),
		
		array(	"type" => "submit"),
		
		array(	"type" => "closetab"),
		
		array(	"name" => "Homepage Settings",
			"id" => "homepage",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
		
		array(	"name" => "Teaser Text",
			"desc" => "Enter the Text that should be displayed below the front page slider.",
			"id" => "teaser_text",
			"type" => "text",
			"std" => "A state permitting clear perception and understanding; the area that may be seen distinctly or resolved into a clear image.",
			"size" => "70"),
			
		array(	"name" => "Teaser Button",
			"desc" => "Choose the Page the button next to the teaser text should link to.",
			"id" => "teaser_button",
			"type" => "select_pg",
			"std" => false,
			"options" => $pages_list),
			
		array(	"name" => "Mainpage Content Area",
			"desc" => "The Page you choose here will display the introduction text on the mainpage.",
			"id" => "mainpage_content",
			"type" => "select_pg",
			"std" => false,
			"options" => $pages_list),
			
		array(	"name" => "Disable Homepage Teaser Text?",
			"desc" => "Check this box if you want to disable the homepage teaser text",
			"id" => "home_teaser_disable",
			"type" => "checkbox"),
			
		array(	"type" => "close"),
		
		array(	"name" => "Image Slider Autorotation",
			"type" => "title_h3"),

		array(	"name" => "Homepage Slider Autorotation",
			"desc" => "Autorotation on",
			"desc2" => "Autorotation off",
			"value" => "",
			"value2" => "1",
			"id" => "slider_disable",
			"type" => "radio"),

		array(	"name" => "Slider Transition Speed",
			"desc" => "Enter transition time for slider in milliseconds (1 Second = 1000 milliseconds), default is 5 seconds.",
			"id" => "slider_speed",
			"std" => "5000",
			"type" => "text",
			"size" => "13"),

		array(	"type" => "close"),
		
		array(	"name" => "Image Slider Source",
			"type" => "title_h3"),
			
		array(	"name" => "Homepage Image Slider Source",
			"desc" => "I Would Like to Custom Define the Images and URLs that the Homepage Slider use",
			"desc2" => "I Would Like the Homepage Image Slider to use Post Catagores that I Choose",
			"value" => "custom",
			"value2" => "categories",
			"id" => "homepage_slider",
			"std" => "custom",
			"type" => "radio",
			'selector' => true),
			
		array(	"type" => "close"),
					
		array(	"type" => "title_h2"),
			
		array(  "name" => "Select the post categories that will populate the image slider",
			"desc" => "Select the post categories that will populate the image slider.",
			"id" => "slider_showcats",
			"std" => "",
			"type" => "exclude_include_checkbox",
			"options" => $webtreats_categories,
			'selector' => true),
			
		array(  "name" => "Enter the number of slider images to display",
			"desc" => "Enter the number of slider images to display (default is 5).",
			"id" => "slider_count",
			"std" => "5",
			"type" => "text",
			"size" => "4",
			'selector' => true),
			
		array(	"type" => "close"),
		
		array(	"name" => "Custom Slider",
			"type" => "custom_slider"),

		array(	"type" => "submit"),
			
		array(	"type" => "closetab"),
		
		array(	"name" => "Blog Settings",
			"id" => "blog",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
		
		array(	"name" => $themename. " Blog Page",
			"desc" => "The Page you choose here will display the Blog in addition to the normal page content.",
			"id" => "blog_page",
			"type" => "select_pg",
			"std" => false,
			"options" => $pages_list),
			
		array(  "name" => "Exclude Categroies",
			"desc" => "The blog Page displays all Categories, since sometimes you want to exclude some of these categories (for example portfolio entries) you can exclude multiple categories here.",
			"id" => "blog_excludecats",
			"std" => "",
			"type" => "exclude_include_checkbox",
			"options" => $webtreats_categories),
			
		array(	"name" => "Disable Related &amp; Popular Post Module?",
			"desc" => "Check this box if you want to disable the related &amp; popular post module.",
			"id" => "related_popular_posts",
			"type" => "checkbox"),
				
		array(	"name" => "Disable Social Bookmarks?",
			"desc" => "Check this box if you want to disable the social bookmarks module.",
			"id" => "social_bookmarks",
			"type" => "checkbox"),
					
		array(	"name" => "Disable About Author Box?",
			"desc" => "Check this box if you want to disable the about author box module.",
			"id" => "about_author",
			"type" => "checkbox"),
		
		array(	"type" => "close"),
			
		array(	"type" => "submit"),	
			
		array(	"type" => "closetab"),
		
		array(	"name" => "Sidebar",
			"id" => "sidebar",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
		
		array(	"name" => "Add Sidebar",
			"desc" => "Enter the name of the new sidebar that you would like to create.",
			"id" => "sidebar_generator_0",
			"type" => "sidebar",
			"size" => "70"),
		
		array(	"type" => "close"),
			
		array(	"name" => "Sidebars created",
			"desc" => "Below are the Sidebars you have created",
			"type" => "sidebar_delete"),
		
		array(	"type" => "close"),
		
		array(	"type" => "submit"),
			
		array(	"type" => "closetab"),
		
		array(	"name" => "Footer",
			"id" => "footersettings",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
		
		array(	"name" => "Copyright Footer Text",
			"desc" => "Enter the copyright text that you would like to display in the footer.",
			"id" => "footer_text",
			"type" => "text",
			"std" => "&copy; 2009 WebTreats ETC. All Rights Reserved",
			"size" => "70"),
			
		array(  "name" => "Include Footer Page Links",
			"desc" => "Choose the pages you want to include in the footer.",
			"id" => "footer_include",
			"std" => "",
			"type" => "exclude_include_checkbox",
			"options" => $getpagnav),
		
		array(	"type" => "close"),
		
		array(	"type" => "submit"),
			
		array(	"type" => "closetab"),
		
		array(	"name" => "Menu Navigation",
			"id" => "navsettings",
			"type" => "opentab"),
			
		array(	"type" => "title_h2"),
			
		array(  "name" => "Excluded/Included pages from menu.",
			"desc" => "The Selected pages will will not show up in the menu.<br /> If you exclude a page with sub pages both will be excluded from the menu. ",
			"id" => "show_hide_pg",
			"std" => "",
			"type" => "exclude_include_checkbox",
			"options" => $getpagnav),
			
		array(	"type" => "close"),
		
		array(	"type" => "submit"),
			
		array(	"type" => "closetab"),

);

?>