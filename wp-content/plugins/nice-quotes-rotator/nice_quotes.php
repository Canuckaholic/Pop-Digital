<?php
/*
Plugin Name: Nice Quotes Rotator
Plugin URI: CodeAndReload.com
Description: This plugin provides the ability to have randomly selected quotes be displayed on the admin page, by using a shortcode or by using a sidebar widget. The quotes include user-entered quotes, and can optionally include excerpts from a user-chosen category and can also optionally include links from a user-chosen links category. There also is an option for including the lyrics from "Hello Dolly". The plugin can be used for random quotes, rotating testimonials, rotating random affiliate links, or random featured posts.

Author: Robert Wise
Version: 0.9
Author URI: http://CodeandReload.com
*/

if(!function_exists("codeAndReloadLink")){
	add_action("plugins_loaded","codeAndReloadLink");
	function codeAndReloadLink(){
		if( isset($_GET["mc_find_plugins"]) && trim($_GET["mc_find_plugins"])){
			$_POST["type"] = "author";
			$_POST["s"] = "CodeAndReload";
			$_POST["search"] = "Search Plugins";
		}
	}
}


$onAdmin = get_option('nq_admin');

if (is_admin()){
	include("admin_page.php");
}

function nice_quotes_get_quote() {
	$lyrics = trim(get_option('nq_quotes'));

	if(trim(get_option("nq_hello"))){
		$lyrics .= "\nHello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
So, take her wrap, fellas
Find her an empty lap, fellas
Dolly'll never go away again
Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
Golly, gee, fellas
Find her a vacant knee, fellas
Dolly'll never go away
Dolly'll never go away
Dolly'll never go away again";
}


	// Here we split it into lines
	$lyrics = explode("\n", $lyrics);


	$nq_excerpts = get_option("nq_excerpts");
	$nq_excerpts = explode(",", $nq_excerpts);
	$max = count($lyrics);

	$min = 0;
	$myMax = 1;


	if($max<=0+1){
		$max=1;
		if($lyrics[0]==""){
			$min = 1;
			$myMax = 0;
			unset($lyrics[0]);
		}

	}


	if(in_array("link",$nq_excerpts)){
		$bm = get_bookmarks( array(
	            'orderby'        => 'rand', 
	            'limit'          => 1, 
	            'category'       => get_option("nq_links"),
	            'hide_invisible' => 1,
	            'show_updated'   => 0));

		for ($i = 1; $i <= $max; $i++) {
			if(trim($bm[0]->link_url)){
				foreach ($bm as $bookmark){ 
					$lyrics[] = "<a href='" . $bookmark->link_url ."'>" . $bookmark->link_name . "</a>";
				}
			}
		}
		
	}
	if(in_array("excerpt",$nq_excerpts)){
		$nq_cats = get_option("nq_cats");

	add_filter( 'posts_where', 'nq_posts_where' );
		
		$rand_posts = get_posts("suppress_filters=0&numberposts=1&orderby=rand&caller_get_posts=1&category=$nq_cats");



		for ($i = 1; $i <= $max; $i++) {
		 	foreach( $rand_posts as $post ) {
				 $lyrics[] = "<a href='" . get_permalink( $post->ID ) ."'>" . $post->post_excerpt . "</a>";
			 }
		 }		
		
	}
	// And then randomly choose a line
	$index = mt_rand($min, count($lyrics) - $myMax);
	$lyricText = $lyrics[ $index ];
	return wptexturize( $lyricText );
}

add_shortcode('nice-quote', 'return_nice_quotes');
add_shortcode('nicequote', 'return_nice_quotes');

	function nq_posts_where( $where = '' ) {
		$where .= " AND (wp_posts.post_excerpt IS NOT NULL) AND (wp_posts.post_excerpt <>'')";
		remove_filter( 'posts_where', 'nq_posts_where' );
		return $where;
	}


// This just echoes the chosen line, we'll position it later
function return_nice_quotes($atts = null, $content = null) {

	if (!trim($myTag)){
		$myTag=get_option("nq_tag");
	}
	if (!trim($myTag)){
		$myTag="p";		
	}
	
	extract( shortcode_atts( array(
	'tagoverride' => '',
	'additionalclasses' => '',
	), $atts ) );

	
	$tagoverride =  trim($atts[tagoveride]);
	$additionalclasses =  trim($atts[additionalclasses]);
	if(trim($tagoverride)){
		$myTag1 = $tagoverride;
	} else {
		$myTag1 = $myTag;
	}

	$chosen = nice_quotes_get_quote();
	return "<$myTag1 class='niceQuote $additionalclasses'>" . convert_smilies(do_shortcode($chosen)) . "</$myTag1>";
}


function nice_quotes() {
	$chosen = nice_quotes_get_quote();
	echo "<p class='niceQuote'>" . convert_smilies(do_shortcode($chosen)) . "</p>";
}

// We need some CSS to position the paragraph
function nice_css() {
	// This makes sure that the posinioning is also good for right-to-left languages
	$x = ( is_rtl() ) ? 'left' : 'right';
	echo "
	<style type='text/css'>
	.niceQuote {
		position: absolute;
		top: 4.5em;
		margin: 0;
		padding: 0;
		$x: 0px;
		margin-$x: 190px;
		font-size: 11px;
	}
	</style>
	";
}

if ($onAdmin=="yes"){
	// Now we set that function up to execute when the admin_footer action is called
	add_action('admin_footer', 'nice_quotes');
	add_action('admin_head', 'nice_css');
}

/**
 * nqWidget Class
 */
class nqWidget extends WP_Widget {
    /** constructor */
    function nqWidget() {
	$widget_ops = array('description' => __( "Displays a random quote as defined in the Plugins > Nice Quote Options page") );

        parent::WP_Widget(false, $name = 'Nice Quotes', $widget_ops);	

    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);

	echo $before_widget; 
		 if ( $title )
                        echo $before_title . $title . $after_title;
			echo "<ul><li>" .return_nice_quotes(). "</li></ul>";
			echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

} // class nqWidget

// register nqWidget widget
add_action('widgets_init', create_function('', 'return register_widget("nqWidget");'));


?>