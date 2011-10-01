<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Audio</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
	<div class="largeTextTitle">Dal's Jukebox</div>
    <p>Welcome to Dal's Jukebox - a streaming audio gallery! Click on a song underneath the radio to listen. You can use the radio to adjust the volume, and pause/resume playback.</p>    
  	<div id="audioGallery">
		Audio Gallery
    </div>
	<script type="text/javascript">
		var f1 = new FlashObject("/flash/audio_player/Dal_audio_player.swf", "audioGallery", "444", "440", "6.0.29", "#FFFFFF");
		f1.addParam("quality", "high");				
   		f1.write("audioGallery");
	</script>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center"><a href="/multimedia/">Go back to the Multimedia page</a></p>
  <p>&nbsp;</p>    
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
