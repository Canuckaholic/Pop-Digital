<?php include('../Includes/Session.php'); ?>
<?php include('../Includes/SessionCheck.php'); ?>

<html>

<head>	

<style>

#Wrapper {


margin: 0px 0px 0px 40px;
padding: 0px;
font-family: arial;
font-size: 10px;
}

#FormDiv {

padding: 0px 0px 0px 0px;
margin: 0px;
float: left;
}


#FormDiv a {

display: block;
position: relative;
margin-top: 5px;
padding: 18px 0px 0px 60px;
width: 140px;
height: 50px;
background: transparent url('/Images/admin/excel_icon.gif') left center no-repeat;
color: #333333;
text-decoration: none;

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

<div id="FormDiv">
Click the icon to download the calendar file:<br>
<a href="Download.php">Calendar.csv</a>	
</div>

</div>	
</body>
</html>