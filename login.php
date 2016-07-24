<?php 

	if ( isset( $_POST['login']) ) {

		$email = mysqli_real_escape_string( $connection, $_POST['email'] );
		$pass  = mysqli_real_escape_string( $connection, $_POST['pass'] );

		$get_user = "SELECT * FROM users WHERE user_email='$email' AND user_pass='$pass'";
		$run_user = mysqli_query( $connection, $get_user );
		$check = mysqli_num_rows( $run_user );

		if ( $check == 1 ) {

			$_SESSION['user_email'] = $email;
			echo "<script>window.open('home.php','_self')</script>";

		}else {

			echo "<script>alert('Password or email is not correct!')</script>";
		}

	}


?>