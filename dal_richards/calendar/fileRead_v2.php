<?php
    $found = "false";
    $filename = "../DB/Calendar.csv";
    
    if (file_exists ($filename)){		
		$fp = fopen($filename,"r"); 
    }    
	
	while (!feof($fp)) {		
		$row = fgets($fp);		
    	$LineData = explode(",",$row);		
		$Spit = "";
		$Spit .= "<tr><td class=\"eventDate\">" . trim($LineData[0]) . "</td>";
		$Spit .= "<td class=\"eventDetails\">" . trim($LineData[1]) . "</td></tr>";
		echo $Spit;					
   }
?>