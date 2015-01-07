<?php
/**
 * Testimonial Shortcode
 */

if( !function_exists( 'grve_testimonial_shortcode' ) ) {

	function grve_testimonial_shortcode( $attr, $content ) {

		$portfolio_row_start = $allow_filter = $class_fullwidth = $slider_data = $output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'items_to_show' => '20',
					'margin_bottom' => '',
					'slideshow_speed' => '3000',
					'navigation_type' => '1',
					'pause_hover' => 'no',
					'auto_height' => 'no',
					'align' => 'left',
					'text_style' => 'none',
					'el_class' => '',
				),
				$attr
			)
		);

		$testimonial_classes = array( 'grve-element', 'grve-testimonial', 'grve-carousel-element', 'grve-align-' . $align );

		if ( !empty ( $el_class ) ) {
			array_push( $testimonial_classes, $el_class);
		}

		if ( 'none' != $text_style ) {
			$text_style_class = 'grve-' .$text_style;
			array_push( $testimonial_classes, $text_style_class);
		}

		$testimonial_class_string = implode( ' ', $testimonial_classes );

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$slider_data = '';
		$slider_data .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$slider_data .= ' data-slider-autoheight="' . esc_attr( $auto_height ) . '"';
		$slider_data .= ' data-navigation-type="' . esc_attr( $navigation_type ) . '"';
		$slider_data .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';

		$testimonial_cat = "";

		if ( !empty( $categories ) ) {
			$testimonial_category_list = explode( ",", $categories );
			foreach ( $testimonial_category_list as $testimonial_list ) {
				$testimonial_term = get_term( $testimonial_list, 'testimonial_category' );
				$testimonial_cat = $testimonial_cat.$testimonial_term->slug . ', ';
			}
		}

		$args = array(
			'post_type' => 'testimonial',
			'post_status'=>'publish',
			'paged' => 1,
			'testimonial_category' => $testimonial_cat,
			'posts_per_page' => $items_to_show,
		);

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

		?>
			<div class="<?php echo esc_attr( $testimonial_class_string ); ?>" style="<?php echo $style; ?>"<?php echo $slider_data; ?>>

		<?php
		while ( $query->have_posts() ) : $query->the_post();


		$name =  grve_post_meta( 'grve_testimonial_name' );
		$identity =  grve_post_meta( 'grve_testimonial_identity' );

		if ( !empty( $identity ) ) {
			$identity = ', ' . $identity;
		}

		$name = '<span>' . $name . '</span>'

		?>
				<div class="grve-testimonial-element">
					<?php the_content(); ?>
					<div class="grve-testimonial-name"><?php echo $name . $identity; ?></div>
				</div>
		<?php
		endwhile;

		?>
			</div>

		<?php
		else :
		endif;
		wp_reset_postdata();

		return ob_get_clean();

	}
	add_shortcode( 'grve_testimonial', 'grve_testimonial_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Testimonial", "grve-osmosis-vc-extension" ),
	"description" => __( "Add a captivating testimonial slider", "grve-osmosis-vc-extension" ),
	"base" => "grve_testimonial",
	"class" => "",
	"icon"      => "icon-wpb-grve-testimonial",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Items to show", "grve-osmosis-vc-extension" ),
			"param_name" => "items_to_show",
			"value" => '20',
			"description" => __( "Maximum Testimonial Items to Show", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_slideshow_speed,
		array(
			"type" => 'checkbox',
			"heading" => __( "Pause on Hover", "grve-osmosis-vc-extension" ),
			"param_name" => "pause_hover",
			"value" => Array( __( "If selected, testimonial will be paused on hover", "grve-osmosis-vc-extension" ) => 'yes' ),
		),
		$grve_vce_add_auto_height,
		$grve_vce_add_navigation_type,
		array(
			"type" => "dropdown",
			"heading" => __( "Text Style", "grve-osmosis-vc-extension" ),
			"param_name" => "text_style",
			"value" => array(
				__( "None", "grve-osmosis-vc-extension" ) => '',
				__( "Leader", "grve-osmosis-vc-extension" ) => 'leader-text',
				__( "Subtitle", "grve-osmosis-vc-extension" ) => 'subtitle',
			),
			"description" => 'Select your text style',
		),
		array(
			"type" => "grve_multi_checkbox",
			"heading" => __("Testimonial Categories", "grve-osmosis-vc-extension" ),
			"param_name" => "categories",
			"value" => grve_vce_get_testimonial_categories(),
			"description" => __( "Select all or multiple categories.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
			"group" => __( "Categories", "grve-osmosis-vc-extension" ),
		),
		$grve_vce_add_align,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
	)
) );

?>