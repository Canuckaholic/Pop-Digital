<?php include('../Includes/Session.php'); ?>
<?php include('../Includes/SessionCheck.php'); ?>

<html>

<head>	

<script type="text/javascript">
<!--
if (document.images) {

	//Preload images for rollovers
	pic1= new Image(); 
  pic1.src="../Images/Spinner.gif"; 

  
}

function DoSpin() {

document.getElementById("LoadIcon").style.width = 16;
document.getElementById("LoadIcon").style.height = 16;
document.getElementById("LoadIcon").style.padding = 9;
document.getElementById("LoadIcon").src = "../Images/Spinner.gif";
}

//-->
</script>


<style>

#Wrapper {


margin: 0px 0px 0px 40px;
padding: 0px;
font-family: arial;
font-size: 10px;
}

#FormDiv {

padding: 10px 0px 0px 4px;
margin: 0px;
float: left;
}

.FileUP {

font-size: 10px;
font-family: arial;
width: 200px;
background: #e9e9e9;
}

	
</style>

</head>

<body>

<div id="Wrapper">

<img id="LoadIcon" src="/Images/admin/excel_icon.gif" height="34" width="34" style="float: left;">

<div id="FormDiv">
	
<form enctype="multipart/form-data" onSubmit="javascript:DoSpin();" action="Upload.php" method="POST">
	Select the file to upload and press <em>Transfer</em>.<br /><br />
	<input class="FileUP" type="file" name="uploaded"><br /><br /><input type="submit" value="Transfer" style="font-family: arial; font-size: 12px;">
</form>
</div>

</div>	
</body>
</html>