<?php
/*
Template Name: Test
*/


    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

<div id="homepageBottomContent">
        
<?php

global $wpdb;

//$wpTablesReloadedRow = $wpdb->get_row("SELECT * FROM $wpdb->wp_options WHERE option_name = 'wp_table_reloaded_data_1'", ARRAY_A);

$wpTablesReloadedRow = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->options WHERE option_name = 'wp_table_reloaded_data_1'"), ARRAY_A);

if ($wpTablesReloadedRow) {
	//print_r($wpTablesReloadedRow);	
	//echo "Results = ".$wpTablesReloadedRow[0]['option_value']."<br><br>";
	
	//print_r(unserialize($wpTablesReloadedRow[0]['option_value']));
	
	$myData = unserialize($wpTablesReloadedRow[0]['option_value']);
	
	//print_r($myData['data']);
	
	echo "start = ".($myData['data'][1][0])."<br>";
	echo "end = ".($myData['data'][1][2])."<br>";	
	
	foreach ($myData['data'] as $myRow) {
		$startTime = $myRow[0];
		$endTime = $myRow[2];
		$weekDay = $myRow[5];
		$onAirProgram = $myRow[4];
		$station = $myRow[6];
		
		echo($startTime." ".$endTime." ".$weekDay." ".$onAirProgram." ".$station."<br>");		
	}
	
} else {
	echo "No go.";
}

?>

    </div>
    
<?php

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>