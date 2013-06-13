<?php
/**
 * Miscellaneous Theme Functions
 */

// Register widgetized areas
function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Sidebar','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="widgettitle">','after_title' => '</h3>'));
	register_sidebars(5,array('name' => 'Footer %d','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="widgettitle">','after_title' => '</h3>'));
}

add_action( 'init', 'the_widgets_init' );


function new_more_link( $more_link, $more_link_text ) {
	return str_replace('more-link', 'more-link button_link', $more_link );
}
add_filter('the_content_more_link', 'new_more_link', 10, 2);


function new_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');


function new_comment_author_link($return) {
	return str_replace($return, "<span></span>$return", $return);
}
add_filter('get_comment_author_link', 'new_comment_author_link');


function webtreats_excerpt($length, $ellipsis) {
	$text = get_the_content();
	$text = preg_replace('`\[[^\]]*\]`','',$text);
	$text = strip_tags($text);
	//$text = preg_replace("/<img[^>]+\>/i", "", $text);
	$text = substr($text, 0, $length);
	$text = substr($text, 0, strripos($text, " "));
	$text = $text.$ellipsis;
	return $text;
}

function webtreats_truncate($string, $limit, $break=".", $pad="...") {
	if(strlen($string) <= $limit) return $string;
	
	 if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	  }
	return $string; 
}

function webtreats_image_resize($height,$width,$img_url) {

	$image['url'] = $img_url;
	$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
	$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
	$image_info = @getimagesize($image_path);

	// If we cannot get the image locally, try for an external URL
	if (!$image_info)
		$image_info = @getimagesize($image['url']);

	$image['width'] = $image_info[0];
	$image['height'] = $image_info[1];
	if($img_url != "" && ($image['width'] > $width || $image['height'] > $height || !isset($image['width']))){
		$img_url = WEBTREATS_SCRIPTS_FOLDER."/thumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=100";
	}
	
	return $img_url;
}

// Contact Form
function webtreats_contact_form($email) {

	$email_adress_reciever = $email != "" ? $email : get_option('admin_email');
	
	//If the form is submitted
	if(isset($_POST['submittedContact'])) {
		require(WEBTREATS_INCLUDES . "/submit.php");
	}
	
	if(isset($emailSent) && $emailSent == true) {
		
		$out .= '<a name="contact_"></a>';
		$out .= '<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent.</p>';
		
	} else {
		
		if(isset($captchaError)) {
			$out .= '<a name="contact_"></a>';
			$out .= '<p class="error">There was an error submitting the form.<p>';
		}
		
		$out .= '<a name="contact_"></a>';
		$out .= '<form action="' .get_permalink(). '#contact_" id="contact_form" method="post">';
		$out .= '<p><input type="text" name="contactName" id="contactName" value="';
		
		if(isset($_POST['contactName'])) {
			$out .= $_POST['contactName'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact textfield';
		
		if($emailError != '') {
			$out .= ' inputError';
		}
		$out .= '"';
		$out .= ' size="22" tabindex="1" /><label class="textfield_label" for="contactName">Name *</label></p>';
		
		$out .= '<p><input type="text" name="email" id="email" value="';
		
		if(isset($_POST['email'])) {
			$out .= $_POST['email'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact email textfield';
		
		if($emailError != '') {
			$out .= ' inputError';
		}
		$out .= '"';
		$out .= ' size="22" tabindex="2" /><label class="textfield_label" for="email">Email *</label></p>';
		
		$out .= '<p><textarea name="comments" id="commentsText" rows="20" cols="30" tabindex="3" class="requiredFieldContact textarea';
		
		if($commentError != '') {
			$out .= ' inputError';
		}
		$out .= '">';
		
		if(isset($_POST['comments'])) { 
			if(function_exists('stripslashes')) { 
				$out .= stripslashes($_POST['comments']); 
				} else { 
					$out .= $_POST['comments']; 
				} 
			}
		$out .= '</textarea></p>';
		
		$out .= '<p class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="';
		
		 if(isset($_POST['checking'])) {
			echo $_POST['checking'];
		}
		$out .= '" /></p>';
		
		$out .= '<p class="loadingImg"></p>';
		$out .= '<p><input name="submittedContact" id="submittedContact" class="button"  tabindex="4" value="Submit" type="submit" /></p>';
		$out .= '<p class="screenReader"><input id="submitUrl" type="hidden" name="submitUrl" value="' .get_template_directory_uri(). '/lib/includes/submit.php" /></p>';
		$out .= '<p class="screenReader"><input id="emailAddress" type="hidden" name="emailAddress" value="' .$email_adress_reciever. '" /></p>';
	
		$out .= '</form>';

	}
	return $out;
}

?>