<?php
include('quotes.php');
srand(time());
$ArrCount = count($Quotes);
$GetQuote = array();
$j = 0;

for ($i = 0; $i <= $ArrCount; $i++) {
	if ($Quotes[$i]['Size'] <= $MaxQuoteLength) {
		if ($MaxQuoteLength < 6) {
			$GetQuote[$j] = $Quotes[$i]['Quote'];
			$j += 1;			
		}
		if ($MaxQuoteLength == 6 && $Quotes[$i]['Size'] > 1) {
			$GetQuote[$j] = $Quotes[$i]['Quote'];
  		$j += 1;			
		}
	}
}
$ArrCount = count($GetQuote);
for ($i = 0; $i <= $ArrCount; $i++) {
//echo ("[]" . $i . " [] " . $GetQuote[$i] . " []<br>\n");
}
$random = (rand()%($ArrCount-1));
echo($GetQuote[$random]);
?>