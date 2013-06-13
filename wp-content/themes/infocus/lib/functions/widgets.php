<?php
/**
 * ************************************* Flickr Widget
 */
function webtreats_flickr_widget($args) {
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];
	
	echo $args['before_widget'];
?>

<div id="flickr" class="block">
	<h3 class="widgettitle">Photos on <span>flick<span>r</span></span></h3>
	<div class="wrap">
		<div class="fix"></div>
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
		<div class="fix"></div>
	</div>
</div>

<?php
	echo $args['after_widget'];
}

function webtreats_flickr_widget_admin() {
	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}
wp_register_sidebar_widget( 'flickr-widget', $themename.' - Flickr', 'webtreats_flickr_widget', array('description' => 'Pulls in images from your Flickr account.'));
register_widget_control('flickr-widget', 'webtreats_flickr_widget_admin', 400, 200);


/**
 * *************************************  Twitter Widget
 */
function webtreats_twitter_widget($args) {
	global $shortname;
	$get_options = get_option($shortname.'_general_settings');
	
	$tweet_limit = get_option("widget_twitterwidget");
	$limit = ($tweet_limit) ? $tweet_limit : '5';
	$usernames = $get_options['twitter_id']; $type = 'widget';
	
	echo $args['before_widget'];
	echo $args['before_title'] .'Recent Tweets'. $args['after_title'];
	echo '<div class="twitter_bird"></div>';
	
	echo '<ul>';
	parse_cache_feed($usernames, $limit, $type);
	echo '</ul>';
	
 	echo $args['after_widget'];
}

function webtreats_twitter_widget_admin() {
	global $shortname;
	$get_options = get_option($shortname.'_general_settings');
	$usernames = $get_options['twitter_id'];
	
	if(!$usernames) {
		echo '<p>You must have your Twitter user name entered in the "General Settings" tab of your themes options for this widget to function properly.</p>';
		
	}else{

	$settings = get_option("widget_twitterwidget");

	// check if anything's been sent
	if (isset($_POST['update_twitter'])) {
		$settings = strip_tags(stripslashes($_POST['twitter_count']));
		update_option("widget_twitterwidget",$settings);
		
		//clear twitter feed cache on save
		$files = glob(WEBTREATS_FUNCTIONS ."/cache/*");
		foreach($files as $file){
			unlink($file);
		}
	}

  	echo '<p>
			<label for="twitter_count">Enter the number of tweets you\'d like to display (default is 5):
			<input id="twitter_count" name="twitter_count" type="text" class="widefat" style="width:60px" value="'.$settings.'" /></label></p>';
	echo '<input type="hidden" id="update_twitter" name="update_twitter" value="1" />';
	
	}	
}
wp_register_sidebar_widget( 'twitter-widget', $themename.' - Twitter', 'webtreats_twitter_widget', array('description' => 'Pulls in your most recent tweet from Twitter.'));
register_widget_control('twitter-widget', 'webtreats_twitter_widget_admin', 450, 200);


/**
 * *************************************  Popular Post Widget
 */
function webtreats_popular_widget($args) {
	global $wpdb;
	$pop_posts = get_option('webtreats_popular_posts');
	if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 3;
	$now = gmdate("Y-m-d H:i:s",time());
	$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
	$popularposts = "SELECT ID, post_title, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
	$posts = $wpdb->get_results($popularposts);
	$popular = '';
	
	echo $args['before_widget'];
	echo $args['before_title'] .'Popular Posts'. $args['after_title']; 

	if($posts){ ?>
		
<ul class="thumbnail_list">
	<?php foreach($posts as $post){ 
			$post_title = stripslashes($post->post_title);
			$post_date = $post->post_date;
			$post_date = mysql2date('F j, Y', $post_date, false);
			$permalink = get_permalink($post->ID);
			$meta_image = get_post_meta($post->ID, "post_image", true);
			if(!$meta_image){
				$meta_image = get_template_directory_uri() .'/images/empty_thumb.gif';
			}else{
				$meta_image = WEBTREATS_SCRIPTS_FOLDER .'/thumb.php?src=' .$meta_image. '&amp;w=60&amp;h=60&amp;zc=1&amp;q=100';
			}
			?>
	<li>
		<a class="alignleft" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
		<span class="small_frame"><img src="<?php echo $meta_image; ?>" width="60" height="60" alt="<?php echo $post_title; ?>"/></span></a>
		<a class="thumbnail_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br/>
		<a class="date" href="#"><?php echo $post_date; ?></a>
		<div class="clearboth" />
	</li>
		<?php } ?>
</ul>
	<?php }
	echo $args['after_widget'];
}
wp_register_sidebar_widget( 'popular-widget', $themename.' - Popular Post', 'webtreats_popular_widget', array('description' => 'Custom popular post widget with post preview image'));


/**
 * *************************************  Recent Post Widget
 */
