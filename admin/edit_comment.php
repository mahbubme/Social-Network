<?php

	session_start(); 
	include ( "../includes/connection.php" );
	include ( "../functions/functions.php" );


	if ( !isset( $_SESSION['admin_email'] ) ) {
		header( "location: login.php" );
	}else {

		include( "header.php" );

		if ( isset( $_GET['comment_id'] ) ) {

			$comment_id = $_GET['comment_id'];

			$sel_comment = "SELECT * from comments where comment_id='$comment_id'";
			$run_comment = mysqli_query( $connection, $sel_comment );

			$row_comment = mysqli_fetch_array( $run_comment );

			$comment_id = $row_comment['comment_id'];
			$user_id = $row_comment['user_id'];
			$comment = $row_comment['comment'];
			$date = $row_comment['date'];

		}

		if ( isset( $_POST['update'] ) ) {

			$comment = $_POST['comment'];

			$update_comment = "UPDATE comments set comment='$comment', date=NOW() where comment_id='$comment_id'";
			$run_update = mysqli_query( $connection, $update_comment );

			if ( $run_update ) {

				echo "<script>alert('Comment has been updated!')</script>";
				echo "<script>window.open( 'index.php?page=comments', '_self')</script>";

			}

		}
?>

<div class="col-sm-10">
	<br><br>	
	<form action="" method="post" class="form-horizontal">
		<div class="form-group">
			<label for="comment" class="col-sm-2">Comment:</label>
			<div class="col-sm-10">
				<textarea name="comment" class="form-control" rows="10"><?php echo $comment; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="submit" name="update" class="btn btn-success pull-right" value="Update Comment">
			</div>
		</div>
	</form>
</div>

<?php include( "footer.php" ); ?>

<?php } ?>