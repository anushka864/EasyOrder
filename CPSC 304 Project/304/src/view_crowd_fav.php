<?php
	require_once("config/db.php");
	require_once("controller/DB.php");

	$db = new DB();
	$connect = $db->connectDB();

	$qType = $_GET['qtype'];

  	$sql = 'SELECT DISTINCT fname FROM processorder P WHERE NOT EXISTS ((SELECT bid FROM bill_order_make) MINUS (SELECT bid FROM processorder O WHERE O.fname = P.fname))';	
	$result = $db->executeSQL($sql);
	echo '<br><br><div class="panel panel-default">
  		<div class="panel-body">';
	echo 'Popular food items: <br>';
	while( $row = oci_fetch_array($result)) {
		echo '- <strong>' . $row['FNAME'] . '</strong> was ordered by every table.<br>';
	}
	echo ' </div> </div>';

?>
