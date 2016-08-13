<?php

if ( isset( $_POST['sign_up'] ) ) {

	$name 	 = mysqli_real_escape_string( $connection, $_POST['u_name'] );
	$pass 	 = mysqli_real_escape_string( $connection, $_POST['u_pass'] );
	$email 	 = mysqli_real_escape_string( $connection, $_POST['u_email'] );
	$country = mysqli_real_escape_string( $connection, $_POST['u_country'] );
	$gender  = mysqli_real_escape_string( $connection, $_POST['u_gender'] );
	$b_day   = mysqli_real_escape_string( $connection, $_POST['u_birthday'] );
	$status  = "unverified";
	$posts   = "No";
	$verification_code = mt_rand();

	$get_email = "SELECT * from users where user_email='$email'";
	$run_email = mysqli_query( $connection, $get_email );
	$check = mysqli_num_rows( $run_email );

	if ( $check == 1 ) {

		echo "<script>alert('Email is already registered, please try another!')</script>";
		exit();

	}

	if ( strlen( $pass ) < 8 ) {

		echo "<script>alert('Password should be 8 characters!')</script>";
		exit();

	} else {

		$insert = "INSERT INTO users(user_name,user_pass,user_email,user_country,user_gender,user_b_day,user_image,register_date,last_login,status,verification_code,posts,user_role) VALUES('{$name}','{$pass}','{$email}','{$country}','{$gender}','{$b_day}','default.jpg',NOW(),NOW(),'{$status}','{$verification_code}','{$posts}','subscriber')";
		
		$run_insert = mysqli_query( $connection, $insert );

			if ( $run_insert ) {

				echo "<div class='alert alert-success'>Hi $name, registration is almost complete. We have send an email to $email, please check your inbox or spam folder.</div>";

			}else {
				echo "User was not inserted";
			}

	}

	
	$user_email = $email;

	// change the following email according to your email address. the email user will receive the new user notification.
	$admin_email = "mail@admin.com";

	include( "templates/email/user_welcome_email.php" );
	include( "templates/email/admin_email.php" );

}


?>