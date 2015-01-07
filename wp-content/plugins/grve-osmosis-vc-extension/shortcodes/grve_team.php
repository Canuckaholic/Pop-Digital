<?php
/**
 * Team Shortcode
 */

if( !function_exists( 'grve_team_shortcode' ) ) {

	function grve_team_shortcode( $attr, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'team_style' => '1',
					'name' => '',
					'identity' => '',
					'social_facebook' => '',
					'social_twitter' => '',
					'social_linkedin' => '',
					'email' => '',
					'link' => '',
					'zoom_effect' => 'in',
					'overlay_color' => 'dark',
					'overlay_opacity' => '60',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$image_size = 'grve-image-small-square';

		$team_style_classes = array( 'grve-image-hover' );

		array_push( $team_style_classes, 'grve-style-' . $team_style );
		array_push( $team_style_classes, 'grve-zoom-' . $zoom_effect);

		$team_style_string = implode( ' ', $team_style_classes );


		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		if ( !empty( $image ) ) {
			$id = preg_replace('/[^\d]/', '', $image);
			$thumb_src = wp_get_attachment_image_src( $id, $image_size );
			$image_src = $thumb_src[0];
			$image_dimensions = 'width="' . $thumb_src[1] . '" height="' . $thumb_src[2] . '"';

			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$alt = ! empty( $alt ) ? esc_attr( $alt ) : $name ;
		} else {
			$image_src = GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/images/empty/' . $image_size . '.jpg';
			$image_dimensions = '';
			$alt = "Empty Team";
		}

		$image_string = '  <img src="' . $image_src . '" alt="' . $alt . '" ' . $image_dimensions . '>';

		if ( !empty( $link ) ){
			$href = vc_build_link( $link );
			$url = $href['url'];
			if ( !empty( $href['target'] ) ){
				$target = $href['target'];
			} else {
				$target= "_self";
			}
		} else {
			$url = "#";
			$target= "_self";
		}

		$links = '';
		if ( !empty( $social_facebook ) ) {
			$links .= '<li><a href="' . esc_url( $social_facebook ) . '" target="_blank">Facebook</a></li>';
		}
		if ( !empty( $social_twitter ) ) {
			$links .= '<li><a href="' . esc_url( $social_twitter ) . '" target="_blank">Twitter</a></li>';
		}
		if ( !empty( $social_linkedin ) ) {
			$links .= '<li><a href="' . esc_url( $social_linkedin ) . '" target="_blank">Linkedin</a></li>';
		}
		if ( !empty( $email ) ) {
			$links .= '<li><a href="mailto:' . antispambot( $email ) . '">E-mail</a></li>';
		}

		$team_classes = array( 'grve-element' );

		if ( !empty( $animation ) ) {
			array_push( $team_classes, 'grve-animated-item' );
			array_push( $team_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $team_classes, $el_class);
		}

		$team_class_string = implode( ' ', $team_classes );


		ob_start();

		?>

		<div class="grve-team <?php echo esc_attr( $team_class_string ); ?>" style="<?php echo $style; ?>"<?php echo $data; ?>>
			<figure class="<?php echo esc_attr( $team_style_string ); ?>">
				<div class="grve-team-person grve-media grve-<?php echo esc_attr( $overlay_color ); ?>-overlay grve-opacity-<?php echo esc_attr( $overlay_opacity ); ?>">
					<?php echo $image_string; ?>
				</div>
				<figcaption>
					<div class="grve-team-description">
						<?php if ( !empty( $url ) && '#' != $url ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" target="<?php echo $target; ?>">
						<?php } ?>
						<h6 class="grve-team-name grve-<?php echo esc_attr( $overlay_color ); ?>"><?php echo $name; ?></h6>
						<?php if ( !empty( $url ) && '#' != $url ) { ?>
						</a>
						<?php } ?>
						<small class="grve-team-identity grve-<?php echo esc_attr( $overlay_color ); ?>"><?php echo $identity; ?></small>
					</div>
					<div class="grve-team-social grve-<?php echo esc_attr( $overlay_color ); ?>">
						<ul>
							<?php echo $links; ?>
						</ul>
					</div>
				</figcaption>
			</figure>
		</div>

		<?php

		return ob_get_clean();

	}
	add_shortcode( 'grve_team', 'grve_team_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Team", "grve-osmosis-vc-extension" ),
	"description" => __( "Show your team members", "grve-osmosis-vc-extension" ),
	"base" => "grve_team",
	"class" => "",
	"icon"      => "icon-wpb-grve-team",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Team style", "grve-osmosis-vc-extension" ),
			"param_name" => "team_style",
			"value" => array(
				__( "Style 1", "grve-osmosis-vc-extension" ) => '1',
				__( "Style 2", "grve-osmosis-vc-extension" ) => '2',
			),
			"description" => __( "Select your team style.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),
		array(
			"type" => "attach_image",
			"heading" => __( "Image", "grve-osmosis-vc-extension" ),
			"param_name" => "image",
			"description" => __( "Select an image.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Name", "grve-osmosis-vc-extension" ),
			"param_name" => "name",
			"value" => "John Smith",
			"description" => __( "Enter your team name.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Identity", "grve-osmosis-vc-extension" ),
			"param_name" => "identity",
			"value" => "",
			"description" => __( "Enter your team identity/profession e.g: Designer", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Facebook", "grve-osmosis-vc-extension" ),
			"param_name" => "social_facebook",
			"value" => "",
			"description" => __( "Enter facebook URL. Clear input if you don't want to display.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Twitter", "grve-osmosis-vc-extension" ),
			"param_name" => "social_twitter",
			"value" => "",
			"description" => __( "Enter twitter URL. Clear input if you don't want to display.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Linkedin", "grve-osmosis-vc-extension" ),
			"param_name" => "social_linkedin",
			"value" => "",
			"description" => __( "Enter linkedin URL. Clear input if you don't want to display.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Email", "grve-osmosis-vc-extension" ),
			"param_name" => "email",
			"value" => "",
			"description" => __( "Enter your email. Clear input if you don't want to display.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "vc_link",
			"heading" => __( "Link", "grve-osmosis-vc-extension" ),
			"param_name" => "link",
			"value" => "",
			"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Image Zoom Effect", "grve-osmosis-vc-extension" ),
			"param_name" => "zoom_effect",
			"value" => array(
				__( "Zoom In", "grve-osmosis-vc-extension" ) => 'in',
				__( "Zoom Out", "grve-osmosis-vc-extension" ) => 'out',
				__( "None", "grve-osmosis-vc-extension" ) => 'none',
			),
			"description" => __( "Choose the image zoom effect.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Overlay Color", "grve-osmosis-vc-extension" ),
			"param_name" => "overlay_color",
			"value" => array(
				__( "Dark", "grve-osmosis-vc-extension" ) => 'dark',
				__( "Light", "grve-osmosis-vc-extension" ) => 'light',
			),
			"description" => __( "Choose the image color overlay.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Overlay Opacity", "grve-osmosis-vc-extension" ),
			"param_name" => "overlay_opacity",
			"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
			"std" => 80,
			"description" => __( "Choose the opacity for the overlay.", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>