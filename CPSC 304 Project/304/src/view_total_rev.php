<?php
	require_once("config/db.php");
	require_once("controller/DB.php");

	$db = new DB();

	$sql = 'select sum(total) as total_sum from bill_order_make';
	$dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
	$result = oci_parse($dbConn, $sql);
	echo '<br><br><div class="panel panel-default"> <div class="panel-body">';
	echo 'Total revenue is';
	if($result!=false){
		oci_define_by_name($result, "TOTAL_SUM"	, $total);
		oci_execute($result);
		while(oci_fetch($result)) {
			echo '<strong> $' . $total . '</strong>';
		}
	} else { 
		$e = oci_error($result);
		echo $e['message']; 
	}

	 echo ' </div> </div>';

?>
