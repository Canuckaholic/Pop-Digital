<?php
	$output = $wrapper_class = $el_class = '';

	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'toggle' => 'no',
				'initial_state' => 'first',
				'margin_bottom' => '',
			),
			$atts
		)
	);

	$classes = array( 'grve-element' );
	$wrapper_classes = array();

	if( 'yes' == $toggle ){
		$classes[] = 'grve-toggle';
		$wrapper_classes[] = 'grve-toggle-wrapper';
	} else {
		$classes[] = 'grve-accordion';
		$wrapper_classes[] = 'grve-accordion-wrapper';
	}

	if( 'first' == $initial_state ){
		$wrapper_classes[] = 'grve-first-open';
	}


	if ( !empty( $el_class ) ) {
		$classes[] = $el_class;
	}

	$classes_string = join( ' ', $classes );
	$wrapper_classes_string = join( ' ', $wrapper_classes );

	$style = grve_build_margin_bottom_style( $margin_bottom );

	$output .= '<div class="' . $classes_string . '" style="' . $style . '">';
	$output .= '  <ul class="' . $wrapper_classes_string . '">';
	$output .= do_shortcode( $content );
	$output .= '  </ul>';
	$output .= '</div>';


	echo $output;
?>