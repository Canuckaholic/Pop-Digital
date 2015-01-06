<?php
	$tablet_class = $el_class = '';

	extract(
		shortcode_atts(
			array(
				'width' => '1/1',
				'font_color' => '',
				'tablet_width' => '',
				'el_class' => '',
				'css' => '',
			),
			$atts
		)
	);

	switch( $width ) {
		case '1/6':
			$shortcode_column = '1-6';
			break;
		case '1/4':
			$shortcode_column = '1-4';
			break;
		case '1/3':
			$shortcode_column = '1-3';
			break;
		case '1/2':
			$shortcode_column = '1-2';
			break;
		case '2/3':
			$shortcode_column = '2-3';
			break;
		case '3/4':
			$shortcode_column = '3-4';
			break;
		case '4/6':
			$shortcode_column = '4-6';
			break;
		case '5/6':
			$shortcode_column = '5-6';
			break;
		case '1/1':
		default :
			$shortcode_column = '1';
			break;
	}

	if ( !empty( $tablet_width ) ) {
		$tablet_class = 'grve-tablet-column-' . $tablet_width ;
	}

	$css_custom = grve_vc_shortcode_custom_css_class( $css, '' );
	$style = grve_build_shortcode_style( '', $font_color );

	$column_classes = array( 'wpb_column' );

	array_push( $column_classes, 'grve-column-' . $shortcode_column );

	if ( !empty( $css_custom ) ) {
		array_push( $column_classes, $css_custom );
	}
	if ( !empty ( $tablet_class ) ) {
		array_push( $column_classes, $tablet_class);
	}
	if ( !empty ( $el_class ) ) {
		array_push( $column_classes, $el_class);
	}

	$column_string = implode( ' ', $column_classes );

	echo '
		<div class="' . $column_string . '"' . $style . '>
			' . do_shortcode( $content ) . '
		</div>
	';
?>