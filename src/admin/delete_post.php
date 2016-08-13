<?php

	include ( "../includes/connection.php" );

	if ( isset( $_GET['post_id'] ) ) {

		$post_id = $_GET['post_id'];

		$del_post = "DELETE from posts where post_id='{$post_id}'";
		$run_post = mysqli_query( $connection, $del_post );
 		
 		echo "<script>alert( 'Post has been deleted!' )</script>";
		echo "<script>window.open( 'index.php?page=posts', '_self')</script>";

	}

?>