function webtreats_recent_widget($args) {
	global $wpdb, $shortname;
	
	$get_options = get_option($shortname.'_general_settings');
	$blog_excludecats = $get_options['blog_excludecats'];
	$exclude_blog_cats = preg_replace("!(\d)+!","-${0}$0", $blog_excludecats);
	$posts = get_posts("cat=$exclude_blog_cats&numberposts=3&offset=0");
	
	echo $args['before_widget'];
	echo $args['before_title'] .'Recent Posts'. $args['after_title'];
	
	if($posts){ ?>
		
<ul class="thumbnail_list">
	<?php foreach($posts as $post){
			$post_title = stripslashes($post->post_title);
			$post_date = $post->post_date;
			$post_date = mysql2date('F j, Y', $post_date, false);
			$permalink = get_permalink($post->ID);
			$meta_image = get_post_meta($post->ID, "post_image", true);
			if(!$meta_image){
				$meta_image = get_template_directory_uri() .'/images/empty_thumb.gif';
			}else{
				$meta_image = WEBTREATS_SCRIPTS_FOLDER .'/thumb.php?src=' .$meta_image. '&amp;w=60&amp;h=60&amp;zc=1&amp;q=100';
			}
			?>			
	<li>
		<a class="alignleft" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
		<span class="small_frame"><img src="<?php echo $meta_image; ?>" width="60" height="60" alt="<?php echo $post_title; ?>"/></span></a>
		<a class="thumbnail_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a><br/>
		<a class="date" href="#"><?php echo $post_date; ?></a>
		<div class="clearboth" />
	</li>
		<?php } ?>
</ul>
	<?php }	
	echo $args['after_widget'];	
}
wp_register_sidebar_widget( 'custom-recent-widget', $themename.' - Recent Post', 'webtreats_recent_widget', array('description' => 'Custom recent post widget with post preview image'));


/**
 * *************************************  Contact Us Widget
 */
function webtreats_contact_widget($args) {
	$settings = get_option('widget_contactwidget');

    echo $args['before_widget'];
	
	if ($settings['title'] == ''){
	$settings['title'] = 'Contact Info';
	}

    echo $args['before_title'] .'<span class="contact_widget_title">'. $settings['title'] .'</span>'. $args['after_title'];

	if ($settings['name'] != ''){
	echo '<span class="contact_widget_name">'. $settings['name'] .'</span><br />';
	}
	
	if ($settings['address'] != ''){
	echo '<span class="contact_widget_address">'. $settings['address'] .'</span><br />';
	}
		
	if ($settings['city'] != ''){
	echo '<span class="contact_widget_city">'. $settings['city'] .',&nbsp;'. $settings['state'] .'</span>&nbsp;';
	}
		
	if ($settings['zip'] != ''){
	echo '<span class="contact_widget_zip">'. $settings['zip'] .'</span><br />';
	}

	if ($settings['phone'] != ''){
	echo '<span class="contact_widget_phone">'. $settings['phone'] .'</span><br />';
	}
	
	if ($settings['email'] != ''){
	echo '<span class="contact_widget_email"><a href="mailto:'. $settings['email'] .'">' .$settings['email']. '</a></span><br />';
	}
	
    echo $args['after_widget'];
	
}

function webtreats_contact_widget_admin() {
	$settings = get_option('widget_contactwidget');
	
	if (isset($_POST['contact_widget_name'])){
		$settings['title'] = strip_tags(stripslashes($_POST['contact_widget_title']));
	    $settings['name'] = strip_tags(stripslashes($_POST['contact_widget_name']));
	    $settings['address'] = strip_tags(stripslashes($_POST['contact_widget_address']));
	    $settings['city'] = strip_tags(stripslashes($_POST['contact_widget_city']));
	    $settings['state'] = strip_tags(stripslashes($_POST['contact_widget_state']));
	    $settings['zip'] = strip_tags(stripslashes($_POST['contact_widget_zip']));
	    $settings['phone'] = strip_tags(stripslashes($_POST['contact_widget_phone']));
	    $settings['email'] = strip_tags(stripslashes($_POST['contact_widget_email']));
	
	    update_option('widget_contactwidget', $settings);
	  }
	
	echo '<p>
		    <label for="contact_widget_title">Title:<br />
			<input size="30" id="contact_widget_title" name="contact_widget_title" type="text" value="'.$settings['title'].'" /></label></p>';
			
	echo '<p>
			<label for="contact_widget_name">Name:<br />
			<input size="30" id="contact_widget_name" name="contact_widget_name" type="text" value="'.$settings['name'].'" /></label></p>';

	echo '<p>
			<label for="contact_widget_address">Address:<br />
			<input size="30" id="contact_widget_address" name="contact_widget_address" type="text" value="'.$settings['address'].'" /></label></p>';

	echo '<p>
			<label for="contact_widget_city">City:<br />
			<input size="30" id="contact_widget_city" name="contact_widget_city" type="text" value="'.$settings['city'].'" /></label></p>';

	echo '<p>
			<label for="contact_widget_state">State:<br />
			<input size="30" id="contact_widget_state" name="contact_widget_state" type="text" value="'.$settings['state'].'" /></label></p>';

	echo '<p>
	        <label for="contact_widget_zip">Zip:<br />
			<input size="30" id="contact_widget_zip" name="contact_widget_zip" type="text" value="'.$settings['zip'].'" /></label></p>';

	echo '<p>
		    <label for="contact_widget_phone">Phone:<br />
			<input size="30" id="contact_widget_phone" name="contact_widget_phone" type="text" value="'.$settings['phone'].'" /></label></p>';
			
	echo '<p>
		    <label for="contact_widget_email">Email:<br />
			<input size="30" id="contact_widget_email" name="contact_widget_email" type="text" value="'.$settings['email'].'" /></label></p>';
	
}
wp_register_sidebar_widget( 'contact-widget', $themename.' - Contact Us', 'webtreats_contact_widget', array('description' => 'Quickly add contact info to your sidebar (e.g. address, phone #, email)'));
register_widget_control('contact-widget', 'webtreats_contact_widget_admin', 400, 200);

