<?php 

	session_start();
	include ( "../includes/connection.php" ); 

	if ( isset( $_SESSION['admin_email'] ) ) {
		header( "location: index.php" );
	}

	$error = '';

	if ( isset( $_POST['login'] ) ) {

		$email = mysqli_real_escape_string( $connection, $_POST['email'] );
		$password = mysqli_real_escape_string( $connection, $_POST['password'] );

		$get_admin = "SELECT * from users where user_email='$email' AND user_role='admin'";
		$run_admin = mysqli_query( $connection, $get_admin );
		$num_rows = mysqli_num_rows( $run_admin );

		if ( $num_rows == 0 ) {

			$error   .= "<div class='alert alert-warning alert-dismissible fade in' role='alert'>";
			$error  .= "Email or password is not correct, please try again.";
			$error  .= "</div>";
		
		}else {

			$_SESSION['admin_email'] = $email;
			echo "<script>window.open( 'index.php', '_self' )</script>";

		}
	
	}

?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login to Admin Panel</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/main.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="well well-lg login-form">
		  	<form method="POST" action="" class="form-horizontal">
			  <div class="form-group">
			    <label for="email">Admin Email</label>
			    <input type="email" name="email" class="form-control" placeholder="Email" required="required">
			  </div>
			  <div class="form-group">
			    <label for="password">Admin Password</label>
			    <input type="password" name="password" class="form-control" placeholder="Password" required="required">
			  </div>
			  <div class="form-group text-center">
			  	<button type="submit" name="login" class="btn btn-success">Admin Login</button>
			  </div>
			</form>
			<?php echo $error; ?>
		</div>
	</body>
</html>