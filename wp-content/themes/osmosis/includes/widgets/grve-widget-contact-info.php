<?php
/**
 * Plugin Name: Greatives Contact Info
 * Description: A widget that displays Contact Info e.g: Address, Phone number.etc.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

add_action( 'widgets_init', 'grve_widget_contact_info' );

function grve_widget_contact_info() {
	register_widget( 'GRVE_Widget_Contact_Info' );
}

class GRVE_Widget_Contact_Info extends WP_Widget {

	function GRVE_Widget_Contact_Info() {
		$widget_ops = array(
			'classname' => 'grve-contact-info',
			'description' => __( 'A widget that displays contact info', GRVE_THEME_TRANSLATE ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-contact-info',
		);
		$this->WP_Widget( 'grve-widget-contact-info', '(Greatives) ' . __( 'Contact Info', GRVE_THEME_TRANSLATE ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$address = $instance['address'];
		$phone = $instance['phone'];
		$mobile = $instance['mobile'];
		$fax = $instance['fax'];
		$mail = $instance['mail'];
		$web = $instance['web'];

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>

		<ul>
			<?php if ( ! empty( $address ) ) { ?>
			<li class="grve-address"><?php echo $address; ?></li>
			<?php } ?>

			<?php if ( ! empty( $phone ) ) { ?>
			<li class="grve-phone"><?php echo $phone; ?></li>
			<?php } ?>

			<?php if ( ! empty( $mobile ) ) { ?>
			<li class="grve-mobile-number"><?php echo $mobile; ?></li>
			<?php } ?>

			<?php if ( ! empty( $fax ) ) { ?>
			<li class="grve-fax"><?php echo $fax; ?></li>
			<?php } ?>

			<?php if ( ! empty( $mail ) ) { ?>
			<li class="grve-email"><a href="mailto:<?php echo antispambot( $mail ); ?>"><?php echo antispambot( $mail ); ?></a></li>
			<?php } ?>

			<?php if ( ! empty( $web ) ) { ?>
			<li class="grve-web"><a href="<?php echo esc_url( $web ); ?>" target="_blank"><?php echo $web; ?></a></li>
			<?php } ?>
		</ul>


		<?php
		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['mobile'] = strip_tags( $new_instance['mobile'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['web'] = strip_tags( $new_instance['web'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'address' => '',
			'phone' => '',
			'mobile' => '',
			'fax' => '',
			'mail' => '',
			'web' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mobile' ); ?>"><?php _e( 'Mobile Phone:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="<?php echo $instance['mobile']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mail' ); ?>"><?php _e( 'Mail:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'mail' ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" value="<?php echo $instance['mail']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'web' ); ?>"><?php _e( 'Website:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'web' ); ?>" name="<?php echo $this->get_field_name( 'web' ); ?>" value="<?php echo $instance['web']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>