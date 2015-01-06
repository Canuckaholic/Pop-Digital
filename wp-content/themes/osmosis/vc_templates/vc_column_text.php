<?php
	$el_class = $data = '';

	extract(
		shortcode_atts(
			array(				
				'text_style' => '',
				'animation' => '',
				'animation_delay' => '200',
				'el_class' => '',
				'css' => '',				
			),
			$atts
		)
	);
	
	$text_classes = array( 'grve-element', 'grve-text' );
	$css_custom = grve_vc_shortcode_custom_css_class( $css, '' );
	
	if ( !empty( $animation ) ) {
		array_push( $text_classes, 'grve-animated-item' );
		array_push( $text_classes, $animation);
		$data = ' data-delay="' . $animation_delay . '"';
	}
	if ( !empty( $text_style ) ) {
		array_push( $text_classes, 'grve-' . $text_style );
	}
	if ( !empty( $el_class ) ) {
		array_push( $text_classes, $el_class);
	}
	
	if ( !empty( $css_custom ) ) {
		array_push( $text_classes, $css_custom );
	}
	
	$text_class_string = implode( ' ', $text_classes );
	
	$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");
	
	
	echo '<div class="' . $text_class_string . '"' . $data . '>		
			' . do_shortcode( shortcode_unautop( $content ) ) . '	
		</div>
	';
?>