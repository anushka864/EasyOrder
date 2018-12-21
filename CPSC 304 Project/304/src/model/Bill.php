<?php 

/**
*	Class bill 
* include information on a bill - food items, staff who took the order, total of bill
*/
class Bill 
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
     * @var bill_number Bill number that identifies till bill 
     */
		public $bill_number = 0;
    /**
     * @var total Total amount for this bill 
     */
		public $total = 0;
    /**
     * @var staff_name Staff's name who took this order
     */
		public $staff_name = null;
    /**
     * @var staff_id Staff's id who took this order
     */
		private $staff_id = 0;
    /**
     * @var table_number table number for this bill 
     */
		public $table_number = 0;
    /**
     * @var is_paid_text Is this bill paid for already in string
     */
		public $is_paid_text = null;
		/**
		*	@var food_list The FoodItems ordered on this bill
		*/
		public $food_list = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$bill = new Bill();"
     */
    public function __construct($bid, $total, $staffid, $tableid, $isPaid)
    {
			$this->bill_number = $bid;
			$this->total = $total;
			$this->table_number = $tableid;
			$this->staffid = $staffid;
			if($isPaid) {
				$this->is_paid_text = "Yes";
			} else {
				$this->is_paid_text = "No";
			}
    }

		/** 
		* Get the staff name from the staff table with staff id
		*/
		public function getStaffName() {
			global $db;
			$db->connectDB();
			$sql = "SELECT staffname 
							FROM staff
							WHERE staffid = " . $this->staffid;
			$result = $db->executeSQL($sql);
			$staff = oci_fetch_object($result);
			$db->disconnectDB();
			return $staff->STAFFNAME;
		}




}
