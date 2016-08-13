<?php
	
	session_start(); 
	include ( "../includes/connection.php" );


	if ( !isset( $_SESSION['admin_email'] ) ) {
		header( "location: login.php" );
	}else {

		include( "header.php" );

		if ( isset( $_GET['edit'] ) ) {

			$user_id = $_GET['edit'];

			$sel_users = "SELECT * from users where user_id='$user_id'";
			$run_users = mysqli_query( $connection, $sel_users );

			$row_users = mysqli_fetch_array( $run_users );

			$user_id = $row_users['user_id'];
			$user_name = $row_users['user_name'];
			$user_pass = $row_users['user_pass'];
			$user_email = $row_users['user_email'];
			$user_country = $row_users['user_country'];
			$user_gender = $row_users['user_gender'];
			$user_image = $row_users['user_image'];
			$user_reg_date = $row_users['register_date'];

		}

		if ( isset( $_POST['update'] ) ) {

			$name = $_POST['u_name'];
			$u_pass = $_POST['u_pass'];
			$u_email = $_POST['u_email'];
			$u_country = $_POST['u_country'];
			$u_gender = $_POST['u_gender'];
			$u_image = $_FILES['u_image']['name'];
			$u_image = $user_id.$u_image;
			$image_tmp = $_FILES['u_image']['tmp_name'];

			move_uploaded_file( $image_tmp, "../user/user_images/$u_image" );

			$update = "UPDATE users set user_name='$name',user_pass='$u_pass',user_email='$u_email',user_country='$u_country',user_gender='$u_gender',user_image='$u_image' where user_id='$user_id'";
			$run = mysqli_query( $connection, $update );

			if ( $run ) {

				echo "<script>alert('User has been updated!')</script>";
				echo "<script>window.open( 'index.php?page=users', '_self' )</script>";

			}

		}

?>

<div class="col-sm-10">
	<br><br>	
	<form method="post" class="form-horizontal" enctype="multipart/form-data">
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
				<input type="email" class="form-control" name="u_email" value="<?php echo $user_email; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="u_country" class="col-sm-2">Country:</label>
			<div class="col-sm-10">
				<select name="u_country" class="form-control">
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
				<select name="u_gender" class="form-control">
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
</div>

<?php include( "footer.php" ); ?>
<?php } ?>