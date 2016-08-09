<?php

	session_start(); 
	include ( "../includes/connection.php" );
	include ( "../functions/functions.php" );


	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: ../index.php" );
	}else {

		include( "header.php" );

		if ( isset( $_GET['post_id'] ) ) {

			$post_id = $_GET['post_id'];

			$query = "SELECT * from posts where post_id='$post_id'";
			$run_query = mysqli_query( $connection, $query );
			$row = mysqli_fetch_array( $run_query );

			$topic_id = $row['topic_id'];
			$post_title = $row['post_title'];
			$post_content = $row['post_content'];

			// getting category name of the current post
			$topic_query = "SELECT * from topics where topic_id='$topic_id'";
			$run_topic_query = mysqli_query( $connection, $topic_query );
			$row_topic = mysqli_fetch_array( $run_topic_query );

			$cat_name = $row_topic['topic_title']; 

		}

		if ( isset( $_POST['update'] ) ) {

			$title = $_POST['post_title'];
			$content = $_POST['post_content'];
			$topic_id = $_POST['topic'];

			$update_post = "UPDATE posts set post_title='$title', post_content='$content', topic_id='$topic_id', post_date=NOW() where post_id='$post_id'";
			$run_update = mysqli_query( $connection, $update_post );

			if ( $run_update ) {

				echo "<script>alert('Post has been updated!')</script>";
				echo "<script>window.open( 'index.php?page=posts', '_self')</script>";

			}

		}
?>

<div class="col-sm-10">
	<br><br>	
	<form action="" method="post" class="form-horizontal">
		<div class="form-group">
			<label for="post_title" class="col-sm-2">Title:</label>
			<div class="col-sm-10">
				<input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="post_content" class="col-sm-2">Description:</label>
			<div class="col-sm-10">
				<textarea name="post_content" class="form-control" rows="20"><?php echo $post_content; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="topic" class="col-sm-2">Category:</label>
			<div class="col-sm-10">
				<select name="topic" class="form-control">
					<option value="<?php echo $topic_id; ?>"><?php echo $cat_name; ?></option>
					<?php getTopics(); ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="submit" name="update" class="btn btn-success pull-right" value="Update Post">
			</div>
		</div>
	</form>
</div>

<?php include( "footer.php" ); ?>

<?php } ?>