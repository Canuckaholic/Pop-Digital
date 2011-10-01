<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Register - Tactical Actions Group Inc.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include($DOCUMENT_ROOT . "/common/keywords.php"); ?>
<?php include($DOCUMENT_ROOT . "/common/js.php"); ?>
<?php include($DOCUMENT_ROOT . "/common/styles.php"); ?>
</head>

<body>
<div class="registrationForm">
<?php
   if ($_SERVER['REQUEST_METHOD'] != 'POST'){
      $me = $_SERVER['PHP_SELF'];
?>
<form name="form1" enctype="multipart/form-data" method="post" action="<?php echo $me;?>">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
      <table width="525" border="0" cellspacing="0" cellpadding="3">
         <tr>
            <td>First Name:</td>
            <td><input name="firstName" type="text" size="25" maxlength="100"></td>
			<td>Last Name:</td>
            <td><input name="lastName" type="text" size="25" maxlength="100"></td>						
         </tr>
         <tr>
            <td>Unit #:</td>
            <td><input name="unitNumber" type="text" size="25" maxlength="100"></td>
			<td>Address:</td>
            <td><input name="address" type="text" size="25" maxlength="100"></td>
		 </tr>
		 <tr>
			<td>City:</td>
            <td><input name="city" type="text" size="25" maxlength="100"></td>
			<td>Postal Code:</td>
            <td><input name="postalCode" type="text" size="25" maxlength="100"></td>
         </tr>
		 <tr>
            <td>Home Phone:</td>
            <td><input name="homePhone" type="text" size="25" maxlength="100"></td>
			<td>Cell Phone:</td>
            <td><input name="cellPhone" type="text" size="25" maxlength="100"></td>			
         </tr>
		 <tr>
			<td>Email:</td>
           <td colspan="2" align="left"><input name="email" type="text" size="35" maxlength="100"></td>
			<td>&nbsp;</td>			
		 </tr>
		 <tr>
		 	<td colspan="4"><hr /></td>
		 </tr>
		 <tr>
            <td>Height:</td>
            <td><input name="height" type="text" size="25" maxlength="100"></td>
			<td>Weight:</td>
            <td><input name="weight" type="text" size="25" maxlength="100"></td>			
		 </tr>
		 <tr>
            <td>Hair Colour:</td>
            <td><input name="hairColour" type="text" size="25" maxlength="100"></td>
			<td>Eye Colour:</td>
            <td><input name="eyeColour" type="text" size="25" maxlength="100"></td>			
		 </tr>
		 <tr>
            <td>Age:</td>
            <td><input name="age" type="text" size="25" maxlength="100"></td>
			<td>Birthdate (DD/MM/YYYY):</td>
            <td><input name="birthdate" type="text" size="25" maxlength="100"></td>			
		 </tr>
		 <tr>
            <td>Gender:</td>
            <td><input name="gender" type="text" size="25" maxlength="100"></td>
			<td>Ethnicity:</td>
            <td><input name="ethnicity" type="text" size="25" maxlength="100"></td>			
		 </tr>
		 <tr>
		 	<td colspan="4"><hr /></td>
		 </tr>
	  </table>
	  <table width="525" border="0" cellspacing="0" cellpadding="3">		 
		 <tr>
            <td>Shirt Size:</td>
            <td><input name="shirtSize" type="text" size="8" maxlength="100"></td>
			<td>Waist Size:</td>
            <td><input name="waist" type="text" size="8" maxlength="100"></td>
			<td>Dress Size (women):</td>
            <td><input name="dressSize" type="text" size="8" maxlength="100"></td>
		 </tr>
		 <tr>
            <td>Collar Size:</td>
            <td><input name="collarSize" type="text" size="8" maxlength="100"></td>
			<td>Inseam:</td>
            <td><input name="inseam" type="text" size="8" maxlength="100"></td>
			<td>Hips (women):</td>
            <td><input name="hips" type="text" size="8" maxlength="100"></td>
		 </tr>
		 <tr>
		 	<td>Sleeve Length:</td>
            <td><input name="sleeveLength" type="text" size="8" maxlength="100"></td>
            <td>Shoe Size<br>(Add 1/2 Size):</td>
            <td><input name="shoeSize" type="text" size="8" maxlength="100"></td>
			<td>Bust (women):</td>
            <td><input name="inseam" type="text" size="8" maxlength="100"></td>			
		 </tr>
		 <tr>		 	
		 	<td>Jacket Size:</td>
            <td><input name="jacketSize" type="text" size="8" maxlength="100"></td>  
            <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>			
			<td>&nbsp;</td>	
		 </tr>
		 <tr>
		 	<td colspan="6"><hr /></td>
		 </tr>
	  </table>
	  <table width="525" border="0" cellspacing="0" cellpadding="3">
		  <tr>
			<td align="left">Which of the Following Skills / Employment May Apply to You?</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Briefly List Some of Your Skills (eg. guitar, skateboarding, horseback riding, etc):</td>
		  </tr>		  
		  <tr>
			<td align="left"><input type="checkbox" name="firearms" value="firearms"> Firearms<br>
			<input type="checkbox" name="martialArts" value="martialArts"> Martial Arts<br>
			<input type="checkbox" name="police" value="police"> Police<br>
			<input type="checkbox" name="military" value="military"> Military<br>
			<input type="checkbox" name="fireman" value="fireman"> Fireman/Firewoman<br>
			<input type="checkbox" name="paramedics" value="paramedics"> Paramedics</td>
			<td>&nbsp;</td>
			<td align="left" valign="top"><textarea name="skills" cols="30" rows="6"></textarea></td>
		  </tr>
    </table>
	<p>&nbsp;</p>
	<div align="center">Attach a Picture of Yourself:<br><input name="attachment" type="file" size="40">
	<p>&nbsp;</p>	
    <input type="submit" name="Submit" value="Submit"></div>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<?php
   } else {
      error_reporting(0);
	  $errors = array();
	  // Test to see if the form was actually posted from our webpage
      // In testing, if you get an Inavlid referer error comment out or remove the next three lines
      $page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
      if (!ereg($page, $_SERVER['HTTP_REFERER'])) {
         $errors[] = "Invalid referer";
	  }
	  // Check for required form fields
	  if (!$_POST['email']) { 
		$errors[] = "<p>Email address is required.</p>"; 
	  }
	  if (!$_POST['firstName']) { 
		$errors[] = "<p>First Name is required.</p>"; 
	  }
	  if (!$_POST['lastName']) { 
		$errors[] = "<p>Last Name is required.</p>"; 
	  }
	  if (!$_POST['address']) { 
		$errors[] = "<p>Address is required.</p>"; 
	  }
	  if (!$_POST['homePhone'] && !$_POST['cellPhone']) {	  
		$errors[] = "<p>A phone number is required.</p>"; 
	  }	  
	  
	  if (count($errors)>0){
      	echo "<br><br><div align='center'><h4>Missing Information:</h4><br><strong>";
      	foreach($errors as $err)
       		echo "$err<br>";
		echo "<br><a href='javascript:history.back();'><strong>Go Back...</strong></a></div>";
		echo "<img src='/images/common/transparent.gif' width='5' height='400' border='0'>";
  	  } else {	       
		$from_name = stripslashes($_POST['firstName']).' '.stripslashes($_POST['lastName']);	
		$recipient = 'bnaipaul@telus.net';
		$subject = 'TAG Registration Form Submission';		      
		$attachment = $_FILES['attachment']['tmp_name']; 
		$attachment_name = $_FILES['attachment']['name']; 
		$type = $_FILES['attachment']['type'];
  		$size = $_FILES['attachment']['size'];
		$firearms=($_POST['firearms'])?"Firearms: Yes":"Firearms: No";
		$martialArts=($_POST['martialArts'])?"Martial Arts: Yes":"Martial Arts: No";
		$police=($_POST['police'])?"Police: Yes":"Police: No";
		$military=($_POST['military'])?"Military: Yes":"Military: No";
		$fireman=($_POST['fireman'])?"Fireman: Yes":"Fireman: No";
		$paramedics=($_POST['paramedics'])?"Paramedics: Yes":"Paramedics: No";

		if (file_exists($attachment)){
			if (is_uploaded_file($attachment)) { //Do we have a file uploaded? 
			  $fp = fopen($attachment, 'rb'); //Open it 
			  $data = fread($fp, filesize($attachment)); //Read it 		  
			  fclose($fp);
			  $data = chunk_split(base64_encode($data)); //Chunk it up and encode it as base64 so it can be emailed 
			}
		}		
		
		// Headers
		$headers = "From: $from_name<" . $_POST['email'] . ">\n"; 
		$headers .= "Reply-To: <" . $_POST['email'] . ">\n";  
		$headers .= "MIME-Version: 1.0\n"; 
		$headers .= "Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"----=MIME_BOUNDRY_main_message\"\n";  
		$headers .= "X-Sender: $from_name<" . $_POST['email'] . ">\n"; 
		$headers .= "X-Mailer: PHP4\n"; 
		$headers .= "X-Priority: 3\n"; //1 = Urgent, 3 = Normal 
		$headers .= "Return-Path: <" . $_POST['email'] . ">\n";  
		$headers .= "This is a multi-part message in MIME format.\n"; 
		$headers .= "------=MIME_BOUNDRY_main_message \n";  
		$headers .= "Content-Type: multipart/alternative; boundary=\"----=MIME_BOUNDRY_message_parts\"\n";  
		
		$body = "<strong>Name:</strong> ".stripslashes($_POST['firstName'])." ".stripslashes($_POST['lastName'])."<br>".
				"<strong>Address:</strong> ";
		if ($_POST['unitNumber']) {
		$body .= "#".stripslashes($_POST['unitNumber'])." - ";
		}
		$body .= stripslashes($_POST['address']).", ".stripslashes($_POST['city']).", ".stripslashes($_POST['postalCode'])."<br>".
				"<strong>Home Phone:</strong> ".stripslashes($_POST['homePhone'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Cell Phone:</strong> ".stripslashes($_POST['cellPhone'])."<br>".
				"<strong>Email:</strong> ".stripslashes($_POST['email'])."<hr>".
				"<strong>Height:</strong> ".stripslashes($_POST['height'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Weight:</strong> ".stripslashes($_POST['weight'])."<br>".
				"<strong>Hair Colour:</strong> ".stripslashes($_POST['hairColour'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Eye Colour:</strong> ".stripslashes($_POST['eyeColour'])."<br>".
				"<strong>Age:</strong> ".stripslashes($_POST['age'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Birthdate:</strong> ".stripslashes($_POST['birthdate'])."<br>".
				"<strong>Gender:</strong> ".stripslashes($_POST['gender'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Ethnicity:</strong> ".stripslashes($_POST['ethnicity'])."<hr>";
	    $body .= "<strong>Shirt Size:</strong> ".stripslashes($_POST['shirtSize'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Collar Size:</strong> ".stripslashes($_POST['collarSize'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sleeve Length:</strong> ".stripslashes($_POST['sleeveLength'])."<br>".
				"<strong>Jacket Size:</strong> ".stripslashes($_POST['jacketSize'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Dress Size:</strong> ".stripslashes($_POST['dressSize'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hips:</strong> ".stripslashes($_POST['hips'])."<br>".
				"<strong>Bust:</strong> ".stripslashes($_POST['bust'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Waist Size:</strong> ".stripslashes($_POST['waist'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Inseam:</strong> ".stripslashes($_POST['inseam'])."<br>".
				"<strong>Shoe Size:</strong> ".stripslashes($_POST['shoeSize'])."<hr>".
				"$firearms<br>$martialArts<br>$police<br>$military<br>$fireman<br>$paramedics<br><br>".
				"<strong>Skills:</strong><br>".stripslashes($_POST['skills'])."<hr>";
		// Message
		$message = "------=MIME_BOUNDRY_message_parts\n"; 
		$message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";  
		$message .= "Content-Transfer-Encoding: quoted-printable\n";  
		$message .= "\n";
		$message .= "$body\n"; 
		$message .= "\n";  
		$message .= "------=MIME_BOUNDRY_message_parts--\n";  
		$message .= "\n";
		if (file_exists($attachment)){
		$message .= "------=MIME_BOUNDRY_main_message\n";  
		$message .= "Content-Type: application/octet-stream;\n\tname=\"" . $attachment_name . "\"\n"; 
		$message .= "Content-Transfer-Encoding: base64\n"; 
		$message .= "Content-Disposition: attachment;\n\tfilename=\"" . $attachment_name . "\"\n\n"; 
		$message .= $data; //The base64 encoded message 
		$message .= "\n";  
		$message .= "------=MIME_BOUNDRY_main_message--\n";
		}
	
		// send the message
		if (mail($recipient, $subject, $message, $headers)) {
			 echo nl2br("<div align='center'><p>&nbsp;</p><h3>Message Sent:<br><br>
			 To: T.A.G. Registration</h3></div><br>
			 <img src='/images/common/transparent.gif' width='5' height='450' border='0'>
			 ");
		 }
		 else
			 echo "<br><br>Message failed to send. Please check your form information and try again.<br><br><a href='javascript:history.back();'><strong>Go Back...</strong></a>";    
	}
}
?>
</div>
</body>
</html>
