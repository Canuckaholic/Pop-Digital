<?php include('../Includes/Session.php'); ?>
<?php include('../Includes/SessionCheck.php'); ?>

<?php
$targetdir = "../DB/";
$target = $targetdir . "Calendar.csv" ;
$targettemp = $targetdir . basename( $_FILES['uploaded']['tmp_name']) ;

$uploaded_type = $_FILES['uploaded']['type'];
$uploaded_size = $_FILES['uploaded']['size'];

$ok=1;

//This is our size condition
if ($uploaded_size > 350000)
{
echo "<p style='font-family:verdana; font-size: 10px; color: #666;'>Your file is too large.<br>";
$ok=0;
}

//This is our limit file type condition
if (!($uploaded_type == "text/plain") && !($uploaded_type == "application/octet-stream") && !($uploaded_type == "application/vnd.ms-excel"))
{
echo "<p style='font-family:verdana; font-size: 10px; color: #777;'>[<span style='color: #333;'>" . $uploaded_type . "</span>] is not a valid file.<br>\n";
echo "Only CSV files allowed.<br />";
$ok=0;
}

//Here we check that $ok was not set to 0 by an error
if ($ok==0)
{
Echo "<span style='color: #f00;'><br />Sorry your file was not uploaded!</span></p>";
}

//If everything is ok we try to upload it
else
{
if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $targettemp))
{

rename($targettemp, $target);


include("iFrameUploaded.php");

}
else
{
echo "Sorry, there was a problem uploading your file.";
}
}
?>