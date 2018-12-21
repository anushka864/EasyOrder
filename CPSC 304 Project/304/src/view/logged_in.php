<?php 
	error_reporting(-1);
	ini_set('display_errors',1);
?>
<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
<h1 class="text-center center-block">
	Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in.
	Try to close this browser tab and open it again. Still logged in! ;)
</h1>

<html lang="en">
	<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
</html>
</body>
	<style >
		body{
			background-color: #eee;
		}
		.center-block {
			width: 50%;
		}
	</style>
	<div class="center-block">
		<a class="btn btn-block btn-primary" href="cashier.php">I'm a cashier</a>
		<a class="btn btn-block btn-primary" href="server.php">I'm a server<br></a>
		<a class="btn btn-block btn-primary" href="order_helper.php">I'm a chef</a>
		<a class="btn btn-block btn-primary" href="manager.php">Go to Manager View</a>
		
		<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
		<a class="btn btn-block btn-danger" href="index.php?logout">Logout</a>
	</div>
</body>
