<?php
	error_reporting(-1);
	ini_set('display_errors',1);

	if(session_id() == '') {
		session_save_path("/tmp");
    session_start();
	}
	// checking for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
			exit("Sorry, this page does not run on a PHP version smaller than 5.3.7 !");
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
			// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
			require_once("lib/password_compatibility_library.php");
	}

	require_once("config/db.php");
	require_once("controller/DB.php");
	$db = new DB();

	require_once("model/Cashier.php");
	$cashier = new Cashier();

	include("view/cashier.php");


