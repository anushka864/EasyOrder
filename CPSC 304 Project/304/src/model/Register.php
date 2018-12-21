<?php

/**
 * Class Register 
 * handles the user's login and logout process
 */
class Register 
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
		*	@var success flag indicate registration successful 
		*/
		public $registrationSucceed = false;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created
     */
    public function __construct()
    {
			if(isset($_POST["register"])) {
				$this->registerNewUser();
			}
    }

		/** 
		*	handles the entire registration process, 
		*	making sure the user info is valid before creating a new user in database
		*/
		private function registerNewUser() 
		{
			global $db;
			$user_name = trim($_POST['user_name']);
			$user_password = trim($_POST['user_password']);
			$user_password_repeat = trim($_POST['user_password_repeat']);

			if (!preg_match('/[a-z\d]$/i', $user_name)) {
				$this->errors[] = "Name ". $user_name . ", is not valid, must be alphanumeric";
			} elseif(strlen($user_name) < 3) {
				$this->errors[] = "Name length must be at least 3";
			} elseif ((strlen($user_password) < 3) || (strlen($user_password) > 20)) {
				$this->errors[] = "Password lengt must be between 3 and 20";
			} elseif ($user_password !== $user_password_repeat) {
				$this->errors[] = "Password doesn't match";
			} else {
				// check if user already exist
				$sql = "SELECT * FROM staff WHERE staffname = :name";
				$db->connectDB();
				$tuples = array (
					":name" => $user_name
				);
				$result = $db->executeBoundSQL($sql, $tuples);
				if($result && oci_fetch_all($result, $res) > 0) {
					$this->errors [] = "Staff " . $user_name . " already exist. Please navigate to login page instead.";
				} else {

					$sql = "INSERT INTO staff 
									VALUES (staff_sequence.nextval, :name, :password)";
					$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					$tuples = array (
						":name" => $user_name,
						":password" => $user_password_hash
					);
					$result = $db->executeBoundSQL($sql, $tuples);
					if(oci_num_rows($result) == 1) {
						header("location: register.php?success=true");
					} else {
						$this->messages[] = "There was a problem with the registration. Please try again.";
					}
				}
				$db->disconnectDB();
			}
		}

}
