<?php
	$output = $el_class = '';

	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'title' => '',
			),
			$atts
		)
	);

	$output .= '<li class="' . $el_class . '">';
	$output .= '  <div class="grve-title"> ' . $title . '</div>';
	$output .= '  <div class="grve-content">' . wpb_js_remove_wpautop( $content ) . '</div>';
	$output .= '</li>';

	echo $output;
?>