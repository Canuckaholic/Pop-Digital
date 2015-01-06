<?php

	$output = $el_class = '';
	
	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'title' => '',
				'tab_id' => '',
			),
			$atts
		)
	);

	$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="grve-tab-content ' . $el_class . '">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= "\n\t\t\t" . '</div>';

	echo $output;
?>