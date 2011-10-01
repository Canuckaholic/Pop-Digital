<?php
    $found = "false";
    $filename = "../DB/Calendar.csv";
    
    if (file_exists ($filename)){
		$fp = fopen($filename,"r+"); 
    } else {
		$fp = fopen($filename,"w");
	}    
    $offset = 0;
    $where = 0;
    $totaldata = "";
    $WaitForData = 0;
    $ShortSpitTwo = 0;
    $TodayOffset = 86400;

    $Stats_total = 0;
    $Stats_upcoming = 0;
    $Stats_past = 0;
    $Stats_major = 0;            
    
    while ($row = fgets($fp)) {
    if (strlen($row) > 4 ) {

    $LineData = explode(",",$row);
	  if ($WaitForData == 1) {

	  $QuotationStarted = 0;
	  $QuotationEnded = 0;
	  $LineToInsert = 0;
	  $MidQuotation = 0;

		$FilterOut = "";
	  
		for ($i = 0; $i <= sizeof($LineData); $i++) {

			if ($QuotationStarted == 1) { $MidQuotation = 1; }
			if ($LineData[$i][0] == "\"") { $QuotationStarted = 1; }
			if ($LineData[$i][strlen($LineData[$i])-1] == "\"") { $QuotationEnded = 1; }
			
			if (($QuotationStarted == 1) && ($QuotationEnded == 0) && ($MidQuotation == 1)) {
				$FilterOut[$LineToInsert] .= str_replace('"', '', $LineData[$i]) . ",";
			}

			if (($QuotationStarted == 1) && ($QuotationEnded == 0) && ($MidQuotation == 0)) {
				$FilterOut[$LineToInsert] = str_replace('"', '', $LineData[$i]) . ",";
			}
			
			if (($QuotationStarted == 0) && ($QuotationEnded == 0) && ($MidQuotation == 0)) {
				$FilterOut[$LineToInsert] = $LineData[$i];
				$LineToInsert += 1;
			}
			if ($QuotationEnded == 1) {
				$QuotationEnded = 0;
				$QuotationStarted = 0;
				$MidQuotation = 0;
				$FilterOut[$LineToInsert] .= str_replace('"', '', $LineData[$i]);
				$LineToInsert += 1;
			}
		}

	if ($OutputFormat == "Short") {	
		$showtime = strtotime($FilterOut[0]);
		if ((time() - ($showtime+$TodayOffset)) > 0) {
			//event is past.
		} else {
			if (($ShortSpitTwo < 2) && ($FilterOut[6] == 1)) {
			$ShortSpitTwo = $ShortSpitTwo + 1;	
			$Spit = "";
			$Spit .= "<h4 class=\"NewsTitle\"><a href=\"Calendar.php#" . $showtime . "\" class=\"linkTitle\">";
			$Spit .= strtoupper(date("M j, Y", $showtime));
      $Spit .= "</a></h4>\n";

      $Spit .= "<p class=\"NewsEvent\"><a href=\"Calendar.php#" . $showtime . "\" class=\"linkEvent\">";
      $Spit .= trim($FilterOut[2]) . ".<br />" . trim($FilterOut[3]) . "<br />" . trim($FilterOut[4]);
      $Spit .= "</a></p>\n\n";
			echo $Spit;
			}
		}
	}

	if ($OutputFormat == "Admin") {

		$Stats_total += 1;
		$showtime = strtotime($FilterOut[0]);
		if ((time() - ($showtime+$TodayOffset)) > 0) {
			
			//event is past.
			$Stats_past += 1;
		} else {		
			$Stats_upcoming += 1;
		}

		if ($FilterOut[6] == 1) {
			$Stats_major += 1;
		}
	}
	
	if ($OutputFormat == "Full") {		
		echo $showtime = strtotime($FilterOut[0]); 
			$Spit = "";
				if ((time() - ($showtime+$TodayOffset)) > 0) {
					$Spit .= "<div class=\"EventPast\">";
				} else {
					$Spit .= "<div class=\"EventUpcoming\">";
				}
			$Spit .= "<a name=\"" . $showtime . "\"></a>\n";
			if (((time() - ($showtime)) > 0) && ((time() - ($showtime+$TodayOffset)) < 0)) {
			$Spit .= "<h3 class=\"EventNow\">" . date("l, F j, Y", $showtime) . "<span class=\"EventToday\"> (today)</span></h3>\n";
			} else {			
			$Spit .= "<h3 class=\"EventDate\">" . date("l, F j, Y", $showtime) . "</h3>\n";
			}
			$Spit .= "<p class=\"EventBand\">" . trim($FilterOut[1]) . "</p>\n"; 
			$Spit .= "<p class=\"EventName\">" . trim($FilterOut[2]) . "</p>\n";
			$Spit .= "<p class=\"EventVenue\">" . trim($FilterOut[3]) . "</p>\n";
			$Spit .= "<p class=\"EventTime\">" . trim($FilterOut[4]) . "</p>\n";
			$Spit .= "<p class=\"EventNotes\">" . trim($FilterOut[5]) . "</p>\n\n";						
			$Spit .= "</div>";
			echo $Spit;
			}
	  } else {

			if ($LineData[0] == "Data:") { $WaitForData = 1; }
	  }
    $where = $where + 1;
	  $totaldata = $totaldata . $row . "\n";

    $offset = ftell($fp);
   }
    }

if ($OutputFormat == "Admin") {
$Spit = "";
$Spit .= "<h4 class=\"NewsTitle\">Logged in.</h4>";
$Spit .= "<p class=\"NewsEvent\"><br />Total Events: " . $Stats_total . "</p>";
$Spit .= "<p class=\"NewsEvent\">Upcoming: " . $Stats_upcoming . "</p>";
$Spit .= "<p class=\"NewsEvent\">Past: " . $Stats_past . "</p>";
$Spit .= "<p class=\"NewsEvent\">Major events: " . $Stats_major . "</p>";
$Spit .= "<p class=\"NewsEvent\" style=\"text-align:right; padding-top: 10px;\"><a style=\"color: #666;\" href=\"Admin.php\">Refresh stats</a></p>";
echo $Spit;
}
?>