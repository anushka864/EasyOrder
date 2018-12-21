<?php
		require_once("config/db.php");
		require_once("controller/DB.php");
	    error_reporting(-1);
		ini_set('display_errors',1);
		$sql = 'SELECT ordernumb, fname, nofood FROM processorder order by ordernumb';
		$dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
		$result = oci_parse($dbConn, $sql);
		
		if($result!=false) {
			oci_execute($result);
			echo '<br>
			  <br>
			  <div class=panel panel-default">
			  <div class="panel-body">';
			echo 'List of Orders: <br>';
			while (($row = oci_fetch_object($result)) != false) {
				echo "<br><tr>Order Number: <strong><td> $row->ORDERNUMB</td></strong><br>-<td>$row->FNAME</td>: <td>$row->NOFOOD</td></tr><br>";
				}
		echo '</div>   </div>';}		
			else {
				$e = oci_error($result);
				echo $e['message'];
				}
			oci_free_statement($result);
oci_close($dbConn);	
		
?>
		
<html>
	<head>
	<title> Chef View </title>
	
	<style type="text/css"> 
		.panel-body {
			width: 100%;
			background-color: #333;
		}
	</style>
	</head>
