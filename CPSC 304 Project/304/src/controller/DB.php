<?php
/* oci_connect() allows you to log onto the Oracle database
	 The three arguments are the username, password, and database
	 You will need to replace "username" and "password" for this to
	 to work. 
	 all strings that start with "$" are variables; they are created
	 implicitly by appearing on the left hand side of an assignment 
	 statement 
	 
	 http://php.net/manual/en/function.ocilogon.php
	 OCILOGON is deprecated 
 */

	class DB 
	{
		/**
		 * @var object The database connection
		*/
		public $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();	

		public function __construct() 
		{	
		}

		/** 
		*	Attempts a database connection 
		*/
		public function connectDB() 
		{
			$this->db_connection = oci_connect(DB_USER, DB_PASS, DB_NAME);
			// Connect Oracle...
			if ($this->db_connection) {
				$this->messages[] =  "Admin is logged in.";
			} else {
				$this->errors[] = "Cannot connect to DB.";
				$e = OCI_Error(); // For OCILogon errors pass no handle
				echo htmlentities($e['message']);
			}
		}

		/**
		*	Disconnects database when we are done 
		*/
		public function disconnectDB() {
			oci_close($this->db_connection);
		}


		public function executeSQL($command) {
			$statement = oci_parse($this->db_connection, $command);
			if(!$statement) {
				$this->errors[] =  "Cannot parse the following command: " . $command;
				$e = oci_error($this->db_connection); // for errors
				$this->errors[] = htmlentities($e['message']);
			}
			
			$r = oci_execute($statement);
			if(!$r) {
				$this->errors[] = "Cannot execute the following command: " . $command;
				$e = oci_error($statement); 
				$this->errors[] = htmlentities($e['message']);
			}

			return $statement;
		}


		public function executeBoundSQL($cmdstr, $list) {
			/* Sometimes a same statement will be excuted for several times, only
			 the value of variables need to be changed.
			 In this case you don't need to create the statement several times; 
			 using bind variables can make the statement be shared and just 
			 parsed once. This is also very useful in protecting against SQL injection. 
			 See example code below for how this functions is used */

			$statement = oci_parse($this->db_connection, $cmdstr);

			if (!$statement) {
				$this->errors[] =  "Cannot parse the following command: " . $command;
				$e = oci_error($this->db_connection); // for errors
				$this->errors[] = htmlentities($e['message']);
			}

			//foreach ($list as $tuple) {
			//	foreach ($tuple as $bind => $val) {
			foreach($list as $bind => $val) {
				oci_bind_by_name($statement, $bind, $val);
				unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
			}	
			$r = oci_execute($statement);
			if (!$r) {
				$this->errors[] = "Cannot execute the following command: " . $command;
				$e = oci_error($statement); 
				$this->errors[] = htmlentities($e['message']);
			}
			//}
			return $statement;
		}
	
	}
