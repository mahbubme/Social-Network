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

// function for displaying single post
function single_post() {

	global $connection;

	if ( isset( $_GET['post_id'] ) ) {

		$get_id = $_GET['post_id'];

		$get_posts  = "SELECT * from posts where post_id='$get_id'";
		$run_posts  = mysqli_query( $connection, $get_posts );

		$row_posts = mysqli_fetch_array( $run_posts );
			
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

		// now displaying the post
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
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "</div>";

		echo $output;
		
		if ( isset( $_POST['reply'] ) ) {

			$comment = $_POST['comment'];
			$user_email = $_SESSION['user_email'];

			$current_user = "SELECT * from users where user_email='$user_email'";
			$run_current_user = mysqli_query( $connection, $current_user );
			$current_user_row = mysqli_fetch_array( $run_current_user );
			$current_user_id = $current_user_row['user_id'];

			$insert = "INSERT into comments (post_id, user_id,comment,date) values('$post_id','$current_user_id','$comment',NOW())";
			$run = mysqli_query( $connection, $insert );

			echo "<h2>Your reply was added!</h2>";
		}
		
		include( "comments.php" );
		
		$output   = "<form action='' method='post' class='form-horizontal'>";
		$output  .= "<div class='form-group'>";
		$output  .= "<div class='col-sm-12'>";
		$output  .= "<textarea name='comment' class='form-control' cols='30' rows='10' placeholder='Write your reply...' required></textarea>";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "<div class='form-group'>";
		$output  .= "<div class='col-sm-12'>";
		$output  .= "<input type='submit' name='reply' class='btn btn-success pull-right' value='Reply to This'>";
		$output  .= "</div>";
		$output  .= "</div>";
		$output  .= "</form>";						

		echo $output;

	}

}


// function for getting the posts based on category
function get_cats() {

	global $connection;

	$per_page = 3;

	if ( isset( $_GET['page'] ) ) {
		$page = $_GET['page'];
	}else {
		$page = 1;
	}

	$start_from = ( $page - 1 ) * $per_page;

	if ( isset( $_GET['topic'] ) ) {
		$topic_id = $_GET['topic'];
	}

	$get_posts  = "SELECT * from posts where topic_id='$topic_id' ORDER by 1 DESC";
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

}


?>