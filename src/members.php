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
			<h2>All Registered Users on this site:</h2>

			<div class="row">
				<?php 

					$get_members = "SELECT * from users";
					$run_members = mysqli_query( $connection, $get_members );

					while ( $row = mysqli_fetch_array( $run_members ) ) {

						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$user_image = $row['user_image'];

						$output  = "<div class='col-xs-4 col-sm-2 user-thumb'>";
						$output .= "<a href='user_profile.php?u_id=$user_id'>";
						$output .= "<img class='img-responsive' src='user/user_images/$user_image' title='$user_name'>";
						$output .= "</a>";
						$output .= "</div>";

						echo $output;

					}
				?>
			</div>
		</div>


<?php 

	include( "footer.php" );

} ?>