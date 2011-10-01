<?php include('Includes/Header.php'); ?>
Dal Richards and his Orchestra : Calendar
<?php include('Includes/Top.php'); ?>
<?php
$CurPage = "Calendar";
include('Includes/Menu.php');
?>

<?php include('Includes/Sidebar.php'); ?>

        <h3 class="ContentTitle">Dal's Calendar</h3>
<p class="ContentP">Here is Dal's schedule for the new few months. <br />
New event information is added regularly; so check back often.</p>

<div id="CalendarEvents" style="display: block; margin-left: 5px;">
<?php 
$OutputFormat = "Full";
include('DB/FileRead.php'); 

?>
</div>
<?php include('Includes/Footer.php'); ?>