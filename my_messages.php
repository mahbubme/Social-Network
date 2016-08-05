<?php 

	session_start(); 
	include ( "includes/connection.php" );
	include ( "functions/functions.php" );

	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: index.php" );
	}else {

?>

<!DOCTYPE html>

<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome User</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/main.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<header id="header">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="row">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Social Network</a>
						</div>
				
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<form method="get" action="results.php" id="form1" class="navbar-form navbar-right" role="search">
						        <div class="form-group">
						          <input type="text" name="user_query" class="form-control" placeholder="Search a topic">
						        </div>
						        <input type="submit" name="search" class="btn btn-default" value="Search">
						    </form>

							<ul class="nav navbar-nav navbar-right">
					        	<li><a href="home.php">Home</a></li>
					        	<li><a href="members.php">Members</a></li>
					        	<li class="dropdown">
					        		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Topics <span class="caret"></span></a>
					        		<ul class="dropdown-menu">
										<?php 

											$get_topics = "SELECT * from topics";
											$run_topics = mysqli_query( $connection, $get_topics );

											while ( $row = mysqli_fetch_array( $run_topics ) ) {

												$topic_id = $row['topic_id'];
												$topic_title = $row['topic_title'];

					            				echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";

											}

										?>										
					        		</ul>
					        	</li>
					     	</ul>
						</div><!-- /.navbar-collapse -->
					</div>
				</div>
			</nav>
		</header>

		<section id="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<?php 

							$user 		= $_SESSION['user_email'];
							$get_user   = "SELECT * from users where user_email='$user'";
							$run_user   = mysqli_query( $connection, $get_user );
							$row 		= mysqli_fetch_array( $run_user );

							$user_id 	    = $row['user_id'];
							$user_name 		= $row['user_name'];
							$user_country 	= $row['user_country'];
							$user_image 	= $row['user_image'];
							$register_date  = $row['register_date'];
							$last_login 	= $row['last_login'];

							$user_posts = "SELECT  * from posts where user_id='$user_id'";
							$run_posts = mysqli_query( $connection, $user_posts );
							$posts = mysqli_num_rows( $run_posts );

							// getting the number of unread messages
							$sel_msg = "SELECT * from messages where receiver='$user_id' AND status='unread' order by 1 DESC";
							$run_msg = mysqli_query( $connection, $sel_msg );

							$count_msg = mysqli_num_rows( $run_msg );

						?>

						<img src="user/user_images/<?php echo $user_image; ?>" class="img-responsive" alt="">
						<ul class="list-group">
							<li class="list-group-item">Name: <?php echo $user_name; ?></li>
							<li class="list-group-item">Country: <?php echo $user_country; ?></li>
							<li class="list-group-item">Last Login: <?php echo $last_login; ?></li>
							<li class="list-group-item">Member Since: <?php echo $register_date; ?></li>
							<li class="list-group-item"><a href="my_messages.php?inbox&u_id=<?php echo $user_id; ?>">Messages (<?php echo $count_msg; ?>)</a></li>
							<li class="list-group-item"><a href="my_posts.php?u_id=<?php echo $user_id; ?>">My Posts (<?php echo $posts; ?>)</a></li>
							<li class="list-group-item"><a href="edit_profile.php?u_id=<?php echo $user_id; ?>">Edit My Account</a></li>
							<li class="list-group-item"><a href="logout.php">Logout</a></li>
						</ul>

					</div>
					<div class="col-sm-9">
						<h2>See your messages:</h2>

						<div class="clearfix btn-group text-center">
							<a href="my_messages.php?inbox&u_id=<?php echo $user_id; ?>" class="btn btn-success">My Inbox</a>
							<a href="my_messages.php?sent&u_id=<?php echo $user_id; ?>" class="btn btn-primary">Sent Items</a>
						</div>
						<?php
							if ( isset( $_GET['sent'] ) ) {

								include( "sent.php" );

							} 
						?>

						<?php if ( isset( $_GET['inbox'] ) ) {?>
							<div class="table-responsive">
								<table class="table">

									<thead>
										<tr>
											<th>Sender</th>
											<th>Subject</th>
											<th>Date</th>
											<th>Reply</th>
										</tr>
									</thead>
									<tbody>
										<?php 

											$sel_msg = "SELECT * from messages where receiver='$user_id' AND msg_type='parent' order by 1 DESC";
											$run_msg = mysqli_query( $connection, $sel_msg );

											$count_msg = mysqli_num_rows( $run_msg );

											while ( $row_msg = mysqli_fetch_array( $run_msg ) ) {

												$msg_id = $row_msg['msg_id'];
												$msg_receiver = $row_msg['receiver'];
												$msg_sender = $row_msg['sender'];
												$msg_sub = $row_msg['msg_sub'];
												$msg_topic = $row_msg['msg_topic'];
												$msg_date = $row_msg['msg_date'];
												$msg_status = $row_msg['status'];

												$get_sender = "SELECT * from users where user_id='$msg_sender'";
												$run_sender = mysqli_query( $connection, $get_sender );
												$row = mysqli_fetch_array( $run_sender );

												$sender_name = $row['user_name'];

												if ( $msg_status == 'unread' ) {
													$output = "<tr class='success'>";
												}else {
													$output = "<tr class='active'>";
												}

												$output .= "<td><a href='user_profile.php?u_id=$msg_sender'>$sender_name</a></td>";
												$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>$msg_sub</a></td>";
												$output .= "<td>$msg_date</td>";
												$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>Reply</a></td>";
												$output .= "</tr>";

												echo $output; 

											}

										?>
									</tbody>
								</table>
							<?php } ?>

							<?php

								if ( isset( $_POST['submit_msg'] ) ) {

									$get_id = $_GET['msg_id'];

									$select_parrent_msg = "SELECT * from messages where msg_id='$get_id'";
									$run_parrent_msg = mysqli_query( $connection, $select_parrent_msg );
									$row_parrent_msg = mysqli_fetch_array( $run_parrent_msg );

									$parrent_msg_receiver = $row_parrent_msg['receiver'];
									$parrent_msg_sender = $row_parrent_msg['sender'];

									$reply_sender = $user_id;

									if ( $parrent_msg_receiver == $user_id ) {
										$reply_receiver = $parrent_msg_sender;
									}else {
										$reply_receiver = $parrent_msg_receiver;
									}

									$user_reply = $_POST['msg_reply'];
									$reply_status = "read";
									$reply_msg_type = "reply";

									$insert_reply_msg = "INSERT into messages(parrent_msg_id,sender,receiver,reply,status,msg_type,msg_date) values('$get_id','$reply_sender','$reply_receiver','$user_reply','read','reply',NOW())";
									$run_update = mysqli_query( $connection, $insert_reply_msg);

								}

								if ( isset( $_GET['msg_id'] ) ) {

									$get_id = $_GET['msg_id'];
									
									$select_msg = "SELECT * from messages where msg_id='$get_id'";
									$run_message = mysqli_query( $connection, $select_msg );

									$row_message = mysqli_fetch_array( $run_message );

									$msg_subject = $row_message['msg_sub'];
									$msg_topic = $row_message['msg_topic'];
									$msg_receiver = $row_message['receiver'];
									$msg_sender = $row_message['sender'];

									// get receiver name
									$get_receiver   = "SELECT * from users where user_id='$msg_receiver'";
									$run_receiver   = mysqli_query( $connection, $get_receiver );
									$row_receiver	= mysqli_fetch_array( $run_receiver );

									$receiver_name = $row_receiver['user_name'];
									$receiver_image = $row_receiver['user_image'];

									// get sender name
									$get_sender   = "SELECT * from users where user_id='$msg_sender'";
									$run_sender  = mysqli_query( $connection, $get_sender );
									$row_sender	= mysqli_fetch_array( $run_sender );

									$sender_name = $row_sender['user_name'];
									$sender_image = $row_sender['user_image'];

									// updating the unread message to read
									$update_unread = "UPDATE messages set status='read' where msg_id='$get_id'";
									$run_unread = mysqli_query( $connection, $update_unread );

									$output   = "<div class='well clearfix'>";
									$output  .= "<div class='message parent'>";
									$output  .= "<h4><img src='user/user_images/$sender_image'><strong> $sender_name</strong></h4>";
									$output  .= "<p><strong>Subject:</strong> $msg_subject</p>";
									$output  .= "<p><strong>Message:</strong> $msg_topic</p><br>";
									$output  .= "</div>";

									// get all replies to this message 
									$get_msg_reply = "SELECT * from messages where parrent_msg_id='$get_id' AND msg_type='reply'  order by msg_date ASC";
									$msg_reply_query = mysqli_query( $connection, $get_msg_reply );
									
									while ( $row_msg_reply = mysqli_fetch_array( $msg_reply_query ) ) {

										$reply_sender = $row_msg_reply['sender'];
										$reply_receiver = $row_msg_reply['receiver'];

										$reply_content = $row_msg_reply['reply'];

										if ( $reply_sender == $msg_sender ) {

											$output  .= "<div class='message reply sender clearfix'>";
											$output  .= "<img src='user/user_images/$sender_image'>";
											$output  .= "<p class='text-right'>$reply_content</p>";
											$output  .= "</div>";

										}else {

											$output  .= "<div class='message reply receiver clearfix'>";
											$output  .= "<img src='user/user_images/$receiver_image'>";
											$output  .= "<p class='text-right'>$reply_content</p>";
											$output  .= "</div>";

										}

									}

									$output  .= "<div class='reply-to-message clearfix'>";
									$output  .= "<form action='my_messages.php?msg_id=$get_id' method='POST' class='form-horizontal'>";
									$output  .= "<textarea name='msg_reply' class='form-control' rows='10' placeholder='Reply to this message...' required></textarea><br>";
									$output  .= "<input type='submit' name='submit_msg' class='btn btn-success pull-right' value='Reply to This Message'>";
									$output  .= "</form>";	 
									$output  .= "</div>";
									$output  .= "</div>";	

									echo $output;
								
								}

								
							?>
						</div>
					</div>
				</div>
			</div>
		</section>


<?php 

	include( "templates/footer.php" );

} ?>