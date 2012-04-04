<?php 
require_once("modules/dbConnect.inc");
if ($logged_in) {
	session_unset();
	session_destroy();
	mysql_close();
	Header("Location: index.php?a=logout");
}
?>