<?php 
if ($logged_in) {
	session_unset();
	session_destroy();
	Header("Location: index.php?a=logout");
}
?>