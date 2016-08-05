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
				</div>
			</div>
		</section>


<?php 

	include( "templates/footer.php" );

} ?>