<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Multimedia</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
	<div class="largeTextTitle">65th Anniversay at the Fair</div>
    <div class="smallTextTitle">August 24-25 at the PNE</div>
    <br />
    <div align="center">
    <div id="august">
		Video
    </div>
	<script type="text/javascript">
		var f1 = new FlashObject("/flash/videos/august24-25.swf", "august", "444", "340", "6.0.29", "#FFFFFF");
		f1.addParam("quality", "high");				
   		f1.write("august");
	</script>
    </div>
    <p align="center"><a href="/multimedia/videos/">Go back to the Video Gallery page</a></p>
    <p>&nbsp;</p> 
    <div align="center"><img src="/Images/common/logo.gif" width="200" height="170" border="0" /></div>
    <br /><br />
<hr />
<?php
$MaxQuoteLength = 4;	
include($_SERVER['DOCUMENT_ROOT']."/Quotes/quote.php");
?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/leftColumn.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/footer.php"); ?>
</body>
</html>
