<?php # config.inc.php

/* 
 *	File name: dbconnect.inc
 *	Connects to the database
 */

	function dbConnect($host,$username,$password) {
		return mysql_connect($host,$username,$password) or die("Houston, we have a problem: " . mysql_error());
	}
	
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
