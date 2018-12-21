<?php
	require_once("config/db.php");
	require_once("controller/DB.php");
	error_reporting(-1);
ini_set('display_errors',1);
	$sql = 'select * from processorder';
	$dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
	$result = oci_parse($dbConn, $sql);
	if($result!=false){
		oci_execute($result);
		echo '<table class="table table-hover">';
		echo '<thead>';
		echo '<tr><th>FNAME</th>';
		echo '<th> ORDERNUB </th><th> NOFOOD </th><th> BID </th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while(($row = oci_fetch_object($result)) != false) {
		echo "<tr><td>$row->FNAME</td><td>$row->ORDERNUMB</td>";
		echo "<td>$row->NOFOOD</td><td>$row->BID</td></tr>";
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
