<?php 
	
	$query = "SELECT * from users where user_email='$email'";
	$query_run = mysqli_query( $connection, $query );
	$user_row = mysqli_fetch_array( $query_run );

	$new_user_id = $user_row['user_id'];

	$to = $admin_email;
	$subject = "New user registered on your site.";
	$message = "
	<html>
		Hello <strong>Admin</strong>. A new user has been registered on your site. Check the user profile by clicking below link:
		<br>
		http://site.com/user_profile.php?u_id=$new_user_id
		<br>
		Or,
		<br>
		<a href='http://site.com/user_profile.php?u_id=$new_user_id'>View the User</a><br>
	</html>
	";

	$headers  = "MIME-VERSION: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <$admin_email>" . "\r\n"; 

	mail( $to, $subject, $message, $headers );

?>