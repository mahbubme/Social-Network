<!DOCTYPE html>

<?php 
	
	include( "functions/functions.php" );

?>

<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Social Network</title>

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
							<form action="" method="post" class="navbar-form navbar-right" role="search">
								<div class="form-group">
									<label for="email">Email:</label>
									<input type="email" name="email" class="form-control" placeholder="Email" required>
								</div>
								<div class="form-group">
									<label for="pass">Password:</label>
									<input type="password" name="pass" class="form-control" placeholder="*****" required>
								</div>
								<button type="submit" name="sub" class="btn btn-default">Login</button>
							</form>
						</div><!-- /.navbar-collapse -->
					</div>
				</div>
			</nav>
		</header>

		<section id="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 text-center">
						<h1>Join the Largest Social Network</h1>
						<img src="assets/images/1.png" class="img-responsive inline-block" alt="">
					</div>
					<div class="col-sm-5">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<h3 class="text-center">Sign Up Here</h3>
								</div>
							</div>
							<div class="form-group">
								<label for="u_name" class="col-sm-2">Name:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="u_name" placeholder="Enter your name" required>
								</div>
							</div>
							<div class="form-group">
								<label for="u_pass" class="col-sm-2">Password:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="u_pass" placeholder="Enter your password" required>
								</div>
							</div>
							<div class="form-group">
								<label for="u_email" class="col-sm-2">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="u_email" placeholder="Enter your mail" required>
								</div>
							</div>
							<div class="form-group">
								<label for="u_country" class="col-sm-2">Country:</label>
								<div class="col-sm-10">
									<select name="u_country" class="form-control">
									  <option>Select a Country</option>
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
									  <option>Select a Gender</option>
									  <option value="Male">Male</option>
									  <option value="Female">Female</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="u_birthday" class="col-sm-2">Birthday:</label>
								<div class="col-sm-10">
									<input type="date" class="form-control" name="u_birthday" placeholder="mm/dd/yyyy" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" name="sign_up" class="btn btn-default">Sign Up</button>
								</div>
							</div>
						</form>

						<?php InsertUser(); ?>

					</div>
				</div>
			</div>
		</section>

		<footer id="footer">
			<div class="container">
				<div class="row">
					<p class="text-center">© 2016 - www.mahbub.me</p>
				</div>
     		 </div>
		</footer>

		<!-- jQuery -->
		<script src="assets/js/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="assets/sass/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
	</body>
</html>