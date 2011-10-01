<?php include($_SERVER['DOCUMENT_ROOT']."/Includes/Session.php"); ?>
<?
if (isset($_SESSION['login']))
{
//everything okay
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Administration</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
<a href="logout.php" style="float: right; text-decoration: none;">(Logout)</a>
<div class="largeTextTitle">Administration</div>
<em>Use this section to administer the Dal Richards calendar database.</em>
<br /><br />
<ul>
	<li>Select <strong>Download</strong> to download and edit the <em>Calendar.csv</em> database file.</li>
	<li>Select <strong>Upload</strong> to upload your changes and update the website.</li>
</ul>
<hr />
<div id="AdminButtons">
<div class="GlossyButtonLeft">
	<a class="GlossyButtonRight" href="/DB/iFrameDownload.php" target="fileIFrame">
		Download
	</a>
</div>
<p class="AdminOrButton">Or</p>
<div class="GlossyButtonLeft">
	<a class="GlossyButtonRight" href="/DB/iFrameUpload.php" target="fileIFrame">
		Upload
	</a>
</div>
</div>
<hr />
<iframe name="fileIFrame" src="" style="width: 400px; height: 160px" frameborder="0"></iframe>
    <p>&nbsp;</p> 
    <div align="center"><img src="/Images/common/logo.gif" width="200" height="170" border="0" /></div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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

<?
//No login
     } else {
?>
<script language="JavaScript"><!--
if (document.images)
    location.replace('/Admin/login.php');
else
    location.href = '/Admin/login.php';
//--></script>
<? } ?>
