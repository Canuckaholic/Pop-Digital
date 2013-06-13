<?php
/**
 * Get all our options from the database
 */
global $options, $shortname;
$get_options = get_option($shortname.'_general_settings');
foreach ($options as $value) {
	if ($get_options[ $value['id'] ] == false) { $$value['id'] = $value['std'];
	} else { $$value['id'] = $get_options[ $value['id'] ]; }
}

?>