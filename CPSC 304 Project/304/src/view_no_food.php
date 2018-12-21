<html>
	<head>
	<title> Chef View </title>
	<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>	
	<style type="text/css"> 
		body{
			background-color: #eee;
		}
		.btn-block {
			width: auto;
		}
	</style>
	</head>
	</body>

<?php
require_once("config/db.php");
		require_once("controller/DB.php");
	    error_reporting(-1);
		ini_set('display_errors',1);
		$sql = 'SELECT p.fname, sum(p.noFood) AS nofood FROM processorder p, fooditem f WHERE p.fname = f.fname GROUP BY p.fname';
		$dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
		$result = oci_parse($dbConn, $sql);

			if($result!=false) {
			oci_execute($result);
			echo '<br>
			  <br>
			  <div class=panel panel-default">
			  <div class="panel-body">';
				echo '<h1><strong> All food items ordered: <br></strong></h1>';
				while (($row = oci_fetch_array($result)) != false) {
					//echo '<strong>' . $row['FNAME'] . '</strong> has ' . $row['NOFOOD'] . ' order(s).<br>';
					echo '<button class="btn btn-block btn-primary" type="button">'.
							$row['FNAME'] . '&nbsp;<span class="badge">' . $row['NOFOOD'] . '</span>'.
						'</button>';
				}
		}		
			else {
				$e = oci_error($result);
				echo $e['message'];
				}
			oci_free_statement($result);
oci_close($dbConn);	
		
?>

	</body>
</html>
