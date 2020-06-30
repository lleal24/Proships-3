<?php 
	$errors = array(); // array to hold validation errors

	$data = array(); // array to pass back data

	// validate the variables ======================================================

	if (empty($_POST['name']))
		$errors['name'] = 'Name is required.';

	elseif (empty($_POST['email']))
		$errors['email'] = 'Email is required.';
	
	elseif (empty($_POST['subject']))
		$errors['subject'] = 'Subject is required.';
	
/*	elseif (empty($_POST['message']))
		$errors['message'] = 'Message is required.'; */
		
	else {
		
	// if there are no errors, return a message
	
		$data['success'] = true;
		
		$data['messageSuccess'] = 'Hey! Thanks for reaching out. I will get back to you soon';
		
		// CHANGE THE TWO LINES BELOW
		
		$email_to = "shyam.sunder@sparxtechnologies.com";
		
		$email_subject = $_POST['subject']; // required
	
		$name = $_POST['name']; // required
		
		$email_from = $_POST['email']; // required
		
		$cc = "shyam.sunder@sparxtechnologies.com";
		
		$message = $_POST['message']; // required
		
		// Form Message begin
		
		$email_message = "<table border='0' cellpadding='2' cellspacing='2' width='600'>
		<tr><td>Form details below:</td></tr>
		<tr><td>Name: ".$name." </td></tr>
		<tr><td>Email: ".$email_from."</td></tr>
		<tr><td>Message: ".$message."</td></tr>
		</table>";		

/*		$email_message = "Form details below.\n\n";
		
		$email_message .= "Name: ".$name."\n";
		
		$email_message .= "Email: ".$email_from."\n";
		
		$email_message .= "Message: ".$message."\n";	
 
		$headers = 'From: '.$email_from."\r\n".
		
		'Reply-To: '.$email_from."\r\n" .
		
		'X-Mailer: PHP/' . phpversion(). 
		
		"CC: sandeep.sharma@sparxitsolutions.com"; */
		
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'Reply-To: '.$email_from."\r\n";
$headers .= 'From: '.$email_from . "\r\n";
$headers .= 'Cc: '.$cc . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

		
	// Send Mail
		
		@mail($email_to, $email_subject, $email_message, $headers);
	}
	
	// return a response ===========================================================
	// response if there are errors
	
	if (! empty($errors)) {
		
		// if there are items in our errors array, return those errors
		
		$data['success'] = false;
		
		$data['errors'] = $errors;
		
		$data['messageError'] = '*Note: Please check the fields in red';
		
	} 
	// return all our data to an AJAX call
	echo json_encode($data);
?>
