		<section id="content" class="registration-page" >
			<div class="container">
				<div class="row">
					<div class="col-sm-7 text-center">
						<h1>Join the Largest Social Network</h1>
						<img src="assets/images/1.png" class="img-responsive inline-block" alt="">
					</div>
					<div class="col-sm-5">
						<form method="post" class="user-registration-form form-horizontal">
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
									<button type="submit" name="sign_up" class="btn btn-default btn-success">Sign Up</button>
								</div>
							</div>
						</form>

						<?php include( 'user_insert.php' ); ?>

					</div>
				</div>
			</div>
		</section>