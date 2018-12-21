<?php
	require_once("config/db.php");
	require_once("controller/DB.php");
	error_reporting(-1);
ini_set('display_errors',1);
	$sql = 'select * from fooditem';
	$dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
	$result = oci_parse($dbConn, $sql);
	if($result!=false){
		oci_execute($result);
		echo '<table class="table table-hover">';
		echo '<thead>';
		echo '<tr><th>FoodItem</th>';
		echo '<th> PRICE </th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while(($row = oci_fetch_object($result)) != false) {
		echo "<tr><td>$row->FNAME</td><td>$row->PRICE</td></tr>";
}
		echo '</tbody>';
		echo '</table>';

	} else { 
		$e = oci_error($result);
		echo $e['message']; 
	}
oci_free_statement($result);
oci_close($dbConn);
?>
