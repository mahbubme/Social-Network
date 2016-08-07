<?php

	include ( "../includes/connection.php" );

	if ( isset( $_GET['delete'] ) ) {

		$user_id = $_GET['delete'];

		$delete = "DELETE from users where user_id='{$user_id}'";
		$run_update = mysqli_query( $connection, $delete );

		$del_posts = "DELETE from posts where user_id='{$user_id}'";
		$run_posts = mysqli_query( $connection, $del_posts );
 		
 		echo "<script>alert( 'User has been deleted!' )</script>";
		echo "<script>window.open( 'index.php?page=users', '_self')</script>";

	}

?>