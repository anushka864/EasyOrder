<?php 
include_once "Bill.php"; // this will import Bill class
include_once "Food.php"; // this will import Food class
/**
 * Class cashier
 * handles the user's cashier and logout process
 */
class Cashier 
{
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();	
		/**
		*	@var bills Collection of bills 
		*/
		public $bills = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$cashier = new Cashier();"
     */
    public function __construct()
    {
			if(isset($_POST["pay_bill"])) {
				$this->payBill($_POST["bid"]);
				$this->fetch_all_bills();
			} else {
				$this->fetch_all_bills();
			}
    }

		/** 
		* Pay bill and update isPaid column in databse
		*/
		private function payBill($bid) {
			$sql = "UPDATE bill_order_make 
							SET billpaid = " . 1 . " " .
							"WHERE bid = " . $bid;
			global $db;
			$db->connectDB(); 
			$result = $db->executeSQL($sql);
			if(oci_num_rows($result) == 1) {
				$this->messages[] = "Successfully paid bill #" . $bid;
			} else {
				$this->errors[] = "There was an error paying the bill. Please try again.";
			}
			$db->disconnectDB();
		}

		/** 
		* fetch bills from database 
		*/
		private function fetch_all_bills() {
			global $db;
			$db->connectDB(); 
			$sql = "SELECT * 
							FROM bill_order_make"; 
			$result = $db->executeSQL($sql);
			while( $row = oci_fetch_array($result, OCI_BOTH)) {
				$bid = $row["BID"];
				$total = $row["TOTAL"];
				$staffid = $row["STAFFID"];
				$tableid = $row["TABLEID"];
				$billpaid = $row["BILLPAID"];
				$bill = new Bill($bid, $total, $staffid, $tableid, $billpaid);
				$this->bills[$bid] = $bill;
			}
			$sql = "SELECT bid, f.fname, nofood, price
							FROM fooditem f, processorder p1
							WHERE f.fname = p1.fname AND f.fname
							IN 
							(SELECT p2.fname 
							FROM processorder p2)";
			$result = $db->executeSQL($sql);
			while( $row = oci_fetch_array($result, OCI_BOTH)) {
				$bid = $row["BID"]; 
				$food_name= $row["FNAME"];
				$food_quantity = $row["NOFOOD"];
				$food_price = $row["PRICE"];
				$food = new Food($food_name, $food_quantity, $food_price);
				$this->bills[$bid]->food_list[] = $food;	
			}
			
			$db->disconnectDB();

		}
		

}
