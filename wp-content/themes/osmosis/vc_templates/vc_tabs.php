<?php
	$output = $tabs_nav = $el_class = '';

	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'margin_bottom' => '',
			),
			$atts
		)
	);


	$style = grve_build_margin_bottom_style( $margin_bottom );

	// Extract tab titles
	preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();

	if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }

	$tabs_nav .= '<ul class="grve-tabs-title">';
	foreach ( $tab_titles as $tab ) {
		preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		if(isset($tab_matches[1][0])) {			
			$tabs_nav .= '<li data-rel="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</li>';
		}
	}
	$tabs_nav .= '</ul>'."\n";

	$output .= "\n\t".'<div class="grve-element grve-tab" style="' . $style . '">';
	$output .= "\n\t\t\t" . $tabs_nav;
	$output .= "\n\t\t".'<div class="grve-tabs-wrapper"> ';
	$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
	$output .= "\n\t\t".'</div> ';
	$output .= "\n\t".'</div> ';

	echo $output;
?>