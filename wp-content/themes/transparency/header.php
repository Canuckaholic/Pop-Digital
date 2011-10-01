<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<!-- BEGIN html head -->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ie.css" /><![endif]-->
</head>
<!-- END html head -->

<body>
<!-- BEGIN wrapper -->
<div id="wrapper">
	<!-- BEGIN header -->
	<div id="header">
		<!-- begin navigation -->
		<ul>
		<li<?php if (is_home()) echo ' class="here"'; ?>><a href="<?php echo get_option('home'); ?>">Home</a></li>
		<?php dp_list_pages(); ?>
		</ul>
		<!-- end navigation -->
		<a id="subscribe" href="<?php bloginfo('rss2_url'); ?>">Subscribe</a>
		<!-- begin logo -->
		<div id="logo">
		<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
		<p id="description"><?php bloginfo('description'); ?></p>
		</div>
		<!-- end logo -->
		<!-- begin about -->
		<div id="about"><img src="<?php bloginfo('template_url'); ?>/images/about.jpg" alt="About" /><p>Hi! Welcome to my Personal Site! Pls feel free to browse around my Free WordPress Themes and get to know me. <a href="#">More</a>..</p></div>
		<!-- end about -->
	<div class="break"></div>
	</div>
	<!-- END header -->
	<!-- BEGIN body -->
	<div id="body">
