<?php include($_SERVER['DOCUMENT_ROOT']."/Includes/Session.php"); ?>
<?
if (isset($_SESSION['login']))
     {
?>

<script language="JavaScript"><!--
if (document.images)
    location.replace('/Admin/');
else
    location.href = '/Admin/';
//--></script>

<?     
     }
     else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards and his Orchestra : Login</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<div class="textBoxOne">
	<div class="largeTextTitle">Administration Login</div>    
    <? 

if (strlen($_POST["password"]) > 0) {
	if ($_POST["password"] == "orchestra") {
	$_SESSION['login'] = "Logged In"; // store session data
?>

<script language="JavaScript"><!--
if (document.images)
    location.replace('/Admin/');
else
    location.href = '/Admin/';
//--></script>
<?
}
else {
//bad password
?>

<form method="post" action="<? echo($PHP_SELF); ?>" style="margin: 0px 0px 0px 10px;">
<br />
<p><span style="color:#ff0000;">Oops! That password is incorrect. </span><br />Please try again.</p>
	<input type="password" name="password" style="font-size: 10px; width: 100px;">
	<input type="submit" value="Log in">
</form>

<script language="JavaScript"><!--
document.LogForm.password.focus();
//--></script>

<?
}
} else {
?>

<form name="LogForm" method="post" action="<? echo($PHP_SELF); ?>" style="margin: 0px 0px 0px 10px;">
<br />
<p><span style="color:#ff0000;">Please enter in your password below:</span></p>
	<input type="password" name="password" style="font-size: 10px; width: 100px;">
	<input type="submit" value="Log in" style="font-size: 11px; font-family: arial;">
</form>

<script language="JavaScript"><!--
document.LogForm.password.focus();
//--></script>

<?

}
?>
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div align="center"><img src="/Images/common/logo.gif" width="200" height="170" border="0" /></div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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
<?php } ?>
