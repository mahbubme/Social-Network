<?php 
	
	$to = $user_email;
	$subject = "Verify your email address";
	$message = "
	<html>
		Hello <strong>$name</strong>. You have just created an account, please verify your email address by clicking below link:
		<br>
		http://site.com/verify.php?code=$verification_code
		<br>
		Or,
		<br>
		<a href='http://site.com/verify.php?code=$verification_code'>Click to Verify Your Email</a><br>
		<strong>Thank you for creating an account!</strong>
	</html>
	";

	$headers  = "MIME-VERSION: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <$admin_email>" . "\r\n"; 

	mail( $to, $subject, $message, $headers );

?>