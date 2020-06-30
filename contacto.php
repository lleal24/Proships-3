<?php $data = array(); // array to pass back data
	  $errors = array(); // array to hold validation errors

	if(empty($_POST['name'])){
		$errors['name'] = 'Name is required.';
	}elseif (empty($_POST['email'])){
		$errors['email'] = 'Email is required.';
	}elseif (empty($_POST['phone'])){
		$errors['phone'] = 'Phone number is required.';
	}elseif (empty($_POST['subject'])){
		$errors['subject'] = 'Subject is required.';
	}else{

		$data['success'] = true;
		
		$data['messageSuccess'] = 'Oye! Gracias por contactarnos. Me pondré en contacto con usted pronto';
		
		// CHANGE THE TWO LINES BELOW
		
		$email_to = "alex.espinosa@auropaq.com";
		
		$email_subject = $_POST['subject']; // required
		
		$email_from = $_POST['email'];
		
		// Form Message Begin
		
		$email_message = "<table border='0' cellpadding='2' cellspacing='2' width='600'>
		<tr><td>Request a Quote details are below:</td></tr>
		<tr><td>Name: ".$_POST['name']." </td></tr>
		<tr><td>Phone: ".$_POST['phone']." </td></tr>
		<tr><td>Email: ".$_POST['email']."</td></tr>
		<tr><td>City: ".$_POST['city']."</td></tr>
		<tr><td>Service: ".$_POST['service']."</td></tr>
		<tr><td>Message: ".$_POST['message']."</td></tr>
		</table>";	
		$cc = "comercioexterior@tranexco.net";
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'Reply-To: '.$_POST['email']."\r\n";
		$headers .= 'From: '.$_POST['email'] . "\r\n";
		$headers .= 'Cc: '.$cc . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
	
		@mail($email_to, $email_subject, $email_message, $headers);
	}
	
		if (! empty($errors)) {
		
			$data['success'] = false;
			
			$data['errors'] = $errors;
			
			$data['messageError'] = '*Nota: compruebe los campos en rojo';
		
		} 

		echo json_encode($data);
?>
