<html>

<head>	
<script language="JavaScript1.2">
hex=0 // Initial color value.

function fadetext(){ 
if(hex<255) { //If color is not black yet
hex+=11; // increase color darkness
document.getElementById("Fader").style.color="rgb("+hex+","+hex+","+hex+")";
setTimeout("fadetext()",150); 
}
else
hex=255 //reset hex value
}
</script>
<style>

#Wrapper {

margin: 19px 0px 0px 82px;
padding: 0px;
font-family: arial;
font-size: 11px;

}

	
</style>

</head>

<body onload="fadetext();">

<div id="Wrapper">
	

<div id="Fader" style="width:100%"><h3 style="font-size: 10px;">File Uploaded Sucessfully.</h3></div>
</div>	
</body>
</html>