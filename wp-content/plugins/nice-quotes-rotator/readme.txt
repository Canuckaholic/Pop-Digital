=== Nice Quotes Rotator ===  
Contributors: CodeAndReload  
Donate link: http://www.codeandreload.com/wp-plugins/nicequotes/#donate  
Tags: quotation, quotations, quote, quotes, random, random quotes, rotating, shortcode, template, testimonies, testimony, widget, rotator  
Requires at least: 2.9  
Tested up to: 3.0.1  
Stable tag: 0.9


Allows display of random quotes via shortcode, a sidebar widget, and/or on the admin page. Quotes can be user-entered, post excerpts or links.


== Description ==

This plugin provides the ability to have randomly selected quotes displayed on the admin page, by using a
shortcode or by using a sidebar widget. The quotes include user-entered quotes, and can optionally include
excerpts from a user-chosen category and can also optionally include links from a user-chosen links category
There also is an option for including the lyrics from "Hello Dolly". The plugin can be used for random
quotes, rotating testimonials, rotating random affiliate links, or random featured posts. It was inspired by
the Hello Dolly plugin (hello.php) that comes bundled with WordPress.


== Installation ==

Installation is simple and straight-forward:

1. Unzip `nice-quotes.zip` into to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Configure the plugin options under the 'Plugins->Nice Quotes Options' menu in WordPress. Don't forget to Save Changes!


== Frequently Asked Questions ==


= I have set the category on the option page but no posts are ever quoted. =

Make sure at least one of those posts in that category has an excerpt defined.


= What is the ratio of quotes, links and excerpts? =

The ratio is split evenly between the types of quotes enabled to be displayed. To determine the
probability of a quote type (links, excerpts, and custom quotes)  being displayed count the number
of types enabled. The probability is one in however many types are being displayed.

For example, if you have links, excerpts and quotes all enabled then the chances of getting an
excerpt is 1 in 3, the chance of getting a quote is 1 in 3 and the chance of getting a quote is 1
in 3.


= Can the plugin be used to list only a random excerpt from a category? =

Yes it can, just don't set any custom quotes or check the option to include Hello Dolly lyrics.


= Can the plugin be used to list only a random link from a link-category (like Blogroll for example) =

Yes it can, just don't set any custom quotes or check the option to include Hello Dolly lyrics.


= Can HTML be used in custom quotes? =

Yes, it can. Using a break tag (`<br />`) is recommended for multi-line quotes.


= Can smilies or shortcodes be used in custom quotes? =

Yes they can. Smilies are only included if they are enabled under Settings->Writing.


= How can the quotes be styled? =

Quotes have a class of 'niceQuote' set on them. To style them add to your stylesheet:

	`.niceQuote {`  
		`// css properties here`  
	`}`


= How can the quotes be used on a post or page? =

Just use `[nicequote]` as a shortcode and a randomly chosen quote will be displayed on the page.
The quote is randomly chosen each time the post or page is loaded.


= Are the quotes random? =

Yes they are. Each time the quote is loaded (whether on the admin page, a sidebar widget or via
shortcode) the quote will be random with the ratios listed above.


= Why is there an option to include Hello Dolly lyrics? =

The inspiration for this plugin comes from the Hello Dolly plugin (hello.php) bundled with
Wordpress. I wanted to have the option to have user-defined custom quotes *and* to have those
quotes appear on the Wordpress front-end. I also wanted to optionally highlight a featured
post or be able to show an affiliated link.


== Screenshots ==

1. This is the options screen showing the settings available with Nice Quotes Rotator.
2. This is the Nice Quotes settings added to the Widgets menu.


== Changelog ==

= 0.1 =  
* Initial public release.

= 0.2 =  
* fixed the shortcode to match the documentation (now `[nicequote]` works. 

= 0.3 =  
* Added two attributes to the shortcode. `tagoverride` which overrides whichever option is set in the options page for which HTML tag to use. This is useful for changing the tag when something should be inline or block. `additionalclasses` is used for adding additional CSS classes to the nicequote. See [This page](http://codex.wordpress.org/CSS) for a listing of  built-in WordPress classes, for reference.

= 0.4 =  
* Fixed an error caused in the last update.

= 0.5 =  
* Fixed an error caused in the last update of a missing argument to one of the functions.

== Upgrade Notice ==

= 0.1 =  
* Initial public release.

= 0.2 =  
* fixed the shortcode to match the documentation (now `[nicequote]` works. 

= 0.3 =  
* Added two attributes (`tagoverride` and`additionalclasses`) to the shortcode.

= 0.4 =  
* Fixed an error caused in the last update.

= 0.5 =  
* Fixed an error caused in the last update of a missing argument to one of the functions.

= 0.8 =  
* Fixed an error in admin-page.php cause by using single-quotes instead of double quotes.

= 0.9 =  
* Fixed an error in admin-page.php cause by un-initialized variables. Also increased the size of the textarea for entering quotes to 90% width and 12em height.


== Support ==

Technical support for this plugin will be provided via the WordPress plugin forum.  Additional support may be
available at [plugin's homepage](http://www.codeandreload.com/wp-plugins/nicequotes/ "Nice Quotes at Code
and Reload").
