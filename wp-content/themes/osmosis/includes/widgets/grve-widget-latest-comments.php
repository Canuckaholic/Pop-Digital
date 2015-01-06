<?php
/**
 * Plugin Name: Greatives Latest Comments
 * Description: A widget that displays latest comments.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */


add_action( 'widgets_init', 'grve_widget_latest_comments' );

function grve_widget_latest_comments() {
	register_widget( 'GRVE_Widget_Latest_Comments' );
}

class GRVE_Widget_Latest_Comments extends WP_Widget {

	function GRVE_Widget_Latest_Comments() {
		$widget_ops = array(
			'classname' => 'grve-comments',
			'description' => __( 'A widget that displays latest comments', GRVE_THEME_TRANSLATE ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-latest-comments',
		);
		$this->WP_Widget( 'grve-widget-latest-comments', '(Greatives) ' . __('Latest Comments', GRVE_THEME_TRANSLATE ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$num_of_comments = $instance['num_of_comments'];
		$show_avatar = $instance['show_avatar'];
		if ( empty( $num_of_comments ) ) {
			$num_of_comments = 5;
		}

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$comments = get_comments(
			array(
				'number' => $num_of_comments,
				'status' =>
				'approve',
				'post_status' => 'publish',
			)
		);
		$avatar = "";
		//Loop comments
		if ( $comments ) {
		?>
			<ul>
		<?php
			foreach ( (array) $comments as $comment ) {
		?>
				<li>
					<?php if( $show_avatar && '1' == $show_avatar ) { ?>
					<?php echo get_avatar( $comment, 30 ); ?>
					<?php } ?>
					<div class="grve-comment-content">
						<div class="grve-author">
							<?php echo sprintf( _x('%1$s on %2$s', GRVE_THEME_TRANSLATE), get_comment_author_link( $comment->comment_ID ), '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'); ?>
						</div>
						<div class="grve-comment-date"><?php echo get_the_date(); ?></div>

					</div>
				</li>
		<?php

			}
		?>
			</ul>
		<?php
 		} else {
			_e( 'No Comments Found!', GRVE_THEME_TRANSLATE );
		}

		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_of_comments'] = strip_tags( $new_instance['num_of_comments'] );
		$instance['show_avatar'] = strip_tags( $new_instance['show_avatar'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'num_of_comments' => '5',
			'show_avatar' => '1',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num_of_comments' ); ?>"><?php echo __( 'Number of comments:', GRVE_THEME_TRANSLATE ); ?></label>
			<select  name="<?php echo $this->get_field_name( 'num_of_comments' ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
					$selected = '';
					if ( $i == $instance['num_of_comments'] ) {
						$selected = 'selected="selected"';
					}
				?>
				    <option value="<?php echo $i; ?>" <?php echo $selected;?>><?php echo $i; ?></option>
				<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_avatar' ); ?>"><?php echo __( 'Show Avatar:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" type="checkbox" value="1" <?php checked( $instance['show_avatar'], 1 ); ?> />
		</p>

	<?php
	}
}

?>