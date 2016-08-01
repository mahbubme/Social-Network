<?php 

	include ( "../includes/connection.php" );

	if ( isset( $_GET['post_id'] ) ) {

		echo $post_id = $_GET['post_id'];

		$delete_post = "DELETE from posts where post_id='$post_id'";
		$run_delete = mysqli_query( $connection, $delete_post );

		if ( $run_delete ) {

			echo "<script>alert('A post has been deleted!')</script>";
			echo "<script>window.open('../home.php','_self')</script>";

		}

	}

?>