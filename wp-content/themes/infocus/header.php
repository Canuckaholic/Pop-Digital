<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/lib/scripts/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php require(WEBTREATS_INCLUDES . "/var.php"); ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $color_scheme; ?>" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>	

<meta name="disable_cufon" content="<?php echo $cufon_disable; ?>" />
<meta name="slider_speed" content="<?php echo $slider_speed; ?>" />
<meta name="slider_disable" content="<?php echo $slider_disable; ?>" />

<?php
$css_style_path = str_replace('.css', '', $color_scheme);
if($css_style_path == 'black') {
	$css_style_path = '/images';
}else{
	$css_style_path = '/styles/' .$css_style_path;
}
$template_dir = get_template_directory_uri();
if(is_home()) { ?>
	
<script type="text/javascript">
/* <![CDATA[ */
jQuery.preloadImages("<?php echo $template_dir.$css_style_path; ?>/home_feature.jpg","<?php echo $template_dir.$css_style_path; ?>/stage.jpg","<?php echo $template_dir.$css_style_path; ?>/header.jpg","<?php echo $template_dir; ?>/images/slider_inactive.png","<?php echo $template_dir; ?>/images/buttons.gif","<?php echo $template_dir.$css_style_path; ?>/buttons.gif","<?php echo $template_dir; ?>/images/slider_active.png","<?php echo $template_dir.$css_style_path; ?>/drop.png","<?php echo $template_dir.$css_style_path; ?>/dropR.png","<?php echo $template_dir.$css_style_path; ?>/drop_sub.png");
/* ]]> */
</script>
<?php } ?>

</head>

<body<?php if(is_home()){echo' id="home_page"';} ?><?php if($teaser_style){echo' class="inset"';} ?>>
<div id="header">
	<div class="inner">
		<?php if($site_name) {
			 	$blog_title = get_bloginfo('name'); 
				$blog_title = ($blog_title) ? $blog_title : 'inFocus'; ?>
			<div id="site_name">
				<a href="<?php echo get_option('home'); ?>"><?php echo $blog_title; ?></a>
			</div>
		<?php }else{ ?>
			<div id="logo">
				<?php if(!$custom_logo) { ?>
					<div id="default_logo"><a href="<?php echo get_option('home'); ?>"></a></div><?php
				 }else{ ?>
					<a href="<?php echo get_option('home'); ?>"><img src="<?php echo $custom_logo; ?>" /></a><?php 
				 } ?>
			</div>
		<?php }

//Exclude a parent and all of that parent's child Pages
if($show_hide_pg) {
	$parent_pages_to_exclude = explode(",", $show_hide_pg);
	foreach($parent_pages_to_exclude as $parent_page_to_exclude) {
		if ($page_exclusions) { $page_exclusions .= ',' . $parent_page_to_exclude;
		}else{
			$page_exclusions = $parent_page_to_exclude; }
		$descendants = get_pages('child_of=' . $parent_page_to_exclude);
		if($descendants){
			foreach($descendants as $descendant) {
				$page_exclusions .= ',' . $descendant->ID;
			}
		}
	}	
}
?>
		<div id="main_navigation" class="jqueryslidemenu">
			<ul>
				<li <?php if (is_front_page()){echo 'class="current_page_item"';} ?> ><a href="<?php echo get_settings('home'); ?>">Home</a></li>
				<?php wp_list_pages("sort_column=menu_order&exclude=$page_exclusions&title_li="); ?>
			</ul>
			
		</div><!-- main_navigation -->				
	</div><!-- inner -->
</div><!-- header -->
