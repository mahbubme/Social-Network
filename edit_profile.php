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
							$user_pass		= $row['user_pass'];
							$user_email		= $row['user_email'];
							$user_gender	= $row['user_gender'];
							$user_birthday	= $row['user_b_day'];
							$user_country 	= $row['user_country'];
							$user_image 	= $row['user_image'];
							$register_date  = $row['register_date'];
							$last_login 	= $row['last_login'];

						?>

						<img src="user/user_images/<?php echo $user_image; ?>" class="img-responsive" alt="">
						<ul class="list-group">
							<li class="list-group-item">Name: <?php echo $user_name; ?></li>
							<li class="list-group-item">Country: <?php echo $user_country; ?></li>
							<li class="list-group-item">Last Login: <?php echo $last_login; ?></li>
							<li class="list-group-item">Member Since: <?php echo $register_date; ?></li>
							<li class="list-group-item"><a href="my_messages.php?u_id=<?php echo $user_id; ?>">Messages (2)</a></li>
							<li class="list-group-item"><a href="my_posts.php?u_id=<?php echo $user_id; ?>">My Posts (3)</a></li>
							<li class="list-group-item"><a href="edit_profile.php?u_id=<?php echo $user_id; ?>">Edit My Account</a></li>
							<li class="list-group-item"><a href="logout.php">Logout</a></li>
						</ul>

					</div>
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
								$u_image = $_FILES['u_image']['name'];
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
				</div>
			</div>
		</section>


<?php 

	include( "templates/footer.php" );

} ?>