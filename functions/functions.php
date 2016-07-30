<?php

// function for getting topics
function getTopics() {

	global $connection;

	$get_topics = "SELECT * from topics";
	$run_topics = mysqli_query( $connection, $get_topics );

	while ( $row = mysqli_fetch_array( $run_topics ) ) {

		$topic_id = $row['topic_id'];
		$topic_title = $row['topic_title'];

		echo "<option value='$topic_id'>$topic_title</option>";

	}

}

// Inser user's post to database
function insertPost() {

	global $connection;
	global $user_id;

	if ( isset( $_POST['sub'] ) ) {

		$title 		= addslashes( $_POST['title'] );
		$content 	= addslashes( $_POST['content'] );
		$topic 		= $_POST['topic'];

		if ( $content == '' ) {

			echo "<h2>Please enter topic description.</h2>";
			exit();
			
		}else {
			
			$insert 	= "INSERT into posts(user_id,topic_id,post_title,post_content,post_date) values('$user_id','$topic','$title','$content',NOW())";

			$run 		= mysqli_query( $connection, $insert );

			if ( $run ) {

				echo "<h3>Posted to timeline, looks great.</h3>";

				$update = "UPDATE users set posts='Yes' where user_id='$user_id'";
				$run_update = mysqli_query( $connection, $update );

			}

		}

	}

}


// function for displaying posts
function get_posts() {

	global $connection;

	$per_page = 3;

	if ( isset( $_GET['page'] ) ) {
		$page = $_GET['page'];
	}else {
		$page = 1;
	}

	$start_from = ( $page - 1 ) * $per_page;
	$get_posts  = "SELECT * from posts ORDER by 1 DESC LIMIT $start_from,$per_page";
	$run_posts  = mysqli_query( $connection, $get_posts );

	while ( $row_posts = mysqli_fetch_array( $run_posts ) ) {
		
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		// getting the user who has posted the thread
		$user = "SELECT * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query( $connection, $user );
		$row_user = mysqli_fetch_array( $run_user );
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		// now displaying all at once
		$output   = "<div class='panel panel-default'>";
		$output  .= "<div class='panel-body'>";
		$output  .= "<div class='col-sm-2'>";
		$output  .= "<img src='user/user_images/$user_image' class='img-responsive'>";
		$output  .= "</div>";
		$output  .= "<div class='col-sm-10'>";
		$output  .= "<ol class='breadcrumb'>";
		$output  .= "<li><a href='user_profile.php?user_id=$user_id'>$user_name</a></li>";
		$output  .= "<li>$post_date</li>";
		$output  .= "</ol>";
		$output  .= "<h3>$post_title</h3>";
		$output  .= "<p>$content</p>";
		$output  .= "<a href='single.php?post_id=$post_id' class='btn btn-success'>See Replies or Reply to This</a>";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "</div>";

		echo $output;

	}

	include( "pagination.php" );

}

?>