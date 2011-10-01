<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Calendar</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
<div class="largeTextTitle">Dal's Calendar</div>
<p>Here is Dal's schedule for the new few months. New event information is added regularly, so check back often.</p>
<table width="100%" cellpadding="6" cellspacing="5">
<?php 
$OutputFormat = "Full";
include($_SERVER['DOCUMENT_ROOT']."/calendar/fileRead_v2.php");
?>
</table>
<hr />
<?php
$MaxQuoteLength = 5;	
include($_SERVER['DOCUMENT_ROOT']."/Quotes/quote.php");
?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/leftColumn.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/footer.php"); ?>
</body>
</html>
