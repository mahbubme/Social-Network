<?php 
	
	session_start();
	
	include( "includes/connection.php" );
	include( "functions/functions.php" );

	if ( isset( $_SESSION['user_email'] ) ) {
		header( "location: home.php" );
	}else {
	
		include( "header_login.php" );
		include( "registration_form.php" );
		include( "footer.php" );
		include( "login.php" );

	}

?>