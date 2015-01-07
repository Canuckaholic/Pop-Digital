<?php
/**
 * Social Shortcode
 */

if( !function_exists( 'grve_social' ) ) {

	function grve_social_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'social_facebook' => '',
					'social_twitter' => '',
					'social_linkedin' => '',
					'social_googleplus' => '',
					'social_reddit' => '',
					'animation' => '',
					'align' => 'left',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);


		$social_classes = array( 'grve-element', 'grve-social', 'grve-social-large', 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $social_classes, 'grve-animated-item' );
			array_push( $social_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $social_classes, $el_class);
		}
		$social_class_string = implode( ' ', $social_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$grve_permalink = esc_url( get_permalink() );
		$grve_title = esc_attr( get_the_title() );

		ob_start();

		?>
			<div class="<?php echo esc_attr( $social_class_string ); ?>" style="<?php echo $style; ?>"<?php echo $data; ?>>
				<ul>

					<?php if ( !empty( $social_facebook  ) ) { ?>
					<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-facebook grve-icon-facebook"></a></li>
					<?php } ?>
					<?php if ( !empty( $social_twitter  ) ) { ?>
					<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-twitter grve-icon-twitter"></a></li>
					<?php } ?>
					<?php if ( !empty( $social_linkedin  ) ) { ?>
					<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-linkedin grve-icon-linkedin"></a></li>
					<?php } ?>
					<?php if ( !empty( $social_googleplus  ) ) { ?>
					<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-googleplus grve-icon-google-plus"></a></li>
					<?php } ?>
					<?php if ( !empty( $social_reddit  ) ) { ?>
					<li><a href="<?php echo $grve_permalink; ?>" title="<?php echo $grve_title; ?>" class="grve-social-share-reddit grve-icon-reddit"></a></li>
					<?php } ?>

				</ul>
			</div>
		<?php

		return ob_get_clean();

	}
	add_shortcode( 'grve_social', 'grve_social_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Social", "grve-osmosis-vc-extension" ),
	"description" => __( "Place your preferred social", "grve-osmosis-vc-extension" ),
	"base" => "grve_social",
	"class" => "",
	"icon"      => "icon-wpb-grve-social",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => 'checkbox',
			"heading" => __( "Facebook", "grve-osmosis-vc-extension" ),
			"param_name" => "social_facebook",
			"description" => __( "Share in Facebook", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show Facebook social share", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Twitter", "grve-osmosis-vc-extension" ),
			"param_name" => "social_twitter",
			"description" => __( "Share in Twitter", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show Twitter social share", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Linkedin", "grve-osmosis-vc-extension" ),
			"param_name" => "social_linkedin",
			"description" => __( "Share in Linkedin", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show Linkedin social share", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Google +", "grve-osmosis-vc-extension" ),
			"param_name" => "social_googleplus",
			"description" => __( "Share in Google +", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show Google + social share", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "reddit", "grve-osmosis-vc-extension" ),
			"param_name" => "social_reddit",
			"description" => __( "Submit in reddit", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Show reddit social share", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		$grve_vce_add_align,
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	),
) );
?>