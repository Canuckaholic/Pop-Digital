<?php
/**
 * Plugin Name: Greatives Social Networking
 * Description: A widget that displays social networking links.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

add_action( 'widgets_init', 'grve_widget_social' );

function grve_widget_social() {
	register_widget( 'GRVE_Widget_Social' );
}

class GRVE_Widget_Social extends WP_Widget {

	function GRVE_Widget_Social() {
		$widget_ops = array(
			'classname' => 'grve-social',
			'description' => __( 'A widget that displays social networking links', GRVE_THEME_TRANSLATE ),
		);
		$control_ops = array(
			'width' => 400,
			'height' => 600,
			'id_base' => 'grve-widget-social',
		);
		$this->WP_Widget( 'grve-widget-social', '(Greatives) ' . __( 'Social Networking', GRVE_THEME_TRANSLATE ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );


		$grve_social_items = array (
			array(
				'title' => 'Twitter',
				'url' => grve_array_value( $instance, 'twitter_url' ),
				'class' => 'twitter',
			),
			array(
				'title' => 'Facebook',
				'url' => grve_array_value( $instance, 'facebook_url' ),
				'class' => 'facebook',
			),
			array(
				'title' => 'Google+',
				'url' => grve_array_value( $instance, 'googleplus_url' ),
				'class' => 'google-plus',
			),
			array(
				'title' => 'RSS',
				'url' => grve_array_value( $instance, 'rss_url' ),
				'class' => 'rss',
			),
			array(
				'title' => 'LinkedIn',
				'url' => grve_array_value( $instance, 'linkedin_url' ),
				'class' => 'linkedin',
			),
			array(
				'title' => 'YouTube',
				'url' => grve_array_value( $instance, 'youtube_url' ),
				'class' => 'youtube',
			),
			array(
				'title' => 'Flickr',
				'url' => grve_array_value( $instance, 'flickr_url' ),
				'class' => 'flickr',
			),
			array(
				'title' => 'Pinterest',
				'url' => grve_array_value( $instance, 'pinterest_url' ),
				'class' => 'pinterest',
			),
			array(
				'title' => 'Dribbble',
				'url' => grve_array_value( $instance, 'dribbble_url' ),
				'class' => 'dribbble',
			),
			array(
				'title' => 'Tumblr',
				'url' => grve_array_value( $instance, 'tumblr_url' ),
				'class' => 'tumblr',
			),
			array(
				'title' => 'GitHub',
				'url' => grve_array_value( $instance, 'github_url' ),
				'class' => 'github',
			),
			array(
				'title' => 'instagram',
				'url' => grve_array_value( $instance, 'instagram_url' ),
				'class' => 'instagram',
			),
			array(
				'title' => 'reddit',
				'url' => grve_array_value( $instance, 'reddit_url' ),
				'class' => 'reddit',
			),
			array(
				'title' => 'Skype',
				'url' => grve_array_value( $instance, 'skype_url' ),
				'class' => 'skype',
			),
			array(
				'title' => 'Vimeo',
				'url' => grve_array_value( $instance, 'vimeo_url' ),
				'class' => 'vimeo',
			),
			array(
				'title' => 'WeChat',
				'url' => grve_array_value( $instance, 'wechat_url' ),
				'class' => 'wechat',
			),
			array(
				'title' => 'Weibo',
				'url' => grve_array_value( $instance, 'weibo_url' ),
				'class' => 'weibo',
			),
			array(
				'title' => 'Renren',
				'url' => grve_array_value( $instance, 'renren_url' ),
				'class' => 'renren',
			),
			array(
				'title' => 'QQ',
				'url' => grve_array_value( $instance, 'qq_url' ),
				'class' => 'qq',
			),
		);


		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
	?>

		<ul>
		<?php
		foreach ( $grve_social_items as $social_item ) {
			if ( ! empty( $social_item['url'] ) ) {

				if ( 'skype' == $social_item['class'] ) {
		?>
					<li>
						<a href="<?php echo $social_item['url']; ?>" class="grve-icon-<?php echo $social_item['class']; ?>"></a>
					</li>
		<?php
				} else {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item['url'] ); ?>" class="grve-icon-<?php echo $social_item['class']; ?>" target="_blank"></a>
					</li>
		<?php
				}
			}
		}
		?>
		</ul>


	<?php

		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_url'] = strip_tags( $new_instance['twitter_url'] );
		$instance['facebook_url'] = strip_tags( $new_instance['facebook_url'] );
		$instance['googleplus_url'] = strip_tags( $new_instance['googleplus_url'] );
		$instance['rss_url'] = strip_tags( $new_instance['rss_url'] );
		$instance['linkedin_url'] = strip_tags( $new_instance['linkedin_url'] );
		$instance['youtube_url'] = strip_tags( $new_instance['youtube_url'] );
		$instance['flickr_url'] = strip_tags( $new_instance['flickr_url'] );
		$instance['pinterest_url'] = strip_tags( $new_instance['pinterest_url'] );
		$instance['dribbble_url'] = strip_tags( $new_instance['dribbble_url'] );
		$instance['tumblr_url'] = strip_tags( $new_instance['tumblr_url'] );
		$instance['github_url'] = strip_tags( $new_instance['github_url'] );
		$instance['instagram_url'] = strip_tags( $new_instance['instagram_url'] );
		$instance['reddit_url'] = strip_tags( $new_instance['reddit_url'] );
		$instance['skype_url'] = strip_tags( $new_instance['skype_url'] );
		$instance['vimeo_url'] = strip_tags( $new_instance['vimeo_url'] );
		$instance['wechat_url'] = strip_tags( $new_instance['wechat_url'] );
		$instance['weibo_url'] = strip_tags( $new_instance['weibo_url'] );
		$instance['renren_url'] = strip_tags( $new_instance['renren_url'] );
		$instance['qq_url'] = strip_tags( $new_instance['qq_url'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'twitter_url'=>'',
			'facebook_url'=>'',
			'googleplus_url'=>'',
			'rss_url'=>'',
			'linkedin_url'=>'',
			'youtube_url'=>'',
			'flickr_url'=>'',
			'pinterest_url'=>'',
			'dribbble_url'=>'',
			'tumblr_url'=>'',
			'github_url'=>'',
			'instagram_url'=>'',
			'reddit_url'=>'',
			'skype_url'=>'',
			'vimeo_url'=>'',
			'wechat_url'=>'',
			'weibo_url'=>'',
			'renren_url'=>'',
			'qq_url'=>'',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$grve_social_items = array (
			array(
				'title' => __( 'Twitter', GRVE_THEME_TRANSLATE ),
				'url' => 'twitter_url',
			),
			array(
				'title' => __( 'Facebook', GRVE_THEME_TRANSLATE ),
				'url' => 'facebook_url',
			),
			array(
				'title' => __( 'Google+', GRVE_THEME_TRANSLATE ),
				'url' => 'googleplus_url',
			),
			array(
				'title' => __( 'RSS', GRVE_THEME_TRANSLATE ),
				'url' => 'rss_url',
			),
			array(
				'title' => __( 'LinkedIn', GRVE_THEME_TRANSLATE ),
				'url' => 'linkedin_url',
			),
			array(
				'title' => __( 'YouTube', GRVE_THEME_TRANSLATE ),
				'url' => 'youtube_url',
			),
			array(
				'title' => __( 'Flickr', GRVE_THEME_TRANSLATE ),
				'url' => 'flickr_url',
			),
			array(
				'title' => __( 'Pinterest', GRVE_THEME_TRANSLATE ),
				'url' => 'pinterest_url',
			),
			array(
				'title' => __( 'Dribbble', GRVE_THEME_TRANSLATE ),
				'url' => 'dribbble_url',
			),
			array(
				'title' => __( 'Tumblr', GRVE_THEME_TRANSLATE ),
				'url' => 'tumblr_url',
			),
			array(
				'title' => __( 'GitHub', GRVE_THEME_TRANSLATE ),
				'url' => 'github_url',
			),
			array(
				'title' => 'instagram',
				'url' => 'instagram_url',
			),
			array(
				'title' => 'reddit',
				'url' => 'reddit_url',
			),
			array(
				'title' => 'Skype',
				'url' => 'skype_url',
			),
			array(
				'title' => 'Vimeo',
				'url' => 'vimeo_url',
			),
			array(
				'title' => 'WeChat',
				'url' => 'wechat_url',
			),
			array(
				'title' => 'Weibo',
				'url' => 'weibo_url',
			),
			array(
				'title' => 'Renren',
				'url' => 'renren_url',
			),
			array(
				'title' => 'QQ',
				'url' => 'qq_url',
			),
		);

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
				<em><?php echo __( 'Note: Make sure you include the full URL (i.e. http://www.samplesite.com)', GRVE_THEME_TRANSLATE ); ?></em>
				<br>
				 <?php echo __( 'If you do not want a social to be visible, simply delete the supplied URL.', GRVE_THEME_TRANSLATE ); ?>
		</p>

		<?php
		foreach ( $grve_social_items as $social_item ) {
		?>

				<p>
					<label for="<?php echo $this->get_field_id( $social_item['url'] ); ?>"><?php echo $social_item['title']; ?>:</label>
					<input style="width: 100%;" id="<?php echo $this->get_field_id( $social_item['url'] ); ?>" name="<?php echo $this->get_field_name( $social_item['url'] ); ?>" value="<?php echo $instance[ $social_item['url'] ]; ?>" />
				</p>

		<?php
		}
		?>

	<?php
	}
}

?>