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
							<a class="navbar-brand" href="index.php">Social Network</a>
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