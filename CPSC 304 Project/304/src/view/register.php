<?php 
	error_reporting(-1);
	ini_set('display_errors',1);
?>

<html lang="en">
	<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
</html>
<body>
	<style>	
		body{
			background-color: #eee;
		}
	</style>
	<form class="form-horizontal" method="post" action="register.php" name="registerform">
		<div class="form-group">
			<h1 class="col-md-offset-2 col-md-2"> Registration </h1>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="register_input_name">Name</label>
			<div class="col-md-8">
				<input id="register_input_name" class="form-control" type="text" name="user_name" placeholder="You name" required />
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label" for="register_input_password">Password</label>
			<div class="col-md-8">
				<input id="register_input_password" class="form-control" type="password" name="user_password" autocomplete="off" placeholder="Password" required />
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label" for="register_input_password_repeat">Confirm Password</label>
			<div class="col-md-8">
				<input id="register_input_password_repeat" class="form-control" type="password" name="user_password_repeat" autocomplete="off" placeholder="Retype to confirm your password" required />
			</div>
		</div>	
				
		<div class="form-group">
			<div class="col-md-offset-2 col-md-2">
				<input class="btn btn-primary" type="submit" name="register" value="Register" /></a>
			</div>
			<div class="col-md-2">
				<a class="btn btn-primary" href="index.php">Cancel</a>
			</div>
		</div>

		<div class="form-group">	
			<div class="col-md-offset-2 col-md-2">
				<a href="index.php">Back to Login page</a>
			</div>
		</div>
	</form>
	<?php
		if (isset($register)) {
				if ($register->errors) {
						foreach ($register->errors as $error) {
							echo '<div class="alert alert-warning">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $error . 
									'</div>';
						}
				}
				if ($register->messages) {
						foreach ($register->messages as $message) {
							echo '<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . 
									'</div>';
						}
				}
		}
	?>
</body>