/**
 * *************************************  Contact Form Widget
 */
function webtreats_contact_form_widget($args) {
	$email_address = get_option("widget_contactform");
	$email_adress_reciever = $email_address['email'] != "" ? $email_address['email'] : get_option('admin_email');
	$loader_style = $args['name'] == "Sidebar" ? 'loadingImgWidgetSb' : 'loadingImgWidgetFt';
	
	echo $args['before_widget'];
	echo $args['before_title'] .'Email Us'. $args['after_title'];
	
//If the form is submitted
if(isset($_POST['submittedWidget'])) {
	require(WEBTREATS_INCLUDES . "/submit-widget.php");
}
?>

<?php if(isset($emailSent) && $emailSent == true) { ?>
	<a name="_contact"></a> 
		<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent.</p>

<?php } else { ?>
	
		<?php if(isset($captchaError)) { ?>
			<a name="_contact"></a>
			<p class="error">There was an error submitting the form.<p>
		<?php } ?>
		<a name="_contact"></a> 
		<form action="<?php the_permalink(); ?>#_contact" id="contactFormWidget" method="post">
			<p><input type="text" name="contactNameWidget" id="contactNameWidget" value="<?php if(isset($_POST['contactNameWidget'])) echo $_POST['contactNameWidget'];?>" class="requiredField textfield<?php if($nameError != '') {echo ' inputError';} ?>" size="22" tabindex="5" /><label class="textfield_label" for="contactNameWidget">Name *</label></p>

			<p><input type="text" name="emailWidget" id="emailWidget" value="<?php if(isset($_POST['emailWidget']))  echo $_POST['emailWidget'];?>" class="requiredField email textfield<?php if($emailError != '') {echo ' inputError';} ?>" size="22" tabindex="6" /><label class="textfield_label" for="emailWidget">Email *</label></p>

			<p><textarea name="commentsWidget" id="commentsTextWidget" rows="20" cols="30" tabindex="7" class="requiredField textarea<?php if($commentError != '') {echo ' inputError';} ?>"><?php if(isset($_POST['commentsWidget'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['commentsWidget']); } else { echo $_POST['commentsWidget']; } } ?></textarea></p>

			<p class="screenReader"><label for="checkingWidget" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checkingWidget" id="checkingWidget" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></p>

			<p class="<?php echo $loader_style; ?>"></p>
			
			<p><input name="submittedWidget" id="submittedWidget" class="button<?php if($args['name'] != "Sidebar"){echo ' in_footer';} ?>" tabindex="8" value="Submit" type="submit" /></p>
			<p class="screenReader"><input id="submitUrlWidget" type="hidden" name="submitUrlWidget" value="<?php echo get_template_directory_uri() . '/lib/includes/submit-widget.php'; ?>" /></p>
			<p class="screenReader"><input id="emailAddressWidget" type="hidden" name="emailAddressWidget" value="<?php echo $email_adress_reciever; ?>" /></p>

		</form>
<?php 
	}
	echo $args['after_widget'];
}

function webtreats_contact_form_widget_admin() {
	$settings = get_option("widget_contactform");

	// check if anything's been sent
	if (isset($_POST['update_email'])) {
		$settings['email'] = strip_tags(stripslashes($_POST['contact_email']));

		update_option("widget_contactform",$settings);
	}

	echo '<p>
			<label for="contact_email">Email Address:
			<input id="contact_email" name="contact_email" type="text" class="widefat" value="'.$settings['email'].'" /></label></p>';
	echo '<input type="hidden" id="update_email" name="update_email" value="1" />';

}
wp_register_sidebar_widget( 'contact-form-widget', $themename.' - Contact Form', 'webtreats_contact_form_widget', array('description' => 'Email contact form for sidebar'));
register_widget_control('contact-form-widget', 'webtreats_contact_form_widget_admin', 400, 200);
?>