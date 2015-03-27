=== Kimili Flash Embed ===
Contributors: Kimili, kitchin
Tags: flash, flex, swf, swfobject, javascript
Requires at least: 2.8
Tested up to: 4.0.1
Stable tag: 2.5.1
Donate Link: http://cl.ly/YgIv
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a WordPress interface for SWFObject 2, the best way to embed Flash content on any site.

== Description ==

Kimili Flash Embed is a plugin for Wordpress that allows you to easily place Flash movies on your site. Built upon [SWFObject](http://code.google.com/p/swfobject/) javascript code, it is standards compliant, search engine friendly, highly flexible and full featured, as well as easy to use.

Kimili Flash Embed utilizes SWFObject 2.2, is fully compatible with Wordpress 2.6 and later and plays well with most other plugins.

For non-english users, Kimili Flash Embed has been localized to the following languages:

* Belorussian
* Bulgarian
* Dutch
* German
* Hindi
* Irish Gaelic
* Latvian
* Romanian
* Russian
* Serbo-Croatian
* Spanish
* Ukranian

== Installation ==

Installing the plugin is as easy as unzipping and uploading the entire kimili-flash-embed folder into your /wp-content/plugins directory and activating the plugin. You can deactivate and delete any old versions of KFE you may have.

== Screenshots ==

1. The Kimili Flash Embed Tag Generator, as rendered by by Wordpress 2.7.
2. The Kimili Flash Embed Preferences page as of v.2.1

== Basic Usage ==

Once the plugin is installed and activated, you can add Flash content to your pages using a tag like this in your articles:

> `[kml_flashembed movie="filename.swf" height="150" width="300" /]`

When you use the Rich Text Editor in either Visual or HTML modes, you should see a button on the right end of the toolbar with a Flash player logo in the visual mode or a button that reads "Kimili Flash Embed" in HTML mode. Click it, and you will be presented with the Kimili Flash Embed Tag Generator which presents you with all possible embedding options. Set the options according to your needs and click the "Generate" button to drop a KFE tag in your editor.

The only required attributes in a KFE tag are movie, height, and width. See the the following sections all available attributes and advanced usage.

== Available Attributes ==

All of the available attributes for the KFE tag should be lowercase and double quoted. They are:

There only one attribute required in a KFE tag: *movie*. All of the available attributes for the KFE tag should be lowercase and double quoted. They are:

**MOVIE** (required)
The path and file name of the Flash movie you want to display.

**ALLOWFULLSCREEN**
(`true`|`false`) Enables full-screen mode. The default value is false if this attribute is omitted. You must have version 9,0,28,0 or greater of Flash Player installed to use full-screen mode.

**ALLOWFULLSCREENINTERACTIVE**
(`true`|`false`) Enables full-screen interactive mode, in which content running in Flash Player can fill the entire screen *and accept text input*. The default value is false if this attribute is omitted. You must have version 11,3,0 or greater of Flash Player installed to use full-screen interactive mode. See [Adobe's developer guide](http://help.adobe.com/en_US/as3/dev/WS58a13becbbb904c7-28cf6d32136e60de784-8000.html) for more info.

**ALLOWNETWORKING**
(`all`|`internal`|`none`) Controls a SWF file's access to network functionality. The default value is 'all' if this attribute is omitted.

**ALLOWSCRIPTACCESS**
(`always`|`never`|`sameDomain`) Controls the ability to perform outbound scripting from within a Flash SWF. The default value is 'always' if this attribute is omitted.

**ALTTEXT** (_very_ deprecated)
The text you want to display if the required Flash player is not found. I strongly recommend that you "nest alternative content in your KFE tags":#altContent in favor of using this attribute.

**BASE**
( . or base directory or URL) - Specifies the base directory or URL used to resolve all relative path statements in the Flash Player movie. This attribute is helpful when your Flash Player movies are kept in a different directory from your other files.

**BGCOLOR**
(`#RRGGBB`, hexadecimal RGB value) - Specifies the background color of the Flash movie.

**DEVICEFONT**
Specifies whether static text objects that the Device Font option has not been selected for will be drawn using device fonts anyway, if the necessary fonts are available from the operating system.

**FID**
Use this attribute to give your movie a unique id on the page for scripting purposes. If omitted, a random ID is assigned to your movie.

**FVARS**
Pass variables (name/value pairs) into your movie with this attribute. You can pass in as few or as many variables as you want, separating name/value pairs with a semicolon. Syntax is as follows:

* `fvars=" name = value ; name = value "`

In addition to hard coded values, you can also pass in arbitrary Javascript or PHP code, like such:

* _Javascript_ - `href = ${document.location.href;}`
* _PHP_ - `date = ?{date('F j, Y');}`

These can be strung together in any order inside the fvars attribute:

* `fvars=" href = ${document.location.href;} ; date = ?{date('F j, Y');} ; name = Johnny Bravo "`

**FVERSION**
You can specify what version of the Flash player is required to play your movie. If you omit this attribute, the value set in the plugin options will be used.

**HEIGHT**
The height of the Flash movie. You can specify in pixels using just a number or percentage. If you omit this attribute, the value set in the plugin options will be used.

**LOOP**
(`true`|`false`) - Specifies whether the movie repeats indefinitely or stops when it reaches the last frame. The default value is true if this attribute is omitted.

**MENU**
 (`true`) displays the full menu, allowing the user a variety of options to enhance or control playback.
 (`false`) displays a menu that contains only the Settings option and the About Flash option.

**PLAY**
(`true`|`false`) - Specifies whether the movie begins playing immediately on loading in the browser. The default is true.

**PUBLISHMETHOD**
 (`static`) - Embed Flash content and alternative content using standards compliant markup and use unobtrusive JavaScript to resolve the issues that markup alone cannot solve.
 (`dynamic`) - Create alternative content using standards compliant markup and embed Flash content with unobtrusive JavaScript.

If you omit this attribute, the value set in the plugin options will be used.

**QUALITY**
(`low`|`high`|`autolow`|`autohigh`|`best`) - Specifies the playback quality of the Flash movie.

**SCALE**
(`showall`|`noborder`|`exactfit`) - Dictates how the movie fills in the specified target area.

**SEAMLESSTABBING**
(`true`|`false`) Specifies whether users are allowed to use the Tab key to move keyboard focus out of a Flash movie and into the surrounding HTML (or the browser, if there is nothing focusable in the HTML following the Flash movie). The default value is true if this attribute is omitted.

**SWLIVECONNECT**
(`true`|`false`) Specifies whether the browser should start Java when loading the Flash Player for the first time. The default value is false if this attribute is omitted. If you use JavaScript and Flash on the same page, Java must be running for the FSCommand to work.

**TARGET**
When setting `publishmethod` to `dynamic`, this is the ID of an element on your page that you want your Flash movie to display within. If you don't set this attribute, a random target ID will be generated. _Will be ignored if `publishmethod` is `static`._

**TARGETCLASS**
This is the class name of the element on your page that you want your Flash movie to display within - helpful for CSS Styling. If you omit this attribute, the value set in the plugin options will be used.

**USEEXPRESSINSTALL**
(`true`|`false`) Use this if you want to invoke the Flash Player "Express Install":#expressinstall functionality. This gives users the option to easily update their Flash Player if it doesn't meet the required version without leaving your site.

**WIDTH**
The width of the Flash movie. You can specify in pixels using just a number or percentage. If you omit this attribute, the value set in the plugin options will be used.

**WMODE**
(window, opaque, transparent) - Sets the Window Mode property of the Flash movie for transparency, layering, and positioning in the browser.

You can find out more about Flash player attributes at [Adobe's Knowledge Base](http://www.adobe.com/go/tn_12701)

== Using Flash Player Express Install ==

If you want to give visitors to your site the option to upgrade their Flash Player to the latest version as quickly and seamlessly as possible, you can use the Flash Player’s Express Install functionality.

= General Notes =

Your SWF files need to be a minimum of 214px wide by 137px high so the entire upgrade dialog can be seen by the user if the Express Install is triggered. Furthermore, if your Express-Install-enabled SWF is not at least that size, the Express Install function will automatically fail.

It may also be a good idea to only place one SWF with Express Install functionality on each page. This way users won’t be greeted with multiple upgrade dialog boxes and be forced to choose one.  Onto the specifics:

= Specifics =

Define the minimum flash player version required by your .SWF using the fversion attribute:

> `fversion="9.0.115"`

Add the useexpressinstall attribute to your `[kml_flashembed /]` tag, like this:

> `useexpressinstall="true"`

In the end, your KFE tag should look something like this:

> `[kml_flashembed movie="filename.swf" height="300" width="300" fversion="9" useexpressinstall="true"  /]`

That is all you need in order to invoke the Express Install functionality.  In the case of the above KFE tag, if a user arrives at your site with either a Flash Player 6, 7, or 8 installed, they will be alerted that they need a more recent version of the Flash Player and be given the option to upgrade it without leaving your site.

== Defining Alternate Content for a Flash Movie ==

As of KFE 2.0, it is now _much_ easier to specify alternative content which gets displayed when your Flash doesn't get rendered. This could happen if a user doesn't have a recent enough Flash player installed or lacks the Flash player altogether, such as on an iPhone. Another reason to specify alternative content is for search engine optimization, or SEO. Most search engines aren't very good at indexing content in Flash movies, if they can do it at all (Google can, but only with content that has been hard coded into a SWF--dynamic content in a SWF doesn't get indexed). In these cases it's best to specify some alternative content for your SWF.

To define alternative content for a SWF, you can now nest arbitrary HTML inside a KFE tag and it will be treated as alternate content for that SWF. The Tag Generator does this for you automatically. Properly nested alternative content looks like this:

	[kml_flashembed movie="/my/great/movie.swf" width="400" height="300"]

		<!-- Begin Alternate Content -->

		<p>
			<a href="http://adobe.com/go/getflashplayer">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
			</a>
		</p>

		<!-- End Alternate Content -->

	[/kml_flashembed]

== Configuration Options ==

KFE 2.1 features configuration options which allow you to customize how the plugin behaves as well as set all defaults for the Tag Generator and KFE tags that omit some parameters. In Wordpress, you can find the options by navigating to _Settings &rarr; Kimili Flash Embed_. Unless otherwise noted, the default tag generator values will be blank or unselected. You'll find the following options available to you:

= SWFObject Configuration Defaults =

**Publish Method**
Specifies the default [publishing method](http://code.google.com/p/swfobject/wiki/documentation#Should_I_use_the_static_or_dynamic_publishing_method?) for your SWF. If you omit this attribute from a KFE tag, whatever value you have set here will be applied to the tag. Default is _static_

**Flash Version**
Specifies the default Flash player version (Major.Minor.Release format) required to display your SWFs. If you omit this attribute from a KFE tag, whatever value you have set here will be applied to the tag. Default is _8.0.0_

**Adobe Express Install**
Specifies whether or not you want to use Express Install functionality in your SWFs for users who don't have the minimum version of the Flash Player you've defined installed. Default is _yes_.

= SWF Definition Defaults =

**SWF Filename**
This is the default SWF filename which is populated in the **Flash (.swf)** field in the Tag Generator. This is especially useful if you use a common player to play FLVs, for instance. You can specify a URL with an absolute file path (i.e. @/flies/flash/player.swf@). Default is *untitled.swf*.

**Dimensions (width&times;height)**
Specifies the default width and height for your SWFs. If you omit either of these attributes from a KFE tag, whatever value you have set here will be applied to the tag. Default is _400&times;300_

= Attributes =

**Flash Content ID**
This is the CSS class name applied to your rendered Flash movies. This uniquely identifies the Flash movie so that it can be referenced using a scripting language or by CSS.

**class**
This is the CSS class name applied to your rendered Flash movies. If you omit this attribute from a KFE tag, whatever value you have set here will be applied to the tag. Default is _flashmovie_.

**align**
HTML alignment of the object element. If this attribute is omitted, it by default centers the movie and crops edges if the browser window is smaller than the movie. NOTE: Using this attribute is not valid in XHTML 1.0 Strict.

= Parameters =

**play**
Specifies whether the movie begins playing immediately on loading in the browser. The default value is true if this attribute is omitted.

**loop**
Specifies whether the movie repeats indefinitely or stops when it reaches the last frame. The default value is true if this attribute is omitted.

**menu**
Shows a shortcut menu when users right-click (Windows) or control-click (Macintosh) the SWF file. To show only About Flash in the shortcut menu, deselect this option. By default, this option is set to true.

**quality**
Specifies the trade-off between processing time and appearance. The default value is 'high' if this attribute is omitted.

**scale**
Specifies scaling, aspect ratio, borders, distortion and cropping for if you have changed the document's original width and height.

**salign**
Specifies where the content is placed within the application window and how it is cropped.

**wmode**
Sets the Window Mode property of the Flash movie for transparency, layering, and positioning in the browser. The default value is 'window' if this attribute is omitted.

**bgcolor**
Hexadecimal RGB value in the format #RRGGBB, which specifies the background color of the movie, which will override the background color setting specified in the Flash file.

**devicefont**
Specifies whether static text objects that the Device Font option has not been selected for will be drawn using device fonts anyway, if the necessary fonts are available from the operating system.

**seamlesstabbing**
Specifies whether users are allowed to use the Tab key to move keyboard focus out of a Flash movie and into the surrounding HTML (or the browser, if there is nothing focusable in the HTML following the Flash movie). The default value is true if this attribute is omitted.

**allowfullscreen**
Enables full-screen mode. The default value is false if this attribute is omitted. You must have version 9.0.28.0 or greater of Flash Player installed to use full-screen mode.

**allowfullscreeninteractive**
Enables full-screen interactive mode, in which content running in Flash Player can fill the entire screen *and accept text input*. The default value is false if this attribute is omitted. You must have version 11.3.0 or greater of Flash Player installed to use full-screen interactive mode. See [Adobe's developer guide](http://help.adobe.com/en_US/as3/dev/WS58a13becbbb904c7-28cf6d32136e60de784-8000.html) for more info.

**allowscriptaccess**
Controls the ability to perform outbound scripting from within a Flash SWF. If omitted, the default value is "sameDomain" in most situations, except if the user's Flash Player version is lower than 9.0.115.0 and the Flash movie is published for FP7 or earlier. In that case, the default will be "always".

**allownetworking**
Controls a SWF file's access to network functionality. The default value is 'all' if this attribute is omitted.

**base**
Specifies the base directory or URL used to resolve all relative path statements in the Flash Player movie. This attribute is helpful when your Flash Player movies are kept in a different directory from your other files.

**fvars**
Allows you to pass variables to a Flash movie. You need to separate individual name/variable pairs with a semicolon (i.e. name=John Doe ; count=3).

= Alternative Content Default =

**Alternate Content**
Specifies the default "alternative content":#altContent to display when your SWF isn't rendered. Default is a "Get Flash Player" badge linked to Adobe's Flash Player download page, rendered as follows:

	<p>
		<a href="http://adobe.com/go/getflashplayer">
			<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
		</a>
	</p>

= Javascript Options =

**Create a reference to SWFObject.js?**
Decide whether or not you want to create a reference to SWFObject 2.1 in the HTML of your page templates. It is useful to turn this off if you already have SWFObject being referenced elsewhere in your code. Note that SWFObject 2.x is NOT compatible with SWFObject 1.x! *KFE 2 requires SWFObject 2.x*. Default is _true_

**Where do you want to reference SWFObject.js from?**
If you choose to create a reference to SWFObject 2.1, you have 2 options in terms of where you reference it from. **Internal** creates a link to the copy of SWFObject bundled with the plugin. **Google Ajax Library** creates a link to the copy of SWFObject hosted in the [Google's Hosted Ajax Library](http://code.google.com/p/swfobject/wiki/hosted_library). The advantage of this is that the Javascript gets served with correct cache headers and it saves you a bit of bandwidth on your server. Default is _Google Ajax Library_

**Do you want to use SWFObject's autohide functionality?**
By default, SWFObject temporarily hides your SWF or alternative content until the library has decided which content to display. This option allows you to disable that behavior.

== Backwards Compatibility Gotchas ==

KFE 2.0 is _mostly_ backwards compatible with KFE 1.x, so if you've been using the 1.x version and just creating basic KFE tags, you should be able to upgrade with no issues whatsoever. There are, however, some attributes which were available in 1.x which are no longer available in 2.0. This is due primarily to changes in SWFObject itself when it went to 2.0, unless otherwise noted. The 1.x attributes which are no longer supported are:

* `detectkey`
* `noscript` - This is now handled by defining alternate content properly.
* `redirecturl`
* `xiredirecturl`

One other minor backwards compatibility issue for you has to do with the format of KFE tags. In very early versions of this plugin, you defined KFE tags using angle brackets - `<kml_flashembed ... />`. When problems arose with using angle bracket tags in Wordpress' Rich Text Editor, I introduced the familiar square bracket variety - `[kml_flashembed ... /]`. Up to and including KFE 1.4.3, both versions of the tag formatting were supported. However, in order to simplify things in the KFE 2.0 code, the old angle bracket tags are no longer supported. If you have any posts which use the old formatting, you'll have to go back and update them to square brackets in order to continue rendering those Flash movies correctly.

== Frequently Asked Questions ==

### I put a Flash Movie in my header. It works on the home page, but not on any other pages. Why?

When you embed a SWF on an HTML page, you have to make sure that you use an **absolute** path to reference your SWF, not a relative one. The reason for this is that the browser looks for the SWF _relative to a page&#8217;s URL_. Therefore, by using an absolute path, you&#8217;ll ensure that the browser always looks for the SWF in the same place, regardless of what the page&#8217;s URL may be. The difference looks like this:

#### Relative Path _incorrect_

    [kml_flashembed movie="myMovie.swf" height="100" width="800" /]

#### Absolute Path _correct_

    [kml_flashembed movie="/path/to/myMovie.swf" height="100" width="800" /]

As you can see, the main difference is that your path begin with a `/`, and then the path to your SWF. This tells the browser to start at the root of your site and find your SWF from there. Note that the absolute path need not include your site&#8217;s URL&#8212;it&#8217;s probably best if it _doesn&#8217;t_ include it, as it&#8217;s more portable if your URL were to change.

### I&#8217;m using SlideShowPro (_or a similar slideshow tool_). It works fine if I open the SWF directly in a browser, but on my site, it doesn&#8217;t display any content. What gives?

SlideShowPro reads an XML file which tells it where to find the images to display. If it doesn&#8217;t find that XML, it won&#8217;t display anything. Typically, the XML file is in the same directory as the slideshow SWF, and the slideshow SWF will look for that XML using a relative path. This is fine if you access the SWF directly in the browser, but as I explain in the previous question, once you embed that SWF in an HTML page, the SWF resolves paths relative to that HTML page, _not relative to itself_.

The way to override this is to use the `base` parameter. Since the slideshow SWF and its XML file are typically in the same directory, set the base value to the absolute path to that directory. It should look something like this:

    [kml_flashembed movie="/path/to/my/slideshow.swf" base="/path/to/my/" /]

Of course, if your XML lives in a different directory, they you should change the value of the `base` parameter to match.

### My Flash movie references external XML/image/audio/video/etc. files to populate its content and it’s not working. What’s going on?

If you&#8217;re using the `fvars` attribute to pass your Flash movie a path to an external file, make sure the path you&#8217;re feeding it is **absolute, not relative**. As in the first question above, when a SWF is embedded in an HTML page, the browser references other files that the SWF may ask for _relative to the HTML page, not the SWF_. Using absolute paths is the best way to make sure the browser always knows where to find those files.

In situations like the SlideShowPro question above, It may be the case that a relative path to an XML file is embedded in the SWF itself. If you can&#8217;t override the path in the SWF, you can use KFE&#8217;s `base` attribute to define a absolute base URL that the relative path will use as its point of reference to find those files.

### I made sure to use an absolute path to reference my SWF (and it&#8217;s assets), but it&#8217;s still not working. Help!

In cases like this, the simplest answer is usually the best. Take that absolute URL, put it directly in a browser&#8217;s address bar and try to load the file in the browser. Do you see it? If not, make sure to correct the URL to point to the right place and then update your KFE tag with the correct URL. If you do see the file, but is still doesn&#8217;t work in your KFE tag, then feel free to [contact me](http://kimili.com/contact).

### Can I use KFE on my Wordpress.com blog?

Unfortunately, no. Because it&#8217;s a hosted service, wordpress.com doesn&#8217;t allow you the same freedom to install plugins and otherwise customize your site the way that you can with your own Wordpress installation on your own server.

### I see KFE tags instead of my Flash movies on my Wordpress site. How can I fix this?

This is _usually_ due to some missing function calls when using a non-default theme. If you&#8217;re experiencing this problem and have your site running with a custom theme, the best thing to do is to go into the theme editor and check the header and footer templates. They should have function calls as follows:

#### Header _typically header.php_

    <?php wp_head() ?>
    </head>

#### Footer _typically footer.php_

    <?php wp_footer() ?>
    </body>

If either the `wp_head()` or the `wp_footer()` php functions are missing, **KFE will not work**, so you&#8217;ll need to add them in. They should be placed, respectively, just before the `</head>` and `</body>` elements, as illustrated above.

### I have HTML drop-down menus (or some other positioned HTML elements) which get hidden behind my Flash movie. How can I fix this?

Fortunately, there&#8217;s a very simple remedy for this. Just set the `wmode` attribute to `transparent` in your KFE tag and you should be good to go.

### I set the `play` attribute to `false` in my KFE, but the video I&#8217;m embedding still plays. What gives?

The `play` parameter is misleading when it comes to embedding video. What it does is tell a simple flash movie with a timeline to play or stop, but that&#8217;s not the case with video. At its simplest, Flash video requires you have a player SWF &#8211; which has the playback controls and the stage for showing the video &#8211; and a video file &#8211; most likely an FLV &#8211; which gets loaded in the player SWF. The KFE `play` parameter has no control over the playback of video, but the player SWF does. Most video player SWFs have some way to play or stop the loaded video defined which is specific to that player. It could be a parameter that you pass to the video player when you load it. It could be a Javascript function that you call. It could be a combination of these things, too. You&#8217;d need to reference the documentation of the player that you&#8217;re using in order to find out what works for you in your specific situation.

### How do I center or add some space around Flash movies on my page?

This is easy to do using a bit of CSS. By default, KFE renders Flash movies either within a `<div>` or an `<object>` element with has a class name of &#8220;flashmovie&#8221; (or whatever you set in your [configuration options](#configuration)). Utilizing that, you can add a CSS definition like this:

    div.flashmovie {
        margin: 1em auto;
    }

That will add a 1 em margin on the top and bottom as well as center of all the Flash movies on your site that you&#8217;ve inserted using KFE. Also, remember that if you can apply a different class name to a certain Flash movies using the `targetclass` attribute. This is useful if you want to, for example, use a Flash movie in the header on your site and don&#8217;t want the default margins you&#8217;ve specified in your CSS to be applied to it.

### How do I make my Flash movie clickable?

If you want somebody to be able to click on your Flash movie and have it work as a link, then you actually have to build that link, or clickable area into your SWF. KFE cannot &#8220;wrap&#8221; your SWF with a link.

### How do I open a new window when someone clicks on my Flash movie?

First, re-read the previous question.

Now, if you still want to open a new window from your Flash movie, be aware that it&#8217;s a _bad idea_ because it probably won&#8217;t work. You&#8217;d have to embed a `window.open()` javascript call in your movie, but the problem is that when you do that and someone clicks on it, any decent browser with a popup blocker (most, these days) will not allow it. Fact is, because the Flash player is a _plugin_, browsers don&#8217;t know whether a javascript call which originates from within a Flash movie was triggered by user interaction or programatically. Since the latter can easily be used with malicious intent (if you&#8217;ve ever see a Windows machine infected with spyware, you know what I&#8217;m talking about), browsers simply don&#8217;t allow it. Don&#8217;t do it.

### Does this thing work with FLV files?

Sure it does, but you can&#8217;t just reference a FLV file directly with KFE. You have to insert a video player SWF onto your page and load an FLV into _that_. If you don&#8217;t have an video player SWF, there are a number available online such as the [JW FLV Media Player](http://www.longtailvideo.com/players/jw-flv-player/).

The general approach you&#8217;d take with KFE is to embed your video player as the SWF and use the `fvars` attribute to specify either the url to the FLV file the URL to a playlist that references the FLV file(s). The specifics of how the `fvars` would be defined depends on the particular requirements of your FLV player.

### I&#8217;d like to use KFE to put a Flash header in my Wordpress site. How do I do it?

You can put a `kml_flashembed` tag anywhere on your site, but it requires some familiarity with editing PHP and HTML files. With the Tag Generator, the plugin is set up to insert tags in posts very easily, but you can manually insert a tag in any of your theme files as well. Simply navigate to _Appearance &rarr; Editor_, select one of your current Theme&#8217;s PHP files, and insert a KFE tag among the HTML and PHP where you want your SWF to appear.

### Help! I installed KFE on my Wordpress site and everything blew up! What do I do?

The first step is to check for incompatibilities with another plugin. Leaving KFE active, disable other plugins you have active one at a time, each time checking to see if your site is still blowing up. The moment you see that it doesn&#8217;t, the last plugin you disabled is the culprit &#8211; [let me know about it](http://kimili.com/contact/).

Of course, this assumes that you are using a stock installation of Wordpress, which is the only type of installation I&#8217;ve tested this plugin on. If you&#8217;re using a non-standard theme or you&#8217;ve modified or hacked the core PHP files in any way, I cannot guarantee any functionality, nor offer you support on how to fix things when they go awry. Sorry.

### I&#8217;m still having trouble getting KFE to work in my Wordpress site. Can you show me what to do?

Although it&#8217;s using an old version of the plugin, [Brooks Andrus](http://www.brooksandrus.com/blog/) has put together [a helpful screencast](http://www.brooksandrus.com/blog_assets/fitc/word_press/index.html) that walks through process of installing an using KFE.

== Upgrade Notice ==

Version 2.4.1 and earlier of this plugin are broken as of WordPress 4.0.1. This release, version 2.5.1	 will get you back in business, so upgrade today! See the changelog for more information.

== Changelog ==

= Version 2.5.1 =

* Whoops! 2.5 shipped with some undefined variable bugs! This release fixes those.

= Version 2.5 =

* I've finally updated shortcode parsing to use the official Wordpress Shortcode API rather than the home-spun approach I cobbled together nearly 9 years ago when I first wrote this plugin. Frankly, I was impressed it worked for as long as it did, but now I was able to strip out that old fragile (and, as of WP 4.0.1, broken) code as a result. Kimili Flash Embed now is a better WordPress citizen, and should work with other plugins that it might not have worked alongside in the past. Now that it uses only official WP APIs, it should also be more future-proof, so you can continue to use it confidently as WordPress continues to evolve in the future.
* Tested up to Wordpress 4.0.1

= Version 2.4.1 =

* Added Bulgarian localization (Thanks to [Ajoft Software](http://www.ajoft.com)).
* Added Ukranian localization (Thanks to [Michael Yunat](http://www.iphostmonitor.com)).
* Tested up to Wordpress 3.9.1

= Version 2.4 =

* Added an option to utilize the allowFullScreenInteractive mode introduced in Flash Player 11.3
* Tested up to Wordpress 3.8.1

= Version 2.3.2 =

* Tested up to Wordpress 3.7
* Added Serbo-Croatian localization (Thanks to Borisa Djuraskovic).

= Version 2.3.1 =

* Changed the way the Generator code detects the Wordpress directory. This will allow KFE to be references via symbolic links.
* Updated information about the "allowScriptAccess" defaults
* Fixed some typos and clarified some information about how the internal SWFObject references are set up. (Thanks Adam Samec for pointing out these last two tweaks)
* Removed inline attribution in public HTML

= Version 2.3 =

* Security patch to utilize updated version of SWFObject (identified by [kitchin](http://wordpress.org/support/profile/kitchin)). Now, when choosing to use the internal version of SWFObject (which is the recommended approach as of this update), KFE will reference the copy of SWFObject included with Wordpress if you're using WP 3.3.2 or newer, otherwise, it'll reference the copy of SWFObject bundled with the plugin.
* Addressed issues with some warnings being thrown.

= Version 2.2.1 =

* Tested up to Wordpress 3.3.1
* Added Romanian localization (Thanks to [Web Geek Science](http://webhostinggeeks.com))

= Version 2.2 =

* Tested up to Wordpress 3.1.3
* Updated some deprecated functions
* Added Irish Gaelic localization (Thanks to [lets be famous](http://letsbefamous.com))

= Version 2.1.5 =

* Tested up to Wordpress 3.0
* Added German localization (Thanks to [BHV](http://www.bhvnederland.nl))

= Version 2.1.4 =

* Tested up to Wordpress 3.0 beta 2
* Fixed a conflict with the WP FollowMe plugin, where the flash content of that plugin was getting hidden.
* Added Dutch localization (Thanks to [Alanya Hotels](http://www.alanyahotels.com))
* Added Latvian localization (Thanks to [Antsar](http://antsar.info/))

= Version 2.1.3 =

* Corrected a conflict with the Contact Form 7 plugin which was causing a blank KFE Tag Generator window.

= Version 2.1.2 =

* Added Hindi localization (Thanks to [Outshine Solutions](http://outshinesolutions.com))

= Version 2.1.1 =

* Fixed a bug introduced in 2.1 when not using SWFObject 2.2's auto hide/show behavior.

= Version 2.1 =

* Now utilizes SWFObject 2.2
* Added ability to set defaults for every attribute in the KFE tag generator.
* Fixed an issue when using KFE on SSL pages.

= Version 2.0.3 =

* Added Russian & Belarusian localizations (Thanks to [Fat Cow](http://www.fatcow.com))

= Version 2.0.2 =

* Added Spanish localization (Thanks to Cropcreativos Hosting)
* Fixes an HTML validation issue when using the fvars attribute

= Version 2.0.1 =

* Complete rewrite utilizing SWFObject 2.1
* Fixes an incompatibility with the Rich Text Editor in Wordpress 2.7

= Version 1.4.3 =

* Fixed a bug with how fvars are output in RSS feeds.

= Version 1.4.2 =

* Fixed a problem with URL file-access on some server configurations.

= Version 1.4.1 =

* Fixed an incompatibility with other plugins that were using the buttonsnap.php library
* Updated Toolbar buttons to work with TinyMCE 3, used in Wordpress 3

= Version 1.4 =

* Added "allowFullScreen" attribute for full support of Flash Player 9
* Fixed a bug when specifying percentage heights and widths.

= Version 1.3.1 =

* Fixed movie ID (fid attribute) handling.

= Version 1.3 =

* Updated SWFObject Javascript to latest codebase (SWFObject 1.5)
* Simplified Express Install handling to reflect changes in SWFObject 1.5
* Cleaned up code, declaring undeclared variables.

= Version 1.2 =

* Improved compatibility with other plugins.
* Removed the need to turn off GZIP compression.
* Added Flash movies to RSS feeds.
* Added a "targetclass" attribute to define a class name for the element which the SWF will be rendered within.
* Fixed a problem with invalid HTML rendering.
* Fixed a problem when passing in URLs with query strings in the FVARS attribute.
* Added Rich Text Editor Toolbar button to quickly insert KFE tags in a post.
* Updated SWFObject Javascript to latest codebase (SWFObject 1.4.4)

= Version 1.1 =

* Much improved compatibility with other WordPress plugins and themes. (yay!)
* Simplified embedding multiple instances of the same SWF.
* Removed FlashObject code from RSS feeds, allowing for feed validation.
* Updated JS to latest codebase. (FlashObject 1.3d)

= Version 1.0 =

* Updated JS to latest codebase. (FlashObject 1.3, released 1/17/06)
* Modified JS to support old browsers.
* Added ability to pass arbitrary Javascript and PHP values to SWF.
* Includes Express Install functionality.

= Version 0.3.1 =

* Fixed a bug that prevented the Javascript from displaying properly on some servers

= Version 0.3 =

* Fixed a bug that prevented the Flash movie from displaying properly on archive pages.
* Updated Flash Object Javascript to include NS4 compatibility.

= Version 0.2 =

* Eliminated the need to install and link to a separate JavaScript file
* Initialized some previously uninitialized variables, cleaning things up a bit
* Fixed a bug that prevented fvars from being passed to the flash
* Dealt with a strange WP behaivior that was keeping the code from validating (See URL above for more info)
