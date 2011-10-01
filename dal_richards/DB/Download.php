<?php
// We'll be outputting a CSV
header('Content-Type: application/octet-stream');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="Calendar.csv"');

    $found = "false";
    $filename = "Calendar.csv";
    
    if (file_exists ($filename))
    { $fp = fopen($filename,"r+"); 
    } else { $fp = fopen($filename,"w"); }
    
    $offset = 0;
    $where = 0;
    $totaldata = "";
    
    while ($row = fgets($fp,4096)) {
    if (strlen($row) > 4 ) {

    $tols = explode(";",$row);
    $newstring = implode(" ; ",$tols);
    $tols = explode(";",$newstring);
    $cols = $tols;
    $where = $where + 1;


$totaldata = $totaldata . $row;

    $offset = ftell($fp);
    } }

print($totaldata);

?>