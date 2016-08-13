<?php 

	session_start(); 
	include ( "includes/connection.php" );
	include ( "functions/functions.php" );

	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: index.php" );
	}else {

		include ( "header.php" );
		include ( "user_sidebar.php" );
?>
		<div class="col-sm-9">
			<?php 

				if ( isset( $_GET['u_id'] ) ) {

					$u_id = $_GET['u_id'];

					$query = "SELECT * from users where user_id='$u_id'";
					$run = mysqli_query( $connection, $query );
					$row = mysqli_fetch_array( $run );

					$user_name = $row['user_name'];
					$user_image = $row['user_image'];
					$reg_date = $row['register_date'];
				
				}

			?>

			<h2>Send a message to <?php echo $user_name; ?></h2>

			<form action="messages.php?u_id=<?php echo $u_id; ?>" method="POST" class="form-horizontal">
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" name="msg_title" class="form-control" placeholder="Message Subject..." required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<textarea name="msg" class="form-control" cols="30" rows="10" placeholder="Message Topic" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="submit" name="message" class="btn btn-success pull-right" value="Send Messae">
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-sm-2">
					<img src="user/user_images/<?php echo $user_image; ?>" class="img-responsive">
				</div>
			</div>
			<div class="alert alert-success" role="alert"><?php echo $user_name; ?> is member of this site since: <?php echo $reg_date; ?></div>

			<?php 

				if ( isset( $_POST['message'] ) ) {

					$msg_title = $_POST['msg_title'];
					$msg = $_POST['msg'];

					$insert = "INSERT into messages(sender,receiver,msg_sub,msg_topic,reply,status,msg_type,msg_date) values('$user_id','$u_id','$msg_title','$msg','no_reply','unread','parent',NOW())";

					$run_insert = mysqli_query( $connection, $insert );

					if ( $run_insert ) {

						echo "<h2>Message was sent to $user_name successfully</h2>";

					}else {
						echo "<h2>Message was not sent to $user_name successfully</h2>";									
					}

				}
			?>
		</div>


<?php 

	include( "footer.php" );

} ?>