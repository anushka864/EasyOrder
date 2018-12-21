<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
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
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
			// create/read session, absolutely necessary
			// http://stackoverflow.com/questions/6821532/php-warning-permission-denied-13-on-session-start
			session_save_path("/tmp");
			session_start();
        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->authenticateUser();
        } elseif (isset($_POST["change_pw"])) {
						$this->change_user_password();
				}
    }

    /**
     * log in with post data
     */
    private function authenticateUser()
    {
     		if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
						$user_name = $_POST['user_name'];

						$sql = "SELECT * 
										FROM staff
										WHERE staffname = :name";

						$tuples = array (
							":name" => $user_name,
						);
						global $db;
						$db->connectDB();
						$result = $db->executeBoundSQL($sql, $tuples);
						$staff = oci_fetch_object($result);	
						$user_password = $_POST['user_password'];	
						if($staff && password_verify($user_password, $staff->PASSWORD)) {
							// write user data into PHP SESSION (a file on your server)
							$_SESSION['user_name'] = $staff->STAFFNAME;
							$_SESSION['user_login_status'] = 1;
						} else {
							$this->errors[] = "Login credentials incorrect. Please try again";
						}
						$db->disconnectDB();
						
        } else {
					$this->messages[] = "Username or password is empty";
				}
    }

		/** 
		* updates user password in database
		*/
		private function change_user_password() {
				$user_name = $_POST['user_name'];
				$user_password = $_POST['user_password'];	
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
			
				$sql = "UPDATE staff 
								SET password = :password  
								WHERE staffname = :name";
				
				global $db;
				$db->connectDB();
				$tuples = array (
					":name" => $user_name,
					":password" => $user_password_hash
				);
				$result = $db->executeBoundSQL($sql, $tuples);
				if(oci_num_rows($result) == 1) {
					$this->messages[] = "Password successfully updated";
				}
				$db->disconnectDB();
		}

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedb_connection ack message
        $this->messages[] = "You have been logged out.";
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
