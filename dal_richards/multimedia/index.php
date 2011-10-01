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
	<div class="largeTextTitle">Photos, Music and Videos!</div>
    <a href="photos/"><img src="/Images/multimedia/photo_thumb.jpg" width="240" height="180" border="0" class="pictureFloatLeft" /></a>
    <div class="smallTextTitle">Photo Gallery</div>
	<p>Check out some of Dal's photos from performances, appearances, and more.</p>
    <p>Even after more than a half century of entertaining, you've never looked better, Dal!</p>
  <p><a href="photos/">Visit the Photo Gallery</a></p>    
    <div style="clear: left;"></div>
    <hr />    
    <a href="audio/"><img src="/Images/multimedia/audio_thumb.jpg" width="240" height="180" border="0" class="pictureFloatRight" /></a>
    <div class="smallTextTitle">Audio</div>
    <p>Of course their live shows are something not be missed, but in the meantime have a listen to Dal and his Orchestra online!</p>
    <p>Here's your chance to have a listen to the magic that is Dal and His Orchestra</p>
  <p><a href="audio/">Visit Dal's Jukebox</a></p>
    <div style="clear: right;"></div>
	<hr />	
    <a href="videos/"><img src="/Images/multimedia/video_thumb.jpg" width="240" height="180" border="0" class="pictureFloatLeft" /></a>
  <div class="smallTextTitle">Video</div>
    <p>And still not missing a beat after 70 years on stage!</p>
    <p>Here's a few short movies of Dal and his orchestra performing.</p>
  <p><a href="videos/">Visit the Video Gallery</a></p>
    <div style="clear: left;"></div>
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
