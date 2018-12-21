<?php
	require_once("config/db.php");
	require_once("controller/DB.php");

	$db = new DB();
	$connect = $db->connectDB();
	
	if(isset($_GET['name']) && isset($_GET['pwd'])) {
			echo '<script language="javascript">';
			echo 'alert("reached!")';
			echo '</script>';

		$addSql = 'INSERT INTO Staff values (' . $_GET['name'] . ',' . $_GET['pwd'] . ')';
		$xcute = $db->executeSQL($addSql);	
		if(oci_num_rows($xcute)==1){
			echo '<script language="javascript">';
			echo 'alert("Added!")';
			echo '</script>';
		}

	}
	$title = 'Manager View';
	$sql = 'SELECT * FROM Staff';
	$response = $db->executeSQL($sql);

?>

<html>
	<head>
		<title>Manager View</title>
		<link rel='stylesheet' type='text/css' href="css/normalize.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
		<script type="text/javascript">
			$(document).ready(function(){ 
				 $("a.ajax-link").on("click", function(e) {
			        e.preventDefault();
			        $(".tab-content").load(this.href);
			    });
			});
		</script>
	</head>
	<body>
		<div class='col-xs-6 col-md-offset-3'>
			<h1><?=$title;?></h1>
			<img src="http://techteen.net/wp-content/uploads/2012/10/Clipart-Graph.png"/>
			<h3>Current Employees</h3>
			<div class='table-responsive'>
				<table class='table'>
					<thead>
	          			<tr>
	            			<th>Name</th>
	          			</tr>
	        		</thead>
			        <tbody>
					<?php 
							while(($row = oci_fetch_object($response)) != false) {
				 				echo "<tr><td>$row->STAFFNAME</td></tr>";
							}
						?>
					</tbody>
				</table>

				<br>
				
				<h3> Summary Statistics </h3>
				<br>
				
				<div class="summary">
				    <ul class="nav nav-tabs" id="myTab">
				        <li class="dropdown">
				            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Staff<b class="caret"></b></a>
				            <ul class="dropdown-menu">
				                <li><a class="ajax-link" href="view_top_employee.php">Most number of orders placed</a></li>
				                <li><a class="ajax-link" href="view_bad_employee.php">Least number of orders placed</a></li>
				            </ul>
				        </li>
				        
				        <li><a class="ajax-link" href="view_stock.php">View stock</a></li>
				        <li><a class="ajax-link" href="view_total_rev.php">Total revenue</a></li>
				      	<li><a class="ajax-link" href="view_crowd_fav.php">Top selling food</a></li> 
				    </ul>
				    <div class="tab-content fade in">
				        <div id="sectionA" class="tab-pane fade in active">
				            <br><br>

				            <p><b>Click any one of the above</b><br>
				            	Employee = staff who has logged the most/least number of orders (nested aggregation) <br>
				            	Stock = Number of food items<br>
				            	Total revenue = sum of total across all bills (aggregation) <br>
						Favourite Food = See food items that are ordered by EVERY table (Division)
				            </p>

				        </div>
				    </div>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
      			</div>
		</div>
	</body>
</html>
