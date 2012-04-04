<?php 
/*	logout.inc.php
 *	Logs out, unsets sessions, closes MySQL connection, returns home
 */

require_once("modules/dbConnect.inc");
if ($logged_in) {
	session_unset();
	session_destroy();
	mysql_close();
	Header("Location: index.php?a=logout");
}
?>