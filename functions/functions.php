<?php 

// Connecting to the database
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "social_network";

foreach ($db as $key => $value) {
	define ( strtoupper( $key ), $value );
}

$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( "Connection was not established" );

function InsertUser() {

	global $connection;

	if ( isset( $_POST['sign_up'] ) ) {

		$name = $_POST['u_name'];
		$pass = $_POST['u_pass'];
		$email = $_POST['u_email'];
		$country = $_POST['u_country'];
		$gender = $_POST['u_gender'];
		$b_day = $_POST['u_birthday'];
		$date = date("d-m-y");
		$status = "unverified";
		$posts = "No";

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

			$insert = "INSERT INTO users(user_name,user_pass,user_email,user_country,user_gender,user_b_day,user_image,register_date,last_login,status,posts) VALUES('{$name}','{$pass}','{$email}','{$country}','{$gender}','{$b_day}','{default.jpg}','{$date}','{$date}','{$status}','{$posts}')";
			
			$run_insert = mysqli_query( $connection, $insert );

				if ( $run_insert ) {
					echo "<script>alert('Registration Successful!')</script>";
				}

		}

	}
 
}

?>