<?php

	session_start(); 
	include ( "../includes/connection.php" );

	if ( !isset( $_SESSION['admin_email'] ) ) {
		header( "location: login.php" );
	}else {

		include( "header.php" );

		if ( isset( $_GET['topic_id'] ) ) {

			$topic_id = $_GET['topic_id'];

			$sel_topic = "SELECT * from topics where topic_id='$topic_id'";
			$run_topic = mysqli_query( $connection, $sel_topic );

			$row_topic = mysqli_fetch_array( $run_topic );

			$topic = $row_topic['topic_title'];

		}

		if ( isset( $_POST['update'] ) ) {

			$topic = $_POST['topic'];

			$update_topic = "UPDATE topics set topic_title='$topic' where topic_id='$topic_id'";
			$run_update = mysqli_query( $connection, $update_topic );

			if ( $run_update ) {

				echo "<script>alert('Topic has been updated!')</script>";
				echo "<script>window.open( 'index.php?page=topics', '_self')</script>";

			}

		}
?>

<div class="col-sm-10">
	<br><br>	
	<form action="" method="post" class="form-horizontal">
		<div class="form-group">
			<label for="topic" class="col-sm-2">Topic Title:</label>
			<div class="col-sm-10">
				<input type="text" name="topic" class="form-control" value="<?php echo $topic; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="submit" name="update" class="btn btn-success pull-right" value="Update Topic">
			</div>
		</div>
	</form>
</div>

<?php include( "footer.php" ); ?>

<?php } ?>