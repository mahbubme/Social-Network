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
			<h2>Edit Your Profile:</h2><br>
			<form method="post" class="user-registration-form form-horizontal" enctype="multipart/form-data">
				<div class="form-group">
					<label for="u_name" class="col-sm-2">Name:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="u_name" value="<?php echo $user_name; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="u_pass" class="col-sm-2">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="u_pass" value="<?php echo $user_pass; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="u_email" class="col-sm-2">Email:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="u_email" value="<?php echo $user_email; ?>" disabled="disabled">
					</div>
				</div>
				<div class="form-group">
					<label for="u_country" class="col-sm-2">Country:</label>
					<div class="col-sm-10">
						<select name="u_country" class="form-control"  disabled="disabled">
						  <option><?php echo $user_country; ?></option>
						  <option value="Australia">Australia</option>
						  <option value="Bangladesh">Bangladesh</option>
						  <option value="United States">United States</option>
						  <option value="United Kingdom">United Kingdom</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="u_gender" class="col-sm-2">Gender:</label>
					<div class="col-sm-10">
						<select name="u_gender" class="form-control" disabled="disabled">
						  <option><?php echo $user_gender; ?></option>
						  <option value="Male">Male</option>
						  <option value="Female">Female</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="u_image" class="col-sm-2">Photo:</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="u_image" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="update" class="btn btn-default btn-success">Update</button>
					</div>
				</div>
			</form>

			<?php 

				if ( isset( $_POST['update'] ) ) {

					$name = $_POST['u_name'];
					$u_pass = $_POST['u_pass'];
					//$u_email = $_POST['u_email'];
					$u_image  = $_FILES['u_image']['name'];
					$u_image  = $user_id.$u_image;
					
					$image_tmp = $_FILES['u_image']['tmp_name'];

					move_uploaded_file( $image_tmp, "user/user_images/$u_image" );

					$update = "UPDATE users set user_name='$name',user_pass='$u_pass',user_image='$u_image' where user_id='$user_id'";
					$run = mysqli_query( $connection, $update );

					if ( $run ) {

						echo "<script>alert('Your Profile Updated!')</script>";
						echo "<script>window.open( 'home.php', '_self' )</script>";

					}

				}

			?>
		</div>


<?php 

	include( "footer.php" );

} ?>