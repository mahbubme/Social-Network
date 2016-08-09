<?php

	include ( "../includes/connection.php" );

	if ( isset( $_GET['topic_id'] ) ) {

		$topic_id = $_GET['topic_id'];

		$delete = "DELETE from topics where topic_id='{$topic_id}'";
		$run_update = mysqli_query( $connection, $delete );
 		
 		echo "<script>alert( 'Topic has been deleted!' )</script>";
		echo "<script>window.open( 'index.php?page=topics', '_self')</script>";

	}

?>