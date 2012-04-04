<?php 

/*	dbConnect.inc
 *	Contains functions for connecting to the database
 */

	/**
	 *
	 * @param type $host MySQL host name
	 * @param type $username MySQL username
	 * @param type $password MySQL password
	 * @return type Returns the connection status
	 */

	function dbConnect($host,$username,$password) {
		return mysql_connect($host,$username,$password) or die("Houston, we have a problem: " . mysql_error());
	}
	
	/**
	 *
	 * @param type $database_name The name of the database to connect to
	 * @return type Returns the selected database
	 */
	function dbSelect($database_name) {
		return mysql_select_db($database_name) or die("Could not connect to the database: " . mysql_error());
	}

	//if at home
	if(stristr($_SERVER["SERVER_NAME"],"127.0.0.1") == true) {
		dbConnect("localhost", "fet10029052", "XxNJi7");
		dbSelect("fet10029052");
	}
	
	//if at uni
	else {
	dbConnect("mysql5", "fet10029052", "XxNJi7");
	dbSelect("fet10029052");
	}
?>
