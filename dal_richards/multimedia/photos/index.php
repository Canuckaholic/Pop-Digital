<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Photo Gallery</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
	<div class="largeTextTitle">Dal's Photo Gallery</div>
    <p>Welcome to Dal's Photo Gallery! Click on an image below to see a larger picture. Use the arrows to navigate through the gallery.</p>    
  	<div id="photoGallery">
		Photo Gallery
  </div>
	<script type="text/javascript">
		var f1 = new FlashObject("/flash/photo_gallery/dal_photo_gallery.swf", "photoGallery", "444", "420", "6.0.29", "#FFFFFF");
		f1.addParam("quality", "high");	
		f1.addParam("allowScriptAccess", "always");				
   		f1.write("photoGallery");
	</script>
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
