<?php include('Includes/Session.php'); ?>
<?
if (isset($_SESSION['login']))
     { 
?>

<script language="JavaScript"><!--
if (document.images)
    location.replace('Admin.php');
else
    location.href = 'Admin.php';
//--></script>

<?     
     }
     else {
?>

<?php include('Includes/Header.php'); ?>
Dal Richards and his Orchestra : Administration
<?php include('Includes/Top.php'); ?>

<?php
$CurPage = "";
include('Includes/Menu.php');
?>

<?php include('Includes/Sidebar.php'); ?>

<h1 class="ContentTitle">Administration</h1>


<? 

if (strlen($_POST["password"]) > 0) {

if ($_POST["password"] == "orchestra") {
$_SESSION['login'] = "Logged In"; // store session data

?>

<script language="JavaScript"><!--
if (document.images)
    location.replace('Admin.php');
else
    location.href = 'Admin.php';
//--></script>

<?
}
else {
//bad password
?>

<form method="post" action="<? echo($PHP_SELF); ?>" style="margin: 0px 0px 0px 10px;">
<br />
<p style="font-size: 11px;"><span style="color:#ff0000;">Bad Password. </span><br />Try again.</p>

	<input type="password" name="password" style="font-size: 10px; width: 100px;">
	<input type="submit" value="Log in" style="font-size: 11px; font-family: arial;">
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
<br />
<p style="font-size: 11px;">Please log in.</p>
	<input type="password" name="password" style="font-size: 10px; width: 100px;">
	<input type="submit" value="Log in" style="font-size: 11px; font-family: arial;">
</form>

<script language="JavaScript"><!--
document.LogForm.password.focus();
//--></script>

<?

}
?>


<?php include('Includes/Footer.php'); ?>
<?php } ?>
