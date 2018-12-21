<?php
	require_once("config/db.php");
	require_once("controller/DB.php");

	$db = new DB();
	$connect = $db->connectDB();

	$qType = $_GET['qtype'];

	$sql = 'SELECT staffName, count(ORDERNUMB) FROM (SELECT * FROM staff, order_assign_take WHERE staff.staffID = order_assign_take.sid) GROUP BY staffName HAVING count(ordernumb) = (SELECT max(count(ordernumb)) FROM order_assign_take GROUP by sid)';	
	
	$result = $db->executeSQL($sql);
	echo '<br><br><div class="panel panel-default"> <div class="panel-body">';
	echo 'Employee who has taken the most number of order is: <br>';
	while( $row = oci_fetch_array($result)) {
		echo '- <strong>'.$row['STAFFNAME'] . '</strong> took ' . $row['COUNT(ORDERNUMB)'] . ' orders.<br>';
	}
	echo ' </div> </div>';

?>
