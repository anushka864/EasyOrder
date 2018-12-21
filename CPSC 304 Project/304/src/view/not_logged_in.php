<?php
error_reporting(-1);
ini_set('display_errors',1);
?>

<!-- login form box -->
<html>
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
		<style>
			body {
			  padding-top: 40px;
			  padding-bottom: 40px;
			  background-color: #eee;
			}

			.form-signin {
			  max-width: 330px;
			  padding: 15px;
			  margin: 0 auto;
			}
			.form-signin .form-signin-heading,
			.form-signin .checkbox {
			  margin-bottom: 10px;
			}
			.form-signin .checkbox {
			  font-weight: normal;
			}
			.form-signin .form-control {
			  position: relative;
			  height: auto;
			  -webkit-box-sizing: border-box;
			     -moz-box-sizing: border-box;
				  box-sizing: border-box;
			  padding: 10px;
			  font-size: 16px;
			}
			.form-signin .form-control:focus {
			  z-index: 2;
			}
			.form-signin input[type="text"] {
			  margin-bottom: -1px;
			  border-bottom-right-radius: 0;
			  border-bottom-left-radius: 0;
			}
			.form-signin input[type="password"] {
			  margin-bottom: 10px;
			  border-top-left-radius: 0;
			  border-top-right-radius: 0;
			}
		</style>
</head>
<body>
<div class="container">
<form method="post" action="index.php" class="form-signin" name="loginform">
	<h2 class="form-signin-heading">Please sign in</h2>
	<br>
    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="form-control" type="text" name="user_name" required />

    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="form-control" type="password" name="user_password" autocomplete="off" required />
	
    <input type="submit"  class="btn btn-block btn-lg btn-signin btn-primary" name="login" value="Log in" />
    <input type="submit"  class="btn btn-block btn-lg btn-signin btn-primary" name="change_pw" value="Change Password" />
	<br>
	<?php
		if (isset($login)) {
				if ($login->errors) {
						foreach ($login->errors as $error) {
							echo '<div class="alert alert-warning">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $error . 
									'</div>';
						}
				}
				if ($login->messages) {
						foreach ($login->messages as $message) {
								echo '<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . 
									'</div>';
						}
				}
		}

		// show potential errors / feedback (from db object)
		if (isset($db)) {
				if ($db->errors) {
						foreach ($db->errors as $error) {
								echo '<div class="alert alert-warning">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $error . 
									'</div>';
						}
				}
				if ($db->messages) {
						foreach ($db->messages as $message) {
								echo '<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . 
									'</div>';
						}
				}
		}
		?>
    <a href="register.php">Register new account</a>
</form>
</div>
</body>
</html>
