<?php 
error_reporting(-1);
ini_set('display_errors',1);
?>
<html lang="en"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
</html>
</body>
	<style>	
		body{
			background-color: #eee;
		}
	</style>
	<a class="btn btn-danger" href="index.php?logout">Logout</a>

	<h1> Bills </h1>

	<h2> Cashier: <?php echo $_SESSION['user_name']; ?> </h2>
	<ul class="list-unstyled list-group">
		<?php 
			foreach($cashier->bills as $bill) {
				echo "<li class='list-group-item'>";
				echo "<div class='accoridion' id='bill-accordion'>";
				echo "<div class='accordion-group'>"; // accordion group
				echo "<div class='accordion-heading'>"; // accordiong header
				echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#bill-accordion' href='#collapse" . $bill->bill_number . "'>";
				echo "Bill number $bill->bill_number";
				echo "</a>";
				echo "</div>"; // end of accordion header
				echo "<div id='collapse" . $bill->bill_number . "' class='accordion-body collapse'>"; // accordion body
				echo "<div class='accordion-inner'>";
				echo "<div class='row'>";
				echo "<div class='col-md-4'>Table number</div>" . "<div class='col-md-6'>" . $bill->table_number . "</div>";
				echo "</div>";
				echo "<div class='row'>";
				echo "<div class='col-md-4'>Staff</div>" . "<div class='col-md-6'>" . $bill->getStaffName() . "</div>";
				echo "</div>";
				if(!empty($bill->food_list)) {
					echo "<div class='row'>";
					echo "<div class='col-md-4'>Food ordered</div>";
					echo "<div class='col-md-6'>"; 
					echo "<table class='table table-hover'>";
					echo "<thead><tr>";
					echo "<th>Food name</th>";
					echo "<th>Quantity</th>";
					echo "<th>Amount</th>";
					echo "</tr></thead>";
					echo "<tbody>";
					foreach($bill->food_list as $food) {
						echo "<tr>";
						echo "<td>$food->food_name</td>";
						echo "<td>$food->food_quantity</td>";
						echo "<td>$food->food_price</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";  
					echo "</div>"; // end of row 
				}
				echo "<div class='row'>";
				echo "<div class='col-md-4'>Total</div>" . "<div class='col-md-6'>" . $bill->total . "</div>";
				echo "</div>";
				echo "<div class='row'>";
				echo "<div class='col-md-4'>Has this bill been paid?</div>" . "<div class='col-md-6'>" . $bill->is_paid_text . "</div>";
				echo "</div>";
				if($bill->is_paid_text == 'No') {
					echo "<form method='post' action='cashier.php'>";
					echo "<input type='hidden' name='bid' value='" . $bill->bill_number . "'/>";
					echo "<input type='submit' class='btn btn-success' name='pay_bill' value = 'Pay'>";
					echo "</form>";
				}
				echo "</div>"; // end of accordion inner
				echo "</div>"; // end of accordion body
				echo "</div>"; // end of accordion group
				echo "</li>";
			}
		?>
	</ul>
	<?php
		if (isset($cashier)) {
				if ($cashier->errors) {
						foreach ($cashier->errors as $error) {
							echo '<div class="alert alert-warning">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $error . 
									'</div>';
						}
				}
				if ($cashier->messages) {
						foreach ($cashier->messages as $message) {
							echo '<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . 
									'</div>';
						}
				}
		}
	?>
</body>
