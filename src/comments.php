<?php 

	$get_id = $_GET['post_id'];

	$get_comments = "SELECT * from comments where post_id='$post_id'";
	$run_query = mysqli_query( $connection, $get_comments );

	while ( $row = mysqli_fetch_array( $run_query ) ) {

		$comment_user_id = $row['user_id'];
		$comment = $row['comment'];
		$comment_date = $row['date'];

		// getting the user who has commented
		$user = "SELECT * from users where user_id='$comment_user_id'";

		$run_user = mysqli_query( $connection, $user );
		$row_user = mysqli_fetch_array( $run_user );
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		// now displaying the comments
		$output   = "<div class='row single-comment'>";
		$output  .= "<div class='col-sm-2'>";
		$output  .= "<div class='thumbnail'>";
		$output  .= "<img src='user/user_images/$user_image' class='img-responsive'>";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "<div class='col-sm-10'>";
		$output  .= "<div class='panel panel-default'>";
		$output  .= "<div class='panel-heading'>";
		$output  .= "<strong><a href='user_profile.php?user_id=$comment_user_id'>$user_name </a></strong>";
		$output  .= "<span>commented $comment_date</span>";
		$output  .= "</div>";
		$output  .= "<div class='panel-body'>";
		$output  .= "$comment";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "</div>";

		echo $output;		

	}

?>