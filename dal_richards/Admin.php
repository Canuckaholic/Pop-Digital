<?php include('Includes/Session.php'); ?>
<?
if (isset($_SESSION['login']))

     {
     	//everything okay
     	?>

<?php include('Includes/Header.php'); ?>
Dal Richards and his Orchestra : Administration
<?php include('Includes/Top.php'); ?>
    <div id="MenuBar">
      <ul>
        <li class="First">&nbsp;</li>
        <li class="MenuLink">&nbsp;</li>
        <li class="MenuLink">&nbsp;</li>
        <li class="MenuLink">&nbsp;</li>
        <li id="EventsLink">&nbsp;</li>
        <li class="Last">&nbsp;</li>
      </ul>
    </div>
<?php include('Includes/Sidebar.php'); ?>

<a href="Logout.php" style="float: right; text-decoration: none;">(Logout)</a>
<h1 class="ContentTitle">Administration</h1>
<em>Use this section to administer the Dal Richards calendar database.</em>

<ul>
<li>Select <strong>Download</strong> to download and edit the <em>Calendar.csv</em> database file.</li>
<li>Select <strong>Upload</strong> to upload your changes and update the website.</li>
</ul>
<p class="Contentp">Questions?: <a href="mailto:kevin@jaako.com?subject=Dal Richards Calendar Help">kevin@jaako.com</a></p>



<h1 class="ContentTitle" style="margin: 40px 0px 0px 14px; font-size:12px;">&#62;</h1>
<div id="AdminButtons">
<div class="GlossyButtonLeft">
	<a class="GlossyButtonRight" href="DB/iFrameDownload.php" target="fileIFrame">
		Download
	</a>
</div>

<p class="AdminOrButton">Or</p>

<div class="GlossyButtonLeft">
	<a class="GlossyButtonRight" href="DB/iFrameUpload.php" target="fileIFrame">
		Upload
	</a>
</div>
</div>

<iframe name="fileIFrame" src="DB/Blank.html" style="width:400px;height:200px" frameborder="0">
</iframe>


<?php include('Includes/Footer.php'); ?>

<?
//No login
     } else {
?>

<script language="JavaScript"><!--
if (document.images)
    location.replace('Login.php');
else
    location.href = 'Login.php';
//--></script>
<? } ?>
