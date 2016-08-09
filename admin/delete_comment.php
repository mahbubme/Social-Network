<?php

	include ( "../includes/connection.php" );

	if ( isset( $_GET['comment_id'] ) ) {

		$comment_id = $_GET['comment_id'];

		$del_comment = "DELETE from comments where comment_id='{$comment_id}'";
		$run_query = mysqli_query( $connection, $del_comment );
 		
 		echo "<script>alert( 'Comment has been deleted!' )</script>";
		echo "<script>window.open( 'index.php?page=comments', '_self')</script>";

	}

?>